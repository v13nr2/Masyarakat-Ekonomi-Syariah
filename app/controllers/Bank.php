<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_bank');
		$this->load->model('Model_akun');
		$this->load->library("form_validation");
		$this->load->helper('tanggal_helper');
	}

	public function index()
	{
		$data['judul'] 		= 'Daftar Rekening Bank';
		$data['bank'] 	= $this->Model_bank->listBank();
		$this->template->view_baru('bank/data', $data);
	}

	public function tambah()
	{
		$data['judul'] 		= 'Tambah Rekening Bank';
		$data['errors'] 	= '';
		
		$data['akun']       = $this->Model_akun->list_akun();
		$data['bank']  = array();
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('kode', 'Kode Bank', 'required|max_length[50]');
			$this->form_validation->set_rules('nama', 'Nama Bank', 'required|max_length[50]');
			$this->form_validation->set_rules('cabang', 'Cabang Bank', 'required|max_length[50]');
			$this->form_validation->set_rules('atas_nama', 'Atas Nama', 'required|max_length[50]');
			$this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'required|max_length[15]');
			$this->form_validation->set_rules('jenis', 'Jenis', 'required');			
			$this->form_validation->set_rules('gl', 'GL', 'required');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$message = alert_php2('Proses Gagal. ', 'error', 'Data gagal disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'Bank');
			} else 
			{
				$data_create = array(
					'bank_kode' 			=> $this->input->post('kode'), 
					'bank_nama' 			=> $this->input->post('nama'), 
					'bank_cabang'	 		=> $this->input->post('cabang'), 
					'bank_atas_nama' 		=> $this->input->post('atas_nama'), 
					'bank_no_rek' 			=> $this->input->post('no_rek'), 
					'gl' 			=> $this->input->post('gl'), 
					'bank_jenis_tabungan'	=> $this->input->post('jenis'), 
					'aktif'	=> $this->input->post('aktif'), 
					'tanggal_buka'			=> tgl_en($this->input->post('tanggal_buka')), 
					'biaya_admin'	        => $this->input->post('biaya_admin'), 
					'insert_user_id' 		=> $this->session->userdata('user_id'), 
					'insert_timestamp' 		=> date('Y-m-d H:i:s')
				);
				$this->db->insert('mst_rekening_bank', $data_create);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'Bank');
			}
		}
		$this->template->view_baru('bank/form', $data);
	}

	public function ubah()
	{
		$id_bank 		= $this->input->get('id');
		$data['judul'] 		= 'Ubah Rekening Bank';
		$data['errors'] 	= '';
		$data['bank']  = $this->Model_bank->getBankById($id_bank);
		$data['akun']       = $this->Model_akun->list_akun();
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('kode', 'Kode Bank', 'required|max_length[50]');
			$this->form_validation->set_rules('nama', 'Nama Bank', 'required|max_length[50]');
			$this->form_validation->set_rules('cabang', 'Cabang Bank', 'required|max_length[50]');
			$this->form_validation->set_rules('atas_nama', 'Atas Nama', 'required|max_length[50]');
			$this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'required|max_length[15]');
			$this->form_validation->set_rules('jenis', 'Jenis', 'required');
			$this->form_validation->set_rules('gl', 'GL', 'required');
			if ($this->form_validation->run() == FALSE) 
			{

			} else 
			{
				$data_create = array(
					'bank_kode' 			=> $this->input->post('kode'), 
					'bank_nama' 			=> $this->input->post('nama'), 
					'bank_cabang'	 		=> $this->input->post('cabang'), 
					'bank_atas_nama' 		=> $this->input->post('atas_nama'), 
					'bank_no_rek' 			=> $this->input->post('no_rek'), 
					'tanggal_buka'			=> tgl_en($this->input->post('tanggal_buka')), 
					'bank_jenis_tabungan'	=> $this->input->post('jenis'), 
					'aktif'	=> $this->input->post('aktif'), 					
					'gl' 			=> $this->input->post('gl'), 
					'biaya_admin'	=> $this->input->post('biaya_admin'), 
					'update_user_id' 		=> $this->session->userdata('user_id'), 
					'update_timestamp' 		=> date('Y-m-d H:i:s')
				);
				$key['bank_id'] = $this->input->post('id');
				$this->db->update('mst_rekening_bank', $data_create, $key);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'Bank');
			}
		}
		$this->template->view_baru('bank/form', $data);
	}

	public function hapus()
	{
		$id_bank = $this->input->get('id');
		$delete 	= $this->Model_bank->hapusBank($id_bank);
		if($delete){
			$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil dihapus');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect(base_url().'Bank');
		}else{
			$message = alert_php2('Proses gagal. ', 'error', 'Data gagal dihapus');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect(base_url().'Bank');
		}
	}

}

/* End of file Bank.php */
/* Location: .//D/xampp/htdocs/FELLOW/akuntansi/app/controllers/Bank.php */