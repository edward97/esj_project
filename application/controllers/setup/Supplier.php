<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {
	public function __construct() {
        parent::__construct();

        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('welcome/login');
        }
		$this->load->model('beta_model', 'beta');
		$this->load->model('setup/supplier_model', 'model');
	}

	public function index() {
        $data['title'] = 'Supplier';

		$this->load->view('inc/v_header', $data);
		$this->load->view('setup/v_supplier');
		$this->load->view('inc/v_footer');
	}

	public function list() {
		$list = $this->model->read_data();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $i) {
			$row = array();
			
			$row[] = ++$no;
			$row[] = $i->id_supplier;
			$row[] = $i->nm_supplier;
			$row[] = $i->address;

			$row[] = '<a href="javascript:;" class="badge badge-primary" data-edit="'.$i->id_supplier.'"><i class="far fa-edit"></i></a>
			<a href="javascript:;" class="badge badge-danger" data-delete="'.$i->id_supplier.'"><i class="far fa-trash-alt"></i></a>';

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

		$this->form_validation->set_rules('supplier-nm', 'Supplier', 'trim|required|max_length[255]|is_unique[tbl_supplier.nm_supplier]');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

		if ($this->form_validation->run()) {
			$sql = $this->model->_create();

			$data['status'] = TRUE;
			$data['msg'] = '<div class="alert alert-success" role="alert">[ ID: '.$sql.' ] Add Supplier - Successfully...</div>';
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

		$this->form_validation->set_rules('supplier-nm', 'Supplier', 'trim|required|max_length[255]|callback_supplier_check');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

		if ($this->form_validation->run()) {
			$sql = $this->model->_update();

			$data['status'] = TRUE;
			$data['msg'] = '<div class="alert alert-primary" role="alert">[ ID: '.$sql.' ] Update Supplier - Successfully...</div>';
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
	public function supplier_check() {
		$supplierid = $this->input->post('supplier-id');
		$suppliernm = $this->input->post('supplier-nm');

		$where = array(
			'id_supplier !=' => $supplierid,
            'nm_supplier' => $suppliernm
		);
		$check = $this->beta->_read_where('tbl_supplier', $where)->num_rows();

		if ($check) {
			$this->form_validation->set_message('supplier_check', 'The {field} already exists');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}
