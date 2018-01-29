<?php defined('BASEPATH') OR exit('No direct script access allowed');
/** * */
class Model_tipepenyedia extends CI_Model {
	function list_tipepenyedia() {
		$this->db->select('*');
		$this->db->order_by('tbl_kategori_penyedia_dana.kategori_penyedia', 'ASC');
		$this->db->from('tbl_kategori_penyedia_dana');
		return $this->db->get();
	}
	function get_tipe_by_id($id_tipe) {
		return $this->db->get_where('tbl_donatur', array('id_kategori_penyedia_dana' => $id_tipe));
	}
}
?>
