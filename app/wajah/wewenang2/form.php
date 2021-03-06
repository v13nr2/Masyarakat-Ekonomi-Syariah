<?php
$id   = "";
$prov = "";
$kab  = "";
$kd   = "";
$act  = "tambah";
if(!empty($provinsi)){
	foreach($provinsi as $k){
		$id = $k->id;
		$kab = $k->provinsi;
		$kd = $k->kode;
		$act = "ubah";	
	}
}
?>
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
					<form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url().'master/provinsi/'.$act ?>">
						<input type="hidden" name="id" value="<?= $id ?>">
						<div class="form-group">
							<label class="control-label col-lg-2">Nama Provinsi</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="provinsi" maxlength="50" id="provinsi" value="<?= $kab ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Kode Provinsi</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" name="kode" maxlength="50" id="kode" value="<?= $kd ?>" />
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2"></div>
							<div class="col-lg-4">
								<button type="submit" value="simpan" name="btnSimpan" class="btn btn-success btn-min"><i class="fa fa-save"></i> Simpan</button>
								<?=anchor('master/provinsi', '<i class="fa fa-angle-left"></i> Kembali', array('class'=>'btn btn-danger btn-min'))?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
