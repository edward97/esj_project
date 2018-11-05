<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Po_model extends CI_Model {
    private $table = 'tbl_po';
    private $column_order = array(NULL, 'id_po', 'date', 'nm_supplier', 'nm_warehouse', 'description', NULL);
    private $column_search = array('id_po', 'date', 'nm_supplier', 'nm_warehouse', 'description');
    private $order = array('id_po' => 'DESC');
    
    private function _get_data() {
        $this->db->from($this->table);

        // join tbl_divisi
        $this->db->join('tbl_supplier', 'tbl_supplier.id_supplier = tbl_po.id_supplier', 'left');
        $this->db->join('tbl_warehouse', 'tbl_warehouse.id_warehouse = tbl_po.id_warehouse', 'left');

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
        $podate = $this->input->post('po-date');
        $description = $this->input->post('description');
        $supplierid = $this->input->post('supplier-id');
        $warehouseid = $this->input->post('warehouse-id');

        $data = array(
            'date' => $podate,
            'description' => $description,
            'id_supplier' => $supplierid,
            'id_warehouse' => $warehouseid,
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
			'id_po' => $id
        );
        
        // return row data
		return $this->db->get_where($this->table, $where)->row();
    }

    // update
    public function _update() {
        $poid = $this->input->post('po-id');
        $podate = $this->input->post('po-date');
        $description = $this->input->post('description');
        $supplierid = $this->input->post('supplier-id');
        $warehouseid = $this->input->post('warehouse-id');

        $data = array(
            'date' => $podate,
            'description' => $description,
            'id_supplier' => $supplierid,
            'id_warehouse' => $warehouseid,
        );
        $where = array(
            'id_po' => $poid
        );
        $this->db->update($this->table, $data, $where);

        return $poid;
    }

    // delete
    public function _delete($id) {
        if ($this->db->simple_query('DELETE FROM `'.$this->table.'` WHERE `id_po` = '.$id)) {
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
