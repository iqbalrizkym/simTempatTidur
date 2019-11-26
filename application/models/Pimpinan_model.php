<?php
class Pimpinan_model extends CI_Model{

	public function __construct(){
		$this->load->database();
		$this->load->library('session');
		$this->load->helper('url_helper');
		if ($this->session->userdata('level')!="Pimpinan"){
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
		$sql = array('bangsal.kd_bgs', 'bangsal.nm_bgs',
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
	// laporan LOS, BTO, TOI, BOR, Barber Johnson
	public function get_btbl1(){
		$select = array('bangsal.nm_bgs', 'bangsal.kd_bgs', 'count(*) as a'); 
		$this->db->select($select);
		$this->db->from('tmp_tdr');
		$this->db->join('bangsal', 'bangsal.kd_bgs = tmp_tdr.kd_bgs');
		$this->db->group_by('bangsal.kd_bgs');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_btbl2(){
		$bulan = date("m",strtotime($this->input->post('bulan')));
		$tahun = date("Y",strtotime($this->input->post('bulan')));
		$select = array('guna_tt.kd_gn', 'bangsal.nm_bgs', 'bangsal.kd_bgs', 'guna_tt.tgl_msk', 'DATEDIFF(guna_tt.tgl_klr, guna_tt.tgl_msk) AS hp'); 
		$this->db->select($select);
		$this->db->from('guna_tt');
		$this->db->join('tmp_tdr', 'tmp_tdr.kd_tt = guna_tt.kd_tt', 'left');
		$this->db->join('bangsal', 'bangsal.kd_bgs = tmp_tdr.kd_bgs', 'left');
		$this->db->where('MONTH(guna_tt.tgl_msk)', $bulan);
		$this->db->where('YEAR(guna_tt.tgl_msk)', $tahun);
		$this->db->where('guna_tt.status_ttguna !=', 'Cancel');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_btbl3(){
		$bulan = date("m",strtotime($this->input->post('bulan')));
		$tahun = date("Y",strtotime($this->input->post('bulan')));
		$select = array('guna_tt.kd_gn', 'bangsal.nm_bgs', 'bangsal.kd_bgs', 'guna_tt.tgl_msk', 'count(kd_gn) AS d'); 
		$this->db->select($select);
		$this->db->from('guna_tt');
		$this->db->join('tmp_tdr', 'tmp_tdr.kd_tt = guna_tt.kd_tt', 'left');
		$this->db->join('bangsal', 'bangsal.kd_bgs = tmp_tdr.kd_bgs', 'left');
		$this->db->where('MONTH(guna_tt.tgl_klr)', $bulan);
		$this->db->where('YEAR(guna_tt.tgl_klr)', $tahun);
		$this->db->where('guna_tt.status_ttguna =', 'Off');
		$this->db->group_by('kd_gn');
		$query = $this->db->get();
		return $query->result_array();
	}
	// laporan minta cari
	public function get_minta_cari(){
		if (isset($_POST['search'])) {
			$tgl1 = $this->input->post('tgl1');
			$tgl2 = $this->input->post('tgl2');
			$this->load->helper('url');
			$this->db->select('*');
			$this->db->from('minta_cari');
			$this->db->join('petugas', 'minta_cari.kd_ptg = petugas.kd_ptg');
			$this->db->where('tgl_cari >=', $tgl1);
			$this->db->where('tgl_cari <=', $tgl2);
			$result = $this->db->get();
			return $result->result_array();
		}
	}
	// penggunaan tempat tidur
	public function get_kosong(){
		$select = array('bangsal.nm_bgs', 'bangsal.kd_bgs', 'count(*) as tmp_tdr1'); 
		$this->db->select($select);
		$this->db->from('tmp_tdr');
		$this->db->join('bangsal', 'bangsal.kd_bgs = tmp_tdr.kd_bgs');
		$this->db->group_by('bangsal.kd_bgs');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_digunakan(){
		$tgl = $this->input->post('tgl');
		$select = array('bangsal.nm_bgs', 'bangsal.kd_bgs', 'count(*) as tmp_tdr2'); 
		$this->db->select($select);
		$this->db->from('guna_tt');
		$this->db->join('tmp_tdr', 'tmp_tdr.kd_tt = guna_tt.kd_tt');
		$this->db->join('bangsal', 'bangsal.kd_bgs = tmp_tdr.kd_bgs');
		$this->db->where('tgl_klr >=', $tgl);
		$this->db->where('tgl_msk <=', $tgl);
		$this->db->group_by('bangsal.kd_bgs');
		$result = $this->db->get();
		return $result->result_array();
	}

}
?>