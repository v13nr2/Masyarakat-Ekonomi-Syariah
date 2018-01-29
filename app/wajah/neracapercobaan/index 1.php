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
					<h3 class="box-title">Neraca Percobaan<?php
					$pdata = $this->session->userdata('session_data'); //Retrive ur session

						$tahun = $pdata['ses_tahun_buku'];
						echo " Per 31/12/".$tahun;
					?></h3>
				</div>
				<div class="box-body">
					<table width="100%" id="dtcustomt" class="table table-striped table-bordered table-hover">
						<thead>
							<th>Nomor</th>
							<th>Kode Akun</th>
							<th>Nama Akun</th>
							<th colspan=2>Saldo Awal</th>
							<th colspan=2>Mutasi</th>
							<th colspan=2>Saldo Akhir</th>
						</thead>
						<thead>
							<th></th>
							<th></th>
							<th></th>
							<th>Debet</th>
							<?php /*<th>Posisi</th> <th>Tanggal Dibuat</th> <th>Tanggal Diubah</th>*/?>
							<th>Kredit</th>
							<th>Debet</th>
							<?php /*<th>Posisi</th> <th>Tanggal Dibuat</th> <th>Tanggal Diubah</th>*/?>
							<th>Kredit</th>
							<th>Debet</th>
							<?php /*<th>Posisi</th> <th>Tanggal Dibuat</th> <th>Tanggal Diubah</th>*/?>
							<th>Kredit</th>
						</thead>
						<tbody>
							<?php 
							$tot_debetmin = 0;
							$tot_kreditmin = 0;
							$tot_debet = 0;
							$tot_kredit = 0;
							$tot_debetz = 0;
							$tot_kreditz = 0;
							$no=0;foreach ($akun as $b)
							{
							    //if($b->kode_akun=='311') die("Ada");
								if($b->debet != 0 || $b->kredit != 0 || $b->debet_coa !=0 || $b->kredit_coa != 0 || $b->debet_min !=0 || $b->kredit_min != 0){
								$nama_akun = $b->level==0 ? '<b>'.$b->nama_akun.'</b>' : $b->nama_akun;
								$kode_akun = $b->level==0 ? '<b>'.$b->kode_akun.'</b>' : $b->kode_akun;
								$saldo_normal   = $b->saldo_normal=="D"?"Debet":"Kredit";
								$lokasi         = $b->lokasi=="Neraca"?"Neraca":"Profit and Loss";
								if($b->level==1){
									$sign = '-';
								}else if($b->level==2){
									$sign = '--';	
								}else if($b->level==3){
									$sign = '---';	
								}else if($b->level==4){
									$sign = '----';	
								}else if($b->level==5){
									$sign = '-----';	
								}else if($b->level==6){
									$sign = '------';	
								}else if($b->level==7){
									$sign = '-------';	
								}else{
									$sign = '';
								}
								if($b->aktif=="A")
								{
									echo '<tr>';
								}
								else
								{
									echo '<tr class="danger">';
								}
								echo '<td>'.++$no.'</td>';
								echo '<td>'.$kode_akun.'</td>';
								echo '<td>'.$sign.'-'.$nama_akun.'</td>';
								
								if($b->saldo_normal=='D'){
								    if($b->debet>0){
								        if($b->debet_coa > 0){
								            echo '<td align="right">'.number_format($b->debet_min).'</td>';
            								echo '<td align="right">'.number_format($b->kredit_min).'</td>';
								            $tot_debetmin = $tot_debetmin + $b->debet_min;
								            $tot_kreditmin = $tot_kreditmin + $b->kredit_min;
            								echo '<td align="right">'.number_format($b->debet - $b->kredit).'</td>';
            								
								            $tot_debet = $tot_debet + $b->debet - $b->kredit;
								            
            								echo '<td align="right"></td>';
            								echo '<td align="right">'.number_format($b->debet_min + $b->debet - $b->kredit).'</td>';
            								$tot_debetz = $tot_debetz + $b->debet_min + $b->debet - $b->kredit;
            								echo '<td align="right"></td>';
								        } else {
								            echo '<td align="right">-</td>';
            								echo '<td align="right">-</td>';
            								echo '<td align="right">-</td>';
            								echo '<td align="right">-</td>';
            								echo '<td align="right">-</td>';
            								echo '<td align="right">-</td>';
								        }
								    } else { 
								        if($b->kredit_coa > 0){
    								        echo '<td align="right">'.number_format($b->debet_min).'</td>';
    								        echo '<td align="right">'.number_format($b->kredit_min).'</td>';
    								        $tot_debetmin = $tot_debetmin + $b->debet_min;
								            $tot_kreditmin = $tot_kreditmin + $b->kredit_min;
    								        echo '<td align="right"></td>';
            								echo '<td align="right">'.number_format($b->kredit - $b->debet).'</td>';
            								$tot_kredit = $tot_kredit + $b->kredit - $b->debet;
            								echo '<td align="right">'.number_format($b->debet_min - $b->kredit + $b->debet).'</td>';
            								$tot_debetz = $tot_debetz + $b->debet_min - $b->kredit + $b->debet;
            								echo '<td align="right"></td>';
								        } elseif($b->debet_coa = 0) {
								            
								            echo '<td align="right">'.number_format($b->debet_min).'</td>';
    								        echo '<td align="right">'.number_format($b->kredit_min).'</td>';
    								        $tot_debetmin = $tot_debetmin + $b->debet_min;
								            $tot_kreditmin = $tot_kreditmin + $b->kredit_min;
    								        echo '<td align="right"></td>';
            								echo '<td align="right">'.number_format($b->kredit - $b->debet).'</td>';
            								$tot_kredit = $tot_kredit + $b->kredit - $b->debet;
            								echo '<td align="right"></td>';
            								echo '<td align="right">'.number_format($b->kredit_min + $b->kredit + $b->debet).'</td>';
            								$tot_kreditz = $tot_kreditz + $b->kredit_min + $b->kredit + $b->debet;
								        }
								    }
								} else {
								    
								    if($b->kredit>0){
								        if($b->kredit_coa > 0){
								            echo '<td align="right">'.number_format($b->debet_min).'</td>';
            								echo '<td align="right">'.number_format($b->kredit_min).'</td>';
								            $tot_debetmin = $tot_debetmin + $b->debet_min;
								            $tot_kreditmin = $tot_kreditmin + $b->kredit_min;
            								echo '<td align="right"></td>';
            								echo '<td align="right">'.number_format($b->kredit - $b->debet).'</td>';
            								$tot_kredit = $tot_kredit + $b->kredit - $b->debet;
            								echo '<td align="right"></td>';
            								echo '<td align="right">'.number_format($b->debet_min + $b->debet + $b->kredit).'</td>';
            								$tot_kreditz = $tot_kreditz + $b->debet_min + $b->debet + $b->kredit;
								        } else {
								            echo '<td align="right">--</td>';
            								echo '<td align="right">--</td>';
            								echo '<td align="right">--</td>';
            								echo '<td align="right">--</td>';
            								echo '<td align="right">--</td>';
            								echo '<td align="right">--</td>';
								        }
								    } else { 
								        if($b->debet_coa > 0){
    								        echo '<td align="right">'.number_format($b->debet_min).'</td>';
    								        echo '<td align="right">'.number_format($b->kredit_min).'</td>';
    								        $tot_debetmin = $tot_debetmin + $b->debet_min;
								            $tot_kreditmin = $tot_kreditmin + $b->kredit_min;
    								        echo '<td align="right">'.number_format($b->debet - $b->kredit).'</td>';
    								        
            								$tot_debet = $tot_debet + $b->debet - $b->kredit;
            								
            								echo '<td align="right"></td>';
            								echo '<td align="right">'.number_format($b->kredit_min + $b->debet - $b->kredit).'</td>';
            								$tot_debetz = $tot_debetz + $b->kredit_min + $b->debet - $b->kredit;
            								echo '<td align="right"></td>';
								        } else {
								            echo '<td align="right">---</td>';
            								echo '<td align="right">'.number_format($b->kredit_min).'</td>';
    								        $tot_debetmin = $tot_debetmin + $b->debet_min;
								            $tot_kreditmin = $tot_kreditmin + $b->kredit_min;
            								echo '<td align="right">---</td>';
            								echo '<td align="right">---</td>';
            								echo '<td align="right">---</td>';
            								echo '<td align="right">'.number_format($b->kredit_min - $b->kredit).'</td>';
            								$tot_kreditz = $tot_kreditz + $b->kredit_min - $b->kredit;
								        }
								    }
								    
								   
								
        								
								
    								
								}
								?>
							
								<?php echo '</tr>';
							} 
							
							} ?>
							
							<tr>
							<td></td>
							<td></td>
							<td></td>
							<td align="right"><?php echo number_format($tot_debetmin);?></td>
							
							<td align="right"><?php echo number_format($tot_kreditmin);?></td>
							<td align="right"><?php echo number_format($tot_debet);?></td>
							<td align="right"><?php echo number_format($tot_kredit);?></td>
							<td align="right"><?php echo number_format($tot_debetz);?></td>
							<td align="right"><?php echo number_format($tot_kreditz);?></td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
