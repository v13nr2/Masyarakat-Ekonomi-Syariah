<script>
	path = "<?php echo base_url();?>";
	send_data = function(cb, name, aksi) {
		
        $.ajax({
      		url: path+"/acl_api/update?cmd="+aksi+"&id="+cb+"&val="+name,
		            dataType: "html",
		            data: {'name' : name},
		            type: "POST",
		            cache: false

		    }).success(function(data) {
		         alert(data);


		        }).fail(function(jqXHR, textStatus, errorThrown) {
					alert("fail send data");
		        }).always(function() {

		        });
				

		}



	$(document).ready(function() {

	    $(".cb").click(function() {
			var cb = $("#"+this.getAttribute( "id" ));
			var id = this.id;
			
	        //console.log(id);
	        //console.log(cb.val());
			//console.log(cb.is(":checked"));
			if (cb.is(":checked")) {
				send_data(id, this.value, "update");			
	        } else {
				send_data(id, this.value, "hapus");
	        }
	    });

	    //checked
	     $.ajax({
      		url: path+"/acl_api/ceked",
		            dataType: "json",
		            data: {'name' : 'nanang'},
		            type: "POST",
		            cache: false

		    }).success(function(data) {
		         for(var x=0; x < data.cizacl_resources_ceked.length; x++){ 
	    				$('#ck_'+data.cizacl_resources_ceked[x]["cizacl_resource_id"]+'_'+ data.cizacl_resources_ceked[x]["cizacl_rule_cizacl_role_id"]).attr('checked', true);
					}	

		        }).fail(function(jqXHR, textStatus, errorThrown) {
					alert("fail list checked");
		        }).always(function() {

		        });
				


	});
	</script>

<section class="content-header">
	<div class="row">
		<div class="col-md-3">
			<label class="label-header"><?=$judul?></label>
		</div>
		<div class="col-md-9">
		
		</div>
	 </div>
 </section>
 <section class="content">
	 <div class="row">
		 <div class="col-lg-12">
			 <?php if($this->session->userdata($this->config->item('ses_message'))) {echo $this->session->userdata($this->config->item('ses_message')); $this->session->unset_userdata($this->config->item('ses_message')); } ?>
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-user"></i>
					<h3 class="box-title"><?=$judul?></h3>
				</div>
				<div class="box-body">
					<table class="table table-condensed table-striped table-bordered table-hover table-responsive">
						<thead>
							<th>Group</th>
							<th>Sifat</th>
							<th>Controller</th>
							<th>Keterangan</th>
							<th style="width: 80px; text-align: center;">Aksi</th>
						</thead>
						<tbody>
							<?php foreach ($grup as $b)
							{
								echo '<tr><td width="30%"><a href="#demo_'. $b->cizacl_role_id . '"  data-toggle="collapse"><span class="glyphicon glyphicon-collapse-down">&nbsp;'.$b->cizacl_role_name.'</span></a></td>';
								echo '<td width="15%">'.$b->cizacl_role_description.'</td>';

								echo '<td width="15%">';

								echo '<td width="15%">';
								echo '<td align="center" width="10%"></td>'; echo '</tr>';

								echo '<tr id="demo_'. $b->cizacl_role_id . '" class="collapse">';
								echo '<td width="15%">';
								echo '<td width="15%">';

								echo '<td width="15%">
									<table border=0>';
									    foreach ($cizacl_resources as $c)
	        							{
	        								//$ceked = 'checked';
	        							    echo '<tr style="height:60px; "><td>';
	        							    echo '<input type="checkbox" onclick="cek();" class="cb" id="ck_'. $c->cizacl_resource_id .'_'. $b->cizacl_role_id .'"  value="'. $c->cizacl_resource_id .'#'. $b->cizacl_role_id . '#'. $c->cizacl_resource_controller;
	        							    echo $c->cizacl_resource_function != "" ? '#'.$c->cizacl_resource_function : "#null";
	        							    echo '"';
	        							   // echo ' '.$ceked.' ';
	        							    echo '> &nbsp;&nbsp;';
	        							    echo $c->cizacl_resource_controller;
	        							    echo $c->cizacl_resource_function != "" ? '/'.$c->cizacl_resource_function : "";
	        							    echo '</tr></td>';
	        							}
									    
								echo '
									</table></td>';
								echo '<td width="15%"><table border=0>';
								    foreach ($cizacl_resources as $d)
        							{
        							    echo '<tr style="height:60px; "><td>';
								        echo $d->cizacl_resource_description !='' ? $d->cizacl_resource_description : '&nbsp;';
								        echo '</tr></td>';
        							}
								echo '</table></td></tr>';

							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

