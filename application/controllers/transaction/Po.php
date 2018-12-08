<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Po extends CI_Controller {
	public function __construct() {
		parent::__construct();

		if ($this->session->userdata('logged_in') !== TRUE) {
			redirect('welcome/login');
		}
		$this->load->model('beta_model', 'beta');
		$this->load->model('transaction/po_model', 'model');
	}

	public function index() {
		$data['title'] = 'Purchase Order';

		$this->load->view('inc/v_header', $data);
		$this->load->view('transaction/v_po');
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
			$row[] = d_date($i->po_date);
			$row[] = $i->nm_supplier;
			$row[] = $i->nm_warehouse;

			$row[] = '<a href="javascript:;" class="btn btn-custom btn-primary" data-detail="'.$i->id_po.'"><i class="fas fa-eye"></i> Detail</a>';

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

	public function store() {
		$data = array(
			'status' => FALSE,
			'msg' => array()
		);

		$this->form_validation->set_rules('po-date', 'Date', 'trim|required');
		$this->form_validation->set_rules('supplier-nm', 'Supplier', 'trim|required|callback_supplier_check');
		$this->form_validation->set_rules('warehouse-nm', 'Warehouse', 'trim|required|callback_warehouse_check');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

		if ($this->form_validation->run()) {
			$sql = $this->model->_create();

			$data['status'] = TRUE;
			$data['id'] = $sql;
			$data['msg'] = '[ ID: '.$sql.' ] Add Po - Successfully...';
		} else {
			foreach ($_POST as $key => $value) {
				$data['msg'][$key] = form_error($key);
			}
		}
		echo json_encode($data);
	}
	
	public function edit($id) {
		$arr = $this->model->_read_where($id);
		// change format date
		$arr->po_date = d_date($arr->po_date);
		$data['po'] = $arr;
		$data['po_detail'] = $this->model->_read_where_list($id);

		echo json_encode($data);
	}
	
	public function update() {
		$data = array(
			'status' => FALSE,
			'msg' => array()
		);

		$this->form_validation->set_rules('po-date', 'Date', 'trim|required');
		$this->form_validation->set_rules('supplier-nm', 'Supplier', 'trim|required|callback_supplier_check');
		$this->form_validation->set_rules('warehouse-nm', 'Warehouse', 'trim|required|callback_warehouse_check');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

		if ($this->form_validation->run()) {
			$sql = $this->model->_update();

			$data['status'] = TRUE;
			$data['id'] = $sql;
			$data['msg'] = '[ ID: '.$sql.' ] Update Po - Successfully...';
		} else {
			foreach ($_POST as $key => $value) {
				$data['msg'][$key] = form_error($key);
			}
		}
		echo json_encode($data);
	}

	public function destroy($id) {
		$data = $this->model->_delete($id);
		echo json_encode($data);
	}

	// ----------------------
	// custom form_validation
	public function supplier_check() {
		$supplierid = $this->input->post('supplier-nm');

		$where = array(
			'nm_supplier' => $supplierid,
		);
		$check = $this->beta->_read_where('tbl_supplier', $where)->num_rows();

		if (!$check) {
			$this->form_validation->set_message('supplier_check', 'The {field} does not exists');
			return FALSE;
		} else {
			return TRUE;
		}
    }
    public function warehouse_check() {
		$warehouseid = $this->input->post('warehouse-nm');

		$where = array(
			'nm_warehouse' => $warehouseid,
		);
		$check = $this->beta->_read_where('tbl_warehouse', $where)->num_rows();

		if (!$check) {
			$this->form_validation->set_message('warehouse_check', 'The {field} does not exists');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}
