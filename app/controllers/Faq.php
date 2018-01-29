<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

  function __construct() {
      parent::__construct();
  		$this->load->model('model_laporan');
  }

  function index() {
    $data['judul'] 		= "List FAQ";
		$this->template->view_baru('faq/list_faq_view', $data);
	}

}
