<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		// $this->load->model('Settings_m');
		
	}
	

	public function index()
	{
		$data['title'] = 'Pengaturan';
		$data['company_profile'] = true;
		$data['content'] = 'backend/company_profile';
		$this->load->view('backend/index', $data);
	}
	public function editCompanyProfile()
	{
		$data = [
			'value'=>$this->input->post('value', true),
			"updated_at" => get_dateTime(),
			"updated_by" => user()['idusers']
		];
		$this->db->where('id', $this->input->post('id', true));
		$this->db->update('settings', $data);
		$this->toastr->success('Setting Value Updated');
		redirect('settings');
	}
	/**
	* View By Id
	* @return Array
	*/
	public function view()
	{
		$id = $this->input->post('id', true);
		$data = $this->db->get_where('settings',['id'=>$id])->row();
		echo json_encode($data);
	}
}

/* End of file Settings.php */
