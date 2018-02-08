<?php
$id   = "";
$kode = "";
$nama = "";
$cabang  = "";
$atas_nama   = "";
$no_rek = "";
$jenis = "";
$biaya_admin = "";
$tgl_buka = "";
$aktif = "";
$gl = "";
$act  = "tambah";
if(!empty($bank)){
	foreach($bank as $k){
		$id = $k->id;
		$kode = $k->kode;
		$nama = $k->bank;
		$cabang = $k->cabang;
		$atas_nama = $k->atas_nama;
		$no_rek = $k->no_rek;
		$jenis = $k->jenis;
        $biaya_admin =  $k->biaya_admin;
		$tgl_buka =  $k->tanggal_buka;
		$aktif =  $k->aktif;
		$gl =  $k->gl;
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
					<form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url().'Bank/'.$act ?>">
						<input type="hidden" name="id" value="<?= $id ?>">
						<div class="form-group">
							<label class="control-label col-lg-2">Kode Bank</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" name="kode" maxlength="50" id="kode" value="<?= $kode ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Nama Bank</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="nama" maxlength="50" id="nama" value="<?= $nama ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Cabang Bank</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" name="cabang" id="cabang" value="<?= $cabang ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Atas Nama</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" name="atas_nama" id="atas_nama" value="<?= $atas_nama ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Tanggal Buka Rekening</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" name="tanggal_buka" id="tgl" value="<?= tgl_indo2($tgl_buka);?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">No Rekening</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" name="no_rek" id="no_rek" value="<?= $no_rek ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Jenis Rekening</label>
							<div class="col-lg-4">
								<select class="form-control" name="jenis" id="jenis" >
								    <option value="">-Pilih-</option>
								    <option value="Tabungan" <?php if($jenis=="Tabungan") { ?> selected <?php } ?>>Tabungan</option>
								    <option value="Giro" <?php if($jenis=="Giro") { ?> selected <?php } ?>>Giro</option>
								    </select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Biaya Admin</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" name="biaya_admin" id="biaya_admin" value="<?= $biaya_admin ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">GL</label>
							<div class="col-lg-4">
								<select class="form-control selectnot"  name="gl">
								    	<option value="">-- Pilih Akun --</option>
									<?php
									foreach($akun as $p){
										if($p->kode_akun==$gl){
											$select = "selected";
										}else{
											$select = "";
										}
										echo "<option $select value='$p->kode_akun'>".$p->nama_akun."=>".$p->kode_akun."</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Aktif</label>
							<div class="col-lg-4">
								<select name="aktif" class="form-control" >
									<option value="">-Pilih-</option>
									<option value="Ya" <?php if($aktif=="Ya") { ?> selected <?php } ?>>Ya</option>
									<option value="Tidak" <?php if($aktif=="Tidak") { ?> selected <?php } ?>>Tidak</option>
								</select>
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
<script>
	$(function() {
		
		$("#tgl").datepicker({'dateFormat':'dd-mm-yy'});
	});
</script>