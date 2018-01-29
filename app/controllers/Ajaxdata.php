<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Ajaxdata extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('model_tipeakun');
		$this->load->model('model_akun');
	}
	function get_kode_tipe_akun() {
		$id_tipe_akun = $this->input->post('id_tipe_akun');
		$data = $this->model_tipeakun->get_kode_tipe_akun($id_tipe_akun)->row_array();
		echo $data["kode_tipe_akun"];
	}
	function get_akun_json() {
		$data = $this->model_akun->get_akun_json()->result();
		echo json_encode($data);
	}
	function get_akun_json2() {
		$q = $this->input->get('q');
		$data = $this->model_akun->get_akun_json2($q);
		echo json_encode($data);
	}
}
