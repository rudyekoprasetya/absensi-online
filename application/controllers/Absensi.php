<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {redirect('login','refresh');}//user harus login
        //load model
        $this->load->model('Model_absensi');
    }

    public function index() {
        $data['judul'] = 'Dashboard Absensi';
        $email=$this->session->userdata('email');
        $data['tipe'] = $this->Model_absensi->get_all('tb_tipe')->result();
        $data['status'] = $this->Model_absensi->get_all('tb_status')->result();
        $data['user']=$this->Model_absensi->get_where('tb_user',array('email'=>$email))->result();
        $this->template->display('absen', $data);
    }

}
