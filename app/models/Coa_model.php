<?php 
Class Coa_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}



	public function getLastCoa($id){
		$this->db->where('id_parent', $id);
		$num_rows = $this->db->count_all_results('mst_akun');
		return $num_rows;
	}
	
	public function getLike($dt){
		$this->db->like('nama_akun', $dt);
		$this->db->from('mst_akun');
		$res = $this->db->get();
		return $res->result();	
	}
	
	
}