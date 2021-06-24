<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_m');
		
	}
	

	public function index()
	{
		$data['title'] = 'Masuk';
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('login', $data);
		} else {
			$this->_login();
		}
		
	}
	private function _login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->db->get_where('users', ['user_name'=>$username])->row_array();
		if($user){
			if($user['is_active'] == 1){
				if($user['is_block'] == 0){
					if(password_verify($password, $user['user_password'])){
						$data = [
							'email' => $user['user_email'],
							'username' => $user['user_name'],
							'access' => $user['user_type']
						];
						$this->session->set_userdata($data);
						$this->User_m->updateLogin($user['idusers']);
						
						redirect('dashboard','refresh');
						// if($user['user_type']!= 'customer'){
						// 	redirect('dashboard');
						// }else{
						// 	redirect('user');
						// }
					}else{
						$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-ban"></i> Password anda salah.</div>');
						redirect('auth');
					}
				}else{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-ban"></i> Akun anda diblok.</div>');
					redirect('auth');
				}
			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-ban"></i> Akun anda sudah tidak aktif.</div>');
				redirect('auth');
			}
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-ban"></i> Username tidak terdaftar.</div>');
			redirect('auth');
		}
	}
	public function register()
	{
		$data['title'] = 'Buat Akun';
		$this->form_validation->set_rules('fullname', 'Fullname', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.user_email]');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[20]|is_unique[users.user_name]');
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|max_length[25]|matches[password2]');
		$this->form_validation->set_rules('password2', 'Confirm password', 'trim|required|min_length[3]|max_length[25]|matches[password2]');
		
		
		if ($this->form_validation->run() == TRUE) {
			$this->User_m->register();
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Create account successfuly.</div>');
			redirect('auth');
		} else {
			$this->load->view('register',$data);
		}
		
	}
	public function logout()
	{
		// $user = user()['username'];
		// $this->LogActivity_m->logKeluar($user);
		$this->session->sess_destroy();
		redirect('auth','refresh');
	}

}

/* End of file Auth.php */