<?php
class M_login extends CI_Model{

	function __construct() {
		parent::__construct();
	}


	function validate(){
		$post = $this->input->post();

		$this->db->select('u.*, a.id as admin_id, u.id as user_id')
			->from('admin a')
			->join('users u', 'a.user_id = u.id')
			->where('u.email', htmlspecialchars($post['email']))
			->where('u.password', htmlspecialchars($post['password']));
		$result = $this->db->get();
		if($result->num_rows() > 0){

			$session = array(
				'fname'=>$result->result()[0]->first_name,
				'lname'=> $result->result()[0]->last_name,
				'id'=>$result->result()[0]->user_id,
			);

			$this->session->set_userdata($session);
			echo json_encode('success');
		}else{
			echo json_encode('error');
		}
	}

}
