<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Services extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('model_services');
		$this->load->model('Model_bukubesar');
		$this->load->model('Model_pegawai');
		$this->load->model('Model_memorial');
		$this->load->model('Model_karyawan_keu');
		$this->load->helper('tanggal_helper');
	}
	function getLaporanAktivitas(){
	    $data["bulan"] = $this->input->get('bulan');
	    $data["tahun"] = $this->input->get('tahun');;
	    $data["idsecret"] = $this->model_services->get_api_id();
	    $data["akivitas4"] = $this->model_services->list_aktivitas4();
	    $data["akivitas5"] = $this->model_services->list_aktivitas5();
        $data['akunAsetNetto'] = $this->model_services->list_asetnetto();
        $data['aktiva'] = $this->Model_bukubesar->list_aktiva_nerc();
		$data['pasiva'] = $this->Model_bukubesar->list_23();
		
	    echo json_encode($data);
	    helper_log("Web Services", "Menggunakan Web Services");
	}

	function paramgaji(){


			$jumlah = $this->Model_karyawan_keu->cekJurnal($this->input->post('idkaryawan'), $this->input->post('paramgaji'), date('Y'), date('m'));
			if($jumlah){
				die('Gaji Telah Dijurnal Sebelumnya.');
			}

		//update ke tabel paramdetail
        $this->Model_karyawan_keu->insertReplace($this->input->post('idkaryawan'), $this->input->post('paramgaji'), $this->input->post('nilai'));


		//cek tahun berjalan
			//cek tahun berjalan
			if($this->input->post("d")=="" || $this->input->post("k")==""){
				die(', Status Jurnal : GAGAL; Coa Belum di Set.');
			}
			$pdata = $this->session->userdata('session_data'); //Retrive ur session

			$akhir_periode = $pdata['akhir_periode'];
			$awal_periode = $pdata['awal_periode'];
			

			$data_input = date('Y-m-d'); //new DateTime(tgl_en($this->input->post('tgl')));
			$expire_dt_awal = new DateTime($awal_periode);
			$expire_dt_akhir = new DateTime($akhir_periode);

			if ($data_input < $awal_periode) { 
				
					die('Transaksi di bawah awal periode');
				
			}
			if ($data_input > $akhir_periode) { 
				die('Transaksi di atas akhir periode');
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
					'memo' => 'Penggajian',
					'tgl_dibuat' => date('Y-m-d H:i:s'),
					'jenis_jurnal' => 'GAJI',
					'kode_gaji' => $this->input->post('idkaryawan') .'_'. $this->input->post('paramgaji')  .'_'. date('Y')  .'_'. date('m'),
					'company_id' => 1, //$this->config->item('ses_company_id'),
					'tgl_jurnal' => date('Y-m-d')//tgl_en($this->input->post('tgl'))
				);
			$id_jurnal = $this->Model_memorial->saveHeader($dt);
				
			$coa = $this->input->post('txt_norek');
			$id_akun = $this->input->post('id_akun');
			$debet = preg_replace('#[^0-9]#', '', $this->input->post('txt_debet'));
			$kredit = preg_replace('#[^0-9]#', '', $this->input->post('txt_kredit'));
			//var_dump($coa);
			//echo sizeof($dt);
			
				$dt = array(
					'id_jurnal' => $id_jurnal,
					'id_akun' => $this->input->post('d'),
					'uraian' => 'Penggajian',
					'debet' => $this->input->post('nilai'),
					'kredit' => 0
				);
				$cek = $this->Model_memorial->save($dt);
				
				$dt = array(
					'id_jurnal' => $id_jurnal,
					'id_akun' =>  $this->input->post('k'),
					'uraian' => 'Penggajian',
					'debet' => 0,
					'kredit' => $this->input->post('nilai')
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
			helper_log("Add", "Menambah Penggajian dengan id = ".$id_jurnal);
	}
}
?>