<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provinsi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model("Model_provinsi");
		$this->load->library("form_validation");
	}

	public function index()
	{
		$data['judul'] 		= 'Daftar Provinsi';
		$data['provinsi'] 	= $this->Model_provinsi->listProvinsi();
		$this->template->view_baru('master/provinsi/data', $data);
	}

	public function tambah() 
	{
		$data['judul'] 		= 'Tambah Provinsi';
		$data['errors'] 	= '';
		//$data['provinsi']	= $this->Model_provinsi->getComboProv();
		$data['provinsi']  = array();
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('provinsi', 'Nama Provinsi', 'required|max_length[50]');
			$this->form_validation->set_rules('kode', 'Kode Provinsi', 'required|max_length[10]');
			if ($this->form_validation->run() == FALSE) 
			{

			} else 
			{
				$data_create = array(
					'prov_nama' 	=> $this->input->post('provinsi'), 
					'prov_kode' 	=> $this->input->post('kode'), 
					'insert_user_id' 	=> $this->session->userdata('user_id'), 
					'insert_timestamp' 	=> date('Y-m-d H:i:s'), 
					'is_default' 		=> '0'
				);
				$this->db->insert('ref_provinsi', $data_create);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'master/Provinsi');
			}
		}
		$this->template->view_baru('master/Provinsi/form', $data);
	}

	public function ubah() 
	{
		$id_Provinsi 		= $this->input->get('id');
		$data['judul'] 		= 'Ubah Provinsi';
		$data['errors'] 	= '';
		//$data['provinsi']	= $this->Model_provinsi->getComboProv();
		$data['provinsi']  = $this->Model_provinsi->getProvinsiById($id_Provinsi);
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('provinsi', 'Nama Provinsi', 'required|max_length[50]');
			$this->form_validation->set_rules('kode', 'Kode Provinsi', 'required|max_length[10]');
			if ($this->form_validation->run() == FALSE) 
			{

			} else 
			{
				$data_create = array(
					'prov_nama' 	=> $this->input->post('provinsi'), 
					'prov_kode' 	=> $this->input->post('kode'),  
					'update_user_id' 	=> $this->session->userdata('user_id'), 
					'update_timestamp' 	=> date('Y-m-d H:i:s'), 
					'is_default' 		=> '0'
				);
				$key['prov_id'] = $this->input->post('id');
				$this->db->update('ref_provinsi', $data_create, $key);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'master/Provinsi');
			}
		}
		$this->template->view_baru('master/Provinsi/form', $data);
	}

	public function hapus() 
	{
		$id_Provinsi 		= $this->input->get('id');
		$delete = $this->Model_provinsi->hapusProvinsi($id_Provinsi);
		if($delete){
			$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil dihapus');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect(base_url().'master/Provinsi');
		}else{
			$message = alert_php2('Proses gagal. ', 'error', 'Data gagal dihapus');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect(base_url().'master/Provinsi');
		}
	}

}

/* End of file Provinsi.php */
/* Location: .//D/xampp/htdocs/FELLOW/akuntansi/app/controllers/master/Provinsi.php */