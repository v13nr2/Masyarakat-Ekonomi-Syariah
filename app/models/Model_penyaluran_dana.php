<?php defined('BASEPATH') OR exit('No direct script access allowed');
/** * */
class Model_penyaluran_dana extends CI_Model {
	function listkategori_dana() {
		$this->db->select('A.*, B.jenis_penyaluran_dana AS nama');
		$this->db->from('tbl_penyaluran_dana A');

		$this->db->join('tbl_penyaluran_dana_jenis B','A.kategori_penyaluran_dana = B.id','left');
		return $this->db->get();
	}
	
	function getkategori_dana($id) {
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$this->db->select('*');
		$where = "md5(id) = '$id'";
		$this->db->where($where);
		$this->db->from('tbl_penyaluran_dana');
		return $this->db->get()->row_array();
	}
}