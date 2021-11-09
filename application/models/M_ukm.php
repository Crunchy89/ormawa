<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_ukm extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		// set table name in parent
		$this->table = 'ukm';
		// set primary field in parent
		$this->id = 'uuid';
		// set column order in parent
		$this->column_order = [null, 'nama_ukm', null, null];
		//  set column search in parent
		$this->column_search = ['ukm.nama_ukm'];
		// set order by datatable in parent
		$this->order = ['ukm.id' => 'asc'];
	}

	//set Query Datatable in parent
	public function queryTable()
	{
		$this->db->select('ukm.id, ukm.nama_ukm ,ukm.uuid,ukm.is_active');
		$this->db->from($this->table);
	}
}
