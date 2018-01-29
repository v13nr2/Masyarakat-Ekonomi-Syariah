<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Tutupbuku extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('model_tutupbuku');
		$this->load->helper('tanggal_helper');
		$this->load->helper('log');
	}
	public function index() {
		$data['judul'] = "Tutup Buku";
		$data['tutup'] = $this->model_tutupbuku->listTutupBuku()->result();
		$this->template->view_baru('tutupbuku/daftar', $data);
	}
	public function proses() {
		$data['judul'] = "Tutup Buku";
		$btnproses 	= $this->input->post('btnproses');
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$id_login 	= $this->session->userdata($this->config->item('ses_id'));
		if($btnproses=="proses") {
			$data_update = array(
				'status'	 		=> 'N', 
			);
			$this->db->update('trs_tutup_buku_bulanan',$data_update);
			$data_create = array(
					'awal' 			=> tgl_en($this->input->post('tanggal_awal')), 
					'akhir' 			=> tgl_en($this->input->post('tanggal_akhir')), 
					'status'	 		=> 'A', 
					'yang_buat'	 		=> $id_login
				);
				$this->db->insert('trs_tutup_buku_bulanan', $data_create);
				helper_log("Add", "Menambah Aktifkan Periode Tutup Buku = ".$this->input->post('tanggal_awal') . ' s/d ' . $this->input->post('tanggal_akhir'));
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect('tutupbuku');
				
		}
		$this->template->view_baru('tutupbuku/form', $data);
	}
	public function rollback() {
		$kode_unik 	= $this->uri->segment(3);
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$id_login 	= $this->session->userdata($this->config->item('ses_id'));
		$cekRollBack = $this->model_tutupbuku->cekRollBack($kode_unik);
		if($cekRollBack>0) {
			$message = alert_php2('', 'danger', '<b>Batalkan tutup buku bulan sesudahnya terlebih dahulu.</b>');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect('tutupbuku');
		} else {
			$data_updat = array("status" => "N", "id_batalkan" => $id_login );
			$this->db->where('kode_unik', $kode_unik);
			$this->db->where('company_id', $company_id);
			$this->db->update('trs_tutup_buku_bulanan', $data_updat);
			$tmp_periodenya = $this->model_tutupbuku->getPeriode($kode_unik);
			$this->model_tutupbuku->summarySaldoCancel($tmp_periodenya);
			$message = alert_php2('Berhasil. ', 'success', 'Proses tutup buku berhasil dibatalkan.');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect('tutupbuku');
		}
	}
}
