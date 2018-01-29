<section class="content-header">
	<div class="row">
		<div class="col-md-5">
			<label class="label-header">Ubah Dokumentasi</label>
		</div>
		<div class="col-md-7">
			<div class="pull-right">
			</div>
		</div>
	 </div>
 </section>
 <section class="content">
      <!-- Main component for a primary marketing message or call to action -->
<div class="panel panel-default">
  <div class="panel-heading"><b>Ubah Dokumentasi</b></div>
  <div class="panel-body">
  <?php  if(validation_errors() != false) {echo alert_php2('', 'validate', validation_errors()); } ?>
  <?php echo $this->session->flashdata('pesan')?>
     <form action="<?=base_url()?>dokumentasi/update" method="post" enctype="multipart/form-data">
       <table class="table table-striped">

         <tr>
          <td style="width:15%;">File Foto/scresnshoot</td>
          <td>
            <div class="col-sm-6">
                <input type="file" name="filefoto" class="form-control">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Nama Modul</td>
          <td>
            <div class="col-sm-10">
				<input type="hidden" name="id" value="<?php echo $organisasi["id"];?>">
                <input type="text" name="nama_modul" class="form-control" value="<?php echo $organisasi["nama_modul"];?>">
				</div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Penjelasan Modul</td>
          <td>
            <div class="col-sm-10">
                <textarea name="penjelasan_modul" class="form-control" ><?php echo $organisasi["penjelasan_modul"];?></textarea>
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Akses Menu</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="akses_menu" class="form-control" value="<?php echo $organisasi["akses_menu"];?>">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Level Pengguna</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="level_pengguna" class="form-control" value="<?php echo $organisasi["level_pengguna"];?>">
            </div>
            </td>
         </tr>
         <tr>
          <td colspan="2">
            <input type="submit" class="btn btn-success" value="Simpan">
            <button type="reset" class="btn btn-default">Batal</button>
          </td>
         </tr>
       </table>
     </form>
        </div>
    </div>    <!-- /panel -->

    </div> <!-- /container -->

