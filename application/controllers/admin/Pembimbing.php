<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembimbing extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->name = 'pembimbing';
		$this->load->model('m_pembimbing', 'model');
		$this->load->model('m_auth', 'auth');
		$this->load->model('m_user', 'user');
		$this->load->model('m_ukm', 'ukm');
		$this->auth->is_login();
		$this->auth->hasAkses($this->name);
	}
	public function index()
	{
		$data = [
			'title' => 'Pembimbing UKM',
			'url' => site_url('admin/' . $this->name . '/getList'),
			'aksi' => site_url('admin/' . $this->name . '/aksi'),
			'aktif' => site_url('admin/' . $this->name . '/aktif'),
			'role_access' => $this->auth->role_access(),
			'active' => $this->name,
			'pembimbing' => $this->user->where(['is_active' => 1, 'is_deleted' => 0, 'role_id' => 2])->result(),
			'ukm' => $this->ukm->where('is_active', 1)->result(),
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
			$rows[] = $row->nama;
			if ($role->can_edit) {
				$rows[] = '
					<button type="button" data-id="' . $row->id . '" data-ukm_id="' . $row->ukm_id . '" class="aktif btn btn-sm ' . ($row->is_active == 1 ? "btn-success disable" : "btn-danger") . '" ' . ($row->is_active == 1 ? "disabled" : "") . '>' . ($row->is_active == 1 ? "Aktif" : "Nonaktif") . '</button>
					';
			} else {
				$rows[] = '
					<button type="button" class="btn btn-sm ' . ($row->is_active == 1 ? "btn-success disable" : "btn-danger") . '" ' . ($row->is_active == 1 ? "disabled" : "") . '>' . ($row->is_active == 1 ? "Aktif" : "Nonaktif") . '</button>
					';
			}
			$rows[] = $row->tanggal;
			if ($role->can_edit && $role->can_delete) {
				$rows[] = '
				<button type="button" data-id="' . $row->id . '" data-ukm_id="' . $row->ukm_id . '" data-user_id="' . $row->user_id . '" data-tanggal="' . $row->tanggal . '" class="edit btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
				<button type="button" data-id="' . $row->id . '" class="hapus btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
				';
			} else if ($role->can_edit) {
				$rows[] = '
				<button type="button" data-id="' . $row->id . '" data-ukm_id="' . $row->ukm_id . '" data-user_id="' . $row->user_id . '" data-tanggal="' . $row->tanggal . '" class="edit btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
				';
			} else if ($role->can_delete) {
				$rows[] = '
				<button type="button" data-id="' . $row->id . '" class="edit btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
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
		$ukm_id = "";
		if ($this->session->userdata('role_id') > 1) {
			$cek = $this->db->from('ukm_anggota')->select('ukm_id')->where('user_id', $this->session->userdata('user_id'))->get()->row();
			$ukm_id = $cek->ukm_id;
		} else {
			$ukm_id = htmlspecialchars($this->input->post('ukm_id'));
		}
		$user_id = htmlspecialchars($this->input->post('user_id'));
		$tanggal = htmlspecialchars($this->input->post('tanggal'));
		$data = [];
		$this->db->trans_begin();
		$this->db->where('is_active', 1)->where('ukm_id', $ukm_id)->update($this->model->table, ['is_active' => 0]);
		$cek = $this->model->save([
			'ukm_id' => $ukm_id,
			'user_id' => $user_id,
			'tanggal' => $tanggal,
			'is_active' => 1
		]);
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$data = ['status' => false, 'pesan' => 'Data gagal ditambah'];
		} else {
			$this->db->trans_commit();
			$data = ['status' => true, 'pesan' => 'Data berhasil ditambah'];
		}
		return $data;
	}
	private function edit()
	{
		$id = htmlspecialchars($this->input->post('id'));
		$ukm_id = htmlspecialchars($this->input->post('ukm_id'));
		$user_id = htmlspecialchars($this->input->post('user_id'));
		$tanggal = htmlspecialchars($this->input->post('tanggal'));

		$cek = $this->model->edit($id, [
			'ukm_id' => $ukm_id,
			'user_id' => $user_id,
			'tanggal' => $tanggal
		]);
		return $this->model->response($cek, 'diedit');
	}
	private function hapus()
	{
		$id = htmlspecialchars($this->input->post('id'));
		$cek = $this->model->delete($id);
		return $this->model->response($cek, 'dihapus');
	}
	public function aktif()
	{
		$id = htmlspecialchars($this->input->post('id'));
		$ukm_id = htmlspecialchars($this->input->post('ukm_id'));
		$cek = $this->model->find($id);
		$data = [];
		$this->db->trans_begin();
		$this->db->where('is_active', 1)->where('ukm_id', $ukm_id)->update($this->model->table, ['is_active' => 0]);
		if ($cek->is_active) {
			$this->model->edit($id, ['is_active' => 0]);
		} else {
			$this->model->edit($id, ['is_active' => 1]);
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$data = [
				'status' => false,
				'pesan' => 'Data gagal diubah'
			];
		} else {
			$this->db->trans_commit();
			$data = [
				'status' => true,
				'pesan' => 'Pembimbing Aktif'
			];
		}
		echo json_encode($data);
	}
}
