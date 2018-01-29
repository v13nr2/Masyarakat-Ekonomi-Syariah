<?php
$id   = "";
$nama_departemen = "";
$penanggung_jawab = "";
$keterangan  = "";
$act  = "tambah";
if(!empty($departemen)){
	foreach($departemen as $k){
		$id = $k->id;
		$nama_departemen = $k->nama_departemen;
		$penanggung_jawab = $k->penanggung_jawab;
		$keterangan = $k->keterangan;
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
					<form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url().'Departemen/'.$act ?>">
						<input type="hidden" name="id" value="<?= $id ?>">
						<div class="form-group">
							<label class="control-label col-lg-2">Nama Departemen</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" name="nama_departemen" maxlength="50" id="nama_departemen" value="<?= $nama_departemen ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Nama Penanggung Jawab</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="penanggung_jawab" maxlength="50" id="penanggung_jawab" value="<?= $penanggung_jawab ?>" />
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
								<?=anchor('Bank', '<i class="fa fa-angle-left"></i> Kembali', array('class'=>'btn btn-danger btn-min'))?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
