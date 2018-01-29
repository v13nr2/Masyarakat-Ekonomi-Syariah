<section class="content-header">
	<div class="row">
		<div class="col-md-5">
			<label class="label-header"><?=$judul?></label>
		</div>
		<div class="col-md-7">
			<div class="pull-right">
			<?php $pdata = $this->session->userdata('session_data'); //Retrive ur session

					$tb = $pdata['ses_organisasi_id2'];
		?>
				<a href="<?=base_url()?>upload/ubah/<?=md5($tb)?>" class="btn btn-sm btn-success"><img src="<?=base_url('assets/resources/add.png');?>" /> Detail</a>
			</div>
		</div>
	 </div>
 </section>
 
