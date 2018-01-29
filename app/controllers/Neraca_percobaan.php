<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Neraca_percobaan extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Model_bukubesar');
		$this->load->helper('date');
		$this->load->library('user_agent');
	}
	function index() {
		$data['judul'] 		= "Neraca Percobaan";
		
		
		$data['akun'] = $this->Model_bukubesar->list_nercob();
		//echo $this->db->last_query();
		//die();
		$this->template->view_baru('neracapercobaan/index', $data);
	}
}
