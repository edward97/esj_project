<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Size extends CI_Controller {
	public function __construct() {
        parent::__construct();

        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('welcome/login');
        }
		$this->load->model('beta_model', 'beta');
		$this->load->model('setup/size_model', 'model');
    }
    
	public function detail() {
        $id = gt_uri(4);
        $where = array(
            'id_item' => $id
        );
        $sql = $this->beta->_read_where('tbl_items', $where);

        if (!$sql->num_rows()) {
            show_404();
            exit();
        }
        $data['title'] = 'Size';

        $arr = $sql->row_array();
        $data['parent_id'] = $arr['id_item'];
        $data['parent_nm'] = $arr['nm_item'];

        $this->load->view('inc/v_header', $data);
        $this->load->view('setup/v_size');
        $this->load->view('inc/v_footer');
	}

	public function list($id) {
		$list = $this->model->read_data($id);
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $i) {
            $row = array();
			
			$row[] = ++$no;
			$row[] = $i->id_size;
			$row[] = $i->nm_size;

			$row[] = '<a href="javascript:;" class="btn btn-custom btn-primary" data-edit="'.$i->id_size.'"><i class="far fa-edit"></i></a>
			<a href="javascript:;" class="btn btn-custom btn-danger" data-delete="'.$i->id_size.'"><i class="far fa-trash-alt"></i></a>';

			$data[] = $row;
		}
		$output = array(
			'draw' => $_POST['draw'],
			'recordsTotal' => $this->model->count_data($id),
			'recordsFiltered' => $this->model->count_data_filtered($id),
			'data' => $data
		);
		echo json_encode($output);
	}

	public function add() {
		$data = array(
			'status' => FALSE,
			'msg' => array()
		);

		$this->form_validation->set_rules('size-nm', 'Size', 'trim|required|max_length[255]|callback_size_check');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

		if ($this->form_validation->run()) {
			$sql = $this->model->_create();

			$data['status'] = TRUE;
			$data['msg'] = '<div class="alert alert-success" role="alert">[ ID: '.$sql.' ] Add Size - Successfully...</div>';
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

		$this->form_validation->set_rules('size-nm', 'Size', 'trim|required|max_length[255]|callback_size_check');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

		if ($this->form_validation->run()) {
			$sql = $this->model->_update();

			$data['status'] = TRUE;
			$data['msg'] = '<div class="alert alert-primary" role="alert">[ ID: '.$sql.' ] Update Size - Successfully...</div>';
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
	public function size_check() {
        $itemid = $this->input->post('item-id');
		$sizeid = $this->input->post('size-id');
		$sizenm = $this->input->post('size-nm');

		$where = array(
			'id_size !=' => $sizeid,
            'nm_size' => $sizenm,
            'id_item' => $itemid
		);
		$check = $this->beta->_read_where('tbl_items_detail', $where)->num_rows();

		if ($check) {
			$this->form_validation->set_message('size_check', 'The {field} already exists');
			return FALSE;
		} else {
			return TRUE;
		}
    }
}
