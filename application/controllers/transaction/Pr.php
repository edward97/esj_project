<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pr extends CI_Controller {
	public function __construct() {
        parent::__construct();

        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('welcome/login');
        }
		$this->load->model('beta_model', 'beta');
		$this->load->model('transaction/pr_model', 'model');
	}

	public function index() {
        $data['title'] = 'Purchase Receipt';

		$this->load->view('inc/v_header', $data);
		$this->load->view('transaction/v_pr');
		$this->load->view('inc/v_footer');
	}

	public function list() {
		
	}

	public function create() {

	}

	public function store() {

	}
	
	public function edit() {

	}
	
	public function update() {

	}

	public function destroy() {

	}
}
