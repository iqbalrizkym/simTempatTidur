<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->model('login_model');
        $this->load->library('session');
    }

    public function index(){
        $this->load->view('login');
    }

    public function proses_login(){
        $user=$this->input->post('username');
        $pass=$this->input->post('password');
        $ceklogin=$this->login_model->login($user, $pass);
        if ($ceklogin) {
            foreach ($ceklogin as $data);
            $this->session->set_userdata('kd_akt', $data->kd_akt);
            $this->session->set_userdata('nm_akt', $data->nm_akt);
            $this->session->set_userdata('username', $data->username);
            $this->session->set_userdata('password', $data->password);
            $this->session->set_userdata('level', $data->level);
            if  ($this->session->userdata('level')=="Petugas Pendaftaran"){
                redirect('pp/index_home');
            } elseif ($this->session->userdata('level')=="Kepala Bangsal"){
                redirect('kb/index_home');
            } elseif ($this->session->userdata('level')=="Petugas Rekam Medik"){
                redirect('prm/index_home');
            } elseif ($this->session->userdata('level')=="Pimpinan"){
                redirect('pimpinan/index_home');
            } 
        } else {
            $data['pesan']="Username atau Password salah";
            $this->load->view('login', $data);
        }
    }
    function logout(){
        $this->session->session_destroy();
        redirect('login/index');
    }
}