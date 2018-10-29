<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('beta_model', 'beta');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function login() {
		$this->load->view('v_login');
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('welcome/login');
	}

	public function login_act() {
		$data = array(
			'status' => FALSE,
			'msg' => array(),
		);

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if ($this->form_validation->run()) {
			$user = dt_filter($this->input->post('username'));
			$pass = $this->input->post('password');

			$where = array(
				'nm_user' => $user,
				'pass_user' => md5($pass),
			);
			$check = $this->beta->_read_where('tbl_users', $where)->num_rows();

			if ($check) {
				$attr = array(
					'logged_in' => TRUE,
					'ses_nm' => strtoupper($user),
				);
				$this->session->set_userdata($attr);

				$data['status'] = '1';
			} else {
				$data['msg'] = 'Username or Password is incorrect...';
				$data['status'] = '2';
			}
		} else {
			foreach ($_POST as $key => $value) {
				$data['msg'][$key] = form_error($key);
			}
		}
		echo json_encode($data);
	}
}
