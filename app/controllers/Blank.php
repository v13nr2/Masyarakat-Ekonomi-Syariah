<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blank extends CI_Controller {

	public function __construct()
	{
		parent::__construct(); 
	}

	public function index()
	{
		 
		$this->template->view_baru('blank/data');
	}
}

/* End of file Bank.php */
/* Location: .//D/xampp/htdocs/FELLOW/akuntansi/app/controllers/Bank.php */