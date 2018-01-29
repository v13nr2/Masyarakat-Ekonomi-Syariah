<?php defined('BASEPATH') OR exit('No direct script access allowed');
/** * */
class Model_jurnal extends CI_Model {
	function list_jurnal() {
		
		$pdata = $this->session->userdata('session_data'); //Retrive ur session

			$tahun = $pdata['ses_tahun_buku'];
			
		$query = "
		
		SELECT A.no_jurnal, A.no_bukti, A.memo, A.tgl_jurnal,  A.kode_unik,  A.tgl_dibuat,  A.tgl_diubah, B.*, C.nama_akun, C.kode_akun
 FROM trs_jurnal A, trs_jurnal_detail B, mst_akun C 
WHERE A.id_jurnal = B.id_jurnal AND C.id_akun = B.id_akun

		";
			
		    		
		if($this->input->get('tanggal_awal')<> "" && $this->input->get('tanggal_akhir') <>""){
		    
		    $dari	= tgl_en($this->input->get('tanggal_awal'));
		    $sampai 	= tgl_en($this->input->get('tanggal_akhir'));
		    $query .= " AND A.tgl_jurnal BETWEEN '$dari' AND '$sampai' ";
		}
		
		$query .= " ORDER BY tgl_jurnal ASC, no_jurnal ASC, Debet DESC";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	
	function list_jurnal_header() {
		
		$pdata = $this->session->userdata('session_data'); //Retrive ur session

			$tahun = $pdata['ses_tahun_buku'];
			
		$query = "
		SELECT A.no_jurnal, A.no_bukti, A.memo, A.tgl_jurnal,  A.kode_unik,  A.tgl_dibuat,  A.tgl_diubah
             FROM trs_jurnal A WHERE A.no_jurnal <> ''";
            		
		if($this->input->get('tanggal_awal')<> "" && $this->input->get('tanggal_akhir') <>""){
		    
		    $dari	= tgl_en($this->input->get('tanggal_awal'));
		    $sampai 	= tgl_en($this->input->get('tanggal_akhir'));
		    $query .= " AND A.tgl_jurnal BETWEEN '$dari' AND '$sampai' ";
		}		
		if($this->input->get('no_jurnal')<> ""){
		    
		    $query .= " AND A.no_jurnal LIKE  '%".$this->input->get('no_jurnal')."%'";
		}
		
		$query .= " ORDER BY tgl_jurnal ASC";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	
	function list_jurnal_detail($x) {
		
		$pdata = $this->session->userdata('session_data'); //Retrive ur session

			$tahun = $pdata['ses_tahun_buku'];
			
		$query = $this->db->query("
		
		SELECT A.no_jurnal, A.no_bukti, A.memo, A.tgl_jurnal, B.*, C.nama_akun, C.kode_akun
 FROM trs_jurnal A, trs_jurnal_detail B, mst_akun C 
WHERE A.id_jurnal = B.id_jurnal AND C.id_akun = B.id_akun AND C.kode_akun LIKE '$x%' 
ORDER BY tgl_jurnal ASC, no_jurnal ASC
		");
		return $query->result();
	}
	
	function list_jurnal_detailByNomor($x) {
		
		$pdata = $this->session->userdata('session_data'); //Retrive ur session

			$tahun = $pdata['ses_tahun_buku'];
			
		$query = $this->db->query("
		
		SELECT A.no_jurnal, A.no_bukti, A.memo, A.tgl_jurnal, B.*, C.nama_akun, C.kode_akun
 FROM trs_jurnal A, trs_jurnal_detail B, mst_akun C 
WHERE A.id_jurnal = B.id_jurnal AND C.id_akun = B.id_akun AND A.kode_unik = '$x' 
ORDER BY no_jurnal ASC
		");
		return $query->result();
	}
	
	function del_jurnal_detail($x) {
		
	
			
		$query = $this->db->query("
		
		    SELECT A.kode_unik, A.id_jurnal
            FROM trs_jurnal A, trs_jurnal_detail B WHERE  A.id_jurnal = B.id_jurnal 
            AND  A.kode_unik = '$x'
		");
		return $query->row_array();
	}
	
	
	function get_data_header($kode_unik)
	{
		$this->db->select('*');
		$this->db->from('trs_jurnal');
		$this->db->where('kode_unik', $kode_unik);
		//$this->db->where('company_id', $this->session->userdata($this->config->item('ses_company_id')));
		return $this->db->get();
	}
	
	
	function list_jurnal_detailByProyek($x) {
		
		$pdata = $this->session->userdata('session_data'); //Retrive ur session

			$tahun = $pdata['ses_tahun_buku'];
			
		$query = $this->db->query("
		
			SELECT A.proyek, A.no_jurnal, A.no_bukti, A.memo, A.tgl_jurnal, B.*, C.nama_akun, C.kode_akun
 FROM trs_jurnal A, trs_jurnal_detail B, mst_akun C 
WHERE A.id_jurnal = B.id_jurnal AND C.id_akun = B.id_akun AND A.proyek = $x 
ORDER BY no_jurnal DESC, debet DESC
		");
		return $query->result();
	}
	
	function getting_idJurnal($x){
        $this->db->select('id_jurnal');
        $this->db->from('trs_jurnal');
        $this->db->where('kode_unik',$x);
        $reault_array = $this->db->get()->result_array();
        return $reault_array[0]['id_jurnal'];
    }

	
	function get_data_detail($id)
	{
		$this->db->select('*'); $this->db->where('trs_jurnal_detail.id_jurnal', $id);
		$this->db->from('trs_jurnal_detail');
		$this->db->join('mst_akun', 'mst_akun.id_akun = trs_jurnal_detail.id_akun', 'left');
		return $this->db->get();
	}

	
	function list_pasiva() {
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
				WHERE B.kode_akun LIKE CONCAT(A.kode_akun,'%') AND YEAR(B.tanggal)=".$tahun .") AS debet, 
				(
				SELECT SUM(kredit)
				FROM trs_jurnal_detail_v C
				WHERE C.kode_akun LIKE CONCAT(A.kode_akun,'%') AND YEAR(C.tanggal)=".$tahun .") AS kredit
				FROM mst_akun A
				
		LEFT JOIN  trs_jurnal_detail AS Z ON Z.id_akun = A.id_akun
		HAVING A.kode_akun LIKE '2%' OR A.kode_akun LIKE '4%'
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
