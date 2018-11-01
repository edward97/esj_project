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
        if (!$this->db->delete($table, $where)) {
            $error = $this->db->error(); // Has keys 'code' and 'message';
        }
        return $error;
    }
    
    // search data - like
	public function _search($table, $column, $data) {
		$this->db->like($column, $data, 'both');
		$this->db->limit(5);

		return $this->db->get($table);
	}
}
