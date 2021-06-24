<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_m extends CI_Model {

	public function delete_permanen($id)
	{
		$this->db->delete('pegawai', ['idpegawai'=>$id]);
	}
	public function delete_permanenGolongan($id)
	{
		$this->db->delete('golongan', ['idgolongan'=>$id]);
	}
}

/* End of file Pegawai_m.php */
