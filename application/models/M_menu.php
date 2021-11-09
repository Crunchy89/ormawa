<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_menu extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		// set table name in parent
		$this->table = 'menu';
		// set primary field in parent
		$this->id = 'uuid';
		// set column order in parent
		$this->column_order = [null, 'menu', null];
		//  set column search in parent
		$this->column_search = ['menu'];
		// set order by datatable in parent
		$this->order = ['id' => 'asc'];
	}

	//set Query Datatable in parent
	public function queryTable()
	{
		$this->db->select('id, menu ,uuid');
		$this->db->from($this->table);
	}
}
