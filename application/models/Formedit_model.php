<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formedit_model extends CI_Model {
    private $table = 'tbl_formedit';
    private $column_order = array(NULL, 'date', 'id_formedit', 'nm_user', 'no_transaksi', 'nm_permintaan', NULL);
    private $column_search = array('date', 'id_formedit', 'nm_user', 'no_transaksi', 'nm_permintaan');
    private $order = array('id_formedit' => 'DESC');
    
    private function _get_data() {
        $this->db->from($this->table);

        // join tbl_divisi
        $this->db->join('tbl_users', 'tbl_users.id_user = tbl_formedit.id_user', 'left');
        $this->db->join('tbl_permintaan', 'tbl_permintaan.id_permintaan = tbl_formedit.id_permintaan', 'left');

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
        $userid = $this->input->post('user-id');
        $date = mdate("%Y-%m-%d %H:%i", strtotime($this->input->post('formedit-date')));
        $notransaksi = $this->input->post('no-transaksi');
        $permintaan = $this->input->post('permintaan-id');
        $description = $this->input->post('description');

        $data = array(
            'date' => $date,
            'no_transaksi' => $notransaksi,
            'description' => $description,
            'id_user' => $userid,
            'id_permintaan' => $permintaan
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
        $where = array(
			'id_formedit' => $id
        );
        
        // return row data
		return $this->db->get_where($this->table, $where)->row();
    }

    // update
    public function _update() {
        $formeditid = $this->input->post('formedit-id');
        $date = mdate("%Y-%m-%d %H:%i", strtotime($this->input->post('formedit-date')));
        $userid = $this->input->post('user-id');
        $notransaksi = $this->input->post('no-transaksi');
        $permintaan = $this->input->post('permintaan-id');
        $description = $this->input->post('description');

        $data = array(
            'date' => $date,
            'no_transaksi' => $notransaksi,
            'description' => $description,
            'id_user' => $userid,
            'id_permintaan' => $permintaan
        );
        $where = array(
            'id_formedit' => $formeditid
        );
        $this->db->update($this->table, $data, $where);

        return $formeditid;
    }

    // delete
    public function _delete($id) {
        if ($this->db->simple_query('DELETE FROM `'.$this->table.'` WHERE `id_formedit` = '.$id)) {
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
