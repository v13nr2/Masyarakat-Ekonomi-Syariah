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
			<?php if($errors!=""){ echo $errors; } if(validation_errors() != false) {echo alert_php2('', 'validate', validation_errors()); } ?> <div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-user"></i>
					<h3 class="box-title"><?=$judul?></h3>
				</div>
				<div class="box-body">
					<form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url('pengguna/tambah')?>">
						<div class="form-group">
							<label class="control-label col-lg-2">Nama Pengguna</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="nama" maxlength="50" id="nama" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Email Pengguna</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="email" maxlength="50" id="email" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Kategori User</label>
							<div class="col-lg-4">
								<select name="wewenang" class="form-control" >
									<option value="">-Pilih-</option>
									<?php
									foreach($roles as $p){
									
										echo "<option $select value='$p->cizacl_role_id'>".$p->cizacl_role_name."</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Kata Sandi</label>
							<div class="col-lg-4">
								<input type="password" class="form-control" name="katasandi" maxlength="50" id="katasandi" value="" />
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-lg-2">Pengurus</label>
							<div class="col-lg-4">
								<select name="pengurus" class="form-control" >
									<option value="">-Pilih-</option>
									<?php
									foreach($pengurus as $p){
										
										echo "<option $select value='$p->id'>$p->nama</option>";
									}
									?>
								</select>
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
