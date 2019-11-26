<?php
class Pengunjung_model extends CI_Model{

	public function __construct(){
		$this->load->database();
		$this->load->helper('url_helper');
	}

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
}
?>