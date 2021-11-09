<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_role extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		// set table name in parent
		$this->table = 'role';
		// set primary field in parent
		$this->id = 'uuid';
		// set column order in parent
		$this->column_order = [null, 'role', 'can_insert', 'can_delete', 'can_edit', null];
		//  set column search in parent
		$this->column_search = ['role'];
		// set order by datatable in parent
		$this->order = ['id' => 'asc'];
	}

	//set Query Datatable in parent
	public function queryTable()
	{
		$this->db->select('id, role ,uuid, can_insert , can_delete , can_edit');
		$this->db->from($this->table);
		$this->db->where('is_deleted', 0);
		if ($this->session->userdata('role_id') != 1) {
			$this->db->where('id != 1');
		}
	}
}
