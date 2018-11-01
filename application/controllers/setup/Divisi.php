<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Divisi extends CI_Controller {
	public function __construct() {
        parent::__construct();

        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('welcome/login');
        }
		$this->load->model('setup/divisi_model');
	}

	public function index() {
        $data['title'] = 'Divisi';

		$this->load->view('inc/v_header', $data);
		$this->load->view('setup/v_divisi');
		$this->load->view('inc/v_footer');
	}

	public function list() {
		$list = $this->divisi_model->read_data();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $i) {
			$row = array();
			
			$row[] = ++$no;
			$row[] = $i->id_divisi;
			$row[] = $i->nm_divisi;

			// $row[] = '<button class="btn btn-primary btn-sm" data-edit="'.$i->id_divisi.'"><i class="far fa-edit"></i></button><button class="btn btn-danger btn-sm" data-delete="'.$i->id_divisi.'"><i class="far fa-trash-alt"></i></button>';
			$row[] = '<a href="javascript:;" class="badge badge-primary" data-edit="'.$i->id_divisi.'"><i class="far fa-edit"></i></a>
			<a href="javascript:;" class="badge badge-danger" data-delete="'.$i->id_divisi.'"><i class="far fa-trash-alt"></i></a>';

			$data[] = $row;
		}
		$output = array(
			'draw' => $_POST['draw'],
			'recordsTotal' => $this->divisi_model->count_data(),
			'recordsFiltered' => $this->divisi_model->count_data_filtered(),
			'data' => $data
		);
		echo json_encode($output);
	}

	public function add() {
		$data = array(
			'status' => FALSE,
			'msg' => array()
		);

		$this->form_validation->set_rules('divisi-nm', 'Divisi', 'trim|required|max_length[255]|is_unique[tbl_divisi.nm_divisi]');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

		if ($this->form_validation->run()) {
			$sql = $this->divisi_model->_create();

			$data['status'] = TRUE;
			$data['msg'] = '<div class="alert alert-success" role="alert">[ ID: '.$sql.' ] Add Divisi - Successfully...</div>';
		} else {
			foreach ($_POST as $key => $value) {
				$data['msg'][$key] = form_error($key);
			}
		}
		echo json_encode($data);
	}

	public function edit($id) {
		$data = $this->divisi_model->_read_where($id);
		echo json_encode($data);
	}

	public function update() {
		$data = array(
			'status' => FALSE,
			'msg' => array()
		);

		$this->form_validation->set_rules('divisi-nm', 'Divisi', 'trim|required|max_length[255]|callback_divisi_check');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

		if ($this->form_validation->run()) {
			$sql = $this->divisi_model->_update();

			$data['status'] = TRUE;
			$data['msg'] = '<div class="alert alert-primary" role="alert">[ ID: '.$sql.' ] Update Divisi - Successfully...</div>';
		} else {
			foreach ($_POST as $key => $value) {
				$data['msg'][$key] = form_error($key);
			}
		}
		echo json_encode($data);
	}

	public function delete($id) {
		$data = $this->divisi_model->_delete($id);
		echo json_encode($data);
	}

	// custom validation
	public function divisi_check() {
		$check = $this->divisi_model->_count_data();

		if ($check) {
			$this->form_validation->set_message('divisi_check', 'The {field} already exists');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}

