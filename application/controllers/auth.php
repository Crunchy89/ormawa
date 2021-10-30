<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// load model User
		$this->load->model('m_auth', 'auth');
	}

	// fungsi yang pertama kali akan di load
	public function index()
	{
		$this->auth->has_login();
		$this->load->library('form_validation');
		$this->form_validation->set_rules(
			'username',
			'Username',
			'required',
			array('required' => 'Kolom %s tidak boleh kosong')
		);
		$this->form_validation->set_rules(
			'password',
			'Password',
			'required',
			array('required' => 'Kolom %s tidak boleh kosong')
		);
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'Masuk'
			];
			home('home/auth', $data);
		} else {
			$username = htmlspecialchars($this->input->post('username'));
			$password = htmlspecialchars($this->input->post('password'));
			$this->auth->attemp($username, $password);
		}
	}
	// fungsi logout
	public function logout()
	{
		$this->auth->logout();
	}
}
