<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {redirect('login','refresh');}//user harus login
        //load model
        $this->load->model('Model_absensi');
    }

    public function index() {
        $data['judul'] = 'Dashboard Absensi';
        $data['user'] = $this->Model_absensi->total_rows('tb_user');
        $data['absensi'] = $this->Model_absensi->total_rows('tb_absensi');
        $data['izin'] = $this->Model_absensi->total_rows('tb_izin');
        $this->template->display('depan', $data);
    }

}
