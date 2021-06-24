<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gaji extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Gaji_m');
		
	}
	

	public function index()
	{
		$data['title'] = 'Daftar Semua Gaji';
		$data['gaji'] = true;
		$data['harga_lembur'] = 25000;
		$data['content'] = 'backend/gaji';
		$this->load->view('backend/index', $data);
	}
	public function detail($id)
	{
		$data['title'] = 'Detail Gaji';
		$data['detail'] = $this->Gaji_m->gajiById($id);
		$data['content'] = 'backend/detailgaji';
		$this->load->view('backend/index', $data);
	}
	public function addNew()
	{
		$this->db->insert('gaji', $this->data());
		$this->toastr->success('Created Successfully');
		redirect('gaji');
		
	}
	public function ubah()
	{
		$data = [
			'pegawai_id'=>$this->input->post('pegawai_id', true),
			'golongan_id'=>$this->input->post('golongan_id', true),
			'tanggal'=>$this->input->post('tanggal', true),
			'potongan'=>delMask($this->input->post('potongan', true)),
			'tunjangan'=>delMask($this->input->post('tunjangan', true)),
			'gaji_bersih'=>$this->input->post('gaji_bersih', true),
			'update_at'=>get_dateTime(),
			'update_by'=>user()['idusers']
		];
		$this->db->where('idgaji', $this->input->post('idgaji', true));
		$this->db->update('gaji', $data);
	}
	/**
	* Data Gaji
	* @return Array
	*/
	private function data() {
		return [
			'pegawai_id'=>$this->input->post('pegawai_id', true),
			'golongan_id'=>$this->input->post('golongan_id', true),
			'tanggal'=>$this->input->post('tanggal', true),
			'potongan'=>delMask($this->input->post('potongan', true)),
			'jam_lembur'=>delMask($this->input->post('lembur', true)),
			'uang_lembur'=>delMask($this->input->post('uang_lembur', true)),
			'tunjangan'=>delMask($this->input->post('tunjangan', true)),
			'gaji_bersih'=>delMask($this->input->post('gaji_bersih', true)),
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
		$this->db->join('pegawai', 'gaji.pegawai_id = pegawai.idpegawai', 'left');
		$this->db->join('golongan', 'gaji.golongan_id = golongan.idgolongan', 'left');
		$data = $this->db->get_where('gaji',['idgaji'=>$id])->row();
		// $sql = "SELECT * FROM gaji,pegawai,golongan WHERE gaji.pegawai_id=pegawai.idpegawai AND gaji.golongan_id=golongan.idgolongan AND pegawai.idpegawai=$id";
		// $data = $this->db->query($sql)->row();
		echo json_encode($data);
	}
	/**
	* View By Id
	* @return Array
	*/
	public function viewPegawai()
	{
		$id = $this->input->post('id', true);
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
			$this->Gaji_m->delete_permanen($id[$i]);
		}
	}
}

/* End of file Gaji.php */
