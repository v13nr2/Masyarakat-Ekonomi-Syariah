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
					<h3 class="box-title">NERACA <?php
					$pdata = $this->session->userdata('session_data'); //Retrive ur session

						$tahun = $pdata['ses_tahun_buku'];
						echo "Per 31/12/".$tahun;
					?></h3>
				</div>
				<div class="box-body">
				<table width="100%">
					<tr>
						<td width="50%"><b>AKTIVA</b></td>
						<td width="10">&nbsp;&nbsp;&nbsp;</td>
						<td width="50%"><b>PASIVA</b></td>
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
										$saldorp = number_format($saldo);
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
										if($saldo < 1){
											$saldo =  $saldo * -1 ;
											$saldorp = "(". number_format($saldo). ")";
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
									
									
									if($barisaktiva > $barispasiva){
									    $tambahbaris = $barisaktiva - $barispasiva + 1;
									    for($i=0;$i<$tambahbaris;$i++){
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
									
								<tr>
								    <td></td>
								    <td><b>TOTAL</b></td>
								    <td align="right"><b><?php echo number_format($totalpasiva);?></b></td>
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
