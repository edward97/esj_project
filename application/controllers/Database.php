<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Database extends CI_Controller {
	public function __construct() {
        parent::__construct();

        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('welcome/login');
        }
		$this->load->model('beta_model', 'beta');
	}

	public function index() {
        $data['title'] = 'Database';
        $data['list_table'] = $this->beta->_get_table()->result();

		$this->load->view('inc/v_header', $data);
		$this->load->view('v_database');
		$this->load->view('inc/v_footer');
    }
    
    public function backup() {
        // Load the Utility Class
        $this->load->dbutil();

        // Backup your entire database and assign it to a variable
        $prefs = array(
            'format'      => 'zip',
            'filename'    => 'my_db_backup.sql'
        );
        $backup = $this->dbutil->backup($prefs); 

        $date = mdate('%Y-%m-%d %H.%i.%s', now('Asia/Jakarta'));
        $db_name = 'backup-'.$date.'.zip';
        $sv_path = 'db/'.$db_name;

        // Load the file helper and write the file to your server
        write_file($sv_path, $backup);

        // Load the download helper and send the file to your desktop
        // $this->load->helper('download');
        // force_download($db_name, $backup);

        $this->session->set_flashdata('msg', '<div class="alert alert-primary">Backup successfully!</div>');
        redirect('database');
    }
}
