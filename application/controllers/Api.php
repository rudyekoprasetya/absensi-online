<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Config CORS
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: *");
		header("Access-Control-Allow-Headers: *");
		header("Content-Type: application/json");
		//load model
		$this->load->model('Model_absensi');
    }

    public function is_key_valid($key)	{
		if ($key == '92d639339020f1b481b4faecb68f15c6ac55cf16') {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function auth() {
		if(isset($_GET['apikey'])) {
			$key=$this->is_key_valid($_GET['apikey']);
			if($key) {
				$email=$this->input->post('email',TRUE);
				$password=$this->input->post('password',TRUE);
				$login=$this->Model_absensi->cek($email,sha1($password));
				if($login) {
					$data_login=$this->Model_absensi->get_where('tb_user',array('email'=>$email,'is_aktif'=>'yes'));
					if($data_login->num_rows() > 0) {
						//update status login
						$is_login=$this->Model_absensi->update('tb_user',array('is_login'=>'yes'),array('email'=>$email));
						$data=array('email'=>$email,'logged_in'=>TRUE );
						$response=array(
							'status' => http_response_code(200),
							'data' => $data					
						);
					} else {
						$response=array(
							'status' => http_response_code(400),
							'data' => 'user not activated'			
						);
					}
					
				} else {
					$response=array(
						'status' => http_response_code(400),
						'data' => 'Bad Request'
					);
				}
			} else {
				$response=array(
					'status' => http_response_code(401),
					'data' => 'Invalid Key'				
				);
			}
		} else {
			$response=array(
					'status' => http_response_code(404),
					'data' => 'No Key Provider'				
				);
		}
		$this->output->set_output(json_encode($response));
	}

	public function logout() {
		if(isset($_GET['apikey'])) {
			$key=$this->is_key_valid($_GET['apikey']);
			if($key) {
				$email=$this->input->post('email',TRUE);
				$is_login=$this->Model_absensi->update('tb_user',array('is_login'=>'no'),array('email'=>$email));
				$data=array('email'=>$email,'logged_in'=>FALSE );
				$response=array(
						'status' => http_response_code(200),
						'data' => $data	
					);
			} else {
				$response=array(
					'status' => http_response_code(401),
					'data' => 'Invalid Key'				
				);
			}
		} else {
			$response=array(
					'status' => http_response_code(404),
					'data' => 'No Key Provider'				
				);
		}
		$this->output->set_output(json_encode($response));
	}

	public function cek_email() {
		if(isset($_GET['apikey'])) {
			$key=$this->is_key_valid($_GET['apikey']);
			if($key) {
				$email=$_GET['email'];
				$cek=$this->Model_absensi->get_where('tb_user',array('email'=>$email));
				if($cek->num_rows()>0) {
					$data=false;
				} else {
					$data=true;
				}
				$response=array(
						'status' => http_response_code(200),
						'data' => $data	
					);
			} else {
				$response=array(
					'status' => http_response_code(401),
					'data' => 'Invalid Key'				
				);
			}
		} else {
			$response=array(
					'status' => http_response_code(404),
					'data' => 'No Key Provider'				
				);
		}
		$this->output->set_output(json_encode($response));
	}

	public function signup() {
		if(isset($_GET['apikey'])) {
			$key=$this->is_key_valid($_GET['apikey']);
			if($key) {
				$data=array(
					'email'=>$this->input->post('email',true),
					'password'=>sha1($this->input->post('password',true)),
					'nama'=>$this->input->post('nama',true),
					'gender'=>$this->input->post('gender',true),
					'alamat'=>$this->input->post('alamat',true),
					'hp'=>$this->input->post('hp',true),
					'id_jenis'=>$this->input->post('id_jenis',true),
					'is_login'=>'no',
					'is_aktif'=>'no'
				);
				$save=$this->Model_absensi->insert('tb_user',$data);
				if($save) {
					$response = array(
					'status' => http_response_code(200),
					'data' => 'Email '.$this->input->post('email',true).' Saved'
					);
				} else {
					$response=array(
						'status' => http_response_code(400),
						'data' => 'Bad Request'
					);
				}
			} else {
				$response=array(
					'status' => http_response_code(401),
					'data' => 'Invalid Key'				
				);
			}
		} else {
			$response=array(
					'status' => http_response_code(404),
					'data' => 'No Key Provider'				
				);
		}
		$this->output->set_output(json_encode($response));
	}

	public function profil() {
		if(isset($_GET['apikey'])) {
			$key=$this->is_key_valid($_GET['apikey']);
			if($key) {
				$email=$_GET['email'];
				$data=$this->Model_absensi->get_where('tb_user',array('email'=>$email))->result();
				$response=array(
						'status' => http_response_code(200),
						'data' => $data	
					);
			} else {
				$response=array(
					'status' => http_response_code(401),
					'data' => 'Invalid Key'				
				);
			}
		} else {
			$response=array(
					'status' => http_response_code(404),
					'data' => 'No Key Provider'				
				);
		}
		$this->output->set_output(json_encode($response));
	}

	public function upload_foto() {
		$name = $this->input->post('id_user',true);

        $filename = NULL;

        $isUploadError = FALSE;
        $fullPath = '';

        if ($_FILES && $_FILES['foto']['name']) {
            $config['upload_path'] = './assets/uploads/foto_user/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 1024;
            $config['overwrite'] = true;
            $config['file_name'] = "imguser_" . $name;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('foto')) {
                $isUploadError = TRUE;
                $response = array(
                    'status' => http_response_code(401),
                    'message' => strip_tags($this->upload->display_errors())
                );
            } else {
                $uploadData = $this->upload->data();
                $fullPath = base_url('assets/uploads/foto_user/' . $uploadData['file_name']);
                $filename = $uploadData['file_name'];
            }
        }

        if (!$isUploadError) {
            $this->Model_absensi->update('tb_user', ["foto" => $filename], ["id_user" => $name]);
            $response = array(
                'status' => http_response_code(200),
                'filePath' => $fullPath
            );
        }

        $this->output->set_output(json_encode($response));
	}

	public function update() {
		if(isset($_GET['apikey'])) {
			$key=$this->is_key_valid($_GET['apikey']);
			if($key) {
				$data=array(
					'nama'=>$this->input->post('nama',true),
					'gender'=>$this->input->post('gender',true),
					'tmp_lahir'=>$this->input->post('tmp_lahir',true),
					'tgl_lahir'=>$this->input->post('tgl_lahir',true),
					'alamat'=>$this->input->post('alamat',true),
					'hp'=>$this->input->post('hp',true)
				);
				$save=$this->Model_absensi->update('tb_user',$data,array('email'=>$this->input->post('email',true)));
				if($save) {
					$response = array(
					'status' => http_response_code(200),
					'data' => 'User '.$this->input->post('email',true).' Updated'
					);
				} else {
					$response=array(
						'status' => http_response_code(400),
						'data' => 'Bad Request'
					);
				}
			} else {
				$response=array(
					'status' => http_response_code(401),
					'data' => 'Invalid Key'				
				);
			}
		} else {
			$response=array(
					'status' => http_response_code(404),
					'data' => 'No Key Provider'				
				);
		}
		$this->output->set_output(json_encode($response));
	}

	public function update_password() {
		if(isset($_GET['apikey'])) {
			$key=$this->is_key_valid($_GET['apikey']);
			if($key) {
				$data=array(
					'password'=>sha1($this->input->post('password',true))
				);
				$save=$this->Model_absensi->update('tb_user',$data,array('email'=>$this->input->post('email',true)));
				if($save) {
					$response = array(
					'status' => http_response_code(200),
					'data' => 'Password User '.$this->input->post('email',true).' Updated'
					);
				} else {
					$response=array(
						'status' => http_response_code(400),
						'data' => 'Bad Request'
					);
				}
			} else {
				$response=array(
					'status' => http_response_code(401),
					'data' => 'Invalid Key'				
				);
			}
		} else {
			$response=array(
					'status' => http_response_code(404),
					'data' => 'No Key Provider'				
				);
		}
		$this->output->set_output(json_encode($response));	
	}













}