<?php


$barispasiva0 = 1;
$totalpasiva = 0;
$no=0;foreach ($pasiva as $b){
    if($b->debet != 0 || $b->kredit != 0){
    
        $barispasiva0++;
    }
}


?>
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
		<div class="col-md-12">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="<?=base_url('kegiatan')?>">Filter Laporan Utama</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active">
						<form class="form-horizontal" method="get" action="<?=base_url('kegiatan')?>">
							<div class="form-group">
								<label class="col-lg-1 col-xs-12 text-left control-label control-label2">Periode</label>
								<div class="col-lg-2 col-xs-6">
									<select class="form-control selectnot" name="bulan">
										<?php
											echo '<option value="0">-Pilih Bulan-</option>';
										for($i=1;$i<=12;$i++) {
										    if($_GET["bulan"] == $i)
											{
												echo '<option value="'.$i.'" selected>'.bulan($i).'</option>';
											}
											else
											{
												echo '<option value="'.$i.'">'.bulan($i).'</option>';
											}
										}
										?>
									</select>
								</div>
								<div class="col-lg-2 col-xs-6">
									<select class="form-control selectnot" name="tahun">
										<?php 
										echo '<option value="0">-Pilih Tahun-</option>';
										for($i=2015;$i<=date('Y');$i++)
										{
											if($_GET["tahun"] ==$i)
											{
												echo '<option value="'.$i.'" selected>'.$i.'</option>';
											}
											else
											{
												echo '<option value="'.$i.'">'.$i.'</option>';
											}
										}
										?>
									</select>
								</div>
								<div class="col-lg-2 col-xs-6">
									<button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Cari</button>
								</div>
							</div>
						</form>
						<hr/>
						
					</div>
				</div>
			</div>
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
					<h3 class="box-title">Laporan Aktivitas<?php
					$pdata = $this->session->userdata('session_data'); //Retrive ur session

						$tahun = $pdata['ses_tahun_buku'];
						if(isset($_GET["bulan"]) && isset($_GET["tahun"])){
						        
						} else {
						    echo " Per 31/12/".$tahun;
						}
						
					?></h3>
				</div>
				<div class="box-body">
					<table width="100%" id="dtcustomt" class="table table-striped table-bordered table-hover">
						<thead></thead>
							<th>Kode Akun</th>
							<th>Nama Akun</th>
							<th colspan=2></th>
						</thead>
						<thead>
							<th></th>
							<th></th>
							<th></th>
							<?php /*<th>Posisi</th> <th>Tanggal Dibuat</th> <th>Tanggal Diubah</th>*/?>
							<th></th>
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
								echo '<td>'.$kode_akun.'</td>';
								echo '<td>'.$sign.'-'.$nama_akun.'</td>';
								
								if($b->saldo_normal=='D'){
								    if($b->debet>0 || $b->debet_min>0 || $b->debet_min_coa>0){
								        if($b->debet_coa > 0 || $b->debet_min_coa>0){
								            $tot_debetmin = $tot_debetmin + $b->debet_min;
								            $tot_kreditmin = $tot_kreditmin + $b->kredit_min;
            								echo '<td align="right">'.number_format($b->debet - $b->kredit).'</td>';
            								
								            $tot_debet = $tot_debet + $b->debet - $b->kredit;
								            
            								echo '<td align="right"></td>';
            								$tot_debetz = $tot_debetz + $b->debet_min + $b->debet - $b->kredit;
								        } else {
            								echo '<td align="right">-</td>';
            								echo '<td align="right">-</td>';
            								echo '<td align="right">-</td>';
            								echo '<td align="right">-</td>';
								        }
								    } else { 
								        if($b->kredit_coa > 0){
    								        $tot_debetmin = $tot_debetmin + $b->debet_min;
								            $tot_kreditmin = $tot_kreditmin + $b->kredit_min;
    								        echo '<td align="right"></td>';
            								echo '<td align="right">'.number_format($b->kredit - $b->debet).'</td>';
            								$tot_kredit = $tot_kredit + $b->kredit - $b->debet;
            								$tot_debetz = $tot_debetz + $b->debet_min - $b->kredit + $b->debet;
								        } elseif($b->debet_coa = 0) {
								            
    								        $tot_debetmin = $tot_debetmin + $b->debet_min;
								            $tot_kreditmin = $tot_kreditmin + $b->kredit_min;
    								        echo '<td align="right"></td>';
            								echo '<td align="right">'.number_format($b->kredit - $b->debet).'</td>';
            								$tot_kredit = $tot_kredit + $b->kredit - $b->debet;
            								$tot_kreditz = $tot_kreditz + $b->kredit_min + $b->kredit + $b->debet;
								        }
								    }
								} else {
								    
								    if($b->kredit>0 || $b->kredit_coa > 0){
								        if($b->kredit_coa > 0){
								            $tot_debetmin = $tot_debetmin + $b->debet_min;
								            $tot_kreditmin = $tot_kreditmin + $b->kredit_min;
            								echo '<td align="right"></td>';
            								echo '<td align="right">'.number_format($b->kredit - $b->debet).'</td>';
            								$tot_kredit = $tot_kredit + $b->kredit - $b->debet;
            								$tot_kreditz = $tot_kreditz + $b->kredit_min + $b->debet + $b->kredit;
								        } else {
            								echo '<td align="right"><!-- -- --></td>';
            								echo '<td align="right"><!-- -- --></td>';
								        }
								    } else { 
								        if($b->debet_coa > 0){
    								        $tot_debetmin = $tot_debetmin + $b->debet_min;
								            $tot_kreditmin = $tot_kreditmin + $b->kredit_min;
    								        echo '<td align="right">'.number_format($b->debet - $b->kredit).'</td>';
    								        
            								$tot_debet = $tot_debet + $b->debet - $b->kredit;
            								
            								echo '<td align="right"></td>';
            								$tot_debetz = $tot_debetz + $b->kredit_min + $b->debet - $b->kredit;
								        } else {
								            if($b->kredit_coa > 0 || $b->kredit_min_coa>0){
        								        $tot_debetmin = $tot_debetmin + $b->debet_min;
    								            $tot_kreditmin = $tot_kreditmin + $b->kredit_min;
                								echo '<td align="right">---</td>';
                								echo '<td align="right">---</td>';
                								$tot_kreditz = $tot_kreditz + $b->kredit_min - $b->kredit;
                							} else {
                								echo '<td align="right">----</td>';
                								echo '<td align="right">----</td>';
                							}
								        }
								    }
								    
								   
								
        								
								
    								
								}
								?>
							
								<?php echo '</tr>';
							} 
							
							} ?>
							
							<tr>
							<td colspan=2><b>TOTAL PENERIMAAN</b></td>
							<td align="right"><!-- <?php echo number_format($tot_debet);?> --></td>
							<td align="right"><b><?php echo number_format($tot_kredit);?></b></td>
							<?php $totalpenerimaan = $tot_kredit - $tot_debet; ?>
						</tr>
						
						
						<tbody>
							<?php 
							$tot_debetmin = 0;
							$tot_kreditmin = 0;
							$tot_debet = 0;
							$tot_kredit = 0;
							$tot_debetz = 0;
							$tot_kreditz = 0;
							$no=0;foreach ($akun5 as $b)
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
								echo '<td>'.$kode_akun.'</td>';
								echo '<td>'.$sign.'-'.$nama_akun.'</td>';
								
								if($b->saldo_normal=='D'){
								    if($b->debet>0 || $b->debet_min>0 || $b->debet_min_coa>0){
								        if($b->debet_coa > 0 || $b->debet_min_coa>0){
								            $tot_debetmin = $tot_debetmin + $b->debet_min;
								            $tot_kreditmin = $tot_kreditmin + $b->kredit_min;
            								echo '<td align="right">'.number_format($b->debet - $b->kredit).'</td>';
            								
								            $tot_debet = $tot_debet + $b->debet - $b->kredit;
								            
            								echo '<td align="right"></td>';
            								$tot_debetz = $tot_debetz + $b->debet_min + $b->debet - $b->kredit;
								        } else {
								            echo '<td align="right">-</td>';
            								echo '<td align="right">-</td>';
								        }
								    } else { 
								        if($b->kredit_coa > 0){
    								        $tot_debetmin = $tot_debetmin + $b->debet_min;
								            $tot_kreditmin = $tot_kreditmin + $b->kredit_min;
    								        echo '<td align="right"></td>';
            								echo '<td align="right">'.number_format($b->kredit - $b->debet).'</td>';
            								$tot_kredit = $tot_kredit + $b->kredit - $b->debet;
            								$tot_debetz = $tot_debetz + $b->debet_min - $b->kredit + $b->debet;
								        } elseif($b->debet_coa = 0) {
								            
    								        $tot_debetmin = $tot_debetmin + $b->debet_min;
								            $tot_kreditmin = $tot_kreditmin + $b->kredit_min;
    								        echo '<td align="right"></td>';
            								echo '<td align="right">'.number_format($b->kredit - $b->debet).'</td>';
            								$tot_kredit = $tot_kredit + $b->kredit - $b->debet;
            								$tot_kreditz = $tot_kreditz + $b->kredit_min + $b->kredit + $b->debet;
								        }
								    }
								} else {
								    
								    if($b->kredit>0 || $b->kredit_coa > 0){
								        if($b->kredit_coa > 0){
								            echo '<td align="right">'.number_format($b->debet_min).'</td>';
            								echo '<td align="right">'.number_format($b->kredit_min).'</td>';
								            $tot_debetmin = $tot_debetmin + $b->debet_min;
								            $tot_kreditmin = $tot_kreditmin + $b->kredit_min;
            								echo '<td align="right"></td>';
            								echo '<td align="right">'.number_format($b->kredit - $b->debet).'</td>';
            								$tot_kredit = $tot_kredit + $b->kredit - $b->debet;
            								$tot_kreditz = $tot_kreditz + $b->kredit_min + $b->debet + $b->kredit;
								        } else {
								            echo '<td align="right">--</td>';
            								echo '<td align="right">--</td>';
								        }
								    } else { 
								        if($b->debet_coa > 0){
    								        $tot_debetmin = $tot_debetmin + $b->debet_min;
								            $tot_kreditmin = $tot_kreditmin + $b->kredit_min;
    								        echo '<td align="right">'.number_format($b->debet - $b->kredit).'</td>';
    								        
            								$tot_debet = $tot_debet + $b->debet - $b->kredit;
            								
            								echo '<td align="right"></td>';
            								$tot_debetz = $tot_debetz + $b->kredit_min + $b->debet - $b->kredit;
								        } else {
								            if($b->kredit_coa > 0 || $b->kredit_min_coa>0){
    								            echo '<td align="right">---</td>';
                								echo '<td align="right">'.number_format($b->kredit_min).'</td>';
        								        $tot_debetmin = $tot_debetmin + $b->debet_min;
    								            $tot_kreditmin = $tot_kreditmin + $b->kredit_min;
                								echo '<td align="right">---</td>';
                								echo '<td align="right">---</td>';
                								$tot_kreditz = $tot_kreditz + $b->kredit_min - $b->kredit;
                							} else {
                							    echo '<td align="right"><!-- ---- --></td>';
                								echo '<td align="right"><!-- ---- --></td>';
                							}
								        }
								    }
								    
								   
								
        								
								
    								
								}
								?>
							
								<?php echo '</tr>';
							} 
							
							} ?>
							
							<tr>
							<td colspan=2><b>TOTAL BEBAN</b></td>
							<td align="right"><b><?php echo number_format($tot_debet);?></b></td>
							<td align="right"><!-- <?php echo number_format($tot_kredit);?> --></td>
							<?php $totalbeban = $tot_debet - $tot_kredit; ?>
						</tr>
							
							<tr>
							<td colspan=2><b>ASET NETO PERIODE BERJALAN</b></td>
							<td align="right"><b><?php $asetnetoperiodeberjalan = ($totalpenerimaan - $totalbeban); echo number_format($asetnetoperiodeberjalan);?></b></td>
							<td align="right"></td>
						</tr>
						</tbody>
						</tbody>
					</table>
				</div>
				
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
					<h3 class="box-title">Laporan Perubahan Aset Neto<?php
					$pdata = $this->session->userdata('session_data'); //Retrive ur session

						$tahun = $pdata['ses_tahun_buku'];
						if(isset($_GET["bulan"]) && isset($_GET["tahun"])){
						        
						} else {
						    echo " Per 31/12/".$tahun;
						}
						
					?></h3>
				</div>
				<div class="box-body">
					<table width="100%" id="dtcustomt" class="table table-striped table-bordered table-hover">
						<thead>
							<th>Keterangan</th>
							<th>Tidak Terikat</th>
							<th>Terikat Temporer</th>
							<th>Terikat Permanen</th>
							<th>Total</th>
						</thead>
					    <tbody>
					        <tr>
    							<td>ASET NETO PERIODE LALU</td>
    							<td></td>
    						<?php	foreach ($akunAsetNetto as $b)
							{ ?>
    							<td align="right"><?php echo number_format($b->kredit_min);?></td>
    						<?php 
    						    $asetnetoperiodelalu = $b->kredit_min;
    						} ?>
    							<td></td>
    							<td><?php echo number_format($asetnetoperiodelalu);?></td>
    						</tr>
					        <tr>
    							<td>ASET NETO PERIODE BERJALAN</td>
    							<td></td>
    							<td align="right"><?php echo number_format($asetnetoperiodeberjalan);?></td>
    							<td></td>
    							<td><?php echo number_format($asetnetoperiodeberjalan);?></td>
    							</tr>
					        <tr>
    							<td>TOTAL ASET NETO</td>
    							<td></td>
    							<td align="right"><b><?php echo number_format($asetnetoperiodelalu + $asetnetoperiodeberjalan);?></b></td>
    							<td></td>
    							<td><b><?php echo number_format($asetnetoperiodelalu + $asetnetoperiodeberjalan);?></b></td>
    						</tr>
						</tbody>
					</table>
				</div>
				
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
					<h3 class="box-title">LAPORAN POSISI KEUANGAN <?php
					$pdata = $this->session->userdata('session_data'); //Retrive ur session

						$tahun = $pdata['ses_tahun_buku'];
						if(isset($_GET["bulan"]) && isset($_GET["tahun"])){
						        
						} else {
						    echo " Per 31/12/".$tahun;
						}
						
					?></h3>
				</div>
				<div class="box-body">
				<table width="100%">
					<tr>
						<td width="50%"><b></b></td>
						<td width="10">&nbsp;&nbsp;&nbsp;</td>
						<td width="50%"><b></b></td>
					</tr>
					<tr>
						<td width="50%" valign="top">
						
						
						<table width="100%" id="aktiva" class="table table-striped table-bordered table-hover">
								<thead>
									<th>Kode Akun</th>
									<th>Nama Akun</th>
									<th></th>
								</thead>
								<tbody>
									<?php 
									$barisaktiva = 1;
									$totalaktiva = 0;
									$no=0;foreach ($aktiva as $b)
									{
										if($b->debet != 0 || $b->kredit != 0){
										$nama_akun = $b->level==0 ? '<b>'.$b->nama_akun.'</b>' : $b->nama_akun;
										$kode_akun = $b->level==0 ? '<b>'.$b->kode_akun.'</b>' : $b->kode_akun;
										$saldo_normal   = $b->saldo_normal=="D"?"Debet":"Kredit";
										$saldo = ($saldo_normal=="Debet") ? ($b->debet - $b->kredit) : ($b->kredit - $b->debet);
										if(($b->debet_coa > 0 || $b->kredit_coa > 0)){
										    	$saldorp = number_format($saldo);
										} else {
									    	$saldorp = '-';
										}
										if($saldo < 1){
											$saldo =  $saldo * -1 ;
											$saldorp = "(". number_format($saldo). ")";
										}
										if($b->id_parent == 0){
										    
										    $nilai =  ($saldo_normal=="Debet") ? ($b->debet - $b->kredit) : ($b->kredit - $b->debet);
										    $totalaktiva = $totalaktiva +  $nilai;
										}
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
										echo '<td>'.$kode_akun.'</td>';
										echo '<td>'.$sign.'-'.$nama_akun.'</td>';
										
										echo '<td align="right">' . $saldorp .'</td>';
										$barisaktiva++;
										?>
									
										<?php echo '</tr>';
										
									} } 
								
									
									?>
									
											<?php
									if($barisaktiva < $barispasiva0){
									    $tambahbaris2 = $barispasiva0 - $barisaktiva;
									    for($g=0;$g<$tambahbaris2;$g++){
									    ?>
									    
									    
                								<tr>
                								    <td>&nbsp;</td>
                								    <td></td>
                								    <td align="right"></td>
                								</tr>
									    
									    <?php
									    }
									}
									?>
								</tbody>
									
								<tr>
								    <td></td>
								    <td><b>TOTAL</b></td>
								    <td align="right"><b><?php echo number_format($totalaktiva);?></b></td>
								</tr>
							</table>
						
						</td>
						
						<td width="20">&nbsp;&nbsp;&nbsp;</td>
						<td width="50%" valign="top">
						
							<table width="100%" id="pasiva" class="table table-striped table-bordered table-hover">
								<thead>
									<th>Kode Akun</th>
									<th>Nama Akun</th>
									<th></th>
								</thead>
								<tbody>
									<?php 
									
									$barispasiva = 1;
									$totalpasiva = 0;
									$no=0;foreach ($pasiva as $b)
									{
										if($b->debet != 0 || $b->kredit != 0){
										$nama_akun = $b->level==0 ? '<b>'.$b->nama_akun.'</b>' : $b->nama_akun;
										$kode_akun = $b->level==0 ? '<b>'.$b->kode_akun.'</b>' : $b->kode_akun;
										$saldo_normal   = $b->saldo_normal=="D"?"Debet":"Kredit";
										$saldo = ($saldo_normal=="Kredit") ? ($b->kredit - $b->debet) : ($b->debet - $b->kredit);
										$lokasi         = $b->lokasi=="Neraca"?"Neraca":"Profit and Loss";
										$saldorp = number_format($saldo);
										if(($b->debet_coa > 0 || $b->kredit_coa > 0)){
										    	$saldorp = number_format($saldo);
										} else {
									    	$saldorp = '-';
										}
										if($b->id_parent == 0){
										    
										    $nilaipasiva = ($saldo_normal=="Kredit") ? ($b->kredit - $b->debet) : ($b->debet - $b->kredit);
										    $totalpasiva = $totalpasiva +  $nilaipasiva;
										}
										
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
										echo '<td>'.$kode_akun.'</td>';
										echo '<td>'.$sign.'-'.$nama_akun.'</td>';
										echo '<td align="right">'.$saldorp.'</td>';
										$barispasiva++;
										?>
									
										<?php echo '</tr>';
										
									} } 
									
									
								
									
									?>
									
									
									    
                							
								<tr>
								    <td>&nbsp;</td>
								    <td></td>
								    <td align="right"></b></td>
								</tr>
                							
								<tr>
								    <td>311</td>
								    <td>ASET NETO TERIKAT</td>
								    <td align="right"><?php $asetnettoterikat = $asetnetoperiodelalu + $asetnetoperiodeberjalan;
								            echo number_format($asetnettoterikat);
								        ?>
								        </b></td>
								</tr>
								<?php
								
                								if($barisaktiva > $barispasiva){
            									    $tambahbaris = $barisaktiva - $barispasiva - 2;
            									    for($i=0;$i<$tambahbaris;$i++){
            									    ?>
            									    
            									    
                            								<tr>
                            								    <td>&nbsp;</td>
                            								    <td></td>
                            								    <td align="right"></td>
                            								</tr>
            									    
            									    <?php
            									    }
            									} ?>
								<tr>
								    <td></td>
								    <td><b>TOTAL</b></td>
								    <td align="right"><b><?php echo number_format($totalpasiva + $asetnettoterikat);?></b></td>
								</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</table>
					
				</div>
			</div>
		</div>
	</div>
</section>