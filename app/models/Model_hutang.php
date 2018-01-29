<?php defined('BASEPATH') OR exit('No direct script access allowed'); /** * */

class Model_hutang extends CI_Model {

	function list_jurnal($tanggal_awal, $tanggal_akhir, $no_jurnal, $dikonfirmasi)
	{
		$this->db->select('trs_jurnal.id_jurnal, SUM(trs_jurnal_detail.kredit) AS kredit, kreditur, no_bukti, no_jurnal, tgl_jurnal, memo, total, dikonfirmasi, tgl_dibuat, tgl_diubah, kode_unik');
		$this->db->from('trs_jurnal');
		$this->db->join('trs_jurnal_detail', 'trs_jurnal.id_jurnal = trs_jurnal_detail.id_jurnal', 'left');
		$this->db->group_by('trs_jurnal.id_jurnal');
		$this->db->where('company_id', $this->session->userdata($this->config->item('ses_company_id')));
		$this->db->where('jenis_jurnal', 'JH');
		if($dikonfirmasi != "")
		{
			$this->db->where('dikonfirmasi', $dikonfirmasi);
		}
		if($tanggal_awal != "")
		{
			$this->db->where('tgl_jurnal >=', date('Y-m-d', strtotime($tanggal_awal)));
		}
		if($tanggal_akhir != "")
		{
			$this->db->where('tgl_jurnal <=', date('Y-m-d', strtotime($tanggal_akhir)));
		}
		if($no_jurnal != "")
		{
			$this->db->like('no_jurnal', $no_jurnal);
		}
		$this->db->order_by('tgl_jurnal', 'ASC');
		$akun = $this->db->get(); return $akun;
	}

	function list_jurnal_no_konfirmasi($no_jurnal = null, $tanggal_awal = null, $tanggal_akhir = null)
	{
		$this->db->select('id_jurnal, no_bukti, no_jurnal, tgl_jurnal, memo, total, dikonfirmasi, tgl_dibuat, tgl_diubah, kode_unik');
		$this->db->from('trs_jurnal'); $this->db->where('dikonfirmasi', '');
		$this->db->where('company_id', $this->session->userdata($this->config->item('ses_company_id')));

		if($tanggal_awal != "")
		{
			$this->db->where('tgl_jurnal >=', date('Y-m-d', strtotime($tanggal_awal)));
		}
		if($tanggal_akhir != "")
		{
			$this->db->where('tgl_jurnal <=', date('Y-m-d', strtotime($tanggal_akhir)));
		}
		if($no_jurnal != "")
		{
			$this->db->like('no_jurnal', $no_jurnal);
		}
		$this->db->order_by('tgl_jurnal', 'ASC');
		return $this->db->get();
	}

	function get_data_header($kode_unik)
	{
		$this->db->select('*');
		$this->db->from('trs_jurnal');
		$this->db->where('kode_unik', $kode_unik);
		$this->db->where('company_id', $this->session->userdata($this->config->item('ses_company_id')));
		return $this->db->get();
	}

	function get_data_detail($id)
	{
		$this->db->select('*'); $this->db->where('trs_jurnal_detail.id_jurnal', $id);
		$this->db->from('trs_jurnal_detail');
		$this->db->join('mst_akun', 'mst_akun.id_akun = trs_jurnal_detail.id_akun', 'left');
		return $this->db->get();
	}

	function get_no_jurnal()
	{
		$this->db->select('(count(no_jurnal) + 1) as noj');
		$this->db->where('MONTH(trs_jurnal.tgl_jurnal)', date('m')); $this->db->where('YEAR(trs_jurnal.tgl_jurnal)', date('Y'));
		$this->db->where('company_id', $this->session->userdata($this->config->item('ses_company_id')));
		$query 	= $this->db->get('trs_jurnal');
		$data 	= $query->row_array(); $no 	= "JL-" . date('Ym-') . substr("00000".$data['noj'], -5); return $no;
	}

	function get_id_jurnal($kode_unik)
	{
		$this->db->select('id_jurnal');
		$this->db->where('kode_unik', $kode_unik);
		$this->db->where('company_id', $this->session->userdata($this->config->item('ses_company_id')));
		$query = $this->db->get('trs_jurnal');
		$data = $query->row_array();
		return $data["id_jurnal"];
	}

	function get_akun_by_id($id_akun)
	{
		return $this->db->get_where('mst_akun', array('md5(id_akun)' => $id_akun));
	}

	function check_kode_akun_insert($kode_akun)
	{
		$this->db->select('kode_akun');
		$this->db->where('kode_akun', $kode_akun);
		$query = $this->db->get('mst_akun');
		$num = $query->num_rows();
		return $num;
	}
	function check_kode_akun_update($kode_akun, $kode_akun_lama)
	{
		$this->db->select('kode_akun');
		$this->db->where(array('kode_akun =' => $kode_akun, 'kode_akun <> ' => $kode_akun_lama));
		$query = $this->db->get('mst_akun'); $num = $query->num_rows();
		return $num;
	}
}
?>
