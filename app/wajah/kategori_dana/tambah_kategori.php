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
					<form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url('kategori_dana/tambah')?>">
						<div class="form-group">
							<label class="control-label col-lg-3"> Kategori Dana</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="nama" maxlength="50" id="nama" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">Keterangan</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="keterangan" maxlength="50" id="keterangan" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">GL</label>
							<div class="col-lg-4">
								<select class="form-control"  name="gl">
								    	<option value="">-- Pilih Akun --</option>
									<?php
									foreach($akun as $p){
										
										echo "<option value='$p->kode_akun'>".$p->nama_akun."=>".$p->kode_akun."</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2"></div>
							<div class="col-lg-4">
								<button type="submit" value="simpan" name="btnSimpan" class="btn btn-success btn-min"><i class="fa fa-save"></i> Simpan</button>
								<?=anchor('kategori_dana', '<i class="fa fa-angle-left"></i> Kembali', array('class'=>'btn btn-danger btn-min'))?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
