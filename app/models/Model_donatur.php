<?php defined('BASEPATH') OR exit('No direct script access allowed');
/** * */
class Model_donatur extends CI_Model {
	function listdonatur() {
		return $this->db->query('SELECT A.*, B.kategori_penyedia FROM tbl_donatur A LEFT JOIN tbl_kategori_penyedia_dana B ON A.id_kategori_penyedia_dana = B.id');
		//return $this->db->get();
	}
	
	function getDonatur($id_donatur) {
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$this->db->select('*');
		$where = "md5(id) = '$id_donatur'";
		$this->db->where($where);
		$this->db->from('tbl_donatur');
		return $this->db->get()->row_array();
	}
	function list_pemasok() {
			$query = "
		SELECT 
		*
		FROM tbl_penyedia
		";

		return $this->db->query($query)->result();
	}
	function list_penyedia() {
			$query = "
		SELECT 
		*
		FROM tbl_donatur
		";

		return $this->db->query($query)->result();
	}
}