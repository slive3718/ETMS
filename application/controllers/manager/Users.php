<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct() {
		parent:: __construct();

		$this->load->model('manager/m_login', 'm_login');
		if(!$this->session->userdata['mid'] || $this->session->userdata['mid'] === ''){
			redirect(base_url().'manager/login');
		}
		$this->load->model('manager/M_users', 'm_users');
	}

	public function index(){
		$this->load->view('manager/common/header')
			->load->view('manager/common/menubar')
			->load->view('manager/common/sidebar')
			->load->view('manager/home')
			->load->view('manager/common/footer');
	}

	public function getUserList(){
		$this->m_users->getUserList();
	}

	public function addUser(){
		$this->m_users->addUser();
	}

	public function getUserById(){
		$this->m_users->getUserById();
	}

	public function updateUserData(){
		$this->m_users->updateUserData();
	}

	public function addToDeletedUsers(){
		$this->m_users->addToDeletedUsers();
	}

	public function addEmployeeTask(){
		$this->m_users->addEmployeeTask();
	}

	public function viewTaskList(){
		$this->m_users->viewTaskList();
	}
}
