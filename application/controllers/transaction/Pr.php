<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pr extends CI_Controller {
	public function __construct() {
        parent::__construct();

        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('welcome/login');
        }
		$this->load->model('beta_model', 'beta');
		$this->load->model('transaction/pr_model', 'model');
	}

	public function index() {
        $data['title'] = 'Purchase Receipt';

		$this->load->view('inc/v_header', $data);
		$this->load->view('transaction/v_pr');
		$this->load->view('inc/v_footer');
	}

	public function list() {
		$list = $this->model->read_data();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $i) {
			$row = array();
			
			$row[] = ++$no;
			$row[] = $i->id_po;
			$row[] = mdate("%d-%M-%Y %H:%i", strtotime($i->date));
			$row[] = $i->nm_supplier;
			$row[] = $i->nm_warehouse;
			$row[] = $i->description;

			$row[] = '<a href="javascript:;" class="btn btn-custom btn-primary" data-direct="'.$i->id_po.'"><i class="far fa-edit"></i></a>
			<a href="javascript:;" class="btn btn-custom btn-danger" data-delete="'.$i->id_po.'"><i class="far fa-trash-alt"></i></a>';

			$data[] = $row;
		}
		$output = array(
			'draw' => $_POST['draw'],
			'recordsTotal' => $this->model->count_data(),
			'recordsFiltered' => $this->model->count_data_filtered(),
			'data' => $data
		);
		echo json_encode($output);
	}

	// public function add() {
	// 	$data = array(
	// 		'status' => FALSE,
	// 		'msg' => array()
	// 	);

	// 	$this->form_validation->set_rules('po-date', 'Date', 'trim|required');
	// 	$this->form_validation->set_rules('supplier-id', 'Supplier', 'trim|required|callback_supplier_check');
	// 	$this->form_validation->set_rules('warehouse-id', 'Warehouse', 'trim|required|callback_warehouse_check');
	// 	$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

	// 	if ($this->form_validation->run()) {
	// 		$sql = $this->model->_create();

	// 		$data['status'] = TRUE;
	// 		$data['id'] = $sql;
	// 		$data['msg'] = '[ ID: '.$sql.' ] Add Po - Successfully...';
	// 	} else {
	// 		foreach ($_POST as $key => $value) {
	// 			$data['msg'][$key] = form_error($key);
	// 		}
	// 	}
	// 	echo json_encode($data);
	// }

	// public function edit($id) {
	// 	$arr = $this->model->_read_where($id);
	// 	// change format date
	// 	$arr->date = mdate("%d-%M-%Y %H:%i", strtotime($arr->date));
	// 	$data['po'] = $arr;

	// 	$data['pr_detail'] = $this->model->_read_where_list($id);
	// 	echo json_encode($data);
	// }

	// public function update() {
	// 	$data = array(
	// 		'status' => FALSE,
	// 		'msg' => array()
	// 	);

	// 	$this->form_validation->set_rules('po-date', 'Date', 'trim|required');
	// 	$this->form_validation->set_rules('supplier-id', 'Supplier', 'trim|required|callback_supplier_check');
	// 	$this->form_validation->set_rules('warehouse-id', 'Warehouse', 'trim|required|callback_warehouse_check');
	// 	$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

	// 	if ($this->form_validation->run()) {
	// 		$sql = $this->model->_update();

	// 		$data['status'] = TRUE;
	// 		$data['msg'] = '[ ID: '.$sql.' ] Update Po - Successfully...';
	// 	} else {
	// 		foreach ($_POST as $key => $value) {
	// 			$data['msg'][$key] = form_error($key);
	// 		}
	// 	}
	// 	echo json_encode($data);
	// }

	// public function delete($id) {
	// 	$data = $this->model->_delete($id);
	// 	echo json_encode($data);
	// }

	// // ----------------------
	// // custom form_validation
	// public function supplier_check() {
	// 	$supplierid = $this->input->post('supplier-id');

	// 	$where = array(
	// 		'id_supplier' => $supplierid,
	// 	);
	// 	$check = $this->beta->_read_where('tbl_supplier', $where)->num_rows();

	// 	if (!$check) {
	// 		$this->form_validation->set_message('supplier_check', 'The {field} does not exists');
	// 		return FALSE;
	// 	} else {
	// 		return TRUE;
	// 	}
    // }
    // public function warehouse_check() {
	// 	$warehouseid = $this->input->post('warehouse-id');

	// 	$where = array(
	// 		'id_warehouse' => $warehouseid,
	// 	);
	// 	$check = $this->beta->_read_where('tbl_warehouse', $where)->num_rows();

	// 	if (!$check) {
	// 		$this->form_validation->set_message('warehouse_check', 'The {field} does not exists');
	// 		return FALSE;
	// 	} else {
	// 		return TRUE;
	// 	}
	// }

	// // -------------------- PO DETAIL --------------------
	public function act() {
		$uri = gt_uri(4);

		if ($uri === 'new') {
			$data['title'] = 'New PR';

			$this->load->view('inc/v_header', $data);
			$this->load->view('transaction/v_pr_detail');
			$this->load->view('inc/v_footer');
		}
		elseif ($uri === 'detail') {
			$data['title'] = 'Detail PR';

			$this->load->view('inc/v_header', $data);
			$this->load->view('transaction/v_pr_detail');
			$this->load->view('inc/v_footer');
		}
	}
}
