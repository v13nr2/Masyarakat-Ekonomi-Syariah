<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kabupaten extends CI_Model {

	function getKabupatenById($id){
		if(!empty($id)){
			$query = "
			SELECT 
			kabupaten_id as id,
			kabupaten_prov_id as provinsi_id,
			kabupaten_nama as kabupaten,
			kabupaten_kode as kode,
			prov_nama as provinsi
			FROM ref_kabupaten LEFT JOIN ref_provinsi 
			ON kabupaten_prov_id=prov_id 
			WHERE md5(kabupaten_id)='$id'
			";

			return $this->db->query($query)->result();
		}
	}

	function listKabupaten() {
		$query = "
		SELECT 
		kabupaten_id as id,
		kabupaten_nama as kabupaten,
		kabupaten_kode as kode,
		prov_nama as provinsi
		FROM ref_kabupaten LEFT JOIN ref_provinsi 
		ON kabupaten_prov_id=prov_id 
		ORDER BY prov_nama,kabupaten_nama ASC
		";

		return $this->db->query($query)->result();
	}

	function hapusKabupaten($id){
		if(!empty($id)){
			$query = "
				DELETE FROM ref_kabupaten WHERE md5(kabupaten_id)='$id'
			";

			return $this->db->query($query);
		}
	}

}

/* End of file Model_kabupaten.php */
/* Location: .//D/xampp/htdocs/FELLOW/akuntansi/app/models/Model_kabupaten.php */