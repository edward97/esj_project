<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct() {
        parent::__construct();

        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('welcome/login');
        }
		$this->load->model('beta_model', 'beta');
	}

	public function index() {
        $data['title'] = 'Dashboard';

		$this->load->view('inc/v_header', $data);
		$this->load->view('v_dashboard');
		$this->load->view('inc/v_footer');
	}
}
