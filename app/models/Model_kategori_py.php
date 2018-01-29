<?php defined('BASEPATH') OR exit('No direct script access allowed');
/** * */
class Model_kategori_py extends CI_Model {
	function list_py() {
		$this->db->select('*');
		$this->db->from('tbl_kategori_penyedia_dana');
		return $this->db->get();
	}
	
	function getKategori($id) {
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$this->db->select('*');
		$where = "md5(id) = '$id'";
		$this->db->where($where);
		$this->db->from('tbl_kategori_penyedia_dana');
		return $this->db->get()->row_array();
	}
}