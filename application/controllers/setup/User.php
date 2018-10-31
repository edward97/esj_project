<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct() {
        parent::__construct();

        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('welcome/login');
        }
		$this->load->model('beta_model', 'beta');
		$this->load->model('setup/user_model', 'user');
	}

	public function index() {
        $data['title'] = 'User';

		$this->load->view('inc/v_header', $data);
		$this->load->view('setup/v_user');
		$this->load->view('inc/v_footer');
	}

	public function list() {
		$list = $this->user->read_data();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $i) {
			$row = array();
			
			$row[] = ++$no;
			$row[] = $i->id_user;
			$row[] = $i->nm_user;
			$row[] = $i->divisi;

			// $row[] = '<button class="btn btn-primary btn-sm" data-edit="'.$i->id_user.'"><i class="far fa-edit"></i></button><button class="btn btn-danger btn-sm" data-delete="'.$i->id_user.'"><i class="far fa-trash-alt"></i></button>';
			$row[] = '<a href="javascript:;" class="badge badge-primary" data-edit="'.$i->id_user.'"><i class="far fa-edit"></i></a>
			<a href="javascript:;" class="badge badge-danger" data-delete="'.$i->id_user.'"><i class="far fa-trash-alt"></i></a>';

			$data[] = $row;
		}
		$output = array(
			'draw' => $_POST['draw'],
			'recordsTotal' => $this->user->count_data(),
			'recordsFiltered' => $this->user->count_data_filtered(),
			'data' => $data
		);
		echo json_encode($output);
	}

	public function add() {
		$data = array(
			'status' => FALSE,
			'msg' => array()
		);

		$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[255]|is_unique[tbl_users.nm_user]');
		$this->form_validation->set_rules('userpass', 'Password', 'trim|required|max_length[255]');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

		if ($this->form_validation->run()) {
			$username = dt_filter($this->input->post('username'));
			$userpass = $this->input->post('userpass');

			$val = array(
				'nm_user' => $username,
				'pass_user' => md5($userpass)
			);
			$add = $this->beta->_create('tbl_users', $val);

			$data['msg'] = '<div class="alert alert-success" role="alert">[ ID: '.$add.' ] Add User - Successfully...</div>';
			$data['status'] = TRUE;
		} else {
			foreach ($_POST as $key => $value) {
				$data['msg'][$key] = form_error($key);
			}
		}
		echo json_encode($data);
	}

	public function edit($id) {
		$where = array(
			'id_user' => $id
		);
		$data = $this->beta->_read_where('tbl_users', $where)->row();

		echo json_encode($data);
	}

	public function update() {
		$data = array(
			'status' => FALSE,
			'msg' => array()
		);

		$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[255]|callback_user_check');
		$this->form_validation->set_rules('userpass', 'Password', 'trim|required|max_length[255]');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

		if ($this->form_validation->run()) {
			$userid = $this->input->post('userid');
			$username = dt_filter($this->input->post('username'));
			$userpass = $this->input->post('userpass');

			$val = array(
				'nm_user' => $username,
				'pass_user' => md5($userpass)
			);
			$where = array(
				'id_user' => $userid
			);
			$this->beta->_update('tbl_users', $val, $where);

			$data['msg'] = '<div class="alert alert-primary" role="alert">[ ID: '.$userid.' ] Update User - Successfully...</div>';
			$data['status'] = TRUE;
		} else {
			foreach ($_POST as $key => $value) {
				$data['msg'][$key] = form_error($key);
			}
		}
		echo json_encode($data);
	}

	public function delete($id) {
		$where = array(
			'id_user' => $id
		);
		$this->beta->_delete('tbl_users', $where);

		echo json_encode(array('status' => TRUE));
	}

	// custom validation
	public function user_check() {
		$userid = dt_filter($this->input->post('userid'));
		$username = $this->input->post('username');

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
}

