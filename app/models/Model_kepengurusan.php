<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kepengurusan extends CI_Model {

	
	function getDeptById($id){
		if(!empty($id)){
			$query = "
			SELECT 
			*
			FROM mst_kepengurusan
			WHERE md5(id)='$id'
			";

			return $this->db->query($query)->result();
		}
	}

	function listKepengurusan() {
		$query = "
		SELECT * FROM mst_kepengurusan
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
			DELETE FROM mst_kepengurusan WHERE md5(id)='$id'
			";

			return $this->db->query($query);
		}
	}
	


}

/* End of file Model_bank.php */
/* Location: .//D/xampp/htdocs/FELLOW/akuntansi/app/models/Model_bank.php */