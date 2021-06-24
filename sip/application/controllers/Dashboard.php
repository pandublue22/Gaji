<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Gaji_m');
		
	}

	public function index()
	{
		$data['title'] = 'Hai, <b>'.user()['user_fullname'].'</b>. Selamat Datang Kembali';
		$data['gajian'] = $this->Gaji_m->getGaji();
		$data['content'] = 'backend/home';
		$this->load->view('backend/index', $data);
	}

}

/* End of file Dashboard.php */
