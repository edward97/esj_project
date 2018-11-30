<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function __construct() {
        parent::__construct();

        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('welcome/login');
        }
		$this->load->model('beta_model', 'beta');
	}

	public function index() {
        $data['title'] = 'Profile';
        
        $where = array(
            'id_user' => $this->session->userdata('ses_id')
        );
        $data['user'] = $this->beta->_read_where('tbl_users', $where)->result();

		$this->load->view('inc/v_header', $data);
		$this->load->view('setting/v_profile');
		$this->load->view('inc/v_footer');
	}

	public function list() {
		$where = array(
			'id_user' => $this->session->userdata('ses_id'),
		);
		$data = $this->beta->_read_where('tbl_users', $where)->row();
		echo json_encode($data);
	}

	public function add() {

	}

	public function edit() {

	}

	public function update() {
        
	}
}
