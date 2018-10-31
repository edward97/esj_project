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

			$row[] = '<button class="btn btn-primary btn-sm update" id="'.$i->id_user.'"><i class="far fa-edit"></i></button><button class="btn btn-danger btn-sm delete" id="'.$i->id_user.'"><i class="far fa-trash-alt"></i></button>';

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
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</span>');

		if ($this->form_validation->run()) {
			$data['msg'] = 'Success';
			$data['status'] = TRUE;
		} else {
			foreach ($_POST as $key => $value) {
				$data['msg'][$key] = form_error($key);
			}
		}
		echo json_encode($data);
	}
}

