<section class="content-header">
	<div class="row">
		<div class="col-md-5">
			<label class="label-header">Tambah Penyedia</label>
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
  <div class="panel-heading"><b>Tambah Mitra Kerja</b></div>
  <div class="panel-body">
  <?php  if(validation_errors() != false) {echo alert_php2('', 'validate', validation_errors()); } ?>
  <?php echo $this->session->flashdata('pesan')?>
     <form action="<?=base_url()?>penyedia/insert" method="post" enctype="multipart/form-data">
       <table class="table table-striped">

         <tr>
          <td style="width:15%;">File Foto/Logo</td>
          <td>
            <div class="col-sm-6">
                <input type="file" name="filefoto" class="form-control">
            </div>
            </td>
         </tr>
          <tr>
          <td style="width:15%;">Nama </td>
          <td>
            <div class="col-sm-10">
				
                <input type="text" name="nama_penyedia" class="form-control" value="">
				</div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Alamat Mitra Kerja</td>
          <td>
            <div class="col-sm-10">
                <textarea name="alamat" class="form-control" ></textarea>
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">HP</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="hp" class="form-control" value="">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Email</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="email" class="form-control" value="">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">NPWP</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="npwp" class="form-control" value="">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">KTP</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="ktp" class="form-control" value="">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">No Rekening</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="no_rekening" class="form-control" value="">
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
