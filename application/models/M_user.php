<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		// set table name in parent
		$this->table = 'user';
		// set primary field in parent
		$this->id = 'uuid';
		// set column order in parent
		$this->column_order = [null, 'user.username', 'user.email', 'user.is_active', 'role.role', null];
		//  set column search in parent
		$this->column_search = ['user.username', 'user.email', 'user.nama', 'role.role'];
		// set order by datatable in parent
		$this->order = ['user.id' => 'asc'];
	}

	//set Query Datatable in parent
	public function queryTable()
	{
		$this->db->select('user.username, user.email,user.nama ,user.uuid, user.role_id, user.is_active , role.role');
		$this->db->from($this->table);
		$this->db->join('role', 'user.role_id = role.id');
		$this->db->where('user.is_deleted', 0);
		$this->db->where('role.is_deleted', 0);
		if ($this->session->userdata('role_id') != 1) {
			$this->db->where('user.role_id != 1');
		}
	}
	public function simpan()
	{
		$username = htmlspecialchars($this->input->post('username'));
		$password = htmlspecialchars($this->input->post('password'));
		$email = htmlspecialchars($this->input->post('email'));
		$nama = htmlspecialchars($this->input->post('nama'));
		$role_id = htmlspecialchars($this->input->post('role_id'));
		$this->db->set('uuid', 'UUID()', false);
		$data = [
			'username' => $username,
			'email' => $email,
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'role_id' => $role_id,
			'nama' => $nama
		];
		$cek = $this->save($data);
		return $this->response($cek, 'ditambah');
	}
	public function ubah()
	{
		$uuid = htmlspecialchars($this->input->post('uuid'));
		$username = htmlspecialchars($this->input->post('username'));
		$email = htmlspecialchars($this->input->post('email'));
		$nama = htmlspecialchars($this->input->post('nama'));
		$role_id = htmlspecialchars($this->input->post('role_id'));
		$data = [
			'username' => $username,
			'email' => $email,
			'nama' => $nama,
			'role_id' => $role_id
		];
		$cek = $this->edit($uuid, $data);
		return $this->response($cek, 'diubah');
	}
	public function reset()
	{
		$uuid = htmlspecialchars($this->input->post('uuid'));
		$password = htmlspecialchars($this->input->post('password'));
		$data = [
			'password' => password_hash($password, PASSWORD_DEFAULT),
		];
		$cek = $this->edit($uuid, $data);
		return $this->response($cek, 'diubah');
	}
	public function hapus()
	{
		$uuid = htmlspecialchars($this->input->post('uuid'));
		$cek = $this->softDelete($uuid);
		return $this->response($cek, 'dihapus');
	}
	public function is_active()
	{
		$uuid = htmlspecialchars($this->input->post('uuid'));
		$cek = $this->find($uuid);
		if ($cek->is_active == 1) {
			$data = [
				'is_active' => 0,
			];
		} else {
			$data = [
				'is_active' => 1,
			];
		}
		$cek = $this->edit($uuid, $data);
		return $this->response($cek, 'diubah');
	}
}
