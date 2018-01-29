<?php defined('BASEPATH') OR exit('No direct script access allowed'); /** * */

class Model_aset extends CI_Model {

	function list_aset()
	{
		$sql = "SELECT A.*, 
			(
			SELECT mano_post FROM aktiva_details WHERE aktiva_id = A.id ORDER BY id DESC LIMIT 1
			) AS mano_post
			FROM aktiva A LEFT JOIN aktiva_details B
			ON A.id = B.aktiva_id
			GROUP BY aktiva_id";
			
		
		$query = $this->db->query($sql);
		return $query->result();
	}

	function list_aset_kategori()
	{
		$sql = "SELECT *
			FROM aset_kategori";
			
		
		$query = $this->db->query($sql);
		return $query->result();
	}


	function list_aset_konfigurasi()
	{
		$sql = "SELECT A.*, B.jenis
			FROM aset_config A, aset_kategori B WHERE A.id_jenis_aset = B.id";
			
		
		$query = $this->db->query($sql);
		return $query->result();
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
		$this->db->from('aktiva');
		$this->db->where('id', $kode_unik);
		//$this->db->where('company_id', $this->session->userdata($this->config->item('ses_company_id')));
		return $this->db->get();
	}

	function get_data_detail($id)
	{
		$this->db->select('*'); $this->db->where('aktiva_details.aktiva_id', $id);
		$this->db->from('aktiva_details');
		$this->db->order_by('mano_post');
		return $this->db->get();
	}


	function detailByid($id)
	{
		if(!empty($id)){
			$query = "
			SELECT 
			* FROM aset_config 
			WHERE md5(id)='$id'
			";

			return $this->db->query($query)->result();
		}
	}


	function get_data_detail_kategori($id)
	{
		$this->db->select('jenis,id');
		$where = "id = '$id'";
		$this->db->where($where);
		$this->db->from('aset_kategori');
		return $this->db->get()->row_array();
		
	}

	public function saveHeader($data){
		$this->db->insert('aktiva',$data);
        $insert_id = $this->db->insert_id();

		return  $insert_id;
	}

	function konfig($id)
	{
		$this->db->select('*');
		$where = "id_jenis_aset = '$id'";
		$this->db->where($where);
		$this->db->from('aset_config');
		return $this->db->get()->row_array();
		
	}

	function konfig_idAkun($coa)
	{
		$this->db->select('id_akun');
		$where = "kode_akun = '$coa'";
		$this->db->where($where);
		$this->db->from('mst_akun');
		return $this->db->get()->row_array();
		//echo $this->db->last_query();
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
	
	function hapusConfig($id){
		if(!empty($id)){
			$query = "
			DELETE FROM aset_config WHERE md5(id)='$id'
			";

			return $this->db->query($query);
		}
	}
	
}
?>
