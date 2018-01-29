<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Kategori_penyedia extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('model_kategori_py');
		$this->load->library('form_validation');
	}
	public function index() {
		$data['judul'] 		= 'Kategori Penyedia Dana';
		$data['kategori_penyedia'] 	= $this->model_kategori_py->list_py()->result();
		$this->template->view_baru('kategori_penyedia/daftar_kategori', $data);
	}
	public function tambah() {
		$data['judul'] 		= 'Tambah Kategori Penyedia Dana';
		$data['errors'] 	= '';
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$kode_unik = base_convert(microtime(false), 10, 36);
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('kategori_penyedia', 'Kategori Penyedia Dana', 'required|max_length[50]');
			$this->form_validation->set_rules('keterangan', 'Keterangan Penyedia Dana', 'required|max_length[50]');
			if ($this->form_validation->run() == FALSE) {
			} else {
				$data_create = array('kategori_penyedia' 			=> $this->input->post('kategori_penyedia'), 'keterangan' 		=> $this->input->post('keterangan'));
				$this->db->insert('tbl_kategori_penyedia_dana', $data_create);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect('kategori_penyedia');
			}
		}
		$this->template->view_baru('kategori_penyedia/tambah_kategori', $data);
	}
	public function ubah() {
		$id 		= $this->uri->segment(3);
		$data['judul'] 		= 'Ubah Kategori Penyedia DAna';
		$data['errors'] 	= '';
		$data['kategori_penyedia'] 	= $this->model_kategori_py->getKategori($id);
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('kategori_penyedia', 'Nama Kategori', 'required|max_length[50]');
			$this->form_validation->set_rules('keterangan', 'Keterangan Kategori', 'required|max_length[50]');
			if ($this->form_validation->run() == FALSE) {
			} else {
				$data_update = array('kategori_penyedia' 			=> $this->input->post('kategori_penyedia'), 'keterangan' 		=> $this->input->post('keterangan') );
				$where = "md5(id) = '$id' ";
				$this->db->where($where);
				$this->db->update('tbl_kategori_penyedia_dana', $data_update);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect('kategori_penyedia');
			}
		}
		$this->template->view_baru('kategori_penyedia/ubah_kategori', $data);
	}
}
