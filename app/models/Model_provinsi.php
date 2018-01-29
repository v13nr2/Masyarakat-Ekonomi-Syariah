<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_provinsi extends CI_Model {

	function getProvinsiById($id){
		if(!empty($id)){
			$query = "
			SELECT 
			prov_id as id,
			prov_nama as provinsi,
			prov_kode as kode
			FROM ref_provinsi 
			WHERE md5(prov_id)='$id'
			";

			return $this->db->query($query)->result();
		}
	}

	function listProvinsi() {
		$query = "
		SELECT 
		prov_id as id,
		prov_kode as kode,
		prov_nama as provinsi
		FROM ref_provinsi 
		ORDER BY prov_nama,prov_nama ASC
		";

		return $this->db->query($query)->result();
	}

	public function getComboProv(){
		$query = "
		SELECT 
			prov_id as id,
			prov_nama as provinsi 
		FROM 
			ref_provinsi
		ORDER BY 
			prov_nama ASC
		";

		return $this->db->query($query)->result();
	}	

	function hapusProvinsi($id){
		if(!empty($id)){
			$query = "
				DELETE FROM ref_provinsi WHERE md5(prov_id)='$id'
			";

			return $this->db->query($query);
		}
	}

}

/* End of file Model_provinsi.php */
/* Location: .//D/xampp/htdocs/FELLOW/akuntansi/app/models/Model_provinsi.php */