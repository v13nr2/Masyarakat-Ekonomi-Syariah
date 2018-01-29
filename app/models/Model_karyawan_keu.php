<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_karyawan_keu extends CI_Model {

	
	function getDeptById($id){
		if(!empty($id)){
			$query = "
			SELECT 
			*
			FROM tbl_pegawai_keu
			WHERE md5(id)='$id'
			";

			return $this->db->query($query)->result();
		}
	}
	
	function listKeudetail($id){
	 
			$query = "
			SELECT 
			*
			FROM tbl_pegawai_keu_detail
			WHERE md5(pegawai_id)='$id'
			ORDER BY param_id ASC
			";

			return $this->db->query($query)->result();
		 
	}
    
    function listKeuParam(){
			$query = "
				SELECT A.*, B.* FROM tbl_pegawai_keu A
				LEFT JOIN tbl_pegawai_keu_detail B ON A.id = B.param_id
				ORDER BY id
			";
			

			return $this->db->query($query)->result();
    }

    
    function listKeuWithID(){
			$query = "
				SELECT A.*, B.*, (SELECT id_akun from mst_akun WHERE kode_akun = A.gl_debet) AS id_akun_debet,
				(SELECT id_akun from mst_akun WHERE kode_akun = A.gl_kredit) AS id_akun_kredit
 				FROM tbl_pegawai_keu A
				LEFT JOIN tbl_pegawai_keu_detail B ON A.id = B.param_id
				LEFT JOIN mst_akun C ON C.kode_akun = A.gl_debet AND C.kode_akun = A.gl_kredit
				
				ORDER BY id
			";
			

			return $this->db->query($query)->result();
    }
    
    function listKeuParamV($id){
			$query = "
				SELECT A.*, B.* FROM tbl_pegawai_keu A
				LEFT JOIN tbl_pegawai_keu_detail B ON A.id = B.param_id
				WHERE md5(pegawai_id)='$id'
				ORDER BY id
			";
			

			return $this->db->query($query)->result();
    }

    function insertReplace($pegawai_id, $param_id, $jumlah){
        $query= "REPLACE INTO tbl_pegawai_keu_detail (pegawai_id, param_id, jumlah) VALUES ($pegawai_id, $param_id, $jumlah)";
        return $this->db->query($query);
    }
    
	function listKeu() {
		$query = "
		SELECT * FROM tbl_pegawai_keu
		";

		return $this->db->query($query)->result();
	}

	function listKaryawan() {
		$query = "
		SELECT * FROM tbl_pegawai
		";

		return $this->db->query($query)->result();
	}

	public function getComboBank(){
		$query = "
		SELECT 
		bank_id as id,
		bank_nama as bank 
		FROM 
		mst_rekening_bank
		ORDER BY 
		bank_nama ASC
		";

		return $this->db->query($query)->result();
	}	

	function hapusParam($id){
		if(!empty($id)){
			$query = "
			DELETE FROM tbl_pegawai_keu WHERE md5(id)='$id'
			";

			return $this->db->query($query);
		}
	}
	
	function cekJurnal($pegawai, $param, $tahun, $bulan){
		//cek field kode_gaji
		$x = $pegawai.'_'.$param.'_'.$tahun.'_'.$bulan;
		$this->db->select('*')->from('trs_jurnal')->where('kode_gaji',$x); 
		$q = $this->db->get(); 
		return $q->num_rows();
	}

}

/* End of file Model_bank.php */
/* Location: .//D/xampp/htdocs/FELLOW/akuntansi/app/models/Model_bank.php */