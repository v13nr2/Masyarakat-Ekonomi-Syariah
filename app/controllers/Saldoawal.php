<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Saldoawal extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('model_saldoawal');
		$this->load->model('model_akun');
		$this->load->library('user_agent');
	}
	function input() {
		$cekSaldoAwal 			= $this->model_saldoawal->cekSaldoAwal();
		if($cekSaldoAwal>0) {
			redirect('/');
		}
		$data['judul'] 		= "Saldo Awal";
		$data['akun'] 		= $this->model_akun->list_akun_neraca()->result();
		$data['mobile']		= $this->agent->is_mobile();
		$data['periode'] 	= $this->input->post('periode');
		$data['errors'] 	= "";
		if($data['periode'] != "") {
			$baris 		= $this->input->post('baris');
			$company_id = $this->session->userdata($this->config->item('ses_company_id'));
			for ($i=0; $i<($baris-1); $i++) {
				$id_akun 	= $this->input->post('id_akun')[$i];
				$debet 		= $this->input->post('debet')[$i];
				$debet 		= str_replace(".", "", $debet);
				$debet 		= str_replace(",", ".", $debet);
				$kredit 	= $this->input->post('kredit')[$i];
				$kredit 	= str_replace(".", "", $kredit);
				$kredit 	= str_replace(",", ".", $kredit);
				$amount 	= $debet - $kredit;
				$data_saldo_awal = array("periode_neraca_saldo" => date_format(date_create($data['periode']), "Y-m-d"), "id_akun" => $id_akun, "amount" => $amount, "debet" => $debet, "kredit" => $kredit, "company_id" => $company_id );
				$this->db->insert('trs_neraca_saldo', $data_saldo_awal);
			}
			$data['errors'] = alert_php2('Proses berhasil. ', 'success', '<b>Saldo Awal</b> berhasil disimpan.');
			redirect('/');
		}
		$this->template->view_baru('saldoawal/input_saldoawal', $data);
	}
}
