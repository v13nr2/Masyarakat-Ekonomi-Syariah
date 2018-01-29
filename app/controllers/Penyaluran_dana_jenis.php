<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Penyaluran_dana_jenis extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('model_penyaluran_dana_jenis');
		$this->load->model('model_kategori_dana');
		$this->load->library('form_validation');
	}
	public function index() {
		$data['judul'] 		= 'Jenis Penyaluran Dana';
		$data['jenis'] 	= $this->model_penyaluran_dana_jenis->listkategori_dana()->result();
		$this->template->view_baru('penyaluran_dana_jenis/data', $data);
	}
	public function tambah() {
		$data['judul'] 		= 'Tambah Penyaluran Dana';
		$data['errors'] 	= '';
		$data['akun']       = $this->model_kategori_dana->listkategori_5();
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$kode_unik = base_convert(microtime(false), 10, 36);
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('jenis_penyaluran_dana', 'Nama Penyaluran Dana', 'required|max_length[50]');
			if ($this->form_validation->run() == FALSE) {
			} else {
				$data_create = array(
				    'jenis_penyaluran_dana' => $this->input->post('jenis_penyaluran_dana')
				    );
				$this->db->insert('tbl_penyaluran_dana_jenis', $data_create);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect('penyaluran_dana_jenis');
			}
		}
		$this->template->view_baru('penyaluran_dana_jenis/form', $data);
	}
	public function ubah() {
		$id 		= $this->input->get('id');
		$data['judul'] 		= 'Ubah Jenis Penyaluran Dana';
		$data['errors'] 	= '';
		$data['jenis'] 	= $this->model_penyaluran_dana_jenis->getJenis_dana($id)->result();
		
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('jenis_penyaluran_dana', 'Jenis Penyaluran Dana', 'required|max_length[50]');
			if ($this->form_validation->run() == FALSE) {
			} else {
				$data_update = array(
				    'jenis_penyaluran_dana' => $this->input->post('jenis_penyaluran_dana')
				);
				$where = "id = '".$this->input->post('id')."' ";
				$this->db->where($where);
				$this->db->update('tbl_penyaluran_dana_jenis', $data_update);
				//echo $this->db->last_query();
				//die();
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect('penyaluran_dana_jenis');
			}
		}
		$this->template->view_baru('penyaluran_dana_jenis/form', $data);
	}

	public function hapus(){

				$where = "md5(id) = '".$this->input->get('id')."' ";
				$this->db->where($where);
				$this->db->delete('tbl_penyaluran_dana_jenis');

				redirect('penyaluran_dana_jenis');
	}
}
