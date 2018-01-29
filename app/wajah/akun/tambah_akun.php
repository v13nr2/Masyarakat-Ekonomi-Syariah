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
					<h3 class="box-title">Tambah Akun (COA)</h3>
				</div> <div class="box-body">
					<form id="exmb" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url()?>akun/tambah">
						<div class="form-group">
							<label class="control-label col-lg-2">Tipe Akun</label>
							<div class="col-lg-4">
								<select class="form-control selectnot" data-validetta="required" name="tipe_akun" id="tipe_akun" data-placeholder="pilih tipe akun" >
									<option value=""></option>
									<?php foreach ($tipeakun as $tp)
									{
										$sel = ""; $ket = "(". $tp->kode_tipe_akun .") - " . $tp->nama_tipe_akun;
										if($id_tipe_akun == $tp->id_tipe_akun) $sel = 'selected=""';
										echo '<option value="'.$tp->id_tipe_akun.'" '.$sel.'>'.$ket.'<option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Induk Akun</label>
							<div class="col-lg-4">
								<select class="form-control selectnot"  name="induk_akun" id="induk_akun" data-placeholder="pilih Induk akun" onchange="js_get_kode_tipe_akun(this.value)">
									<option value=""></option>
									<?php foreach ($indukakun as $tp)
									{
										//$sel = ""; $ket = "(". $tp->id_akun .") - " . $tp->nama_akun;
										
										echo '<option value="'.$tp->kode_akun.'" >'.$tp->kode_akun.'-'.$tp->nama_akun.'<option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Kode Akun</label>
							<div class="col-lg-2"> <div class="input-group">
								<span class="input-group-addon" id="kode_akun_depan_text"></span>
								<input type="hidden" name="kode_akun_depan" id="value_kode_depan" value="<?=$kode_akun_depan?>">
								<input type="text" class="form-control" maxlength="4" data-validetta="required" name="kode_akun" id="kode_akun" value="<?=$kode_akun?>" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2">Nama Akun</label>
						<div class="col-lg-4">
							<input type="text" class="form-control" data-validetta="required" maxlength="50" name="nama_akun" id="nama_akun" value="<?=$nama_akun?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2">Saldo Normal</label>
						<div class="col-lg-4">
							<label class="radio-inline"><input type="radio" value="D" class="" data-validetta="required" name="saldo_normal" <?php if($saldo_normal=="D") { echo "checked"; } if($saldo_normal=="") { echo "checked"; }  ?> >Debet</label>
							<label class="radio-inline"><input type="radio" value="K" name="saldo_normal" <?php if($saldo_normal=="K") { echo "checked"; }  ?> >Kredit</label>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2">Lokasi</label>
						<div class="col-lg-4">
							<label class="radio-inline"><input type="radio" value="Neraca" data-validetta="required" class="" name="lokasi" <?php if($lokasi=="Neraca") { echo "checked"; } if($lokasi=="") { echo "checked"; }  ?> >Neraca</label>
							<label class="radio-inline"><input type="radio" value="Profit" name="lokasi" <?php if($lokasi=="Profit") { echo "checked"; }  ?> >Profit and Lost</label>
						</div>
					</div> <?php /*<div class="form-group"> <label class="control-label col-lg-2">Posisi</label> <div class="col-lg-2"> <input type="number" min="1" class="form-control" data-validetta="required" name="posisi" id="posisi" value="<?=$posisi?>" /> </div> </div>*/ ?>
					<div class="form-group">
						<div class="col-lg-2">
					</div>
					<div class="col-lg-4">
						<button type="submit" value="simpan" name="btnSimpan" class="btn btn-success btn-min"><i class="fa fa-save"></i> Simpan</button>
						<?=anchor('akun', '<i class="fa fa-angle-left"></i> Kembali', array('class'=>'btn btn-danger btn-min'))?>
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
