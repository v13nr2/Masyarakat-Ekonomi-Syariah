<?php defined('BASEPATH') OR exit('No direct script access allowed');
/** * */
class Model_bukukas extends CI_Model {
	function list_akun() {
		
		$pdata = $this->session->userdata('session_data'); //Retrive ur session

			$tahun = $pdata['ses_tahun_buku'];
			
		$query = $this->db->query("SELECT DISTINCT A.kode_akun,
				A.nama_akun,
				A.saldo_normal,
				A.lokasi,
				A.aktif,
				A.id_tipe_akun,
				A.level,
				(
				SELECT SUM(debet)
				FROM trs_jurnal_detail_v B
				WHERE B.kode_akun LIKE CONCAT(A.kode_akun,'%') AND YEAR(B.tanggal)=".$tahun .") AS debet, (
				SELECT SUM(kredit)
				FROM trs_jurnal_detail_v C
				WHERE C.kode_akun LIKE CONCAT(A.kode_akun,'%') AND YEAR(C.tanggal)=".$tahun .") AS kredit
				FROM mst_akun A
		LEFT JOIN  trs_jurnal_detail AS Z ON Z.id_akun = A.id_akun 
		 WHERE A.kode_akun LIKE CONCAT((SELECT coa_kas_induk FROM tbl_organisasi WHERE id=1),'%')
		ORDER BY A.kode_akun
		");
		return $query->result();
	}
	
	function list_akun_bank() {
		
		$pdata = $this->session->userdata('session_data'); //Retrive ur session

			$tahun = $pdata['ses_tahun_buku'];
			
		$query = $this->db->query("SELECT DISTINCT A.kode_akun,
				A.nama_akun,
				A.saldo_normal,
				A.lokasi,
				A.aktif,
				A.id_tipe_akun,
				A.level,
				(
				SELECT SUM(debet)
				FROM trs_jurnal_detail_v B
				WHERE B.kode_akun LIKE CONCAT(A.kode_akun,'%') AND YEAR(B.tanggal)=".$tahun .") AS debet, (
				SELECT SUM(kredit)
				FROM trs_jurnal_detail_v C
				WHERE C.kode_akun LIKE CONCAT(A.kode_akun,'%') AND YEAR(C.tanggal)=".$tahun .") AS kredit
				FROM mst_akun A
		LEFT JOIN  trs_jurnal_detail AS Z ON Z.id_akun = A.id_akun 
		 WHERE A.kode_akun LIKE CONCAT((SELECT coa_bank_induk FROM tbl_organisasi WHERE id=1),'%')
		ORDER BY A.kode_akun
		");
		return $query->result();
	}
	
	
	function list_nercob() {
		
		$pdata = $this->session->userdata('session_data'); //Retrive ur session

			$tahun = $pdata['ses_tahun_buku'];
			$tahunmin1 = $tahun - 1;
			$SQL = "
		
		SELECT DISTINCT A.kode_akun, A.nama_akun, A.saldo_normal, A.lokasi, A.aktif, A.id_tipe_akun,  
        A.level, 
        
        (SELECT SUM(debet)
        FROM trs_jurnal_detail_v BMIN
        WHERE BMIN.kode_akun LIKE CONCAT(A.kode_akun,'%') AND YEAR(BMIN.tanggal)='$tahun'  AND BMIN.no_bukti = 'SA$tahun') AS debet_min, 
        
        (SELECT SUM(kredit)
        FROM trs_jurnal_detail_v CMIN
        WHERE CMIN.kode_akun LIKE CONCAT(A.kode_akun,'%') AND YEAR(CMIN.tanggal)='$tahun' AND CMIN.no_bukti = 'SA$tahun') AS kredit_min,
        
        
        
        (
        SELECT SUM(debet)
        FROM trs_jurnal_detail_v B
        WHERE B.kode_akun LIKE CONCAT(A.kode_akun,'%') AND YEAR(B.tanggal)='$tahun'  AND B.no_bukti NOT LIKE 'SA$tahun')  AS debet, 
        
        (
        SELECT SUM(debet)
        FROM trs_jurnal_detail_v B
        WHERE B.kode_akun LIKE CONCAT(A.kode_akun) AND YEAR(B.tanggal)='$tahun')  AS debet_coa, 
        
        
        (
        SELECT SUM(kredit)
        FROM trs_jurnal_detail_v C
        WHERE C.kode_akun LIKE CONCAT(A.kode_akun,'%') AND YEAR(C.tanggal)='$tahun'  AND C.no_bukti NOT LIKE 'SA$tahun')  AS kredit, 
        
        
        (
        SELECT SUM(kredit)
        FROM trs_jurnal_detail_v C
        WHERE C.kode_akun LIKE CONCAT(A.kode_akun) AND YEAR(C.tanggal)='$tahun')  AS kredit_coa
        
        FROM mst_akun A
        
        
        
        
        LEFT JOIN trs_jurnal_detail AS Z ON Z.id_akun = A.id_akun
        ORDER BY A.kode_akun";
		$query = $this->db->query($SQL);
		return $query->result();
	
	}
	function list_pasiva() {
		$pdata = $this->session->userdata('session_data'); //Retrive ur session

			$tahun = $pdata['ses_tahun_buku'];
			
		$query = $this->db->query("SELECT DISTINCT A.kode_akun,
				A.nama_akun,
				A.saldo_normal,
				A.lokasi,
				A.aktif,
				A.id_parent,
				A.id_tipe_akun,
				A.level,
				(
				SELECT SUM(debet)
				FROM trs_jurnal_detail_v B
				WHERE B.kode_akun LIKE CONCAT(A.kode_akun,'%') AND YEAR(B.tanggal)=".$tahun .") AS debet, 
				(
				SELECT SUM(kredit)
				FROM trs_jurnal_detail_v C
				WHERE C.kode_akun LIKE CONCAT(A.kode_akun,'%') AND YEAR(C.tanggal)=".$tahun .") AS kredit
				FROM mst_akun A
				
		LEFT JOIN  trs_jurnal_detail AS Z ON Z.id_akun = A.id_akun
		HAVING A.kode_akun LIKE '2%' OR A.kode_akun LIKE '4%' OR A.kode_akun LIKE '5%'
		ORDER BY A.kode_akun
		");
		return $query->result();
	}
	function list_aktiva() {
		$pdata = $this->session->userdata('session_data'); //Retrive ur session

			$tahun = $pdata['ses_tahun_buku'];
		$query = $this->db->query("SELECT DISTINCT A.kode_akun,
				A.nama_akun,
				A.saldo_normal,
				A.lokasi,
				A.aktif,
				A.id_tipe_akun,
				A.id_parent,
				A.level,
				(
				SELECT SUM(debet)
				FROM trs_jurnal_detail_v B
				WHERE B.kode_akun LIKE CONCAT(A.kode_akun,'%') AND YEAR(B.tanggal)=".$tahun .") AS debet, (
				SELECT SUM(kredit)
				FROM trs_jurnal_detail_v C
				WHERE C.kode_akun LIKE CONCAT(A.kode_akun,'%') AND YEAR(C.tanggal)=".$tahun .") AS kredit
				FROM mst_akun A
				
		LEFT JOIN  trs_jurnal_detail AS Z ON Z.id_akun = A.id_akun
		HAVING A.kode_akun LIKE '1%' OR A.kode_akun LIKE '3%'
		ORDER BY A.kode_akun
		");
		return $query->result();
	}
}
?>
