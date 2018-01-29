<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

  function __construct() {
      parent::__construct();
  		$this->load->model('model_laporan');
  }

  function index() {
    $data['judul'] 		= "List Ticket";
		$this->template->view_baru('ticket/list_ticket_view', $data);
	}

  function submitticket() {
    $data['judul'] 		= "List Ticket";
		$this->template->view_baru('ticket/submit_ticket_view', $data);
  }

  function viewticket() {
    $data['idticket'] = $this->uri->segment(3);
    $this->template->view_baru('ticket/detail_ticket_view', $data);
  }

}
