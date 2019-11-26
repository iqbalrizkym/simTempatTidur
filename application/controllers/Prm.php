<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prm extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('prm_model');
		$this->load->helper('url_helper');
	}

	public function index_home(){
		$this->load->view('templates/header');    
		$this->load->view('prm/navRekammedik');
		$this->load->view('home');
		$this->load->view('templates/footer');  
	}

	// profil
	public function update_profil(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nm_akt', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == false) {
			$data['aktor'] = $this->prm_model->get_aktor();
			$this->load->view('templates/header');
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/profil/update', $data);
			$this->load->view('templates/footer');
		} else {
			$data = array(
				'nm_akt'    => $this->input->post('nm_akt', TRUE),
				'username'  => $this->input->post('username', TRUE),
				'password'  => $this->input->post('password', TRUE),
			);
			$result = $this->prm_model->update_profil($this->session->userdata('kd_akt'), $data);
			if ($result > 0) {
				$session_data = array(
					'nm_akt'    => $this->input->post('nm_akt', TRUE),
					'username'  => $this->input->post('username', TRUE),
					'password'  => $this->input->post('password', TRUE),
				);
				$this->session->set_userdata($session_data);
				$this->session->set_flashdata('success_msg', 'User Profile Updated');
				return redirect('prm/update_profil');
			} else {
				$this->session->set_flashdata('error_msg', 'User Profile cant Updated');
				return redirect('prm/update_profil');
			}
		}   
	}
	
	public function form_btbl(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('bulan', 'bulan', 'required');
        $this->form_validation->set_rules('jenis', 'jenis', 'required');
        $this->load->view('templates/header');
		$this->load->view('prm/navRekammedik');
		$this->load->view('prm/btbl/form');
		$this->load->view('templates/footer');
    }
    public function index_btbl(){
        $jenis = $this->input->post('jenis');
        $data['btbl1'] = $this->prm_model->get_btbl1();
        $data['btbl2'] = $this->prm_model->get_btbl2();
        $data['btbl3'] = $this->prm_model->get_btbl3();
        if($jenis == "BOR"){
			$this->load->view('templates/header');
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/btbl/bor', $data);
			$this->load->view('templates/footer');
		} elseif ($jenis == "LOS"){
			$this->load->view('templates/header');
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/btbl/los', $data);
			$this->load->view('templates/footer');
		} elseif ($jenis == "TOI"){
			$this->load->view('templates/header');
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/btbl/toi', $data);
			$this->load->view('templates/footer');
		} elseif ($jenis == "BTO"){
			$this->load->view('templates/header');
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/btbl/bto', $data);
			$this->load->view('templates/footer');
		}
    }
	// grafik
	public function form_grafik(){
		$this->load->helper('form');
		$this->load->library('form_validation');
        // $this->form_validation->set_rules('bulan', 'bulan', 'required');
        // $this->form_validation->set_rules('jenis', 'jenis', 'required');
		$this->load->view('templates/header');
		$this->load->view('prm/navRekammedik');
		$this->load->view('prm/grafik/form');
		$this->load->view('templates/footer');
	}
	public function index_grafik(){
		$jenis = $this->input->post('jenis');
		$data['btbl1'] = $this->prm_model->get_btbl1();
		$data['btbl2'] = $this->prm_model->get_btbl2();
		$data['btbl3'] = $this->prm_model->get_btbl3();
		if($jenis == "BOR"){
			$this->load->view('templates/header');
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/grafik/bor', $data);
			$this->load->view('templates/footer');
		} elseif ($jenis == "LOS"){
			$this->load->view('templates/header');
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/grafik/los', $data);
			$this->load->view('templates/footer');
		} elseif ($jenis == "TOI"){
			$this->load->view('templates/header');
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/grafik/toi', $data);
			$this->load->view('templates/footer');
		} elseif ($jenis == "BTO"){
			$this->load->view('templates/header');
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/grafik/bto', $data);
			$this->load->view('templates/footer');
		} elseif ($jenis == "BJ"){
			$this->load->view('templates/header');
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/grafik/bj', $data);
			$this->load->view('templates/footer');
		}
	}
	//sensus
	public function form_sensus(){ 
		$this->load->helper('form');
		$this->load->library('form_validation');
		// $this->form_validation->set_rules('kd_bgs', 'kd_bgs', 'required');
		// $this->form_validation->set_rules('bln', 'bln', 'required');
		$data['bangsal'] = $this->prm_model->get_bangsal();
		$this->load->view('templates/header');
		$this->load->view('prm/navRekammedik');
		$this->load->view('prm/sensus/form', $data);
		$this->load->view('templates/footer');
	}
	public function index_sensus(){
		$data['masuk'] = $this->prm_model->get_masuk();
		$data['keluar'] = $this->prm_model->get_keluar();
		$data['inout'] = $this->prm_model->get_inout();
		$data['awal'] = $this->prm_model->get_awal();
		$this->load->view('templates/header');
		$this->load->view('prm/navRekammedik');
		$this->load->view('prm/sensus/index', $data);
		$this->load->view('templates/footer');
	}

	//status
	public function index_status(){
		$data['count_tt'] = $this->prm_model->get_status();
		$this->load->view('templates/header');
		$this->load->view('prm/navRekammedik');
		$this->load->view('prm/status/index', $data);
		$this->load->view('templates/footer');
	}

    //bangsal-
	public function index_bangsal(){
		$data['bangsal'] = $this->prm_model->get_bangsal();
		$this->load->view('templates/header');
		$this->load->view('prm/navRekammedik');
		$this->load->view('prm/bangsal/index', $data);
		$this->load->view('templates/footer');
	}
	public function add_bangsal(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		// $this->form_validation->set_rules('kd_bgs', 'Kode', 'required');
		// $this->form_validation->set_rules('nm_bgs', 'Nama', 'required');
		// $this->form_validation->set_rules('alokasi', 'Alokasi', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header');        
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/bangsal/add');
			$this->load->view('templates/footer');
		}		
	}
	public function simpan_add_bangsal(){
		$addData = $this->prm_model->set_bangsal();
		if ($addData) {
            $this->session->set_flashdata('success_msg', 'sukses');
            redirect(base_url('prm/index_bangsal/'));
        } else {
            $this->session->set_flashdata('error_msg', 'gagal');
            redirect(base_url('prm/index_bangsal/'));
        }
	}
	public function update_bangsal($kd_bgs){
		$this->load->helper('form');
		$this->load->library('form_validation');
		// $this->form_validation->set_rules('kd_bgs', 'Kode', 'required');
		// $this->form_validation->set_rules('nm_bgs', 'Nama', 'required');
		// $this->form_validation->set_rules('alokasi', 'Alokasi', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data['item'] = $this->prm_model->get_bangsal($kd_bgs);		
			$this->load->view('templates/header');        
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/bangsal/update', $data);
			$this->load->view('templates/footer');
		}		
	}
	public function simpan_update_bangsal(){
		$addData = $this->prm_model->update_bangsal($kd_bgs);
		if ($addData) {
            $this->session->set_flashdata('success_msg_edit', 'sukses');
            redirect(base_url('prm/index_bangsal/'));
        } else {
            $this->session->set_flashdata('error_msg_edit', 'gagal');
            redirect(base_url('prm/index_bangsal/'));
        }
	}
	public function simpan_delete_bangsal($kd_bgs){
		$this->prm_model->delete_bangsal($kd_bgs);
		redirect(base_url('prm/index_bangsal/'));
	}

	//dokter-
	public function index_dokter(){
		$data['dokter'] = $this->prm_model->get_dokter();
		$this->load->view('templates/header');
		$this->load->view('prm/navRekammedik');
		$this->load->view('prm/dokter/index', $data);
		$this->load->view('templates/footer');
	}
	public function add_dokter(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		// $this->form_validation->set_rules('kd_dkt', 'Kode', 'required');
		// $this->form_validation->set_rules('nm_dkt', 'Nama', 'required');
		// $this->form_validation->set_rules('keahlian', 'Keahlian', 'required');
		// $this->form_validation->set_rules('kd_bgs', 'Bangsal', 'required');
		if ($this->form_validation->run() === FALSE){
			$data['bangsal'] = $this->prm_model->get_bangsal();
			$this->load->view('templates/header');        
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/dokter/add', $data);
			$this->load->view('templates/footer');
		}
	}
	public function simpan_add_dokter(){
		$addData = $this->prm_model->set_dokter();
		if ($addData) {
            $this->session->set_flashdata('success_msg', 'sukses');
            redirect(base_url('prm/index_dokter/'));
        } else {
            $this->session->set_flashdata('error_msg', 'gagal');
            redirect(base_url('prm/index_dokter/'));
        }
	}
	public function update_dokter($kd_dkt){
		$this->load->helper('form');
		$this->load->library('form_validation');
		// $this->form_validation->set_rules('kd_dkt', 'Kode', 'required');
		// $this->form_validation->set_rules('nm_dkt', 'Nama', 'required');
		// $this->form_validation->set_rules('keahlian', 'Status', 'required');
		// $this->form_validation->set_rules('kd_bgs', 'Bangsal', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data['item'] = $this->prm_model->get_dokter($kd_dkt);
			$data['bangsal'] = $this->prm_model->get_bangsal();
			$this->load->view('templates/header');        
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/dokter/update', $data);
			$this->load->view('templates/footer');
		}		
	}
	public function simpan_update_dokter(){
		$addData = $this->prm_model->update_dokter($kd_dkt);
		if ($addData) {
            $this->session->set_flashdata('success_msg_edit', 'sukses');
            redirect(base_url('prm/index_dokter/'));
        } else {
            $this->session->set_flashdata('error_msg_edit', 'gagal');
            redirect(base_url('prm/index_dokter/'));
        }
	}
	public function simpan_delete_dokter($kd_dkt){
		$this->prm_model->delete_dokter($kd_dkt);
		redirect(base_url('prm/index_dokter/'));
	}

	//kelas-
	public function index_kelas(){
		$data['kelas'] = $this->prm_model->get_kelas();
		$this->load->view('templates/header');
		$this->load->view('prm/navRekammedik');
		$this->load->view('prm/kelas/index', $data);
		$this->load->view('templates/footer');
	}
	public function add_kelas(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		// $this->form_validation->set_rules('kd_kls', 'Kode', 'required');
		// $this->form_validation->set_rules('nm_kls', 'Nama', 'required');
		// $this->form_validation->set_rules('fasilitas', 'Fasilitas', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header');        
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/kelas/add');
			$this->load->view('templates/footer');
		}		
	}
	public function simpan_add_kelas(){
		$this->prm_model->set_kelas();
		$addData = redirect(base_url('prm/index_kelas/'));
		if ($addData) {
            $this->session->set_flashdata('success_msg', 'sukses');
            redirect(base_url('prm/index_kelas/'));
        } else {
            $this->session->set_flashdata('error_msg', 'gagal');
            redirect(base_url('prm/index_kelas/'));
        }
	}
	public function update_kelas($kd_kls){
		$this->load->helper('form');
		$this->load->library('form_validation');
		// $this->form_validation->set_rules('kd_kls', 'Kode', 'required');
		// $this->form_validation->set_rules('nm_kls', 'Nama', 'required');
		// $this->form_validation->set_rules('fasilitas', 'Fasilitas', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data['item'] = $this->prm_model->get_kelas($kd_kls);		
			$this->load->view('templates/header');        
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/kelas/update', $data);
			$this->load->view('templates/footer');
		}		
	}
	public function simpan_update_kelas(){
		$addData = $this->prm_model->update_kelas($kd_kls);
		if ($addData) {
            $this->session->set_flashdata('success_msg_edit', 'sukses');
            redirect(base_url('prm/index_kelas/'));
        } else {
            $this->session->set_flashdata('error_msg_edit', 'gagal');
            redirect(base_url('prm/index_kelas/'));
        }
	}
	public function simpan_delete_kelas($kd_kls){
		$this->prm_model->delete_kelas($kd_kls);
		redirect(base_url('prm/index_kelas/'));
	}

	//pasien-
	public function index_pasien(){
		$data['pasien'] = $this->prm_model->get_pasien();
		$this->load->view('templates/header');
		$this->load->view('prm/navRekammedik');
		$this->load->view('prm/pasien/index', $data);
		$this->load->view('templates/footer');
	}
	public function add_pasien(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		// $this->form_validation->set_rules('kd_rm', 'No. RM', 'required');
		// $this->form_validation->set_rules('nm_kls', 'Nama', 'required');
		// $this->form_validation->set_rules('alm_psn', 'Alamat', 'required');
		// $this->form_validation->set_rules('kd_pyk', 'Diagnosa', 'required');
		// $this->form_validation->set_rules('jns_psn', 'Jenis', 'required');
		// $this->form_validation->set_rules('status_psn', 'Status', 'required');
		if ($this->form_validation->run() === FALSE){
			$data['penyakit'] = $this->prm_model->get_penyakit();
			$this->load->view('templates/header');        
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/pasien/add', $data);
			$this->load->view('templates/footer');
		}		
	}
	public function simpan_add_pasien(){
		$addData = $this->prm_model->set_pasien();
		if ($addData) {
            $this->session->set_flashdata('success_msg', 'sukses');
            redirect(base_url('prm/index_pasien/'));
        } else {
            $this->session->set_flashdata('error_msg', 'gagal');
            redirect(base_url('prm/index_pasien/'));
        }
	}
	public function update_pasien($kd_rm){
		$this->load->helper('form');
		$this->load->library('form_validation');
		// $this->form_validation->set_rules('kd_rm', 'No. RM', 'required');
		// $this->form_validation->set_rules('nm_kls', 'Nama', 'required');
		// $this->form_validation->set_rules('alm_psn', 'Alamat', 'required');
		// $this->form_validation->set_rules('kd_pyk', 'Diagnosa', 'required');
		// $this->form_validation->set_rules('jns_psn', 'Jenis', 'required');
		// $this->form_validation->set_rules('status_psn', 'Status', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data['item'] = $this->prm_model->get_pasien($kd_rm);
			$data['penyakit'] = $this->prm_model->get_penyakit();
			$this->load->view('templates/header');        
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/pasien/update', $data);
			$this->load->view('templates/footer');
		}		
	}
	public function simpan_update_pasien(){
		$addData = $this->prm_model->update_pasien($kd_rm);
		if ($addData) {
            $this->session->set_flashdata('success_msg_edit', 'sukses');
            redirect(base_url('prm/index_pasien/'));
        } else {
            $this->session->set_flashdata('error_msg_edit', 'gagal');
            redirect(base_url('prm/index_pasien/'));
        }
	}
	public function simpan_delete_pasien($kd_rm){
		$this->prm_model->delete_pasien($kd_rm);
		redirect(base_url('prm/index_pasien/'));
	}

	//penyakit-
	public function index_penyakit(){
		$data['penyakit'] = $this->prm_model->get_penyakit();
		$this->load->view('templates/header');
		$this->load->view('prm/navRekammedik');
		$this->load->view('prm/penyakit/index', $data);
		$this->load->view('templates/footer');
	}
	public function add_penyakit(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		// $this->form_validation->set_rules('kd_pyk', 'Kode', 'required');
		// $this->form_validation->set_rules('nm_pyk', 'Nama', 'required');
		// $this->form_validation->set_rules('desk_pyk', 'Dekripsi', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header');        
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/penyakit/add');
			$this->load->view('templates/footer');
		}		
	}
	public function simpan_add_penyakit(){
		$addData = $this->prm_model->set_penyakit();
		if ($addData) {
            $this->session->set_flashdata('success_msg', 'sukses');
            redirect(base_url('prm/index_penyakit/'));
        } else {
            $this->session->set_flashdata('error_msg', 'gagal');
            redirect(base_url('prm/index_penyakit/'));
        }
	}
	public function update_penyakit($kd_pyk){
		$this->load->helper('form');
		$this->load->library('form_validation');
		// $this->form_validation->set_rules('kd_pyk', 'Kode', 'required');
		// $this->form_validation->set_rules('nm_pyk', 'Nama', 'required');
		// $this->form_validation->set_rules('desk_pyk', 'Dekripsi', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data['item'] = $this->prm_model->get_penyakit($kd_pyk);		
			$this->load->view('templates/header');        
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/penyakit/update', $data);
			$this->load->view('templates/footer');
		}		
	}
	public function simpan_update_penyakit(){
		$addData = $this->prm_model->update_penyakit($kd_pyk);
		if ($addData) {
            $this->session->set_flashdata('success_msg_edit', 'sukses');
            redirect(base_url('prm/index_penyakit/'));
        } else {
            $this->session->set_flashdata('error_msg_edit', 'gagal');
            redirect(base_url('prm/index_penyakit/'));
        }
	}
	public function simpan_delete_penyakit($kd_pyk){
		$this->prm_model->delete_penyakit($kd_pyk);
		redirect(base_url('prm/index_penyakit/'));
	}

	//petugas-
	public function index_petugas(){
		$data['petugas'] = $this->prm_model->get_petugas();
		$this->load->view('templates/header');
		$this->load->view('prm/navRekammedik');
		$this->load->view('prm/petugas/index', $data);
		$this->load->view('templates/footer');
	}
	public function add_petugas(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		// $this->form_validation->set_rules('kd_ptg', 'Kode', 'required');
		// $this->form_validation->set_rules('nm_ptg', 'Nama', 'required');
		// $this->form_validation->set_rules('jns_ptg', 'Jenis', 'required');
		// $this->form_validation->set_rules('kd_bgs', 'Bangsal', 'required');
		if ($this->form_validation->run() === FALSE){
			$data['bangsal'] = $this->prm_model->get_bangsal();
			$this->load->view('templates/header');        
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/petugas/add', $data);
			$this->load->view('templates/footer');
		}		
	}
	public function simpan_add_petugas(){
		$addData = $this->prm_model->set_petugas();
		if ($addData) {
            $this->session->set_flashdata('success_msg', 'sukses');
            redirect(base_url('prm/index_petugas/'));
        } else {
            $this->session->set_flashdata('error_msg', 'gagal');
            redirect(base_url('prm/index_petugas/'));
        }
	}
	public function update_petugas($kd_dkt){
		$this->load->helper('form');
		$this->load->library('form_validation');
		// $this->form_validation->set_rules('kd_ptg', 'Kode', 'required');
		// $this->form_validation->set_rules('nm_ptg', 'Nama', 'required');
		// $this->form_validation->set_rules('jns_ptg', 'Jenis', 'required');
		// $this->form_validation->set_rules('kd_bgs', 'Bangsal', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data['item'] = $this->prm_model->get_petugas($kd_dkt);
			$data['bangsal'] = $this->prm_model->get_bangsal();
			$this->load->view('templates/header');        
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/petugas/update', $data);
			$this->load->view('templates/footer');
		}		
	}
	public function simpan_update_petugas(){
		$addData = $this->prm_model->update_petugas($kd_ptg);
		if ($addData) {
            $this->session->set_flashdata('success_msg_edit', 'sukses');
            redirect(base_url('prm/index_petugas/'));
        } else {
            $this->session->set_flashdata('error_msg_edit', 'gagal');
            redirect(base_url('prm/index_petugas/'));
        }
	}
	public function delete_petugas($kd_ptg){
		$this->prm_model->delete_minta_cari($kd_ptg);
		redirect('prm/index_petugas');
	}

	//tempat tdiur-
	public function index_tmp_tdr(){
		$data['tmp_tdr'] = $this->prm_model->get_tmp_tdr();
		$this->load->view('templates/header');
		$this->load->view('prm/navRekammedik');
		$this->load->view('prm/tmp_tdr/index', $data);
		$this->load->view('templates/footer');
	}
	public function add_tmp_tdr(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		// $this->form_validation->set_rules('kd_tt', 'Kode', 'required');
		// $this->form_validation->set_rules('nm_tt', 'Nama', 'required');
		// $this->form_validation->set_rules('status_tt', 'Status', 'required');
		// $this->form_validation->set_rules('kd_bgs', 'Bangsal', 'required');
		// $this->form_validation->set_rules('kd_kls', 'Kelas', 'required');
		if ($this->form_validation->run() === FALSE){
			$data['bangsal'] = $this->prm_model->get_bangsal();
			$data['kelas'] = $this->prm_model->get_kelas();
			$this->load->view('templates/header');
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/tmp_tdr/add', $data);
			$this->load->view('templates/footer');
		}		
	}
	public function simpan_add_tmp_tdr(){
		$addData = $this->prm_model->set_tmp_tdr();
		if ($addData) {
            $this->session->set_flashdata('success_msg', 'sukses');
            redirect(base_url('prm/index_tmp_tdr/'));
        } else {
            $this->session->set_flashdata('error_msg', 'gagal');
            redirect(base_url('prm/index_tmp_tdr/'));
        }
	}
	public function update_tmp_tdr($kd_tt){
		$this->load->helper('form');
		$this->load->library('form_validation');
		// $this->form_validation->set_rules('kd_tt', 'Kode', 'required');
		// $this->form_validation->set_rules('nm_tt', 'Nama', 'required');
		// $this->form_validation->set_rules('kd_bgs', 'Bangsal', 'required');
		// $this->form_validation->set_rules('kd_kls', 'Kelas', 'required');
		// $this->form_validation->set_rules('status_tt', 'Status', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data['item'] = $this->prm_model->get_tmp_tdr($kd_tt);
			$data['bangsal'] = $this->prm_model->get_bangsal();
			$data['kelas'] = $this->prm_model->get_kelas();
			$this->load->view('templates/header');        
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/tmp_tdr/update', $data);
			$this->load->view('templates/footer');
		}		
	}
	public function simpan_update_tmp_tdr(){
		$addData = $this->prm_model->update_tmp_tdr($kd_tt);
		if ($addData) {
            $this->session->set_flashdata('success_msg_edit', 'sukses');
            redirect(base_url('prm/index_tmp_tdr/'));
        } else {
            $this->session->set_flashdata('error_msg_edit', 'gagal');
            redirect(base_url('prm/index_tmp_tdr/'));
        }
	}
	public function simpan_tmp_tdr($kd_tt){
		$this->prm_model->delete_tmp_tdr($kd_tt);
		redirect(base_url('prm/index_tmp_tdr/'));
	}

	//aktor-
	public function index_aktor(){
		$data['aktor'] = $this->prm_model->get_aktor();
		$this->load->view('templates/header');
		$this->load->view('prm/navRekammedik');
		$this->load->view('prm/aktor/index', $data);
		$this->load->view('templates/footer');
	}
	public function add_aktor(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		// $this->form_validation->set_rules('kd_aktor', 'Kode', 'required');
		// $this->form_validation->set_rules('username', 'Username', 'required');
		// $this->form_validation->set_rules('password', 'Password', 'required');
		// $this->form_validation->set_rules('level', 'Level', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header');        
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/aktor/add');
			$this->load->view('templates/footer');
		}		
	}
	public function simpan_add_aktor(){
		$addData = $this->prm_model->set_aktor();
		if ($addData) {
            $this->session->set_flashdata('success_msg', 'sukses');
            redirect(base_url('prm/index_aktor/'));
        } else {
            $this->session->set_flashdata('error_msg', 'gagal');
            redirect(base_url('prm/index_aktor/'));
        }
	}
	public function update_aktor($kd_akt){
		$this->load->helper('form');
		$this->load->library('form_validation');
		// $this->form_validation->set_rules('kd_aktor', 'Kode', 'required');
		// $this->form_validation->set_rules('username', 'Username', 'required');
		// $this->form_validation->set_rules('password', 'Password', 'required');
		// $this->form_validation->set_rules('level', 'Level', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data['item'] = $this->prm_model->get_aktor($kd_akt);		
			$this->load->view('templates/header');        
			$this->load->view('prm/navRekammedik');
			$this->load->view('prm/aktor/update', $data);
			$this->load->view('templates/footer');
		}		
	}
	public function simpan_update_aktor(){
		$addData = $this->prm_model->update_aktor($kd_akt);
		if ($addData) {
            $this->session->set_flashdata('success_msg_edit', 'sukses');
            redirect(base_url('prm/index_aktor/'));
        } else {
            $this->session->set_flashdata('error_msg_edit', 'gagal');
            redirect(base_url('prm/index_aktor/'));
        }
	}
	public function simpan_delete_aktor($kd_akt){
		$this->prm_model->delete_aktor($kd_akt);
		redirect(base_url('prm/index_aktor/'));
	}
}