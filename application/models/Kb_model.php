<?php
class Kb_model extends CI_Model{
	
	public function __construct(){
		$this->load->database();
		$this->load->library('session');
		$this->load->helper('url_helper');

		if($this->session->userdata('level')!="Kepala Bangsal"){
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

	// status - dashboard
	public function get_status(){
		$sql = array('bangsal.kd_bgs', 'bangsal.nm_bgs',
			'COUNT(IF(status_tt="kosong", 1, NULL)) "Kosong"',
			'COUNT(IF(status_tt="Disiapkan", 1, NULL)) "Disiapkan"',
			'COUNT(IF(status_tt="Direncanakan", 1, NULL)) "Direncanakan"',
			'COUNT(IF(status_tt="Diminta", 1, NULL)) "Diminta"',
			'COUNT(IF(status_tt="Dipesan", 1, NULL)) "Dipesan"',
			'COUNT(IF(status_tt="Disiapkan (Pesan)", 1, NULL)) "Disisan"',
			'COUNT(IF(status_tt="Dipakai", 1, NULL)) "Dipakai"',
			'COUNT(IF(status_tt="Rusak", 1, NULL)) "Rusak"');
		$this->db->select($sql);
		$this->db->from('bangsal');
		$this->db->join('tmp_tdr', 'tmp_tdr.kd_bgs = bangsal.kd_bgs');
		$this->db->group_by('bangsal.kd_bgs');
		$result = $this->db->get();
		return $result->result_array();
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
		$this->db->join('bangsal', 'bangsal.kd_bgs = tmp_tdr.kd_bgs', 'left');
		$this->db->join('kelas', 'kelas.kd_kls = tmp_tdr.kd_kls', 'left');
		$this->db->group_by('tmp_tdr.kd_tt');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_tt_kosong($where){
		$this->db->select('*');
		$this->db->from('tmp_tdr');
		$this->db->join('bangsal', 'bangsal.kd_bgs = tmp_tdr.kd_bgs', 'left');
		$this->db->join('kelas', 'kelas.kd_kls = tmp_tdr.kd_kls', 'left');
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

	// form ganti status tt dipakai -> direncanakan
	public function get_data_dipakai($where){
		$this->db->select('*');
		$this->db->from('guna_tt');
		$this->db->join('tmp_tdr', 'tmp_tdr.kd_tt = guna_tt.kd_tt', 'left');
		$this->db->join('kelas', 'tmp_tdr.kd_kls = kelas.kd_kls', 'left');
		$this->db->join('pasien', 'pasien.kd_rm = guna_tt.kd_rm', 'left');
		$this->db->join('detail_diagnosa', 'detail_diagnosa.kd_gn = guna_tt.kd_gn', 'left');
		$this->db->join('penyakit', 'detail_diagnosa.diagnosa = penyakit.kd_pyk', 'left');
		$this->db->where($where);
		$result = $this->db->get();
		return $result->result_array();
	}
	public function update_guna_tt_dipakai_direncanakan(){
		$kd_gn = $this->uri->segment(4);
		$data_ubah_gunatt = array(
			'tgl_klr' 		=> date("Y-m-d H:i:s"),
			'tgjwb_gn' 		=> $this->input->post('tgjwb_gn'),
			'jns_klr' 		=> $this->input->post('jns_klr'),
			'kd_ptg' 		=> $this->input->post('kd_ptg'),
			'status_ttguna'	=> 'Off',
			'kd_dkt' 		=> $this->input->post('kd_dkt')
		);
		$this->db->where('kd_gn', $kd_gn);
		return $this->db->update('guna_tt', $data_ubah_gunatt);
	}
	public function update_diagnosa_dipakai_direncanakan(){
		$kd_gn = $this->uri->segment(4);
		$data_ubah_diagnosa = array(
			'diagnosa1' 	=> $this->input->post('diagnosa1'),
			'diagnosa2' 	=> $this->input->post('diagnosa2'),
			'diagnosa3' 	=> $this->input->post('diagnosa3'),
			'diagnosa4' 	=> $this->input->post('diagnosa4')
		);
		$this->db->where('kd_gn', $kd_gn);
		return $this->db->update('detail_diagnosa', $data_ubah_diagnosa);
	}	
	public function update_tt_dipakai_direncanakan(){
		$kd_tt = $this->uri->segment(3);
		$data_ubah_status = array (
			'status_tt' => 'Direncanakan'
		);
		$this->db->where('kd_tt', $kd_tt);
		return $this->db->update('tmp_tdr', $data_ubah_status);
	}	
	public function update_psn_dipakai_direncanakan(){
		$kd_rm = $this->uri->segment(5);
		$data_ubah_status_psn = array (
			'status_psn' => 'Out'
		);
		$this->db->where('kd_rm', $kd_rm);
		return $this->db->update('pasien', $data_ubah_status_psn);
	}
	public function get_petugas($kd_ptg = FALSE){
		if($kd_ptg == FALSE){
			$this->db->select('*');
			$this->db->from('petugas');
			$this->db->join('bangsal', 'bangsal.kd_bgs = petugas.kd_bgs', 'left');
			$query = $this->db->get();
			return $query->result_array();
		}
		$query = $this->db->get_where('petugas', array('kd_ptg' => $kd_ptg));
		return $query->row_array();
	}

	// form ganti status tt rusak -> kosong
	public function get_data_tt_rusak($where){
		$this->db->select('*');
		$this->db->from('tmp_tdr');
		$this->db->join('kelas', 'tmp_tdr.kd_kls = kelas.kd_kls', 'left');
		$this->db->where($where);
		$result = $this->db->get();
		return $result->result_array();
	}	
	public function update_tt_rusak_kosong(){
		$kd_tt = $this->uri->segment(3);
		$data_ubah_status_kosong = array (
			'status_tt' => 'Kosong'
		);
		$this->db->where('kd_tt', $kd_tt);
		return $this->db->update('tmp_tdr', $data_ubah_status_kosong);
	}

	// form ganti status tt kosong -> rusak
	public function get_data_tt_kosong($where){
		$this->db->select('*');
		$this->db->from('tmp_tdr');
		$this->db->join('kelas', 'tmp_tdr.kd_kls = kelas.kd_kls', 'left');
		$this->db->where($where);
		$result = $this->db->get();
		return $result->result_array();
	}	
	public function update_tt_kosong_rusak(){
		$kd_tt = $this->uri->segment(3);
		$data_ubah_status_rusak = array (
			'status_tt' => 'Rusak'
		);
		$this->db->where('kd_tt', $kd_tt);
		return $this->db->update('tmp_tdr', $data_ubah_status_rusak);
	}

	// form ganti status tt diminta -> dipakai / kosong
	public function get_data_tt_diminta($where){
		$this->db->select('*');
		$this->db->from('guna_tt');
		$this->db->join('tmp_tdr', 'tmp_tdr.kd_tt = guna_tt.kd_tt', 'left');
		$this->db->join('kelas', 'tmp_tdr.kd_kls = kelas.kd_kls', 'left');
		$this->db->join('pasien', 'pasien.kd_rm = guna_tt.kd_rm', 'left');
		$this->db->join('detail_diagnosa', 'detail_diagnosa.kd_gn = guna_tt.kd_gn', 'left');
		$this->db->join('penyakit', 'detail_diagnosa.diagnosa = penyakit.kd_pyk', 'left');
		$this->db->where($where);
		$result = $this->db->get();
		return $result->result_array();
	}	
	public function update_tt_diminta_dipakai(){
		$kd_tt = $this->uri->segment(3);
		$data_ubah_status_dipakai = array (
			'status_tt' => 'Dipakai'
		);
		$this->db->where('kd_tt', $kd_tt);
		return $this->db->update('tmp_tdr', $data_ubah_status_dipakai);
	}	
	public function update_guna_tt_diminta_dipakai(){
		$kd_gn =  $this->uri->segment(4);
		$data_ubah_gunatt = array(
			'tgl_msk' 		=> date("Y-m-d H:i:s")
		);
		$this->db->where('kd_gn', $kd_gn);
		return $this->db->update('guna_tt', $data_ubah_gunatt);
	}
	public function update_tt_diminta_kosong(){
		$kd_tt = $this->uri->segment(3);
		$data_ubah_status_dipakai = array (
			'status_tt' => 'Kosong'
		);
		$this->db->where('kd_tt', $kd_tt);
		return $this->db->update('tmp_tdr', $data_ubah_status_dipakai);
	}
	public function update_guna_tt_diminta_kosong(){
		$kd_gn =  $this->uri->segment(4);
		$data_ubah_gunatt = array(
			'status_ttguna'	=> 'Cancel'			
		);
		$this->db->where('kd_gn', $kd_gn);
		return $this->db->update('guna_tt', $data_ubah_gunatt);
	}	
	public function update_psn_diminta_kosong(){
		$kd_rm = $this->uri->segment(5);
		$data_ubah_status_psn = array (
			'status_psn' => 'Out'
		);
		$this->db->where('kd_rm', $kd_rm);
		return $this->db->update('pasien', $data_ubah_status_psn);
	}

	// form ganti status tt direncanakan -> dipesan/ disiapkan
	public function get_data_tt_direncanakan($where){
		$this->db->select('*');
		$this->db->from('tmp_tdr');
		$this->db->join('kelas', 'tmp_tdr.kd_kls = kelas.kd_kls');
		$this->db->where($where);
		$result = $this->db->get();
		return $result->result_array();
	}
	public function update_tt_direncanakan_disiapkan(){
		$kd_tt = $this->uri->segment(3);
		$data_ubah_tt = array (
			'status_tt' => 'Disiapkan'
		);
		$this->db->where('kd_tt', $kd_tt);
		return $this->db->update('tmp_tdr', $data_ubah_tt);
	}
	public function set_tt_direncanakan_dipesan(){
		$data_gntt = array(
			'kd_gn' 		=> $this->input->post('kd_gn'),
			'kd_tt' 		=> $this->input->post('kd_tt'),
			'kd_rm' 		=> $this->input->post('kd_rm'),
			'jns_msk'		=> $this->input->post('jns_msk'),
			'status_ttguna'	=> 'On'
		);
		return $this->db->insert('guna_tt', $data_gntt);
	}
	public function set_diagnosa_direncanakan_dipesan(){
		$data_dgns = array(
			'kd_gn' 		=> $this->input->post('kd_gn'),
			'diagnosa' 		=> $this->input->post('diagnosa')
		);
		return $this->db->insert('detail_diagnosa', $data_dgns);
	}
	public function update_tt_direncanakan_dipesan(){
		$kd_tt = $this->input->post('kd_tt');
		$data_ubah_tt = array (
			'status_tt' => 'Dipesan'
		);
		$this->db->where('kd_tt', $kd_tt);
		return $this->db->update('tmp_tdr', $data_ubah_tt);
	}
	public function update_psn_direncanakan_dipesan(){
		$kd_rm = $this->input->post('kd_rm');
		$data_ubah_psn = array (
			'status_psn' => 'In'
		);
		$this->db->where('kd_rm', $kd_rm);
		return $this->db->update('pasien', $data_ubah_psn);
	}
	// form ganti status tt dipesan -> disiapkan (pesan)
	public function get_data_tt_dipesan($where){
		$this->db->select('*');
		$this->db->from('guna_tt');
		$this->db->join('tmp_tdr', 'tmp_tdr.kd_tt = guna_tt.kd_tt');
		$this->db->join('kelas', 'tmp_tdr.kd_kls = kelas.kd_kls');
		$this->db->join('pasien', 'pasien.kd_rm = guna_tt.kd_rm');
		$this->db->join('detail_diagnosa', 'detail_diagnosa.kd_gn = guna_tt.kd_gn');
		$this->db->join('penyakit', 'detail_diagnosa.diagnosa = penyakit.kd_pyk');
		$this->db->where($where);
		$result = $this->db->get();
		return $result->result_array();
	}
	public function update_tt_dipesan_disiapkanpesan(){
		$kd_tt = $this->uri->segment(3);
		$data_ubah_status_dipakai = array (
			'status_tt' => 'Disiapkan (Pesan)'
		);
		$this->db->where('kd_tt', $kd_tt);
		return $this->db->update('tmp_tdr', $data_ubah_status_dipakai);
	}
	// form ganti status tt disiapkan (pesan) -> dipakai
	public function get_data_tt_disiapkanpesan($where){
		$this->db->select('*');
		$this->db->from('guna_tt');
		$this->db->join('tmp_tdr', 'tmp_tdr.kd_tt = guna_tt.kd_tt');
		$this->db->join('kelas', 'tmp_tdr.kd_kls = kelas.kd_kls');
		$this->db->join('pasien', 'pasien.kd_rm = guna_tt.kd_rm');
		$this->db->join('detail_diagnosa', 'detail_diagnosa.kd_gn = guna_tt.kd_gn');
		$this->db->join('penyakit', 'detail_diagnosa.diagnosa = penyakit.kd_pyk');
		$this->db->where($where);
		$result = $this->db->get();
		return $result->result_array();
	}
	public function update_tt_disiapkanpesan_dipakai(){
		$kd_tt = $this->uri->segment(3);
		$data_ubah_status_dipakai = array (
			'status_tt' => 'Dipakai'
		);
		$this->db->where('kd_tt', $kd_tt);
		return $this->db->update('tmp_tdr', $data_ubah_status_dipakai);
	}
	public function update_guna_tt_disiapkanpesan_dipakai(){
		$kd_gn =  $this->uri->segment(4);
		$data_ubah_gunatt = array(
			'tgl_msk' 		=> date("Y-m-d H:i:s")
		);
		$this->db->where('kd_gn', $kd_gn);
		return $this->db->update('guna_tt', $data_ubah_gunatt);
	}
	// form ganti status tt disiapkan -> kosong
	public function get_data_tt_disiapkan($where){
		$this->db->select('*');
		$this->db->from('tmp_tdr');
		$this->db->join('kelas', 'tmp_tdr.kd_kls = kelas.kd_kls');
		$this->db->where($where);
		$result = $this->db->get();
		return $result->result_array();
	}	
	public function update_tt_disiapkan_kosong(){
		$kd_tt = $this->uri->segment(3);
		$data_ubah_status_kosong = array (
			'status_tt' => 'Kosong'
		);
		$this->db->where('kd_tt', $kd_tt);
		return $this->db->update('tmp_tdr', $data_ubah_status_kosong);
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
	public function get_aktor ($kd_akt = FALSE){
		if($kd_akt == FALSE){
			$query = $this->db->get('aktor');
			return $query->result_array();
		}
		$query = $this->db->get_where('aktor', array('kd_akt' => $kd_akt));
		return $query->row_array();
	}
	public function set_gunatt($kd_tt){
		$data = array(
			'kd_gn' 		=> $this->input->post('kd_gn'),
			'kd_tt' 		=> $this->input->post('kd_tt'),
			'kd_kls' 		=> $this->input->post('kd_kls'),
			'kd_rm' 		=> $this->input->post('kd_rm'),
			'jns_psn' 		=> $this->input->post('jns_psn'),
			'status_psn' 	=> $this->input->post('status_psn'),
			'tgl_msk' 		=> $this->input->post('tgl_msk')
		);
		return $this->db->insert('guna_tt', $data);
	}
	Public function get_tmp_tdr($kd_tt){ 
		$this->db->from('tmp_tdr');
		$this->db->where('kd_tt', $kd_tt);
		$query = $this->db->get();
		if($query->num_rows()>0) {
			$data = $query->row_array();
			$value = $data['nm_tt'];
			Return $value;
		} else {
			return false;
		}
	}
	Public function get_kelas($kd_tt){ 
		$this->db->from('tmp_tdr');
		$this->db->join('kelas', 'kelas.kd_kls=tmp_tdr.kd_kls');
		$this->db->where('kd_tt', $kd_tt);
		$query = $this->db->get();
		if($query->num_rows()>0) {
			$data = $query->row_array();
			$value = $data['nm_kls'];
			Return $value;
		} else {
			return false;
		}
	}
	public function get_pasien($kd_rm = FALSE){
		if($kd_rm == FALSE){
			$this->db->select('*');
			$this->db->from('pasien');
			$query = $this->db->get();
			return $query->result_array();
		}
		$query = $this->db->get_where('pasien', array('kd_rm' => $kd_rm));
		return $query->row_array();
	}
	public function get_penyakit($kd_pyk = FALSE){
		if($kd_pyk == FALSE){
			$query = $this->db->get('penyakit');
			return $query->result_array();
		}
		$query = $this->db->get_where('penyakit', array('kd_pyk' => $kd_pyk));
		return $query->row_array();
	}
	public function get_dokter($kd_dkt = FALSE){
		if($kd_dkt == FALSE){
			$this->db->select('*');
			$this->db->from('dokter');
			$this->db->join('bangsal', 'bangsal.kd_bgs = dokter.kd_bgs');
			$query = $this->db->get();
			return $query->result_array();
		}
		$query = $this->db->get_where('dokter', array('kd_dkt' => $kd_dkt));
		return $query->row_array();
	}

	// lappran gunatt
	public function get_gunatt(){
		if (isset($_POST['search'])) {
			$tgl1 = $_POST['tgl1'];
			$tgl2 = $_POST['tgl2'];
			$this->load->helper('url');
			$this->db->select('*','penyakit.nm_pyk');
			$this->db->from('guna_tt');
			$this->db->join('detail_diagnosa', 'guna_tt.kd_gn = detail_diagnosa.kd_gn');
			$this->db->join('penyakit', 'penyakit.kd_pyk = detail_diagnosa.diagnosa');
			$this->db->join('tmp_tdr', 'tmp_tdr.kd_tt = guna_tt.kd_tt');
			$this->db->join('pasien', 'pasien.kd_rm = guna_tt.kd_rm');
			$this->db->where('tgl_msk >=', $tgl1);
			$this->db->where('tgl_msk <=', $tgl2);
			$this->db->where('status_ttguna', 'Off');
			$this->db->order_by('detail_diagnosa.id_dgn');
			$result = $this->db->get();
			return $result->result_array();
		}
	}
	public function get_data_duatabel($tabel1, $tabel2, $penyambung,$where){
		$this->db->select('*');
		$this->db->from($tabel1);
		$this->db->join($tabel2, $penyambung);
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_data($tabel1){
		$this->db->select('*');
		$this->db->from($tabel1);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_data_order_by($tabel1, $order_by){
		$this->db->select('*');
		$this->db->from($tabel1);
		$this->db->order_by($order_by);
		$query = $this->db->get();
		return $query->result_array();
	}
}
?>