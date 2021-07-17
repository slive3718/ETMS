<?php
class M_users extends CI_Model{

	function __construct() {
		parent::__construct();
	}


	 function getUserList(){
		$this->db->select('u.*, at.name as user_account_type')
		 	->from('users u')
			->join('account_type at', 'u.account_type=at.id', 'left')
			->join('deleted_users du', 'u.id=du.user_id', 'left')
			->where('du.user_id', null)
		;
		$ret = $this->db->get();
		if ($ret->num_rows() > 0){
			echo json_encode($ret->result_array());
		}else{
			echo json_encode(json_last_error());
		}
	}

	function addUser(){
		$post = $this->input->post();

		if($this->check_existing_email($post['email'])){
			echo json_encode('duplicate');
			exit;
		}
		$field_set = array(
			'first_name'=>$post['first_name'],
			'last_name'=>$post['last_name'],
			'middle_name'=>$post['middle_name'],
			'email'=>$post['email'],
			'password'=>password_hash($post['password'], PASSWORD_DEFAULT),
			'city'=>$post['city'],
			'province'=>$post['province'],
			'country'=>$post['country'],
			'contact_number'=>$post['contact'],
			'status'=>$post['status'],
			'account_type'=>$post['account_type']
		);
		$result = $this->db->insert('users', $field_set);
		if ($this->db->affected_rows() > 0){
			echo json_encode('success');
		}else{
			echo json_encode(json_last_error());
		}
	}

	function check_existing_email($email){
		$this->db->select('*')
			->from('users')
			->where('email', $email);
		$duplicate = $this->db->get();
		if($duplicate->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	function getUserById(){
		$id = $this->input->post('id');

		$this->db->select('*')
			->from('users')
			->where('id', $id);
		$user = $this->db->get();
		if($user->num_rows() > 0){
			echo json_encode($user->result_array()[0]);
		}else{
			echo json_encode(json_last_error());
		}
	}

	function updateUserData(){
		$post = $this->input->post();

		$field_set = array(
			'first_name'=>$post['first_name'],
			'last_name'=>$post['last_name'],
			'middle_name'=>$post['middle_name'],
			'city'=>$post['city'],
			'province'=>$post['province'],
			'country'=>$post['country'],
			'contact_number'=>$post['contact'],
			'status'=>$post['status'],
			'account_type'=>$post['account_type']
		);

//		if(isset($post['email']) && ($post['email'] !=='')){
//			if($this->check_existing_email($post['email'])){
//				echo json_encode('duplicate');
//				exit;
//			}else{
//				$field_set = array('email'=>($post['email']));
//			}
//		}

		if(isset($post['password']) && $post['password'] !== ''){
			$field_set = array('password'=>(password_hash($post['password'], PASSWORD_DEFAULT)));
		}

		$this->db->update('users', $field_set, array('id'=>$post['user_id']));

		if($this->db->affected_rows()>0){
			echo json_encode('success');
		}else{
			json_encode('error');
		}
	}

	function addToDeletedUsers(){
		$post = $this->input->post();

		if($this->checkDeletedUserExist($post['user_id'])){
			echo json_encode('exist');
			exit;
		}

		$this->db->insert('deleted_users', array('user_id'=>$post['user_id']));
		if($this->db->affected_rows()>0){
			echo json_encode('success');
		}
	}

	function checkDeletedUserExist($user_id){
		$this->db->select('*')
			->from('deleted_users')
			->where('user_id', $user_id)
			;
		$exist = $this->db->get();
		if($exist->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
}
