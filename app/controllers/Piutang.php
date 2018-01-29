<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Piutang extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_akun');
		$this->load->model('model_piutang');
		$this->load->model('model_donatur');
		$this->load->helper('date');
		$this->load->library('user_agent');
		$this->load->model('model_tutupbuku');
	}

	function index()
	{
		$data['akun'] = $this->model_akun->list_akun();
		$data['penyedia'] = $this->model_donatur->list_penyedia();
		$this->template->view_baru('piutang/add',$data);
	}
	
	public function simpan(){
		
		if($this->input->is_ajax_request()){
			//$cek = ''
			$res = array();
			$this->load->model('Model_memorial');
			$this->load->helper('tanggal_helper');
			
			
			//cek tahun berjalan
			//cek tahun berjalan
			$pdata = $this->session->userdata('session_data'); //Retrive ur session

			$tahun = $pdata['ses_tahun_buku'];
			
			if(substr($this->input->post('tgl'),-4) != $tahun){
				
				$res = array(
					'status' => FALSE,
					'msg' => 'Bukan tahun aktif '
				);
				die(json_encode($res));
			}
			
			$kode_unik = base_convert(microtime(false), 10, 36);
			
			//input header
			$dt = array(
					'no_jurnal' => 'Tes', //$this->input->post('nojurnal'),
					'no_bukti' => $this->input->post('nobukti'),
					'debitur' => $this->input->post('debitur'),
					'memo' => $this->input->post('keterangan'),
					'tgl_dibuat' => date('Y-m-d H:i:s'),
					'jenis_jurnal' => 'JP',
					"kode_unik" 	=> $kode_unik,
					'company_id' => 1, //$this->config->item('ses_company_id'),
					'tgl_jurnal' => tgl_en($this->input->post('tgl'))
				);
			$id_jurnal = $this->Model_memorial->saveHeader($dt);
				
			$coa = $this->input->post('txt_norek');
			$id_akun = $this->input->post('id_akun');
			$debet = $this->input->post('txt_debet');
			$kredit = $this->input->post('txt_kredit');
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
	
	public function listjp()
	{
		$data['judul'] 			= "Daftar Jurnal Piutang";
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

		$data['jurnal'] 		= $this->model_piutang->list_jurnal($data['tanggal_awal'],
		$data['tanggal_akhir'], $data['no_jurnal'], $data['dikonfirmasi'])->result();
		$this->template->view_baru('piutang/daftar_jurnal', $data);
	}
	
}
