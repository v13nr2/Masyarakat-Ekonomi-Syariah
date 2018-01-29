<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Kaskeluar extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_akun');
		$this->load->model('model_kas');
		$this->load->helper('date');
		$this->load->library('user_agent');
		$this->load->model('model_tutupbuku');
	}

	function index()
	{
		$data['akun'] = $this->model_akun->list_akun();
		$data['kasbank'] = $this->model_kas->list_kasbank();
		$data['program'] = $this->model_kas->list_program();
		$data['departemen'] = $this->model_kas->list_departemen();
		$data["penyedia"]= $this->model_kas->getComboPenyedia();
		$data['sumberdana'] = $this->model_kas->list_sumberdana();
		$this->template->view_baru('kaskeluar/add',$data);
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

			$akhir_periode = $pdata['akhir_periode'];
			$awal_periode = $pdata['awal_periode'];
			

			$data_input = new DateTime(tgl_en($this->input->post('tgl')));
			$expire_dt_awal = new DateTime($awal_periode);
			$expire_dt_akhir = new DateTime($akhir_periode);

			if ($data_input < $expire_dt_awal) { 
				$res = array(
					'status' => FALSE,
					'msg' => 'Transaksi di bawah awal periode'
				);
				die(json_encode($res));
			}
			if ($data_input > $expire_dt_akhir) { 
				$res = array(
					'status' => FALSE,
					'msg' => 'Transaksi di atas akhir periode'
				);
				die(json_encode($res));
			}
			$kode_unik = base_convert(microtime(false), 10, 36);
			
			//buat nomor jurnal
			$this->load->model('Model_kas');
			$dt = array(
					'jenis_jurnal' => 'BKK', //$this->input->post('nojurnal'),
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
					'no_jurnal' => 'BKK/'.$nomor.'/'.$tb.'/'.$iduser, //$this->input->post('nojurnal'),
					'no_bukti' => $this->input->post('nobukti'),
					'kreditur' => $this->input->post('kreditur'),
					'memo' => $this->input->post('keterangan'),
					'tgl_dibuat' => date('Y-m-d H:i:s'),
					'jenis_jurnal' => 'BKK',
					'program' => $this->input->post('program'),
					'proyek' => $this->input->post('proyek'),
					'penyedia' => $this->input->post('penyedia'),
					'sumberdana' => $this->input->post('sumberdana'),
					'departemen' => $this->input->post('departemen'),
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
			$total_debet = 0;
			
			for($i=0; $i<sizeof($coa); $i++){
				$dt = array(
					'id_jurnal' => $id_jurnal,
					'id_akun' => $id_akun[$i],
					'uraian' => $coa[$i],
					'debet' => $debet[$i],
					'kredit' => 0
				);
				$total_debet = $total_debet + $debet[$i];
				$cek = $this->Model_memorial->save($dt);
			}
				
				$dt = array(
					'id_jurnal' => $id_jurnal,
					'id_akun' => $this->input->post('coa_kredit'),
					'uraian' => $this->input->post('keterangan'),
					'debet' => 0,
					'kredit' => $total_debet
				);
				$cek = $this->Model_memorial->save($dt);
				
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
	
	public function listkas()
	{
		$data['judul'] 			= "Daftar Jurnal kas";
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

		$data['jurnal'] 		= $this->model_kas->list_jurnal_BKK($data['tanggal_awal'],
		$data['tanggal_akhir'], $data['no_jurnal'], $data['dikonfirmasi'])->result();
		$this->template->view_baru('kaskeluar/daftar_jurnal', $data);
	}
	
}
