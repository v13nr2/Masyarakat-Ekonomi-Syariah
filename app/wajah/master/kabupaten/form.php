<?php
$id   = "";
$prov = "";
$kab  = "";
$kd   = "";
$act  = "tambah";
if(!empty($kabupaten)){
	foreach($kabupaten as $k){
		$id = $k->id;
		$prov = $k->provinsi_id;
		$kab = $k->kabupaten;
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
					<form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url().'master/Kabupaten/'.$act ?>">
						<input type="hidden" name="id" value="<?= $id ?>">
						<div class="form-group">
							<label class="control-label col-lg-2">Provinsi</label>
							<div class="col-lg-4">
								<select name="provinsi" id="provinsi" class="form-control">
									<option value="">-- Pilih Provinsi --</option>
									<?php
									foreach($provinsi as $p){
										if($p->id==$prov){
											$select = "selected";
										}else{
											$select = "";
										}
										echo "<option $select value='$p->id'>$p->provinsi</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Nama Kabupaten</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="kabupaten" maxlength="50" id="kabupaten" value="<?= $kab ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Kode Kabupaten</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" name="kode" maxlength="50" id="kode" value="<?= $kd ?>" />
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2"></div>
							<div class="col-lg-4">
								<button type="submit" value="simpan" name="btnSimpan" class="btn btn-success btn-min"><i class="fa fa-save"></i> Simpan</button>
								<?=anchor('master/Kabupaten', '<i class="fa fa-angle-left"></i> Kembali', array('class'=>'btn btn-danger btn-min'))?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
