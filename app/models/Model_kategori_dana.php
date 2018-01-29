<?php defined('BASEPATH') OR exit('No direct script access allowed');
/** * */
class Model_kategori_dana extends CI_Model {
	function listkategori_dana() {
		$this->db->select('*');
		$this->db->from('tbl_kategori_dana');
		return $this->db->get();
	}
	
	function getkategori_dana($id) {
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$this->db->select('A.*');
		$where = "md5(id) = '$id'";
		$this->db->where($where);
		$this->db->from('tbl_kategori_dana A');
		return $this->db->get()->row_array();
	}
	function listkategori_4() {
		$query = "
		SELECT 
			*
		FROM 
			mst_akun
		WHERE
		    kode_akun LIKE '4%'
		ORDER BY kode_akun
		";

		return $this->db->query($query)->result();
	}
	function listkategori(){
		$query = "
		SELECT 
			*
		FROM 
			tbl_kategori_dana
		";

		return $this->db->query($query)->result();
	}
	function listjenis() {
		$query = "
		SELECT 
			*
		FROM 
			tbl_penyaluran_dana_jenis
		";

		return $this->db->query($query)->result();

	}
	function listkategori_5() {
		$query = "
		SELECT 
			*
		FROM 
			mst_akun
		WHERE
		    kode_akun LIKE '5%'
		ORDER BY kode_akun
		";

		return $this->db->query($query)->result();
	}
}