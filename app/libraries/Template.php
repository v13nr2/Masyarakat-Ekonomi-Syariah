<?php class Template {
	protected $_ci;
	function __construct() {
		$this->_ci = &get_instance();
		$this->_ci->load->model('model_saldoawal');
	}
	function view_baru($content, $data = NULL) {
		if($this->_ci->session->userdata($this->_ci->config->item('ses_id'))=="") {
			redirect('login');
		}
		/*$cekSaldoAwal   = $this->_ci->model_saldoawal->cekSaldoAwal(); if($cekSaldoAwal==0 && ($content!="saldoawal/input_saldoawal"&& $content!="akun/daftar_akun"&& $content!="akun/tambah_akun"&& $content!="akun/ubah_akun") ) {redirect('saldoawal'); }*/
		$data['metadata']   = $this->_ci->load->view('template/metadata', $data, TRUE);
		$data['headernya']  = $this->_ci->load->view('template/header', $data, TRUE);
		$data['sidebarnya'] = $this->_ci->load->view('template/sidebar', $data, TRUE);
		$data['contentnya'] = $this->_ci->load->view($content, $data, TRUE);
		$data['footernya']  = $this->_ci->load->view('template/footer', $data, TRUE);
		$this->_ci->load->view('template/index', $data);
	}
	function alert_php($alert = "", $message = "") {
		$_div_alert = '<div class="alert alert-'.$alert.' fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$message.'</div>';
		return $_div_alert;
	}
	function not_found_data($header, $body) {
		$html   = '<div id="container" class="c">';
		$html   .= '<h1 class="h1">'.$header.'</h1>';
		$html   .= '<p class="p">'.$body.'</p>';
		$html   .= '</div>';
		return $html;
	}
}
