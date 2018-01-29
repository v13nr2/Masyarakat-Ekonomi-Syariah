<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller {

  function __construct() {
      parent::__construct();
      $this->load->model('model_export');

  }

  public function coba() {

      $get_list_tipeakun = $this->model_export->list_tipeakun();

      echo '<pre>';
      // print_r($get_list_tipeakun);

      header('content-type: application/json');
      echo json_encode($get_list_tipeakun);
  }



}
