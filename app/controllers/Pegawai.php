<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    var $limit=10;
	var $offset=10;

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url'));  
		$this->load->library('form_validation');
		$this->load->model("Model_pegawai");
		$this->load->model("Model_karyawan_keu");

    }

	public function index($page=NULL,$offset='',$key=NULL)
	{
        $data['titel']='Daftar Pegawai';  
        
        $data['query'] = $this->Model_pegawai->get_all();  
        
        $this->template->view_baru('pegawai/pegawai_daftar',$data); 
	}
    public function add() {
	    
        $data['titel']='Daftar Pegawai'; 
        $id_peg = 0;
        $data['keu']  = $this->Model_karyawan_keu->listKeu();
        $data['keudetail']  = $this->Model_karyawan_keu->listKeudetail($id_peg);
        $this->template->view_baru('pegawai/fupload',$data);
       
    }
	public function getComboKab(){
		$id_provinsi = $this->input->post('id');
		$data["provinsi"]= $this->mupload->getComboKab($id_provinsi);
		die(json_encode($data["provinsi"]));
	}
    public function ubah() {
	    $id_peg 				= $this->uri->segment(3);
		$data['organisasi'] 	= $this->Model_pegawai->getPegawai($id_peg);
		$data['keu'] 	= $this->Model_karyawan_keu->listKeu();
		$data['keudetail'] 	= $this->Model_karyawan_keu->listKeudetail($id_peg);
        $this->template->view_baru('pegawai/pegawai_ubah',$data);
       
    }
	public function update(){
			
			
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
				  'id' => $this->input->post('id'),
                  'nm_gbr' =>$gbr['file_name'],
                  'tipe_gbr' =>$gbr['file_type'],
                  'nama_pegawai' =>$this->input->post('nama_pegawai'),
                  'alamat' =>$this->input->post('alamat'),
                  'hp' =>$this->input->post('hp'),
                  'email' =>$this->input->post('email'),
                  'npwp' =>$this->input->post('npwp'),
                  'nip' =>$this->input->post('nip'),
                  'no_ktp' =>$this->input->post('no_ktp'),
                  'no_rekening' =>$this->input->post('no_rekening'),
                  'total_gaji' =>$this->input->post('total_gaji'),
                  'total_tunjangan' =>$this->input->post('total_tunjangan'),
                  'jabatan' =>$this->input->post('jabatan')
			);

                $this->db->where('id',  $this->input->post('id'));
				        $this->db->update('tbl_pegawai', $data);
                 
                
                //replace into
                
                //replace into
                $id = $_POST['parameter'];
                $banyaknya = count($id);
                for ($i=0; $i<$banyaknya; $i++) {
                  $postName = 'parameterV_'.$id[$i];
                  $this->Model_karyawan_keu->insertReplace($this->input->post('id'), $id[$i], $_POST[$postName]);
                  //echo $id[$i]."<br>";
                }
                
                  
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload gambar berhasil !!</div></div>");
                redirect('pegawai');  
            }else{
                 
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal upload gambar !!</div></div>");
                redirect('upload/add');  
            }
        } else {
			$data = array(
				'id' => $this->input->post('id'),
				'nama_pegawai' =>$this->input->post('nama_pegawai'),
                  'alamat' =>$this->input->post('alamat'),
                  'hp' =>$this->input->post('hp'),
                  'email' =>$this->input->post('email'),
                  'npwp' =>$this->input->post('npwp'),
                  'nip' =>$this->input->post('nip'),
                  'no_ktp' =>$this->input->post('no_ktp'),
                  'no_rekening' =>$this->input->post('no_rekening'),
                  'total_gaji' =>$this->input->post('total_gaji'),
                  'total_tunjangan' =>$this->input->post('total_tunjangan'),
                  'jabatan' =>$this->input->post('jabatan')
			);
			
				$this->db->where('id',  $this->input->post('id'));
				$this->db->update('tbl_pegawai', $data);
                
                
                //replace into
                
                //replace into
                $id = $_POST['parameter'];
                $banyaknya = count($id);
                for ($i=0; $i<$banyaknya; $i++) {
                  $postName = 'parameterV_'.$id[$i];
                  $this->Model_karyawan_keu->insertReplace($this->input->post('id'), $id[$i], $_POST[$postName]);
                  //echo $id[$i]."<br>";
                }
                
               
                 
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload gambar berhasil !!</div></div>");
                redirect('pegawai'); 
			
		}
		
			
			//echo $this->db->last_query();
			redirect('upload');
	}
    public function insert(){
		$this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required|max_length[50]');
		if ($this->form_validation->run() == FALSE) {
			redirect('pegawai/add');
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
                  'nama_pegawai' =>$this->input->post('nama_pegawai'),
                  'alamat' =>$this->input->post('alamat'),
                  'hp' =>$this->input->post('hp'),
                  'email' =>$this->input->post('email'),
                  'npwp' =>$this->input->post('npwp'),
                  'nip' =>$this->input->post('nip'),
                  'no_ktp' =>$this->input->post('no_ktp'),
                  'no_rekening' =>$this->input->post('no_rekening'),
                  'total_gaji' =>$this->input->post('total_gaji'),
                  'total_tunjangan' =>$this->input->post('total_tunjangan'),
                  'jabatan' =>$this->input->post('jabatan')
			
                  
                );

                $this->Model_pegawai->get_insert($data);  
                 
                 $idpeg = $this->db->insert_id();

                //replace into
                
                //replace into
                $id = $_POST['parameter'];
                $banyaknya = count($id);
                for ($i=0; $i<$banyaknya; $i++) {
                  $postName = 'parameterV_'.$id[$i];
                  $this->Model_karyawan_keu->insertReplace($idpeg, $id[$i], $_POST[$postName]);
                  //echo $id[$i]."<br>";
                }
                
                
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload gambar berhasil !!</div></div>");
                redirect('pegawai');  
            }else{
                 
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal upload gambar !!</div></div>");
                redirect('pegawai/add');  
            }
        }else{
				$data = array(
                  'nama_pegawai' =>$this->input->post('nama_pegawai'),
                  'alamat' =>$this->input->post('alamat'),
                  'hp' =>$this->input->post('hp'),
                  'email' =>$this->input->post('email'),
                  'npwp' =>$this->input->post('npwp'),
                  'nip' =>$this->input->post('nip'),
                  'no_ktp' =>$this->input->post('no_ktp'),
                  'no_rekening' =>$this->input->post('no_rekening'),
                  'total_gaji' =>$this->input->post('total_gaji'),
                  'total_tunjangan' =>$this->input->post('total_tunjangan'),
                  'jabatan' =>$this->input->post('jabatan')
			
                  
                );

                $this->Model_pegawai->get_insert($data);  
                 $idpeg = $this->db->insert_id();

                //replace into
                
                //replace into
                $id = $_POST['parameter'];
                $banyaknya = count($id);
                for ($i=0; $i<$banyaknya; $i++) {
                  $postName = 'parameterV_'.$id[$i];
                  $this->Model_karyawan_keu->insertReplace($idpeg, $id[$i], $_POST[$postName]);
                  //echo $id[$i]."<br>";
                }
                
               

                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Data Berhasil Disimpan !!</div></div>");
                redirect('pegawai');
		}
    }
}

/* End of file upload.php */
/* Location: ./application/controllers/upload.php */