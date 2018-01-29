<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Organisasi extends CI_Controller {
	function __construct() {
		parent::__construct();
		//$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}
	public function index() {
		$data['judul'] 		= 'Tambah Orgnanisasi';
		$this->template->view_baru('organisasi/organisasi_tambah',$data);
	}
	
	public function do_upload(){
		$config['upload_path']          = '.files/gambar/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		
		$this->load->library('upload', $config);
		
		if ( ! $this->Organisasi->do_upload('berkas')){
			$error = array('error' => $this->Organisasi->display_errors());
			$this->load->view('organisasi_tambah', $error);
		}else{
			$data = array('upload_data' => $this->Organisasi->data());
			$this->load->view('organisasi_daftar', $data);
		}

	}
}
