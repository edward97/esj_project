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
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

		if ($this->form_validation->run()) {
			$user = dt_filter($this->input->post('username'));
			$pass = $this->input->post('password');

			$where = array(
				'nm_user' => $user,
				'pass_user' => md5($pass),
			);
			$query = $this->beta->_read_where('tbl_users', $where);

			if ($query->num_rows()) {
				$val = $query->row_array();

				$attr = array(
					'logged_in' => TRUE,
					'ses_id' => $val['id_user'],
					'ses_nm' => strtoupper($val['nm_user']),
					'ses_color' => $val['nav_color'],
					'ses_bg' => $val['nav_bg'],
					'ses_status' => $val['nav_status'],
				);
				$this->session->set_userdata($attr);

				$data['status'] = '1';
			} else {
				$data['msg'] = 'Username or Password is incorrect...';
				$data['status'] = '2';
			}
		} else {
			foreach ($_POST as $key => $val) {
				$data['msg'][$key] = form_error($key);
			}
		}
		echo json_encode($data);
	}
}
