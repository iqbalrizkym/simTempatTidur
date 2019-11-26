<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pp extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->model('pp_model');
        $this->load->helper('url_helper');
    }

    public function index_home(){
        $this->load->view('templates/header');    
        $this->load->view('pp/navPendaftaran');
        $this->load->view('home');
        $this->load->view('templates/footer');  
    }

    // profil
        // profil
    public function update_profil(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nm_akt', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == false) {
            $data['aktor'] = $this->pp_model->get_aktor();
            $this->load->view('templates/header');
            $this->load->view('pp/navPendaftaran');
            $this->load->view('pp/profil/update', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'nm_akt'    => $this->input->post('nm_akt', TRUE),
                'username'  => $this->input->post('username', TRUE),
                'password'  => $this->input->post('password', TRUE),
            );
            $result = $this->pp_model->update_profil($this->session->userdata('kd_akt'), $data);
            if ($result > 0) {
                $session_data = array(
                    'nm_akt'    => $this->input->post('nm_akt', TRUE),
                    'username'  => $this->input->post('username', TRUE),
                    'password'  => $this->input->post('password', TRUE),
                );
                $this->session->set_userdata($session_data);
                $this->session->set_flashdata('success_msg', 'User Profile Updated');
                return redirect('pp/update_profil');
            } else {
                $this->session->set_flashdata('error_msg', 'User Profile cant Updated');
                return redirect('pp/update_profil');
            }
        }   
    }

    //status
    public function index_status(){
        $data['count_tt'] = $this->pp_model->get_status();
        $this->load->view('templates/header');
        $this->load->view('pp/navPendaftaran');
        $this->load->view('pp/status/index', $data);
        $this->load->view('templates/footer');
    }
    public function detail_status($kd_bgs){
        $data['status'] = $this->pp_model->get_detail('tmp_tdr.kd_bgs = "'.$kd_bgs. '" AND guna_tt.status_ttguna = "On"');
        $data['nama'] = $this->pp_model->get_nm_bgs($kd_bgs);
        $where_guna_tt = array('status_ttguna' => 'On');
        $data['guna_tt'] = $this->pp_model->get_guna_tt($where_guna_tt);
        $data['tempat_tidur'] = $this->pp_model->get_tt();
        $where_tt_kosong = array("tmp_tdr.kd_bgs" => $kd_bgs);
        $data['tt_kosong'] = $this->pp_model->get_tt_kosong('tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Kosong" OR tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Rusak" OR  tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Direncanakan" OR tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Disiapkan"');
        $this->load->view('templates/header');
        $this->load->view('pp/navPendaftaran');
        $this->load->view('pp/status/detail', $data);
        $this->load->view('templates/footer');
    }
    public function add_alokasi($kd_tt){
        $kd_tt = $this->uri->segment(4);
        $this->load->helper('form');
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('kd_gn', 'Kode Guna', 'required');
        // $this->form_validation->set_rules('kd_tt', 'Tempa Tidur', 'required');
        // $this->form_validation->set_rules('kd_kls', 'Kelas', 'required');
        // $this->form_validation->set_rules('kd_rm', 'Pasien', 'required');
        // $this->form_validation->set_rules('diagnosa', 'Diagnosa Awal', 'required');
        $data['tempat_tidur'] = $this->pp_model->get_data_duatabel('tmp_tdr', 'kelas', 'tmp_tdr.kd_kls = kelas.kd_kls', 'kd_tt = "'.$kd_tt.'"');
        if ($this->form_validation->run() === FALSE) {
            $data['namatt'] = $this->pp_model->get_tmp_tdr($kd_tt);
            $data['namakelas'] = $this->pp_model->get_kelas($kd_tt);
            $data['pasien'] = $this->pp_model->get_pasien();
            $data['penyakit'] = $this->pp_model->get_penyakit();
            $this->load->view('templates/header');        
            $this->load->view('pp/navPendaftaran');
            $this->load->view('pp/status/add', $data);
            $this->load->view('templates/footer');
        }
    }
    public function simpan_add_alokasi(){
        $addData = $this->pp_model->set_guna_tt();
        $addData = $this->pp_model->update_status();
        $addData = $this->pp_model->update_status_psn();
        $addData = $this->pp_model->set_detail_diagnosa();
        if ($addData) {
            $this->session->set_flashdata('success_msg', 'sukses');
            redirect(base_url('pp/index_status/'));
        } else {
            $this->session->set_flashdata('error_msg', 'gagal');
            redirect(base_url('pp/index_status/'));
        }
    }

    //pendaftran pasien
    public function add_pendaftaran(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('kd_rm', 'No. RM', 'required');
        // $this->form_validation->set_rules('nm_kls', 'Nama', 'required');
        // $this->form_validation->set_rules('alm_psn', 'Alamat', 'required');
        // $this->form_validation->set_rules('kd_pyk', 'Diagnosa', 'required');
        // $this->form_validation->set_rules('jns_psn', 'Jenis', 'required');
        // $this->form_validation->set_rules('status_psn', 'Status', 'required');
        if ($this->form_validation->run() === FALSE){
            $this->load->view('templates/header');        
            $this->load->view('pp/navPendaftaran');
            $this->load->view('pp/pendaftaran/add');
            $this->load->view('templates/footer');
        }       
    }
    public function simpan_add_pendaftran(){
        $addData = $this->pp_model->set_pendaftaran();
        if ($addData) {
            $this->session->set_flashdata('success_msg', 'sukses');
            redirect(base_url('pp/add_pendaftaran/'));
        } else {
            $this->session->set_flashdata('error_msg', 'gagal');
            redirect(base_url('pp/add_pendaftaran/'));
        }
    }

    //minta cari
    public function index_minta_cari(){
        $data['minta_cari'] = $this->pp_model->get_minta_cari();
        $this->load->view('templates/header');
        $this->load->view('pp/navPendaftaran');
        $this->load->view('pp/minta_cari/index', $data);
        $this->load->view('templates/footer');
    }
    public function add_minta_cari(){
        $this->load->helper('form');
        // $this->load->library('form_validation');
        // $this->form_validation->set_rules('kd_cari', 'Kode', 'required');
        // $this->form_validation->set_rules('nm_cari', 'Nama', 'required');
        // $this->form_validation->set_rules('alm_cari', 'Alamat', 'required');
        // $this->form_validation->set_rules('desk_minta', 'Deskripsi', 'required');
        // $this->form_validation->set_rules('kd_ptg', 'Petugas', 'required');
        // if ($this->form_validation->run() === FALSE) {
        $data['petugas'] = $this->pp_model->get_petugas();
        $this->load->view('templates/header');        
        $this->load->view('pp/navPendaftaran');
        $this->load->view('pp/minta_cari/add', $data);
        $this->load->view('templates/footer');
    }
    public function simpan_add_minta_cari(){
        $addData = $this->pp_model->set_minta_cari();
        if ($addData) {
            $this->session->set_flashdata('success_msg', 'sukses');
            redirect(base_url('pp/index_minta_cari/'));
        } else {
            $this->session->set_flashdata('error_msg', 'gagal');
            redirect(base_url('pp/index_minta_cari/'));
        }
    }

    public function update_minta_cari($kd_cari){
        $this->load->helper('form');
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('kd_cari', 'Kode', 'required');
        // $this->form_validation->set_rules('nm_cari', 'Nama', 'required');
        // $this->form_validation->set_rules('alm_cari', 'Alamat', 'required');
        // $this->form_validation->set_rules('desk_minta', 'Deskripsi', 'required');
        // $this->form_validation->set_rules('kd_ptg', 'Petugas', 'required');
        if ($this->form_validation->run() === FALSE) {
            $data['item'] = $this->pp_model->get_minta_cari($kd_cari);
            $data['petugas'] = $this->pp_model->get_petugas();
            $this->load->view('templates/header');        
            $this->load->view('pp/navPendaftaran');
            $this->load->view('pp/minta_cari/update', $data);
            $this->load->view('templates/footer');
        }       
    }
    public function simpan_update_minta_cari(){
        $addData = $this->pp_model->update_minta_cari($kd_cari);
        if ($addData) {
            $this->session->set_flashdata('success_msg_edit', 'sukses');
            redirect(base_url('pp/index_minta_cari/'));
        } else {
            $this->session->set_flashdata('error_msg_edit', 'gagal');
            redirect(base_url('pp/index_minta_cari/'));
        }

    }
    public function simpan_delete_minta_cari($kd_cari){
        $this->pp_model->delete_minta_cari($kd_cari);
        redirect('pp/index_minta_cari');
    }
}
?>