<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Memorial extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_akun');
		$this->load->model('model_jurnal');
		$this->load->helper('date');
		$this->load->helper('jurnal_helper');
		$this->load->library('user_agent');
		$this->load->model('model_tutupbuku');
	}

	function index()
	{
		$data['akun'] = $this->model_akun->list_akun();
		$this->template->view_baru('memorial/add',$data);
	}
	
	public function simpan(){
		
		if($this->input->is_ajax_request()){
			//$cek = ''
			$res = array();
			$this->load->model('Model_memorial');
			$this->load->helper('tanggal_helper');
			
			
			//cek tahun berjalan
			
			//validasi tanggal jurnal
			inputOke($this->input->post('tgl'));

			$kode_unik = base_convert(microtime(false), 10, 36);
			
			//buat nomor jurnal
			$this->load->model('Model_kas');
			$dt = array(
					'jenis_jurnal' => 'JU', //$this->input->post('nojurnal'),
					'urut' => $this->input->post('nobukti'),
					'ip' => $this->input->post('kreditur'),
					'user' => $this->input->post('keterangan')
				);
			$id_counter = $this->Model_kas->saveCounter($dt);
			$pdata = $this->session->userdata('session_data'); //
			$tb = $pdata['ses_tahun_buku'];
			$iduser =  $pdata['ses_user_id'];
			$this->load->helper('nomor_helper');
			$nomor = nojurnal($id_counter);
			//input header
			$dt = array(
					'no_jurnal' => date('Y').date('m').$nomor, //$this->input->post('nojurnal'),
					'no_bukti' => $this->input->post('nobukti'),
					'memo' => $this->input->post('keterangan'),
					'tgl_dibuat' => date('Y-m-d H:i:s'),
					'jenis_jurnal' => 'JU',
					"kode_unik" 	=> $kode_unik,
					'company_id' => 1, //$this->config->item('ses_company_id'),
					'tgl_jurnal' => tgl_en($this->input->post('tgl'))
				);
			$id_jurnal = $this->Model_memorial->saveHeader($dt);
				
			$coa = $this->input->post('txt_norek');
			$id_akun = $this->input->post('id_akun');
			$debet = preg_replace('#[^0-9]#', '', $this->input->post('txt_debet'));
			$kredit = preg_replace('#[^0-9]#', '', $this->input->post('txt_kredit'));
			//var_dump($coa);
			//echo sizeof($dt);
			for($i=0; $i<sizeof($coa); $i++){
				$dt = array(
					'id_jurnal' => $id_jurnal,
					'id_akun' => $id_akun[$i],
					'uraian' => $coa[$i],
					'debet' => $debet[$i],
					'kredit' => $kredit[$i]
				);
				$cek = $this->Model_memorial->save($dt);
			}
			if($cek){
				$res = array(
					'status' => TRUE,
					'msg' => 'Data Telah Tersimpan'
				);
				helper_log("Add", "Menambah jurnal dengan id = ".$id_jurnal);
			}else{
				$res = array(
					'status' => FALSE,
					'msg' => 'Terjadi Kesalahan Pada Saat Penyimpanan Data.'
				);
			}
			echo json_encode($res);
		}else{
			show_404();
		}
	}
}
