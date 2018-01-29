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
					<form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url('penyaluran_dana/tambah')?>">
						<div class="form-group">
							<label class="control-label col-lg-2">Nama Penyaluran</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="nama_penyaluran_dana" maxlength="50" id="nama" value="" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Kategori Penyaluran</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="kategori_penyaluran_dana" maxlength="50" id="nama" value="" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Nilai Penyaluran</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="nilai" maxlength="50" id="nama" value="" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Keterangan</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="keterangan" maxlength="50" id="keterangan" value="" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">GL</label>
							<div class="col-lg-4">
								<select class="form-control selectnot"  name="gl">
								    	<option value="">-- Pilih Akun --</option>
									<?php
									foreach($akun as $p){
										if($p->kode_akun==$kategori_dana["gl"]){
											$select = "selected";
										}else{
											$select = "";
										}
										echo "<option $select value='$p->kode_akun'>".$p->nama_akun."=>".$p->kode_akun."</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2"></div>
							<div class="col-lg-4">
								<button type="submit" value="simpan" name="btnSimpan" class="btn btn-success btn-min"><i class="fa fa-save"></i> Simpan</button>
								<?=anchor('penyaluran_dana', '<i class="fa fa-angle-left"></i> Kembali', array('class'=>'btn btn-danger btn-min'))?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
