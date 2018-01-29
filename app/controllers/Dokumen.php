<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Model_dokumen");
		$this->load->model("Model_provinsi");
		$this->load->library("form_validation");
		
	}

	public function index()
	{
		$data['judul'] 		= 'Daftar Dokumen';
		$data['dokumen'] 	= $this->Model_dokumen->listDokumen();
		$this->template->view_baru('dokumen/data', $data);
	}

	public function tambah()
	{
		$data['judul'] 		= 'Tambah Dokumen';
		$data['errors'] 	= '';
		
		$data['dokumen']  = array();
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('dokumen', 'Nama dokumen', 'required|max_length[50]');
			$this->form_validation->set_rules('keterangan', 'keterangan', 'required|max_length[10]');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$message = alert_php2('Proses Gagal. ', 'error', 'Data gagal disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'Dokumen');
			} else 
			{
				if(!empty($_FILES)){
					$config['upload_path']          = 'files/logo/';
					$config['allowed_types']        = 'gif|jpg|png|jpeg';
					$config['max_size']             = 100;
					$config['max_width']            = 1024;
					$config['max_height']           = 768;

					$this->load->library('upload');
					$this->upload->initialize($config);

					if (!$this->upload->do_upload('logo')){
						$error = array('error' => $this->upload->display_errors());
						print_r($error);
						$logo = "";
						$upload = false;
					}else{
						$data = array('upload_data' => $this->upload->data());
						$logo = $data['upload_data']['file_name'];
						$upload = true;
					}
				}else{
					$logo = "";
				}
				if($upload){
					$data_create = array(
						'dokumen_nama' 			=> $this->input->post('dokumen'), 
						'dokumen_keterangan' 	=> $this->input->post('keterangan'), 
						'dokumen_logo	' 		=> $logo, 
						'insert_user_id' 		=> $this->session->userdata('user_id'), 
						'insert_timestamp' 		=> date('Y-m-d H:i:s')
						);
					$this->db->insert('mst_dokumen', $data_create);
					$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
					$this->session->set_userdata($this->config->item('ses_message'), $message);
					redirect(base_url().'Dokumen');
				}else{
					$message = alert_php2('Proses gagal. ', 'error', 'Proses Upload File Gagal');
					$this->session->set_userdata($this->config->item('ses_message'), $message);
					redirect(base_url().'Dokumen');
				}
			}
		}
		$this->template->view_baru('dokumen/form', $data);
	}

	public function ubah()
	{
		$id_dokumen 		= $this->input->get('id');
		$data['judul'] 		= 'Ubah Dokumen';
		$data['errors'] 	= '';
		$data['dokumen']  = $this->Model_dokumen->getDokumenById($id_dokumen);
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('dokumen', 'Nama dokumen', 'required|max_length[50]');
			$this->form_validation->set_rules('keterangan', 'keterangan', 'required|max_length[10]');
			if ($this->form_validation->run() == FALSE) 
			{
				$message = alert_php2('Proses Gagal. ', 'error', 'Data gagal disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'Dokumen');
			} else 
			{
				if(!empty($_FILES)){
					//$id_dokumen = md5($this->input->post('id'));
					$logoo   	= $this->Model_dokumen->getDokumenById($id_dokumen);
					unlink("files/logo/".$logoo[0]->logo);

					$config['upload_path']          = 'files/logo/';
					$config['allowed_types']        = 'gif|jpg|png|jpeg';
					$config['max_size']             = 100;
					$config['max_width']            = 1024;
					$config['max_height']           = 768;

					$this->load->library('upload');
					$this->upload->initialize($config);

					if (!$this->upload->do_upload('logo')){
						$error = array('error' => $this->upload->display_errors());
						print_r($error);
						$logo = "";
						$upload = false;
					}else{
						$data = array('upload_data' => $this->upload->data());
						$logo = $data['upload_data']['file_name'];
						$upload = true;
					}
				}else{
					$logo = "";
				}
				if($upload){
					$data_create = array(
						'dokumen_nama' 			=> $this->input->post('dokumen'), 
						'dokumen_keterangan' 	=> $this->input->post('keterangan'), 
						'dokumen_logo	' 		=> $logo, 
						'update_user_id' 		=> $this->session->userdata('user_id'), 
						'update_timestamp' 		=> date('Y-m-d H:i:s')
						);
					$key['dokumen_id'] = $this->input->post('id');
					$this->db->update('mst_dokumen', $data_create, $key);
					$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
					$this->session->set_userdata($this->config->item('ses_message'), $message);
					redirect(base_url().'Dokumen');
				}else{
					$message = alert_php2('Proses gagal. ', 'error', 'Proses Upload File Gagal');
					$this->session->set_userdata($this->config->item('ses_message'), $message);
					redirect(base_url().'Dokumen');
				}
			}
		}
		$this->template->view_baru('dokumen/form', $data);
	}

	public function hapus()
	{
		$id_dokumen = $this->input->get('id');
		$logo   	= $this->Model_dokumen->getDokumenById($id_dokumen);
		unlink("files/logo/".$logo[0]->logo);
		$delete 	= $this->Model_dokumen->hapusDokumen($id_dokumen);
		if($delete){
			$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil dihapus');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect(base_url().'Dokumen');
		}else{
			$message = alert_php2('Proses gagal. ', 'error', 'Data gagal dihapus');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect(base_url().'Dokumen');
		}
	}

}

/* End of file Dokumen.php */
/* Location: .//D/xampp/htdocs/FELLOW/akuntansi/app/controllers/Dokumen.php */