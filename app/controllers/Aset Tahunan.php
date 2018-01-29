<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Aset extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_akun');
		$this->load->model('Model_memorial');
		$this->load->model('model_aset');
		$this->load->helper('date');
		$this->load->helper('tanggal_helper');
		$this->load->library('user_agent');
		$this->load->model('model_tutupbuku');
	}

	function index()
	{
		$data['judul'] 			= "Daftar Aset";
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
		$this->template->view_baru('aset/daftar', $data);
	}

	function tambah()
	{
		$data['judul'] 	= "Tambah Aset ";
		$data['jenis'] = $this->model_aset->list_aset_kategori();
		$this->template->view_baru('aset/tambah', $data);
	}

	public function detail()
	{
		$kode_unik 		= $this->uri->segment(3);
		$header 		= $this->model_aset->get_data_header($kode_unik)->row_array();
		$data['header'] = $header;
		$data['detail'] = $this->model_aset->get_data_detail($header['id'])->result();
		$data['judul'] 	= "Detail Penyusutan Aset " . $header['nama'];
		$data['back'] 	= $this->uri->segment(1);

		$this->template->view_baru('aset/detail', $data);
	}
	
	public function insert(){
		
		$jenis_aset = 		$this->input->post('id_jenis_aset');
		$cari["konfigurasi"] = $this->model_aset->konfig($jenis_aset);
		
		//validasi jika coa belum di set
		if($cari["konfigurasi"]["rek_rekdebet"]==""){
			die("Rekening Belum di set");
		}
		
		if($cari["konfigurasi"]["rek_rekkredit"]==""){
			die("Rekening Belum di set");
		}
		
		if($cari["konfigurasi"]["rek_rek_d_bbsusut"]==""){
			die("Rekening Belum di set");
		}
		
		if($cari["konfigurasi"]["rek_rek_k_akmsusut"]==""){
			die("Rekening Belum di set");
		}
		
		
		$this->load->model('Model_kas');
			$dt = array(
					'jenis_jurnal' => 'ASET', //$this->input->post('nojurnal'),
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
			
		//jurnal perolehan aset
		$kode_unik = base_convert(microtime(false), 10, 36);
		$dt = array(
					'no_jurnal' => 'ASET/'.$nomor.'/'.$tb.'/'.$iduser, //$this->input->post('nojurnal'),
					'memo' => $this->input->post('nama'),
					'no_bukti' => $this->input->post('nobukti'),
					'tgl_dibuat' => date('Y-m-d H:i:s'),
					'jenis_jurnal' => 'ASET',
					"kode_unik" 	=> $kode_unik,
					'company_id' => 1, //$this->config->item('ses_company_id'),
					'tgl_jurnal' => tgl_en_slash_month($this->input->post('tgl'))
				);
			$id_jurnal = $this->Model_memorial->saveHeader($dt);
		
			//isi debet
			$dt = array(
					'id_jurnal' => $id_jurnal,
					'id_akun' => $cari["konfigurasi"]["rek_rekdebet"],
					'uraian' => $this->input->post('nama'),
					'debet' => preg_replace('#[^0-9]#', '', $this->input->post('nilai')),
					'kredit' => 0
				);
				$cek = $this->Model_memorial->save($dt);
				
			//isi kredit
			$dt = array(
					'id_jurnal' => $id_jurnal,
					'id_akun' => $cari["konfigurasi"]["rek_rekkredit"],
					'uraian' => $this->input->post('nama'),
					'debet' => 0,
					'kredit' => preg_replace('#[^0-9]#', '', $this->input->post('nilai'))
				);
				$cek = $this->Model_memorial->save($dt);
				
			
		$data['judul'] 			= "Daftar Aset";
		$susut = preg_replace('#[^0-9]#', '', $this->input->post('nilai')) / $cari["konfigurasi"]["bagi"];
		$data = array(
				  'nama' => $this->input->post('nama'),
				  'id_jenis_aset' => $this->input->post('id_jenis_aset'),
				  'tgl' => tgl_en_slash_month($this->input->post('tgl')),
				  'nilai' => preg_replace('#[^0-9]#', '', $this->input->post('nilai')),
				  'tarif' => $cari["konfigurasi"]["tarif"],
				  'bagi' => $cari["konfigurasi"]["bagi"],
				  'susut' => $susut,
				  'rekdebet' => $cari["konfigurasi"]["rek_rekdebet"],
				  'rekkredit' => $cari["konfigurasi"]["rek_rekkredit"],
				  'rek_d_bbsusut' => $cari["konfigurasi"]["rek_rek_d_bbsusut"],
				  'rek_k_akmsusut' => $cari["konfigurasi"]["rek_rek_k_akmsusut"],
				  'status' => 1
			);
		$id_aktiva = $this->model_aset->saveHeader($data);
		
		//setup detail penyusutan
		$nilai = preg_replace('#[^0-9]#', '', $this->input->post('nilai'));
		
		$purchase_date = tgl_en_slash_month($this->input->post('tgl'));
		$tahunperolehan = substr($purchase_date, 0,4);
		$bulanperolehan = substr($purchase_date, 5,2);
		
		$akhirperiode = $tahunperolehan."-12-31";
		$akhirperiode_to1py = $tahunperolehan."-12-31";
		$nilaiawal = ($nilai / $cari["konfigurasi"]["bagi"]) * ((12 - ($bulanperolehan * 1) + 1) / 12);
		
		//echo $nilaiawal; echo "<br>";		
		//insert untuk tahun pertama
		
		$data = array(
				  'posted' => 0,
				  'aktiva_id' => $id_aktiva,
				  'nilai' => $nilaiawal,
				  'mano_post' => $akhirperiode
			);
		$this->db->insert('aktiva_details', $data);
		
		//insert tahun berikutnya
		for ($i=1;$i<= $cari["konfigurasi"]["bagi"];$i++) {
			$purchase_date_timestamp = strtotime($akhirperiode);
			$purchase_date_1year = strtotime("+$i year", $purchase_date_timestamp);
			$jtempo = date("Y-m-d", $purchase_date_1year);
			$data = array(
				  'posted' => 0,
				  'aktiva_id' => $id_aktiva,
				  'nilai' => $susut,
				  'mano_post' => $jtempo
			);
			$jtempo_plus1_akhir = $jtempo;
		$this->db->insert('aktiva_details', $data);
			
		}
		
		//update data akhirperiode
		$nilaiakhir = ($nilai / $cari["konfigurasi"]["bagi"] - $nilaiawal);
			
		//$SQL = "UPDATE aktiva_details SET nilai = '".$nilaiakhir."' WHERE mano_post = '".$jtempo."' AND aktiva_id = ".$id_aktiva;
		$data = array(
				  'nilai' => $nilaiakhir
			);
		$this->db->where('aktiva_id',  $id_aktiva);
		$this->db->where('mano_post',  $jtempo);
		$this->db->update('aktiva_details', $data);
		
		
		$dt = array(
					'jenis_jurnal' => 'ASET', //$this->input->post('nojurnal'),
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
		
			
		//jurnal penyusutan aset
		$dt = array(
					'no_jurnal' => 'ASET-PY/'.$nomor.'/'.$tb.'/'.$iduser,  //$this->input->post('nojurnal'),
					'memo' => $this->input->post('nama'),
					'no_bukti' => 'py_'.$this->input->post('nobukti'),
					'tgl_dibuat' => date('Y-m-d H:i:s'),
					'jenis_jurnal' => 'ASET-PY',
					"kode_unik" 	=> 'py_'.$kode_unik,
					'company_id' => 1, //$this->config->item('ses_company_id'),
					'tgl_jurnal' => $akhirperiode_to1py
				);
			$id_jurnal_py = $this->Model_memorial->saveHeader($dt);		
		
			//isi debet pertama
			$dt = array(
					'id_jurnal' => $id_jurnal_py,
					'id_akun' => $cari["konfigurasi"]["rek_rek_d_bbsusut"],
					'uraian' => $this->input->post('nama'),
					'debet' => $nilaiawal,
					'kredit' => 0
				);
				$cek = $this->Model_memorial->save($dt);
				
			//isi kredit pertama
			$dt = array(
					'id_jurnal' => $id_jurnal_py,
					'id_akun' => $cari["konfigurasi"]["rek_rek_k_akmsusut"],
					'uraian' => $this->input->post('nama'),
					'debet' => 0,
					'kredit' => $nilaiawal
				);
				$cek = $this->Model_memorial->save($dt);
				
		
		
		
		
			// isi tengah
			for ($i=1;$i< $cari["konfigurasi"]["bagi"];$i++) {
			    $purchase_date_timestamp = strtotime($akhirperiode);
    			$purchase_date_1year = strtotime("+$i year", $purchase_date_timestamp);
    			$jtempo = date("Y-m-d", $purchase_date_1year);
    			
			    	$dt = array(
					'jenis_jurnal' => 'ASET-PY', //$this->input->post('nojurnal'),
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
        		
        			
        		//jurnal penyusutan aset
        		$dt = array(
        					'no_jurnal' => 'ASET-PY/'.$nomor.'/'.$tb.'/'.$iduser,  //$this->input->post('nojurnal'),
        					'memo' => $this->input->post('nama'),
        					'no_bukti' => 'py_'.$this->input->post('nobukti'),
        					'tgl_dibuat' => date('Y-m-d H:i:s'),
        					'jenis_jurnal' => 'ASET-PY',
        					"kode_unik" 	=> 'py_'.$kode_unik,
        					'company_id' => 1, //$this->config->item('ses_company_id'),
        					'tgl_jurnal' => $jtempo
        				);
        			$id_jurnal_py = $this->Model_memorial->saveHeader($dt);	
        			
			    //isi debet tengah
				$dt = array(
						'id_jurnal' => $id_jurnal_py,
						'id_akun' => $cari["konfigurasi"]["rek_rek_d_bbsusut"],
						'uraian' => $this->input->post('nama'),
						'debet' => $susut,
						'kredit' => 0
					);
					$cek = $this->Model_memorial->save($dt);
					
				//isi kredit tengah
				$dt = array(
						'id_jurnal' => $id_jurnal_py,
						'id_akun' => $cari["konfigurasi"]["rek_rek_k_akmsusut"],
						'uraian' => $this->input->post('nama'),
						'debet' => 0,
						'kredit' => $susut
					);
					$cek = $this->Model_memorial->save($dt);
				
			}
		
		
		    //akhir
		    	$dt = array(
					'jenis_jurnal' => 'ASET-PY', //$this->input->post('nojurnal'),
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
        		
        			
        		//jurnal penyusutan aset
        		$dt = array(
        					'no_jurnal' => 'ASET-PY/'.$nomor.'/'.$tb.'/'.$iduser,  //$this->input->post('nojurnal'),
        					'memo' => $this->input->post('nama'),
        					'no_bukti' => 'py_'.$this->input->post('nobukti'),
        					'tgl_dibuat' => date('Y-m-d H:i:s'),
        					'jenis_jurnal' => 'ASET-PY',
        					"kode_unik" 	=> 'py_'.$kode_unik,
        					'company_id' => 1, //$this->config->item('ses_company_id'),
        					'tgl_jurnal' => $jtempo_plus1_akhir
        				);
        			$id_jurnal_py = $this->Model_memorial->saveHeader($dt);	
        			
			//isi debet akhir
			$dt = array(
					'id_jurnal' => $id_jurnal_py,
					'id_akun' => $cari["konfigurasi"]["rek_rek_d_bbsusut"],
					'uraian' => $this->input->post('nama'),
					'debet' => $nilaiakhir,
					'kredit' => 0
				);
				$cek = $this->Model_memorial->save($dt);
				
			//isi kredit akhir
			$dt = array(
					'id_jurnal' => $id_jurnal_py,
					'id_akun' => $cari["konfigurasi"]["rek_rek_k_akmsusut"],
					'uraian' => $this->input->post('nama'),
					'debet' => 0,
					'kredit' => $nilaiakhir
				);
				$cek = $this->Model_memorial->save($dt);
				
		
		
		redirect('aset');
	}
}
