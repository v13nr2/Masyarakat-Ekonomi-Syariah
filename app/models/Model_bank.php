<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_bank extends CI_Model {

	
	function getBankById($id){
		if(!empty($id)){
			$query = "
			SELECT 
			bank_id as id,
			bank_kode as kode,
			bank_nama as bank,
			gl as gl,
			bank_cabang as cabang,
			tanggal_buka as tanggal_buka,
			aktif as aktif,
			bank_atas_nama as atas_nama, 
			bank_no_rek as no_rek, 
		    biaya_admin as biaya_admin,
			bank_jenis_tabungan as jenis 
			FROM mst_rekening_bank 
			WHERE md5(bank_id)='$id'
			";

			return $this->db->query($query)->result();
		}
	}

	function listBank() {
		$query = "
		SELECT 
		bank_id as id,
		bank_kode as kode,
		bank_cabang as cabang,
		bank_nama as bank,
		biaya_admin as biaya_admin,
		bank_atas_nama as atas_nama, 
		bank_no_rek as no_rek, 
		bank_jenis_tabungan as jenis 
		FROM mst_rekening_bank 
		ORDER BY bank_nama ASC
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

	function hapusBank($id){
		if(!empty($id)){
			$query = "
			DELETE FROM mst_rekening_bank WHERE md5(bank_id)='$id'
			";

			return $this->db->query($query);
		}
	}
	


}

/* End of file Model_bank.php */
/* Location: .//D/xampp/htdocs/FELLOW/akuntansi/app/models/Model_bank.php */