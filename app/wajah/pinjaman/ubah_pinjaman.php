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
					<form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url()?>pinjaman/ubah/<?=$this->uri->segment(3)?>">
						<div class="form-group">
							<label class="control-label col-lg-3">Nama Pegawai</label>
							<div class="col-lg-4">
								<select name="id_pegawai"  id="id_pegawai" class="form-control">
								<option value="">-- Pilih Pegawai --</option>
													<?php
													foreach($pegawai as $p){
														if($p->id==$pinjaman["id_pegawai"]){
															$select = "selected";
														}else{
															$select = "";
														}
														echo "<option $select value='$p->id'>$p->nama_pegawai</option>";
													}
													?>
								</select>
				</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">Tanggal Pinjaman</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="tanggal_pinjaman" maxlength="50" id="tanggal_pinjaman" value="<?=$pinjaman["tanggal_pinjaman"]?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">Jumlah Pinjaman</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="jumlah_pinjaman" maxlength="50" id="jumlah_pinjaman" value="<?=$pinjaman["jumlah_pinjaman"]?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">Status Pinjaman</label>
							<div class="col-lg-4">
									<select name="status_pinjaman" class="form-control" >
										<option value="">--Pilih Status--</option>
										<option value="Baru" <?php if($pinjaman["status_pinjaman"]=="Baru"){?> selected <?php }?>>Pinjaman Baru</option>
										<option value="Lunas" <?php if($pinjaman["status_pinjaman"]=="Lunas"){?> selected <?php }?>>Lunas</option>
									</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-3"></div>
							<div class="col-lg-4">
								<button type="submit" value="simpan" name="btnSimpan" class="btn btn-success btn-min"><i class="fa fa-save"></i> Simpan</button>
								<?=anchor('pinjaman', '<i class="fa fa-angle-left"></i> Kembali', array('class'=>'btn btn-danger btn-min'))?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(function() {
		
		$("#tanggal_pinjaman").datepicker({dateFormat: 'yy/mm/dd'});
	});
</script>