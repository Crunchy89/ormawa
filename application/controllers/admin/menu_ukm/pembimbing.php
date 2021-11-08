<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pembimbing extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->name = 'menu_ukm';
		$this->load->model('m_pembimbing', 'model');
		$this->load->model('m_auth', 'auth');
		$this->auth->is_login();
		$this->auth->hasAkses($this->name);
	}
	public function index()
	{
		$sub_active = 'pembimbing';
		$data = [
			'title' => 'Pembimbing',
			'url' => site_url('admin/' . $this->name . '/pembimbing/getList'),
			'aksi' => site_url('admin/' . $this->name . '/pembimbing/aksi'),
			'aktif' => site_url('admin/' . $this->name . '/pembimbing/aktif'),
			'role_access' => $this->auth->role_access(),
			'active' => $this->name,
			'sub_active' => $sub_active,
		];
		if ($this->session->userdata('role_id') == 1) {
			$data['ukm'] = $this->model->select('ukm.nama_ukm')->join('ukm', 'ukm_pembimbing.ukm_id = ukm.id')->where(['ukm_pembimbing.is_active' => 1])->result();
		} else {
			$data['ukm'] = $this->model->select('ukm.nama_ukm')->join('ukm', 'ukm_pembimbing.ukm_id = ukm.id')->where(['ukm_pembimbing.user_id' => $this->session->userdata('user_id'), 'ukm_pembimbing.is_active' => 1])->result();
		}
		admin('admin/' . $this->name . '/' . $sub_active . '', $data);
	}
}
