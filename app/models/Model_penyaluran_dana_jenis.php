<?php defined('BASEPATH') OR exit('No direct script access allowed');
/** * */
class Model_penyaluran_dana_jenis extends CI_Model {
	function listkategori_dana() {
		$this->db->select('*');
		$this->db->from('tbl_penyaluran_dana_jenis');
		return $this->db->get();
	}
	
	function getJenis_dana($id) {
		$this->db->select('*');
		$where = "md5(id) = '$id'";
		$this->db->where($where);
		$this->db->from('tbl_penyaluran_dana_jenis');
		return $this->db->get();
	}
}