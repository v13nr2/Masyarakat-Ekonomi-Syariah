<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dokumentasi extends CI_Controller
{
    var $limit=10;
	var $offset=10;

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url'));  
		$this->load->library('form_validation');
		$this->load->model("Model_dokumentasi");

    }

	public function index($page=NULL,$offset='',$key=NULL)
	{
        $data['titel']='Daftar Pegawai';  
        
        $data['query'] = $this->Model_dokumentasi->get_all();  
        
        $this->template->view_baru('dokumentasi/daftar',$data); 
	}
    public function add() {
	    
        $data['titel']='Daftar Dokumentasi'; 
        $this->template->view_baru('dokumentasi/fupload',$data);
       
    }
	public function getComboKab(){
		$id_provinsi = $this->input->post('id');
		$data["provinsi"]= $this->mupload->getComboKab($id_provinsi);
		die(json_encode($data["provinsi"]));
	}
    public function ubah() {
	    $id_peg 				= $this->uri->segment(3);
		$data['organisasi'] 	= $this->Model_dokumentasi->getDok($id_peg);
        $this->template->view_baru('dokumentasi/ubah',$data);
       
    }
	public function update(){
			
			
		$this->load->library('upload');
        $nmfile = "file_".time(); //nama file  
        $config['upload_path'] = './assets/uploads/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '5048'; //maksimum besar file 2M
        $config['max_width']  = '5288'; //lebar maksimum 1288 px
        $config['max_height']  = '1768'; //tinggi maksimu 768 px
        $config['file_name'] = $nmfile;  

        $this->upload->initialize($config);
        
        if($_FILES['filefoto']['name'])
        {
            if ($this->upload->do_upload('filefoto'))
            {
                $gbr = $this->upload->data();
                $data = array(
				  'id' => $this->input->post('id'),
                  'nm_gbr' =>$gbr['file_name'],
                  'tipe_gbr' =>$gbr['file_type'],
                  'nama_modul' =>$this->input->post('nama_modul'),
                  'penjelasan_modul' =>$this->input->post('penjelasan_modul'),
                  'akses_menu' =>$this->input->post('akses_menu'),
                  'level_pengguna' =>$this->input->post('level_pengguna')
			);

                $this->db->where('id',  $this->input->post('id'));
				$this->db->update('tbl_dokumentasi', $data);
                 
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload gambar berhasil !!</div></div>");
                redirect('dokumentasi');  
            }else{
                 
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal upload gambar !!</div></div>");
                redirect('dokumentasi/add');  
            }
        } else {
			$data = array(
				'id' => $this->input->post('id'),
                  'nama_modul' =>$this->input->post('nama_modul'),
                  'penjelasan_modul' =>$this->input->post('penjelasan_modul'),
                  'akses_menu' =>$this->input->post('akses_menu'),
                  'level_pengguna' =>$this->input->post('level_pengguna')
			);
			
				$this->db->where('id',  $this->input->post('id'));
				$this->db->update('tbl_dokumentasi', $data);
                 
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload gambar berhasil !!</div></div>");
                redirect('dokumentasi'); 
			
		}
		
			
			//echo $this->db->last_query();
			redirect('upload');
	}
    public function insert(){
		$this->form_validation->set_rules('nama_modul', 'Nama Modul', 'required|max_length[50]');
		if ($this->form_validation->run() == FALSE) {
			redirect('dokumentasi/add');
		}
        $this->load->library('upload');
        $nmfile = "file_".time(); //nama file  
        $config['upload_path'] = './assets/uploads/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '2048'; //maksimum besar file 2M
        $config['max_width']  = '1288'; //lebar maksimum 1288 px
        $config['max_height']  = '768'; //tinggi maksimu 768 px
        $config['file_name'] = $nmfile;  

        $this->upload->initialize($config);
        
        if($_FILES['filefoto']['name'])
        {
            if ($this->upload->do_upload('filefoto'))
            {
                $gbr = $this->upload->data();
                $data = array(
                  'nm_gbr' =>$gbr['file_name'],
                  'tipe_gbr' =>$gbr['file_type'],
                  'nama_modul' =>$this->input->post('nama_modul'),
                  'penjelasan_modul' =>$this->input->post('penjelasan_modul'),
                  'akses_menu' =>$this->input->post('akses_menu'),
                  'level_pengguna' =>$this->input->post('level_pengguna')
			
                  
                );

                $this->Model_dokumentasi->get_insert($data);  
                 
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload gambar berhasil !!</div></div>");
                redirect('dokumentasi');  
            }else{
                 
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal upload gambar !!</div></div>");
                redirect('dokumentasi/add');  
            }
        }else{
				$data = array(
                  'nama_modul' =>$this->input->post('nama_modul'),
                  'penjelasan_modul' =>$this->input->post('penjelasan_modul'),
                  'akses_menu' =>$this->input->post('akses_menu'),
                  'level_pengguna' =>$this->input->post('level_pengguna')
			
                  
                );

                $this->Model_dokumentasi->get_insert($data);  
                 
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Data Berhasil Disimpan !!</div></div>");
                redirect('dokumentasi');
		}
    }
}

/* End of file upload.php */
/* Location: ./application/controllers/upload.php */