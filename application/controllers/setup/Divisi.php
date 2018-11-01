<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Divisi extends CI_Controller {
	public function __construct() {
        parent::__construct();

        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('welcome/login');
        }
		$this->load->model('beta_model', 'beta');
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
			$divisiname = dt_filter($this->input->post('divisi-nm'));

			$val = array(
				'nm_divisi' => $divisiname,
			);
			$add = $this->beta->_create('tbl_divisi', $val);

			$data['msg'] = '<div class="alert alert-success" role="alert">[ ID: '.$add.' ] Add Divisi - Successfully...</div>';
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
			'id_divisi' => $id
		);
		$data = $this->beta->_read_where('tbl_divisi', $where)->row();

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
			$divisiid = $this->input->post('divisi-id');
			$divisiname = $this->input->post('divisi-nm');

			$val = array(
				'nm_divisi' => $divisiname,
			);
			$where = array(
				'id_divisi' => $divisiid
			);
			$this->beta->_update('tbl_divisi', $val, $where);

			$data['msg'] = '<div class="alert alert-primary" role="alert">[ ID: '.$divisiname.' ] Update Divisi - Successfully...</div>';
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
			'id_divisi' => $id
		);
		$x = $this->beta->_delete('tbl_divisi', $where);

		echo json_encode(array('status' => $x));
	}

	// custom validation
	public function divisi_check() {
		$divisiid = dt_filter($this->input->post('divisi-id'));
		$divisiname = $this->input->post('divisi-nm');

		$where = array(
			'id_divisi !=' => $divisiid,
            'nm_divisi' => $divisiname
        );
		$check = $this->beta->_read_where('tbl_divisi', $where)->num_rows();

		if ($check) {
			$this->form_validation->set_message('divisi_check', 'The {field} already exists');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}

