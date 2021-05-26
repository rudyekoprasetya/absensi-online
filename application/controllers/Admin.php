<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //load model
		$this->load->model('Model_absensi');
    }

    public function _crud_output($output = null) {
		$this->template->display('utama.php',$output);
	}

	public function encrypt_password_callback($post_array, $primary_key = null) {
		  $post_array['password'] = sha1($post_array['password']);
		  return $post_array;
	}

	public function jenis() {
		$crud = new grocery_CRUD();
		//pilih tabel
		$crud->set_table('tb_jenis');
		$crud->set_subject('Jenis User');
		$data['judul']='Manajemen Jenis User';
		$data['output']=$crud->render();
		$this->_crud_output($data);
	}

	public function tipe() {
		$crud = new grocery_CRUD();
		//pilih tabel
		$crud->set_table('tb_tipe');
		$crud->set_subject('Tipe Kerja');
		$data['judul']='Manajemen Tipe Kerja';
		$data['output']=$crud->render();
		$this->_crud_output($data);
	}

	public function status() {
		$crud = new grocery_CRUD();
		//pilih tabel
		$crud->set_table('tb_status');
		$crud->set_subject('Status Absen');
		$data['judul']='Manajemen Status';
		$data['output']=$crud->render();
		$this->_crud_output($data);
	}

	public function user() {
		$crud = new grocery_CRUD();
		//pilih tabel
		$crud->set_table('tb_user');
		$crud->set_subject('User');
		//relasi
		$crud->set_relation('id_jenis','tb_jenis','jenis');
		$crud->display_as('id_jenis','Jenis Karyawan');
		$crud->required_fields('email','password','nama','hp','id_jenis');
		//merubah input type password
		$crud->change_field_type('password', 'password');
		//enkripsi password
		$crud->callback_before_insert(array($this,'encrypt_password_callback'));
  		$crud->callback_before_update(array($this,'encrypt_password_callback'));
		$crud->columns('email','nama','gender', 'hp', 'foto', 'is_login');		
		$crud->set_field_upload('foto','assets/uploads/foto_user');
		$data['judul']='Manajemen User';
		$data['output']=$crud->render();
		$this->_crud_output($data);
	}

	public function useractivation() {
		$data['judul'] = 'Aktivasi User';
        $this->template->display('aktivasi_user', $data);
	}

	public function searchuser() {
		$key=$this->input->post('key',true);
		$data['judul'] = 'Aktivasi User';
		$data['user']=$this->Model_absensi->cari_user($key);
		$this->template->display('aktivasi_user',$data);
	}

	public function activated() {
		$id_user=$this->uri->segment(3);
		$aktif=$this->Model_absensi->update('tb_user',array('is_aktif'=>'yes'),array('id_user'=>$id_user));
		$data['judul'] = 'Aktivasi User';
		$this->session->set_flashdata('alert','User sudah diaktfikan!');
        redirect('admin/useractivation');
	}


}