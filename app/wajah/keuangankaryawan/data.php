<section class="content-header">
	<div class="row">
		<div class="col-md-7">
			<label class="label-header"><?=$judul?></label>
		</div>
		<div class="col-md-5">
			<div class="pull-right">
				<a href="<?=base_url('keuangankaryawan/tambah')?>" class="btn btn-sm btn-success"><img src="<?=base_url('assets/resources/add.png');?>" /> Tambah</a>
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
					<i class="fa fa-user"></i>
					<h3 class="box-title"><?=$judul?></h3>
				</div>
				<div class="box-body">
					<table width="100%" id="dtcustomt" class="table table-striped table-bordered table-hover">
						<thead>
							<th>Nama Parameter</th>
							<th>GL Debet</th>
							<th>GL Kredit</th>
							<th>Keterangan</th>
							<th style="width: 80px; text-align: center;">Aksi</th>
						</thead>
						<tbody>
							<?php foreach ($keu as $b)
							{
								echo '<td>'.$b->nama_keuangan.'</td>';
								echo '<td>'.$b->gl_debet.'</td>';
								echo '<td>'.$b->gl_kredit.'</td>';
								echo '<td>'.$b->keterangan.'</td>';
								echo '<td align="center" width="10%">'; ?>
								<a href="<?= base_url() ?>keuangankaryawan/ubah?id=<?=md5($b->id)?>" title="Ubah Parameter" data-toggle="tooltip"><img src="<?=base_url();?>assets/resources/edit.png" /></a>

								<?php echo '</td>'; echo '</tr>';
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
