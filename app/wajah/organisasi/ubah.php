<section class="content-header">
	<div class="row">
		<div class="col-md-5">
			<label class="label-header">Ubah Organisasi</label>
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
  <div class="panel-heading"><b>Ubah Organisasi</b></div>
  <div class="panel-body">
  <?php  if(validation_errors() != false) {echo alert_php2('', 'validate', validation_errors()); } ?>
  <?php echo $this->session->flashdata('pesan')?>
     <form action="<?=base_url()?>upload/update" method="post" enctype="multipart/form-data">
       <table class="table table-striped">

	   
	 
								
								
								
         <tr>
          <td style="width:15%;"></td>
          <td>
            <div class="col-sm-6">
                  <?php
				  if($organisasi["nm_gbr"] !=""){
								?>
								 <img src="<?php echo base_url();?>/assets/uploads/<?php echo $organisasi["nm_gbr"];?>" height="100px">
								<?php } ?>
            </div>
            </td>
         </tr>					
								
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
				<input type="hidden" name="id" value="<?php echo $organisasi["id"];?>">
                <input type="text" name="nama_organisasi" class="form-control" value="<?php echo $organisasi["nama_organisasi"];?>">
				</div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Alamat Organisasi</td>
          <td>
            <div class="col-sm-10">
                <textarea name="alamat" class="form-control" ><?php echo $organisasi["alamat"];?></textarea>
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
          <td style="width:15%;">Nama Pimpinan</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="nama_pimpinan" class="form-control" value="<?php echo $organisasi["nama_pimpinan"];?>">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Pimpinan Harian</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="pimpinan_harian" class="form-control" value="<?php echo $organisasi["pimpinan_harian"];?>">
            </div>
            </td>
         </tr><tr>
          <td style="width:15%;">Propinsi</td>
          <td>
            <div class="col-sm-10">
                <select name="id_provinsi"  id="id_provinsi" class="form-control">
				<option value="">-- Pilih Provinsi --</option>
									<?php
									foreach($provinsi as $p){
										if($p->id==$prop["id_provinsi"]){
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
				<?php
									foreach($kabupaten as $p){
										if($p->kabupaten_id==$kab["id_kabupaten"]){
											$select = "selected";
										}else{
											$select = "";
										}
										echo "<option $select value='$p->kabupaten_id'>$p->kabupaten_nama</option>";
									}
									?>
				</select>
            </div>
            </td>
         </tr>
         <tr>
         <tr>
          <td style="width:15%;">Jenjang Organisasi</td>
          <td>
            <div class="col-sm-10">
                <select name="jenjang"  id="jenjang" class="form-control">
                    <option value="0">-Pilih-</option>
				<?php
									foreach($jenjang as $p){
										if($p->id_jenjang==$jenjang_id["jenjang"]){
											$select = "selected";
										}else{
											$select = "";
										}
										echo "<option $select value='$p->id_jenjang'>$p->nama_jenjang</option>";
									}
									?>
				</select>
			</div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Induk Organisasi</td>
          <td>
            <div class="col-sm-10">
			<select name="induk_organisasi"  id="induk_organisasi" class="form-control">
                <option value="0" <?php if($org["induk_organisasi"]==0){ ?> selected="selected" <?php }?>>-- Pilih Induk Organisasi --</option>
									<?php
									foreach($organisasiCB as $p){
										if($p->id==$org["induk_organisasi"]){
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
          <td style="width:15%;">API Secret</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="api_web_service" class="form-control" value="<?php echo $organisasi["api_web_service"];?>">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">SERVER API</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="server" class="form-control" value="<?php echo $organisasi["server"];?>">
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