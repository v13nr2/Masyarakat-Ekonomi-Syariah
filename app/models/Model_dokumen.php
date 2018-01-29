<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dokumen extends CI_Model {

	function getDokumenById($id){
		if(!empty($id)){
			$query = "
			SELECT 
				dokumen_id as id,
				dokumen_nama as dokumen,
				dokumen_keterangan as keterangan,
				dokumen_logo as logo
			FROM mst_dokumen 
			WHERE md5(dokumen_id)='$id'
			";

			return $this->db->query($query)->result();
		}
	}

	function listDokumen() {
		$query = "
		SELECT 
			dokumen_id as id,
			dokumen_keterangan as keterangan,
			dokumen_nama as dokumen,
			dokumen_logo as logo
		FROM mst_dokumen 
		ORDER BY dokumen_nama,dokumen_nama ASC
		";

		return $this->db->query($query)->result();
	}

	public function getComboDokumen(){
		$query = "
		SELECT 
			dokumen_id as id,
			dokumen_nama as dokumen 
		FROM 
		mst_dokumen
		ORDER BY 
		dokumen_nama ASC
		";

		return $this->db->query($query)->result();
	}	

	function hapusDokumen($id){
		if(!empty($id)){
			$query = "
			DELETE FROM mst_dokumen WHERE md5(dokumen_id)='$id'
			";

			return $this->db->query($query);
		}
	}
	

}

/* End of file Model_dokumen.php */
/* Location: .//D/xampp/htdocs/FELLOW/akuntansi/app/models/Model_dokumen.php */