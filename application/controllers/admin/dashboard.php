<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_auth', 'auth');
		$this->auth->is_login();
	}
	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'active' => 'dashboard',
			'sub_active' => ''
		];
		admin('admin/index', $data);
	}
}
