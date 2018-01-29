<?php defined('BASEPATH') OR exit('No direct script access allowed');
/** * */
class Model_tipeakun extends CI_Model {
	function list_tipeakun() {
		$this->db->select('*');
		$this->db->order_by('mst_tipeakun.kode_tipe_akun', 'ASC');
		$this->db->from('mst_tipeakun');
		return $this->db->get();
		/*$barang = $this->db->get('mst_tipeakun'); return $barang;*/
	}
	function list_indukakun() {
		$this->db->select('*');
		//$this->db->order_by('mst_tipeakun.kode_tipe_akun', 'ASC');
		$this->db->from('mst_akun');
		return $this->db->get();
		/*$barang = $this->db->get('mst_tipeakun'); return $barang;*/
	}
	function get_kode_tipe_akun($id_tipe_akun) {
		$this->db->select('kode_tipe_akun');
		$this->db->where(array('id_tipe_akun =' => $id_tipe_akun));
		$this->db->from('mst_tipeakun');
		$kode_tipe_akun = $this->db->get();
		return $kode_tipe_akun;
	}
	function get_tipe_akun_id($id_tipe_akun) {
		return $this->db->get_where('mst_tipeakun', array('id_tipe_akun' => $id_tipe_akun));
	}
}
?>
