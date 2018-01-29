<section class="content-header">
	<div class="row">
		<div class="col-md-3">
			<label class="label-header"><?=$judul?></label>
		</div>
		<div class="col-md-9">
			<div class="pull-right">
				<a href="<?=base_url('pengguna/tambah')?>" class="btn btn-sm btn-success"><img src="<?=base_url('assets/resources/add.png');?>" /> Tambah</a>
			</div>
		</div>
	</div>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<?php if($this->session->userdata($this->config->item('ses_message')))
			{
				echo $this->session->userdata($this->config->item('ses_message'));
				 $this->session->unset_userdata($this->config->item('ses_message'));
			 }
			 ?>
			 <div class="box box-primary">
				 <div class="box-header">
					 <i class="fa fa-user"></i>
					 <h3 class="box-title"><?=$judul?></h3>
				 </div>
				 <div class="box-body">
					 <table width="100%" id="dtcustomt" class="table table-striped table-bordered table-hover">
						 <thead>
							 <th>Nama</th>
							 <th>Email</th>
							 <th>Wewenang</th>
							 <th>Pengurus</th>
							 <th>Tanggal Dibuat</th>
							 <th>Terakhir Login</th>
							 <th>Opsi</th>
						 </thead>
						 <tbody>
							 <?php foreach ($pengguna as $b)
							 {
								 echo '<td width="30%">'.$b->nama.'</td>';
								 echo '<td width="30%">'.$b->email.'</td>';
								 echo '<td width="10%">'.$b->cizacl_role_name.'</td>';
								 echo '<td width="30%">'.$b->pengurus.'</td>';
								 echo '<td width="15%">'.$b->dibuat.'</td>';
								 echo '<td width="15%">'.$b->terakhir.'</td>';
								 echo '<td align="center" width="10%">'; ?>
									 <a href="<?=base_url()?>pengguna/ubah/<?=md5($b->koderahasia)?>" title="Ubah Pengguna" data-toggle="tooltip"><img src="<?=base_url();?>assets/resources/edit.png" /></a>
									 <?php
								 echo '</td>';
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
