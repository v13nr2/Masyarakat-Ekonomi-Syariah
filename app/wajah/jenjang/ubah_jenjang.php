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
					<h3 class="box-title">Ubah Jenjang</h3>
				</div>
				<div class="box-body">
					<form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url()?>jenjang/ubah/<?=$this->uri->segment(3)?>">
					
						<div class="form-group">
							<label class="control-label col-lg-2">Induk Jenjang</label>
							<div class="col-lg-4">
								<select class="form-control selectnot"  name="induk_akun" id="induk_akun" data-placeholder="pilih Induk akun" onchange="js_get_kode_tipe_akun(this.value)">
										<option value=""></option>
									<?php foreach ($indukakun as $tp)
									{
										$sel = ""; 
										if($jenjang["id_parent"] == $tp->id_jenjang) {
											$sel = 'selected';
										} else {}
										echo '<option value="'.$tp->kode_jenjang.'" '. $sel .' >'.$tp->kode_jenjang.'-'.$tp->nama_jenjang.'<option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Kode Jenjang</label>
							<div class="col-lg-2"> <div class="input-group">
								<span class="input-group-addon" id="kode_akun_depan_text"><?=$kode_induk?></span>
								<input type="hidden" name="kode_akun_depan" id="value_kode_depan" value="<?=$kode_akun_depan?>">
								<input type="text" class="form-control" data-validetta="required" maxlength="4" name="kode_jenjang" id="kode_akun" value="<?=$kode_belakang?>" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2">Nama Jenjang</label>
						<div class="col-lg-4">
							<input type="text" class="form-control" data-validetta="required" name="nama_jenjang" maxlength="50" id="nama_akun" value="<?=$jenjang["nama_jenjang"]?>" />
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-2"></div>
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
