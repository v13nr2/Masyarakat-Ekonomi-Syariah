<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Tipeakun extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('model_tipeakun');
	}
	function index() {
		$judul 			= "Daftar Tipe Akun";
		$data['judul'] 	= $judul;
		$data['tipeakun'] = $this->model_tipeakun->list_tipeakun()->result();
		$this->template->view_baru('tipeakun/daftar_tipeakun', $data);
	}
}
