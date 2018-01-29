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
					<form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url()?>donatur/update/<?=$this->uri->segment(3)?>" enctype="multipart/form-data">
						<div class="form-group">
							<label class="control-label col-lg-3">Foto</label>
							<div class="col-sm-4">
								<input type="file" name="filefoto" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">Nama Donatur</label>
							<div class="col-lg-4">
							
								<input type="hidden" name="id" value="<?php echo $donatur["id"];?>">
								<input type="text" class="form-control" data-validetta="required" name="nama" maxlength="50" id="nama" value="<?=$donatur["nama"]?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">Alamat Donatur</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="alamat" maxlength="50" id="alamat" value="<?=$donatur["alamat"]?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">Email Donatur</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="email" maxlength="50" id="email" value="<?=$donatur["email"]?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">HP Donatur</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="hp" maxlength="50" id="hp" value="<?=$donatur["hp"]?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">NPWP</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="npwp" maxlength="50" id="hp" value="<?=$donatur["npwp"]?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">Nomor Rekening</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" data-validetta="required" name="norek" maxlength="50" id="hp" value="<?=$donatur["norek"]?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">Kategori Penyedia Dana</label>
							<div class="col-lg-4">
								<select class="form-control selectnot" data-validetta="required" name="tipe" data-placeholder="pilih tipe penyedia">
								<option value=""></option>
										<?php foreach ($tipepenyedia as $tp) 
												{
														$sel = ""; 
														$ket = $tp->kategori_penyedia; 
														if($donatur["id_kategori_penyedia_dana"] == $tp->id) $sel = 'selected=""';
														echo '<option value="'.$tp->id.'" '.$sel.'>'.$ket.'<option>';
												} ?>
								<select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-3"></div>
							<div class="col-lg-4">
								<button type="submit" value="simpan" name="btnSimpan" class="btn btn-success btn-min"><i class="fa fa-save"></i> Simpan</button>
								<?=anchor('donatur', '<i class="fa fa-angle-left"></i> Kembali', array('class'=>'btn btn-danger btn-min'))?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
