<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pembimbing extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		// set table name in parent
		$this->table = 'ukm_pembimbing';
		// set primary field in parent
		$this->id = 'id';
		// set column order in parent
		$this->column_order = [null, 'ukm.nama_ukm', 'user.nama', 'ukm_pembimbing.is_active', 'ukm_pembimbing.tanggal', null];
		//  set column search in parent
		$this->column_search = ['ukm.nama_ukm', 'user.nama'];
		// set order by datatable in parent
		$this->order = ['ukm_pembimbing.created_at' => 'desc'];
	}

	//set Query Datatable in parent
	public function queryTable()
	{
		$user = $this->session->userdata('user_id');
		$cek = $this->db->from('ukm_pengurus as a')->select('b.ukm_id')->join('ukm_anggota as b', 'a.anggota_id = b.id')->where('b.user_id', $user)->where('a.is_active', 1)->where('a.jabatan_id', 1)->get()->row();
		$this->db->select('ukm_pembimbing.id,ukm_pembimbing.ukm_id,ukm_pembimbing.user_id, ukm.nama_ukm ,user.nama,ukm_pembimbing.is_active,ukm_pembimbing.tanggal');
		$this->db->from($this->table);
		$this->db->join('ukm', 'ukm_pembimbing.ukm_id = ukm.id');
		$this->db->join('user', 'ukm_pembimbing.user_id = user.id');
		$this->db->where('ukm.is_active', 1);
		$this->db->where('user.is_active', 1);
		$this->db->where('user.is_deleted', 0);
		if ($this->session->userdata('role_id') > 1) {
			$this->db->where('ukm_pembimbing.ukm_id', $cek->ukm_id);
		}
	}
}
