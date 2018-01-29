<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Kegiatan extends CI_Controller {
    
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_kegiatan');
		$this->load->model('Model_bukubesar');
	}

    public function index(){
        $data["judul"] = "Laporan Aktivitas";
        $data['akun'] = $this->model_kegiatan->list_aktivitas4();
        $data['akun5'] = $this->model_kegiatan->list_aktivitas5();
        //echo $this->db->last_query();
        //die();
        
        $data['akunAsetNetto'] = $this->model_kegiatan->list_asetnetto();
        
       $data['aktiva'] = $this->Model_bukubesar->list_aktiva_nerc();
        
		$data['pasiva'] = $this->Model_bukubesar->list_23();
        
        $this->template->view_baru('kegiatan/index.php',$data);
    }
}