<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beta_model extends CI_Model {
    // create
    public function _create($table, $data) {
        $this->db->insert($table, $data);
        $id = $this->db->insert_id();
        // return id data
        return (isset($id)) ? $id : FALSE;
    }

    // read
    public function _read($table) {
        return $this->db->get($table);
    }
    // read where
    public function _read_where($table, $where) {
        return $this->db->get_where($table, $where);
    }

    // update
    public function _update($table, $data, $where) {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    // delete
    public function _delete($table, $where) {
        $this->db->delete($table, $where);
    }
    
    // search data - like
	public function _search($table, $column, $data) {
		$this->db->like($column, $data, 'both');
		$this->db->limit(10);

		return $this->db->get($table);
    }

    // searh data - like custom - size
    public function _search_custom_size($data) {
		$this->db->select('*');
		$this->db->from('tbl_items_detail');
		$this->db->join('tbl_items', 'tbl_items.id_item = tbl_items_detail.id_item');
		$this->db->order_by('tbl_items.nm_item', 'ASC');
		$this->db->order_by('tbl_items_detail.nm_size', 'ASC');
		$this->db->like('tbl_items_detail.nm_size', $data, 'both');
		$this->db->or_like('tbl_items.nm_item', $data, 'both');
		$this->db->limit(5);
		return $this->db->get();
	}
    
    // custom - get list table
    public function _get_table() {
		$sql = $this->db->query("SELECT t.TABLE_NAME AS t_name FROM INFORMATION_SCHEMA.TABLES AS t WHERE t.TABLE_SCHEMA = 'db_project'");
		return $sql;
	}
}
