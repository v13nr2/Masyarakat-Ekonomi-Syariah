<?php defined('BASEPATH') OR exit('No direct script access allowed');
/** * */
class Model_penerimaan_dana extends CI_Model {
	function listkategori_dana() {
		$this->db->select('A.*, B.nama_penyedia AS penyedia, C.kategori_dana');
		$this->db->from('tbl_penerimaan_dana A');
		$this->db->join('tbl_penyedia B', 'A.penyedia_dana_id = B.id', 'left');
		$this->db->join('tbl_kategori_dana C', 'A.jenis_dana = C.id', 'left');
		return $this->db->get();
	}
	
	function getPenerimaan_dana($id) {
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$this->db->select('A.*, B.kategori_dana');
		$where = "md5(A.id) = '$id'";
		$this->db->where($where);
		$this->db->from('tbl_penerimaan_dana A');
		$this->db->join('tbl_kategori_dana B','B.id = A.jenis_dana','left');
		return $this->db->get()->row_array();
	}

	function penyedia(){

		$query = "
		SELECT 
			*
		FROM 
			tbl_penyedia
		";

		return $this->db->query($query)->result();
	}
}