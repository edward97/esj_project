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
		$data = array();
		if (isset($_GET['term']) && $id == 'divisi') {
			$result = $this->beta->_search('tbl_divisi', 'nm_divisi', $_GET['term'])->result();

			if (count($result)) {
				foreach ($result as $i) {
					array_push($data, array(
						'label' => $i->nm_divisi,
						'value' => $i->id_divisi,
					));
				}
			}
		}
		elseif (isset($_GET['term']) && $id == 'supplier') {
			$result = $this->beta->_search('tbl_supplier', 'nm_supplier', $_GET['term'])->result();

			if (count($result)) {
				foreach ($result as $i) {
					array_push($data, array(
						'label' => $i->nm_supplier,
						'value' => $i->id_supplier
					));
				}
			}
		}
		elseif (isset($_GET['term']) && $id == 'warehouse') {
			$result = $this->beta->_search('tbl_warehouse', 'nm_warehouse', $_GET['term'])->result();

			if (count($result)) {
				foreach ($result as $i) {
					array_push($data, array(
						'label' => $i->nm_warehouse,
						'value' => $i->id_warehouse
					));
				}
			}
		}
		elseif (isset($_GET['term']) && $id == 'item') {
			$result = $this->beta->_search_custom_size($_GET['term'])->result();

			if (count($result)) {
				foreach ($result as $i) {
					array_push($data, array(
						'label' => $i->nm_item.'-'.$i->nm_size,
                        'value' => $i->id_item.'-'.$i->id_size,
					));
				}
			}
		}
		elseif (isset($_GET['term']) && $id == 'po') {
			$result = $this->beta->_search('tbl_po', 'id_po', $_GET['term'])->result();

			if (count($result)) {
				foreach ($result as $i) {
					array_push($data, array(
						'label' => $i->id_po,
						'value' => $i->id_po,
						'supplierid' => $i->id_supplier,
						'warehouseid' => $i->id_warehouse,
					));
				}
			}
		}
		echo json_encode($data);
	}
}
