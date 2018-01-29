<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyek extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_proyek');
		$this->load->model('model_kas');
		$this->load->model('model_akun');
		$this->load->model('model_jurnal');
		$this->load->library("form_validation");
		$this->load->helper('tanggal_helper');
	}

	public function index()
	{
		$data['judul'] 		= 'Daftar Proyek';
		$data['proyek'] 	= $this->Model_proyek->listProyek();
		$this->template->view_baru('proyek/data', $data);
	}
	public function kasmasuk()
	{
		$id = $this->input->get("id");;
		$data["judul"]="DETAIL PROYEK";
		$data['proyek_detail'] 	= $this->Model_proyek->listProyekByID($id);
		//echo $this->db->last_query();
		
		$data['akun'] = $this->model_akun->list_akun();
		$data['kasbank'] = $this->model_kas->list_kasbank();
		$data['program'] = $this->model_kas->list_program();
		$data['departemen'] = $this->model_kas->list_departemen();
		$data['sumberdana'] = $this->model_kas->list_sumberdana();
		$data["penyedia"]= $this->model_kas->getComboPenyedia();
		
		$this->template->view_baru('proyek/kasmasuk', $data);
	}
	
	
	public function simpankaskeluar(){
		
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
			
			//buat nomor jurnal
			$this->load->model('Model_kas');
			$dt = array(
					'jenis_jurnal' => 'BKK-PY', //$this->input->post('nojurnal'),
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
					'no_jurnal' => 'BKK-PY/'.$nomor.'/'.$tb.'/'.$iduser, //$this->input->post('nojurnal'),
					'no_bukti' => $this->input->post('nobukti'),
					'kreditur' => $this->input->post('kreditur'),
					'memo' => $this->input->post('keterangan'),
					'tgl_dibuat' => date('Y-m-d H:i:s'),
					'jenis_jurnal' => 'BKK-PY',
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
	
	
	public function simpankasmasuk(){
		
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
			//buat nomor jurnal
			$this->load->model('Model_kas');
			$dt = array(
					'jenis_jurnal' => 'BKM-PY', //$this->input->post('nojurnal'),
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
					'no_jurnal' => 'BKM-PY/'.$nomor.'/'.$tb.'/'.$iduser, //$this->input->post('nojurnal'),
					'no_bukti' => $this->input->post('nobukti'),
					'kreditur' => $this->input->post('kreditur'),
					'memo' => $this->input->post('keterangan'),
					'tgl_dibuat' => date('Y-m-d H:i:s'),
					'jenis_jurnal' => 'BKM-PY',
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
	
	
	public function kaskeluar()
	{
		$id = $this->input->get("id");;
		$data["judul"]="DETAIL PROYEK";
		$data['proyek_detail'] 	= $this->Model_proyek->listProyekByID($id);
		//echo $this->db->last_query();
		
		$data['akun'] = $this->model_akun->list_akun();
		$data['kasbank'] = $this->model_kas->list_kasbank();
		$data['program'] = $this->model_kas->list_program();
		$data['departemen'] = $this->model_kas->list_departemen();
		$data['sumberdana'] = $this->model_kas->list_sumberdana();
		$data["penyedia"]= $this->model_kas->getComboPenyedia();
		
		$this->template->view_baru('proyek/kaskeluar', $data);
	}
	
	public function resume()
	{
		$id = $this->input->get("idProyek");
		$data["judul"]="DETAIL PROYEK";
		$data['proyek_detail'] 	= $this->Model_proyek->listProyekByID($id);
		//echo $this->db->last_query();
		
		$data['sumberdana'] = $this->model_kas->list_sumberdana();
		
		$data['akun'] = $this->model_jurnal->list_jurnal_detailByProyek($id);
	
		$this->template->view_baru('proyek/resume', $data);
	}
	
	public function enum()
	{
		
		$data['proyek'] 	= $this->Model_proyek->field_enums();
		//print_r($data['proyek']);
	}

	
	public function detail()
	{
		$id = $this->input->get("id");
		$data["judul"]="DETAIL PROYEK";
		$data['proyek_detail'] 	= $this->Model_proyek->listProyekByID($id);
		//echo $this->db->last_query();
		
		//$data['kasbank'] = $this->model_kas->list_kasbank();
		//$data['departemen'] = $this->model_kas->list_departemen();
		$data['sumberdana'] = $this->model_kas->list_sumberdana();
		
		$this->template->view_baru('proyek/index', $data);
	}

	public function tambah()
	{
		$data['judul'] 		= 'Tambah Proyek';
		$data['errors'] 	= '';
		
		$data['bank']  = array();
		$data['program'] 	= $this->Model_proyek->listProgram();
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('nama_proyek', 'Nama Proyek', 'required|max_length[50]');
			$this->form_validation->set_rules('id_program', 'No Program', 'required');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|max_length[50]');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$message = alert_php2('Proses Gagal. ', 'error', 'Data gagal disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'proyek');
			} else 
			{
				$data_create = array(
					'nama_proyek' 			=> $this->input->post('nama_proyek'), 
					'id_program' 			=> $this->input->post('id_program'), 
					'jenis_proyek'	 		=> $this->input->post('jenis_proyek'), 
					'tanggal_sampai'	 		=> tgl_en($this->input->post('tanggal_sampai')), 
					'tanggal_dari'	 		=> tgl_en($this->input->post('tanggal_dari')), 
					'nilai'	 				=> preg_replace('#[^0-9]#', '', $this->input->post('nilai')), 
					'keterangan'	 		=> $this->input->post('keterangan')
				);
				$this->db->insert('tbl_proyek', $data_create);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'Proyek');
			}
		}
		$this->template->view_baru('proyek/form', $data);
	}

	public function ubah()
	{
		$id 		= $this->input->get('id');
		$data['judul'] 		= 'Ubah Proyek';
		$data['errors'] 	= '';
		$data['proyek']  = $this->Model_proyek->getProyekById($id);
		$data['program'] 	= $this->Model_proyek->listProgram();
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			
		 
				$data_create = array(
					'nama_proyek' 			=> $this->input->post('nama_proyek'), 
					'id_program' 			=> $this->input->post('id_program'), 
					'keterangan'	 		=> $this->input->post('keterangan'),
					'jenis_proyek'	 		=> $this->input->post('jenis_proyek'), 
					'nilai'	 				=> preg_replace('#[^0-9]#', '', $this->input->post('nilai')), 
					'tanggal_sampai'	 		=> tgl_en($this->input->post('tanggal_sampai')), 
					'tanggal_dari'	 		=> tgl_en($this->input->post('tanggal_dari')) 
				);
				$key['id'] = $this->input->post('id');
				$this->db->update('tbl_proyek', $data_create, $key);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect(base_url().'proyek');
			 
		}
		$this->template->view_baru('proyek/form', $data);
	}

	public function hapus()
	{
		$id = $this->input->get('id');
		$delete 	= $this->Model_proyek->hapusProyek($id);
		if($delete){
			$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil dihapus');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect(base_url().'proyek');
		}else{
			$message = alert_php2('Proses gagal. ', 'error', 'Data gagal dihapus');
			$this->session->set_userdata($this->config->item('ses_message'), $message);
			redirect(base_url().'proyek');
		}
	}

}

/* End of file Bank.php */
/* Location: .//D/xampp/htdocs/FELLOW/akuntansi/app/controllers/Bank.php */