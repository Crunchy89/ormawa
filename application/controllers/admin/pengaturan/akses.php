<?php
defined('BASEPATH') or exit('No direct script access allowed');

class akses extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_menu', 'menu');
		$this->load->model('m_akses', 'model');
		$this->load->model('m_auth', 'auth');
		$this->auth->is_login();
		$this->auth->hasAkses('pengaturan');
	}
	public function index()
	{
		$tes = $this->auth->getMenuAkses();
		$data = [
			'title' => 'Akses',
			'url' => site_url('admin/pengaturan/akses/getList'),
			'aksi' => site_url('admin/pengaturan/akses/aksi'),
			'role_access' => $this->auth->role_access(),
			'active' => 'pengaturan',
			'sub_active' => 'akses'
		];
		admin('admin/pengaturan/akses/index', $data);
	}
	public function getList()
	{
		$role = $this->auth->role_access();
		$model = $this->model;
		$datas = $model->getRows($_POST);
		$data = [];
		$no = $_POST['start'];
		foreach ($datas as $row) {
			$menu = $this->db->select('menu.id , menu.menu')->from('menu')->join('akses', 'menu.id = akses.menu_id')->where('akses.role_id', $row->id)->get()->result();
			$ol = '<ol>';
			foreach ($menu as $rows) {
				$ol .= "<li>$rows->menu</li>";
			}
			$ol .= '</ol>';
			$rows = [];
			$rows[] = ++$no;
			$rows[] = $row->role;
			$rows[] = $ol;
			if ($role->can_edit) {
				$rows[] = '
				<a href="' . site_url('admin/pengaturan/akses/edit/' . $row->id) . '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
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
	public function edit($id)
	{
		$data = [
			'title' => 'Akses',
			'role_access' => $this->auth->role_access(),
			'menu' => $this->menu->getAll(),
			'akses' => $this->model->where(['role_id' => $id])->result(),
			'active' => 'pengaturan',
			'sub_active' => 'akses',
			'role_id' => $id,
			'link_akses' => site_url('admin/pengaturan/akses/setAkses')
		];
		admin('admin/pengaturan/akses/edit', $data);
	}
	public function setAkses()
	{
		$role_id = htmlspecialchars($this->input->post('role_id'));
		$menu_id = htmlspecialchars($this->input->post('menu_id'));
		$data = [];
		$cek = $this->model->where(['role_id' => $role_id, 'menu_id' => $menu_id])->row();
		if ($cek) {
			$tes = $this->model->delete($cek->id);
			if ($tes)
				$data = [
					'status' => true,
					'pesan' => 'Akses Dihapus'
				];
			else
				$data = [
					'status' => true,
					'pesan' => 'Akses gagal dihapus'
				];
		} else {
			$tes = $this->model->save(['role_id' => $role_id, 'menu_id' => $menu_id]);
			if ($tes)
				$data = [
					'status' => true,
					'pesan' => 'Akses Diberikan'
				];
			else
				$data = [
					'status' => true,
					'pesan' => 'Akses gagal ditambahkan'
				];
		}
		echo json_encode($data);
	}
}
