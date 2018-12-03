<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formedit extends CI_Controller {
	public function __construct() {
        parent::__construct();

        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('welcome/login');
        }
		$this->load->model('beta_model', 'beta');
		$this->load->model('formedit_model', 'model');
	}

	public function index() {
        $data['title'] = 'Form Edit';

		$this->load->view('inc/v_header', $data);
		$this->load->view('v_formedit');
		$this->load->view('inc/v_footer');
	}

	public function list() {
		$list = $this->model->read_data();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $i) {
			$row = array();
			
			$row[] = ++$no;
			$row[] = mdate("%d-%M-%Y %H:%i", strtotime($i->date));
			$row[] = $i->id_formedit;
			$row[] = $i->nm_user;
			$row[] = $i->no_transaksi;
			$row[] = $i->nm_permintaan;

			$row[] = '<a href="javascript:;" class="btn btn-custom btn-primary" data-edit="'.$i->id_formedit.'"><i class="far fa-edit"></i></a>
			<a href="javascript:;" class="btn btn-custom btn-danger" data-delete="'.$i->id_formedit.'"><i class="far fa-trash-alt"></i></a>';

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

		$this->form_validation->set_rules('user-nm', 'Username', 'trim|required|max_length[255]|callback_user_check');
		$this->form_validation->set_rules('formedit-date', 'Date', 'trim|required');
		$this->form_validation->set_rules('no-transaksi', 'No. Transaksi', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('permintaan-nm', 'Permintaan', 'trim|required|max_length[255]|callback_permintaan_check');
		$this->form_validation->set_rules('description', 'Keterangan', 'trim|required|max_length[255]');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

		if ($this->form_validation->run()) {
			$sql = $this->model->_create();

			$data['status'] = TRUE;
			$data['msg'] = '<div class="alert alert-success" role="alert">[ ID: '.$sql.' ] Add Formedit - Successfully...</div>';
		} else {
			foreach ($_POST as $key => $value) {
				$data['msg'][$key] = form_error($key);
			}
		}
		echo json_encode($data);
	}

	public function edit($id) {
		$data = $this->model->_read_where($id);
		// change format date
		$data->date = mdate("%d-%M-%Y %H:%i", strtotime($data->date));
		echo json_encode($data);
	}

	public function update() {
		$data = array(
			'status' => FALSE,
			'msg' => array()
		);

		$this->form_validation->set_rules('user-nm', 'Username', 'trim|required|max_length[255]|callback_user_check');
		$this->form_validation->set_rules('formedit-date', 'Date', 'trim|required');
		$this->form_validation->set_rules('no-transaksi', 'No. Transaksi', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('permintaan-nm', 'Permintaan', 'trim|required|max_length[255]|callback_permintaan_check');
		$this->form_validation->set_rules('description', 'Keterangan', 'trim|required|max_length[255]');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

		if ($this->form_validation->run()) {
			$sql = $this->model->_update();

			$data['status'] = TRUE;
			$data['msg'] = '<div class="alert alert-primary" role="alert">[ ID: '.$sql.' ] Update Formedit - Successfully...</div>';
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
	public function user_check($data) {
		$where = array(
			'nm_user' => $data,
		);
		$check = $this->beta->_read_where('tbl_users', $where)->num_rows();

		if (!$check) {
			$this->form_validation->set_message('user_check', 'The {field} does not exist');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function permintaan_check($data) {
		$where = array(
			'nm_permintaan' => $data,
		);
		$check = $this->beta->_read_where('tbl_permintaan', $where)->num_rows();

		if (!$check) {
			$this->form_validation->set_message('permintaan_check', 'The {field} does not exist');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}
