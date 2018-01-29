<?php
$id   = "";
$id_program = "";
$nama_proyek = "";
$jenis_proyek = "";
$tanggal_dari = "";
$tanggal_sampai = "";
$keterangan  = "";
$nilai  = "";
$act  = "tambah";
if(!empty($proyek)){
	foreach($proyek as $k){
		$id = $k->id;
		$id_program = $k->id_program;
		$nama_proyek = $k->nama_proyek;
		$keterangan = $k->keterangan;
		$jenis_proyek = $k->jenis_proyek;
		$tanggal_dari = $k->tanggal_dari;
		$nilai = number_format($k->nilai);
		$tanggal_sampai = $k->tanggal_sampai;
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
					<form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url().'proyek/'.$act ?>">
						<input type="hidden" name="id" value="<?= $id ?>">
						<div class="form-group">
							<label class="control-label col-lg-2">No Program</label>
							<div class="col-lg-4">
								<select name="id_program"  id="id_program" class="form-control">
									<option value="">-- Pilih No Program --</option>
														<?php
														foreach($program as $p){
															if($p->id_program==$id_program){
																$select = "selected";
															}else{
																$select = "";
															}
															echo "<option $select value='$p->id_program'> [ $p->no_program ] . $p->keterangan";
														}
														?>
									</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Nama Proyek</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="nama_proyek" maxlength="50" id="nama_proyek" value="<?= $nama_proyek ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Jenis Proyek</label>
							<div class="col-lg-4">
								
														<?php
														//$selected = 
														//echo form_dropdown('jenis_proyek"'.'class="form-control', $selected, $this->db->enum_select('tbl_proyek','jenis_proyek'), set_value('jenis_proyek'));
														?>
														
								<select name="jenis_proyek"  id="jenis_proyek" class="form-control">
									<option value="">-- Pilih Jenis --</option>
									<option value="One Year" <?php if($jenis_proyek == "One Year"){?> selected <?php } ?>>One Year</option>
									<option value="Multi Year" <?php if($jenis_proyek == "Multi Year"){?> selected <?php } ?>>Multi Year</option>
								</select>		
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="nama">Dari Tanggal</label>
							<div class="col-sm-4">
								<input type="text" name="tanggal_dari" class="form-control" id="tanggal_dari" placeholder="Tanggal" required value="<?php echo tgl_indo2($tanggal_dari);?>">
							</div>
						</div>
					
						<div class="form-group">
							<label class="control-label col-sm-2" for="nama">Sampai Tanggal</label>
							<div class="col-sm-4">
								<input type="text" name="tanggal_sampai" class="form-control" id="tanggal_sampai" placeholder="Tanggal" required value="<?php echo tgl_indo2($tanggal_sampai);?>">
							</div>
						</div>
					
						<div class="form-group">
							<label class="control-label col-lg-2">Nilai</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" onkeyup="inputnilai();" name="nilai" id="nilai" value="<?= $nilai ?>" />
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
								<?=anchor('proyek', '<i class="fa fa-angle-left"></i> Kembali', array('class'=>'btn btn-danger btn-min'))?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
 <script type="text/javascript">
$(document).ready(function(){
/* 	$.each($('.kanan'), function()
    {
       $(this).keyup( function(){ 
	   		$(this).val(formatCurrency($(this).val()));
		} );
    }); */


});
function inputnilai(){
	$('#nilai').val(formatCurrency($('#nilai').val()));
}
function formatCurrency(num) {
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+','+
		num.substring(num.length-(4*i+3));
		//return (((sign)?'':'-') + '$' + num + '.' + cents);
		return (((sign)?'':'-') + num);
	}

function clearNum(number){
	while(String(number).indexOf(',') > -1){
	 number = String(number).replace(',','');
	}
	return number;
}
	function hitungSusut(){
		nilai = clearNum(document.getElementById("nilai").value) * 1;
		bagi = clearNum(document.getElementById("bagi").value) * 1;
		tarif = clearNum(document.getElementById("tarif").value) * 1;
		susut = nilai / 1 * tarif / 100;
		document.getElementById("susut").value = formatCurrency(susut);
		document.getElementById("tarif").value = 100/bagi;
	}
	
$(function() {
		
		$("#tanggal_dari").datepicker({'dateFormat':'dd-mm-yy'});
		$("#tanggal_sampai").datepicker({'dateFormat':'dd-mm-yy'});
	});
	
</script>
