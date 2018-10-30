<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct() {
        parent::__construct();

        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('welcome/login');
        }
		$this->load->model('beta_model', 'beta');
	}

	public function index() {
        $data['title'] = 'User';

		$this->load->view('inc/v_header', $data);
		$this->load->view('setup/v_user');
		$this->load->view('inc/v_footer');
	}

	
}
