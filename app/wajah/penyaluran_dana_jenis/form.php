<?php
$id   = "";
$jenis_penyaluran_dana = "";
$act  = "tambah";
if(!empty($jenis)){
	foreach($jenis as $yk){
		$id = $yk->id;
		$jenis_penyaluran_dana = $yk->jenis_penyaluran_dana;
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
					<form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url().'penyaluran_dana_jenis/'.$act ?>">
						<input type="hidden" name="id" value="<?= $id ?>">
						<div class="form-group">
							<label class="control-label col-lg-4">Jenis Penyaluran Dana</label>
							<div class="col-lg-4">
								<input type="hidden" class="form-control" name="id" maxlength="50" id="id" value="<?= $id ?>" />
								<input type="text" class="form-control" name="jenis_penyaluran_dana" maxlength="50" id="jenis_penyaluran_dana" value="<?= $jenis_penyaluran_dana ?>" />
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2"></div>
							<div class="col-lg-4">
								<button type="submit" value="simpan" name="btnSimpan" class="btn btn-success btn-min"><i class="fa fa-save"></i> Simpan</button>
								<?=anchor('penyaluran_dana_jenis', '<i class="fa fa-angle-left"></i> Kembali', array('class'=>'btn btn-danger btn-min'))?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
