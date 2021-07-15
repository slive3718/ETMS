<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent:: __construct();

		$this->load->model('admin/M_login', 'm_login');
	}

	public function index(){
		$this->load->view('admin/common/header');
		$this->load->view('admin/login');
	}

	public function validate(){
		$this->m_login->validate();
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'admin/login');
	}
}
