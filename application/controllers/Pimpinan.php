<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pimpinan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('pimpinan_model');
        $this->load->helper('url_helper');
        $this->load->library('pdf_download');

    }

    public function index_home(){
      $this->load->view('templates/header');    
      $this->load->view('pimpinan/navPimpinan');
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
        $data['aktor'] = $this->pimpinan_model->get_aktor();
        $this->load->view('templates/header');
        $this->load->view('pimpinan/navPimpinan');
        $this->load->view('pimpinan/profil/update', $data);
        $this->load->view('templates/footer');
    } else {
        $data = array(
            'nm_akt'    => $this->input->post('nm_akt', TRUE),
            'username'  => $this->input->post('username', TRUE),
            'password'  => $this->input->post('password', TRUE),
        );
        $result = $this->pimpinan_model->update_profil($this->session->userdata('kd_akt'), $data);
        if ($result > 0) {
            $session_data = array(
                'nm_akt'    => $this->input->post('nm_akt', TRUE),
                'username'  => $this->input->post('username', TRUE),
                'password'  => $this->input->post('password', TRUE),
            );
            $this->session->set_userdata($session_data);
            $this->session->set_flashdata('success_msg', 'User Profile Updated');
            return redirect('pimpinan/update_profil');
        } else {
            $this->session->set_flashdata('error_msg', 'User Profile cant Updated');
            return redirect('pimpinan/update_profil');
            }
        }
    }

    // status
    public function index_status(){
        $data['count_tt'] = $this->pimpinan_model->get_status();
        $this->load->view('templates/header');
        $this->load->view('pimpinan/navPimpinan');
        $this->load->view('pimpinan/status/index', $data);
        $this->load->view('templates/footer');
    }

    // grafik
    public function periode_grafik(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('bulan', 'bulan', 'required');
        // $this->form_validation->set_rules('jenis', 'jenis', 'required');
        $this->load->view('templates/header');
        $this->load->view('pimpinan/navPimpinan');
        $this->load->view('pimpinan/grafik/form');
        $this->load->view('templates/footer');
    }
    public function index_grafik(){
        $jenis = $this->input->post('jenis');
        $data['btbl1'] = $this->pimpinan_model->get_btbl1();
        $data['btbl2'] = $this->pimpinan_model->get_btbl2();
        $data['btbl3'] = $this->pimpinan_model->get_btbl3();
        if($jenis == "BOR"){
            $this->load->view('templates/header');
            $this->load->view('pimpinan/navPimpinan');
            $this->load->view('pimpinan/grafik/bor', $data);
            $this->load->view('templates/footer');
        } elseif ($jenis == "LOS"){
            $this->load->view('templates/header');
            $this->load->view('pimpinan/navPimpinan');
            $this->load->view('pimpinan/grafik/los', $data);
            $this->load->view('templates/footer');
        } elseif ($jenis == "TOI"){
            $this->load->view('templates/header');
            $this->load->view('pimpinan/navPimpinan');
            $this->load->view('pimpinan/grafik/toi', $data);
            $this->load->view('templates/footer');
        } elseif ($jenis == "BTO"){
            $this->load->view('templates/header');
            $this->load->view('pimpinan/navPimpinan');
            $this->load->view('pimpinan/grafik/bto', $data);
            $this->load->view('templates/footer');
        } elseif ($jenis == "BJ"){
            $this->load->view('templates/header');
            $this->load->view('pimpinan/navPimpinan');
            $this->load->view('pimpinan/grafik/bj', $data);
            $this->load->view('templates/footer');
        }
    }

    // btbl
    public function periode_btbl(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('bulan', 'bulan', 'required');
        // $this->form_validation->set_rules('jenis', 'jenis', 'required');
        $this->load->view('templates/header');
        $this->load->view('pimpinan/navPimpinan');
        $this->load->view('pimpinan/lbtb/form');
        $this->load->view('templates/footer');
    }
    public function index_btbl(){
        $jenis = $this->input->post('jenis');
        $data['btbl1'] = $this->pimpinan_model->get_btbl1();
        $data['btbl2'] = $this->pimpinan_model->get_btbl2();
        $data['btbl3'] = $this->pimpinan_model->get_btbl3();
        if($jenis == "BOR"){
            $this->load->view('templates/header');
            $this->load->view('pimpinan/navPimpinan');
            $this->load->view('pimpinan/lbtb/bor', $data);
            $this->load->view('templates/footer');
        } elseif ($jenis == "LOS"){
            $this->load->view('templates/header');
            $this->load->view('pimpinan/navPimpinan');
            $this->load->view('pimpinan/lbtb/los', $data);
            $this->load->view('templates/footer');
        } elseif ($jenis == "TOI"){
            $this->load->view('templates/header');
            $this->load->view('pimpinan/navPimpinan');
            $this->load->view('pimpinan/lbtb/toi', $data);
            $this->load->view('templates/footer');
        } elseif ($jenis == "BTO"){
            $this->load->view('templates/header');
            $this->load->view('pimpinan/navPimpinan');
            $this->load->view('pimpinan/lbtb/bto', $data);
            $this->load->view('templates/footer');
        }
    }

	// minta cari
    public function periode_mintacari(){ 
        $this->load->helper('form');
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('tgl1', 'tgl1', 'required');
        // $this->form_validation->set_rules('tgl2', 'tgl2', 'required');
        $this->load->view('templates/header');
        $this->load->view('pimpinan/navPimpinan');
        $this->load->view('pimpinan/minta_cari/form');
        $this->load->view('templates/footer');
    }
    public function lap_mintacari(){
        $data['minta_cari'] = $this->pimpinan_model->get_minta_cari();
        $this->load->view('templates/header');
        $this->load->view('pimpinan/navPimpinan');
        $this->load->view('pimpinan/minta_cari/index', $data);
        $this->load->view('templates/footer');
    }
    public function download_minta_cari(){
        $data['minta_cari'] = $this->pimpinan_model->get_minta_cari();
        $this->load->view('pimpinan/minta_cari/download', $data);
    }

    // tempat tidur
    public function periode_tmp_tdr(){ 
        $this->load->helper('form');
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('tgl', 'tgl', 'required');
        $this->load->view('templates/header');
        $this->load->view('pimpinan/navPimpinan');
        $this->load->view('pimpinan/tmp_tdr/form');
        $this->load->view('templates/footer');
    }
    public function grafik_tmp_tdr(){
        $data['digunakan'] = $this->pimpinan_model->get_digunakan();
        $data['kosong'] = $this->pimpinan_model->get_kosong();
        $this->load->view('templates/header');
        $this->load->view('pimpinan/navPimpinan');
        $this->load->view('pimpinan/tmp_tdr/index', $data);
        $this->load->view('templates/footer');
    }
}
?>