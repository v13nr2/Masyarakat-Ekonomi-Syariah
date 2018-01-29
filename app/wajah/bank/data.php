<section class="content-header">
	<div class="row">
		<div class="col-md-5">
			<label class="label-header"><?=$judul?></label>
		</div>
		<div class="col-md-7">
			<div class="pull-right">
				<a href="<?=base_url('Bank/tambah')?>" class="btn btn-sm btn-success"><img src="<?=base_url('assets/resources/add.png');?>" /> Tambah</a>
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
							<th>Kode Bank</th>
							<th>Nama Bank</th>
							<th>Cabang</th>
							<th>Atas Nama</th>
							<th>No Rekening</th>
							<th>Jenis Rekening</th>
							<th style="width: 80px; text-align: center;">Aksi</th>
						</thead>
						<tbody>
							<?php foreach ($bank as $b)
							{
								echo '<td>'.$b->kode.'</td>';
								echo '<td>'.$b->bank.'</td>';
								echo '<td>'.$b->cabang.'</td>';
								echo '<td>'.$b->atas_nama.'</td>';
								echo '<td>'.$b->no_rek.'</td>';
								echo '<td>'.$b->jenis.'</td>';
								echo '<td align="center" width="10%">'; ?>
								<a href="<?= base_url() ?>Bank/ubah?id=<?=md5($b->id)?>" title="Ubah Konfig" data-toggle="tooltip"><img src="<?=base_url();?>assets/resources/edit.png" /></a>

								<a onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')" href="<?= base_url() ?>Bank/hapus?id=<?=md5($b->id)?>" title="Hapus Konfig" data-toggle="tooltip"><img src="<?=base_url();?>assets/resources/hapus.png" /></a>
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
