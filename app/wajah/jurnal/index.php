<section class="content-header">
	<div class="row">
		<div class="col-md-3">
			<label class="label-header"></label>
		</div>
		<div class="col-md-9">
			<div class="pull-right">
			
			</div>
		</div>
	</div>
</section>
<section class="content">
    <div class="row">
		<div class="col-lg-12">
			<form autocomplete="off" method="GET">
				<div class="box box-primary">
					<div class="box-header">
						<i class="fa fa-files-o"></i>
						<h3 class="box-title">Daftar Jurnal</h3>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="col-md-2">
									<div class="form-group">
										<label for="start_date">Tanggal Awal</label>
										<input type="text" name="tanggal_awal" id="tanggal_awal" class="form-control mulai" value="<?=$tanggal_awal?>" onkeypress="return false" readonly="" placeholder="Tanggal Awal (22-08-2011)" />
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="start_date">Tanggal Akhir</label>
										<input type="text" name="tanggal_akhir" id="tanggal_akhir" class="form-control selesai" value="<?=$tanggal_akhir?>" onkeypress="return false" readonly="" placeholder="Tanggal Akhir  (31-08-2011)" />
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="start_date">No Jurnal</label>
										<input type="text" name="no_jurnal" id="no_jurnal" class="form-control" value="<?=$no_jurnal?>" placeholder="No Jurnal" />
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="start_date">Status Konfirmasi</label>
										<input type="text" name="status" placeholder="Status Konfirmasi" id="status" class="form-control" value="<?=$dikonfirmasi?>"  />
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-4 col-xs-10">
									<button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> Cari</button>
									<a href="<?php echo site_url('jurnal_lap');?>" class="btn btn-danger btn-sm"><i class="fa fa-refresh"></i> Reset</a> <a href="<?=base_url()?>memorial" class="btn btn-sm btn-header btn-success"><img src="<?=base_url();?>assets/resources/add.png" /> Buat Jurnal Baru</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<?php if($this->session->userdata($this->config->item('ses_message')))
				{
					echo $this->session->userdata($this->config->item('ses_message'));
					$this->session->unset_userdata($this->config->item('ses_message'));
				}
			?>
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-credit-card"></i>
					<h3 class="box-title">Jurnal <?php
					$pdata = $this->session->userdata('session_data'); //Retrive ur session

						$tahun = $pdata['ses_tahun_buku'];
						echo " Per 31/12/".$tahun;
					?></h3>
				</div>
				<div class="box-body">
					<table width="100%" id="dtcustomt" class="table table-striped table-bordered table-hover">
						<thead>
							<th>Nomor Jurnal</th>
							<th>Tanggal Jurnal</th>
							<th>Nomor Bukti</th>
							<th>Memo</th>
							<th>Kode Akun</th>
							<th>Nama Akun</th>
							<th>Debet</th>
							<th>Kredit</th>
						</thead>
						<tbody>
							<?php 
							
							$nomorJurnalDua = "";
							$nomorJurnal = "";
							$no=0;foreach ($akun as $b)
							{
							echo '<tr>';
							
							    $nomorJurnal = $b->no_jurnal;
							    
							    if($nomorJurnalDua == $nomorJurnal){
							        
								    echo '<td><font color="#CCCCCC">'.$b->no_jurnal.'</font></td>';
								    echo '<td><font color="#CCCCCC">'.tgl_indo($b->tgl_jurnal).'</font></td>';
								    echo '<td><font color="#CCCCCC">'.$b->no_bukti.'</font></td>';
								    echo '<td><font color="#CCCCCC">'.$b->memo.'</td>';
							    } else 
							    {
							        
								    echo '<td>'.$b->no_jurnal.'</td>';
								    echo '<td>'.tgl_indo($b->tgl_jurnal).'</td>';
								    echo '<td>'.$b->no_bukti.'</td>';
								echo '<td>'.$b->memo.'</td>';
							        
							        
							    }
							
							    $nomorJurnalDua = $b->no_jurnal;
							    
								echo '<td>'.$b->kode_akun.'</td>';
								echo '<td>'.$b->nama_akun.'</td>';
								echo '<td align="right">'.number_format($b->debet).'</td>';
								echo '<td align="right">'.number_format($b->kredit).'</td>';
								?>
							
								<?php echo '</tr>';
							}  ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
