<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Program extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('model_program');
     // $this->load->model('model_tutupbuku');
		$this->load->library('form_validation');
	}
	public function index() {
      $data['judul'] 			= "Daftar Program";
      $data['dikonfirmasi'] 	= $this->input->get('status');
      $data['no_program'] 		= $this->input->get('no_program');
      $data['tanggal_dibuat'] 	= $this->input->get('tanggal_awal');
      $reset 					= $this->input->get('btnreset');

      if($reset!="")
      {
         $data['dikonfirmasi'] 	= "";
         $data['no_program'] 		= "";
         $data['tanggal_dibuat'] 	= "";
      }

      //$data['program'] 		= $this->model_program->list_program($data['tanggal_dibuat'], $data['no_program'], $data['dikonfirmasi'])->result();

		$this->template->view_baru('angaran/program/daftar_program', $data);
	}

	function displayHeading(){
		$this->load->model('model_program'); 
		$program['list'] = $this->model_program->get_program();

		$no = 1;
		if(is_array($program['list']) && count($program['list'])>0){
			
			foreach ($program['list'] as $p)
				{
			echo '<div class="panel panel-default col-md-3">
					<div class="panel-heading">Program : '.$p["keterangan"].'&nbsp;&nbsp;&nbsp;<a data-toggle="tooltip" href="'.base_url('program/ubah/'.$p["kode_unik"]).'" title="Ubah '.$p["no_program"].'" class="btn btn-warning btn-xs"><img src="'. base_url() .'/assets/images/icons/edit2.gif" heigth="10px"></a>&nbsp;&nbsp;'.$p["no_program"].'</div>
						<div class="panel-heading">
							<div>Anggaran : Rp. '.number_format($p["anggaran"]).'<br>List Proyek : </div>
						<ul>';
						
						$proyek['list2'] = $this->model_program->get_proyek($p["id_program"]);
						$totalnilai = 0;
						if(is_array($proyek['list2']) && count($proyek['list2'])>0){
							foreach ($proyek['list2'] as $j) {
								echo '<li><table width="100%"><tr><td><a href="'.site_url().'proyek/detail?id='.md5($j["id"]).'&idProyek='.$j["id"].'">'. $j["nama_proyek"] .'</a></td><td align="right">'. number_format($j["nilai"]) .'</td></tr></table></li>';
								$totalnilai = $totalnilai + $j["nilai"];
							}
						} else {
							echo "<li>Belum ada Proyek.</li>";
						}
			echo '
						</ul>
						<table width="100%"><tr><td><b>Sisa Anggaran</b></td><td align="right"><b>'. number_format($p["anggaran"] - $totalnilai) .'</b></td></tr></table>
						</div>
					</div>';
				}
		} else {
			echo '<div class="panel panel-default col-md-3">
					<div class="panel-heading">Belum Ada Program</div>
						<div class="panel-body">
						<ul><li>
							#
						</li>
						<li>
							#
						</li>
						</ul>
						</div>
					</div>';
		}
	}
	
	function display(){
		
		$this->load->model('model_program'); 
		$program['list'] = $this->model_program->get_program();

		$no = 1;
		if(is_array($program['list']) && count($program['list'])>0){
			foreach ($program['list'] as $p)
				{
			echo '<tr class="appendx"><td width="25%"><a href="'.base_url('program/detail/'.$p["kode_unik"]).'">'.$p["no_program"].'</a></td>';
					echo '<td width="30%">'.$p["keterangan"].'</td>';
					echo '<td width="20%">'.$p["tgl_dibuat"].'</td>';
					echo '<td align="center" width="10%">';
					echo '<a data-toggle="tooltip" href="'.base_url('program/detail/'.$p["kode_unik"]).'" title="Detail '.$p["no_program"].'" class="btn btn-success btn-xs">Detail</a>';
					echo '</td>';
					echo '<td align="center" width="10%">';
					echo '<a data-toggle="tooltip" href="'.base_url('program/ubah/'.$p["kode_unik"]).'" title="Ubah '.$p["no_program"].'" class="btn btn-warning btn-xs">Edit</a>';
					echo '</td>';


					echo '</tr>';
				}
		} else {
			echo '<tr class="appendx"><td width="25%"></td>';
					echo '<td width="30%"></td>';
					echo '<td width="20%"></td>';
					echo '<td align="center" width="10%">';
					echo '</td>';
					echo '<td align="center" width="10%">';
					echo '</td>';


					echo '</tr>';
		}
	}		
		
   function tambah()
   {
      $data['judul'] 		= "Buat Program Baru";
      $data['no_program'] 	= $this->input->post('no_program');
      $data['keterangan'] 		= $this->input->post('keterangan');
      $tmp_no_program 		= $this->model_program->get_no_program();
      $data['tgl_dibuat'] = $this->input->post('tgl_dibuat');
      $data['errors'] 	= '';

      if($data['no_program']=="" || $data["keterangan"]=="" || $data["tgl_dibuat"]=="")
      {
         $data['tgl_dibuat'] = date('d-m-Y');
         $data['no_program'] 	= $tmp_no_program;
      }
      else
      {
         $bulan = date_format(date_create($data['tgl_dibuat']), "m");
         $tahun = date_format(date_create($data['tgl_dibuat']), "Y");
         $cekTutupBuku = $this->model_tutupbuku->cekTutupBuku($bulan, $tahun);

         if($cekTutupBuku>0)
         {
            $data['errors'] = alert_php2('Sudah Tutup Buku. ', 'danger', 'Tanggal program harus lebih besar dari tanggal terakhir tutup buku.');
         }
         else
         {
            /*Save Header*/
            $kode_unik = base_convert(microtime(false), 10, 36);
            $data_program = array(
               "no_program"      => $data['no_program'],
               "keterangan"      => $data['keterangan'],
               "tgl_dibuat" 	=> date_format(date_create($data['tgl_dibuat']),"Y-m-d H:i:s"),
               "dikonfirmasi" 	=> "Yes",
               "yang_buat" 	=> "0",
               "kode_unik" 	=> $kode_unik,
               "company_id" 	=> $this->session->userdata($this->config->item('ses_company_id'))
            );
            $this->db->insert('tbl_program', $data_program);

            /*End Save Header*/ /*Get Id program*/
            $id_program = $this->model_program->get_id_program($kode_unik);
            /*End Get Id program*/ /*Detail program*/
            $baris 		= $this->input->post('baris');
            $set_uraian = $this->input->post('set_uraian');
            for ($i=0; $i<$baris; $i++)
            {
               $uraian 	= "";
               if($set_uraian=="A")
               {
                  $uraian = $data['keterangan'];
               }
               else
               {
                  $uraian = $this->input->post('uraian')[$i];

               }
					$tgl_perencaana 	= $this->input->post('tgl_perencaana')[$i];
               $data_detail = array(
                  "id_program" => $id_program,
                  "tgl_perencaana" 	=> date_format(date_create($data['tgl_dibuat']),"Y-m-d H:i:s"),
                  "uraian" 	=> $uraian,
                  "budget" 	=> $this->input->post('budget')[$i],
                  "total_penerimaan" 	=> $this->input->post('total_penerimaan')[$i],);

               $this->db->insert('tbl_program_detail', $data_detail);
            }
            /*End Detail program*/
            $message = alert_php2('Proses berhasil. ', 'success', 'program <b>'.$data["no_program"].'</b> berhasil disimpan.');
            $this->session->set_userdata($this->config->item('ses_message'), $message);
            redirect('program');
            $data['no_program'] 	= "";
            $data['keterangan'] 		= "";
            $data['tgl_dibuat'] = "";
         }
      }
      $this->template->view_baru('angaran/program/tambah_program', $data);
   }

   public function detail()
   {
      $kode_unik 		= $this->uri->segment(3);
      $header 		= $this->model_program->get_data_header($kode_unik)->row_array();
      $data['header'] = $header;
      $data['detail'] = $this->model_program->get_data_detail($header['id_program'])->result();
      $data['judul'] 	= "Detail Program " . $header['no_program'];
      $data['back'] 	= $this->uri->segment(1);

      $this->template->view_baru('angaran/program/detail_program', $data);
   }

   public function ubah()
   {
      $kode_unik 		= $this->uri->segment(3);
      $data['errors'] = '';
      $header 		= $this->model_program->get_data_header($kode_unik)->row_array();
      $data['header'] = $header;
      $data['detail'] = $this->model_program->get_data_detail($header['id_program'])->result();
      
      if($this->input->post('btnSimpan')=="Simpan")
      {

            $no_program 	= $this->input->post('no_program');
            $keterangan 		= $this->input->post('keterangan');
            $tgl_dibuat = $this->input->post('tgl_dibuat');
      
        $data_program = array(
               "no_program" 	=> $no_program,
               "keterangan" 			=> $keterangan,
               "tgl_dibuat" 	=> date_format(date_create($tgl_dibuat),"Y-m-d H:i:s")
            );

            $this->db->where('kode_unik', $kode_unik);
            $this->db->update('tbl_program', $data_program);
            
            
             /*DELETE DATA LAMA*/
            $w_d = "id_program = ";
            $w_d .= " (select id_program from tbl_program where kode_unik = '$kode_unik') ";
            $this->db->where($w_d);
            $this->db->delete('tbl_program_detail');

            /*AKHIR DELETE*/
            $baris 		= ($this->input->post('baris')-1);
            
            $id       = $_POST['tgl_perencaana'];
	  	    $jml_data = count($id);
	  	
            $set_uraian = $this->input->post('set_uraian');
            $id_program 	= $this->model_program->get_id_program($kode_unik);
            for ($i=0; $i < $jml_data; $i++)
            {
               $uraian 	= ""; if($set_uraian=="A")
               {
                  $uraian = $data['keterangan'];
               }
               else

               {
                  $uraian = $this->input->post('uraian')[$i];

               }
					$tgl_perencaana 	= $this->input->post('tgl_perencaana')[$i];
                    $data_detail = array(
                          "id_program" => $id_program,
                          "tgl_perencaana" 	=> date_format(date_create($data['tgl_dibuat']),"Y-m-d H:i:s"),
                          "uraian" 	=> $uraian,
                          "budget" 	=> $this->input->post('budget')[$i],
                          "total_penerimaan" 	=> $this->input->post('total_penerimaan')[$i]
                    );
                    $this->db->insert('tbl_program_detail', $data_detail);
            }
            /*End Detail program*/
            $message = alert_php2('Proses berhasil. ', 'success', 'program <b>'.$no_program.'</b> berhasil disimpan.');
            $this->session->set_userdata($this->config->item('ses_message'), $message);
            
            
            redirect('program');
      }
       
       
      $data['judul'] 	= "Ubah program " . $header['no_program'];
      $data['back'] 	= $this->uri->segment(1);
      $this->template->view_baru('angaran/program/ubah_program', $data);
   }

	public function konfirmasi()
	{
		$data['judul'] 		 	= "Daftar Program Yang Belum Dikonfirmasi";
		$data['no_program'] 	 	= $this->input->get('no_program');
		$data['tanggal_dibuat'] 	= $this->input->get('tanggal_dibuat');
		$reset 					= $this->input->get('btnreset');

		if($reset!="")
		{
			$data['no_program'] 		= "";
			$data['tanggal_dibuat'] 	= "";

		}
		$data['program'] 	= $this->model_program->list_program_no_konfirmasi($data['no_program'], $data['tanggal_dibuat'])->result();
		$this->template->view_baru('angaran/program/konfirmasi_program', $data);
	}

}
