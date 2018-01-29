<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Laporan extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('model_laporan');
	}
	function index() {
		$data['judul'] 		= "Laporan";
		$this->template->view_baru('laporan/index', $data);
	}
	function neraca() {
		$data['judul'] = "Neraca Saldo";
		$data['bulan'] 	= $this->input->get('bulan');
		$data['tahun'] 	= $this->input->get('tahun');
		$periode 		= "";
		if($data['bulan']=='' && $data['tahun']=='') {
			$periode 		= date("m/Y");
			$data['bulan'] 	= date("m");
			$data['tahun'] 	= date("Y");
		} else {
			if($data['bulan']<10) {
				$data['bulan'] = '0'.$data['bulan'];
			}
			$periode = $data['bulan'] . '/' . $data['tahun'];
		}
		$this->model_laporan->insert_labarugi($periode);
		$data['neraca'] = $this->model_laporan->neraca($periode)->result();
		$b 				= intval(substr($periode, 0, 2));
		$t 				= substr($periode, 3, 4);
		$data['periode'] = $periode;
		$data['tmp_p'] 	= bulan($b) . " " . $t;
		$data['lastday'] = akhirbulan($data['tahun'] . "-" . $data["bulan"] . "-01");
		$this->template->view_baru('laporan/neraca', $data);
	}
	function jurnal() {
		$data['judul'] 		= "Jurnal Umum";
		$data['bulan'] 	= $this->input->get('bulan');
		$data['tahun'] 	= $this->input->get('tahun');
		$periode 		= "";
		if($data['bulan']=='' && $data['tahun']=='') {
			$periode = date("m/Y");
		} else {
			if($data['bulan']<10) {
				$data['bulan'] = '0'.$data['bulan'];
			}
			$periode = $data['bulan'] . '/' . $data['tahun'];
		}
		$data['jurnal'] = $this->model_laporan->jurnal_umum($periode)->result();
		$b 				= intval(substr($periode, 0, 2));
		$t 				= substr($periode, 3, 4);
		$data['periode'] = $periode;
		$data['tmp_p'] 	= bulan($b) . " " . $t;
		$this->template->view_baru('laporan/jurnal_umum', $data);
	}
	function bukubesar() {
		$data['judul'] 	= "Buku Besar";
		$data['bulan'] 	= $this->input->get('bulan');
		$data['tahun'] 	= $this->input->get('tahun');
		$periode 		= "";
		if($data['bulan']=='' && $data['tahun']=='') {
			$periode = date("m/Y");
		} else {
			if($data['bulan']<10) {
				$data['bulan'] = '0'.$data['bulan'];
			}
			$periode = $data['bulan'] . '/' . $data['tahun'];
		}
		$data['bb'] 	= $this->model_laporan->bukubesar($periode)->result();
		$b 				= intval(substr($periode, 0, 2));
		$t 				= substr($periode, 3, 4);
		$data['periode'] = $periode;
		$data['tmp_p'] 	= bulan($b) . " " . $t;
		$this->template->view_baru('laporan/buku_besar', $data);
	}
	function labarugi() {
		$data['judul'] 	= "Buku Besar";
		$data['bulan'] 	= $this->input->get('bulan');
		$data['tahun'] 	= $this->input->get('tahun');
		$periode 		= "";
		if($data['bulan']=='' && $data['tahun']=='') {
			$periode = date("m/Y");
		} else {
			if($data['bulan']<10) {
				$data['bulan'] = '0'.$data['bulan'];
			}
			$periode = $data['bulan'] . '/' . $data['tahun'];
		}
		$this->model_laporan->insert_labarugi($periode);
		$data['labarugi'] 	= $this->model_laporan->labarugi($periode)->result();
		$b = intval(substr($periode, 0, 2));
		$t = substr($periode, 3, 4);
		$data['tmp_p'] = bulan($b) . " " . $t;
		$data['periode'] = $periode;
		$this->template->view_baru('laporan/laba_rugi', $data);
	}
}
