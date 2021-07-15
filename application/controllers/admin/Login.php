<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent:: __construct();

		$this->load->model('m_admin/m_login', 'm_login');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}
}
