<section class="content-header">
	<div class="row">
		<div class="col-md-5">
			<label class="label-header"><?=$judul?></label>
		</div>
	</div>
</section>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12">
            <!-- general form elements -->
            <div class="box box-primary">
               <div class="box-header">
						<form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url('menu/edit')?>">

							<div class="box-body">
								<div class="form-group">
									<label class="control-label col-lg-3">Nama Menu</label>
									<div class="col-lg-4">
										<input type="hidden"  name="id" value="<?php echo $record['id_menu'] ?>" >
										<input type="tex" name="nama" class="form-control" id="inputError" required oninvalid="setCustomValidity('Nama Menu Harus di Isi !')"
										oninput="setCustomValidity('')" placeholder="Masukan Nama menu" value="<?php echo $record['nama_menu']; ?>" >
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-3">Icon</label>
									<div class="col-lg-4">
										<input type="tex" name="icon" class="form-control" id="inputError" required oninvalid="setCustomValidity('Icon Harus di Isi !')"
										oninput="setCustomValidity('')" placeholder="ex : fa fa-dashboard" value="<?php echo $record['icon']; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-3">Link </label>
									<div class="col-lg-4">
										<input type="tex" name="link" class="form-control" id="inputError" required oninvalid="setCustomValidity('Link Harus di Isi !')"
										oninput="setCustomValidity('')" placeholder="ex : menu/edit" value="<?php echo $record['link']; ?>" >
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-3">Kat. Menu</label>
									<div class="col-lg-4">
										<select name='kat_menu' class="form-control ">
											<option value='0'>Menu Utama</option>
												<?php
													foreach ($katmenu as $k) {
														echo "<option value='$k->id_menu'";
														echo $record['parent'] == $k->id_menu ? 'selected' : '';
														echo">$k->nama_menu</option>";
													}
												?>
										</select>
									</div>
								</div>
							</div>

							<div class="box-footer">
								<button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
								<a href="<?php echo site_url('menu'); ?>" class="btn btn-danger">Kembali</a>
							</div>
						</form>
               </div>
            </div>
        </div>
    </div>
</section>
