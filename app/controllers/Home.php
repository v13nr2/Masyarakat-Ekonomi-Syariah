<?php
class Home extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
    	$this->load->model('Dashboard_model'); 
    }

    public function index()
    {
		$data['nilaiaset'] = $this->Dashboard_model->get_total_aset();
		$data['nilaikas'] = $this->Dashboard_model->get_total_kas();
		$data['nilaipiutang'] = $this->Dashboard_model->get_total_piutang();
		$data['nilaiutang'] = $this->Dashboard_model->get_total_utang();
		$data['log'] = $this->Dashboard_model->get_log();
		$data['server'] = $this->Dashboard_model->get_server();

		//$data['audit_trail'] = $this->Dashboard_model->get_audit_trail();
		$data['judul'] 		= 'Dashboard';
		$this->template->view_baru('dashboard/home', $data);
		    	
    }
	
	public function utama(){
		
		$this->load->view('home/home.php');
	}
}