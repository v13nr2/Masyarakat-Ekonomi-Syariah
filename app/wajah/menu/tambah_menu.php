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
                  <form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url('menu/add')?>">
                     <div class="box-body">
                        <div class="form-group">
                           <label class="control-label col-lg-3">Nama Menu</label>
                           <div class="col-lg-4">
                              <input type="tex" name="nama" class="form-control" required oninvalid="setCustomValidity('Nama Menu Harus di Isi !')"
                              oninput="setCustomValidity('')" placeholder="Masukan Nama Menu" >
                              <?php echo form_error('nama', '<div class="text-red">', '</div>'); ?>
                           </div>
                        </div>

                        <div class="form-group">
                           <label class="control-label col-lg-3">Icon</label>
                           <div class="col-lg-4">
                              <input type="text" class="form-control" name="icon" required oninvalid="setCustomValidity('Icon di Isi !')"
                              oninput="setCustomValidity('')" placeholder="ex : fa fa-dashboard">
                              <?php echo form_error('merek', '<div class="text-red">', '</div>'); ?>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-lg-3">Link Menu</label>
                           <div class="col-lg-4">
                              <input type="text" class="form-control" name="link" required oninvalid="setCustomValidity('Link Harus di Isi !')"
                              oninput="setCustomValidity('')" placeholder="ex : menu/add atau #">
                              <?php echo form_error('merek', '<div class="text-red">', '</div>'); ?>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-lg-3">Kat. Menu</label>
                           <div class="col-lg-4">
                              <select name='kat_menu' class="form-control ">
                                 <option value='0'>Menu Utama</option>
                                 <?php
	                                 if (!empty($record)) {
		                                 foreach ($record as $r) {
		                                 	echo "<option value=".$r->id_menu.">".$r->nama_menu."</option>";
		                                 }
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
