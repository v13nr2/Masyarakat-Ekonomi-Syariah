<?php
class Coa extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }

   public function index()
    {
		
    }

	public function getLast(){
		if($this->input->is_ajax_request()){
			$id = $this->input->post('id');
			$this->load->model('coa_model');
			$jumlah_anak = $this->coa_model->getLastCoa($id);
			if($jumlah_anak>0){
				echo "No";
			} else {
				echo "Yes";
			}
		}
	}
	
	public function getCoa(){
		if($this->input->is_ajax_request()){
			$dtL = $this->input->post('term');
			$dt = array();
			$this->load->model('coa_model');
			$dtBrg = $this->coa_model->getLike($dtL);
			foreach($dtBrg as $row){
				$dt[] = array(
					'id' => $row->id_akun,
					'value' => $row->nama_akun,
					'label' => $row->nama_akun . " : " . $row->kode_akun
				);
			}
			echo json_encode($dt);
		}else{
			show_404();
		}
	}
	
}