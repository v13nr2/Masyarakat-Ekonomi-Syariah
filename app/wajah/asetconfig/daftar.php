<section class="content-header">
	<div class="row">
		<div class="col-md-6">
			<label class="label-header"><?=$judul?></label>
		</div>
	</div>
</section>
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				 <a href="<?=base_url()?>asetconfig/tambah"  ><img src="<?php echo base_url().'assets/images/icon/add.png';?>" height="50px" title="Tambah Konfigurasi Aset"></a>
				 <a href="<?=base_url()?>asetconfig/kategori"  ><img src="<?php echo base_url().'assets/images/icon/kategori.png';?>" height="50px" title="List Kategori Aset"></a>
			</div>
		</div>
	</div>
</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-body">
					<div class="row">
						<div class="col-lg-12">
							<table width="100%" id="dtcustomt" class="table table-striped table-bordered table-hover">
								<thead>
									<th>Jenis Barang</th>
									<th>Umur Ekonomis</th>
									<th>Ayt. Jr. Perolehan Aktiva (D)</th>
									<th>Kredit (K)</th>
									<th>Beban Penyusutan (D)</th>
									<th>Akumulasi Penyusutan (K)</th>
									<th>Opsi</th> </thead>
									<tbody>
										<?php foreach ($konfigurasi as $b)
										{
											echo '<tr>';
											echo '<td>'.$b->jenis.'</td>';
											echo '<td>'.$b->bagi.'</td>';
											echo '<td>'.$b->rekdebet.'</td>';
											echo '<td>'.$b->rekkredit.'</td>';
											echo '<td>'.$b->rek_d_bbsusut.'</td>';
											echo '<td>'.$b->rek_k_akmsusut.'</td>';
												echo '<td align="center" width="10%">'; ?>
								<a href="<?= base_url() ?>asetconfig/ubah?id=<?=md5($b->id)?>" title="Ubah Konfig" data-toggle="tooltip"><img src="<?=base_url();?>assets/resources/edit.png" /></a>

								<a onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')" href="<?= base_url() ?>asetconfig/hapus?id=<?=md5($b->id)?>" title="Hapus Konfig" data-toggle="tooltip"><img src="<?=base_url();?>assets/resources/hapus.png" /></a>
								<?php echo '</td>'; echo '</tr>';
										} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
