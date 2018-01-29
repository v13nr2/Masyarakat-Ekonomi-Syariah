<?php defined('BASEPATH') OR exit('No direct script access allowed');
/** * */
class Model_tutupbuku extends CI_Model {
	function listTutupBuku() {
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$this->db->select('*, trs_tutup_buku_bulanan.status as statusx');
		$this->db->from('trs_tutup_buku_bulanan');
		//$this->db->where('trs_tutup_buku_bulanan.company_id', $company_id);
		//$this->db->where('trs_tutup_buku_bulanan.status', 'A');
		$this->db->join('mst_pengguna', 'mst_pengguna.id_pengguna = trs_tutup_buku_bulanan.yang_buat');
		return $this->db->get();
	}
	function cekTutupBuku($bulan, $tahun) {
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$this->db->select('count(*) as banyak');
		$this->db->from('trs_tutup_buku_bulanan');
		$where = " month(periode_tb_bulanan)='$bulan' and year(periode_tb_bulanan)='$tahun' and company_id = '$company_id' and trs_tutup_buku_bulanan.status = 'A' ";
		$this->db->where($where);
		$data = $this->db->get()->row_array();
		return $data["banyak"];
	}
	function cekRollBack($kode_unik) {
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$sql 	= "select count(*) as banyak FROM trs_tutup_buku_bulanan ";
		$sql 	.= " WHERE periode_tb_bulanan > ";
		$sql 	.= " (SELECT periode_tb_bulanan FROM trs_tutup_buku_bulanan WHERE kode_unik = '$kode_unik' and company_id = '$company_id' and trs_tutup_buku_bulanan.status = 'A') and company_id = '$company_id' and trs_tutup_buku_bulanan.status = 'A' ";
		$cek 	= $this->db->query($sql)->row_array();
		/*mysqli_next_result($this->db->conn_id);*/
		return $cek["banyak"];
	}
	function summarySaldo($periode) {
		$sql 		= "CALL sp_summary_saldo('".$periode."', '".$this->session->userdata($this->config->item('ses_company_id'))."');";
		$this->db->query($sql);
		/*$jurnal 	= $this->db->query($sql); //mysqli_next_result($this->db->conn_id); //return $jurnal;*/
	}
	function summarySaldoCancel($periode) {
		$sql 		= "CALL sp_summary_saldo_cancel('".$periode."', '".$this->session->userdata($this->config->item('ses_company_id'))."');";
		$this->db->query($sql);
		/*$jurnal 	= $this->db->query($sql); mysqli_next_result($this->db->conn_id); return $jurnal;*/
	}
	function getPeriode($kode_unik) {
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$this->db->select('periode_tb_bulanan');
		$this->db->where('kode_unik', $kode_unik);
		$this->db->where('company_id', $company_id);
		$this->db->from('trs_tutup_buku_bulanan');
		$data = $this->db->get()->row_array();
		return $data['periode_tb_bulanan'];
	}
}
