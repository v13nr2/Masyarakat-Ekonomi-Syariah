<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Buku_Kas extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Model_bukukas');
		$this->load->model('Model_jurnal');
		$this->load->helper('tanggal_helper');
	}
	function index() {
		$data['judul'] 		= "Buku Besar";
		
		$data['akun'] = $this->Model_bukukas->list_akun();
		$this->template->view_baru('bukubesar/index_BB', $data);
	}
	
	function detail() {
	    
		$data['judul'] 		= "Laporan Buku Besar";
		$kode_akun          = $this->uri->segment(3);
		$data['akun'] = $this->Model_jurnal->list_jurnal_detail($kode_akun);
		$this->template->view_baru('bukubesar/detail', $data);
	}
}
