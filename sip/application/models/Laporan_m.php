<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_m extends CI_Model {

	
	function cetakLaporan($tgl,$tgl_akhir,$nip,$nama,$golongan){
		if($sts_bayar!='semua' && $sts_kirim=='semua'){
			$sql = "SELECT * FROM user,pesanan WHERE user.id=pesanan.user_id AND pesanan.tanggal BETWEEN '".$tgl."' AND '".$tgl_akhir."' AND pesanan.status_bayar='".$sts_bayar."'";
		}elseif($sts_kirim!='semua' && $sts_bayar=='semua'){
			$sql = "SELECT user.nama,user.telp,user.alamat,pesanan.* FROM user,pesanan WHERE user.id=pesanan.user_id AND pesanan.tanggal BETWEEN '".$tgl."' AND '".$tgl_akhir."' AND pesanan.status_kirim='".$sts_kirim."'";
		}elseif($sts_kirim!='semua' && $sts_bayar!='semua'){
			$sql = "SELECT user.nama,user.telp,user.alamat,pesanan.* FROM user,pesanan WHERE user.id=pesanan.user_id AND pesanan.tanggal BETWEEN '".$tgl."' AND '".$tgl_akhir."' AND pesanan.status_bayar='".$sts_bayar."' AND pesanan.status_kirim='".$sts_kirim."'";
		}else{
			$sql = "SELECT user.nama,user.telp,user.alamat,pesanan.* FROM user,pesanan WHERE user.id=pesanan.user_id AND pesanan.tanggal BETWEEN '".$tgl."' AND '".$tgl_akhir."'";
		}
		return $this->db->query($sql)->result();
	}
	function cetak($tgl,$tgl_akhir,$nip,$nama,$golongan){
		$this->db->join('pegawai', 'gaji.pegawai_id = pegawai.idpegawai', 'left');
		$this->db->join('golongan', 'gaji.golongan_id = golongan.idgolongan', 'left');
		// $this->db->where("gaji.tanggal BETWEEN $tgl AND $tgl_akhir");
		// $where=[];
		// if($tgl!='' && $tgl_akhir!='')
		// $where['gaji.tanggal>=']=$tgl;
		// $where['gaji.tanggal<=']=$tgl_akhir;
		// if($nip!='')
		// $where['pegawai.nip']=$nip;
		// if($nama!='')
		// $where['pegawai.nama']=$nama;
		// if($golongan!='')
		// $where['gaji.golongan_id']=$golongan;
		
		if($tgl!='' && $tgl_akhir!=''){
		$this->db->where('gaji.tanggal>=',$tgl);
		$this->db->where('gaji.tanggal<=',$tgl_akhir);
		}
		if($nip!=''){
		$this->db->or_like('pegawai.nip',$nip);
		}
		if($nama!=''){
		$this->db->or_like('pegawai.nama',$nama);
		}
		if($golongan!=''){
		$this->db->where('gaji.golongan_id', $golongan);
		}
		
		// return $this->db->get_where('gaji',$where)->result();
		return $this->db->get('gaji')->result();
	}
}

/* End of file Laporan_m.php */