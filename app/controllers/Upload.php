<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller
{
  var $limit=10;
  var $offset=10;

  public function __construct() {
    parent::__construct();
    $this->load->model('mupload'); 
    $this->load->helper(array('url','tanggal_helper'));  
    $this->load->library('form_validation');
    $this->load->model("Model_kabupaten");
    $this->load->model("Model_provinsi");

  }

  public function index($page=NULL,$offset='',$key=NULL)
  {
    $data['titel']='Upload CodeIgniter';  
    
    $data['query'] = $this->mupload->get_allimage();  
    
    $this->template->view_baru('organisasi/organisasi_daftar',$data); 
  }
  public function add() {
   
    $data['titel']='Form Upload CodeIgniter'; 
    $data["provinsi"]= $this->Model_provinsi->getComboProv();
    $data["organisasi"]= $this->mupload->get_all();
    $this->template->view_baru('organisasi/fupload',$data);
    
  }
  public function getComboKab(){
    $id_provinsi = $this->input->post('id');
    $data["provinsi"]= $this->mupload->getComboKab($id_provinsi);
    die(json_encode($data["provinsi"]));
  }
  public function ubah() {
   $id_org 		= $this->uri->segment(3);
   $data['organisasi'] 	= $this->mupload->getOrg($id_org);
   $data["provinsi"]= $this->Model_provinsi->getComboProv();
   $data["jenjang"]= $this->mupload->getJenjang();
   $data["prop"]= $this->mupload->getComboPropSelected($id_org);
   $data["kabupaten"]= $this->mupload->getComboKab($data["prop"]["id_provinsi"]);
   $data["kab"]= $this->mupload->getComboKabSelected($id_org);
   $data["jenjang_id"]= $this->mupload->getComboJenjangSelected($id_org);
   $data["org"]= $this->mupload->getComboIndukSelected($id_org);
   $data["level"]= $this->mupload->getComboLevelSelected($id_org);
   $data["organisasiCB"]= $this->mupload->get_all();
   $this->template->view_baru('organisasi/ubah',$data);
   
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
              'nama_organisasi' =>$this->input->post('nama_organisasi'),
              'alamat' =>$this->input->post('alamat'),
              'hp' =>$this->input->post('hp'),
              'email' =>$this->input->post('email'),
              'npwp' =>$this->input->post('npwp'),
              'no_wa' =>$this->input->post('no_wa'),
              'summary_organisasi' =>$this->input->post('summary_organisasi'),
              'nama_pimpinan' =>$this->input->post('nama_pimpinan'),
              'id_provinsi' =>$this->input->post('id_provinsi'),
              'id_kabupaten' =>$this->input->post('id_kabupaten'),
              'pimpinan_harian' =>$this->input->post('pimpinan_harian'),
              'periode_tahun_buku' =>$this->input->post('periode_tahun_buku'),
              'level_organisasi' =>$this->input->post('level_organisasi'),
              'jenjang' =>$this->input->post('jenjang'),
              'induk_organisasi' =>$this->input->post('induk_organisasi'),
              'coa_kas_induk' =>$this->input->post('coa_kas_induk'),
              'coa_bank_induk' =>$this->input->post('coa_bank_induk'),
              'coa_piutang_induk' =>$this->input->post('coa_piutang_induk'),
              'coa_utang_induk' =>$this->input->post('coa_utang_induk')
              );

            $this->db->where('id',  $this->input->post('id'));
            $this->db->update('tbl_organisasi', $data);
            
            $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload gambar berhasil !!</div></div>");
            redirect('upload/ubah/'.md5($this->input->post('id')));  
          }else{
           
            $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal upload gambar !!</div></div>");
            redirect('upload/ubah/'.md5($this->input->post('id')));  
          }
        } else {
         $data = array(
          'id' => $this->input->post('id'),
          'nama_organisasi' =>$this->input->post('nama_organisasi'),
          'alamat' =>$this->input->post('alamat'),
          'hp' =>$this->input->post('hp'),
          'email' =>$this->input->post('email'),
          'npwp' =>$this->input->post('npwp'),
          'no_wa' =>$this->input->post('no_wa'),
          'summary_organisasi' =>$this->input->post('summary_organisasi'),
          'nama_pimpinan' =>$this->input->post('nama_pimpinan'),
          'id_provinsi' =>$this->input->post('id_provinsi'),
          'id_kabupaten' =>$this->input->post('id_kabupaten'),
              'jenjang' =>$this->input->post('jenjang'),
          'pimpinan_harian' =>$this->input->post('pimpinan_harian'),
          'level_organisasi' =>$this->input->post('level_organisasi'),
          'periode_tahun_buku' =>$this->input->post('periode_tahun_buku'),
          'induk_organisasi' =>$this->input->post('induk_organisasi'),
          'coa_kas_induk' =>$this->input->post('coa_kas_induk'),
          'coa_bank_induk' =>$this->input->post('coa_bank_induk'),
          'coa_piutang_induk' =>$this->input->post('coa_piutang_induk'),
          'coa_utang_induk' =>$this->input->post('coa_utang_induk')
          );
         
         $this->db->where('id',  $this->input->post('id'));
         $this->db->update('tbl_organisasi', $data);
         
         $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload gambar berhasil !!</div></div>");
         redirect('upload/ubah/'.md5($this->input->post('id'))); 
         
       }
       
       
			//echo $this->db->last_query();
       redirect('upload');
     }
     public function insert(){
      $this->form_validation->set_rules('nama_organisasi', 'Nama Organisasi', 'required|max_length[50]');
      if ($this->form_validation->run() == FALSE) {
       redirect('upload/add');
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
              'nama_organisasi' =>$this->input->post('nama_organisasi'),
              'alamat' =>$this->input->post('alamat'),
              'hp' =>$this->input->post('hp'),
              'email' =>$this->input->post('email'),
              'npwp' =>$this->input->post('npwp'),
              'no_wa' =>$this->input->post('no_wa'),
              'summary_organisasi' =>$this->input->post('summary_organisasi'),
              'nama_pimpinan' =>$this->input->post('nama_pimpinan'),
              'id_provinsi' =>$this->input->post('id_provinsi'),
              'id_kabupaten' =>$this->input->post('id_kabupaten'),
              'pimpinan_harian' =>$this->input->post('pimpinan_harian'),
              'level_organisasi' =>$this->input->post('level_organisasi'),
              'periode_tahun_buku' =>$this->input->post('periode_tahun_buku'),
              'induk_organisasi' =>$this->input->post('induk_organisasi'),
              'coa_kas_induk' =>$this->input->post('coa_kas_induk'),
              'coa_bank_induk' =>$this->input->post('coa_bank_induk'),
              'coa_piutang_induk' =>$this->input->post('coa_piutang_induk'),
              'coa_utang_induk' =>$this->input->post('coa_utang_induk')
              
              
              );

            $this->mupload->get_insert($data);  
            
            $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload gambar berhasil !!</div></div>");
            redirect('upload');  
          }else{
           
            $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal upload gambar !!</div></div>");
            redirect('upload/add');  
          }
        }else{
          $data = array(
            'nama_organisasi' =>$this->input->post('nama_organisasi'),
            'alamat' =>$this->input->post('alamat'),
            'hp' =>$this->input->post('hp'),
            'email' =>$this->input->post('email'),
            'npwp' =>$this->input->post('npwp'),
            'no_wa' =>$this->input->post('no_wa'),
            'summary_organisasi' =>$this->input->post('summary_organisasi'),
            'nama_pimpinan' =>$this->input->post('nama_pimpinan'),
            'id_provinsi' =>$this->input->post('id_provinsi'),
            'id_kabupaten' =>$this->input->post('id_kabupaten'),
            'pimpinan_harian' =>$this->input->post('pimpinan_harian'),
            'level_organisasi' =>$this->input->post('level_organisasi'),
            'periode_tahun_buku' =>$this->input->post('periode_tahun_buku'),
            'induk_organisasi' =>$this->input->post('induk_organisasi'),
            'coa_kas_induk' =>$this->input->post('coa_kas_induk'),
            'coa_bank_induk' =>$this->input->post('coa_bank_induk'),
            'coa_piutang_induk' =>$this->input->post('coa_piutang_induk'),
            'coa_utang_induk' =>$this->input->post('coa_utang_induk')
            
            
            );

          $this->mupload->get_insert($data);  
          
          $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Data Berhasil Disimpan !!</div></div>");
          redirect('upload');
        }
      }
    }

    /* End of file upload.php */
/* Location: ./application/controllers/upload.php */