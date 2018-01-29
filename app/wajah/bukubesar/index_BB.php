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
					<h3 class="box-title">BUKU BESAR<?php
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
							<th>Saldo Normal</th>
							<th>View</th>
						</thead>
						<tbody>
							<?php $no=0;foreach ($akun as $b)
							{
								if($b->debet != 0 || $b->kredit != 0){
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
								echo '<td>'.$saldo_normal.'</td>';
								echo '<td><a href="'. site_url('buku_Besar/detail/'.$b->kode_akun) .'">VIEW</a></td>';
								?>
							
								<?php echo '</tr>';
							} } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
