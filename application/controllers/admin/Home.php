<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent:: __construct();

		$this->load->model('admin/m_login', 'm_login');
		if(!$this->session->userdata['id'] || $this->session->userdata['id'] === ''){
			redirect(base_url().'admin/login');
		}
	}

	public function index(){
		$this->load->view('admin/common/header')
			->load->view('admin/common/menubar')
			->load->view('admin/common/sidebar')
			->load->view('admin/home')
			->load->view('admin/common/footer');
	}

}
