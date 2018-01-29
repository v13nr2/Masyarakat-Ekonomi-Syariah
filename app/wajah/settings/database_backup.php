<section class="content-header">
	<div class="row">
		<div class="col-md-4">
			<label class="label-header"><?=$judul?></label>
		</div>
		<div class="col-md-8">
			<div class="pull-right">
            <a href="<?=base_url('database_backup/db_backup')?>" class="btn btn-sm btn-success"><img src="<?=base_url('assets/resources/add.png');?>" /> database backup</a>
				<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                restore database
            </button>
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
							<th>Tanggal</th>
							<th>File Name</th>
							<th>Opsi</th>
						</thead>
						<tbody>
							<?php if (isset($backups)) {
								 arsort($backups);
								 foreach ($backups as $file):
									  $filename = explode("_", $file);
									  ?>

									  <tr>
											<td><?php echo str_replace('.zip', '', $filename[1]); ?><?php echo str_replace('.zip', '', $filename[2]); ?></td>
											<td><?php echo str_replace('-', ' ', $filename[0]); ?></td>
											<td>
												 <a data-toggle="tooltip" data-placement="top" class="btn btn-purple btn-xs"  href="<?= base_url() ?>database_backup/download_backup/<?= $file ?>"title="download"><i class="fa fa-download"></i></a>
												 <a data-toggle="tooltip" data-placement="top" class="btn btn-purple btn-xs"  href="<?= base_url() ?>database_backup/delete_backup/<?= $file ?>"title="Delete"><i class="fa fa-trash"></i></a>
											</td>
									  </tr>

								 <?php endforeach;
							} else { ?>
								 <tr>
									  <td colspan="4">application_no_backups</td>
								 </tr>
							<?php } ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-default">
	  <div class="modal-dialog">
		  <form id="form"action="<?php echo base_url() ?>database_backup/restore_database"	method="post" enctype="multipart/form-data" class="form-horizontal">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Default Modal</h4>
	      </div>

				 <div class="panel-body">
					  <br/>
					  <div class="form-group" style="margin-bottom: 0px">
							<label for="field-1"
									 class="col-sm-6 control-label"><?= 'upload' . ' ' . 'database_backup' . ' ' . 'zipped_file' ?></label>
							<div class="col-sm-5">
								 <div class="fileinput fileinput-new"
									   data-provides="fileinput">

									  <span class="btn btn-default btn-file">
										   <span class="fileinput-new"><?= 'choose_file' ?></span>
											<span class="fileinput-exists"><?= 'change' ?></span>
											<input type="file" name="upload_file">
										</span>
									  <span class="fileinput-filename"></span>
									  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none;">&times;</a>
								 </div>
								 <div id="msg_pdf" style="color: #e11221"></div>
							</div>
					  </div>
				 </div>

	      <div class="modal-footer">
	        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
	        <button type="submit" name="send" class="btn btn-primary" value="upload">Save changes</button>
	      </div>
	    </div>
	    <!-- /.modal-content -->
		 </form>
	  </div>
	  <!-- /.modal-dialog -->
	</div>
</section>
