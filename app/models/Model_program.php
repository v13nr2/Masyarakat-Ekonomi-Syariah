<?php defined('BASEPATH') OR exit('No direct script access allowed');
/** * */
class Model_program extends CI_Model {


	function list_program($tanggal_dibuat, $no_program, $dikonfirmasi)
	{
		$this->db->select('id_program, no_program, tgl_dibuat, keterangan, dikonfirmasi,kode_unik');
		$this->db->from('tbl_program');
		$this->db->where('company_id', $this->session->userdata($this->config->item('ses_company_id')));
		if($dikonfirmasi != "")
		{
			$this->db->where('dikonfirmasi', $dikonfirmasi);
		}
		if($tanggal_dibuat != "")
		{
			$this->db->where('tgl_dibuat >=', date('Y-m-d', strtotime($tanggal_dibuat)));
		}
		if($no_program != "")
		{
			$this->db->like('no_program', $no_program);
		}
		$this->db->order_by('tgl_dibuat', 'ASC');
		$akun = $this->db->get();
		return $akun;
	}

	
	public function get_program($cari = "")
	{
		if ($cari == "")
		{
			$query = $this->db->query("SELECT A.*, SUM(B.budget) as anggaran FROM tbl_program  A 
				LEFT JOIN tbl_program_detail B 
				ON A.id_program = B.id_program 
							WHERE YEAR(A.tgl_dibuat) = '". $this->input->get("cari") ."' 
							
							GROUP BY A.id_program ");
			return $query->result_array();
		}
		
		$query = $this->db->get_where('tbl_program', array('id' => $id));
		return $query->row_array();
	}
	
	
	function get_no_program()
	{
		$this->db->select('(count(no_program) + 1) as noj');
		$this->db->where('MONTH(tbl_program.tgl_dibuat)', date('m'));
		$this->db->where('YEAR(tbl_program.tgl_dibuat)', date('Y'));
		$this->db->where('company_id', $this->session->userdata($this->config->item('ses_company_id')));
		$query 	= $this->db->get('tbl_program');
		$data 	= $query->row_array(); $no 	= "AP-" . date('Ym-') . substr("00000".$data['noj'], -5); return $no;
	}

	function get_id_program($kode_unik)
	{
		$this->db->select('id_program');
		$this->db->where('kode_unik', $kode_unik);
		$this->db->where('company_id', $this->session->userdata($this->config->item('ses_company_id')));
		$query = $this->db->get('tbl_program');
		$data = $query->row_array();
		return $data["id_program"];
	}

	function get_data_header($kode_unik)
	{
		$this->db->select('*');
		$this->db->from('tbl_program');
		$this->db->where('kode_unik', $kode_unik);
		$this->db->where('company_id', $this->session->userdata($this->config->item('ses_company_id')));
		return $this->db->get();
	}



	function get_data_detail($id)
	{
		$this->db->select('*'); $this->db->where('tbl_program_detail.id_program', $id);
		$this->db->from('tbl_program_detail');
		$this->db->join('mst_akun', 'mst_akun.id_akun = tbl_program_detail.id_akun', 'left'); return $this->db->get();
	}



	function get_proyek($id)
	{
		
		$query = $this->db->get_where('tbl_proyek', array('id_program' => $id));
		return $query->result_array();
 
	
	}

	function list_jurnal_no_konfirmasi($no_program = null, $tanggal_dibuat = null)
	{
		$this->db->select('id_program, no_program, tgl_dibuat, keterangan, dikonfirmasi, kode_unik');
		$this->db->from('tbl_program');
		$this->db->where('dikonfirmasi', '');
		$this->db->where('company_id', $this->session->userdata($this->config->item('ses_company_id')));

		if($tanggal_dibuat != "")
		{
			$this->db->where('tgl_dibuat >=', date('Y-m-d', strtotime($$tanggal_dibuat)));
		}
		if($no_program != "")
		{
			$this->db->like('no_program', $no_program);
		}
		$this->db->order_by('tbl_program', 'ASC');
		return $this->db->get();
	}





}
