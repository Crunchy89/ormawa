<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_akses extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		// set table name in parent
		$this->table = 'akses';
		// set primary field in parent
		$this->id = 'id';
		// set column order in parent
		$this->column_order = [null, 'role.role', null, null];
		//  set column search in parent
		$this->column_search = ['role.role'];
		// set order by datatable in parent
		$this->order = ['role.id' => 'asc'];
	}

	//set Query Datatable in parent
	public function queryTable()
	{
		$this->db->select('role.id, role.role, akses.menu_id')
			->from($this->table)
			->join('role', 'akses.role_id = role.id', 'right')
			->where('role.is_deleted', 0)
			->group_by('role.id');
	}
}
