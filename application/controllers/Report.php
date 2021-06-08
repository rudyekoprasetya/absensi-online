<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {redirect('login','refresh');}//user harus login
        //load model
        $this->load->model('Model_absensi');
    }

    public function index() {
        $data['judul'] = 'Report Absensi';
        $data['user'] = $this->Model_absensi->get_all('tb_user');
        $this->template->display('report_absen', $data);
    }

}