<?php
$id   = "";
$nama_keuangan = "";
$gl_debet = "";
$gl_kredit = "";
$keterangan  = "";
$act  = "tambah";
if(!empty($keu)){
	foreach($keu as $k){
		$id = $k->id;
		$nama_keuangan = $k->nama_keuangan;
		$gl_kredit = $k->gl_kredit;
		$gl_debet = $k->gl_debet;
		$keterangan = $k->keterangan;
		$act = "ubah";	
	}
}
?>
<section class="content-header">
	<div class="row">
		<div class="col-md-7">
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
					<form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url().'keuangankaryawan/'.$act ?>">
						<input type="hidden" name="id" value="<?= $id ?>">
						<div class="form-group">
							<label class="control-label col-lg-2">Nama Parameter</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" name="nama_keuangan" maxlength="50" id="nama_keuangan" value="<?= $nama_keuangan ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">GL Debet</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="gl_debet" maxlength="50" id="gl_debet" value="<?= $gl_debet ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">GL Kredit</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="gl_kredit" maxlength="50" id="gl_kredit" value="<?= $gl_kredit ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Keterangan</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" name="keterangan" id="keterangan" value="<?= $keterangan ?>" />
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2"></div>
							<div class="col-lg-4">
								<button type="submit" value="simpan" name="btnSimpan" class="btn btn-success btn-min"><i class="fa fa-save"></i> Simpan</button>
								<?=anchor('keuangankaryawan', '<i class="fa fa-angle-left"></i> Kembali', array('class'=>'btn btn-danger btn-min'))?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
