<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departemen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_departemen');
		$this->load->library("form_validation");
	}

	public function index()
	{
		$data['judul'] 		= 'Daftar Departemen';
		$data['bank'] 	= $this->Model_departemen->listDepartemen();
		$this->template->view_baru('departemen/data', $data);
	}

	public function tambah()
	{
		$data['judul'] 		= 'Tambah Departemen';
		$data['errors'] 	= '';
		
		$data['bank']  = array();
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('nama_departemen', 'Nama Departemen', 'required|max_length[50]');
			$this->form_validation->set_rules('penanggung_jawab', 'Penanggung Jawab', 'required|max_length[50]');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|max_length[50]');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$message = alert_php2('Proses Gagal. ', 'error', 'Data gagal disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'Departemen');
			} else 
			{
				$data_create = array(
					'nama_departemen' 			=> $this->input->post('nama_departemen'), 
					'penanggung_jawab' 			=> $this->input->post('penanggung_jawab'), 
					'keterangan'	 		=> $this->input->post('keterangan')
				);
				$this->db->insert('tbl_departemen', $data_create);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'Departemen');
			}
		}
		$this->template->view_baru('departemen/form', $data);
	}

	public function ubah()
	{
		$id_bank 		= $this->input->get('id');
		$data['judul'] 		= 'Ubah Departemen';
		$data['errors'] 	= '';
		$data['departemen']  = $this->Model_departemen->getDeptById($id_bank);
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('nama_departemen', 'Nama Departemen', 'required|max_length[50]');
			$this->form_validation->set_rules('penanggung_jawab', 'Penanggung Jawab', 'required|max_length[50]');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|max_length[50]');
			if ($this->form_validation->run() == FALSE) 
			{

			} else 
			{
				$data_create = array(
					'nama_departemen' 			=> $this->input->post('nama_departemen'), 
					'penanggung_jawab' 			=> $this->input->post('penanggung_jawab'), 
					'keterangan'	 		=> $this->input->post('keterangan')
				);
				$key['id'] = $this->input->post('id');
				$this->db->update('tbl_departemen', $data_create, $key);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'Departemen');
			}
		}
		$this->template->view_baru('departemen/form', $data);
	}

	public function hapus()
	{
		$id_bank = $this->input->get('id');
		$delete 	= $this->Model_departemen->hapusBank($id_bank);
		if($delete){
			$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil dihapus');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect(base_url().'Departemen');
		}else{
			$message = alert_php2('Proses gagal. ', 'error', 'Data gagal dihapus');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect(base_url().'Departemen');
		}
	}

}

/* End of file Bank.php */
/* Location: .//D/xampp/htdocs/FELLOW/akuntansi/app/controllers/Bank.php */