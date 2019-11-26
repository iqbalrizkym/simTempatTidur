<?php
class Prm_model extends CI_Model{

	public function __construct(){
		$this->load->database();
		$this->load->library('session');
		$this->load->helper('url_helper');
		
		if($this->session->userdata('level')!="Petugas Rekam Medik"){
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
	// sensus
	public function get_masuk(){
		// $kd_bgs = $this->input->post('kd_bgs');
		$bulan = date("m",strtotime($this->input->post('bulan')));
		$tahun = date("Y",strtotime($this->input->post('bulan')));
		$bulan1 = strtotime("$tahun-$bulan-01");
		$bulanfix = date("Y-m-d",$bulan1);
		$sql = "SELECT cal.my_date AS date_field,
				COUNT(IF(jns_msk='Baru', 1, NULL)) as Baru, 
				COUNT(IF(jns_msk='Transfer', 1, NULL)) as Transfer 
				FROM ( 
					SELECT s.start_date + INTERVAL (days.d) DAY AS my_date 
					FROM ( 
						SELECT LAST_DAY('$bulanfix') + INTERVAL 1 DAY - INTERVAL 1 MONTH AS start_date, 
							LAST_DAY('$bulanfix') AS end_date 
						 ) AS s 
							JOIN days ON days.d <= DATEDIFF(s.end_date, s.start_date) 
					  ) AS cal 
				LEFT JOIN guna_tt AS t ON t.tgl_msk >= cal.my_date AND t.tgl_msk < cal.my_date + INTERVAL 1 DAY 
				LEFT JOIN tmp_tdr ON tmp_tdr.kd_tt = t.kd_tt
				
				GROUP BY cal.my_date";
			$result = $this->db->query($sql);
		return $result->result_array(); 
	}
	public function get_keluar(){
		// $kd_bgs = $this->input->post('kd_bgs');
		$bulan = date("m",strtotime($this->input->post('bulan')));
		$tahun = date("Y",strtotime($this->input->post('bulan')));
		$bulan1 = strtotime("$tahun-$bulan-01");
		$bulanfix = date("Y-m-d",$bulan1);
		$sql = "SELECT cal.my_date AS date_field, 
				COUNT(IF(jns_klr='Dipindahkan', 1, NULL)) as Pindah, 
				COUNT(IF(jns_klr='Pulang Hidup', 1, NULL)) as Pulang, 
				COUNT(IF(jns_klr='Pulang Atas Permintaan Sendiri', 1, NULL)) as Sendiri, 
				COUNT(IF(jns_klr='Keluar Melarikan Diri', 1, NULL)) as Lari, 
				COUNT(IF(jns_klr='Keluar Dirujuk', 1, NULL)) as Rujuk,
				COUNT(IF(jns_klr='Meninggal < 48 Jam', 1, NULL)) as Kurang, 
				COUNT(IF(jns_klr='Meninggal > 48 Jam', 1, NULL)) as Lebih,
				SUM(COALESCE(DATEDIFF(tgl_klr, tgl_msk), 0)) as Hp
				FROM ( 
					SELECT s.start_date + INTERVAL (days.d) DAY AS my_date 
					FROM ( 
						SELECT LAST_DAY('$bulanfix') + INTERVAL 1 DAY - INTERVAL 1 MONTH AS start_date, 
							LAST_DAY('$bulanfix') AS end_date ) AS s 
							JOIN days ON days.d <= DATEDIFF(s.end_date, s.start_date
						  ) 
					  ) AS cal 
				LEFT JOIN guna_tt AS t ON t.tgl_klr >= cal.my_date AND t.tgl_klr < cal.my_date + INTERVAL 1 DAY 
				LEFT JOIN tmp_tdr ON tmp_tdr.kd_tt = t.kd_tt

				GROUP BY cal.my_date";
			$result = $this->db->query($sql);
		return $result->result_array(); 
	}
	public function get_inout(){
		// $kd_bgs = $this->input->post('kd_bgs');
		$bulan = date("m",strtotime($this->input->post('bulan')));
		$tahun = date("Y",strtotime($this->input->post('bulan')));
		$bulan1 = strtotime("$tahun-$bulan-01");
		$bulanfix = date("Y-m-d",$bulan1);
		$sql = "SELECT cal.my_date AS date_field,
				COUNT(kd_gn) AS pinout
				FROM ( 
					SELECT s.start_date + INTERVAL (days.d) DAY AS my_date 
					FROM ( 
						SELECT LAST_DAY('$bulanfix') + INTERVAL 1 DAY - INTERVAL 1 MONTH AS start_date, 
							LAST_DAY('$bulanfix') AS end_date ) AS s 
							JOIN days ON days.d <= DATEDIFF(s.end_date, s.start_date
						  ) 
					  ) AS cal 
				LEFT JOIN guna_tt AS t ON t.tgl_msk >= cal.my_date AND t.tgl_klr < cal.my_date + INTERVAL 1 DAY 
				LEFT JOIN tmp_tdr ON tmp_tdr.kd_tt = t.kd_tt

				GROUP BY cal.my_date";
			$result = $this->db->query($sql);
		return $result->result_array(); 
	}
	public function get_awal(){
		// $kd_bgs = $this->input->post('kd_bgs');
		$bulan = date("m",strtotime($this->input->post('bulan')));
		$tahun = date("Y",strtotime($this->input->post('bulan')));
		$bulan1 = strtotime("$tahun-$bulan-01");
		$bulanfix = date("Y-m-d",$bulan1);
		$sql = "SELECT cal.my_date AS date_field,
				COUNT(kd_gn) as Awaltt
				FROM ( 
					SELECT s.start_date + INTERVAL (days.d) DAY AS my_date 
					FROM ( 
						SELECT LAST_DAY('$bulanfix') + INTERVAL 1 DAY - INTERVAL 1 MONTH AS start_date, 
							LAST_DAY('$bulanfix') AS end_date ) AS s 
							JOIN days ON days.d <= DATEDIFF(s.end_date, s.start_date
						  ) 
					  ) AS cal 
				LEFT JOIN guna_tt AS t ON t.tgl_klr >= cal.my_date AND t.tgl_msk < cal.my_date + INTERVAL 1 DAY 
				LEFT JOIN tmp_tdr ON tmp_tdr.kd_tt = t.kd_tt
				
				GROUP BY cal.my_date";
			$result = $this->db->query($sql);
		return $result->result_array(); 
	}
	// where tmp_tdr.kd_bgs = '$kd_bgs' is null or tmp_tdr.kd_bgs = '$kd_bgs'
	
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

	// bangsal
	public function get_bangsal($kd_bgs = FALSE){
		if($kd_bgs == FALSE){
			$query = $this->db->get('bangsal');
			return $query->result_array();
		}
		$query = $this->db->get_where('bangsal', array('kd_bgs' => $kd_bgs));
		return $query->row_array();
	}
	public function set_bangsal(){
		$data = array(
			'kd_bgs' 	=> $this->input->post('kd_bgs'),
			'nm_bgs' 	=> $this->input->post('nm_bgs'),
			'alokasi' 	=> $this->input->post('alokasi')
		);
		return $this->db->insert('bangsal', $data);
	}
	public function update_bangsal(){
		$kd_bgs = $this->uri->segment(3);
		$data = array(
			'kd_bgs' 	=> $this->input->post('kd_bgs'),
			'nm_bgs' 	=> $this->input->post('nm_bgs'),
			'alokasi' 	=> $this->input->post('alokasi')
		);
		$this->db->where('kd_bgs', $kd_bgs);
		return $this->db->update('bangsal', $data);
	}
	public function delete_bangsal($kd_bgs){
		$kd_bgs = $this->uri->segment(3);
		return $this->db->delete('bangsal', array('kd_bgs' => $kd_bgs));
	}

	// dokter
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
	public function buatkodedkt($tabel,$inisial){
		$con = mysqli_connect("localhost","root","","rs");
		$struktur = mysqli_query($con, "SELECT * from dokter");
		$fieldInfo = mysqli_fetch_field_direct($struktur,0);
		$field = $fieldInfo->name;
		$panjang =8;
		$qry = mysqli_query($con,"SELECT MAX(kd_dkt) FROM dokter");
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
	public function set_dokter(){
		$data = array(
			'kd_dkt'	=> $this->buatkodedkt('dokter', 'D'),
			'nm_dkt' 	=> $this->input->post('nm_dkt'),
			'keahlian' 	=> $this->input->post('keahlian'),
			'kd_bgs' 	=> $this->input->post('kd_bgs')				
		);
		return $this->db->insert('dokter', $data);
	}
	public function update_dokter(){
		$kd_dkt = $this->uri->segment(3);
		$data = array(
			'kd_dkt' 	=> $this->input->post('kd_dkt'),
			'nm_dkt' 	=> $this->input->post('nm_dkt'),
			'keahlian' 	=> $this->input->post('keahlian'),
			'kd_bgs' 	=> $this->input->post('kd_bgs')
		);
		$this->db->where('kd_dkt', $kd_dkt);
		return $this->db->update('dokter', $data);
	}
	public function delete_dokter($kd_dkt){
		$kd_dkt = $this->uri->segment(3);
		return $this->db->delete('dokter', array('kd_dkt' => $kd_dkt));
	}

	// kelas
	public function get_kelas($kd_kls = FALSE){
		if($kd_kls == FALSE){
			$query = $this->db->get('kelas');
			return $query->result_array();
		}
		$query = $this->db->get_where('kelas', array('kd_kls' => $kd_kls));
		return $query->row_array();
	}
	public function set_kelas(){
		$data = array(
			'kd_kls' 	=> $this->input->post('kd_kls'),
			'nm_kls' 	=> $this->input->post('nm_kls'),
			'fasilitas' => $this->input->post('fasilitas')
		);
		return $this->db->insert('kelas', $data);
	}

	public function update_kelas($kd_kls){
		$kd_kls = $this->uri->segment(3);
		$data = array(
			'kd_kls' 	=> $this->input->post('kd_kls'),
			'nm_kls' 	=> $this->input->post('nm_kls'),
			'fasilitas' => $this->input->post('fasilitas')
		);
		$this->db->where('kd_kls', $kd_kls);
		return $this->db->update('kelas', $data);
	}

	public function delete_kelas($kd_kls){
		$kd_kls = $this->uri->segment(3);
		return $this->db->delete('kelas', array('kd_kls' => $kd_kls));
	}

	//pasien
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
	public function buatkodepsn($tabel,$inisial){
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
	public function set_pasien(){
		$data = array(
			'kd_rm' 		=> $this->buatkodepsn('pasien', 'RM'),
			'nm_psn' 		=> $this->input->post('nm_psn'),
			'alm_psn' 		=> $this->input->post('alm_psn'),
			'tgl_lahir' 	=> $this->input->post('tgl_lahir'),
			'jns_psn' 		=> $this->input->post('jns_psn'),
			'status_psn' 	=> 'Out',
			'tgl_daftar' 	=> date("Y-m-d H:i:s")
		);
		return $this->db->insert('pasien', $data);
	}
	public function update_pasien(){
		$kd_rm = $this->uri->segment(3);
		$this->load->helper('url');
		$data = array(
			'kd_rm' 		=> $this->input->post('kd_rm'),
			'nm_psn' 		=> $this->input->post('nm_psn'),
			'alm_psn' 		=> $this->input->post('alm_psn'),
			'tgl_lahir' 	=> $this->input->post('tgl_lahir'),
			'jns_psn' 		=> $this->input->post('jns_psn')
		);
		$this->db->where('kd_rm', $kd_rm);
		return $this->db->update('pasien', $data);
	}

	public function delete_pasien(){
		$kd_rm = $this->uri->segment(3);
		return $this->db->delete('pasien', array('kd_rm' => $kd_rm));
	}

	// penyakit
	public function get_penyakit($kd_pyk = FALSE){
		if($kd_pyk == FALSE){
			$query = $this->db->get('penyakit');
			return $query->result_array();
		}
		$query = $this->db->get_where('penyakit', array('kd_pyk' => $kd_pyk));
		return $query->row_array();
	}
	public function set_penyakit(){
		$data = array(
			'kd_pyk' 	=> $this->input->post('kd_pyk'),
			'nm_pyk' 	=> $this->input->post('nm_pyk'),
			'desk_pyk' 	=> $this->input->post('desk_pyk')
		);
		return $this->db->insert('penyakit', $data);
	}
	public function update_penyakit(){
		$kd_pyk = $this->uri->segment(3);
		$data = array(
			'kd_pyk' 	=> $this->input->post('kd_pyk'),
			'nm_pyk' 	=> $this->input->post('nm_pyk'),
			'desk_pyk' 	=> $this->input->post('desk_pyk')
		);
		$this->db->where('kd_pyk', $kd_pyk);
		return $this->db->update('penyakit', $data);
	}
	public function delete_penyakit(){
		$kd_pyk = $this->uri->segment(3);
		return $this->db->delete('penyakit', array('kd_pyk' => $kd_pyk));
	}

	// petugas
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
	public function buatkodeptg($tabel,$inisial){
		$con = mysqli_connect("localhost","root","","rs");
		$struktur = mysqli_query($con, "SELECT * from petugas");
		$fieldInfo = mysqli_fetch_field_direct($struktur,0);
		$field = $fieldInfo->name;
		$panjang =8;
		$qry = mysqli_query($con,"SELECT MAX(kd_ptg) FROM petugas");
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
	public function set_petugas(){
		$data = array(
			'kd_ptg' 	=> $this->buatkodeptg('petugas', 'P'),
			'nm_ptg' 	=> $this->input->post('nm_ptg'),
			'jns_ptg' 	=> $this->input->post('jns_ptg'),
			'kd_bgs' 	=> $this->input->post('kd_bgs')				
		);
		return $this->db->insert('petugas', $data);
	}
	public function update_petugas(){
		$kd_ptg = $this->uri->segment(3);
		$data = array(
			'kd_ptg' 	=> $this->input->post('kd_ptg'),
			'nm_ptg' 	=> $this->input->post('nm_ptg'),
			'jns_ptg' 	=> $this->input->post('jns_ptg'),
			'kd_bgs' 	=> $this->input->post('kd_bgs')
		);
		$this->db->where('kd_ptg', $kd_ptg);
		return $this->db->update('petugas', $data);
	}
	public function delete_petugas(){
		$kd_ptg = $this->uri->segment(3);
		return $this->db->delete('petugas', array('kd_ptg' => $kd_ptg));
	}

	// tempat tidur
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
	public function buatkodetmp($tabel,$inisial){
		$con = mysqli_connect("localhost","root","","rs");
		$struktur = mysqli_query($con, "SELECT * from tmp_tdr");
		$fieldInfo = mysqli_fetch_field_direct($struktur,0);
		$field = $fieldInfo->name;
		$panjang =8;
		$qry = mysqli_query($con,"SELECT MAX(kd_tt) FROM tmp_tdr");
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
	public function set_tmp_tdr(){
		$data = array(
			'kd_tt' 	=> $this->buatkodetmp('tmp_tdr', 'TT'),
			'nm_tt' 	=> $this->input->post('nm_tt'),
			'status_tt' => $this->input->post('status_tt'),
			'kd_bgs' 	=> $this->input->post('kd_bgs'),
			'status_tt' => $this->input->post('status_tt'),
			'kd_kls' 	=> $this->input->post('kd_kls')
		);
		return $this->db->insert('tmp_tdr', $data);
	}
	public function update_tmp_tdr($kd_tt){
		$kd_tt = $this->uri->segment(3);
		$data = array(
			'kd_tt' 	=> $this->input->post('kd_tt'),
			'nm_tt' 	=> $this->input->post('nm_tt'),
			'status_tt' => $this->input->post('status_tt'),
			'kd_bgs' 	=> $this->input->post('kd_bgs'),
			'status_tt' => $this->input->post('status_tt'),
			'kd_kls' 	=> $this->input->post('kd_kls')
		);
		$this->db->where('kd_tt', $kd_tt);
		return $this->db->update('tmp_tdr', $data);
	}
	public function delete_tmp_tdr($kd_tt){
		$kd_tt = $this->uri->segment(3);
		return $this->db->delete('tmp_tdr', array('kd_tt' => $kd_tt));
	}

	// aktor
	public function get_aktor ($kd_akt = FALSE){
		if($kd_akt == FALSE){
			$query = $this->db->get('aktor');
			return $query->result_array();
		}
		$query = $this->db->get_where('aktor', array('kd_akt' => $kd_akt));
		return $query->row_array();
	}
	public function buatkodeakt($tabel,$inisial){
		$con = mysqli_connect("localhost","root","","rs");
		$struktur = mysqli_query($con, "SELECT * from aktor");
		$fieldInfo = mysqli_fetch_field_direct($struktur,0);
		$field = $fieldInfo->name;
		$panjang =8;
		$qry = mysqli_query($con,"SELECT MAX(kd_akt) FROM aktor");
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
	public function set_aktor(){
		$data = array(
			'kd_akt' 	=> $this->buatkodeakt('aktor', 'A'),
			'nm_akt' 	=> $this->input->post('nm_akt'),
			'username' 	=> $this->input->post('username'),
			'password' 	=> $this->input->post('password'),
			'level' 	=> $this->input->post('level')
		);
		return $this->db->insert('aktor', $data);
	}

	public function update_aktor($kd_akt){
		$kd_akt = $this->uri->segment(3);
		$data = array(
			'kd_akt' 	=> $this->input->post('kd_akt'),
			'nm_akt' 	=> $this->input->post('nm_akt'),
			'username' 	=> $this->input->post('username'),
			'password' 	=> $this->input->post('password'),
			'level' 	=> $this->input->post('level')
		);
		$this->db->where('kd_akt', $kd_akt);
		return $this->db->update('aktor', $data);
	}

	public function delete_aktor($kd_akt){
		return $this->db->delete('aktor', array('kd_akt' => $kd_akt));
	}
}
?>