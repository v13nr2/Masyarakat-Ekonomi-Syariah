<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Model_saldoawal extends CI_Model {
	function cekSaldoAwal() {
		$company_id = $this->session->userdata($this->config->item('ses_company_id'));
		$this->db->select('count(*) as banyak');
		$this->db->from('trs_neraca_saldo');
		$this->db->where('company_id', $company_id);
		$data = $this->db->get()->row_array();
		return $data["banyak"];
	}
}
?>
