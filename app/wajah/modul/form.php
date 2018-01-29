<?php
$id   = "";
$controller = "";
$method = "";
$nama_fungsi  = "";
$act  = "tambah";
if(!empty($modul)){
	foreach($modul as $k){
		$id = $k->id;
		$controller = $k->controller;
		$method = $k->method;
		$nama_fungsi = $k->nama_fungsi;
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
					<form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url().'Modul/'.$act ?>">
						<input type="hidden" name="id" value="<?= $id ?>">
						<div class="form-group">
							<label class="control-label col-lg-2">Conroller</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" name="controller" maxlength="50" id="kode" value="<?= $controller ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Method</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="method" maxlength="50" id="nama" value="<?= $method ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Nama Fungsi</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" name="nama_fungsi" id="nama_fungsi" value="<?= $nama_fungsi ?>" />
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2"></div>
							<div class="col-lg-4">
								<button type="submit" value="simpan" name="btnSimpan" class="btn btn-success btn-min"><i class="fa fa-save"></i> Simpan</button>
								<?=anchor('Modul', '<i class="fa fa-angle-left"></i> Kembali', array('class'=>'btn btn-danger btn-min'))?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
