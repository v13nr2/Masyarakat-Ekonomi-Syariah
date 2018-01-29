<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Jenjang extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('model_jenjang');
		$this->load->library('form_validation');
	}
	function index() {
		$data['judul'] 	= "Daftar Jenjang Kepengurusan";
		$data['akun'] = $this->model_jenjang->list_jenjang();
		//var_dump($data['akun']);die();
		$this->template->view_baru('jenjang/daftar_jenjang', $data);
	}
	function tambah() {
		$data['judul'] 		= "Tambah Jenjang Baru";
		$data['indukakun'] 	= $this->model_jenjang->list_indukakun()->result();

		$data['id_tipe_akun'] 		= $this->input->post('tipe_akun');
		$data['kode_akun_depan'] 	= $this->input->post('kode_akun_depan');
		$data['kode_jenjang'] 			= $this->input->post('kode_jenjang');
		$data['nama_jenjang'] 		= $this->input->post('nama_jenjang');

		$data['induk_akun'] 			= $this->input->post('induk_akun');

		$data['posisi'] 			= "0";
		$data['errors'] 	= '';

		$btnSimpan 	= $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
		    //die('konjreng');
			if($data['induk_akun']==""){
				$data_akun = array(
							"level" => '0',
							"id_parent" => '',
							"kode_jenjang" => $data["kode_akun"],
							"nama_jenjang" => $data["nama_jenjang"], "aktif" => "A");
						$data['id_tipe_akun'] 		= "";
						$data['kode_akun_depan'] 	= "";
						$data['kode_jenjang'] 	= "";
						$data['nama_jenjang'] 	= "";
						$this->db->insert('mst_jenjang', $data_akun);
						$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
						$this->session->set_userdata($this->config->item('ses_message'), $message);
						helper_log("Add", "Menambah Akun dengan = ".$data["kode_akun"]);
						redirect('jenjang');
			}else{
			
					$kode_check = $data["kode_akun_depan"].$data["kode_jenjang"];
					    $this->db->where('kode_jenjang',$data['induk_akun']);
						$master_akun = $this->db->get('mst_jenjang')->row();

						$data_akun = array(
							"level" => ($master_akun->level + 1),
							"id_parent" => $master_akun->id_jenjang,
							"kode_jenjang" => $data["induk_akun"].$data["kode_jenjang"],
							"nama_jenjang" => $data["nama_jenjang"], "aktif" => "A");
						$data['id_tipe_akun'] 		= "";
						$data['kode_akun_depan'] 	= "";
						$data['kode_jenjang'] 	= "";
						$data['nama_jenjang'] 	= "";
						$this->db->insert('mst_jenjang', $data_akun);
						$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
						$this->session->set_userdata($this->config->item('ses_message'), $message);
						helper_log("Add", "Menambah Jenjang dengan induk ".$data["induk_akun"].$data["kode_akun"]);
						redirect('jenjang');
					
				
			}
		}
		$this->template->view_baru('jenjang/tambah_jenjang', $data);
	}
	function ubah() {
		$id_akun = $this->uri->segment(3);
		$data['judul'] 		= "Ubah Akun";
		$data['jenjang'] 		= $this->model_jenjang->get_jenjang_by_id($id_akun)->row_array();  //ok
		
		$idparent 			= $data['jenjang']["id_parent"];
		//cari detail parent
		$data['akunparent'] 		= $this->model_jenjang->get_induk_by_id($idparent)->row_array();
		 
		$data['indukakun'] 	= $this->model_jenjang->list_indukakun()->result();
		$data['kode_induk'] = $data['akunparent']['kode_jenjang'];
		$data['kode_anak'] = $data['jenjang']['kode_jenjang'];
		
		$data['errors'] 	= '';
		
		$data['kode_akun_depan'] 	= $data['akunparent']['kode_jenjang'];
		
		$data['kode_jenjang'] 	= $this->input->post('kode_jenjang');
		$data['nama_jenjang'] 	= $this->input->post('nama_jenjang');
		 
		$this->form_validation->set_rules('kode_jenjang', 'Kode Jenjang', 'required'); 
		/*$this->form_validation->set_rules('posisi', 'Posisi', 'required');*/
		$btnSimpan 	= $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {

				
						$data_akun = array("kode_jenjang" => $data["kode_akun_depan"].$data["kode_jenjang"], "nama_jenjang" => $data["nama_jenjang"] );
						
						$this->db->where('md5(id_jenjang)', $id_akun);
						$this->db->update('mst_jenjang', $data_akun);
						$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil diubah');
						$this->session->set_userdata($this->config->item('ses_message'), $message);
						redirect('jenjang');
					
				
	
		}
		$this->template->view_baru('jenjang/ubah_jenjang', $data);
	}
	function hapus() {
		$id_akun = $this->uri->segment(3);
		$this->db->where('md5(id_jenjang)', $id_akun);
		//$this->db->where('company_id', $this->session->userdata($this->config->item('ses_company_id')));
		$this->db->delete('mst_jenjang');
	
		$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil dinonaktifkan');
		$this->session->set_userdata($this->config->item('ses_message'), $message);
		redirect('jenjang');
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
