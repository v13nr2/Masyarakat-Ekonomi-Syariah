<section class="content-header">
	<div class="row">
		<div class="col-md-5">
			<label class="label-header">Daftar Dokumentasi</label>
		</div>
		<div class="col-md-7">
			<div class="pull-right">
				<a href="<?=base_url('dokumentasi/add')?>" class="btn btn-sm btn-success"><img src="<?=base_url('assets/resources/add.png');?>" /> Tambah</a>
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
					<h3 class="box-title">Daftar Dokumentasi</h3>
				</div>
				<div class="box-body">
					<table width="100%" id="dtcustomt" class="table table-striped table-bordered table-hover">
						<thead>
							<th>Nama Modul</th>
							<th>Penjelasan</th>
							<th>Akses Menu</th>
							<th>Level Pengguna</th>
							<th>Foto</th>
							<th>Opsi</th>
						</thead>
						<tbody>
							<?php foreach($query as $rowdata)
							{
								echo '<td width="20%">'.$rowdata->nama_modul .'</td>';
								echo '<td width="30%">'.$rowdata->penjelasan_modul .'</td>';
								echo '<td width="15%">'.$rowdata->akses_menu .'</td>';
								echo '<td width="25%">'.$rowdata->level_pengguna .'</td>';
								echo '<td align="center" width="10%">'; 
								if($rowdata->nm_gbr !=""){
								?>
								 <img src="assets/uploads/<?php echo $rowdata->nm_gbr;?>" height="100px">
								<?php } echo '</td>';
								echo '<td align="center" width="10%">'; ?>
								<a href="<?=base_url()?>dokumentasi/ubah/<?=md5($rowdata->id)?>" title="Ubah Dokumentasi" data-toggle="tooltip"><img src="<?=base_url();?>assets/resources/edit.png" /></a>
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
