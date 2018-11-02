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
		$this->db->limit(5);

		return $this->db->get($table);
    }
    
    // custom - get list table
    public function _get_table() {
		$sql = $this->db->query("SELECT t.TABLE_NAME AS t_name FROM INFORMATION_SCHEMA.TABLES AS t WHERE t.TABLE_SCHEMA = 'db_project'");
		return $sql;
	}
}
