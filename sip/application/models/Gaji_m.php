<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gaji_m extends CI_Model {

	public function delete_permanen($id)
	{
		$this->db->delete('gaji', ['idgaji'=>$id]);
	}
	public function getGaji(){
		$this->db->join('pegawai', 'gaji.pegawai_id = pegawai.idpegawai', 'left');
		$this->db->join('golongan', 'gaji.golongan_id = golongan.idgolongan', 'left');
		$this->db->limit(5);
		return $this->db->get('gaji')->result_array();
	}
	public function gajiById($id){
		$this->db->join('pegawai', 'gaji.pegawai_id = pegawai.idpegawai', 'left');
		$this->db->join('golongan', 'gaji.golongan_id = golongan.idgolongan', 'left');
		return $this->db->get_where('gaji',['idgaji'=>$id])->row();
	}
}

/* End of file Gaji_m.php */