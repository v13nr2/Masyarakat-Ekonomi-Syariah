<section class="content-header">
	<div class="row">
		<div class="col-md-3">
			<label class="label-header"><?=$judul?></label>
		</div>
	</div>
</section>
<section class="content">
	<?php
		echo '<div class="row">';
		echo '<div class="col-lg-12">';
		echo alert_php2('', 'info', '<b>Tipe Akun</b> sudah kami default.');
		echo '</div>';
		echo '</div>';
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-compress"></i>
					<h3 class="box-title">Daftar Tipe Akun</h3>
				</div>
				<div class="box-body">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dtcustomt">
						<thead>
							<th>Kode</th>
							<th>Tipe Akun</th>
							<th>Keterangan</th>
							<th>Tanggal Dibuat</th>
							<th>Tanggal Diubah</th>
						</thead>
						<tbody>
							<?php foreach ($tipeakun as $b) {
								echo '<tr>';
								echo '<td>'.$b->kode_tipe_akun.'</td>';
								echo '<td>'.$b->nama_tipe_akun.'</td>';
								echo '<td>'.$b->keterangan.'</td>';
								echo '<td class="text-right">'.$b->tgl_dibuat.'</td>';
								echo '<td class="text-right">'.$b->tgl_diubah.'</td>';
								echo '</tr>';
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
