<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kepengurusan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_kepengurusan');
		$this->load->library("form_validation");
	}

	public function index()
	{
		$data['judul'] 		= 'Daftar Kepengurusan';
		$data['bank'] 	= $this->Model_kepengurusan->listKepengurusan();
		$this->template->view_baru('kepengurusan/data', $data);
	}

	public function tambah()
	{
		$data['judul'] 		= 'Tambah Kepengurusan';
		$data['errors'] 	= '';
		
		$data['bank']  = array();
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('nama', 'Nama Kepengurusan', 'required|max_length[50]');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$message = alert_php2('Proses Gagal. ', 'error', 'Data gagal disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'kepengurusan');
			} else 
			{
				$data_create = array(
					'nama' 			=> $this->input->post('nama')
				);
				$this->db->insert('mst_kepengurusan', $data_create);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'kepengurusan');
			}
		}
		$this->template->view_baru('kepengurusan/form', $data);
	}

	public function ubah()
	{
		$id_bank 		= $this->input->get('id');
		$data['judul'] 		= 'Ubah Kepengurusan';
		$data['errors'] 	= '';
		$data['Kepengurusan']  = $this->Model_kepengurusan->getDeptById($id_bank);
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('nama', 'Nama Kepengurusan', 'required|max_length[50]');
			if ($this->form_validation->run() == FALSE) 
			{

			} else 
			{
				$data_create = array(
					'nama' 			=> $this->input->post('nama')
				);
				$key['id'] = $this->input->post('id');
				$this->db->update('mst_kepengurusan', $data_create, $key);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'Kepengurusan');
			}
		}
		$this->template->view_baru('kepengurusan/form', $data);
	}

	public function hapus()
	{
		$id_bank = $this->input->get('id');
		$delete 	= $this->Model_kepengurusan->hapusBank($id_bank);
		if($delete){
			$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil dihapus');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect(base_url().'kepengurusan');
		}else{
			$message = alert_php2('Proses gagal. ', 'error', 'Data gagal dihapus');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect(base_url().'kepengurusan');
		}
	}

}

/* End of file Bank.php */
/* Location: .//D/xampp/htdocs/FELLOW/akuntansi/app/controllers/Bank.php */