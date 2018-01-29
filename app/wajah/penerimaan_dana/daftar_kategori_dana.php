<section class="content-header">
	<div class="row">
		<div class="col-md-4">
			<label class="label-header"><?=$judul?></label>
		</div>
		<div class="col-md-8">
			<div class="pull-right">
				<a href="<?=base_url('penerimaan_dana/tambah')?>" class="btn btn-sm btn-success"><img src="<?=base_url('assets/resources/add.png');?>" /> Tambah</a>
			</div>
		</div>
	 </div>
 </section>
 <section class="content">
	 <div class="row">
		 <div class="col-lg-12">
			 <?php if($this->session->userdata($this->config->item('ses_message'))) {echo $this->session->userdata($this->config->item('ses_message')); $this->session->unset_userdata($this->config->item('ses_message')); } ?>
			<div class="box box-primary">
				
				<div class="box-body">
					<table width="100%" id="dtcustomt" class="table table-striped table-bordered table-hover">
						<thead>
							<th>Kategori Penerimaan Dana</th>
							<th>Jenis Dana</th>
							<th>Penyedia</th>
							<th>Nilai</th>
							<th>Opsi</th>
						</thead>
						<tbody>
							<?php foreach ($kategori_dana as $b)
							{
								echo '<td width="30%">'.$b->kategori_penyedia_dana.'</td>';
								echo '<td width="30%">'.$b->kategori_dana.'</td>';
								echo '<td width="30%">'.$b->penyedia.'</td>';
								echo '<td width="30%">'.number_format($b->nilai).'</td>';
								echo '<td align="center" width="10%">'; ?>
								<a href="<?=base_url()?>penerimaan_dana/ubah/<?=md5($b->id)?>" title="Ubah Penyaluran dana" data-toggle="tooltip"><img src="<?=base_url();?>assets/resources/edit.png" /></a>
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
