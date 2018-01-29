<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_memorial extends CI_Model {
	
	public function saveHeader($data){
		$this->db->insert('trs_jurnal',$data);
        $insert_id = $this->db->insert_id();

		return  $insert_id;
	}
	

	public function save($data){
		$this->db->insert('trs_jurnal_detail',$data);
        return $this->db->affected_rows();
	}
	
	
	function cekTutupBuku() {
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$this->db->select('tahun');
		$this->db->from('organisasi');
		$where = " id = 1";
		$this->db->where($where);
		$data = $this->db->get()->row_array();
		return $data["tahun"];
	}
	
}
