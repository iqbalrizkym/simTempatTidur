<?php
class Pp_model extends CI_Model{

	public function __construct(){
		$this->load->database();
		$this->load->library('session');
		$this->load->helper('url_helper');
		
		if($this->session->userdata('level')!="Petugas Pendaftaran"){
			redirect('login/index');
		}
	}

	// profil
	public function update_profil($kd_akt, $data){
		$this->db->set($data);
		$this->db->where('kd_akt', $kd_akt);
		$this->db->update('aktor');
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function get_aktor ($kd_akt = FALSE){
		if($kd_akt == FALSE){
			$query = $this->db->get('aktor');
			return $query->result_array();
		}
		$query = $this->db->get_where('aktor', array('kd_akt' => $kd_akt));
		return $query->row_array();
	}

	// status
	public function get_status(){
		$sql = array('*',
			'COUNT(IF(status_tt="kosong", 1, NULL)) "Kosong"',
			'COUNT(IF(status_tt="Disiapkan", 1, NULL)) "Disiapkan"',
			'COUNT(IF(status_tt="Direncanakan", 1, NULL)) "Direncanakan"',
			'COUNT(IF(status_tt="Diminta", 1, NULL)) "Diminta"',
			'COUNT(IF(status_tt="Dipesan", 1, NULL)) "Dipesan"',
			'COUNT(IF(status_tt="Disiapkan (Pesan)", 1, NULL)) "Disisan"',
			'COUNT(IF(status_tt="Dipakai", 1, NULL)) "Dipakai"',
			'COUNT(IF(status_tt="Rusak", 1, NULL)) "Rusak"
			');
		$this->db->select($sql);
		$this->db->from('bangsal');
		$this->db->join('tmp_tdr', 'tmp_tdr.kd_bgs = bangsal.kd_bgs');
		$this->db->group_by('bangsal.kd_bgs');
		$result = $this->db->get();
		return $result->result_array();
	}
	Public function get_nm_bgs($kd_bgs){ 
		$this->db->from('bangsal');
		$this->db->where('kd_bgs', $kd_bgs);
		$query = $this->db->get();
		if($query->num_rows()>0) {
			$data = $query->row_array();
			$value = $data['nm_bgs'];
			Return $value;
		} else {
			return false;
		}
	}
	public function get_detail($where){
		$this->db->select('*');
		$this->db->from('tmp_tdr');
		$this->db->join('guna_tt', 'tmp_tdr.kd_tt = guna_tt.kd_tt', 'left');
		$this->db->join('kelas', 'kelas.kd_kls = tmp_tdr.kd_kls', 'left');
		$this->db->join('detail_diagnosa', 'detail_diagnosa.kd_gn = guna_tt.kd_gn', 'left');
		$this->db->join('pasien', 'pasien.kd_rm = guna_tt.kd_rm', 'left');
		$this->db->join('penyakit', 'penyakit.kd_pyk = detail_diagnosa.diagnosa', 'left');
		$this->db->join('bangsal', 'bangsal.kd_bgs = tmp_tdr.kd_bgs', 'left');
		$this->db->where($where);
		$this->db->group_by('tmp_tdr.kd_tt');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function get_tt(){
		$this->db->select('*');
		$this->db->from('tmp_tdr');
		$this->db->join('bangsal', 'bangsal.kd_bgs = tmp_tdr.kd_bgs');
		$this->db->join('kelas', 'kelas.kd_kls = tmp_tdr.kd_kls');
		$this->db->group_by('tmp_tdr.kd_tt');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_tt_kosong($where){
		$this->db->select('*');
		$this->db->from('tmp_tdr');
		$this->db->join('bangsal', 'bangsal.kd_bgs = tmp_tdr.kd_bgs');
		$this->db->join('kelas', 'kelas.kd_kls = tmp_tdr.kd_kls');
		$this->db->where($where);
		$this->db->group_by('tmp_tdr.kd_tt');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_guna_tt($where){
		$this->db->select('*');
		$this->db->from('guna_tt');
		$this->db->where($where);
		$result = $this->db->get();
		return $result->result_array();
	}
	public function get_data_duatabel($table, $tabel1, $penyambung, $where){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join($tabel1, $penyambung);
		$this->db->where($where);
		$result = $this->db->get();
		return $result->result_array();
	}
	public function buatkodegn($tabel,$inisial){
		$con = mysqli_connect("localhost","root","","rs");
		$struktur = mysqli_query($con, "SELECT * from guna_tt");
		$fieldInfo = mysqli_fetch_field_direct($struktur,0);
		$field = $fieldInfo->name;
		$panjang =10;
		$qry = mysqli_query($con,"SELECT MAX(kd_gn) FROM guna_tt");
		$row = mysqli_fetch_array($qry); 
		if ($row[0]=="") {
			$angka = 0;
		}else{
			$angka = substr($row[0],strlen($inisial));
		}
		$angka++;
		$angka = strval($angka);
		$tmp = "";
		for ($i=1; $i <= ($panjang-strlen($inisial)-strlen($angka)) ; $i++) { 
			$tmp = $tmp."0";
		}return $inisial.$tmp.$angka;
	}
	public function set_guna_tt(){
		$data = array(
			'kd_gn' 		=> $this->buatkodegn('guna_tt', 'GN'),
			'kd_tt' 		=> $this->input->post('kd_tt'),
			'kd_rm' 		=> $this->input->post('kd_rm'),
			'jns_msk'		=> $this->input->post('jns_msk'),
			'status_ttguna'	=> 'On'
		);
		return $this->db->insert('guna_tt', $data);
	}
	public function update_status(){
		$kd_tt = $this->input->post('kd_tt');
		$data_ubah_status = array (
			'status_tt' => 'Diminta'
		);
		$this->db->where('kd_tt', $kd_tt);
		return $this->db->update('tmp_tdr', $data_ubah_status);
	}
	public function update_status_psn(){
		$kd_rm = $this->input->post('kd_rm');
		$data_ubah_status_psn = array (
			'status_psn' => 'In'
		);
		$this->db->where('kd_rm', $kd_rm);
		return $this->db->update('pasien', $data_ubah_status_psn);
	}
	public function get_tmp_tdr($kd_tt = FALSE){
		if($kd_tt == FALSE){
			$this->db->select('*');
			$this->db->from('tmp_tdr');
			$this->db->join('bangsal', 'bangsal.kd_bgs = tmp_tdr.kd_bgs');
			$this->db->join('kelas', 'kelas.kd_kls = tmp_tdr.kd_kls');
			$query = $this->db->get();
			return $query->result_array();
		}
		$query = $this->db->get_where('tmp_tdr', array('kd_tt' => $kd_tt));
		return $query->row_array();
	}
	public function get_kelas($kd_kls = FALSE){
		if($kd_kls == FALSE){
			$query = $this->db->get('kelas');
			return $query->result_array();
		}
		$query = $this->db->get_where('kelas', array('kd_kls' => $kd_kls));
		return $query->row_array();
	}
	public function get_pasien($kd_rm = FALSE){
		if($kd_rm == FALSE){
			$this->db->select('*');
			$this->db->from('pasien');
			$this->db->where('status_psn = "Out"');
			$query = $this->db->get();
			return $query->result_array();
		}
		$query = $this->db->get_where('pasien', array('kd_rm' => $kd_rm));
		return $query->row_array();
	}
	public function buatkodedgn($tabel,$inisial){
		$con = mysqli_connect("localhost","root","","rs");
		$struktur = mysqli_query($con, "SELECT * from detail_diagnosa");
		$fieldInfo = mysqli_fetch_field_direct($struktur,0);
		$field = $fieldInfo->name;
		$panjang =10;
		$qry = mysqli_query($con,"SELECT MAX(kd_gn) FROM detail_diagnosa");
		$row = mysqli_fetch_array($qry); 
		if ($row[0]=="") {
			$angka = 0;
		}else{
			$angka = substr($row[0],strlen($inisial));
		}
		$angka++;
		$angka = strval($angka);
		$tmp = "";
		for ($i=1; $i <= ($panjang-strlen($inisial)-strlen($angka)) ; $i++) { 
			$tmp = $tmp."0";
		}return $inisial.$tmp.$angka;
	}
	public function set_detail_diagnosa(){
		$data = array(
			'kd_gn' 		=> $this->buatkodedgn('guna_tt', 'GN'),
			'diagnosa' 		=> $this->input->post('diagnosa')
		);
		return $this->db->insert('detail_diagnosa', $data);
	}

	// pendaftran pasien
	public function buatkoderm($tabel,$inisial){
		$con = mysqli_connect("localhost","root","","rs");
		$struktur = mysqli_query($con, "SELECT * from pasien");
		$fieldInfo = mysqli_fetch_field_direct($struktur,0);
		$field = $fieldInfo->name;
		$panjang =8;
		$qry = mysqli_query($con,"SELECT MAX(kd_rm) FROM pasien");
		$row = mysqli_fetch_array($qry); 
		if ($row[0]=="") {
			$angka = 0;
		}else{
			$angka = substr($row[0],strlen($inisial));
		}
		$angka++;
		$angka = strval($angka);
		$tmp = "";
		for ($i=1; $i <= ($panjang-strlen($inisial)-strlen($angka)) ; $i++) { 
			$tmp = $tmp."0";
		}return $inisial.$tmp.$angka;
	}
	public function set_pendaftaran(){
		$data = array(
			'kd_rm' 		=> $this->buatkoderm('pasien', 'RM'),
			'nm_psn' 		=> $this->input->post('nm_psn'),
			'alm_psn' 		=> $this->input->post('alm_psn'),
			'tgl_lahir' 	=> $this->input->post('tgl_lahir'),
			'jns_psn' 		=> $this->input->post('jns_psn'),
			'status_psn' 	=> 'Out',
			'tgl_daftar' 	=> date("Y-m-d H:i:s")
		);
		return $this->db->insert('pasien', $data);
	}
	public function get_penyakit($kd_pyk = FALSE){
		if($kd_pyk == FALSE){
			$query = $this->db->get('penyakit');
			return $query->result_array();
		}
		$query = $this->db->get_where('penyakit', array('kd_pyk' => $kd_pyk));
		return $query->row_array();
	}

	// minta cari
	public function get_minta_cari($kd_cari = FALSE){
		if($kd_cari == FALSE){
			$this->db->select('*');
			$this->db->from('minta_cari');
			$this->db->join('petugas', 'petugas.kd_ptg = minta_cari.kd_ptg');
			$query = $this->db->get();
			return $query->result_array();
		}
		$query = $this->db->get_where('minta_cari', array('kd_cari' => $kd_cari));
		return $query->row_array();
	}
	public function buatkodecari($tabel,$inisial){
		$con = mysqli_connect("localhost","root","","rs");
		$struktur = mysqli_query($con, "SELECT * from minta_cari");
		$fieldInfo = mysqli_fetch_field_direct($struktur,0);
		$field = $fieldInfo->name;
		$panjang =8;
		$qry = mysqli_query($con,"SELECT MAX(kd_cari) FROM minta_cari");
		$row = mysqli_fetch_array($qry); 
		if ($row[0]=="") {
			$angka = 0;
		}else{
			$angka = substr($row[0],strlen($inisial));
		}
		$angka++;
		$angka = strval($angka);
		$tmp = "";
		for ($i=1; $i <= ($panjang-strlen($inisial)-strlen($angka)) ; $i++) { 
			$tmp = $tmp."0";
		}return $inisial.$tmp.$angka;
	}
	public function set_minta_cari(){
		$data = array(
			'kd_cari' 		=> $this->buatkodecari('minta_cari', 'M'),
			'nm_cari' 		=> $this->input->post('nm_cari'),
			'alm_cari' 		=> $this->input->post('alm_cari'),
			'tgl_cari' 		=> date("Y-m-d H:i:s"),	
			'desk_minta' 	=> $this->input->post('desk_minta'),
			'kd_ptg' 		=> $this->input->post('kd_ptg')
		);
		return $this->db->insert('minta_cari', $data);
	}
	public function update_minta_cari(){
		$kd_cari = $this->uri->segment(3);
		$data = array(
			'nm_cari' 		=> $this->input->post('nm_cari'),
			'alm_cari'		=> $this->input->post('alm_cari'),
			'tgl_cari' 		=> date("Y-m-d H:i:s"),
			'desk_minta' 	=> $this->input->post('desk_minta'),
			'kd_ptg' 		=> $this->input->post('kd_ptg')
		);
		$this->db->where('kd_cari', $kd_cari);
		return $this->db->update('minta_cari', $data);
	}
	public function delete_minta_cari(){
		$kd_cari = $this->uri->segment(3);
		return $this->db->delete('minta_cari', array('kd_cari' => $kd_cari));
	}

	public function get_petugas($kd_ptg = FALSE){
		if($kd_ptg == FALSE){
			$this->db->select('*');
			$this->db->from('petugas');
			$this->db->join('bangsal', 'bangsal.kd_bgs = petugas.kd_bgs');
			$query = $this->db->get();
			return $query->result_array();
		}
		$query = $this->db->get_where('petugas', array('kd_ptg' => $kd_ptg));
		return $query->row_array();
	}
}
?>