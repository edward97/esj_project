<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    private $table = 'tbl_users';
    private $column_order = array(NULL, 'id_user', 'nm_user', 'tbl_divisi.nm_divisi', NULL);
    private $column_search = array('id_user', 'nm_user', 'tbl_divisi.nm_divisi');
    private $order = array('id_user' => 'DESC');

    private function _get_data() {
        $this->db->from($this->table);

        // join tbl_divisi
        $this->db->join('tbl_divisi', 'tbl_divisi.id_divisi = tbl_users.id_divisi', 'left');

        $i = 0;

        foreach ($this->column_search as $item) {
            // if datatable send post for search
            if ($_POST['search']['value']) {
                if ($i == 0) {
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
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

    public function read_data() {
        $this->_get_data();

        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function count_data_filtered() {
        $this->_get_data();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_data() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    // ----------------------------------------

    // create
    public function _create() {
        $usernm = dt_filter($this->input->post('user-nm'));
        $userpass = $this->input->post('user-pass');
        $divisiid = $this->input->post('divisi-id');

        $data = array(
            'nm_user' => $usernm,
            'pass_user' => md5($userpass),
            'id_divisi' => $divisiid
        );
        $this->db->insert($this->table, $data);

        // return last insert id
        return $this->db->insert_id();
    }

    // read
    public function _read() {
        return $this->db->get($this->table)->result();
    }

    // read by id
    public function _read_where($id) {
        $this->db->join('tbl_divisi', 'tbl_divisi.id_divisi = tbl_users.id_divisi', 'left');
        $where = array(
			'id_user' => $id
        );
        
        // return row data
		return $this->db->get_where($this->table, $where)->row();
    }

    // update
    public function _update() {
        $userid = $this->input->post('user-id');
        $usernm = dt_filter($this->input->post('user-nm'));
        $userpass = $this->input->post('user-pass');
        $divisiid = $this->input->post('divisi-id');

        $data = array(
            'nm_user' => $usernm,
            'pass_user' => md5($userpass),
            'id_divisi' => $divisiid
        );
        $where = array(
            'id_user' => $userid
        );
        $this->db->update($this->table, $data, $where);

        return $userid;
    }

    // delete
    public function _delete($id) {
        if ($this->db->simple_query('DELETE FROM `'.$this->table.'` WHERE `id_user` = '.$id)) {
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
