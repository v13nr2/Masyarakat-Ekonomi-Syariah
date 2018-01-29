<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Pinjaman extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('model_pinjaman');
		$this->load->model('model_tipepenyedia');
		$this->load->library('form_validation');
	}
	public function index() {
		$data['judul'] 		= 'Daftar Pinjaman';
		$data['pinjaman'] 	= $this->model_pinjaman->listpinjaman()->result();
		$this->template->view_baru('pinjaman/daftar_pinjaman', $data);
	}
	public function tambah() {
		$data['judul'] 		= 'Tambah Donatur';
		$data['errors'] 	= '';
		$data["pegawai"]= $this->model_pinjaman->getComboPeg();
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('id_pegawai', 'Nama Pegawai', 'required|max_length[50]');
			if ($this->form_validation->run() == FALSE) {
			} else {
				$data_create =  array('id_pegawai' => $this->input->post('id_pegawai'), 'tanggal_pinjaman' => $this->input->post('tanggal_pinjaman'), 'status_pinjaman' => $this->input->post('status_pinjaman') , 'jumlah_pinjaman' => $this->input->post('jumlah_pinjaman')  );
				$this->db->insert('tbl_pinjaman_pegawai', $data_create);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect('pinjaman');
			}
		}
		$this->template->view_baru('pinjaman/tambah_pinjaman', $data);
	}
	public function ubah() {
		$id_pinjaman 		= $this->uri->segment(3);
		$data['judul'] 		= 'Ubah Pinjaman';
		$data['errors'] 	= '';
		$data['pinjaman'] 	= $this->model_pinjaman->getPinjaman($id_pinjaman);
		$data["pegawai"]= $this->model_pinjaman->getComboPeg();
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('id_pegawai', 'Nama Pegawai', 'required|max_length[50]');
			if ($this->form_validation->run() == FALSE) {
			} else {
				$data_update = array('id_pegawai' => $this->input->post('id_pegawai'), 'tanggal_pinjaman' => $this->input->post('tanggal_pinjaman'), 'status_pinjaman' => $this->input->post('status_pinjaman') , 'jumlah_pinjaman' => $this->input->post('jumlah_pinjaman')  );
				$where = "md5(id) = '$id_pinjaman' ";
				$this->db->where($where);
				$this->db->update('tbl_pinjaman_pegawai', $data_update);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect('pinjaman');
			}
		}
		$this->template->view_baru('pinjaman/ubah_pinjaman', $data);
	}
}
