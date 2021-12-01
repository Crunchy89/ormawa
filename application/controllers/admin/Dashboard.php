<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_auth', 'auth');
		$this->load->model('m_ukm', 'ukm');
		$this->auth->is_login();
	}
	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'active' => 'dashboard',
			'ukm' => $this->ukm->select('count(id) as jumlah')->row(),
			'sub_active' => ''
		];
		admin('admin/index', $data);
	}
}
