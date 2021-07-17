<?php
class M_login extends CI_Model{

	function __construct() {
		parent::__construct();
	}


	function validate(){
		$post = $this->input->post();
		$this->db->select('*')
			->from('users u')
//			->join('account_type at', 'u.account_type=at.id', 'left')
//			->where('at.name', 'manager')
			->where('u.email', htmlspecialchars($post['email']));

		$result = $this->db->get();
		if($result->num_rows() > 0){
			if(password_verify($post['password'], $result->result()[0]->password)){
				$session = array(
					'email'=>$result->result()[0]->email,
					'uid'=>$result->result()[0]->id,
					'first_name'=>$result->result()[0]->first_name,
//				'account_type'=>$result->result()[0]->user_account_type
				);


				$this->session->set_userdata($session);
				echo json_encode('success');
			}else{
				echo json_encode('error');
			}

		}else{
			echo json_encode('error');
		}
	}

}
