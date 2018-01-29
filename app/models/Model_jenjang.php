<?php defined('BASEPATH') OR exit('No direct script access allowed');
/** * */
class Model_jenjang extends CI_Model {
	function list_jenjang() {
		$query = $this->db->query("SELECT a.id_jenjang,a.nama_jenjang,a.keterangan,a.level,a.aktif
			FROM mst_jenjang a
			LEFT JOIN mst_jenjang c ON c.id_jenjang=a.id_jenjang
			ORDER BY a.kode_jenjang
		");
		return $query->result();
	}
	
	function list_indukakun() {
		$this->db->select('*');
		$this->db->from('mst_jenjang');
		return $this->db->get();
	}
	
	function get_jenjang_by_id($id_jenjang) {
		return $this->db->get_where('mst_jenjang', array('md5(id_jenjang)' => $id_jenjang));
	}
	function get_induk_by_id($id_jenjang) {
		return $this->db->get_where('mst_jenjang', array('id_jenjang' => $id_jenjang));
	}
}
?>
