<?php
class Login extends CI_controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model("Model_absensi"); 
		}
	
	public function index() {
		$data['judul']="Absensi Online";
		$this->load->view('view-login',$data);
	}

	public function admin() {
		$data['judul']="Login Admin";
		$this->load->view('login-admin',$data);
	}

	public function cekadmin() {
		$admin=$this->input->post('admin',TRUE);
		$password=$this->input->post('password',TRUE);		
		$cek=$this->Model_absensi->cek_admin($admin,sha1($password));
			if($cek==TRUE) {
				$data_admin=$this->Model_absensi->get_where('tb_admin',array('admin'=>$admin))->row();
				$akses='admin';
				$data=array('admin'=>$admin,'akses'=>$akses,'logged_in'=>TRUE );
				$this->session->set_userdata($data);
				redirect('dashboard');
			} else {			
				$this->session->set_flashdata('alert','User dan Password tidak sesuai!');
				redirect('login/admin','refresh');	
			}	
	}
		
	public function cek() { 
		$email=$this->input->post('email',TRUE);
		$password=$this->input->post('password',TRUE);		
		$cek=$this->Model_absensi->cek($email,sha1($password));
			if($cek==TRUE) {
				$data_admin=$this->Model_absensi->get_where('tb_user',array('email'=>$email))->row();
				$akses='user';
				$data=array('email'=>$email,'akses'=>$akses,'logged_in'=>TRUE );
				$this->session->set_userdata($data);
				redirect('absensi');
			} else {			
				$this->session->set_flashdata('alert','Email dan Password tidak sesuai!');
				redirect('login','refresh');	
			}	
		
	}
		
	public function logout() {
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('akses');
		$this->session->set_flashdata('alert','Berhasil Logout!');
		redirect('login','refresh');
	}

	public function profil() {
		$data['judul']="Ubah Profil";
		$email=$this->session->userdata('email');
		$data['user']=$this->Model_absensi->get_where('tb_user',array('email'=>$email));
		$this->template->display('profil',$data);
	}

	public function ubah_profil() {
		$data=array(
			'email'=>$this->input->post('email',true),
			'password'=>sha1($this->input->post('password',true)),
			'is_aktif'=>"yes"
		);
		$where=array('id_user'=>$this->input->post('id_user',true));
		$this->Model_absensi->update('tb_user', $data, $where);
		$this->session->set_flashdata('alert','Profile Berhasil Diubah!');
		redirect('login/profil');
	}
}
?>