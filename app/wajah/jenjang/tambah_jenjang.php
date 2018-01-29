<section class="content-header">
	<div class="row">
		<div class="col-md-5">
			<label class="label-header"></label>
		</div>
	</div>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<?php if($errors!=""){
				echo $errors;
			}
			?>
			<?php if(validation_errors() != false) {
				echo alert_php2('', 'validate', validation_errors());
			}
			?>
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-credit-card"></i>
					<h3 class="box-title">Tambah Jenjang</h3>
				</div> <div class="box-body">
					<form id="exmb" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url()?>jenjang/tambah">
					
						<div class="form-group">
							<label class="control-label col-lg-2">Induk Jenjang</label>
							<div class="col-lg-4">
								<select class="form-control selectnot"  name="induk_akun" id="induk_akun" data-placeholder="pilih Induk Jenjang" onchange="js_get_kode_tipe_akun(this.value)">
									<option value=""></option>
									<?php foreach ($indukakun as $tp)
									{
										//$sel = ""; $ket = "(". $tp->id_akun .") - " . $tp->nama_akun;
										
										echo '<option value="'.$tp->kode_jenjang.'" >'.$tp->nama_jenjang.'<option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Kode Jenjang</label>
							<div class="col-lg-2"> <div class="input-group">
								<span class="input-group-addon" id="kode_akun_depan_text"></span>
								<input type="hidden" name="kode_akun_depan" id="value_kode_depan" value="<?=$kode_akun_depan?>">
								<input type="text" class="form-control" maxlength="4" data-validetta="required" name="kode_jenjang" id="kode_jenjang" value="<?=$kode_jenjang?>" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2">Nama Jenjang</label>
						<div class="col-lg-4">
							<input type="text" class="form-control" data-validetta="required" maxlength="50" name="nama_jenjang" id="nama_akun" value="<?=$nama_jenjang?>" />
						</div>
					</div>
				<div class="form-group">
						<div class="col-lg-2">
					</div>
					<div class="col-lg-4">
						<button type="submit" value="simpan" name="btnSimpan" class="btn btn-success btn-min"><i class="fa fa-save"></i> Simpan</button>
						<?=anchor('jenjang', '<i class="fa fa-angle-left"></i> Kembali', array('class'=>'btn btn-danger btn-min'))?>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
</section>
<script>

function js_get_kode_tipe_akun(value)
{
	
	//alert('ok');
	//$("#kode_akun_depan").html('<i class="fa fa-spinner fa-spin"></i>'
	$("#kode_akun_depan_text").html(value);
	$("#value_kode_depan").val(value);
	//document.getElementById("value_kode_depan").value = value;
}
</script>
