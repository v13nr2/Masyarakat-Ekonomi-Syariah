<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Asetconfig extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_akun');
		$this->load->model('model_aset');
		$this->load->helper('date');
		$this->load->library('user_agent');
		$this->load->model('model_tutupbuku');
	}

	function index()
	{
		$data['judul'] 			= "Daftar Konfigurasi Aset";
		$data['dikonfirmasi'] 	= $this->input->get('status');
		$data['no_jurnal'] 		= $this->input->get('no_jurnal');
		$data['tanggal_awal'] 	= $this->input->get('tanggal_awal');
		$data['tanggal_akhir'] 	= $this->input->get('tanggal_akhir');
		$reset 					= $this->input->get('btnreset');

		if($reset!="")
		{
			$data['dikonfirmasi'] 	= "";
			$data['no_jurnal'] 		= "";
			$data['tanggal_awal'] 	= "";
			$data['tanggal_akhir'] 	= "";
		}

		$data['aset'] 		= $this->model_aset->list_aset();
		$data['konfigurasi'] 		= $this->model_aset->list_aset_konfigurasi();
		$this->template->view_baru('asetconfig/daftar', $data);
	}

	function kategori()
	{
		$data['judul'] 			= "Daftar Kategori Aset";
		$data['dikonfirmasi'] 	= $this->input->get('status');
		$data['no_jurnal'] 		= $this->input->get('no_jurnal');
		$data['tanggal_awal'] 	= $this->input->get('tanggal_awal');
		$data['tanggal_akhir'] 	= $this->input->get('tanggal_akhir');
		$reset 					= $this->input->get('btnreset');

		if($reset!="")
		{
			$data['dikonfirmasi'] 	= "";
			$data['no_jurnal'] 		= "";
			$data['tanggal_awal'] 	= "";
			$data['tanggal_akhir'] 	= "";
		}

		$data['kategori'] 		= $this->model_aset->list_aset_kategori();
		$this->template->view_baru('asetconfig/daftar_kategori', $data);
	}
	
	function kategori_add(){
		
		$data['judul'] 	= "Tambah Kategori Aset ";
		$this->template->view_baru('asetconfig/tambah_kategori', $data);
	}
	
	function kategori_ubah(){
		$id 		= $this->uri->segment(3);
		$data['judul'] 	= "Ubah Kategori Aset ";
		$data['jenis'] = $this->model_aset->get_data_detail_kategori($id);
		//echo $this->db->last_query();
		$this->template->view_baru('asetconfig/ubah_kategori', $data);
	}
	
	function tambah()
	{
		$data['judul'] 	= "Tambah Konfigurasi Aset ";
		$data['akun'] = $this->model_akun->list_akun();
		$data['jenis'] = $this->model_aset->list_aset_kategori();
		$this->template->view_baru('asetconfig/tambah', $data);
	}

	
	function ubah()
	{
	    $id = $this->input->get("id");
		$data['judul'] 	= "Ubah Konfigurasi Aset ";
		$data['akun'] = $this->model_akun->list_akun();
		$data['jenis'] = $this->model_aset->list_aset_kategori();
		$data['detail'] = $this->model_aset->detailByid($id);
		//echo $this->db->last_query();
		//die();
		$this->template->view_baru('asetconfig/ubah', $data);
	}

	
	public function insert(){
		
		$data['judul'] 			= "Daftar Aset";
		$data = array(
				  'id_jenis_aset' => $this->input->post('id_jenis_aset'),
				  'bagi' => $this->input->post('bagi'),
				  'tarif' => $this->input->post('tarif'),
				  'rekdebet' => $this->input->post('rekdebet'),
				  'rek_rekdebet' => $this->input->post('rek_rekdebet'),
				  'rekkredit' => $this->input->post('rekkredit'),
				  'rek_rekkredit' => $this->input->post('rek_rekkredit'),
				  'rek_d_bbsusut' => $this->input->post('rek_d_bbsusut'),
				  'rek_rek_d_bbsusut' => $this->input->post('rek_rek_d_bbsusut'),
				  'rek_k_akmsusut' => $this->input->post('rek_k_akmsusut'),
				  'rek_rek_k_akmsusut' => $this->input->post('rek_rek_k_akmsusut'),
				  'status' => 1
			);
		$this->db->insert('aset_config', $data);
		redirect('asetconfig');
	}
	public function insert_kategori(){
		
		$data['judul'] 			= "Daftar Kategori Aset";
		$data = array(
				  'jenis' => $this->input->post('jenis'),
				  'status' => 1
			);

		$this->db->insert('aset_kategori', $data);
		redirect('asetconfig/kategori');
	}
	
	public function update_kategori(){
		
                $data = array(
				  'id' => $this->input->post('id'),
                  'jenis' => $this->input->post('jenis')
				);

                $this->db->where('id',  $this->input->post('id'));
				$this->db->update('aset_kategori', $data);
                 
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Edit Jenis Kategori berhasil !!</div></div>");
                redirect('asetconfig/kategori');  
      
			
		}
		
	public function updatekonfig(){
		
                $data = array(
				  'id' => $this->input->post('id'),
                  'id_jenis_aset' => $this->input->post('id_jenis_aset'),
				  'bagi' => $this->input->post('bagi'),
				  'tarif' => $this->input->post('tarif'),
				  'rekdebet' => $this->input->post('rekdebet'),
				  'rek_rekdebet' => $this->input->post('rek_rekdebet'),
				  'rekkredit' => $this->input->post('rekkredit'),
				  'rek_rekkredit' => $this->input->post('rek_rekkredit'),
				  'rek_d_bbsusut' => $this->input->post('rek_d_bbsusut'),
				  'rek_rek_d_bbsusut' => $this->input->post('rek_rek_d_bbsusut'),
				  'rek_k_akmsusut' => $this->input->post('rek_k_akmsusut'),
				  'rek_rek_k_akmsusut' => $this->input->post('rek_rek_k_akmsusut')
				);

                $this->db->where('id',  $this->input->post('id'));
				$this->db->update('aset_config', $data);
                 
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Edit Jenis Kategori berhasil !!</div></div>");
                redirect('asetconfig');  

		}

		
	public function hapus()
	{
		$id = $this->input->get('id');
		$delete 	= $this->model_aset->hapusConfig($id);
		if($delete){
			$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil dihapus');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect(base_url().'asetconfig');
		}else{
			$message = alert_php2('Proses gagal. ', 'error', 'Data gagal dihapus');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect(base_url().'asetconfig');
		}
	}
}
