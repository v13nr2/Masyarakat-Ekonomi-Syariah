<?php
class Model_penyedia extends CI_Model {

    var $tabel = 'tbl_penyedia';

    function __construct() {
        parent::__construct();
    }
    
     
	function get_all() {
        $this->db->from($this->tabel);
		$query = $this->db->get();

         
        if ($query->num_rows() > 0) {
            return $query->result();
        }
	}
     
	function get_allimage() {
        $this->db->from($this->tabel);
		$query = $this->db->get();

         
        if ($query->num_rows() > 0) {
            return $query->result();
        }
	}

    function getComboKab($id_propinsi){
		//if(!empty($id_propinsi)){
			$query = "
			SELECT 
			kabupaten_id, kabupaten_nama
			FROM
			ref_kabupaten
			WHERE kabupaten_prov_id = '$id_propinsi'
			";

			return $this->db->query($query)->result();
		//}
	}
	
	function getComboPropSelected($id_organisasi){
		$this->db->select('id_provinsi');
		$where = "md5(id) = '$id_organisasi'";
		$this->db->where($where);
		$this->db->from('tbl_organisasi');
		return $this->db->get()->row_array();
		echo $this->db->last_query();
	}
	function getComboIndukSelected($id_organisasi){
		$this->db->select('induk_organisasi');
		$where = "md5(id) = '$id_organisasi'";
		$this->db->where($where);
		$this->db->from('tbl_organisasi');
		return $this->db->get()->row_array();
		echo $this->db->last_query();
	}
	function getComboLevelSelected($id_organisasi){
		$this->db->select('level_organisasi');
		$where = "md5(id) = '$id_organisasi'";
		$this->db->where($where);
		$this->db->from('tbl_organisasi');
		return $this->db->get()->row_array();
		echo $this->db->last_query();
	}
	function getComboKabSelected($id_organisasi){
		$this->db->select('id_kabupaten');
		$where = "md5(id) = '$id_organisasi'";
		$this->db->where($where);
		$this->db->from('tbl_organisasi');
		return $this->db->get()->row_array();
		echo $this->db->last_query();
	}
	
	
    function get_insert($data){
       $this->db->insert($this->tabel, $data);
       return TRUE;
    }
	
	function getPenyedia($id) {
		$this->db->select('*');
		$where = "md5(id) = '$id'";
		$this->db->where($where);
		$this->db->from('tbl_penyedia');
		return $this->db->get()->row_array();
	}
}

?>
