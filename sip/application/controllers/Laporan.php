<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Gaji_m');
		$this->load->model('Laporan_m');
		
	}

	public function index()
	{
		$data['title'] = 'Laporan Gaji';
		$data['laporan'] = true;
		$data['gajian'] = $this->Gaji_m->getGaji();
		$data['content'] = 'backend/laporan';
		$this->load->view('backend/index', $data);
	}
	public function cetak()
	{
		$tgl = $this->input->post('tgl', true);
		$nip = $this->input->post('nip', true);
		$nama = $this->input->post('nama', true);
		$golongan = $this->input->post('golongan_id', true);
		// var_dump($tgl);
		// var_dump($tgl_akhir);
		// var_dump($nip);
		// var_dump($nama);
		// var_dump($golongan);die;
		$data['data'] = $this->Laporan_m->cetak($tgl, $nip, $nama,$golongan);
		// var_dump($data['data']);die;
		$data['title'] = "Sistem Informasi Penggajian";
		$this->load->view('backend/cetak_laporan', $data);
	
		
	}

	

}

/* End of file Laporan.php */