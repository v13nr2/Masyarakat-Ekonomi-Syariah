<section class="content-header">
	<div class="row">
		<div class="col-md-5">
			<label class="label-header"><?=$judul?></label>
		</div>
	</div>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<?php if($errors!=""){ echo $errors; } if(validation_errors() != false) {echo alert_php2('', 'validate', validation_errors()); } $tmp_id = md5($this->session->userdata($this->config->item('ses_id'))); ?>
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-user"></i>
					<h3 class="box-title">Data <?=$judul?> Anda</h3>
				</div>
				<div class="box-body">
					<form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url()?>pengguna/ubah/<?=$tmp_id?>">
						<div class="form-group">
							<label class="control-label col-lg-2">Nama Pengguna</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="nama" maxlength="50" id="nama" value="<?=$pengguna["nama"]?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Email Pengguna</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="email" maxlength="50" id="email" value="<?=$pengguna["email"]?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Kata Sandi</label>
							<div class="col-lg-4">
								<input type="password" class="form-control" name="katasandi" maxlength="50" id="katasandi" value="" />
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2"></div>
							<div class="col-lg-4">
								<button type="submit" value="simpan" name="btnSimpan" class="btn btn-success btn-min"><i class="fa fa-save"></i> Simpan</button>
								<?=anchor('pengguna', '<i class="fa fa-angle-left"></i> Kembali', array('class'=>'btn btn-danger btn-min'))?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
