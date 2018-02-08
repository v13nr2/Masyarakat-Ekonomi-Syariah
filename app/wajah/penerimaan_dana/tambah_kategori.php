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
					<form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url('penerimaan_dana/tambah')?>">
						<div class="form-group">
							<label class="control-label col-lg-2">kategori Penerimaan</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="kategori_penyedia_dana" maxlength="50" id="kategori_penyedia_dana" value="" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Jenis Penerimaan</label>
							<div class="col-lg-4">
								<?php echo '<select class="form-control selectnot" name="jenis_dana">
												<option value="">-Pilih-</option>';
															foreach ($kategori as $a) {
																
																echo '<option value="'. $a->id .'" >'. $a->kategori_dana .'</option>';
															}
															echo '</select>';
															?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Nilai Penerimaan</label>
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
							<label class="control-label col-lg-2">Penyedia Dana</label>
							<div class="col-lg-4">
								<select class="form-control selectnot"  name="penyedia_dana_id">
								    	<option value="">-- Pilih --</option>
									<?php
									foreach($penyedia as $p){
										if($p->id==$kategori_dana["penyedia_dana_id"]){
											$select = "selected";
										}else{
											$select = "";
										}
										echo "<option $select value='$p->id'>".$p->nama_penyedia."</option>";
									}
									?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">GL</label>
							<div class="col-lg-4">
								<select class="form-control selectnot"  name="gl">
								    	<option value="">-- Pilih Akun --</option>
									<?php
									foreach($akun4 as $p){
									
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
