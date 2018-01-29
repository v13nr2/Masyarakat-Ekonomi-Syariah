<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Kas extends CI_Controller {
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
		$data['sumberdana'] = $this->model_kas->list_sumberdana();
		$data["penyedia"]= $this->model_kas->getComboPenyedia();
		$data["kategori_penyedia_dana"]= $this->model_kas->kategori_penyedia_dana();
		$data["kategori_dana"]= $this->model_kas->kategori_dana();
		$data["penyaluran"]= $this->model_kas->tbl_penyaluran_dana();
		$this->template->view_baru('kas/add',$data);
	}
	
	public function getComboProyek(){
		$id_program = $this->input->post('id');
		$data["proyek"]= $this->model_kas->getComboProyek($id_program);
		die(json_encode($data["proyek"]));
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

		/*	if(substr($this->input->post('tgl'),-4) != $tahun){
				
				$res = array(
					'status' => FALSE,
					'msg' => 'Bukan tahun aktif '
				);
				//die(json_encode($res));
			}*/
			
			$kode_unik = base_convert(microtime(false), 10, 36);
			//buat nomor jurnal
			$this->load->model('Model_kas');
			$nourut =  $this->Model_kas->nourut();
			$dt = array(
					'jenis_jurnal' => 'BKM', //$this->input->post('nojurnal'),
					'urut' => $nourut+1,
					'tahun' => date('Y'),
					'bulan' => date('m'),
					'ip' => $this->input->post('kreditur'),
					'user' => $this->input->post('keterangan')
				);
			$id_counter = $this->Model_kas->saveCounter($dt);
			$pdata = $this->session->userdata('session_data'); //
			//$tb = $pdata['ses_tahun_buku'];
			$iduser =  $pdata['ses_user_id'];
			$this->load->helper('nomor_helper');
			$nomor = nojurnal($nourut+1);
			//input header
			$dt = array(
					'no_jurnal' => date('Y').date('m').$nomor, //$this->input->post('nojurnal'),
					'no_bukti' => $this->input->post('nobukti'),
					'kreditur' => $this->input->post('kreditur'),
					'memo' => $this->input->post('keterangan'),
					'tgl_dibuat' => date('Y-m-d H:i:s'),
					'jenis_jurnal' => 'BKM',
					'program' => $this->input->post('program'),
					'proyek' => $this->input->post('proyek'),
					'kategori' => $this->input->post('kategori'),
					'kategori_penyedia_dana' => $this->input->post('kategori_penyedia_dana'),
					'kategori_dana' => $this->input->post('kategori_dana'),
					'penyedia' => $this->input->post('penyedia'),
					'sumberdana' => $this->input->post('sumberdana'),
					'departemen' => $this->input->post('departemen'),
					'penyaluran' => $this->input->post('penyaluran'),
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
			$total_kredit = 0;
			for($i=0; $i<sizeof($coa); $i++){
				
				$total_kredit = $total_kredit + $kredit[$i];
				
			}
				$dt = array(
					'id_jurnal' => $id_jurnal,
					'id_akun' => $this->input->post('coa_debet'),
					'uraian' => $this->input->post('keterangan'),
					'debet' => $total_kredit,
					'kredit' => 0
				);
				$cek = $this->Model_memorial->save($dt);
				
			for($i=0; $i<sizeof($coa); $i++){
				$dt = array(
					'id_jurnal' => $id_jurnal,
					'id_akun' => $id_akun[$i],
					'uraian' => $coa[$i],
					'debet' => 0,
					'kredit' => $kredit[$i]
				);
				$total_kredit = $total_kredit + $kredit[$i];
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

		$data['jurnal'] 		= $this->model_kas->list_jurnal($data['tanggal_awal'],
		$data['tanggal_akhir'], $data['no_jurnal'], $data['dikonfirmasi'])->result();
		$this->template->view_baru('kas/daftar_jurnal', $data);
	}
	
}
