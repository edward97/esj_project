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

	public function theme() {
		$data = TRUE;
		$uri = gt_uri(4);

		if ($uri == 'bg_status') {
			$bg_status = ($this->input->post('name') === '1') ? 'sidebar-bg' : NULL ;

			$val = array( 'nav_status' => $bg_status);
			$where = array('id_user' => $this->session->userdata('ses_id'));
			$this->beta->_update('tbl_users', $val, $where);

			$this->session->set_userdata('ses_status', $bg_status);
		}
		elseif ($uri == 'bg_color') {
			$bg_color = $this->input->post('name');

			$val = array( 'nav_color' => $bg_color);
			$where = array('id_user' => $this->session->userdata('ses_id'));
			$this->beta->_update('tbl_users', $val, $where);

			$this->session->set_userdata('ses_color', $bg_color);
		}
		elseif ($uri == 'bg_img') {
			$bg_color = $this->input->post('name');

			$val = array( 'nav_bg' => $bg_color);
			$where = array('id_user' => $this->session->userdata('ses_id'));
			$this->beta->_update('tbl_users', $val, $where);

			$this->session->set_userdata('ses_bg', $bg_color);
		} else {
			$data = FALSE;
		}
		echo json_encode($data);
	}
}
