<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modul extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_modul');
		$this->load->library("form_validation");
	}

	public function index()
	{
		$data['judul'] 		= 'Daftar Modul';
		$data['modul'] 	= $this->Model_modul->listModul();
		$this->template->view_baru('modul/data', $data);
	}

	public function tambah()
	{
		$data['judul'] 		= 'Tambah Modul';
		$data['errors'] 	= '';
		
		$data['bank']  = array();
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('controller', 'Controller', 'required|max_length[50]');
			$this->form_validation->set_rules('method', 'Method', 'required|max_length[50]');
			$this->form_validation->set_rules('nama_fungsi', 'Nama Fungsi', 'required|max_length[50]');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$message = alert_php2('Proses Gagal. ', 'error', 'Data gagal disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'Modul');
			} else 
			{
				$data_create = array(
					'controller' 			=> $this->input->post('controller'), 
					'method' 			=> $this->input->post('method'), 
					'nama_fungsi'	 		=> $this->input->post('nama_fungsi')
				);
				$this->db->insert('tbl_modul', $data_create);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'Modul');
			}
		}
		$this->template->view_baru('modul/form', $data);
	}

	public function ubah()
	{
		$id		= $this->input->get('id');
		$data['judul'] 		= 'Ubah Modul';
		$data['errors'] 	= '';
		$data['modul']  = $this->Model_modul->getModulById($id);
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('controller', 'Controller', 'required|max_length[50]');
			$this->form_validation->set_rules('method', 'Method', 'required|max_length[50]');
			$this->form_validation->set_rules('nama_fungsi', 'Nama Fungsi', 'required|max_length[50]');
			
			if ($this->form_validation->run() == FALSE) 
			{

			} else 
			{
				$data_create = array(
					'controller' 			=> $this->input->post('controller'), 
					'method' 			=> $this->input->post('method'), 
					'nama_fungsi'	 		=> $this->input->post('nama_fungsi')
				);
				$key['id'] = $this->input->post('id');
				$this->db->update('tbl_modul', $data_create, $key);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'Modul');
			}
		}
		$this->template->view_baru('modul/form', $data);
	}

	public function hapus()
	{
		$id = $this->input->get('id');
		$delete 	= $this->Model_modul->hapusModul($id);
		if($delete){
			$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil dihapus');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect(base_url().'Modul');
		}else{
			$message = alert_php2('Proses gagal. ', 'error', 'Data gagal dihapus');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect(base_url().'Modul');
		}
	}

}

/* End of file Bank.php */
/* Location: .//D/xampp/htdocs/FELLOW/akuntansi/app/controllers/Bank.php */