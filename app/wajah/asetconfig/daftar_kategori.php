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
				 <a href="<?=base_url()?>asetconfig/kategori_add"  ><img src="<?php echo base_url().'assets/images/icon/add.png';?>" height="50px" title="Tambah Kategori Aset"></a>
				 <a href="<?=base_url()?>asetconfig"  ><img src="<?php echo base_url().'assets/images/icon/config.png';?>" height="50px" title="Configurasi Aset"></a>
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
									<th width="70%">Jenis Aset</th>
									<th>status</th>
									<th>Opsi</th> </thead>
									<tbody>
										<?php foreach ($kategori as $b)
										{
											echo '<tr>';
											echo '<td>'.$b->jenis.'</td>';
											echo '<td>'.$b->status.'</td>';
											echo '<td align="center">';
											echo '<a data-toggle="tooltip" href="'.base_url('asetconfig/kategori_ubah/'.$b->id).'" title="Ubah '.$b->jenis.'" class="btn btn-success btn-xs">Ubah</a>';
											echo '</td>'; echo '</tr>';
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
