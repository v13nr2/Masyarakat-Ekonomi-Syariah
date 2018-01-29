<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Tahunbuku extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
	}
	public function index() {
		$pdata = $this->session->userdata('session_data'); //Retrive ur session

		$tb = $pdata['ses_organisasi_id2'];
		
		
		$data['judul'] 		= 'Tahun Buku Organisasi '.$tb;
		$this->template->view_baru('tahunbuku/index', $data);
	}
	
}
