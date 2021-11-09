<?php
defined('BASEPATH') or exit('No direct script access allowed');

abstract class MY_Model extends CI_Model
{
	public $table;
	public $id;
	public $column_order;
	public $column_search;
	public $order;

	// get query datatable from child
	abstract function queryTable();

	public function getRows($postData)
	{
		$this->_get_datatables_query($postData);
		if ($postData['length'] != -1) {
			$this->db->limit($postData['length'], $postData['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function countAll()
	{
		$this->queryTable();
		return $this->db->count_all_results();
	}

	public function countFiltered($postData)
	{
		$this->_get_datatables_query($postData);
		$query = $this->db->get();
		return $query->num_rows();
	}
	private function _get_datatables_query($postData)
	{
		$this->queryTable();
		$i = 0;
		foreach ($this->column_search as $item) {
			if ($postData['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $postData['search']['value']);
				} else {
					$this->db->or_like($item, $postData['search']['value']);
				}
				if (count($this->column_search) - 1 == $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}
		if (isset($postData['order'])) {
			$this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	// method mengembalikan nama tabel
	public function getTable()
	{
		return $this->table;
	}
	// method mengembalikan nama field primary
	public function getId()
	{
		return $this->id;
	}
	// method simpan data
	public function save($data)
	{
		return $this->db->insert($this->table, $data);
	}
	// method edit data
	public function edit($id, $data)
	{
		return $this->db->where($this->id, $id)->update($this->table, $data);
	}
	// method soft delete
	public function softDelete($id)
	{
		return $this->db->where($this->id, $id)->update($this->table, ['is_deleted' => 1]);
	}
	// method hapus
	public function delete($id)
	{
		return $this->db->where($this->id, $id)->delete($this->table);
	}
	// method mengembalikan semua data dari table yang belum terhapus softdelete
	public function all()
	{
		return $this->db->get_where($this->table, ['is_deleted' => 0])->result();
	}
	// method mengembalikan semua data dari tabel
	public function getAll()
	{
		return $this->db->get($this->table)->result();
	}
	// method mengembalikan data berdasarkan pencarian where
	public function where($array, $val = false)
	{
		if ($val) {
			$this->db->where($array, $val);
		} else {
			if (is_array($array)) {
				foreach ($array as $field => $value) {
					$this->db->where($field, $value);
				}
			} else {
				$this->db->where($array);
			}
		}
		return $this;
	}
	public function join($table, $relation)
	{
		$this->db->join($table, $relation);
		return $this;
	}
	public function select($field)
	{
		$this->db->select($field);
		return $this;
	}
	public function row()
	{
		return $this->db->get($this->table)->row();
	}
	public function result()
	{
		return $this->db->get($this->table)->result();
	}
	// method mengembalikan 1 data berdasarkan id
	public function find($id)
	{
		return $this->db->get_where($this->table, [$this->id => $id])->row();
	}
	// response
	public function response($bool, $pesan)
	{
		$data = [];
		if ($bool)
			$data = ['status' => true, 'pesan' => "Data berhasil $pesan"];
		else
			$data = ['status' => false, 'pesan' => "Data gagal $pesan"];
		return $data;
	}
}
