<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_export extends CI_Model {

    function list_tipeakun() {
  		$this->db->select('*');
  		$this->db->order_by('mst_tipeakun.kode_tipe_akun', 'ASC');
      $query = $this->db->get('mst_tipeakun');
  		$data = $query->result_array();
  		return $data;
	   }
}
