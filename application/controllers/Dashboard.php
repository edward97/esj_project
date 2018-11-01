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

	public function theme() {
		$data = TRUE;
		$uri = gt_uri(3);

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

	// search for autocomplete
	public function search($id) {
		if (isset($_GET['term']) && $id == 'divisi') {
			$result = $this->beta->_search('tbl_divisi', 'nm_divisi', $_GET['term'])->result();

			if (count($result)) {
				foreach ($result as $i) {
					$data[] = array(
						'label' => $i->nm_divisi,
						'value' => $i->id_divisi
					);
				}
			} else {
				$data[] = array(
					'label' => 'no-records',
					'value' => 'no-records',
				);
			}
		}

		echo json_encode($data);
	}
}
