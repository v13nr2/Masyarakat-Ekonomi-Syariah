<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resetsistem extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Model_resetsistem");
		
	}

	public function index()
	{
		$data['judul'] 		= 'Reset Sistem';
		$this->template->view_baru('reset/index');
	}
	
	public function reset_it(){
		
		$reset = $this->Model_resetsistem->reset_it();
		redirect('jurnal');
	}
}