<?php
/* echo "parent dari array akun : ".$akun["id_parent"];
echo "<br>kode induk : ".$kode_induk;
echo "<br>kode anak : ".$kode_anak; */
$panjang = strlen($kode_anak)-strlen($kode_induk);
$kode_belakang = substr($kode_anak,-$panjang);
?><section class="content-header">
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
			if(validation_errors() != false)
			{
				echo alert_php2('', 'validate', validation_errors());
			}
			if($this->session->userdata($this->config->item('ses_message')))
			{
				echo $this->session->userdata($this->config->item('ses_message'));
				$this->session->unset_userdata($this->config->item('ses_message'));
			}
			?>
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-credit-card"></i>
					<h3 class="box-title">Ubah Akun (COA)</h3>
				</div>
				<div class="box-body">
					<form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url()?>akun/ubah/<?=$this->uri->segment(3)?>">
						<div class="form-group">
							<label class="control-label col-lg-2">Tipe Akun</label>
							<div class="col-lg-4">
								<select class="form-control selectnot" data-validetta="required" name="tipe_akun" data-placeholder="pilih tipe akun" onchange="js_get_kode_tipe_akun(this.value)">
									<option value=""></option>
									<?php foreach ($tipeakun as $tp) {
									        $sel = ""; 
									        $ket = "(". $tp->kode_tipe_akun .") - " . $tp->nama_tipe_akun; 
									        if($akun["id_tipe_akun"] == $tp->id_tipe_akun) {
									            $sel = 'selected='; 
									        }
									        echo '<option value="'.$tp->id_tipe_akun.'" '.$sel.'>'.$ket.'<option>'; 
									        } ?>
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
										$sel = ""; 
										if($akun["id_parent"] == $tp->id_akun) {
											$sel = 'selected';
										} else {}
										echo '<option value="'.$tp->kode_akun.'" '. $sel .' >'.$tp->kode_akun.'-'.$tp->nama_akun.'<option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Kode Akun</label>
							<div class="col-lg-2"> <div class="input-group">
								<span class="input-group-addon" id="kode_akun_depan_text"><?=$kode_induk?></span>
								<input type="hidden" name="kode_akun_depan" id="value_kode_depan" value="<?=$kode_akun_depan?>">
								<input type="text" class="form-control" data-validetta="required" maxlength="4" name="kode_akun" id="kode_akun" value="<?=$kode_belakang?>" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2">Nama Akun</label>
						<div class="col-lg-4">
							<input type="text" class="form-control" data-validetta="required" name="nama_akun" maxlength="50" id="nama_akun" value="<?=$akun["nama_akun"]?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2">Saldo Normal</label>
						<div class="col-lg-4">
							<label class="radio-inline"><input type="radio" value="D" class="" data-validetta="required" name="saldo_normal" <?php if($akun["saldo_normal"]=="D") { echo "checked"; }  ?> >Debet</label>
							<label class="radio-inline"><input type="radio" value="K" name="saldo_normal" <?php if($akun["saldo_normal"]=="K") { echo "checked"; }  ?> >Kredit</label>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2">Lokasi</label>
						<div class="col-lg-4">
							<label class="radio-inline"><input type="radio" value="Neraca" class="" data-validetta="required" name="lokasi" <?php if($akun["lokasi"]=="Neraca") { echo "checked"; }  ?> >Neraca</label>
							<label class="radio-inline"><input type="radio" value="Profit" name="lokasi" <?php if($akun["lokasi"]=="Profit") { echo "checked"; }  ?> >Profit and Lost</label>
						</div>
					</div>
					<?php /*<div class="form-group"> <label class="control-label col-lg-2">Posisi</label> <div class="col-lg-2"> <input type="number" min="1" class="form-control" data-validetta="required" name="posisi" id="posisi" value="<?=$akun["posisi"]?>" /> </div> </div>*/ ?>
					<div class="form-group">
						<div class="col-lg-2"></div>
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
<script>
/* function js_get_kode_tipe_akun(value)
{
	$.ajax({
		type:"POST",
		url:"<?php echo base_url('ajaxdata/get_kode_tipe_akun'); ?>",
		dataType: 'json',
		data:{"id_tipe_akun":value},
		beforeSend: function ()
		{
			$("#kode_akun_depan").html('<i class="fa fa-spinner fa-spin"></i>');
		},
		success: function(resp){
			$("#kode_akun_depan").html(resp);
			document.getElementById("value_kode_depan").value = resp;
		},
		error:function(event, textStatus, errorThrown)
		{
			alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
		}
	});
} */
</script>
