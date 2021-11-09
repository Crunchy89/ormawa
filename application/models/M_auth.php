<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_auth extends CI_Model
{
	public function __construct()
	{
		$this->table = 'user';
		$this->id = 'id';
	}
	public function attemp($username, $password)
	{
		$cek = $this->db->get_where($this->table, ['username' => $username])->row();
		if ($cek) {
			if ($cek->is_deleted) {
				$this->session->set_flashdata('error', 'Akun tidak ditemukan silahkan hubungi admin');
				redirect('auth');
			} else if (!$cek->is_active) {
				$this->session->set_flashdata('error', 'Akun tidak aktif silahkan hubungi admin');
				redirect('auth');
			} else if (password_verify($password, $cek->password)) {
				$data = [
					'user_id' => $cek->id,
					'role_id' => $cek->role_id
				];
				$this->session->set_userdata($data);
				redirect('/');
			} else {
				$this->session->set_flashdata('error', 'Username atau password salah');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('error', 'Username atau password salah');
			redirect('auth');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('role_id');
		$this->session->sess_destroy();
		redirect('home');
	}
	public function is_login()
	{
		if (!$this->session->userdata('user_id')) {
			redirect('home');
		}
	}
	public function role_access()
	{
		$role_id = $this->session->userdata('role_id');
		$role = $this->db->get_where('role', ['id' => $role_id])->row();
		return $role;
	}
	public function has_login()
	{
		if ($this->session->userdata('user_id')) {
			redirect('admin/dashboard');
		}
	}
	public function detail_user()
	{
		$data = $this->db->get_where('user', ['id' => $this->session->userdata('user_id')])->row();
		return $data;
	}
	public function getMenuAkses()
	{
		$session = $this->session->userdata();
		return $this->db->select('menu.menu')->from('akses')->join('menu', 'akses.menu_id = menu.id')->where('akses.role_id', $session['role_id'])->get()->result();
	}
	public function hasAkses($cek)
	{
		$menus = $this->getMenuAkses();
		$arr = [];
		foreach ($menus as $menu) {
			$arr[] = $menu->menu;
		}
		$tes = array_search($cek, $arr) > 0 ? 1 : 0;
		if (!$tes) {
			redirect('admin/dashboard');
		}
	}
}
