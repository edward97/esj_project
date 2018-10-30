<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beta_model extends CI_Model {
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
}
