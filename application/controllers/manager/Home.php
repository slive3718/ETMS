<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent:: __construct();

		$this->load->model('manager/m_manager', 'm_manager');
		if(!$this->session->userdata['uid'] || $this->session->userdata['uid'] === ''){
			redirect(base_url().'manager/login');
		}
	}

	public function index(){
		$this->load->view('manager/common/header')
			->load->view('manager/common/menubar')
			->load->view('manager/common/sidebar')
			->load->view('manager/home')
			->load->view('manager/common/footer');
	}


}
