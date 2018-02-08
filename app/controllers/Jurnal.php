<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Jurnal extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_akun');
		$this->load->model('model_jurnal');
		$this->load->helper('date');
		$this->load->library('user_agent');
		$this->load->model('model_tutupbuku');
		
	    $this->load->helper('tanggal_helper');
	}

	function index()
	{
		$data['judul'] 			= "Daftar Jurnal";
		$data['dikonfirmasi'] 	= $this->input->get('status');
		$data['no_jurnal'] 		= $this->input->get('no_jurnal');
		$data['tanggal_awal'] 	= $this->input->get('tanggal_awal');
		$data['tanggal_akhir'] 	= $this->input->get('tanggal_akhir');
		$reset 					= $this->input->get('btnreset');

		if($reset!="")
		{
			$data['dikonfirmasi'] 	= "";
			$data['no_jurnal'] 		= "";
			$data['tanggal_awal'] 	= "";
			$data['tanggal_akhir'] 	= "";
		}

		$data['jurnal'] 		= $this->model_jurnal->list_jurnal_header();
    //	$data['tanggal_akhir'], $data['no_jurnal'], $data['dikonfirmasi'])->result();
		$this->template->view_baru('jurnal/daftar_jurnal', $data);
	}

	function tambah()
	{
		$data['mobile']		= $this->agent->is_mobile();
		$data['judul'] 		= "Buat Jurnal";
		$data['akun'] 		= $this->model_akun->list_akun()->result();

		$this->load->model('Model_kas');
			$nourut =  $this->Model_kas->nourut();
			$dt = array(
					'jenis_jurnal' => 'BKM', //$this->input->post('nojurnal'),
					'urut' => $nourut+1,
					'tahun' => date('Y'),
					'bulan' => date('m'),
					'ip' => $this->input->post('kreditur'),
					'user' => $this->input->post('keterangan')
				);
			$id_counter = $this->Model_kas->saveCounter($dt);

			$iduser =  $pdata['ses_user_id'];
			$this->load->helper('nomor_helper');
			$nomor = nojurnal($nourut+1);

		$data['no_jurnal'] = date('Y').date('m').$nomor; 	
		$data['no_bukti'] 	= $this->input->post('no_bukti');
		$data['memo'] 		= $this->input->post('memo');
		$data['tgl_jurnal'] = $this->input->post('tgl_jurnal');
		$tmp_no_jurnal 		= $this->model_jurnal->get_no_jurnal();
		$data['total'] 		= $this->input->post('total'); $data['total'] 		= str_replace(".", "", $data['total']);
		$data['total'] 		= str_replace(",", ".", $data['total']);
		$data['errors'] 	= '';

		if($data['no_jurnal']=="" || $data["memo"]=="" || $data["tgl_jurnal"]=="")
		{
			$data['tgl_jurnal'] = date('d-m-Y');
			//$data['no_jurnal'] 	= $tmp_no_jurnal;

			$data['no_jurnal'] = date('Y').date('m').$nomor; 	
		}
		else
		{
			$bulan = date_format(date_create($data['tgl_jurnal']), "m");
			$tahun = date_format(date_create($data['tgl_jurnal']), "Y");
			$cekTutupBuku = $this->model_tutupbuku->cekTutupBuku($bulan, $tahun);

			if($cekTutupBuku>0)
			{
				$data['errors'] = alert_php2('Sudah Tutup Buku. ', 'danger', 'Tanggal jurnal harus lebih besar dari tanggal terakhir tutup buku.');
			}
			else
			{
				/*Save Header*/
				$kode_unik = base_convert(microtime(false), 10, 36);
				$data_jurnal = array("no_jurnal" 	=> $data['no_jurnal'],
				"no_bukti" 		=> $data['no_bukti'],
				"memo" 			=> $data['memo'],
				"tgl_jurnal" 	=> date_format(date_create($data['tgl_jurnal']),
				"Y-m-d H:i:s"), "total" 		=> $data['total'],
				"dikonfirmasi" 	=> "Yes",
				"yang_buat" 	=> "0",
				"jenis_jurnal" 	=> "JU",
				"kode_unik" 	=> $kode_unik,
				"company_id" 	=> $this->session->userdata($this->config->item('ses_company_id')) );

				$this->db->set('tgl_dibuat', 'NOW()', FALSE);
				$this->db->set('yang_ubah', 'NULL', FALSE);
				$this->db->set('tgl_diubah', 'NULL', FALSE);
				$this->db->insert('trs_jurnal', $data_jurnal);

				/*End Save Header*/ /*Get Id Jurnal*/
				$id_jurnal = $this->model_jurnal->get_id_jurnal($kode_unik);
				/*End Get Id Jurnal*/ /*Detail Jurnal*/
				$baris 		= $this->input->post('baris');
				$set_uraian = $this->input->post('set_uraian');
				for ($i=0; $i<$baris; $i++)
				{
					$uraian 	= "";
					if($set_uraian=="A")
					{
						$uraian = $data['memo'];
					}
					else
					{
						$uraian = $this->input->post('uraian')[$i];

					}

					$debet 		= $this->input->post('debet')[$i];
					$debet 		= str_replace(".", "", $debet);
					$debet 		= str_replace(",", ".", $debet);
					$kredit 	= $this->input->post('kredit')[$i];
					$kredit 	= str_replace(".", "", $kredit);
					$kredit 	= str_replace(",", ".", $kredit);
					$amount = $debet - $kredit;
					$data_detail = array("id_jurnal" => $id_jurnal,
					"id_akun" 	=> $this->input->post('akun')[$i],
					"amount" 	=> $amount,
					"uraian" 	=> $uraian,
					"debet" 	=> $debet,
					"kredit" 	=> $kredit, );

					$this->db->insert('trs_jurnal_detail', $data_detail);
				}
				helper_log("Add", "Menambah jurnal dengan id = ".$id_jurnal);
				/*End Detail Jurnal*/
				$message = alert_php2('Proses berhasil. ', 'success', 'Jurnal <b>'.$data["no_jurnal"].'</b> berhasil disimpan.');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
				redirect('jurnal/tambah'); $data['no_jurnal'] 	= ""; $data['memo'] 		= ""; $data['tgl_jurnal'] = "";
			}
		}
		$this->template->view_baru('jurnal/tambah_jurnal', $data);
	}

	public function detail()
	{
		$kode_unik 		= $this->uri->segment(3);
		$header 		= $this->model_jurnal->get_data_header($kode_unik)->row_array();
		$data['header'] = $header;
		$data['detail'] = $this->model_jurnal->get_data_detail($header['id_jurnal'])->result();
		$data['judul'] 	= "Detail Jurnal " . $header['no_jurnal'];
		$data['back'] 	= $this->uri->segment(1);

		$this->template->view_baru('jurnal/detail_jurnal', $data);
	}
    
    public function delete($x){
        $kode       = $this->uri->segment(3);
        
		//tutup harian
		$tanggaldb = $this->model_jurnal->validEditByTanggal($kode);
		if($tanggaldb < date('Y-m-d')){
			echo '<script>alert("Sudah lewat Hari.");window.history.back();</script>';
			return false;
		}


        $data["id_delete"] = $this->model_jurnal->del_jurnal_detail($kode);
        
        $this->db->where('id_jurnal', $data["id_delete"]["id_jurnal"]);
        $delDetail = $this->db->delete('trs_jurnal_detail');
        if($delDetail){
            $this->db->where('kode_unik', $kode);
            $this->db->delete('trs_jurnal'); 
        }
        helper_log("Delete", "Menghapus jurnal ".$data["id_delete"]["id_jurnal"]);
        redirect('jurnal');
        
    }
    
	public function ubah()
	{
		$kode_unik 		= $this->uri->segment(3);
		$data['errors'] = '';
		$data['mobile']	= $this->agent->is_mobile();
		$data['akun'] 		= $this->model_akun->list_akun_detail()->result();
		$header 		= $this->model_jurnal->get_data_header($kode_unik)->row_array();
		$data['header'] = $header;
		$data['detail'] = $this->model_jurnal->get_data_detail($header['id_jurnal'])->result();
		$no_jurnal 	= $this->input->post('no_jurnal');
		$no_bukti 	= $this->input->post('no_bukti');
		$memo 		= $this->input->post('memo');
		$tgl_jurnal = $this->input->post('tgl_jurnal');
		$total 		= $this->input->post('total');


		//tutup harian
		$tanggaldb = $this->model_jurnal->validEditByTanggal($kode_unik);
		if($tanggaldb < date('Y-m-d')){
			echo '<script>alert("Sudah lewat Hari.");window.history.back();</script>';
		}

		if($no_jurnal=="" || $memo=="" || $tgl_jurnal=="")
		{

		}
		 else
		 {
			 $bulan = date_format(date_create($tgl_jurnal), "m");
			 $tahun = date_format(date_create($tgl_jurnal), "Y");
			 $cekTutupBuku = $this->model_tutupbuku->cekTutupBuku($bulan, $tahun);

			 if($cekTutupBuku>0)
			{
				$data['errors'] = alert_php2('Sudah Tutup Buku. ', 'danger', 'Tanggal jurnal harus lebih besar dari tanggal terakhir tutup buku.');
			}
			else
			{
				$data_jurnal = array(
					"no_jurnal" 	=> $no_jurnal,
					"no_bukti" 		=> $no_bukti,
					"memo" 			=> $memo,
					"tgl_jurnal" 	=> date_format(date_create($tgl_jurnal),
					"Y-m-d H:i:s"),
					"total" 		=> $total,
					"company_id" 	=> $this->session->userdata($this->config->item('ses_company_id'))
				);

				$this->db->set('yang_ubah', '-1', FALSE);
				$this->db->set('tgl_diubah', 'NOW()', FALSE);
				$this->db->where('kode_unik', $kode_unik);
				$this->db->update('trs_jurnal', $data_jurnal);

				 /*DELETE DATA LAMA*/
				$w_d = "id_jurnal = ";
				$w_d .= " (select id_jurnal from trs_jurnal where kode_unik = '$kode_unik') ";
				$this->db->where($w_d); 
				$this->db->delete('trs_jurnal_detail');
				helper_log("Add", "Menghapus jurnal untuk edit, id = ".$w_d);

				/*AKHIR DELETE*/
				$baris 		= ($this->input->post('baris')-1);

				$set_uraian = $this->input->post('set_uraian');
				$id_jurnal 	= $this->model_jurnal->getting_idJurnal($kode_unik);
				for ($i=0; $i<$baris; $i++)
				{
					$uraian 	= ""; if($set_uraian=="A")
					{
						$uraian = $data['memo'];
					}
					else

					{
						$uraian = $this->input->post('uraian')[$i];

					}

					$debet 		= $this->input->post('debet')[$i];
					$debet 		= str_replace(".", "", $debet);
					$debet 		= str_replace(",", ".", $debet);
					$kredit 	= $this->input->post('kredit')[$i];
					$kredit 	= str_replace(".", "", $kredit);
					$kredit 	= str_replace(",", ".", $kredit);
					$amount 	= $debet - $kredit;
					$data_detail = array(
						"id_jurnal" => $id_jurnal,
						"id_akun" 	=> $this->input->post('akun')[$i],
						"amount" 	=> $amount,
						"uraian" 	=> $uraian,
						"debet" 	=> $debet,
						"kredit" 	=> $kredit, );
					$this->db->insert('trs_jurnal_detail', $data_detail);
				}
				helper_log("Add", "Menambah jurnal dengan id = ".$id_jurnal);
				/*End Detail Jurnal*/
				$message = alert_php2('Proses berhasil. ', 'success', 'Jurnal <b>'.$no_jurnal.'</b> berhasil disimpan.');
				$this->session->set_userdata($this->config->item('ses_message'), $message); redirect('jurnal/ubah/'.$kode_unik);
			}
		}
		$data['judul'] 	= "Ubah Jurnal " . $header['no_jurnal'];
		$data['back'] 	= $this->uri->segment(1);
		$this->template->view_baru('jurnal/ubah_jurnal', $data);
	}

	public function konfirmasi()
	{
		$data['judul'] 		 	= "Daftar Jurnal Yang Belum Dikonfirmasi";
		$data['no_jurnal'] 	 	= $this->input->get('no_jurnal');
		$data['tanggal_awal'] 	= $this->input->get('tanggal_awal');
		$data['tanggal_akhir'] 	= $this->input->get('tanggal_akhir');
		$reset 					= $this->input->get('btnreset');

		if($reset!="")
		{
			$data['no_jurnal'] 		= "";
			$data['tanggal_awal'] 	= "";
			$data['tanggal_akhir'] 	= "";
		}
		$data['jurnal'] 	= $this->model_jurnal->list_jurnal_no_konfirmasi($data['no_jurnal'], $data['tanggal_awal'], $data['tanggal_akhir'])->result();
		$this->template->view_baru('jurnal/konfirmasi_jurnal', $data);
	}
	public function confirm()
	{
		$kode_unik 		= $this->input->post('jurnal_id');
		$company_id 	= $this->session->userdata($this->config->item('ses_company_id'));
		$login_id 		= $this->session->userdata($this->config->item('ses_id'));
		$sql 	= "update trs_jurnal set "; $sql 	.= " dikonfirmasi = 'Yes' ";
		$sql 	.= " , dikonfirmasi_oleh = '$login_id' ";
		$sql 	.= " WHERE kode_unik = '$kode_unik' and dikonfirmasi = '' ";
		$sql 	.= " and company_id = '$company_id' ";
		$this->db->query($sql);
	}
}
