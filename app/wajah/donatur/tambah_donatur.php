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
			<?php if($errors!=""){ echo $errors; } if(validation_errors() != false) {echo alert_php2('', 'validate', validation_errors()); } ?>
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-user"></i>
					<h3 class="box-title"><?=$judul?></h3>
				</div>
				<div class="box-body">
					<form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url('donatur/tambah')?>"  enctype="multipart/form-data">
					<div class="form-group">
							<label class="control-label col-lg-3">Foto</label>
							<div class="col-sm-4">
								<input type="file" name="filefoto" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">Nama Donatur</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="nama" maxlength="50" id="nama" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">Alamat Donatur</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="alamat" maxlength="50" id="alamat" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">HP</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" name="hp" maxlength="50" id="hp" value="" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">Email</label>
							<div class="col-lg-4">
								<input type="email" class="form-control" name="email" maxlength="50" id="email" value="" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">NPWP</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="npwp" maxlength="50" id="hp" value="" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">Nomor Rekening</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="norek" maxlength="50" id="hp" value="" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">Kategori Penyedia Dana</label>
							<div class="col-lg-4">
								<select class="form-control selectnot" data-validetta="required" name="tipe" data-placeholder="pilih tipe penyedia">
								<option value=""></option>
										<?php foreach ($tipepenyedia as $tp) { echo '<option value="'.$tp->id.'">' . $tp->kategori_penyedia.'<option>'; } ?>
								<select>
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
