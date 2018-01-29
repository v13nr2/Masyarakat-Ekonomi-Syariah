<?php defined('BASEPATH') OR exit('No direct script access allowed');
/** * */
class Model_Pinjaman extends CI_Model {
	function listpinjaman() {
		return $this->db->query('SELECT A.*, B.nama_pegawai FROM tbl_pinjaman_pegawai A, tbl_pegawai B WHERE A.id_pegawai = B.id');
		//return $this->db->get();
	}
	
	function getPinjaman($id_pinjaman) {
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$this->db->select('*');
		$where = "md5(id) = '$id_pinjaman'";
		$this->db->where($where);
		$this->db->from('tbl_pinjaman_pegawai');
		return $this->db->get()->row_array();
	}
	
	function getComboPegSelected($id_pinjaman){
		$this->db->select('id_pegawai');
		$where = "md5(id) = '$id_pinjaman'";
		$this->db->where($where);
		$this->db->from('tbl_pinjaman_pegawai');
		return $this->db->get()->row_array();
		//echo $this->db->last_query();
	}
	
    function getComboPeg(){
		
			$query = "
			SELECT 
			id, nama_pegawai
			FROM
			tbl_pegawai
			";

		return $this->db->query($query)->result();
	}
	
}