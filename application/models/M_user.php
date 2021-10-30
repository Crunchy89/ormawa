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
}
