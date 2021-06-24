<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Golongan extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Pegawai_m');
		
	}

	public function index()
	{
		$data['title'] = 'Golongan';
		$data['golongan'] = $data['allgolongan'] = true;
		$data['content']= 'backend/golongan';
		$this->load->view('backend/index', $data);

	}
	public function addNew()
	{
		$this->db->insert('golongan', $this->data());
		$this->toasrtr->succes('Created Successfully');
		redirect('golongan');
	}
	public function ubah()
	{
		$data = [
			"golongan"=>$this->input->post('golongan', true),
			"gaji_pokok"=>$this->input->post('gaji_pokok', true),
			"korpri"=>$this->input->post('korpri', true),
			"kristiani"=>$this->input->post('kristiani', true),
			"muslim"=>$this->input->post('muslim', true),
			"dh_wanita"=>$this->input->post('dh_wanita', true),
			"update_at"=>get_dateTime(),
			"update_by"=>user()['idusers']
		];
		$this->db->where('idgolongan', $this->input->post('idgolongan', true));
		$this->db->update('golongan', $data);
	}
		/**
	* Data Golongan
	* @return Array
	*/
	private function data() {
		return [
			'golongan'=>$this->input->post('golongan', true),
			'gaji_pokok'=>$this->input->post('gaji_pokok', true),
			'korpri'=>$this->input->post('korpri', true),
			'kristiani'=>$this->input->post('kristiani', true),
			'muslim'=>$this->input->post('muslim', true),
			'dh_wanita'=>$this->input->post('dh_wanita', true),
			'create_at'=>get_dateTime(),
			'create_by'=>user()['idusers']
		];
	}

	/**
	* View By Id
	* @return Array
	*/
	public function view()
	{
		$id = $this->input->post('id', true);
		$data = $this->db->get_where('golongan',['idgolongan'=>$id])->row();
		echo json_encode($data);
	}

	/**
	* Delete Golongan By ID
	* @return Boolean
	*/
	public function delete()
	{
		$id = $this->input->post('id');
		for ($i=0; $i < count($id); $i++) { 
			$this->Pegawai_m->delete_permanenGolongan($id[$i]);
		}
	}
}	

/* End of file Golongan.php */