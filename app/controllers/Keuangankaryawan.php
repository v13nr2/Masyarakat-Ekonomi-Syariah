<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangankaryawan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_karyawan_keu');
		$this->load->library("form_validation");
	}

	public function index()
	{
		$data['judul'] 		= 'Daftar Parameter Keuangan Karyawan';
		$data['keu'] 	= $this->Model_karyawan_keu->listKeu();
		$this->template->view_baru('keuangankaryawan/data', $data);
	}

	public function tambah()
	{
		$data['judul'] 		= 'Tambah Parameter Keuangan Karyawan';
		$data['errors'] 	= '';
		
		$data['bank']  = array();
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('nama_keuangan', 'Nama Parameter', 'required|max_length[50]');
			$this->form_validation->set_rules('gl_debet', 'GL Debet', 'required|max_length[50]');
			$this->form_validation->set_rules('gl_kredit', 'GL Kredit', 'required|max_length[50]');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|max_length[50]');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$message = alert_php2('Proses Gagal. ', 'error', 'Data gagal disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'Departemen');
			} else 
			{
				$data_create = array(
					'nama_keuangan' 			=> $this->input->post('nama_keuangan'), 
					'gl_debet' 			=> $this->input->post('gl_debet'), 
					'gl_kredit' 			=> $this->input->post('gl_kredit'), 
					'keterangan'	 		=> $this->input->post('keterangan')
				);
				$this->db->insert('tbl_pegawai_keu', $data_create);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'keuangankaryawan');
			}
		}
		$this->template->view_baru('keuangankaryawan/form', $data);
	}

	public function ubah()
	{
		$id		= $this->input->get('id');
		$data['judul'] 		= 'Ubah Parameter';
		$data['errors'] 	= '';
		$data['keu']  = $this->Model_karyawan_keu->getDeptById($id);
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('nama_keuangan', 'Nama Parameter', 'required|max_length[50]');
			$this->form_validation->set_rules('gl_debet', 'GL Debet', 'required|max_length[50]');
			$this->form_validation->set_rules('gl_kredit', 'GL Kredit', 'required|max_length[50]');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|max_length[50]');
			if ($this->form_validation->run() == FALSE) 
			{

			} else 
			{
				$data_create = array(
					'nama_keuangan' 			=> $this->input->post('nama_keuangan'), 
					'gl_debet' 			=> $this->input->post('gl_debet'), 
					'gl_kredit' 			=> $this->input->post('gl_kredit'), 
					'keterangan'	 		=> $this->input->post('keterangan')
				);
				$key['id'] = $this->input->post('id');
				$this->db->update('tbl_pegawai_keu', $data_create, $key);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'keuangankaryawan');
			}
		}
		$this->template->view_baru('keuangankaryawan/form', $data);
	}

	public function hapus()
	{
		$id = $this->input->get('id');
		$delete 	= $this->Model_karyawan_keu->hapusParam($id);
		if($delete){
			$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil dihapus');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect(base_url().'keuangankaryawan');
		}else{
			$message = alert_php2('Proses gagal. ', 'error', 'Data gagal dihapus');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect(base_url().'keuangankaryawan');
		}
	}

}

/* End of file Bank.php */
/* Location: .//D/xampp/htdocs/FELLOW/akuntansi/app/controllers/Bank.php */