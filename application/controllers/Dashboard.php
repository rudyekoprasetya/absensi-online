<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['judul'] = 'Dashboard Absensi';
        $this->template->display('welcome_message', $data);
    }

}
