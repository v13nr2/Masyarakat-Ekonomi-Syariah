<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Bukubesar extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Model_bukubesar');
	}
	function index() {
		$data['judul'] 		= "Buku Besar";
		
		$data['akun'] = $this->Model_bukubesar->list_akun();
		$this->template->view_baru('bukubesar/index', $data);
	}
}
