<?php
class Dashboard_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}


	public function get_total_kas(){
	    $pdata = $this->session->userdata('session_data'); //Retrive ur session
		$ORG = $pdata['ses_organisasi_id2'];
		$this->db->select('coa_kas_induk');
		$this->db->from('tbl_organisasi');
		$where = " id = '$ORG'";;
		$this->db->where($where);
		$data = $this->db->get()->row_array();
		//return $data["coa_kas_induk"];
		
		$this->db->select('SUM(debet-kredit) as jumlah');
		$this->db->from('trs_jurnal_detail_v');        
		$this->db->join('mst_akun', 'mst_akun.id_akun = trs_jurnal_detail_v.id_akun'); 
		$this->db->like('trs_jurnal_detail_v.kode_akun', $data["coa_kas_induk"], 'after');      
		$query = $this->db->get();
		return $query->result_array();
	}
	

	public function get_total_piutang(){
	    $pdata = $this->session->userdata('session_data'); //Retrive ur session
		$ORG = $pdata['ses_organisasi_id2'];
		$this->db->select('coa_piutang_induk');
		$this->db->from('tbl_organisasi');
		$where = " id = '$ORG'";
		$this->db->where($where);
		$data = $this->db->get()->row_array();
		//return $data["coa_kas_induk"];
		
		$this->db->select('SUM(debet) as jumlah');
		$this->db->from('trs_jurnal_detail_v');        
		$this->db->join('mst_akun', 'mst_akun.id_akun = trs_jurnal_detail_v.id_akun'); 
		$this->db->like('trs_jurnal_detail_v.kode_akun', $data["coa_piutang_induk"], 'after');      
		$query = $this->db->get();
		return $query->result_array();
	}
	

	public function get_total_utang(){
    	$pdata = $this->session->userdata('session_data'); //Retrive ur session
		$ORG = $pdata['ses_organisasi_id2'];
		$this->db->select('coa_utang_induk');
		$this->db->from('tbl_organisasi');
		$where = " id = '$ORG'";
		$this->db->where($where);
		$data = $this->db->get()->row_array();
		//return $data["coa_kas_induk"];
		
		$this->db->select('SUM(debet) as jumlah');
		$this->db->from('trs_jurnal_detail_v');        
		$this->db->join('mst_akun', 'mst_akun.id_akun = trs_jurnal_detail_v.id_akun'); 
		$this->db->like('trs_jurnal_detail_v.kode_akun', $data["coa_utang_induk"], 'after');      
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_total_aset(){
		
		$this->db->select('SUM(nilai) as jumlah');
		$this->db->from('aktiva');        
		//$this->db->join('tblProduct', 'tblSaler.SalerID = tblProduct.SalerID'); 
		//$this->db->where('no_inst',$x);       
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_log(){
		
		$this->db->select('*');
		$this->db->from('tabel_log');        
		//$this->db->join('tblProduct', 'tblSaler.SalerID = tblProduct.SalerID'); 
		//$this->db->where('no_inst',$x);       
		$query = $this->db->order_by('log_time', 'DESC');       
		$query = $this->db->limit(10);    
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_server(){
		
		$this->db->select('server');
		$this->db->from('tbl_organisasi');    
		$data = $this->db->get()->row_array();
		//$data = $query->result_array();
		return $data["server"];
	}

	
}