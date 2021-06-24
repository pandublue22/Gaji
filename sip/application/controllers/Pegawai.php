<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Pegawai_m');
		
	}
	

	public function index()
	{
		$data['title'] = 'Semua Pegawai';
		$data['pegawai'] = $data['allpegawai'] = true;
		$data['content'] = 'backend/pegawai';
		$this->load->view('backend/index', $data);
	}

	public function addNew()
	{
		$this->db->insert('pegawai', $this->data());
		$this->toastr->success('Created Successfully');
		redirect('pegawai');
		
	}

	public function ubah()
	{
		$data = [
			"nip"=>$this->input->post('nip', true),
			"nama"=>$this->input->post('nama', true),
			'golongan_idpeg'=>$this->input->post('golongan_idpeg', true),
			"jk"=>$this->input->post('jk', true),
			"agama"=>$this->input->post('agama', true),
			"telp"=>$this->input->post('telp', true),
			"update_at"=>get_dateTime(),
			"update_by"=>user()['idusers']
		];
		$this->db->where('idpegawai', $this->input->post('idpegawai', true));
		$this->db->update('pegawai', $data);
	}

	/**
	* Data Pegawai
	* @return Array
	*/
	private function data() {
		return [
			'nip'=>$this->input->post('nip', true),
			'nama'=>$this->input->post('nama', true),
			'golongan_idpeg'=>$this->input->post('golongan_idpeg', true),
			'jk'=>$this->input->post('jk', true),
			'agama'=>$this->input->post('agama', true),
			'telp'=>$this->input->post('telp', true),
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
		$this->db->join('golongan', 'pegawai.golongan_idpeg = golongan.idgolongan', 'left');
		$data = $this->db->get_where('pegawai',['idpegawai'=>$id])->row();
		echo json_encode($data);
	}

		/**
	* View Golongan By Id
	* @return Array
	*/
	public function viewGolongan()
	{
		$id = $this->input->post('id', true);
		$data = $this->db->get_where('golongan',['idgolongan'=>$id])->row();
		echo json_encode($data);
	}

	/**
	* Delete By ID
	* @return Boolean
	*/
	public function delete()
	{
		$id = $this->input->post('id');
		for ($i=0; $i < count($id); $i++) { 
			$this->Pegawai_m->delete_permanen($id[$i]);
		}
	}
}

/* End of file Pegawai.php */
