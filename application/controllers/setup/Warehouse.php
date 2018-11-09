<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends CI_Controller {
	public function __construct() {
        parent::__construct();

        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('welcome/login');
        }
		$this->load->model('beta_model', 'beta');
		$this->load->model('setup/warehouse_model', 'model');
	}

	public function index() {
        $data['title'] = 'Warehouse';

		$this->load->view('inc/v_header', $data);
		$this->load->view('setup/v_warehouse');
		$this->load->view('inc/v_footer');
	}

	public function list() {
		$list = $this->model->read_data();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $i) {
			$row = array();
			
			$row[] = ++$no;
			$row[] = $i->id_warehouse;
			$row[] = $i->nm_warehouse;

			$row[] = '<a href="javascript:;" class="btn-custom btn-primary" data-edit="'.$i->id_warehouse.'"><i class="far fa-edit"></i></a>
			<a href="javascript:;" class="btn-custom btn-danger" data-delete="'.$i->id_warehouse.'"><i class="far fa-trash-alt"></i></a>';

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

	public function add() {
		$data = array(
			'status' => FALSE,
			'msg' => array()
		);

		$this->form_validation->set_rules('warehouse-nm', 'Warehouse', 'trim|required|max_length[255]|is_unique[tbl_warehouse.nm_warehouse]');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

		if ($this->form_validation->run()) {
			$sql = $this->model->_create();

			$data['status'] = TRUE;
			$data['msg'] = '<div class="alert alert-success" role="alert">[ ID: '.$sql.' ] Add Warehouse - Successfully...</div>';
		} else {
			foreach ($_POST as $key => $value) {
				$data['msg'][$key] = form_error($key);
			}
		}
		echo json_encode($data);
	}

	public function edit($id) {
		$data = $this->model->_read_where($id);
		echo json_encode($data);
	}

	public function update() {
		$data = array(
			'status' => FALSE,
			'msg' => array()
		);

		$this->form_validation->set_rules('warehouse-nm', 'Warehouse', 'trim|required|max_length[255]|callback_warehouse_check');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

		if ($this->form_validation->run()) {
			$sql = $this->model->_update();

			$data['status'] = TRUE;
			$data['msg'] = '<div class="alert alert-primary" role="alert">[ ID: '.$sql.' ] Update Warehouse - Successfully...</div>';
		} else {
			foreach ($_POST as $key => $value) {
				$data['msg'][$key] = form_error($key);
			}
		}
		echo json_encode($data);
	}

	public function delete($id) {
		$data = $this->model->_delete($id);
		echo json_encode($data);
	}

	// ----------------------
	// custom form_validation
	public function warehouse_check() {
		$warehouseid = $this->input->post('warehouse-id');
		$warehousenm = $this->input->post('warehouse-nm');

		$where = array(
			'id_warehouse !=' => $warehouseid,
            'nm_warehouse' => $warehousenm
		);
		$check = $this->beta->_read_where('tbl_warehouse', $where)->num_rows();

		if ($check) {
			$this->form_validation->set_message('warehouse_check', 'The {field} already exists');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}
