<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Penyaluran_dana extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('model_penyaluran_dana');
		$this->load->model('model_kategori_dana');
		$this->load->library('form_validation');
	}
	public function index() {
		$data['judul'] 		= 'Daftar Penyaluran Dana';
		$data['kategori_dana'] 	= $this->model_penyaluran_dana->listkategori_dana()->result();
		$this->template->view_baru('penyaluran_dana/daftar_kategori_dana', $data);
	}
	public function tambah() {
		$data['judul'] 		= 'Tambah Penyaluran Dana';
		$data['errors'] 	= '';
		$data['akun']       = $this->model_kategori_dana->listkategori_5();
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$kode_unik = base_convert(microtime(false), 10, 36);
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('nama_penyaluran_dana', 'Nama Penyaluran Dana', 'required|max_length[50]');
			if ($this->form_validation->run() == FALSE) {
			} else {
				$data_create = array(
				    'kategori_penyaluran_dana' => $this->input->post('kategori_penyaluran_dana'), 
				    'nama_penyaluran_dana' => $this->input->post('nama_penyaluran_dana'), 
				    'nilai' => $this->input->post('nilai'), 
				    'keterangan' => $this->input->post('keterangan'),
				    'gl' => $this->input->post('gl')  
				    );
				$this->db->insert('tbl_penyaluran_dana', $data_create);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect('penyaluran_dana');
			}
		}
		$this->template->view_baru('penyaluran_dana/tambah_kategori', $data);
	}
	public function ubah() {
		$id_kategori_dana 		= $this->uri->segment(3);
		$data['judul'] 		= 'Ubah Penyaluran Dana';
		$data['errors'] 	= '';
		$data['jenis']       = $this->model_kategori_dana->listjenis();
		$data['akun']       = $this->model_kategori_dana->listkategori_5();
		$data['kategori_dana'] 	= $this->model_penyaluran_dana->getkategori_dana($id_kategori_dana);
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('nama_penyaluran_dana', 'Nama Penyaluran Dana', 'required|max_length[50]');
			if ($this->form_validation->run() == FALSE) {
			} else {
				$data_update = array(
				    'kategori_penyaluran_dana' => $this->input->post('kategori_penyaluran_dana'), 
				    'nama_penyaluran_dana' => $this->input->post('nama_penyaluran_dana'), 
				    'nilai' => $this->input->post('nilai'), 
				    'keterangan' => $this->input->post('keterangan'),
				    'gl' => $this->input->post('gl')  
				);
				$where = "md5(id) = '$id_kategori_dana' ";
				$this->db->where($where);
				$this->db->update('tbl_penyaluran_dana', $data_update);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect('penyaluran_dana');
			}
		}
		$this->template->view_baru('penyaluran_dana/ubah_kategori', $data);
	}
}
