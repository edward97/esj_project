<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {
	public function __construct() {
        parent::__construct();

        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('welcome/login');
        }
		$this->load->model('beta_model', 'beta');
		$this->load->model('setup/item_model', 'model');
	}

	public function index() {
        $data['title'] = 'Item';

		$this->load->view('inc/v_header', $data);
		$this->load->view('setup/v_item');
		$this->load->view('inc/v_footer');
	}

	public function list() {
		$list = $this->model->read_data();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $i) {
            $row = array();
			
			$row[] = ++$no;
			$row[] = '<a href="'.site_url('setup/size/detail/'.$i->id_item).'" class="badge badge-secondary">'.$i->id_item.'</a>';
			$row[] = $i->nm_item;
			$row[] = $i->uom;

			$row[] = '<a href="javascript:;" class="btn-custom btn-primary" data-edit="'.$i->id_item.'"><i class="far fa-edit"></i></a>
			<a href="javascript:;" class="btn-custom btn-danger" data-delete="'.$i->id_item.'"><i class="far fa-trash-alt"></i></a>';

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

		$this->form_validation->set_rules('item-nm', 'Item', 'trim|required|max_length[255]|is_unique[tbl_items.nm_item]');
		$this->form_validation->set_rules('item-uom', 'UOM', 'trim|required|max_length[20]');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

		if ($this->form_validation->run()) {
			$sql = $this->model->_create();

			$data['status'] = TRUE;
			$data['msg'] = '<div class="alert alert-success" role="alert">[ ID: '.$sql.' ] Add Item - Successfully...</div>';
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

		$this->form_validation->set_rules('item-nm', 'Item', 'trim|required|max_length[255]|callback_item_check');
		$this->form_validation->set_rules('item-uom', 'UOM', 'trim|required|max_length[20]');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

		if ($this->form_validation->run()) {
			$sql = $this->model->_update();

			$data['status'] = TRUE;
			$data['msg'] = '<div class="alert alert-primary" role="alert">[ ID: '.$sql.' ] Update Item - Successfully...</div>';
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
	public function item_check() {
		$itemid = $this->input->post('item-id');
		$itemnm = $this->input->post('item-nm');

		$where = array(
			'id_item !=' => $itemid,
            'nm_item' => $itemnm
		);
		$check = $this->beta->_read_where('tbl_items', $where)->num_rows();

		if ($check) {
			$this->form_validation->set_message('item_check', 'The {field} already exists');
			return FALSE;
		} else {
			return TRUE;
		}
    }
}
