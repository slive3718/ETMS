<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct() {
		parent:: __construct();

		$this->load->model('admin/m_login', 'm_login');
		if(!$this->session->userdata['aid'] || $this->session->userdata['aid'] === ''){
			redirect(base_url().'admin/login');
		}
		$this->load->model('admin/M_users', 'm_users');
	}

	public function index(){
		$this->load->view('admin/common/header')
			->load->view('admin/common/menubar')
			->load->view('admin/common/sidebar')
			->load->view('admin/users')
			->load->view('admin/common/footer');
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

	public function importUsers(){
		$this->m_users->importUsers();
	}


}
