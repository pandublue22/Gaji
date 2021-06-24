<?php defined('BASEPATH') or exit('No direct script access allowed');


/**
* Get User
*/
if (!function_exists('user')){
	function user(){
		$CI =& get_instance();
		$sql = "select * from users where user_email='".$CI->session->userdata('email')."'";
		return $CI->db->query($sql)->row_array();
	}
}
/**
* Get Settings Value
*/
if (! function_exists('settings')) {
	function settings($group='',$var='') {
		$ci = & get_instance();
		if($var!=null || $var!=''){
			$query = $ci->db->query("SELECT * FROM settings WHERE `group`='$group' AND variable='$var'")->row_array();
			if($query['value']!=null || $query['value']!=''){
				return $query['value'];
			}else{
				return $query['default'];
			}
		}else{
			return $ci->db->query("SELECT * FROM settings WHERE `group`='$group' ORDER BY id ASC")->result_array();
		}
	}
}
/**
* Get Produk
*/
if (!function_exists('produk')){
	function produk($id=null,$stok=null,$limit=null){
		$CI =& get_instance();
		if($id!=null){
			return $CI->db->get_where('product',['idproduct'=>$id])->row_array();
		}else{
			if($stok!=null){
				$CI->db->order_by('idproduct', 'desc');
				return $CI->db->get_where('product',['stok<='=>$stok])->result_array();
			}else{
				if($limit!=null){
					$CI->db->limit($limit);
					$CI->db->order_by('idproduct', 'desc');
					return $CI->db->get('product')->result_array();
				}else{
					$CI->db->order_by('idproduct', 'desc');
					return $CI->db->get('product')->result_array();
				}
			}
		}
	}
}
/**
* Get Gaji
*/
if (!function_exists('gaji')){
	function gaji(){
		$CI =& get_instance();
		$CI->db->join('pegawai', 'gaji.pegawai_id = pegawai.idpegawai', 'left');
		$CI->db->join('golongan', 'gaji.golongan_id = golongan.idgolongan', 'left');
		return $CI->db->get('gaji')->result_array();
		
		// $sql = "SELECT * FROM gaji,`pegawai`,`golongan` WHERE gaji.pegawai_id=`pegawai`.idpegawai AND gaji.golongan_id=`golongan`.idgolongan";
		// // $CI->db->order_by('idgaji', 'asc');
		// return $CI->db->query($sql)->result_array();
	}
}
/**
* Get Pengguna
*/
if (!function_exists('pengguna')){
	function pengguna(){
		$CI =& get_instance();
		$CI->db->order_by('idusers', 'asc');
		return $CI->db->get('users')->result_array();
	}
}
/**
* Get Pegawai
*/
if (!function_exists('pegawai')){
	function pegawai(){
		$CI =& get_instance();
		$CI->db->order_by('idpegawai', 'asc');
		return $CI->db->get('pegawai')->result_array();
	}
}
/**
* Get Golongan
*/
if (!function_exists('golongan')){
	function golongan(){
		$CI =& get_instance();
		$CI->db->order_by('idgolongan', 'asc');
		return $CI->db->get('golongan')->result_array();
	}
}
/**
* Get Produk Image
*/
if (!function_exists('produk_gambar')){
	function produk_gambar($id=null){
		$CI =& get_instance();
		if($id!=null){
			$CI->db->order_by('idImage', 'asc');
			return $CI->db->get_where('product_image',['product_id'=>$id])->result();
		}else{
			$CI->db->order_by('idImage', 'asc');
			return $CI->db->get('product_image')->result();
		}
	}
}
if (! function_exists('timezone_list')) {
	function timezone_list() {
		static $regions = array(DateTimeZone::ASIA);
		$timezones = array();
		foreach( $regions as $region ) {
			$timezones = array_merge($timezones, DateTimeZone::listIdentifiers($region));
		}
		$timezone_offsets = array();
		foreach($timezones as $timezone) {
			$tz = new DateTimeZone($timezone);
			$timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
		}
		asort($timezone_offsets);
		$timezone_list = array();
		foreach( $timezone_offsets as $timezone => $offset ) {
			$offset_prefix = $offset < 0 ? '-' : '+';
			$offset_formatted = gmdate( 'H:i', abs($offset) );
			$pretty_offset = "UTC${offset_prefix}${offset_formatted}";
			$timezone_list[$timezone] = "(${pretty_offset}) $timezone";
		}
		return $timezone_list;
	}
}