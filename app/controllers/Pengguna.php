<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Pengguna extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('model_pengguna');
		$this->load->model('Mupload');
		//$this->load->model('Mupload');
		$this->load->library('form_validation');
	}
	public function index() {
		$data['judul'] 		= 'Daftar Pengguna';
		$data['pengguna'] 	= $this->model_pengguna->listPengguna()->result();
		$data['pengurus'] 	= $this->model_pengguna->GetPengurus();
		
		$this->template->view_baru('pengguna/daftar_pengguna', $data);
	}
	public function tambah() {
		$data['judul'] 		= 'Tambah Pengguna';
		$data['errors'] 	= '';
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		
		$data['pengurus'] 	= $this->model_pengguna->GetPengurus();

		$data['organisasi'] 	= $this->Mupload->get_all();
		$data['roles'] 	        = $this->model_pengguna->getRole();
		$kode_unik = base_convert(microtime(false), 10, 36);
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$this->form_validation->set_rules('nama', 'Nama Pengguna', 'required|max_length[50]');
			$this->form_validation->set_rules('email', 'Email Pengguna', 'required|max_length[50]|valid_email|is_unique[mst_pengguna.email]');
			$this->form_validation->set_rules('katasandi', 'Kata Sandi', 'required|min_length[4]|max_length[50]');
			if ($this->form_validation->run() == FALSE) {
			} else {
				$data_create = array('nama' 			=> $this->input->post('nama'), 'email' 		=> $this->input->post('email'), 'katasandi' 	=> md5($this->input->post('katasandi')), 'company_id' 	=> $company_id,
				'koderahasia' 	=> $kode_unik,
				'verifikasi' 	=> 'A',
				'status' 		=> 'A',
				'user_cizacl_role_id_pg' => $this->input->post('wewenang'),
				'id_organisasi' => $this->input->post('id_organisasi'), 'pengurus_id' => $this->input->post('pengurus') 
				);
				$this->db->set('dibuat', 'NOW()', false);
				$this->db->set('terakhir', 'NOW()', false);
				$this->db->insert('mst_pengguna', $data_create);
				
				$insert_id = $this->db->insert_id();
				//mirroring
				$data_create = array(
				'user_profile_pengguna_id' 	=> $insert_id,
				'user_profile_name' 	=> $this->input->post('nama')
				);
				$this->db->insert('user_profiles', $data_create);
				
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect('pengguna');
			}
		}
		$this->template->view_baru('pengguna/tambah_pengguna', $data);
	}
	public function ubah() {
		$kodeunik_crypt 		= $this->uri->segment(3);
		$data['judul'] 		= 'Ubah Pengguna';
		$data['errors'] 	= '';
		$data['organisasi'] 	= $this->Mupload->get_all();
		$data['pengurus'] 	= $this->model_pengguna->GetPengurus();

		$data['pengguna'] 	= $this->model_pengguna->getPengguna($kodeunik_crypt);
		
		$data['roles'] 	        = $this->model_pengguna->getRole();
		
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$pdata = $this->session->userdata('session_data'); //Retrive ur session
        $ORGID = $pdata['ses_organisasi_id2'];
        
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			$origin_email 	= $data['pengguna']['email'];
			$is_unique 		= '';
			if($this->input->post('email')!=$origin_email) $is_unique =  '|is_unique[mst_pengguna.email]';
			$this->form_validation->set_rules('nama', 'Nama Pengguna', 'required|max_length[50]');
			$this->form_validation->set_rules('email', 'Email Pengguna', 'required|max_length[50]|valid_email'.$is_unique);
			if ($this->form_validation->run() == FALSE) {
			} else {
				$data_update = array('nama' => $this->input->post('nama'),  
				'user_cizacl_role_id_pg' => $this->input->post('wewenang'), 'id_organisasi' => $this->input->post('id_organisasi') , 'email' => $this->input->post('email') , 'pengurus_id' => $this->input->post('pengurus') );
				if($this->input->post('katasandi')!="") {
					$katasandi = $this->input->post('katasandi');
					$kategori = $this->input->post('kategori');
					$katasandi = md5($katasandi);
					$this->db->set('katasandi', $katasandi);
				}
				$where = "  md5(koderahasia) = '$kodeunik_crypt' ";
				$this->db->where($where);
				$this->db->update('mst_pengguna', $data_update);
				$message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect('pengguna');
			}
		}
		$this->template->view_baru('pengguna/ubah_pengguna', $data);
	}
	public function profil() {
		$company_id 		= $this->session->userdata($this->config->item('ses_company_id'));
		$id_pengguna 		= md5($this->session->userdata($this->config->item('ses_id')));
		$data['judul'] 	= 'Profil';
		$data['errors'] = '';
		$data['pengguna'] 	= $this->model_pengguna->getPengguna($id_pengguna);
		$this->template->view_baru('pengguna/profil', $data);
	}
	public function login() {
		$data['url'] 	= '';
		$btnlogin 		= $this->input->post('btnlogin');
		if($btnlogin=="dologin") {
			$your_password 	= $this->input->post('your_password');
			$your_email 	= $this->input->post('your_email');
			$this->db->select('*');
			$this->db->where(array('md5(email) =' => md5($your_email), 'katasandi = ' => md5($your_password)));
			$this->db->from('mst_pengguna');
			$data = $this->db->get();
			
			
			if($data->num_rows() > 0) {
				$user = $data->row_array();
				if($user["verifikasi"]!="A") {
					$message = alert_php2('Akun anda belum diverifikasi.', 'info', '<br/>Klik <a href="'.base_url('kirim_konfirm').'">disini</a> untuk verifikasi.');
					$this->session->set_userdata($this->config->item('ses_message'), $message);
					redirect('login');
				} elseif($user["status"]!="A") {
					$message = alert_php2('Email ini sudah tidak bisa digunakan lagi.', 'info', '');
					$this->session->set_userdata($this->config->item('ses_message'), $message);
					redirect('login');
				} else {
					$this->session->set_userdata($this->config->item('ses_id'), $user["id_pengguna"]);
					$this->session->set_userdata($this->config->item('ses_organisasi_id'), $user["id_organisasi"]);
					$this->session->set_userdata($this->config->item('ses_email'), $user["email"]);
					$this->session->set_userdata($this->config->item('ses_name'), $user["nama"]);
					$this->session->set_userdata($this->config->item('ses_create'), $user["dibuat"]);
					$this->session->set_userdata($this->config->item('ses_last'), $user["terakhir"]);
					$this->session->set_userdata($this->config->item('ses_company_id'), $user["company_id"]);
					$this->session->set_userdata($this->config->item('ses_user_group'), $user["user_cizacl_role_id_pg"]);
					
					
					
					//organisasi			
					$this->db->select('periode_tahun_buku');
					$this->db->where('id =',$user["id_organisasi"]);
					$this->db->from('tbl_organisasi');
					$data = $this->db->get();
					$organisasi = $data->row_array();
					
					$pdata = array(
							'ses_organisasi_id2'  =>  $user["id_organisasi"],
							'ses_tahun_buku'  =>  $organisasi["periode_tahun_buku"],
							'ses_user_id'  =>  $user["id_pengguna"]
						   );  // pass ur data in the array

					$this->session->set_userdata('session_data', $pdata); //Sets the session


					$this->db->set('terakhir', 'NOW()', FALSE);
					$this->db->where('id_pengguna', $user["id_pengguna"]);
					$update = $this->db->update('mst_pengguna');
					redirect('/');
				}
			} else {
				$message = alert_php2('Login gagal.', 'danger', '');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect('login');
			}
		}
		$this->load->view('pengguna/login', $data);
	}
	public function logout() {
	    helper_log("logout", "User Logout");
		$this->session->unset_userdata($this->config->item('ses_id'));
		$this->session->unset_userdata($this->config->item('ses_email'));
		$this->session->unset_userdata($this->config->item('ses_name'));
		$this->session->unset_userdata($this->config->item('ses_create'));
		$this->session->unset_userdata($this->config->item('ses_last'));
		$this->session->unset_userdata($this->config->item('ses_company_id'));
		$this->session->unset_userdata($this->config->item('ses_tahun_buku'));
		$this->session->unset_userdata($this->config->item('ses_organisasi_id'));
		redirect('login');
	}
}
