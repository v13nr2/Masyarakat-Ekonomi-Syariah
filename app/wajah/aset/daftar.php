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
				 <a href="<?=base_url()?>aset/tambah"  ><img src="<?php echo base_url().'assets/images/icon/add.png';?>" height="50px" title="Tambah Aset"></a>
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
									<th width="10%">Tgl Beli</th>
									<th>Nama Barang</th>
									<th>Nilai</th>
									<th>Tarif</th>
									<th>Susut/Tahun</th>
									<th>Akhir Periode</th>
									<th>Opsi</th> </thead>
									<tbody>
										<?php foreach ($aset as $b)
										{
											echo '<tr>';
											echo '<td  class="text-right">'.date_format(date_create($b->tgl), 'd-m-Y').'</td>';
											echo '<td>'.$b->nama.'</td>';
											echo '<td>'.number_format($b->nilai,2,",",".").'</td>'; echo '<td>'.number_format($b->tarif,2,",",".").'</td>';
											echo '<td class="text-right">'.number_format($b->susut,2,",",".").'</td>';
											echo '<td class="text-right">'.date_format(date_create($b->mano_post), 'd-m-Y').'</td>';
											echo '<td align="center">';
											echo '<a data-toggle="tooltip" href="'.base_url('aset/detail/'.$b->id).'" title="Detail '.$b->nama.'" class="btn btn-success btn-xs">Detail</a>';
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
