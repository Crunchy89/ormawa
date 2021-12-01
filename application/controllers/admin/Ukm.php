<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ukm extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->name = 'ukm';
		$this->load->model('m_ukm', 'model');
		$this->load->model('m_auth', 'auth');
		$this->auth->is_login();
		$this->auth->hasAkses($this->name);
	}
	public function index()
	{
		$data = [
			'title' => 'UKM',
			'url' => site_url('admin/' . $this->name . '/getList'),
			'aksi' => site_url('admin/' . $this->name . '/aksi'),
			'role_access' => $this->auth->role_access(),
			'active' => $this->name,
			'sub_active' => ''
		];
		admin('admin/' . $this->name . '/index', $data);
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
			$rows[] = $row->nama_ukm;
			$rows[] = '
					<button type="button" data-uuid="' . $row->uuid . '" class="aktif btn btn-sm btn-' . ($row->is_active == 1 ? "success" : "danger") . ' ' . ($role->can_edit != 1 ? "disable" : "") . '" ' . ($role->can_edit != 1 ? "disabled" : "") . '>' . ($row->is_active == 1 ? "Aktif" : "Nonaktif") . '</button>
					';
			if ($role->can_edit && $role->can_delete) {
				$rows[] = '
				<button type="button" data-uuid="' . $row->uuid . '" data-nama_ukm="' . $row->nama_ukm . '" class="edit btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
				<button type="button" data-uuid="' . $row->uuid . '" class="hapus btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
				';
			} else if ($role->can_edit) {
				$rows[] = '
				<button type="button" data-uuid="' . $row->uuid . '" data-nama_ukm="' . $row->nama_ukm . '" class="edit btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
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
		$nama_ukm = htmlspecialchars($this->input->post('nama_ukm'));
		$slug = implode('-', explode(' ', $nama_ukm));

		$this->db->set('uuid', 'UUID()', false);
		$cek = $this->model->save([
			'nama_ukm' => $nama_ukm,
			'slug' => $slug
		]);
		return $this->model->response($cek, 'ditambah');
	}
	private function edit()
	{
		$uuid = htmlspecialchars($this->input->post('uuid'));
		$nama_ukm = htmlspecialchars($this->input->post('nama_ukm'));
		$slug = implode('-', explode(' ', $nama_ukm));
		$cek = $this->model->edit($uuid, [
			'nama_ukm' => $nama_ukm,
			'slug' => $slug
		]);
		return $this->model->response($cek, 'diedit');
	}
	private function hapus()
	{
		$uuid = htmlspecialchars($this->input->post('uuid'));
		$cek = $this->model->softDelete($uuid);
		return $this->model->response($cek, 'dihapus');
	}
	public function aktif()
	{
		$uuid = htmlspecialchars($this->input->post('uuid'));
		$cek = $this->model->find($uuid);
		$data = [];
		if ($cek->is_active) {
			$tes = $this->model->edit($uuid, ['is_active' => 0,]);
			if ($tes) {
				$data = [
					'status' => false,
					'pesan' => 'UKM Nonaktif'
				];
			}
		} else {
			$tes = $this->model->edit($uuid, ['is_active' => 1,]);
			if ($tes) {
				$data = [
					'status' => true,
					'pesan' => 'UKM Aktif'
				];
			}
		}
		echo json_encode($data);
	}
}
