<section class="content-header">
	<div class="row">
		<div class="col-md-6">
			<label class="label-header"><?=$judul?></label>
		</div>
	</div>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<form autocomplete="off" method="GET">
				<div class="box box-primary">
					<div class="box-header">
						<i class="fa fa-files-o"></i>
						<h3 class="box-title">Daftar Hutang</h3>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="col-md-2">
									<div class="form-group">
										<label for="start_date">Tanggal Awal</label>
										<input type="text" name="tanggal_awal" id="tanggal_awal" class="form-control mulai" value="<?=$tanggal_awal?>" onkeypress="return false" readonly="" placeholder="Tanggal Awal (22-08-2011)" />
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="start_date">Tanggal Akhir</label>
										<input type="text" name="tanggal_akhir" id="tanggal_akhir" class="form-control selesai" value="<?=$tanggal_akhir?>" onkeypress="return false" readonly="" placeholder="Tanggal Akhir  (31-08-2011)" />
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="start_date">No Jurnal</label>
										<input type="text" name="no_jurnal" id="no_jurnal" class="form-control" value="<?=$no_jurnal?>" placeholder="No Jurnal" />
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="start_date">Status Konfirmasi</label>
										<input type="text" name="status" placeholder="Status Konfirmasi" id="status" class="form-control" value="<?=$dikonfirmasi?>"  />
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-4 col-xs-10">
									<button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> Cari</button>
									<button type="submit" name="btnreset" value="reset" class="btn btn-danger btn-sm"><i class="fa fa-refresh"></i> Reset</button> <a href="<?=base_url()?>piutang" class="btn btn-sm btn-header btn-success"><img src="<?=base_url();?>assets/resources/add.png" /> Buat Jurnal Baru</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
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
									<th width="10%">Tgl Jurnal</th>
									<th>Kreditur</th>
									<th>No Bukti</th>
									<th>Memo</th>
									<th>Tanggal Dibuat</th>
									<th>Jumlah</th>
									<th>Opsi</th> </thead>
									<tbody>
										<?php foreach ($jurnal as $b)
										{
											echo '<tr>';
											echo '<td  class="text-right">'.date_format(date_create($b->tgl_jurnal), 'd-m-Y').'</td>';
											echo '<td><a href="'.base_url('jurnal/detail/'.$b->kode_unik).'">'.$b->debitur.'</a></td>';
											echo '<td>'.$b->no_bukti.'</td>'; echo '<td>'.$b->memo.'</td>';
											echo '<td class="text-right">'.$b->tgl_dibuat.'</td>';
											echo '<td class="text-right">'.number_format($b->debet).'</td>';
											echo '<td align="center">';
											echo '<a data-toggle="tooltip" href="'.base_url('jurnal/detail/'.$b->kode_unik).'" title="Detail '.$b->no_jurnal.'" class="btn btn-success btn-xs">Detail</a>';
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
