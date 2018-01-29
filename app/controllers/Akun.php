<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Akun extends CI_Controller {
	function __construct() { 
		parent::__construct();
		$this->load->model('model_akun');
		$this->load->model('model_tipeakun');
		$this->load->library('form_validation');
	}
	function index() {
		$data['judul'] 	= "Daftar Akun";
		$data['akun'] = $this->model_akun->list_akun();
		//var_dump($data['akun']);die();
		$this->template->view_baru('akun/daftar_akun', $data);
	}
	function tambah() {
		$data['judul'] 		= "Tambah Akun Baru";
		$data['tipeakun'] 	= $this->model_tipeakun->list_tipeakun()->result();
		$data['indukakun'] 	= $this->model_tipeakun->list_indukakun()->result();

		$data['id_tipe_akun'] 		= $this->input->post('tipe_akun');
		$data['kode_akun_depan'] 	= $this->input->post('kode_akun_depan');
		$data['kode_akun'] 			= $this->input->post('kode_akun');
		$data['nama_akun'] 			= $this->input->post('nama_akun');
		$data['saldo_normal'] 		= $this->input->post('saldo_normal');
		$data['lokasi'] 			= $this->input->post('lokasi');

		$data['induk_akun'] 			= $this->input->post('induk_akun');

		$data['posisi'] 			= "0";
		$data['errors'] 	= '';
		$this->form_validation->set_rules('tipe_akun', 'Tipe Akun', 'required');
		$this->form_validation->set_rules('kode_akun', 'Kode Akun', 'required|min_length[1]|max_length[4]');
		$this->form_validation->set_rules('nama_akun', 'Nama Akun', 'required');
		$this->form_validation->set_rules('saldo_normal', 'Saldo Normal', 'required');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
		/*$this->form_validation->set_rules('posisi', 'Posisi', 'required');*/
		$btnSimpan 	= $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			if($data['induk_akun']==""){
				$data_akun = array(
							"level" => '0',
							"id_parent" => '',
							"id_tipe_akun" => $data["id_tipe_akun"],
							"kode_akun" => $data["kode_akun"],
							"nama_akun" => $data["nama_akun"], "saldo_normal" => $data["saldo_normal"], "lokasi" => $data["lokasi"], "posisi" => $data["posisi"], "aktif" => "A", "company_id" => $this->session->userdata($this->config->item('ses_company_id')) );
						$data['id_tipe_akun'] 		= "";
						$data['kode_akun_depan'] 	= "";
						$data['kode_akun'] 	= "";
						$data['nama_akun'] 	= "";
						$data['lokasi'] 	= "";
						$data['posisi'] 	= "";
						$data['saldo_normal'] 	= "";
						$this->db->set('tgl_dibuat', 'NOW()', FALSE);
						$this->db->set('tgl_diubah', 'NOW()', FALSE);
						$this->db->insert('mst_akun', $data_akun);
						$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
						$this->session->set_userdata($this->config->item('ses_message'), $message);
						helper_log("Add", "Menambah Akun dengan = ".$data["kode_akun"]);
						redirect('akun');
			}else{
			if ($this->form_validation->run() == FALSE) {
				} else {
					$kode_check = $data["kode_akun_depan"].$data["kode_akun"];
					if($this->model_akun->check_kode_akun_insert($kode_check)>0) {
						$data['errors'] = alert_php2('Kode akun <b>' . $kode_check . '</b> sudah ada!', 'danger', '');
					} else {

						$this->db->where('kode_akun',$data['induk_akun']);
						$master_akun = $this->db->get('mst_akun')->row();

						$data_akun = array(
							"level" => ($master_akun->level + 1),
							"id_parent" => $master_akun->id_akun,
							"id_tipe_akun" => $data["id_tipe_akun"],
							"kode_akun" => $data["induk_akun"].$data["kode_akun"],
							"nama_akun" => $data["nama_akun"], "saldo_normal" => $data["saldo_normal"], "lokasi" => $data["lokasi"], "posisi" => $data["posisi"], "aktif" => "A", "company_id" => $this->session->userdata($this->config->item('ses_company_id')) );
						$data['id_tipe_akun'] 		= "";
						$data['kode_akun_depan'] 	= "";
						$data['kode_akun'] 	= "";
						$data['nama_akun'] 	= "";
						$data['lokasi'] 	= "";
						$data['posisi'] 	= "";
						$data['saldo_normal'] 	= "";
						$this->db->set('tgl_dibuat', 'NOW()', FALSE);
						$this->db->set('tgl_diubah', 'NOW()', FALSE);
						$this->db->insert('mst_akun', $data_akun);
						$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
						$this->session->set_userdata($this->config->item('ses_message'), $message);
						helper_log("Add", "Menambah Akun dengan induk ".$data["induk_akun"].$data["kode_akun"]);
						redirect('akun');
					}
				}
			}
		}
		$this->template->view_baru('akun/tambah_akun', $data);
	}
	function ubah() {
		$id_akun = $this->uri->segment(3);
		$data['judul'] 		= "Ubah Akun";
		$data['akun'] 		= $this->model_akun->get_akun_by_id($id_akun)->row_array();  //ok
		
		$idparent 			= $data['akun']["id_parent"];
		//cari detail parent
		$data['akunparent'] 		= $this->model_akun->get_akun_by_id_induk($idparent)->row_array();
		
		$data['indukakun'] 	= $this->model_tipeakun->list_indukakun()->result();
		$data['kode_induk'] = $data['akunparent']['kode_akun'];
		$data['kode_anak'] = $data['akun']['kode_akun'];
		
		$data['tipeakun'] 	= $this->model_tipeakun->list_tipeakun()->result();
		$data['errors'] 	= '';
		
		$data['kode_akun_depan'] 	= $data['akunparent']['kode_akun'];
		
		$data['kode_akun'] 	= $this->input->post('kode_akun');
		$data['nama_akun'] 	= $this->input->post('nama_akun');
		$data['lokasi'] 	= $this->input->post('lokasi');
		$data['id_tipe_akun'] = $this->input->post('tipe_akun');
		/*$data['posisi'] 	= $this->input->post('posisi');*/
		$data['saldo_normal'] 	= $this->input->post('saldo_normal');
		$this->form_validation->set_rules('tipe_akun', 'Tipe Akun', 'required');
		$this->form_validation->set_rules('kode_akun', 'Kode Akun', 'required|min_length[1]|max_length[10]');
		$this->form_validation->set_rules('nama_akun', 'Nama Akun', 'required');
		$this->form_validation->set_rules('saldo_normal', 'Saldo Normal', 'required');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
		/*$this->form_validation->set_rules('posisi', 'Posisi', 'required');*/
		$btnSimpan 	= $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
/* 			if($data['']){

			}else{

			} */
			if ($this->form_validation->run() == FALSE) {
			} else {
				$kode_check = $data["kode_akun_depan"].$data["kode_akun"];
				if($this->model_akun->check_kode_akun_update($kode_check, $data['akun']['kode_akun'])>0) {
					$data['errors'] = alert_php2('Kode akun <b>' . $kode_check . '</b> sudah ada!', 'danger', '');
				} else {
					if($data['akun']["nama_akun"]=="Laba (Rugi) Bulan Berjalan") {
						$message = alert_php2('Akun Ini Tidak Dapat Diubah. ', 'warning', '');
						$this->session->set_userdata($this->config->item('ses_message'), $message);
						redirect('akun/ubah/'.$id_akun);
					} elseif($data['akun']["nama_akun"]=="Laba (Rugi) Ditahan") {
						$message = alert_php2('Akun Ini Tidak Dapat Diubah. ', 'warning', '');
						$this->session->set_userdata($this->config->item('ses_message'), $message);
						redirect('akun/ubah/'.$id_akun);
					} else {
						$data_akun = array("id_tipe_akun" => $data["id_tipe_akun"], "kode_akun" => $data["kode_akun_depan"].$data["kode_akun"], "nama_akun" => $data["nama_akun"], "saldo_normal" => $data["saldo_normal"], "lokasi" => $data["lokasi"] );
						$this->db->set('tgl_diubah', 'NOW()', FALSE);
						$this->db->where('md5(id_akun)', $id_akun);
						$this->db->where('company_id', $this->session->userdata($this->config->item('ses_company_id')));
						$this->db->update('mst_akun', $data_akun);
						$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil diubah');
						$this->session->set_userdata($this->config->item('ses_message'), $message);
						redirect('akun');
					}
				}
			}
		} else {
			$data['kode_akun_depan'] 	= substr($data["akun"]["kode_akun"], 0, 2);
			$lens = strlen($data["akun"]["kode_akun"]);
			$data['kode_akun'] 	= substr($data["akun"]["kode_akun"], 2, $lens);
		}
		$this->template->view_baru('akun/ubah_akun', $data);
	}
	function hapus() {
		$id_akun = $this->uri->segment(3);
		$data_akun = array("tgl_diubah" => date("Y-m-d H:i:s"), "aktif" => "N");
		
		$this->db->where('md5(id_akun)', $id_akun);
		//$this->db->where('company_id', $this->session->userdata($this->config->item('ses_company_id')));
		$this->db->delete('mst_akun');
	
		$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil dinonaktifkan');
		$this->session->set_userdata($this->config->item('ses_message'), $message);
		redirect('akun');
	}
	function aktif() {
		$id_akun = $this->uri->segment(3);
		$data_akun = array("tgl_diubah" => date("Y-m-d H:i:s"), "aktif" => "A");
		$this->db->where('md5(id_akun)', $id_akun);
		$this->db->where('company_id', $this->session->userdata($this->config->item('ses_company_id')));
		$this->db->update('mst_akun', $data_akun);
		$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil diaktifkan');
		$this->session->set_userdata($this->config->item('ses_message'), $message);
		redirect('akun');
	}
}
