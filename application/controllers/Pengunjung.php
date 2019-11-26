<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengunjung extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->model('pengunjung_model');
    }

    public function index(){
        $data['count_tt'] = $this->pengunjung_model->get_status();
        $this->load->view('templates/header');
        $this->load->view('pengunjung', $data);
        $this->load->view('templates/footer');
    }
    public function detail($kd_bgs){
        $data['status'] = $this->pengunjung_model->get_detail('tmp_tdr.kd_bgs = "'.$kd_bgs. '" AND guna_tt.status_ttguna = "On"');
        $data['nama'] = $this->pengunjung_model->get_nm_bgs($kd_bgs);
        $where_guna_tt = array('status_ttguna' => 'On');
        $data['guna_tt'] = $this->pengunjung_model->get_guna_tt($where_guna_tt);
        $data['tempat_tidur'] = $this->pengunjung_model->get_tt();
        $where_tt_kosong = array("tmp_tdr.kd_bgs" => $kd_bgs);
        $data['tt_kosong'] = $this->pengunjung_model->get_tt_kosong('tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Kosong" OR tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Rusak" OR tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Diminta"  OR tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Dipakai" OR tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Disiapkan (Pesan)" OR tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Dipesan" OR  tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Direncanakan" OR  tmp_tdr.kd_bgs = "'.$kd_bgs.'" AND tmp_tdr.status_tt = "Disiapkan"');
        $this->load->view('templates/header');
        $this->load->view('detail', $data);
        $this->load->view('templates/footer');
    }
}