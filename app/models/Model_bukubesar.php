<?php defined('BASEPATH') OR exit('No direct script access allowed');
/** * */
class Model_bukubesar extends CI_Model {
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
		ORDER BY A.kode_akun
		");
		return $query->result();
	}
	function list_nercob() {
		
		//saldo awal
		$pdata = $this->session->userdata('session_data'); //Retrive ur session

			$tahun = $pdata['ses_tahun_buku'];
			$tahunmin1 = $tahun - 1;
			$bulan = $this->input->get('bulan');
			$tahunquery = $this->input->get('tahun');
			
			$whereB = " AND YEAR(B.tanggal)='$tahun' ";
			$whereC = " AND YEAR(C.tanggal)='$tahun' ";
			
			if($bulan<>"" && $tahunquery <>""){
			    
			    $whereB = " AND YEAR(B.tanggal)= '$tahunquery'";
			    if($bulan!="0"){
			        $whereB .= " AND MONTH(B.tanggal)= '$bulan'";
			    }
			    
			    $whereC = " AND YEAR(C.tanggal)= '$tahunquery'";
			    if($bulan!="0"){
			        $whereC .= " AND MONTH(C.tanggal)= '$bulan'";
			    }
			}
			$SQL = "
		
		SELECT DISTINCT A.kode_akun, A.nama_akun, A.saldo_normal, A.lokasi, A.aktif, A.id_tipe_akun,  
        A.level, 
        
        (SELECT SUM(debet)
        FROM trs_jurnal_detail_v BMIN
        WHERE BMIN.kode_akun LIKE CONCAT(A.kode_akun,'%') AND YEAR(BMIN.tanggal)='$tahun'  AND BMIN.no_bukti = 'SA$tahun') AS debet_min, 
        
        
        (
        SELECT SUM(debet)
        FROM trs_jurnal_detail_v BMIN_coa
        WHERE BMIN_coa.kode_akun LIKE CONCAT(A.kode_akun)  AND YEAR(BMIN_coa.tanggal)='$tahun'  AND BMIN_coa.no_bukti = 'SA$tahun')  AS debet_min_coa,
        
        (SELECT SUM(kredit)
        FROM trs_jurnal_detail_v CMIN
        WHERE CMIN.kode_akun LIKE CONCAT(A.kode_akun,'%') AND YEAR(CMIN.tanggal)='$tahun' AND CMIN.no_bukti = 'SA$tahun') AS kredit_min,
        
        
        (
        SELECT SUM(kredit)
        FROM trs_jurnal_detail_v CMIN_coa
        WHERE CMIN_coa.kode_akun LIKE CONCAT(A.kode_akun)  AND YEAR(CMIN_coa.tanggal)='$tahun'  AND CMIN_coa.no_bukti = 'SA$tahun')  AS kredit_min_coa,
        
        (
        SELECT SUM(debet)
        FROM trs_jurnal_detail_v B
        WHERE B.kode_akun LIKE CONCAT(A.kode_akun,'%') ". $whereB ." AND B.no_bukti NOT LIKE 'SA$tahun')  AS debet, 
        
        (
        SELECT SUM(debet)
        FROM trs_jurnal_detail_v B
        WHERE B.kode_akun LIKE CONCAT(A.kode_akun) ". $whereB .")  AS debet_coa, 
        
        
        (
        SELECT SUM(kredit)
        FROM trs_jurnal_detail_v C
        WHERE C.kode_akun LIKE CONCAT(A.kode_akun,'%') ". $whereC ."  AND C.no_bukti NOT LIKE 'SA$tahun')  AS kredit, 
        
        
        (
        SELECT SUM(kredit)
        FROM trs_jurnal_detail_v C
        WHERE C.kode_akun LIKE CONCAT(A.kode_akun) ". $whereC .")  AS kredit_coa
        
        FROM mst_akun A
        
        
        
        
        LEFT JOIN trs_jurnal_detail AS Z ON Z.id_akun = A.id_akun
        ORDER BY A.kode_akun";
		$query = $this->db->query($SQL);
		return $query->result();
	
	}
	
	
	function list_23() {
		$pdata = $this->session->userdata('session_data'); //Retrive ur session

			$tahun = $pdata['ses_tahun_buku'];
			$tahunmin1 = $tahun - 1;
			$bulan = $this->input->get('bulan');
			$tahunquery = $this->input->get('tahun');
			
			$whereB = " AND YEAR(B.tanggal)='$tahun' ";
			$whereC = " AND YEAR(C.tanggal)='$tahun' ";
			
			if($bulan<>"" && $tahunquery <>""){
			    
			    $whereB = " AND YEAR(B.tanggal)= '$tahunquery'";
			    if($bulan!="0"){
			        $whereB .= " AND MONTH(B.tanggal) <= '$bulan'";
			    }
			    
			    $whereC = " AND YEAR(C.tanggal)= '$tahunquery'";
			    if($bulan!="0"){
			        $whereC .= " AND MONTH(C.tanggal) <='$bulan'";
			    }
			}

			
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
				WHERE B.kode_akun LIKE CONCAT(A.kode_akun,'%') " . $whereB  .") AS debet, 
				(
				SELECT SUM(kredit)
				FROM trs_jurnal_detail_v C
				WHERE C.kode_akun LIKE CONCAT(A.kode_akun,'%') " . $whereC  .") AS kredit,
				
				
				 (
                SELECT SUM(debet)
                FROM trs_jurnal_detail_v B
                WHERE B.kode_akun LIKE CONCAT(A.kode_akun) ". $whereB .")  AS debet_coa,
                
                 (
                SELECT SUM(kredit)
                FROM trs_jurnal_detail_v C
                WHERE C.kode_akun LIKE CONCAT(A.kode_akun) ". $whereC .")  AS kredit_coa
                
                
				FROM mst_akun A
				
		LEFT JOIN  trs_jurnal_detail AS Z ON Z.id_akun = A.id_akun
		HAVING A.kode_akun LIKE '2%' 
		ORDER BY A.kode_akun
		");
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
	
	function list_aktiva_nerc() {
		
		$pdata = $this->session->userdata('session_data'); //Retrive ur session

			$tahun = $pdata['ses_tahun_buku'];
			$tahunmin1 = $tahun - 1;
			$bulan = $this->input->get('bulan');
			$tahunquery = $this->input->get('tahun');
			
			$whereB = " AND YEAR(B.tanggal)='$tahun' ";
			$whereC = " AND YEAR(C.tanggal)='$tahun' ";
			
			if($bulan<>"" && $tahunquery <>""){
			    
			    $whereB = " AND YEAR(B.tanggal)= '$tahunquery'";
			    if($bulan!="0"){
			        $whereB .= " AND MONTH(B.tanggal) <= '$bulan'";
			    }
			    
			    $whereC = " AND YEAR(C.tanggal)= '$tahunquery'";
			    if($bulan!="0"){
			        $whereC .= " AND MONTH(C.tanggal) <= '$bulan'";
			    }
			}

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
				WHERE B.kode_akun LIKE CONCAT(A.kode_akun,'%') ". $whereB .") AS debet, 
				
				(
				SELECT SUM(kredit)
				FROM trs_jurnal_detail_v C
				WHERE C.kode_akun LIKE CONCAT(A.kode_akun,'%')  ". $whereC .") AS kredit,
				
				 (
                SELECT SUM(debet)
                FROM trs_jurnal_detail_v B
                WHERE B.kode_akun LIKE CONCAT(A.kode_akun) ". $whereB .")  AS debet_coa,
                
                 (
                SELECT SUM(kredit)
                FROM trs_jurnal_detail_v C
                WHERE C.kode_akun LIKE CONCAT(A.kode_akun) ". $whereC .")  AS kredit_coa
                
                
				FROM mst_akun A
				
		LEFT JOIN  trs_jurnal_detail AS Z ON Z.id_akun = A.id_akun
		HAVING A.kode_akun LIKE '1%'
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
	
	
	
	
	
	
	function list_aktiva1() {
		$pdata = $this->session->userdata('session_data'); //Retrive ur session

			$tahun = $pdata['ses_tahun_buku'];
			$tahunmin1 = $tahun - 1;
			$bulan = $this->input->get('bulan');
			$tahunquery = $this->input->get('tahun');
			
			$whereB = " AND YEAR(B.tanggal)='$tahun' ";
			$whereC = " AND YEAR(C.tanggal)='$tahun' ";
			
			if($bulan<>"" && $tahunquery <>""){
			    
			    $whereB = " AND YEAR(B.tanggal)= '$tahunquery'";
			    if($bulan!="0"){
			        $whereB .= " AND MONTH(B.tanggal)= '$bulan'";
			    }
			    
			    $whereC = " AND YEAR(C.tanggal)= '$tahunquery'";
			    if($bulan!="0"){
			        $whereC .= " AND MONTH(C.tanggal)= '$bulan'";
			    }
			}
			$SQL = "
		
		SELECT DISTINCT A.kode_akun, A.nama_akun, A.saldo_normal, A.id_parent, A.lokasi, A.aktif, A.id_tipe_akun,  
        A.level, 
        
        (SELECT SUM(debet)
        FROM trs_jurnal_detail_v BMIN
        WHERE BMIN.kode_akun LIKE CONCAT(A.kode_akun,'%') AND YEAR(BMIN.tanggal)='$tahun'  AND BMIN.no_bukti = 'SA$tahun') AS debet_min, 
        
        
        (
        SELECT SUM(debet)
        FROM trs_jurnal_detail_v BMIN_coa
        WHERE BMIN_coa.kode_akun LIKE CONCAT(A.kode_akun)  AND YEAR(BMIN_coa.tanggal)='$tahun'  AND BMIN_coa.no_bukti = 'SA$tahun')  AS debet_min_coa,
        
        (SELECT SUM(kredit)
        FROM trs_jurnal_detail_v CMIN
        WHERE CMIN.kode_akun LIKE CONCAT(A.kode_akun,'%') AND YEAR(CMIN.tanggal)='$tahun' AND CMIN.no_bukti = 'SA$tahun') AS kredit_min,
        
        
        (
        SELECT SUM(kredit)
        FROM trs_jurnal_detail_v CMIN_coa
        WHERE CMIN_coa.kode_akun LIKE CONCAT(A.kode_akun)  AND YEAR(CMIN_coa.tanggal)='$tahun'  AND CMIN_coa.no_bukti = 'SA$tahun')  AS kredit_min_coa,
        
        (
        SELECT SUM(debet)
        FROM trs_jurnal_detail_v B
        WHERE B.kode_akun LIKE CONCAT(A.kode_akun,'%') ". $whereB ." AND B.no_bukti NOT LIKE 'SA$tahun')  AS debet, 
        
        (
        SELECT SUM(debet)
        FROM trs_jurnal_detail_v B
        WHERE B.kode_akun LIKE CONCAT(A.kode_akun) ". $whereB .")  AS debet_coa, 
        
        
        (
        SELECT SUM(kredit)
        FROM trs_jurnal_detail_v C
        WHERE C.kode_akun LIKE CONCAT(A.kode_akun,'%') ". $whereC ." AND C.no_bukti NOT LIKE 'SA$tahun')  AS kredit, 
        
        
        (
        SELECT SUM(kredit)
        FROM trs_jurnal_detail_v C
        WHERE C.kode_akun LIKE CONCAT(A.kode_akun) ". $whereC .")  AS kredit_coa
        
        FROM mst_akun A
        
        
        
        
        LEFT JOIN trs_jurnal_detail AS Z ON Z.id_akun = A.id_akun WHERE A.kode_akun LIKE '1%' 
        ORDER BY A.kode_akun";
		$query = $this->db->query($SQL);
		return $query->result();
	}
	
	
	
}
?>
