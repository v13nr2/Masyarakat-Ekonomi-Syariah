<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gajikaryawan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_karyawan_keu');
		$this->load->library("form_validation");
	}

	public function index()
	{
		$data['judul'] 	= 'Daftar Gaji Karyawan';
		$data['karyawan'] 	= $this->Model_karyawan_keu->listKaryawan();
		$data['listKeu'] 	= $this->Model_karyawan_keu->listKeuWithID();
		$this->template->view_baru('gajikaryawan/data', $data);
	}

	

}

/* End of file Bank.php */
/* Location: .//D/xampp/htdocs/FELLOW/akuntansi/app/controllers/Bank.php */