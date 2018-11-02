<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct() {
        parent::__construct();

        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('welcome/login');
        }
		$this->load->model('beta_model', 'beta');
		$this->load->model('setup/user_model', 'model');
	}

	public function index() {
        $data['title'] = 'User';

		$this->load->view('inc/v_header', $data);
		$this->load->view('setup/v_user');
		$this->load->view('inc/v_footer');
	}

	public function list() {
		$list = $this->model->read_data();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $i) {
			$row = array();
			
			$row[] = ++$no;
			$row[] = $i->id_user;
			$row[] = $i->nm_user;
			$row[] = $i->nm_divisi;

			$row[] = '<a href="javascript:;" class="badge badge-primary" data-edit="'.$i->id_user.'"><i class="far fa-edit"></i></a>
			<a href="javascript:;" class="badge badge-danger" data-delete="'.$i->id_user.'"><i class="far fa-trash-alt"></i></a>';

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

		$this->form_validation->set_rules('user-nm', 'Username', 'trim|required|max_length[255]|is_unique[tbl_users.nm_user]');
		$this->form_validation->set_rules('user-pass', 'Password', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('divisi-id', 'Divisi', 'trim|required|callback_divisi_check');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

		if ($this->form_validation->run()) {
			$sql = $this->model->_create();

			$data['msg'] = '<div class="alert alert-success" role="alert">[ ID: '.$sql.' ] Add User - Successfully...</div>';
			$data['status'] = TRUE;
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

		$this->form_validation->set_rules('user-nm', 'Username', 'trim|required|max_length[255]|callback_user_check');
		$this->form_validation->set_rules('user-pass', 'Password', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('divisi-id', 'Divisi', 'trim|required|callback_divisi_check');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

		if ($this->form_validation->run()) {
			$sql = $this->model->_update();

			$data['msg'] = '<div class="alert alert-primary" role="alert">[ ID: '.$sql.' ] Update User - Successfully...</div>';
			$data['status'] = TRUE;
		} else {
			foreach ($_POST as $key => $value) {
				$data['msg'][$key] = form_error($key);
			}
		}
		echo json_encode($data);
	}

	public function delete($id) {
		$this->model->_delete($id);
		echo json_encode(array('status' => TRUE));
	}

	// ----------------------
	// custom form_validation
	public function user_check() {
		$userid = $this->input->post('user-id');
		$username = $this->input->post('user-nm');

		$where = array(
			'id_user !=' => $userid,
			'nm_user' => $username
		);
		$check = $this->beta->_read_where('tbl_users', $where)->num_rows();

		if ($check) {
			$this->form_validation->set_message('user_check', 'The {field} already exists');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function divisi_check($data) {
		$where = array(
			'id_divisi' => $data
		);
		$check = $this->beta->_read_where('tbl_divisi', $where)->num_rows();
		if (!$check) {
			$this->form_validation->set_message('divisi_check', 'The {field} does not exist');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}
