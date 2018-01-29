<?php defined('BASEPATH') OR exit('No direct script access allowed');
/** * */
class Model_pengguna extends CI_Model {
	function listPengguna() {
		$tipe 		= $this->getCompanyTipe();
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$this->db->select('A.*, C.*, A.email AS email, X.nama AS pengurus');
		//$pdata = $this->session->userdata('session_data'); //Retrive ur session
        //$ORG = $pdata['ses_organisasi_id2'];
		//$this->db->where('id_organisasi', $ORG);
		$this->db->from('mst_pengguna A');

		$this->db->join('mst_kepengurusan X', 'A.pengurus_id = X.id', 'left');
		$this->db->join('tbl_organisasi B', 'A.id_organisasi = B.id', 'left');
		$this->db->join('cizacl_roles C', 'A.user_cizacl_role_id_pg = C.cizacl_role_id', 'left');
		if($tipe=="Free") return $this->db->limit(0,2)->get(); else return $this->db->get();
	}
	function countPengguna() {
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$this->db->select('count(*) as banyak');
		$this->db->where('company_id', $company_id);
		$this->db->from('mst_pengguna');
		$data = $this->db->get()->row_array();
		return $data["banyak"];
	}
	function getCompanyTipe() {
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$this->db->select('tipe');
		$this->db->where('company_id', $company_id);
		$this->db->from('mst_company');
		$data = $this->db->get()->row_array();
		return $data["tipe"];
	}
	function getRole() {
		$this->db->from('cizacl_roles');
		$this->db->where('cizacl_role_id >', 2);
		$query = $this->db->get();

         
        if ($query->num_rows() > 0) {
            return $query->result();
        }
	}
	function getCompanyID($kode_unik, $email) {
		$this->db->select('company_id');
		$where = "kode_unik = '$kode_unik' and email_anda = '$email' ";
		$this->db->where($where);
		$this->db->from('mst_company');
		$data = $this->db->get()->row_array();
		return $data["company_id"];
	}
	function insertAkunAwal($company_id) {
		$sql 		= "CALL sp_insert_akun_awal('".$company_id."');";
		$this->db->query($sql);
		/*mysqli_next_result($this->db->conn_id);*/
	}
	function getPengguna($kodeunikCrypt) {
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$this->db->select('*');
		$where = " md5(koderahasia) = '$kodeunikCrypt' ";
		$this->db->where($where);
		$this->db->from('mst_pengguna');
		return $this->db->get()->row_array();

	}
	function GetPengurus(){
		$query = "SELECT * FROM mst_kepengurusan";
		return $this->db->query($query)->result();

	}
}
