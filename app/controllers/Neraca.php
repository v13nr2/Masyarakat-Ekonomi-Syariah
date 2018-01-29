<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Neraca extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Model_bukubesar');
	}
	function index() {
		$data['judul'] 		= "Neraca";
		
		$data['aktiva'] = $this->Model_bukubesar->list_aktiva();
		$data['pasiva'] = $this->Model_bukubesar->list_pasiva();
		$this->template->view_baru('neraca/neraca', $data);
	}
}
