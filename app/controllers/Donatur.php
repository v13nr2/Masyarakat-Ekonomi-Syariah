<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Donatur extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('model_donatur');
		$this->load->model('model_tipepenyedia');
		$this->load->library('form_validation');
	}
	public function index() {
		$data['judul'] 		= 'Daftar Donatur';
		$data['donatur'] 	= $this->model_donatur->listdonatur()->result();
		$this->template->view_baru('donatur/daftar_donatur', $data);
	}
	public function tambah() {
		$this->load->library('upload');
		$data['judul'] 		= 'Tambah Donatur';
		$data['errors'] 	= '';
		$data['tipepenyedia'] 	= $this->model_tipepenyedia->list_tipepenyedia()->result();
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$kode_unik = base_convert(microtime(false), 10, 36);
		$btnSimpan = $this->input->post('btnSimpan');
		if($btnSimpan=="simpan") {
			if($_FILES['filefoto']['name'])
			{
					//die('hiih');
				if ($this->upload->do_upload('filefoto'))
				{
					$gbr = $this->upload->data();
					$data = array(
					  'nm_gbr' =>$gbr['file_name'],
					  'tipe_gbr' =>$gbr['file_type'],
					  'nama' =>$this->input->post('nama'),
					  'alamat' =>$this->input->post('alamat'),
					  'hp' =>$this->input->post('hp'),
					  'id_kategori_penyedia_dana' => $this->input->post('tipe'),
					  'email' =>$this->input->post('email'),
					  'npwp' =>$this->input->post('npwp'),
					  'norek' =>$this->input->post('norek')
					);

					$this->db->insert('tbl_donatur', $data);
					 
					$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload gambar berhasil !!</div></div>");
					redirect('donatur');  
				}else{
					 
					$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal upload gambar !!</div></div>");
					redirect('donatur/tambah');  
				}
			} else {
				$data = array(
					  'nama' =>$this->input->post('nama'),
					  'alamat' =>$this->input->post('alamat'),
					  'hp' =>$this->input->post('hp'),
					  'id_kategori_penyedia_dana' => $this->input->post('tipe'),
					  'email' =>$this->input->post('email'),
					  'npwp' =>$this->input->post('npwp'),
					  'norek' =>$this->input->post('norek')
				);
					$this->db->insert('tbl_donatur', $data);
					 
					$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload gambar berhasil !!</div></div>");
					redirect('donatur'); 
				
			}
			
		}
		$this->template->view_baru('donatur/tambah_donatur', $data);
	}
	
	public function ubah() {
	    $id_donatur 		= $this->uri->segment(3);
		$data['judul'] 		= 'Ubah Donatur';
		$data['errors'] 	= '';
		$data['penyedia'] 		= $this->model_tipepenyedia->get_tipe_by_id($id_donatur)->row_array();
		$data['donatur'] 	= $this->model_donatur->getDonatur($id_donatur);
		$data['tipepenyedia'] 	= $this->model_tipepenyedia->list_tipepenyedia()->result();
        $this->template->view_baru('donatur/ubah_donatur',$data);
       
    }
	public function update(){
			
			
		$this->load->library('upload');
        $nmfile = "file_".time(); //nama file  
        $config['upload_path'] = './assets/uploads/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '6048'; //maksimum besar file 2M
        $config['max_width']  = '1288'; //lebar maksimum 1288 px
        $config['max_height']  = '768'; //tinggi maksimu 768 px
        $config['file_name'] = $nmfile;  

        $this->upload->initialize($config);
        
        if($_FILES['filefoto']['name'])
        {
				//die('hiih');
            if ($this->upload->do_upload('filefoto'))
            {
                $gbr = $this->upload->data();
                $data = array(
				  'id' => $this->input->post('id'),
                  'nm_gbr' =>$gbr['file_name'],
                  'tipe_gbr' =>$gbr['file_type'],
                  'nama' =>$this->input->post('nama'),
                  'alamat' =>$this->input->post('alamat'),
                  'hp' =>$this->input->post('hp'),
				  'id_kategori_penyedia_dana' => $this->input->post('tipe'),
                  'email' =>$this->input->post('email'),
                  'npwp' =>$this->input->post('npwp'),
                  'norek' =>$this->input->post('norek')
			);

                $this->db->where('id',  $this->input->post('id'));
				$this->db->update('tbl_donatur', $data);
                 
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload gambar berhasil !!</div></div>");
                redirect('donatur');  
            }else{
                 
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal upload gambar !!</div></div>");
                redirect('donatur/add');  
            }
        } else {
			$data = array(
				'id' => $this->input->post('id'),
                  'nama' =>$this->input->post('nama'),
                  'alamat' =>$this->input->post('alamat'),
                  'hp' =>$this->input->post('hp'),
				  'id_kategori_penyedia_dana' => $this->input->post('tipe'),
                  'email' =>$this->input->post('email'),
                  'npwp' =>$this->input->post('npwp'),
                  'norek' =>$this->input->post('norek')
			);
				$this->db->where('id',  $this->input->post('id'));
				$this->db->update('tbl_donatur', $data);
                 
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload gambar berhasil !!</div></div>");
                redirect('donatur'); 
			
		}
		
			
			//echo $this->db->last_query();
			redirect('donatur');
	}

		
	
}
