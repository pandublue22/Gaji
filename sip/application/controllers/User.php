<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('User_m');
		
	}
	

	public function index()
	{	
		$idorder = $this->db->get_where('pesanan',['user_id'=>user()['idusers']])->row();
		// var_dump($idorder->idorder);die;
		if($idorder){
		$data['totalorder']=count($this->db->get_where('pesanan',['user_id'=>user()['idusers']])->result());
		$data['totalordered']=count($this->db->get_where('pesanan',['user_id'=>user()['idusers'],'status'=>'selesai'])->result());
		$data['totalbeli']=count($this->db->get_where('detail_order',['order_id'=>$idorder->idorder])->result());
		}else{
			$data['totalorder']=0;
			$data['totalordered']=0;
			$data['totalbeli']=0;
		}// var_dump($data['barangbeli']);die;
		$data['profil']=$this->db->get_where('user_profile',['users_id'=>user()['idusers']])->row();
		$data['content'] = 'themes/'.theme_active().'/user_profil';
		$this->load->view('themes/'.theme_active().'/index',$data);
	}
	public function alluser()
	{
		$data['title'] = 'Semua Pengguna';
		$data['users'] = $data['allusers'] = true;
		$data['alluser'] = $this->db->get('users')->result_array();
		$data['content'] = 'backend/alluser';
		$this->load->view('backend/index', $data);
	}
	public function usergroup()
	{
		$data['title'] = 'All Group';
		$data['users'] = $data['usersgroup'] = true;
		$data['usergroup'] = $this->db->get('user_group')->result_array();
		$data['content'] = 'backend/usergroup';
		$this->load->view('backend/index', $data);
	}
	public function useraccess()
	{
		$data['title'] = 'All Access';
		$data['users'] = $data['usersaccess'] = true;
		$data['alluser'] = $this->db->get('users')->result_array();
		$data['content'] = 'backend/alluser';
		$this->load->view('backend/index', $data);
	}
	public function add()
	{
		$data = [
			'users_id'=>$this->input->post('users_id', true),
			'fullname'=>$this->input->post('fullname', true),
			'email'=>$this->input->post('email', true),
			'telp'=>$this->input->post('telp', true),
			'address'=>$this->input->post('address', true),
			'create_at'=>get_dateTime(),
			'create_by'=>user()['idusers']
		];
		$this->db->insert('user_profile', $data);
		redirect('user');
	}
	public function addTestimoni()
	{
		$data = [
			'user_id'=>$this->input->post('user_id', true),
			'name'=>$this->input->post('nama', true),
			'email'=>$this->input->post('email', true),
			'job'=>$this->input->post('job', true),
			'message'=>$this->input->post('message', true),
			'create_at'=>get_dateTime(),
			'create_by'=>user()['idusers']
		];
		$this->db->insert('testimonial', $data);
		redirect('public/testimoni');
	}
	public function editTestimoni()
	{
		$data = [
			'name'=>$this->input->post('nama', true),
			'email'=>$this->input->post('email', true),
			'job'=>$this->input->post('job', true),
			'message'=>$this->input->post('message', true),
			'status'=>'No',
			'update_at'=>get_dateTime(),
			'update_by'=>user()['idusers']
		];
		$this->db->where('user_id', $this->input->post('user_id', true));
		$this->db->update('testimonial', $data);
		redirect('public/testimoni');
	}
	public function addNewUser(){
		// $this->User_m->register();
		$data = [
			'user_name' => htmlspecialchars($this->input->post('user_name', true)),
			'user_password' => password_hash(htmlspecialchars($this->input->post('user_password', true)), PASSWORD_DEFAULT),
			'user_fullname' => htmlspecialchars($this->input->post('user_fullname', true)),
			'user_email' => htmlspecialchars($this->input->post('user_email', true)),
			'user_type' => htmlspecialchars($this->input->post('user_type', true)),
			'is_active' => 1,
			'is_block' => 0,
			'create_at' => get_dateTime(),
			'create_by' => user()['idusers']
		];
		$this->db->insert('users', $data);
		$this->toastr->success('Created Successfully');
		redirect('user/alluser');
	}
	public function updateUser()
	{
		if($this->input->post('idusers', true)==1){
			$user_type = 'super_user';
		}else{
			$user_type = htmlspecialchars($this->input->post('user_type', true));
		}
		$data = [
			'user_name' => htmlspecialchars($this->input->post('user_name', true)),
			'user_fullname' => htmlspecialchars($this->input->post('user_fullname', true)),
			'user_email' => htmlspecialchars($this->input->post('user_email', true)),
			'user_type' => $user_type,
			"update_at"=>get_dateTime(),
			"update_by"=>user()['idusers']
		];
		$this->db->where('idusers', $this->input->post('idusers', true));
		$this->db->update('users', $data);
	}
	public function changepassword()
	{
		$data = [
			"user_password"=>password_hash(htmlspecialchars($this->input->post('user_password', true)), PASSWORD_DEFAULT),
			"update_at"=>get_dateTime(),
			"update_by"=>user()['idusers']
		];
		$this->db->where('idusers', $this->input->post('idusers', true));
		$this->db->update('users', $data);
		$this->toastr->success('Change Password Successfully');
		redirect('user/alluser');
	}
	public function proses_order()
	{
		//-------------------------Input data order------------------------------
		$data_order = array('datetime' => get_dateTime(),
							'user_id' => user()['idusers'],
							'total_harga' => $this->cart->total(),
							'status_bayar' => 'belum lunas',
							'status' => 'pembayaran pending',
							'create_at'=>get_dateTime(),
							'create_by'=>user()['idusers']
						);
							// var_dump($data_order);die;
		$id_order = $this->User_m->tambah_order($data_order);
		//-------------------------Input data pembayaran------------------------------
		$data_bayar = array('order_id' => $id_order,
							'user_id' => user()['idusers'],
							'file' => '',
							'total' => 0,
							'status' => 'pending',
							'keterangan' => ''
						);
							// var_dump($data_order);die;
		$id_bayar = $this->User_m->tambah_bayar($data_bayar);
		//-------------------------Input data detail order-----------------------		
		if ($cart = $this->cart->contents())
			{
				foreach ($cart as $item)
					{
						$data_detail = array(
							'product_id' => $item['id'],
							'order_id' =>$id_order,
							'qty' => $item['qty'],
							'harga' => $item['price'],			
							'satuan' => $item['satuan'],			
							'berat' => $item['berat'],
							'create_at'=>get_dateTime(),
							'create_by'=>user()['idusers']			
						);
						$proses = $this->User_m->tambah_detail_order($data_detail);
					}
			}
		//-------------------------Hapus shopping cart--------------------------		
		$this->cart->destroy();
		
		redirect(base_url('user'),'refresh');
		
	}
	/**
	* View By Id
	* @return Array
	*/
	public function view()
	{
		$id = $this->input->post('id', true);
		$data = $this->db->get_where('users',['idusers'=>$id])->row();
		echo json_encode($data);
	}
	/**
	* Blocked By ID
	* @return Boolean
	*/
	public function block()
	{
		if($this->input->post('id')){
			$id = $this->input->post('id');
			for ($i=0; $i < count($id); $i++) { 
				$this->User_m->blocked($id[$i]);
			}
		}
	}
	/**
	* Unblocked By ID
	* @return Boolean
	*/
	public function unblock()
	{
		if($this->input->post('id')){
			$id = $this->input->post('id');
			for ($i=0; $i < count($id); $i++) { 
				$this->User_m->unblocked($id[$i]);
			}
		}
	}
}

/* End of file User.php */
