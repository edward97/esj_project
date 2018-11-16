<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pr_model extends CI_Model {
    private $table = 'tbl_pr';
    private $table_detail = 'tbl_pr_detail';
    private $column_order = array(NULL, 'id_pr', 'date', 'nm_supplier', 'nm_warehouse', 'description', NULL);
    private $column_search = array('id_pr', 'date', 'nm_supplier', 'nm_warehouse', 'description');
    private $order = array('id_pr' => 'DESC');
    
    private function _get_data() {
        $this->db->from($this->table);

        // join tbl_divisi
        $this->db->join('tbl_supplier', 'tbl_supplier.id_supplier = tbl_pr.id_supplier', 'left');
        $this->db->join('tbl_warehouse', 'tbl_warehouse.id_warehouse = tbl_pr.id_warehouse', 'left');

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
        $podate = mdate("%Y-%m-%d %H:%i", strtotime($this->input->post('pr-date')));
        $poid = $this->input->post('po-id');
        $description = $this->input->post('description');
        $supplierid = $this->input->post('supplier-id');
        $warehouseid = $this->input->post('warehouse-id');

        // array item detail
        $detailid = $this->input->post('addr');
        $detailqty = $this->input->post('detail-qty');

        $data = array(
            'date' => $podate,
            'description' => $description,
            'id_po' => $poid,
            'id_supplier' => $supplierid,
            'id_warehouse' => $warehouseid,
        );
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();

        $arr_data = array();
        foreach ($detailid as $i => $item) {

            array_push($arr_data, array(
                'pr_qty' => $detailqty[$i],
                'id_pr' => $id,
                'id_po_detail' => $item,
            ));
        }
        $this->db->insert_batch($this->table_detail, $arr_data);

        // return last insert id
        $q = $this->db->get_where($this->table, array('id_pr' => $id))->row_array();
        return $q['id_pr'];
    }

    // read
    public function _read() {
        return $this->db->get($this->table)->result();
    }

    public function _read_item_po() {
        $id = $this->input->get('id');
        
        $this->db->select('*');
        $this->db->from('tbl_po_detail');
        $this->db->join('tbl_items',  'tbl_items.id_item = tbl_po_detail.id_item', 'left');
        $this->db->join('tbl_items_detail',  'tbl_items_detail.id_size = tbl_po_detail.id_size', 'left');
        $this->db->where('tbl_po_detail.id_po', $id);

        return $this->db->get()->result();
    }

    // read by id
    public function _read_where($id) {
        $where = array(
			'id_pr' => $id
        );
        
        // return row data
		return $this->db->get_where($this->table, $where)->row();
    }

    // read list by id
    public function _read_where_list($id) {
        $this->db->select('*');
        $this->db->from($this->table_detail);
        $this->db->join('tbl_po_detail',  'tbl_po_detail.id_po_detail = tbl_pr_detail.id_po_detail', 'left');
        $this->db->where('tbl_pr_detail.id_pr', $id);

        // return row data
		return $this->db->get()->result();
    }

    // // update
    // public function _update() {
    //     $poid = $this->input->post('pr-id');
    //     $podate = mdate("%Y-%m-%d %H:%i", strtotime($this->input->post('pr-date')));
    //     $description = $this->input->post('description');
    //     $supplierid = $this->input->post('supplier-id');
    //     $warehouseid = $this->input->post('warehouse-id');

    //     // array item detail
    //     $addr = $this->input->post('addr');
    //     $detailid = $this->input->post('detail-id');
    //     $detailname = $this->input->post('detail-name');
    //     $detailqty = $this->input->post('detail-qty');
    //     $detailrate = $this->input->post('detail-rate');

    //     $data = array(
    //         'date' => $podate,
    //         'description' => $description,
    //         'id_supplier' => $supplierid,
    //         'id_warehouse' => $warehouseid,
    //     );
    //     $where = array(
    //         'id_pr' => $poid
    //     );
    //     $this->db->update($this->table, $data, $where);

    //     $arr_id = $arr_addr = $arr_data = array();
    //     foreach ($addr as $i => $value) {
    //         $code = explode('-', $detailid[$i]);

    //         if ($value != 'New') {
    //             array_push($arr_id, $value);

    //             array_push($arr_addr, array(
    //                 'unq' => $value,
    //                 'nm_po_item' => $detailname[$i],
    //                 'qty' => $detailqty[$i],
    //                 'rate' => $detailrate[$i],
    //                 'id_pr' => $poid,
    //                 'id_item' => $code[0],
    //                 'id_size' => $code[1],
    //             ));
    //         } else {
    //             array_push($arr_data, array(
    //                 'unq' => rd_code(12),
    //                 'nm_po_item' => $detailname[$i],
    //                 'qty' => $detailqty[$i],
    //                 'rate' => $detailrate[$i],
    //                 'id_pr' => $poid,
    //                 'id_item' => $code[0],
    //                 'id_size' => $code[1],
    //             ));
    //         }
    //     }
    //     // delete data
    //     if (!empty($arr_id)) {
    //         $this->db->where($where)
    //         ->where_not_in('unq', $arr_id)
    //         ->delete($this->table_detail);
    //     } else {
    //         $this->db->delete($this->table_detail, $where);
    //     }

    //     // udpate batch
    //     $this->db->update_batch($this->table_detail, $arr_addr, 'unq');

    //     // insert batch
    //     if (!empty($arr_data)) {
    //         $this->db->insert_batch($this->table_detail, $arr_data);
    //     }
    //     return $poid;
    // }

    // delete
    public function _delete($id) {
        if ($this->db->simple_query('DELETE FROM `'.$this->table.'` WHERE `id_pr` = '.$id)) {
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
