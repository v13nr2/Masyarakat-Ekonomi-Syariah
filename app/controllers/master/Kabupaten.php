<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabupaten extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model("Model_kabupaten");
		$this->load->model("Model_provinsi");
		$this->load->library("form_validation");
	}

	public function index()
	{
		$data['judul'] 		= 'Daftar Kabupaten';
		$data['kabupaten'] 	= $this->Model_kabupaten->listKabupaten();
		$this->template->view_baru('master/kabupaten/data', $data);
	}

	public function tambah() 
	{
		$data['judul'] 		= 'Tambah Kabupaten';
		$data['errors'] 	= '';
		$data['provinsi']	= $this->Model_provinsi->getComboProv();
		$data['kabupaten']  = array();
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('kabupaten', 'Nama Kabupaten', 'required|max_length[50]');
			$this->form_validation->set_rules('kode', 'Kode Kabupaten', 'required|max_length[10]');
			$this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
			if ($this->form_validation->run() == FALSE) 
			{

			} else 
			{
				$data_create = array(
					'kabupaten_nama' 	=> $this->input->post('kabupaten'), 
					'kabupaten_kode' 	=> $this->input->post('kode'), 
					'kabupaten_prov_id' => $this->input->post('provinsi'), 
					'insert_user_id' 	=> $this->session->userdata('user_id'), 
					'insert_timestamp' 	=> date('Y-m-d H:i:s'), 
					'is_default' 		=> '0'
				);
				$this->db->insert('ref_kabupaten', $data_create);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'master/Kabupaten');
			}
		}
		$this->template->view_baru('master/kabupaten/form', $data);
	}

	public function ubah() 
	{
		$id_Kabupaten 		= $this->input->get('id');
		$data['judul'] 		= 'Ubah Kabupaten';
		$data['errors'] 	= '';
		$data['provinsi']	= $this->Model_provinsi->getComboProv();
		$data['kabupaten']  = $this->Model_kabupaten->getKabupatenById($id_Kabupaten);
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('kabupaten', 'Nama Kabupaten', 'required|max_length[50]');
			$this->form_validation->set_rules('kode', 'Kode Kabupaten', 'required|max_length[10]');
			$this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
			if ($this->form_validation->run() == FALSE) 
			{

			} else 
			{
				$data_create = array(
					'kabupaten_nama' 	=> $this->input->post('kabupaten'), 
					'kabupaten_kode' 	=> $this->input->post('kode'), 
					'kabupaten_prov_id' => $this->input->post('provinsi'), 
					'update_user_id' 	=> $this->session->userdata('user_id'), 
					'update_timestamp' 	=> date('Y-m-d H:i:s'), 
					'is_default' 		=> '0'
				);
				$key['kabupaten_id'] = $this->input->post('id');
				$this->db->update('ref_kabupaten', $data_create, $key);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'master/Kabupaten');
			}
		}
		$this->template->view_baru('master/kabupaten/form', $data);
	}

	public function hapus() 
	{
		$id_Kabupaten 		= $this->input->get('id');
		$delete = $this->Model_kabupaten->hapusKabupaten($id_Kabupaten);
		if($delete){
			$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil dihapus');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect(base_url().'master/Kabupaten');
		}else{
			$message = alert_php2('Proses gagal. ', 'error', 'Data gagal dihapus');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect(base_url().'master/Kabupaten');
		}
	}

}

/* End of file Kabupaten.php */
/* Location: .//D/xampp/htdocs/FELLOW/akuntansi/app/controllers/master/Kabupaten.php */