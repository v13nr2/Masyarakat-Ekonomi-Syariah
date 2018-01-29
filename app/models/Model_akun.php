<?php defined('BASEPATH') OR exit('No direct script access allowed');
/** * */
class Model_akun extends CI_Model {
	function list_akun() {
		$query = $this->db->query("SELECT a.id_akun,b.nama_tipe_akun,a.kode_akun,a.nama_akun,c.nama_akun as induk_akun,a.saldo_normal,a.lokasi,a.level,a.is_parent,a.aktif
			FROM mst_akun a
			JOIN mst_tipeakun b ON b.id_tipe_akun=a.id_tipe_akun
			LEFT JOIN mst_akun c ON c.id_akun=a.id_parent
			ORDER BY a.id_tipe_akun,a.kode_akun,a.posisi
		");
		return $query->result();
	}
	function list_akun2() {
		$this->db->select('mst_akun.kode_akun, mst_akun.saldo_normal, mst_akun.nama_akun, mst_tipeakun.nama_tipe_akun, mst_akun.lokasi, mst_akun.posisi, mst_akun.tgl_dibuat, mst_akun.tgl_diubah, mst_akun.id_akun, mst_akun.aktif');
		$this->db->from('mst_akun');
		$this->db->where(array('mst_akun.company_id=' => $this->session->userdata($this->config->item('ses_company_id'))));
		$this->db->join('mst_tipeakun', 'mst_akun.id_tipe_akun = mst_tipeakun.id_tipe_akun');
		$this->db->order_by('mst_akun.kode_akun', 'ASC');
		return $this->db->get();
	}
	function list_akun_detail() {
		$this->db->select('mst_akun.kode_akun, mst_akun.saldo_normal, mst_akun.nama_akun, mst_tipeakun.nama_tipe_akun, mst_akun.lokasi, mst_akun.posisi, mst_akun.tgl_dibuat, mst_akun.tgl_diubah, mst_akun.id_akun, mst_akun.aktif');
		$this->db->from('mst_akun');
		//$this->db->where(array('mst_akun.company_id=' => $this->session->userdata($this->config->item('ses_company_id'))));
		$this->db->join('mst_tipeakun', 'mst_akun.id_tipe_akun = mst_tipeakun.id_tipe_akun');
		$this->db->order_by('mst_akun.kode_akun', 'ASC');
		return $this->db->get();
	}
	function list_akun_neraca() {
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$where 		= " mst_akun.company_id = '$company_id' ";
		/*and mst_akun.id_tipe_akun in (1, 2, 3, 4, 5, 6) ";*/
		$this->db->select('mst_akun.kode_akun, mst_akun.saldo_normal, mst_akun.nama_akun, mst_tipeakun.nama_tipe_akun, mst_akun.lokasi, mst_akun.posisi, mst_akun.tgl_dibuat, mst_akun.tgl_diubah, mst_akun.id_akun, mst_akun.aktif');
		$this->db->from('mst_akun');
		$this->db->where($where);
		$this->db->join('mst_tipeakun', 'mst_akun.id_tipe_akun = mst_tipeakun.id_tipe_akun');
		$this->db->order_by('mst_akun.kode_akun', 'ASC');
		return $this->db->get();
	}
	function get_akun_by_id($id_akun) {
		return $this->db->get_where('mst_akun', array('md5(id_akun)' => $id_akun));
	}
	function get_akun_by_id_induk($id_akun) {
		return $this->db->get_where('mst_akun', array('id_akun' => $id_akun));
	}
	function check_kode_akun_insert($kode_akun) {
		$this->db->select('kode_akun');
		$this->db->where(array('kode_akun'=> $kode_akun, 'mst_akun.company_id=' => $this->session->userdata($this->config->item('ses_company_id'))));
		$query = $this->db->get('mst_akun');
		$num = $query->num_rows();
		return $num;
	}
	function check_kode_akun_update($kode_akun, $kode_akun_lama) {
		$this->db->select('kode_akun');
		$this->db->where(array('kode_akun =' => $kode_akun, 'kode_akun <> ' => $kode_akun_lama, 'mst_akun.company_id=' => $this->session->userdata($this->config->item('ses_company_id'))));
		$query = $this->db->get('mst_akun');
		$num = $query->num_rows();
		return $num;
	}
	function get_akun_json() {
		$this->db->select('mst_akun.id_akun, mst_akun.kode_akun, mst_akun.nama_akun, mst_akun.aktif');
		$this->db->from('mst_akun');
		$this->db->where(array('aktif = ' => 'A', 'mst_akun.company_id=' => $this->session->userdata($this->config->item('ses_company_id'))));
		$this->db->order_by('mst_akun.kode_akun', 'ASC');
		$akun = $this->db->get();
		return $akun;
	}
	function get_akun_json2($q) {
		if($q!="") {
			$this->db->select("mst_akun.id_akun as id, CONCAT(mst_akun.kode_akun,' - ',  mst_akun.nama_akun) as text");
			$this->db->from('mst_akun');
			$this->db->like('mst_akun.nama_akun', $q);
			$this->db->where(array('aktif = ' => 'A', 'mst_akun.company_id=' => $this->session->userdata($this->config->item('ses_company_id'))));
			$this->db->order_by('mst_akun.kode_akun', 'ASC');
			$akun = $this->db->get();
			return $akun->result();
		} else {
			return [];
		}
	}
}
?>
