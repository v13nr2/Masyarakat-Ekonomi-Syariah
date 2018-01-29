<section class="content-header">
	<div class="row">
		<div class="col-md-5">
			<label class="label-header">Tambah Organisasi</label>
		</div>
	</div>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-user"></i>
					<h3 class="box-title">Tambah Organisasi</h3>
				</div>
				<div class="box-body">
						
					<?php // echo $error;
					?>
 
					<?php echo form_open_multipart('upload/aksi_upload');?>
							
							  <div class="form-group">
								  <label for="imagetitle">Image Title</label>
								  <input type="text" class="form-control" name="nama_organisasi" id="nama_organisasi" placeholder="Nama Organisasi" required="required">
								</div>
							   <div class="control-group form-group">
										<div class="controls">
											<label>Upload Photo:</label>
											<input name="berkas" type="file"  id="image_file" required>
											<p class="help-block"></p>
										</div>
							   </div>
						   
						<div class="form-group">
							<div class="col-lg-3"></div>
							<div class="col-lg-4">
								<button type="submit" value="simpan" name="btnSimpan" class="btn btn-success btn-min"><i class="fa fa-save"></i> Simpan</button>
								<?=anchor('donatur', '<i class="fa fa-angle-left"></i> Kembali', array('class'=>'btn btn-danger btn-min'))?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
