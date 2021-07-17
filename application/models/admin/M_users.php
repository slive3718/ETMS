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

	function importUsers(){

		$allowed_column_names = array(
			'A'=>'FirstName',
			'B'=>'MiddleName',
			'C'=>'LastName',
			'D'=>'Email',
			'E'=>'Password',
			'F'=>'City',
			'G'=>'Province',
			'H'=>'Country',
			'I'=>'Contact',
			'J'=>'Status',
			'K'=>'AccountType',
		);

		$required_column_names = array(
			'D'=>'Email',
		);

		$param_column_index = array(
			'first_name'=>'A',
			'middle_name'=>'B',
			'last_name'=>'C',
			'email'=>'D',
			'password'=>'E',
			'city'=>'F',
			'province'=>'G',
			'country'=>'H',
			'contact'=>'I',
			'status'=>'J',
			'account_type'=>'K',
		);


		$admin_id= $this->session->userdata['aid'];


		if (!isset($_FILES['file']['name']))
		{
			echo json_encode(array('status'=>'failed', 'message'=>'File required', 'duplicateRows'=>''));
			return;
		}

		$file = $_FILES['file'];

		$this->load->library('excel');

		$objPHPExcel = PHPExcel_IOFactory::load($file['tmp_name']);

		/** Save file for logging */
//		$unique_file_name = date("Y-m-d_H:i:s").'.'.pathinfo($file["name"])['extension'];
//		move_uploaded_file($file["tmp_name"], FCPATH.'upload_system_files/data_load_files/'.$unique_file_name);
//		$this->Admin_Logger->log("Data load initiated", $file['name']." ($unique_file_name)");


		$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

		/** @var array $cell
		 * Get the data from spreadsheet file
		 */

		foreach ($cell_collection as $cell)
		{
			$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
			$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
			$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

			if ($row == 1) {
				$header[$column] = $data_value;
			} else {
				$rows[$row][$column] = $data_value;
			}
		}

		$this->db->trans_begin();

		$duplicateRows = 0;
		$createdPresentations = 0;
		/** @var array $rows */
		if(!isset($rows)){
			echo json_encode('empty file');
			exit;
		}
		foreach ($rows as $row => $row_columns)
		{


			if($required_column_names['D'] == ''){

					$this->db->trans_rollback();
					echo json_encode(array('status'=>'failed','message'=>'missing required rows','duplicateRows'=>$duplicateRows));

					return;
			}


			$first_name = (isset($row_columns['A']))?str_replace('\'', "\`", $row_columns[$param_column_index['first_name']]):'';
			$middle_name = (isset($row_columns['B']))?str_replace('\'', "\`", $row_columns[$param_column_index['middle_name']]):'';
			$last_name = (isset($row_columns['C']))?str_replace('\'', "\`", $row_columns[$param_column_index['last_name']]):'';


			$email = str_replace('\'', "\`", $row_columns[$param_column_index['email']]);
			$password = (isset($row_columns['E']))?str_replace('\'', "\`", $row_columns[$param_column_index['password']]):'1234';

			$city = (isset($row_columns['F']))?str_replace('\'', "\`", $row_columns[$param_column_index['city']]):'';
			$province = (isset($row_columns['G']))?str_replace('\'', "\`", $row_columns[$param_column_index['province']]):'';
			$country = (isset($row_columns['H']))?str_replace('\'', "\`", $row_columns[$param_column_index['country']]):'';
			$contact = (isset($row_columns['I']))?str_replace('\'', "\`", $row_columns[$param_column_index['contact']]):'';
			$status = (isset($row_columns['J']))?str_replace('\'', "\`", $row_columns[$param_column_index['status']]):'';
			$account_type = (isset($row_columns['K']))?str_replace('\'', "\`", $row_columns[$param_column_index['account_type']]):'';

			$created_date_time = date("Y-m-d H:i:s");


			$exists = $this->checkDuplicate($email);

			if($exists){
				$this->db->trans_rollback();
				$duplicateRows =$duplicateRows+1;
				echo json_encode(array('status'=>'failed','message'=>'Email already exist','duplicateRows'=>$duplicateRows));
				return false;
			}else{
				try{
					$this->db->query("INSERT INTO `users`( `first_name`,`middle_name`, `last_name`, `email`, `password`, `city`, `province`, `country`, `contact_number`, `status`, `account_type` ) VALUES ('{$first_name}','{$middle_name}','{$last_name}','{$email}','{$password}','{$city}','{$province}','{$country}','{$contact}','{$status}','{$account_type}')");
	//				$insert = $this->db->insert_id();

				}catch (Exception $e){

					$this->db->trans_rollback();
					echo json_encode(array('status'=>'failed','message'=>'Problem importing data','duplicateRows'=>$duplicateRows));

					return false;
				}
			}
		}

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();

			echo json_encode(array('status'=>'failed','message'=>'problem importing data','duplicateRows'=>$duplicateRows));
			return false;
		}
		else
		{
			$this->db->trans_commit();

			echo json_encode(array('status'=>'success','message'=>'Data imported successfully','duplicateRows'=>$duplicateRows));
			return;
		}

		return;


	}

	private function checkDuplicate($email)
	{
		$this->db->select('*')
			->from('users')
			->where('email', $email);

		$result = $this->db->get();

		if ($result->num_rows() > 0)
			return $result->row()->id;

		return false;
	}



}
