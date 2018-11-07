<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Size_model extends CI_Model {
    private $table = 'tbl_items_detail';
    private $column_order = array(NULL, 'id_size', 'nm_size', NULL);
    private $column_search = array('id_size', 'nm_size');
    private $order = array('id_size' => 'DESC');
    
    private function _get_data($id) {
        $this->db->from($this->table);
        $this->db->where('id_item', $id);
        $i = 0;

        foreach ($this->column_search as $size) {
            // if datatable send post for search
            if ($_POST['search']['value']) {
                if ($i == 0) {
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($size, $_POST['search']['value']);
                } else {
                    $this->db->or_like($size, $_POST['search']['value']);
                }
                // last loop
                if (count($this->column_search)-1 == $i) {
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }
        
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } elseif (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function read_data($id) {
        $this->_get_data($id);

        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function count_data_filtered($id) {
        $this->_get_data($id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_data($id) {
        $this->db->from($this->table);
        $this->db->where('id_item', $id);
        return $this->db->count_all_results();
    }

    // ----------------------------------------

    // create
    public function _create() {
        $sizenm = dt_filter($this->input->post('size-nm'));
        $itemid = $this->input->post('item-id');

        $data = array(
            'nm_size' => $sizenm,
            'id_item' => $itemid
        );
        $this->db->insert($this->table, $data);

        return $this->db->insert_id();
    }

    // read
    public function _read() {
        return $this->db->get($this->table)->result();
    }

    // read by id
    public function _read_where($id) {
        $where = array(
			'id_size' => $id
        );
        
        // return row data
		return $this->db->get_where($this->table, $where)->row();
    }

    // update
    public function _update() {
        $sizeid = $this->input->post('size-id');
        $sizenm = dt_filter($this->input->post('size-nm'));

        $data = array(
            'nm_size' => $sizenm,
        );
        $where = array(
            'id_size' => $sizeid
        );
        $this->db->update($this->table, $data, $where);

        return $sizeid;
    }

    // delete
    public function _delete($id) {
        if ($this->db->simple_query('DELETE FROM `'.$this->table.'` WHERE `id_size` = '.$id)) {
            $data = array(
                'status' => TRUE
            );
        } else {
            $data = array(
                'status' => FALSE,
                'msg' => $this->db->error()
            );
        }
        return $data;
    }
}
