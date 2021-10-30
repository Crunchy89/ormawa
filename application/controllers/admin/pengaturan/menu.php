<?php
defined('BASEPATH') or exit('No direct script access allowed');

class menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_menu', 'model');
		$this->load->model('m_auth', 'auth');
		$this->auth->is_login();
		$this->auth->hasAkses('pengaturan');
	}
	public function index()
	{
		$data = [
			'title' => 'Menu',
			'url' => site_url('admin/pengaturan/menu/getList'),
			'aksi' => site_url('admin/pengaturan/menu/aksi'),
			'role_access' => $this->auth->role_access(),
			'active' => 'pengaturan',
			'sub_active' => 'menu'
		];
		admin('admin/pengaturan/menu/index', $data);
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
			$rows[] = $row->menu;
			if ($role->can_edit && $role->can_delete) {
				$rows[] = '
				<button type="button" data-uuid="' . $row->uuid . '" data-menu="' . $row->menu . '" class="edit btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
				<button type="button" data-uuid="' . $row->uuid . '" class="hapus btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
				';
			} else if ($role->can_edit) {
				$rows[] = '
				<button type="button" data-uuid="' . $row->uuid . '" data-role="' . $row->menu . '" class="edit btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
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
		$menu = htmlspecialchars($this->input->post('menu'));
		$this->db->set('uuid', 'UUID()', false);
		$cek = $this->model->save(['menu' => $menu]);
		return $this->model->response($cek, 'ditambah');
	}
	private function edit()
	{
		$uuid = htmlspecialchars($this->input->post('uuid'));
		$menu = htmlspecialchars($this->input->post('menu'));
		$cek = $this->model->edit($uuid, ['menu' => $menu]);
		return $this->model->response($cek, 'diedit');
	}
	private function hapus()
	{
		$uuid = htmlspecialchars($this->input->post('uuid'));
		$cek = $this->model->delete($uuid);
		return $this->model->response($cek, 'dihapus');
	}
}
