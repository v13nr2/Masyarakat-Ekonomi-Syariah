<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Penerimaan_dana extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('model_penerimaan_dana');
		$this->load->model('model_kategori_dana');
		$this->load->library('form_validation');
	}
	public function index() {
		$data['judul'] 		= 'Daftar Penerimaan Dana';
		$data['kategori_dana'] 	= $this->model_penerimaan_dana->listkategori_dana()->result();
		$this->template->view_baru('penerimaan_dana/daftar_kategori_dana', $data);
	}
	public function tambah() {
		$data['judul'] 		= 'Tambah Penyaluran Dana';
		$data['errors'] 	= '';
		$data['akun']       = $this->model_kategori_dana->listkategori_5();
		$data['penyedia']       = $this->model_penerimaan_dana->penyedia();
		$data['kategori']	= $this->model_kategori_dana->listkategori();
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$kode_unik = base_convert(microtime(false), 10, 36);
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('kategori_penyedia_dana', 'Nama Kategori Penyaluran Dana', 'required|max_length[50]');
			if ($this->form_validation->run() == FALSE) {
			} else {
				$data_create = array(
				    'kategori_penyedia_dana' => $this->input->post('kategori_penyedia_dana'), 
				    'jenis_dana' => $this->input->post('jenis_dana'), 
				    'nilai' => $this->input->post('nilai'), 
				    'keterangan' => $this->input->post('keterangan'),
				    'penyedia_dana_id' => $this->input->post('penyedia_dana_id')  
				    );
				$this->db->insert('tbl_penerimaan_dana', $data_create);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect('penerimaan_dana');
			}
		}
		$this->template->view_baru('penerimaan_dana/tambah_kategori', $data);
	}
	public function ubah() {
		$id_kategori_dana 		= $this->uri->segment(3);
		$data['judul'] 		= 'Ubah Penerimaan Dana';
		$data['errors'] 	= '';
		$data['penyedia']       = $this->model_penerimaan_dana->penyedia();
		$data['akun']       = $this->model_kategori_dana->listkategori_5();
		$data['kategori']	= $this->model_kategori_dana->listkategori();
		$data['penerimaan_dana'] 	= $this->model_penerimaan_dana->getPenerimaan_dana($id_kategori_dana);
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('kategori_penyedia_dana', 'Nama kategori Penyedia Dana', 'required|max_length[50]');
			if ($this->form_validation->run() == FALSE) {
			} else {
				$data_update = array(
				    'kategori_penyedia_dana' => $this->input->post('kategori_penyedia_dana'), 
				    'jenis_dana' => $this->input->post('jenis_dana'), 
				    'nilai' => $this->input->post('nilai'), 
				    'keterangan' => $this->input->post('keterangan'),
				    'penyedia_dana_id' => $this->input->post('penyedia_dana_id')  
				);
				$where = "md5(id) = '$id_kategori_dana' ";
				$this->db->where($where);
				$this->db->update('tbl_penerimaan_dana', $data_update);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect('penerimaan_dana');
			}
		}
		$this->template->view_baru('penerimaan_dana/ubah_kategori', $data);
	}
}
