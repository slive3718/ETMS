<?php
class M_login extends CI_Model{

	function __construct() {
		parent::__construct();
	}


	function validate(){
		$post = $this->input->post();

		$this->db->select('*')
			->from('super_admin ')
			->where('email', htmlspecialchars($post['email']))
			->where('password', htmlspecialchars($post['password']));
		$result = $this->db->get();
		if($result->num_rows() > 0){

			$session = array(
				'username'=>$result->result()[0]->username,
				'email'=>$result->result()[0]->email,
				'id'=>$result->result()[0]->id,
			);

			$this->session->set_userdata($session);
			echo json_encode('success');
		}else{
			echo json_encode('error');
		}
	}

}
