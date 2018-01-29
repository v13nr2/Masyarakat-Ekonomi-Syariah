<section class="content-header">
	<div class="row">
		<div class="col-md-3">
			<label class="label-header"><?=$judul?></label>
		</div>
		<div class="col-md-9">
			<div class="pull-right">
				<a href="<?=base_url('tutupbuku/proses')?>" class="btn btn-sm btn-success"><img src="<?=base_url('assets/resources/add.png');?>" /> Tambah</a>
			</div>
		</div>
	</div>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<?php if($this->session->userdata($this->config->item('ses_message'))) {echo $this->session->userdata($this->config->item('ses_message')); $this->session->unset_userdata($this->config->item('ses_message')); } ?>
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-recycle"></i>
					<h3 class="box-title">Daftar Tutup Buku</h3>
				</div> <div class="box-body">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dtcustomt">
						<thead>
							<th>Periode</th>
							<th>Dilakukan Oleh</th>
							<th>Tanggal Proses</th>
							<th>Aktif</th>
						</thead>
						<tbody>
							<?php foreach ($tutup as $b) {
								echo '<tr>';
								echo '<td width="35%" class="text-right">'.tgl_indo($b->awal).' s/d '.tgl_indo($b->akhir).'</td>';
								echo '<td>'.$b->nama.'</td>';
								echo '<td>'.$b->tgl_dibuat.'</td>';
								echo '<td>'.$b->statusx.'</td>';
								echo '</tr>';
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
