<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->name = 'role';
		$this->load->model('m_role', 'model');
		$this->load->model('m_auth', 'auth');
		$this->auth->is_login();
		$this->auth->hasAkses($this->name);
	}
	public function index()
	{
		$data = [
			'title' => 'Role',
			'url' => site_url('admin/role/getList'),
			'aksi' => site_url('admin/role/aksi'),
			'role_access' => $this->auth->role_access(),
			'active' => $this->name,
			'sub_active' => ''
		];
		admin('admin/role/index', $data);
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
			$rows[] = $row->role;
			if ($row->id == 1) {
				$rows[] = "<input type='checkbox' data-uuid='$row->uuid' class='can_insert' " . $this->cek($row->can_insert) . "  disabled/>";
				$rows[] = "<input type='checkbox' data-uuid='$row->uuid' class='can_delete' " . $this->cek($row->can_delete) . " disabled />";
				$rows[] = "<input type='checkbox' data-uuid='$row->uuid' class='can_edit' " . $this->cek($row->can_edit) . " disabled />";
			} else {
				$rows[] = "<input type='checkbox' data-uuid='$row->uuid' class='can_insert' " . $this->cek($row->can_insert) . "  />";
				$rows[] = "<input type='checkbox' data-uuid='$row->uuid' class='can_delete' " . $this->cek($row->can_delete) . " />";
				$rows[] = "<input type='checkbox' data-uuid='$row->uuid' class='can_edit' " . $this->cek($row->can_edit) . " />";
			}
			if ($role->can_edit && $role->can_delete) {
				$rows[] = '
				<button type="button" data-uuid="' . $row->uuid . '" data-role="' . $row->role . '" class="edit btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
				<button type="button" data-uuid="' . $row->uuid . '" class="hapus btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
				';
			} else if ($role->can_edit) {
				$rows[] = '
				<button type="button" data-uuid="' . $row->uuid . '" data-role="' . $row->role . '" class="edit btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
				';
			} else if ($role->can_delete) {
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
		else
			$data = ['status' => false, 'pesan' => 'Pilihan aksi tidak ditemukan'];
		echo json_encode($data);
	}
	private function save()
	{
		$role = htmlspecialchars($this->input->post('role'));
		$this->db->set('uuid', 'UUID()', false);
		$cek = $this->model->save(['role' => $role]);
		return $this->model->response($cek, 'ditambah');
	}
	private function edit()
	{
		$uuid = htmlspecialchars($this->input->post('uuid'));
		$role = htmlspecialchars($this->input->post('role'));
		$cek = $this->model->edit($uuid, ['role' => $role]);
		return $this->model->response($cek, 'diedit');
	}
	private function hapus()
	{
		$uuid = htmlspecialchars($this->input->post('uuid'));
		$cek = $this->model->softDelete($uuid);
		return $this->model->response($cek, 'dihapus');
	}
	public function can_insert()
	{
		$uuid = htmlspecialchars($this->input->post('uuid'));
		$cek = $this->model->find($uuid);
		$data = [];
		if ($cek) {
			if ($cek->can_insert == 1) {
				$tes = $this->model->edit($uuid, ['can_insert' => 0]);
			} else {
				$tes = $this->model->edit($uuid, ['can_insert' => 1]);
			}
			$data = $this->model->response($tes, 'diubah');
		} else
			$data = $this->model->response(false, 'diubah');
		echo json_encode($data);
	}
	public function can_delete()
	{
		$uuid = htmlspecialchars($this->input->post('uuid'));
		$cek = $this->model->find($uuid);
		$data = [];
		if ($cek) {
			if ($cek->can_delete == 1) {
				$tes = $this->model->edit($uuid, ['can_delete' => 0]);
			} else {
				$tes = $this->model->edit($uuid, ['can_delete' => 1]);
			}
			$data = $this->model->response($tes, 'diubah');
		} else
			$data = $this->model->response(false, 'diubah');
		echo json_encode($data);
	}
	public function can_edit()
	{
		$uuid = htmlspecialchars($this->input->post('uuid'));
		$cek = $this->model->find($uuid);
		$data = [];
		if ($cek) {
			if ($cek->can_edit == 1) {
				$tes = $this->model->edit($uuid, ['can_edit' => 0]);
			} else {
				$tes = $this->model->edit($uuid, ['can_edit' => 1]);
			}
			$data = $this->model->response($tes, 'diubah');
		} else
			$data = $this->model->response(false, 'diubah');
		echo json_encode($data);
	}
}
