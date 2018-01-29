<section class="content-header">
	<div class="row">
		<div class="col-md-5">
			<label class="label-header">Tambah Dokumentasi</label>
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
  <div class="panel-heading"><b>Tambah Dokumentasi</b></div>
  <div class="panel-body">
  <?php  if(validation_errors() != false) {echo alert_php2('', 'validate', validation_errors()); } ?>
  <?php echo $this->session->flashdata('pesan')?>
     <form action="<?=base_url()?>dokumentasi/insert" method="post" enctype="multipart/form-data">
       <table class="table table-striped">

         <tr>
          <td style="width:15%;">File Screenshoot</td>
          <td>
            <div class="col-sm-6">
                <input type="file" name="filefoto" class="form-control">
            </div>
            </td>
         </tr>
          <td style="width:15%;">Nama Modul</td>
          <td>
            <div class="col-sm-10">
				<input type="hidden" name="id" value="">
                <input type="text" name="nama_modul" class="form-control" value="">
				</div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Penjelasan Modul</td>
          <td>
            <div class="col-sm-10">
                <textarea name="penjelasan_modul" class="form-control" ></textarea>
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Akses Menu</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="akses_menu" class="form-control" value="">
            </div>
            </td>
         </tr>
         <tr>
          <td style="width:15%;">Level Pengguna</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="level_pengguna" class="form-control" value="">
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
