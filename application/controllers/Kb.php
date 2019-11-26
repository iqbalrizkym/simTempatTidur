<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kb extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('kb_model');
		$this->load->helper('url_helper');
	}

	public function index_home(){
        $this->load->view('templates/header');
        $this->load->view('kb/navBangsal');
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
            $data['aktor'] = $this->kb_model->get_aktor();
            $this->load->view('templates/header');
            $this->load->view('kb/navBangsal');
            $this->load->view('kb/profil/update', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'nm_akt'    => $this->input->post('nm_akt', TRUE),
                'username'  => $this->input->post('username', TRUE),
                'password'  => $this->input->post('password', TRUE),
            );
            $result = $this->kb_model->update_profil($this->session->userdata('kd_akt'), $data);
            if ($result > 0) {
                $session_data = array(
                    'nm_akt'    => $this->input->post('nm_akt', TRUE),
                    'username'  => $this->input->post('username', TRUE),
                    'password'  => $this->input->post('password', TRUE),
                );
                $this->session->set_userdata($session_data);
                $this->session->set_flashdata('success_msg', 'User Profile Updated');
                return redirect('kb/update_profil');
            } else {
                $this->session->set_flashdata('error_msg', 'User Profile cant Updated');
                return redirect('kb/update_profil');
            }
        }   
    }

    // status
    public function index_status(){
        $data['count_tt'] = $this->kb_model->get_status();
        $this->load->view('templates/header');
        $this->load->view('kb/navBangsal');
        $this->load->view('kb/status/index', $data);
        $this->load->view('templates/footer');
    }
    public function detail_status($kd_bgs){
        $data['status'] = $this->kb_model->get_detail('tmp_tdr.kd_bgs = "'.$kd_bgs. '" AND guna_tt.status_ttguna = "On"');
        $data['nama'] = $this->kb_model->get_nm_bgs($kd_bgs);
        $where_guna_tt = array('status_ttguna' => 'On');
        $data['guna_tt'] = $this->kb_model->get_guna_tt($where_guna_tt);
        $data['tempat_tidur'] = $this->kb_model->get_tt();
        $where_tt_kosong = array("tmp_tdr.kd_bgs" => $kd_bgs);
        $data['tt_kosong'] = $this->kb_model->get_tt_kosong('tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Kosong" OR tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Rusak" OR  tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Direncanakan" OR tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Disiapkan"');
        $this->load->view('templates/header');
        $this->load->view('kb/navBangsal');
        $this->load->view('kb/status/detail', $data);
        $this->load->view('templates/footer');
    }
     public function update_guna_tt_diminta($kd_gn, $kd_tt){
        $kd_gn = $this->uri->segment(4);
        $kd_tt = $this->uri->segment(3);
        $this->load->helper('form');
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('kd_gn', 'guna', 'required');
        // $this->form_validation->set_rules('kd_tt', 'tt', 'required');
        // $this->form_validation->set_rules('kd_kls', 'Kelas', 'required');
        // $this->form_validation->set_rules('kd_rm', 'RM', 'required');
        // $this->form_validation->set_rules('status_tt', 'Statustt', 'required');
        // $this->form_validation->set_rules('jns_psn', 'Jenis', 'required');
        // $this->form_validation->set_rules('status_psn', 'Status', 'required');
        // $this->form_validation->set_rules('tgl_msk', 'Masuk', 'required');
        $data['gunattawal'] = $this->kb_model->get_data_tt_diminta('guna_tt.kd_gn = "'.$kd_gn.'"');
        // print_r($data);
        // exit(0);
        if ($this->form_validation->run() === FALSE) {
            $data['namatt']     = $this->kb_model->get_tmp_tdr($kd_tt);
            $data['namakelas']  = $this->kb_model->get_kelas($kd_tt);
            $data['penyakit']   = $this->kb_model->get_penyakit();
            $data['pasien']     = $this->kb_model->get_pasien($kd_gn);
            $this->load->view('templates/header');        
            $this->load->view('kb/navBangsal');
            $this->load->view('kb/status/diminta', $data);
            $this->load->view('templates/footer');
        }
    }
    public function update_diminta_dipakai(){
        $addData = $this->kb_model->update_tt_diminta_dipakai();
        $addData = $this->kb_model->update_guna_tt_diminta_dipakai();
        if ($addData) {
            $this->session->set_flashdata('success_msg_edit', 'sukses');
            redirect(base_url('kb/index_status/'));
        } else {
            $this->session->set_flashdata('error_msg_edit', 'gagal');
            redirect(base_url('kb/index_status/'));
        }
    }
    public function update_guna_tt_dipakai($kd_gn, $kd_tt){
        $kd_gn = $this->uri->segment(4);
        $kd_tt = $this->uri->segment(3);
        $this->load->helper('form');
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('kd_gn', 'guna', 'required');
        // $this->form_validation->set_rules('kd_tt', 'tt', 'required');
        // $this->form_validation->set_rules('kd_kls', 'Kelas', 'required');
        // $this->form_validation->set_rules('kd_rm', 'RM', 'required');
        // $this->form_validation->set_rules('status_tt', 'Statustt', 'required');
        // $this->form_validation->set_rules('jns_psn', 'Jenis', 'required');
        // $this->form_validation->set_rules('status_psn', 'Status', 'required');
        // $this->form_validation->set_rules('tgl_msk', 'Masuk', 'required');
        $data['gunattawal'] = $this->kb_model->get_data_dipakai('guna_tt.kd_gn = "'.$kd_gn.'"');
        if ($this->form_validation->run() === FALSE) {
            $data['namatt']     = $this->kb_model->get_tmp_tdr($kd_tt);
            $data['namakelas']  = $this->kb_model->get_kelas($kd_tt);
            $data['penyakit']   = $this->kb_model->get_penyakit();
            $data['pasien']     = $this->kb_model->get_pasien($kd_gn);
            $data['dokter']     = $this->kb_model->get_dokter();
            $data['petugas']    = $this->kb_model->get_petugas();
            $this->load->view('templates/header');        
            $this->load->view('kb/navBangsal');
            $this->load->view('kb/status/dipakai', $data);
            $this->load->view('templates/footer');
        }
    }
    public function simpan_update_dipakai_direncanakan(){
        $addData = $this->kb_model->update_guna_tt_dipakai_direncanakan();
        $addData = $this->kb_model->update_diagnosa_dipakai_direncanakan();
        $addData = $this->kb_model->update_tt_dipakai_direncanakan();
        $addData = $this->kb_model->update_psn_dipakai_direncanakan();
        if ($addData) {
            $this->session->set_flashdata('success_msg_tambah', 'sukses');
            redirect(base_url('kb/index_status/'));
        } else {
            $this->session->set_flashdata('error_msg_edit_tambah', 'gagal');
            redirect(base_url('kb/index_status/'));
        }
    }
    public function update_diminta_kosong(){
        $addData = $this->kb_model->update_tt_diminta_kosong();
        $addData = $this->kb_model->update_guna_tt_diminta_kosong();
        $addData = $this->kb_model->update_psn_diminta_kosong();
        if ($addData) {
            $this->session->set_flashdata('success_msg_edit', 'sukses');
            redirect(base_url('kb/index_status/'));
        } else {
            $this->session->set_flashdata('error_msg_edit', 'gagal');
            redirect(base_url('kb/index_status/'));
        }
    }
    public function update_guna_tt_direncanakan($kd_tt){
        $kd_tt = $this->uri->segment(3);
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['ttrencana'] = $this->kb_model->get_data_tt_direncanakan('tmp_tdr.kd_tt = "'.$kd_tt.'"');
        if ($this->form_validation->run() === FALSE) {
            $data['namatt']     = $this->kb_model->get_tmp_tdr($kd_tt);
            $data['namakelas']  = $this->kb_model->get_kelas($kd_tt);
            $this->load->view('templates/header');        
            $this->load->view('kb/navBangsal');
            $this->load->view('kb/status/direncanakan', $data);
            $this->load->view('templates/footer');
        }
    }
    public function update_guna_tt_direncanakan_form($kd_tt){
        $kd_tt = $this->uri->segment(3);
        $this->load->helper('form');
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('kd_tt', 'tt', 'required');
        // $this->form_validation->set_rules('kd_kls', 'Kelas', 'required');
        $data['ttrencana'] = $this->kb_model->get_data_tt_direncanakan('tmp_tdr.kd_tt = "'.$kd_tt.'"');
        if ($this->form_validation->run() === FALSE) {
            $data['namatt']     = $this->kb_model->get_tmp_tdr($kd_tt);
            $data['namakelas']  = $this->kb_model->get_kelas($kd_tt);
            $data['penyakit'] = $this->kb_model->get_penyakit();
            $data['pasien'] = $this->kb_model->get_pasien();
            $this->load->view('templates/header');        
            $this->load->view('kb/navBangsal');
            $this->load->view('kb/status/form_pesan', $data);
            $this->load->view('templates/footer');
        }
    }
    public function update_direncanakan_dipesan(){
        $addData = $this->kb_model->set_tt_direncanakan_dipesan();
        $addData = $this->kb_model->set_diagnosa_direncanakan_dipesan();
        $addData = $this->kb_model->update_psn_direncanakan_dipesan();
        $addData = $this->kb_model->update_tt_direncanakan_dipesan();
        if ($addData) {
            $this->session->set_flashdata('success_msg_edit', 'sukses');
            redirect(base_url('kb/index_status/'));
        } else {
            $this->session->set_flashdata('error_msg_edit', 'gagal');
            redirect(base_url('kb/index_status/'));
        }
    }
    public function update_direncanakan_disiapkan(){
        $addData = $this->kb_model->update_tt_direncanakan_disiapkan();
        if ($addData) {
            $this->session->set_flashdata('success_msg_edit', 'sukses');
            redirect(base_url('kb/index_status/'));
        } else {
            $this->session->set_flashdata('error_msg_edit', 'gagal');
            redirect(base_url('kb/index_status/'));
        }
    }
    public function update_guna_tt_rusak($kd_tt){
        $kd_tt = $this->uri->segment(3);
        $this->load->helper('form');
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('kd_tt', 'tt', 'required');
        // $this->form_validation->set_rules('kd_kls', 'Kelas', 'required');
        $data['ttkosong'] = $this->kb_model->get_data_tt_rusak('tmp_tdr.kd_tt = "'.$kd_tt.'"');
        if ($this->form_validation->run() === FALSE) {
            $data['namatt']     = $this->kb_model->get_tmp_tdr($kd_tt);
            $data['namakelas']  = $this->kb_model->get_kelas($kd_tt);
            $this->load->view('templates/header');        
            $this->load->view('kb/navBangsal');
            $this->load->view('kb/status/rusak', $data);
            $this->load->view('templates/footer');
        }
    }
    public function update_rusak_kosong(){
        $addData = $this->kb_model->update_tt_rusak_kosong();
        if ($addData) {
            $this->session->set_flashdata('success_msg_edit', 'sukses');
            redirect(base_url('kb/index_status/'));
        } else {
            $this->session->set_flashdata('error_msg_edit', 'gagal');
            redirect(base_url('kb/index_status/'));
        }
    }
    public function update_guna_tt_dipesan($kd_gn, $kd_tt){
        $kd_gn = $this->uri->segment(4);
        $kd_tt = $this->uri->segment(3);
        $this->load->helper('form');
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('kd_gn', 'guna', 'required');
        // $this->form_validation->set_rules('kd_tt', 'tt', 'required');
        // $this->form_validation->set_rules('kd_kls', 'Kelas', 'required');
        // $this->form_validation->set_rules('kd_rm', 'RM', 'required');
        // $this->form_validation->set_rules('status_tt', 'Statustt', 'required');
        // $this->form_validation->set_rules('jns_psn', 'Jenis', 'required');
        // $this->form_validation->set_rules('status_psn', 'Status', 'required');
        // $this->form_validation->set_rules('tgl_msk', 'Masuk', 'required');
        $data['gunattawal'] = $this->kb_model->get_data_tt_dipesan('guna_tt.kd_gn = "'.$kd_gn.'"');
        if ($this->form_validation->run() === FALSE) {
            $data['namatt']     = $this->kb_model->get_tmp_tdr($kd_tt);
            $data['namakelas']  = $this->kb_model->get_kelas($kd_tt);
            $data['penyakit']   = $this->kb_model->get_penyakit();
            $data['pasien']     = $this->kb_model->get_pasien($kd_gn);
            $this->load->view('templates/header');        
            $this->load->view('kb/navBangsal');
            $this->load->view('kb/status/dipesan', $data);
            $this->load->view('templates/footer');
        }
    }
    public function update_dipesan_disiapkanpesan(){
        $addData = $this->kb_model->update_tt_dipesan_disiapkanpesan();
        if ($addData) {
            $this->session->set_flashdata('success_msg_edit', 'sukses');
            redirect(base_url('kb/index_status/'));
        } else {
            $this->session->set_flashdata('error_msg_edit', 'gagal');
            redirect(base_url('kb/index_status/'));
        }
    }
    public function update_guna_tt_disiapkanpesan($kd_gn, $kd_tt){
        $kd_gn = $this->uri->segment(4);
        $kd_tt = $this->uri->segment(3);
        $this->load->helper('form');
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('kd_gn', 'guna', 'required');
        // $this->form_validation->set_rules('kd_tt', 'tt', 'required');
        // $this->form_validation->set_rules('kd_kls', 'Kelas', 'required');
        // $this->form_validation->set_rules('kd_rm', 'RM', 'required');
        // $this->form_validation->set_rules('status_tt', 'Statustt', 'required');
        // $this->form_validation->set_rules('jns_psn', 'Jenis', 'required');
        // $this->form_validation->set_rules('status_psn', 'Status', 'required');
        // $this->form_validation->set_rules('tgl_msk', 'Masuk', 'required');
        $data['gunattawal'] = $this->kb_model->get_data_tt_dipesan('guna_tt.kd_gn = "'.$kd_gn.'"');
        if ($this->form_validation->run() === FALSE) {
            $data['namatt']     = $this->kb_model->get_tmp_tdr($kd_tt);
            $data['namakelas']  = $this->kb_model->get_kelas($kd_tt);
            $data['penyakit']   = $this->kb_model->get_penyakit();
            $data['pasien']     = $this->kb_model->get_pasien($kd_gn);
            $this->load->view('templates/header');        
            $this->load->view('kb/navBangsal');
            $this->load->view('kb/status/dipesan', $data);
            $this->load->view('templates/footer');
        }
    }
    public function update_disiapkanpesan_dipakai(){
        $addData = $this->kb_model->update_tt_dipesan_disiapkanpesan();
        $addData = $this->kb_model->update_guna_tt_disiapkanpesan_dipakai();
        if ($addData) {
            $this->session->set_flashdata('success_msg_edit', 'sukses');
            redirect(base_url('kb/index_status/'));
        } else {
            $this->session->set_flashdata('error_msg_edit', 'gagal');
            redirect(base_url('kb/index_status/'));
        }
    }
    public function update_guna_tt_disiapkan($kd_tt){
        $kd_tt = $this->uri->segment(3);
        $this->load->helper('form');
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('kd_tt', 'tt', 'required');
        // $this->form_validation->set_rules('kd_kls', 'Kelas', 'required');
        $data['ttkosong'] = $this->kb_model->get_data_tt_disiapkan('tmp_tdr.kd_tt = "'.$kd_tt.'"');
        if ($this->form_validation->run() === FALSE) {
            $data['namatt']     = $this->kb_model->get_tmp_tdr($kd_tt);
            $data['namakelas']  = $this->kb_model->get_kelas($kd_tt);
            $this->load->view('templates/header');        
            $this->load->view('kb/navBangsal');
            $this->load->view('kb/status/disiapkan', $data);
            $this->load->view('templates/footer');
        }
    }
    public function update_disiapkan_kosong(){
        $addData = $this->kb_model->update_tt_disiapkan_kosong();
        if ($addData) {
            $this->session->set_flashdata('success_msg_edit', 'sukses');
            redirect(base_url('kb/index_status/'));
        } else {
            $this->session->set_flashdata('error_msg_edit', 'gagal');
            redirect(base_url('kb/index_status/'));
        }
    }
    public function update_guna_tt_kosong($kd_tt){
        $kd_tt = $this->uri->segment(3);
        $this->load->helper('form');
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('kd_tt', 'tt', 'required');
        // $this->form_validation->set_rules('kd_kls', 'Kelas', 'required');
        $data['ttkosong'] = $this->kb_model->get_data_tt_rusak('tmp_tdr.kd_tt = "'.$kd_tt.'"');
        if ($this->form_validation->run() === FALSE) {
            $data['namatt']     = $this->kb_model->get_tmp_tdr($kd_tt);
            $data['namakelas']  = $this->kb_model->get_kelas($kd_tt);
            $this->load->view('templates/header');        
            $this->load->view('kb/navBangsal');
            $this->load->view('kb/status/kosong', $data);
            $this->load->view('templates/footer');
        }
    }
    public function update_kosong_rusak(){
        $addData = $this->kb_model->update_tt_kosong_rusak();
        if ($addData) {
            $this->session->set_flashdata('success_msg_edit', 'sukses');
            redirect(base_url('kb/index_status/'));
        } else {
            $this->session->set_flashdata('error_msg_edit', 'gagal');
            redirect(base_url('kb/index_status/'));
        }
    }

    // dashboard
    public function index_dashboard(){
        $data['count_tt'] = $this->kb_model->get_status();
        $this->load->view('templates/header');
        $this->load->view('kb/navBangsal');
        $this->load->view('kb/dashboard/index', $data);
        $this->load->view('templates/footer');
    }
    public function detail_dashboard($kd_bgs){
        $data['status'] = $this->kb_model->get_detail('tmp_tdr.kd_bgs = "'.$kd_bgs. '" AND guna_tt.status_ttguna = "On"');
        $data['nama'] = $this->kb_model->get_nm_bgs($kd_bgs);
        $where_guna_tt = array('status_ttguna' => 'On');
        $data['guna_tt'] = $this->kb_model->get_guna_tt($where_guna_tt);
        $data['tempat_tidur'] = $this->kb_model->get_tt();
        $where_tt_kosong = array("tmp_tdr.kd_bgs" => $kd_bgs);
        $data['tt_kosong'] = $this->kb_model->get_tt_kosong('tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Kosong" OR tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Rusak" OR tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Diminta"  OR tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Dipakai" OR tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Disiapkan (Pesan)" OR tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Dipesan" OR  tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Direncanakan" OR  tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Disiapkan"');
        $this->load->view('templates/header');
        $this->load->view('kb/navBangsal');
        $this->load->view('kb/dashboard/detail', $data);
        $this->load->view('templates/footer');
    }

    // laporan
    public function form_laporan(){ 
        $this->load->helper('form');
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('tgl1', 'tgl1', 'required');
        // $this->form_validation->set_rules('tgl2', 'tgl2', 'required');
        $this->load->view('templates/header');
        $this->load->view('kb/navBangsal');
        $this->load->view('kb/laporan/form');
        $this->load->view('templates/footer');
    }
    public function index_laporan(){
        $data['gunatt'] = $this->kb_model->get_gunatt();
        $data['detail_diagnosa'] =  $this->kb_model->get_data('detail_diagnosa');
        $data['total_diagnosa'] = array();
        $i = 1;
        $data['total_seluruh_diagnosa'] = array();
        foreach ($data['detail_diagnosa'] as $dd) {
            $data['diagnosa1'] = $this->kb_model->get_data_duatabel('penyakit', 'detail_diagnosa', 'penyakit.kd_pyk=detail_diagnosa.diagnosa1', 'kd_gn = "'.$dd['kd_gn'].'"');
            $data['diagnosa2'] = $this->kb_model->get_data_duatabel('penyakit', 'detail_diagnosa', 'penyakit.kd_pyk=detail_diagnosa.diagnosa2', 'kd_gn = "'.$dd['kd_gn'].'"');
            $data['diagnosa3'] = $this->kb_model->get_data_duatabel('penyakit', 'detail_diagnosa', 'penyakit.kd_pyk=detail_diagnosa.diagnosa3', 'kd_gn = "'.$dd['kd_gn'].'"');
            $data['diagnosa4'] = $this->kb_model->get_data_duatabel('penyakit', 'detail_diagnosa', 'penyakit.kd_pyk=detail_diagnosa.diagnosa4', 'kd_gn = "'.$dd['kd_gn'].'"');
            foreach ($data['diagnosa1'] as $d1) {
               $diagnosa1 = $d1['nm_pyk'];
           }
           foreach ($data['diagnosa2'] as $d2) {
               $diagnosa2 = $d2['nm_pyk'];
           }
           foreach ($data['diagnosa3'] as $d3) {
               $diagnosa3 = $d3['nm_pyk'];
           }
           foreach ($data['diagnosa4'] as $d4) {
            $diagnosa4 = $d4['nm_pyk'];
        }
        array_push($data['total_diagnosa'], $diagnosa1, $diagnosa2, $diagnosa3, $diagnosa4);
        array_push($data['total_seluruh_diagnosa'], $data['total_diagnosa']);
        $i++;
    }
    $this->load->view('templates/header');
    $this->load->view('kb/navBangsal');
    $this->load->view('kb/laporan/index', $data);
    $this->load->view('templates/footer');
    }
}
?>