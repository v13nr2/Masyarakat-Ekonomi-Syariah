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
					<h3 class="box-title">JURNAL DETAIL &nbsp;</h3>
				</div>
				<div class="box-body">
					<table width="100%" id="dtcustomt" class="table table-striped table-bordered table-hover">
						<thead>
							<th>Nomor Jurnal</th>
							
							<th>Nomor Bukti</th>
							<th>Memo</th>
							<th>Kode Akun</th>
							<th>Nama Akun</th>
							<th>Debet</th>
							<th>Kredit</th>
						</thead>
						<tbody>
							<?php 
							$totaldebet = 0;
							$totalkredit = 0;
							$nomorJurnalDua = "";
							$nomorJurnal = "";
							$no=0;foreach ($akun as $b)
							{
							echo '<tr>';
							
							    $nomorJurnal = $b->no_jurnal;
							    
							    if($nomorJurnalDua == $nomorJurnal){
							        
								    echo '<td><font color="#CCCCCC">'.$b->no_jurnal.'</font></td>';
								    echo '<td><font color="#CCCCCC">'.$b->no_bukti.'</font></td>';
								    echo '<td><font color="#CCCCCC">'.$b->memo.'</td>';
							    } else 
							    {
							        
								    echo '<td>'.$b->no_jurnal.'</td>';
								    echo '<td>'.$b->no_bukti.'</td>';
								echo '<td>'.$b->memo.'</td>';
							        
							        
							    }
							
							    $nomorJurnalDua = $b->no_jurnal;
							    
								echo '<td>'.$b->kode_akun.'</td>';
								echo '<td>'.$b->nama_akun.'</td>';
								echo '<td align="right">'.number_format($b->debet).'</td>';
								$totaldebet = $totaldebet + $b->debet;
								$totalkredit = $totalkredit + $b->kredit;
								echo '<td align="right">'.number_format($b->kredit).'</td>';
								?>
							
								<?php echo '</tr>';
							}  ?>
							<tr>
							    
							    
							    <td></td>
							    <td></td>
							    <td></td>
							    <td></td>
							    <td>TOTAL</td>
							    <td align="right"><?php echo number_format($totaldebet);?></td>
							    <td align="right"><?php echo number_format($totalkredit);?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
