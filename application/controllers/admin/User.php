<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->name = 'user';
		$this->load->model('m_user', 'model');
		$this->load->model('m_role', 'role');
		$this->load->model('m_auth', 'auth');
		$this->auth->is_login();
		$this->auth->hasAkses($this->name);
	}
	public function index()
	{
		$data = [
			'title' => 'User',
			'url' => site_url('admin/user/getList'),
			'aksi' => site_url('admin/user/aksi'),
			'role_access' => $this->auth->role_access(),
			'active' => $this->name,
			'sub_active' => ''
		];
		if ($this->session->userdata('role_id') != 1) {
			$data['role'] = $this->db->from('role')->where('is_deleted', 0)->where('id !=', 1)->get()->result();
		} else {
			$data['role'] = $this->role->all();
		}
		admin('admin/user/index', $data);
	}
	private function cek($a)
	{
		if ($a) {
			return "checked";
		} else {
			return "";
		}
	}
	public function getList()
	{
		$role = $this->auth->role_access();
		$model = $this->model;
		$datas = $model->getRows($_POST);
		$data = [];
		$no = $_POST['start'];
		foreach ($datas as $row) {

			$rows = [];
			$rows[] = ++$no;
			$rows[] = $row->username;
			$rows[] = $row->email;
			$rows[] = $row->nama;
			$rows[] = $row->role;
			if (!$role->can_edit || $row->role_id == 1) {
				$rows[] = "<input type='checkbox' class='is_active' " . $this->cek($row->is_active) . " disabled />";
				$rows[] = "<input type='button' data-uuid='$row->uuid' class='reset btn btn-info' value='Reset Password' disabled  />";
			} else {
				$rows[] = "<input type='checkbox' class='is_active' " . $this->cek($row->is_active) . " />";
				$rows[] = "<input type='button' data-uuid='$row->uuid' class='reset btn btn-info' value='Reset Password'  />";
			}
			if ($role->can_edit == 1 && $role->can_delete == 1) {
				$rows[] = '
				<button type="button" data-uuid="' . $row->uuid . '" data-username="' . $row->username . '" data-email="' . $row->email . '" data-role_id="' . $row->role_id . '" data-nama="' . $row->nama . '" class="edit btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
				<button type="button" data-uuid="' . $row->uuid . '" class="hapus btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
				';
			} else if ($role->can_edit == 1) {
				$rows[] = '
				<button type="button" data-uuid="' . $row->uuid . '" data-username="' . $row->username . '" data-email="' . $row->email . '" data-role_id="' . $row->role_id . '" data-nama="' . $row->nama . '" class="edit btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
				';
			} else if ($role->can_delete == 1) {
				$rows[] = '
				<button type="button" data-uuid="' . $row->uuid . '" class="edit btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
				';
			}
			$data[] = $rows;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $model->countAll(),
			"recordsFiltered" => $model->countFiltered($_POST),
			"data" => $data,
		);
		echo json_encode($output);
	}
	public function aksi()
	{
		$aksi = htmlspecialchars($this->input->post('aksi'));
		$data = [];
		if ($aksi == "tambah")
			$data = $this->save();
		else if ($aksi == 'edit')
			$data = $this->edit();
		else if ($aksi == 'hapus')
			$data = $this->hapus();
		else if ($aksi == 'reset')
			$data = $this->reset();
		else
			$data = ['status' => false, 'pesan' => 'Pilihan aksi tidak ditemukan'];
		echo json_encode($data);
	}
	private function save()
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
		$cek = $this->model->save($data);
		return $this->model->response($cek, 'ditambah');
	}
	private function edit()
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
		$cek = $this->model->edit($uuid, $data);
		return $this->model->response($cek, 'diubah');
	}
	private function reset()
	{
		$uuid = htmlspecialchars($this->input->post('uuid'));
		$password = htmlspecialchars($this->input->post('password'));
		$data = [
			'password' => password_hash($password, PASSWORD_DEFAULT),
		];
		$cek = $this->model->edit($uuid, $data);
		return $this->model->response($cek, 'diubah');
	}
	private function hapus()
	{
		$uuid = htmlspecialchars($this->input->post('uuid'));
		$cek = $this->model->sofDelete($uuid);
		return $this->model->response($cek, 'dihapus');
	}
}
