<section class="content-header">
	<div class="row">
		<div class="col-md-4">
			<label class="label-header"><?=$judul?></label>
		</div>
		<div class="col-md-8">
			<div class="pull-right">
				<a href="<?=base_url('program/tambah')?>" class="btn btn-sm btn-success"><img src="<?=base_url('assets/resources/add.png');?>" /> Tambah Program</a>
				<a href="<?=base_url('proyek/tambah')?>" class="btn btn-sm btn-success"><img src="<?=base_url('assets/resources/add.png');?>" /> Tambah Proyek</a>
			</div>
		</div>
	 </div>
 </section>
 <section class="content">
 <div class="well">
 	<select class="form-control" id="tahunProgram">
 		<option value="2016">2016</option>
 		<option value="2017" selected>2017</option>
 		<option value="2018">2018</option>
 	</select>
 </div>

	 <div class="row">
	 
		<div id="KontenHeading">
			
		</div>
		 <div class="col-lg-12">
			 <?php if($this->session->userdata($this->config->item('ses_message'))) {echo $this->session->userdata($this->config->item('ses_message')); $this->session->unset_userdata($this->config->item('ses_message')); } ?>
			<div class="box box-primary" style="display:none">
				<div class="box-header">
					<i class="fa fa-user"></i>
					<h3 class="box-title"><?=$judul?></h3>
				</div>
				<div class="box-body">
					<table width="100%" id="dtcustomt2" class="table table-striped table-bordered table-hover">
						<thead>
							<th>No Program</th>
							<th>Keterangan</th>
                     <th>Tangal Dibuat</th>
                     <th>Opsi</th>
							<th>Opsi</th>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	$(document).ready(function(){
		$('#tahunProgram').change(function(){
			tampil_append_rowHead();
			//tampil_append_row();
		});
		tampil_append_rowHead();
		//tampil_append_row();
	});
	
	function tampil_append_row(){
		x = $('#tahunProgram').val();
		$.ajax({
			  type:"get",
			  url:"<?php echo site_url('program/display');?>",
			  data:"cari="+x,
			  dataType: 'html',
			  success:  function(response){	
					$('.appendx').remove();
					$('#dtcustomt2').append(response);
					/* $('#dtcustomt2').DataTable( {
							paging: true,
							searching: true,
							"order": [[ 1, "asc" ]]
						} ); */
			  },
			  error: function(){
					alert("eror");
				}
		  });
	}
	
	function tampil_append_rowHead(){
		x = $('#tahunProgram').val();
		$.ajax({
			  type:"get",
			  url:"<?php echo site_url('program/displayHeading');?>",
			  data:"cari="+x,
			  dataType: 'html',
			  success:  function(response){	
					$('#KontenHeading').html(response);
					/* $('#dtcustomt2').DataTable( {
							paging: true,
							searching: true,
							"order": [[ 1, "asc" ]]
						} ); */
			  },
			  error: function(){
					alert("eror");
				}
		  });
	}
	
</script>
