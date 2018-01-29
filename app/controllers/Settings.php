<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('general');
    $this->load->model('model_settings');
    $this->load->library('form_validation');
  }

  public function index()
  {
     $data['judul'] = 'Database Backup' ;
     $data['errors'] 	= '';
     $this->template->view_baru('settings/general', $data);
  }

  public function email()
  {
     $data['judul'] = 'Email Settings' ;
     $data['errors'] = '';
     $this->template->view_baru('settings/email_settings',$data);
  }
  public function margin()
  {
     $data['judul'] = 'Margin Settings' ;
     $data['errors'] = '';

     $data["margin"] =  $this->model_settings->getSettingById(1);
     $this->template->view_baru('settings/invoice',$data);
  }
  public function kuitansi()
  {
     $data['judul'] = 'Margin Settings' ;
     $data['errors'] = '';
     
     $data["margin"] =  $this->model_settings->getSettingById(1);
     $this->template->view_baru('settings/kuitansi',$data);
  }
  
    public function save_margin_settings(){
        
     
        $data['judul'] = 'Margin Settings' ;
        $data['errors'] = '';
        
        $data = array(
				  'batasatas' => $this->input->post('batasatas'),
				  'batasbawah' => $this->input->post('batasbawah'),
				  'bataskiri' => $this->input->post('bataskiri'),
				  'bataskanan' =>$this->input->post('bataskanan')
			);
		
		$this->db->where('organisasi_id',  1);	
		$this->db->update('tbl_seting_dokumen', $data);
		//echo $this->db->last_query();
		//die();
        $data["margin"] =  $this->model_settings->getSettingById(1);
        $this->template->view_baru('settings/kuitansi',$data);
    }
  
  function kuitansi_to_pdf(){
      
            $data["margin"] =  $this->model_settings->getSettingById(1);
            $data["organisasi"] = $this->model_settings->getOrganisasi(1);
           $this->load->view('cetak/kwitansi',$data);
     //       $this->pdf->load_view('cetak/kwitansi',$data);
        
      //$this->pdf->render();
      //$this->pdf->stream("kwitansi-transaksi.pdf");
    }
    
  function invoice_to_pdf(){
            $data["organisasi"] = $this->model_settings->getOrganisasi(1);
            $data["margin"] =  $this->model_settings->getSettingById(1);
           $this->load->view('cetak/invoice_cetak',$data);
            //$this->pdf->load_view('cetak/invoice_cetak',$data);
        
      //$this->pdf->render();
      //$this->pdf->stream("invoice-transaksi.pdf");
    }
    
  public function save_email_settings()
  {
     $settings = array("email_sent_from_address", "email_sent_from_name", "email_protocol", "email_smtp_host", "email_smtp_port", "email_smtp_user", "email_smtp_pass", "email_smtp_security_type");

      foreach ($settings as $setting) {
          $value = $this->input->post($setting);
          if (!$value) {
              $value = "";
          }
          $this->model_settings->save_setting($setting, $value);
      }

      $test_email_to = $this->input->post("send_test_mail_to");
      if ($test_email_to) {
          $email_config = Array(
              'charset' => 'utf-8',
              'mailtype' => 'html'
          );
          if ($this->input->post("email_protocol") === "smtp") {
              $email_config["protocol"] = "smtp";
              $email_config["smtp_host"] = $this->input->post("email_smtp_host");
              $email_config["smtp_port"] = $this->input->post("email_smtp_port");
              $email_config["smtp_user"] = $this->input->post("email_smtp_user");
              $email_config["smtp_pass"] = $this->input->post("email_smtp_pass");
              $email_config["smtp_crypto"] = $this->input->post("email_smtp_security_type");
          }

          $this->load->library('email', $email_config);
          $this->email->set_newline("\r\n");
          $this->email->from($this->input->post("email_sent_from_address"), $this->input->post("email_sent_from_name"));

          $this->email->to($test_email_to);
          $this->email->subject("Test message");
          $this->email->message("This is a test message to check mail configuration.");

          if ($this->email->send()) {
              echo json_encode(array("success" => true, 'message' => 'test_mail_sent'));
              return false;
          } else {
              echo json_encode(array("success" => false, 'message' => 'test_mail_send_failed'));
              show_error($this->email->print_debugger());
              return false;
          }
      }
      echo json_encode(array("success" => true, 'message' => 'settings_updated'));

  }

}
