<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Jurnal_lap extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Model_jurnal');
	}
	function index() {
	    
		$data['dikonfirmasi'] 	= $this->input->get('status');
		$data['no_jurnal'] 		= $this->input->get('no_jurnal');
		$data['tanggal_awal'] 	= $this->input->get('tanggal_awal');
		$data['tanggal_akhir'] 	= $this->input->get('tanggal_akhir');
		$reset 					= $this->input->get('btnreset');

		if($reset!="")
		{
			$data['dikonfirmasi'] 	= "";
			$data['no_jurnal'] 		= "";
			$data['tanggal_awal'] 	= "";
			$data['tanggal_akhir'] 	= "";
		}
		$data['judul'] 		= "Laporan Jurnal";
		$this->load->helper('tanggal_helper');
		$data['akun'] = $this->Model_jurnal->list_jurnal();
		$this->template->view_baru('jurnal/index', $data);
	}
	function detailByNomor() {
		$data['judul'] 		= "Laporan Jurnal";
		$nomor          = $this->uri->segment(3);
		$data['akun'] = $this->Model_jurnal->list_jurnal_detailByNomor($nomor);
		$this->template->view_baru('jurnal/detailByNomor', $data);
	}
	function list_jurnal_detailByProyek() {
		$data['judul'] 		= "Laporan Jurnal";
		$nomor          = $this->uri->segment(3);
		$data['akun'] = $this->Model_jurnal->list_jurnal_detailByProyek($nomor);
		$this->template->view_baru('jurnal/detailByNomor', $data);
	}
}
