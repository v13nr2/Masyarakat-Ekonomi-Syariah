<?php defined('BASEPATH') OR exit('No direct script access allowed');
/** * */
class Model_laporan extends CI_Model {
	function jurnal_umum($periode) {
		$sql 		= "CALL sp_jurnal_umum('".$periode."', '".$this->session->userdata($this->config->item('ses_company_id'))."');";
		$jurnal 	= $this->db->query($sql);
		mysqli_next_result($this->db->conn_id);
		return $jurnal;
	}
	function neraca($periode) {
		$sql 		= "CALL sp_neraca('".$periode."', '".$this->session->userdata($this->config->item('ses_company_id'))."');";
		$neracasaldo 	= $this->db->query($sql);
		mysqli_next_result($this->db->conn_id);
		return $neracasaldo;
	}
	function bukubesar($periode) {
		$sql 		= "CALL sp_buku_besar('".$periode."', '".$this->session->userdata($this->config->item('ses_company_id'))."');";
		$bukubesar 	= $this->db->query($sql);
		mysqli_next_result($this->db->conn_id);
		return $bukubesar;
	}
	function labarugi($periode) {
		$sql 		= "CALL sp_laba_rugi('".$periode."', '".$this->session->userdata($this->config->item('ses_company_id'))."');";
		$labarugi 	= $this->db->query($sql);
		mysqli_next_result($this->db->conn_id);
		return $labarugi;
	}
	function insert_labarugi($periode) {
		$tmp_bulan 	= substr($periode, 0, 2);
		$tmp_tahun 	= substr($periode, 3, 4);
		$tmp_tgl 	= $tmp_tahun . "-" . $tmp_bulan . "-01";
		$sql 		= "CALL sp_laba_rugi_insert('".$tmp_tgl."', '".$this->session->userdata($this->config->item('ses_company_id'))."');";
		$query 		= $this->db->query($sql);
	}
}
?>
