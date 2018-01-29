<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_proyek extends CI_Model {

	
	function getProyekById($id){
		if(!empty($id)){
			$query = "
			SELECT 
			*
			FROM tbl_proyek
			WHERE md5(id)='$id'
			";

			return $this->db->query($query)->result();
		}
	}
	
	
	function listProyek() {
		$query = "
		SELECT A.*,B.no_program FROM tbl_proyek A
		LEFT JOIN tbl_program B 
		ON A.id_program = B.id_program
		";

		return $this->db->query($query)->result();
	}

	
	function listProyekByID($id) {
		$query = "
		SELECT A.*,B.no_program FROM tbl_proyek A
		LEFT JOIN tbl_program B 
		ON A.id_program = B.id_program
		WHERE md5(id) = '$id'
		";
		//echo $this->db->last_query();
		return $this->db->query($query)->result();
	}

	function listProgram() {
		$query = "
		SELECT * FROM tbl_program
		
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

	function hapusProyek($id){
		if(!empty($id)){
			$query = "
			DELETE FROM tbl_proyek WHERE md5(id)='$id'
			";

			return $this->db->query($query);
		}
	}
	


}

/* End of file Model_bank.php */
/* Location: .//D/xampp/htdocs/FELLOW/akuntansi/app/models/Model_bank.php */