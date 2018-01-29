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
			<?php if($this->session->userdata($this->config->item('ses_message')))
				{
					echo $this->session->userdata($this->config->item('ses_message'));
					$this->session->unset_userdata($this->config->item('ses_message'));
				}
			?>
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-credit-card"></i>
					<h3 class="box-title">BUKUR BESAR  <?php
					$pdata = $this->session->userdata('session_data'); //Retrive ur session

						$tahun = $pdata['ses_tahun_buku'];
						echo " Per 31/12/".$tahun;
					?>&nbsp; Kode Akun <?php echo $this->uri->segment(3);?></h3>
				</div>
				<div class="box-body">
					<table width="100%" id="dtcustomt2" class="table table-striped table-bordered table-hover">
						<thead>
							<th>Nomor Jurnal</th>
							<th>Tanggal </th>
							<th>Nomor Bukti</th>
							<th>Memo</th>
							<th>Kode Akun</th>
							<th>Nama Akun</th>
							<th>Debet</th>
							<th>Kredit</th>
							<th>Saldo</th>
						</thead>
						<tbody>
							<?php 
							$saldo = 0;
							$saldorun = 0;
							$totaldebet = 0;
							$totalkredit = 0;
							$nomorJurnalDua = "";
							$nomorJurnal = "";
							$no=0;foreach ($akun as $b)
							{
							echo '<tr>';
							
							    $nomorJurnal = $b->no_jurnal;
							    
							  
								    echo '<td>'.$b->no_jurnal.'</td>';
								    echo '<td>'.tgl_indo($b->tgl_jurnal).'</td>';
								    echo '<td>'.$b->no_bukti.'</td>';
								echo '<td>'.$b->memo.'</td>';
							        
							   
							    $nomorJurnalDua = $b->no_jurnal;
							    
								echo '<td>'.$b->kode_akun.'</td>';
								echo '<td>'.$b->nama_akun.'</td>';
								echo '<td align="right">'.number_format($b->debet).'</td>';
								$totaldebet = $totaldebet + $b->debet;
								$totalkredit = $totalkredit + $b->kredit;
								echo '<td align="right">'.number_format($b->kredit).'</td>';
								
								$saldo = $b->debet - $b->kredit;
								$saldorun = $saldorun + $saldo;
							    echo '<td align="right">'. number_format($saldorun) . '</td>';
								
								?>
							
								<?php echo '</tr>';
							}  ?>
							<tr>
							    
							    
							    <td></td>
							    <td></td>
							    <td></td>
							    <td></td>
							    <td></td>
							    <td></td>
							    <td>TOTAL</td>
							    <td align="right"><?php echo number_format($totaldebet);?></td>
							    <td align="right"><?php echo number_format($totalkredit);?></td>
							</tr>
							<tr>
							    
							    
							    <td></td>
							    <td></td>
							    <td></td>
							    <td></td>
							    <td></td>
							    <td></td>
							    <td>SALDO</td>
							    <td align="right"></td>
							    <td align="right"><?php echo number_format($totaldebet- $totalkredit);?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
