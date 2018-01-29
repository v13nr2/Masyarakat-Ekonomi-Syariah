<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Kategori_dana extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('model_kategori_dana');
		$this->load->library('form_validation');
	}
	public function index() {
		$data['judul'] 		= 'Daftar Kategori Dana';
		$data['kategori_dana'] 	= $this->model_kategori_dana->listkategori_dana()->result();
		$this->template->view_baru('kategori_dana/daftar_kategori_dana', $data);
	}
	public function tambah() {
		$data['judul'] 		= 'Tambah kategori_dana';
		$data['errors'] 	= '';
		$data['akun']       = $this->model_kategori_dana->listkategori_4();
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$kode_unik = base_convert(microtime(false), 10, 36);
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('nama', 'Nama Kategori Dana', 'required|max_length[50]');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|min_length[4]|max_length[250]');
			if ($this->form_validation->run() == FALSE) {
			} else {
				$data_create = array(
				    'kategori_dana' 			=> $this->input->post('nama'), 'keterangan' 	=> $this->input->post('keterangan'),
				    
				    'gl' 			=> $this->input->post('gl'),
				    );
				$this->db->insert('tbl_kategori_dana', $data_create);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect('kategori_dana');
			}
		}
		$this->template->view_baru('kategori_dana/tambah_kategori', $data);
	}
	public function ubah() {
		$id_kategori_dana 		= $this->uri->segment(3);
		$data['judul'] 		= 'Ubah kategori_dana';
		$data['errors'] 	= '';
		
		$data['akun']       = $this->model_kategori_dana->listkategori_4();
		$data['kategori_dana'] 	= $this->model_kategori_dana->getkategori_dana($id_kategori_dana);
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('nama', 'Nama Kategori Dana', 'required|max_length[50]');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|min_length[4]|max_length[250]');
			if ($this->form_validation->run() == FALSE) {
			} else {
				$data_update = array(
				    'kategori_dana' => $this->input->post('nama'), 
				    'keterangan' => $this->input->post('keterangan'),
				    'gl' => $this->input->post('gl')  
				);
				$where = "md5(id) = '$id_kategori_dana' ";
				$this->db->where($where);
				$this->db->update('tbl_kategori_dana', $data_update);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect('kategori_dana');
			}
		}
		$this->template->view_baru('kategori_dana/ubah_kategori', $data);
	}
}
