<section class="content-header">
	<div class="row">
		<div class="col-md-5">
			<label class="label-header">Ubah Pegawai</label>
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
  <div class="panel-heading"><b>Ubah Pegawai</b></div>
  <div class="panel-body">
  <?php  if(validation_errors() != false) {echo alert_php2('', 'validate', validation_errors()); } ?>
  <?php echo $this->session->flashdata('pesan')?>
     <form action="<?=base_url()?>pegawai/update" method="post" enctype="multipart/form-data">
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
          <td style="width:15%;">Nama Pegawai</td>
          <td>
            <div class="col-sm-10">
				<input type="hidden" name="id" value="<?php echo $organisasi["id"];?>">
                <input type="text" name="nama_pegawai" class="form-control" value="<?php echo $organisasi["nama_pegawai"];?>">
				</div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Alamat Pegawai</td>
          <td>
            <div class="col-sm-10">
                <textarea name="alamat" class="form-control" ><?php echo $organisasi["alamat"];?></textarea>
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">HP</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="hp" class="form-control" value="<?php echo $organisasi["hp"];?>">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Email</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="email" class="form-control" value="<?php echo $organisasi["email"];?>">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">NPWP</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="npwp" class="form-control" value="<?php echo $organisasi["npwp"];?>">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">NIP/NIK</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="nip" class="form-control" value="<?php echo $organisasi["nip"];?>">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">No KTP</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="no_ktp" class="form-control" value="<?php echo $organisasi["no_ktp"];?>">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">No Rekening</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="no_rekening" class="form-control" value="<?php echo $organisasi["no_rekening"];?>">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Jabatan</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="jabatan" class="form-control" value="<?php echo $organisasi["jabatan"];?>">
            </div>
            </td>
         </tr>
         <!-- loop parameter -->
         	<?php 
         	$no = 1;
         	foreach ($keudetail as $k){
         	    ${'paramValue_' . $no} = $k->jumlah;
         	    $no++;
         	}
         	$noKeu = 1;
         	foreach ($keu as $b)
			{ ?>
                 <tr>
                  <td style="width:15%;"><?php echo $b->nama_keuangan;?></td>
                  <td>
                    <div class="col-sm-10">
                        <input type="hidden" id="tambah" name="parameter[]" value="<?php echo $b->id;?>" />
                        <input type="text" name="parameterV_<?php echo $b->id;?>" class="form-control" value="<?php 
                        echo isset(${'paramValue_' . $noKeu}) ? ${'paramValue_' . $noKeu} : '0';

                        ?>">
                    </div>
                    </td>
                 </tr>
         <?php 
         $noKeu++;
         } ?>
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

