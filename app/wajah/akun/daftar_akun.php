<section class="content-header">
	<div class="row">
		<div class="col-md-3">
			<label class="label-header"></label>
		</div>
		<div class="col-md-9">
			<div class="pull-right">
				<a href="<?=base_url()?>akun/tambah" class="btn btn-sm btn-success"><img src="<?=base_url('assets/resources/add.png');?>" /> Tambah</a>
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
					<h3 class="box-title">Daftar Akun (COA)</h3>
				</div>
				<div class="box-body">
					<table width="100%" id="dtcustomt" class="table table-striped table-bordered table-hover">
						<thead>
							<th>Kode Akun</th>
							<th>Nama Akun</th>
							<th>Induk Akun</th>
							<th>Tipe Akun</th>
							<th>Saldo Normal</th>
							<th>Lokasi</th>
							<?php /*<th>Posisi</th> <th>Tanggal Dibuat</th> <th>Tanggal Diubah</th>*/?>
							<th>Opsi</th>
						</thead>
						<tbody>
							<?php foreach ($akun as $b)
							{
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
								echo '<td>'.$b->induk_akun.'</td>';
								echo '<td>'.$b->nama_tipe_akun.'</td>';
								echo '<td>'.$saldo_normal.'</td>';
								echo '<td>'.$lokasi.'</td>';
								/*echo '<td class="text-right">'.$b->posisi.'</td>';
								//echo '<td class="text-right">'.$b->tgl_dibuat.'</td>';
								//echo '<td class="text-right">'.$b->tgl_diubah.'</td>';*/
								echo '<td align="center">'; ?>
								<a href="<?=base_url()?>akun/ubah/<?=md5($b->id_akun)?>" title="Ubah Akun" data-toggle="tooltip"><img src="<?=base_url();?>assets/resources/edit.png" /></a>
								<?php if($b->aktif=="A") { ?>
									<a href="<?=base_url()?>akun/hapus/<?=md5($b->id_akun)?>" title="Hapus Akun" data-toggle="tooltip"><img src="<?=base_url();?>assets/resources/hapus.png" onclick="return confirm('Anda yakin ingin menghapus akun <?=$b->nama_akun?> ?')" /></a>
									<?php
								}
								else
								{ ?>
									<a href="<?=base_url()?>akun/aktif/<?=md5($b->id_akun)?>" title="Aktifkan Akun" data-toggle="tooltip"><img src="<?=base_url();?>assets/resources/check.png" onclick="return confirm('Anda yakin ingin mengaktifkan akun <?=$b->nama_akun?> ?')" /></a>
									<?php
								} ?>
								<?php echo '</td>'; echo '</tr>';
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
