<section class="content-header">
	<div class="row">
		<div class="col-md-5">
			<label class="label-header">Tambah Organisasi</label>
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
  <div class="panel-heading"><b>Tambah Organisasi</b></div>
  <div class="panel-body">
  <?php  if(validation_errors() != false) {echo alert_php2('', 'validate', validation_errors()); } ?>
  <?php echo $this->session->flashdata('pesan')?>
     <form action="<?=base_url()?>upload/insert" method="post" enctype="multipart/form-data">
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
          <td style="width:15%;">Nama Organisasi</td>
          <td>
            <div class="col-sm-10">
                <textarea name="nama_organisasi" class="form-control"></textarea>
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Alamat Organisasi</td>
          <td>
            <div class="col-sm-10">
                <textarea name="alamat" class="form-control"></textarea>
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">HP</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="hp" class="form-control">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Email</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="email" class="form-control">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">NPWP</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="npwp" class="form-control">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">No WA</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="no_wa" class="form-control">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Summary Organisasi</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="summary_organisasi" class="form-control">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Nama Pimpinan</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="nama_pimpinan" class="form-control">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Pimpinan Harian</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="pimpinan_harian" class="form-control">
            </div>
            </td>
         </tr>
		 
		 
         <tr>
          <td style="width:15%;">Propinsi</td>
          <td>
            <div class="col-sm-10">
                <select name="id_provinsi"  id="id_provinsi" class="form-control">
				<option value="">-- Pilih Provinsi --</option>
									<?php
									foreach($provinsi as $p){
										if($p->id==$prov){
											$select = "selected";
										}else{
											$select = "";
										}
										echo "<option $select value='$p->id'>$p->provinsi</option>";
									}
									?>
				</select>
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Kabupaten</td>
          <td>
            <div class="col-sm-10">
                <select name="id_kabupaten"  id="id_kabupaten" class="form-control">
				</select>
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Level Organisasi</td>
          <td>
            <div class="col-sm-10">
               <select name="level_organisasi"  id="level_organisasi" class="form-control">
				<option value="Pusat">Pusat</option>
				<option value="Cabang">Wilayah</option>
				<option value="Cabang">Cabang</option>
				</select>
             </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Induk Organisasi</td>
          <td>
            <div class="col-sm-10">
                <select name="induk_organisasi"  id="induk_organisasi" class="form-control">
				<option value="0">-- Pilih Induk Organisasi --</option>
									<?php
									foreach($organisasi as $p){
										if($p->id==$org){
											$select = "selected";
										}else{
											$select = "";
										}
										echo "<option $select value='$p->id'>$p->nama_organisasi</option>";
									}
									?>
				</select>
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Periode Tahun Buku</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="periode_tahun_buku" class="form-control" value="2017">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">COA Induk Kas </td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="coa_kas_induk" class="form-control" value="">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Coa Induk Bank </td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="coa_bank_induk" class="form-control" value="">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">COA Induk Piutang</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="coa_piutang_induk" class="form-control" value="">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Coa Induk Utang</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="coa_utang_induk" class="form-control" value="">
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
	<script>
	
		$('#document').ready(function(){
			$('#id_provinsi').change(function(){
				$("#id_kabupaten").empty();
				$.ajax({
				  type:"post",
				  url:"<?php echo base_url('upload/getComboKab');?>",
				  data:"id="+$('#id_provinsi').val(),
				  dataType: 'json',
				  success:
				  function(response){
					 //
					 $.each(response, function () {
							$("#id_kabupaten").append($("<option></option>").val(this['kabupaten_id']).html(this['kabupaten_nama']));
						});
				  },
				  error:
					function(){
						alert("Error. Ajax Service");
					}
			  })
			});
		});
	
	</script>
