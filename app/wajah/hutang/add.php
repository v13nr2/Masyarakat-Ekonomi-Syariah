<link rel="stylesheet" href="<?php echo base_url('assets/autocomplete/jquery-ui.css');?>">

  <script src="<?php echo base_url('assets/autocomplete/jquery-ui.js');?>"></script>
<section class="content-header">
	<div class="row">
		<div class="col-md-5">
			<label class="label-header">Tambah Daftar Hutang</label>
		</div>
	</div>
</section>
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				 <a href="<?=base_url()?>hutang/listht"  class="btn btn-primary" type="button" >Ke Daftar Hutang</a>
			</div>
		</div>
	</div>
</div>
	<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Jurnal Piutang / JP</h3>
			</div>
			<div class="box-body">
				<div id='sukses' class="alert alert-success alert-dismissable collapse">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Success</h4>
                </div>
				<div id='rusak' class="alert alert-danger alert-dismissable collapse">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Error</h4>
                </div>
				<form class="form-horizontal" id="form" method="POST" >
					<!--
					<div class="col-md-6">
						<div class="form-group ui-widget">
							<label class="control-label col-sm-3" for="nama">No Jurnal</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="nojurnal" name="nojurnal" placeholder="Nomor Jurnal" required>
								<input type="hidden" class="form-control" id="txtsupp" name="txtsupp"/>
							</div>
						</div>
					</div>
					-->
					<div class="col-md-6">
						<div class="form-group ui-widget">
							<label class="control-label col-sm-3" for="nama">No. Bukti</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="nobukti" name="nobukti" placeholder="Nomor Nota" required>
								<input type="hidden" class="form-control" id="nonota" name="nonota"/>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-sm-3" for="nama">Tanggal</label>
							<div class="col-sm-6">
								<input type="text" name="tgl" class="form-control" id="tgl" placeholder="Tanggal" required>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-sm-3" for="nama">Keterangan</label>
							<div class="col-sm-6">
								<input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Keterangan" required>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-sm-3" for="nama">Pemasok</label>
							<div class="col-sm-6">
								  <select name="kreditur"  id="kreditur" class="form-control">
                    				<option value="">-- Pilih Pemasok --</option>
                    									<?php
                    									foreach($pemasok as $p){
                    										if($p->id==$prov){
                    											$select = "selected";
                    										}else{
                    											$select = "";
                    										}
                    										echo "<option $select value='$p->id'>$p->nama_penyedia</option>";
                    									}
                    									?>
                    				</select>
							</div>
						</div>
					</div>
				<div class="row">
					<div class="col-md-12">
						<div class="box box-solid box-primary">
							<div class="box-header">
								<h3 class="box-title">Detail</h3>
								<div class="box-tools pull-right">
									<a class="btn btn-sm btn-warning" id="btnAdd"><i class="fa fa-plus"></i> Add</a>
								</div>
							</div>
							<div class="box-body">
								
								<table id="tableMenu" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th width="50%">Kode Rekening</th>
											<th width="10px"></th>
											<th width="25%">Debet</th>
											<th width="25%">Kredit</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody id="tbl_content">
						
									</tbody>
								</table>
								
							</div>
						</div>
					</div>
				</div>
				<button class="btn btn-primary" type="submit">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</div>



 <!-- /.modal -->

        <div class="modal modal-info fade" id="modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Info Modal</h4>
              </div>
              <div class="modal-body">
                
			<div class="box box-primary" style="color:black">
				<div class="box-header">
					<i class="fa fa-credit-card"></i>
					<h3 class="box-title">Daftar Akun (COA)</h3>
				</div>
				<div class="box-body">
					<table width="100%" id="dtcustomt" class="table table-striped table-bordered table-hover">
						<thead>
							<th>Kode Akun</th>
							<th>Nama Akun</th>
							<th>Induk Akun</th>
							<th>Tipe Akun</th>
							<th>Saldo Normal</th>
							<th>Lokasi</th>
							<?php /*<th>Posisi</th> <th>Tanggal Dibuat</th> <th>Tanggal Diubah</th>*/?>
							
						</thead>
						<tbody>
							<?php foreach ($akun as $b)
							{
								$nama_akun = $b->level==0 ? '<b>'.$b->nama_akun.'</b>' : $b->nama_akun;
								$kode_akun = $b->level==0 ? '<b>'.$b->kode_akun.'</b>' : $b->kode_akun;
								$saldo_normal   = $b->saldo_normal=="D"?"Debet":"Kredit";
								$lokasi         = $b->lokasi=="Neraca"?"Neraca":"Profit and Loss";
								if($b->level==1){
									$sign = '-';
								}else if($b->level==2){
									$sign = '--';	
								}else if($b->level==3){
									$sign = '---';	
								}else if($b->level==4){
									$sign = '----';	
								}else if($b->level==5){
									$sign = '-----';	
								}else if($b->level==6){
									$sign = '------';	
								}else if($b->level==7){
									$sign = '-------';	
								}else{
									$sign = '';
								}
								if($b->aktif=="A")
								{
									echo '<tr>';
								}
								else
								{
									echo '<tr class="danger">';
								}
								echo '<td>'.$kode_akun.'</td>';
								echo '<td><a href="#" onclick="pilihCoa(\''.$b->id_akun.'\',\''.$b->nama_akun.'\')">'.$sign.'-'.$nama_akun.'</a></td>';
								echo '<td>'.$b->induk_akun.'</td>';
								echo '<td>'.$b->nama_tipe_akun.'</td>';
								echo '<td>'.$saldo_normal.'</td>';
								echo '<td>'.$lokasi.'</td>';
								/*echo '<td class="text-right">'.$b->posisi.'</td>';
								//echo '<td class="text-right">'.$b->tgl_dibuat.'</td>';
								//echo '<td class="text-right">'.$b->tgl_diubah.'</td>';*/
								 ?>
								
								<?php echo '</tr>';
							} ?>
						</tbody>
					</table>
				</div>
			</div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


</div>
<script type="text/javascript">
	var id_pilihan = 0;
	function pilihan(x){
		id_pilihan = x;
	}
	function pilihCoa(kode,nama){
		$.ajax({
			  type:"post",
			  url:"<?php echo base_url('/coa/getLast');?>",
			  data:"id="+kode,
			  dataType: 'html',
			  success:
			  function(response){
				 if(response=="No"){
					alert("Bukan rekening node akhir. Silakan Pilih Lagi. Code = "+kode);
					$("#txtnorek1"+id_pilihan).val('');
					$("#txtnorek"+id_pilihan).val('');
					return false;
				 }
			  },
			  error:
				function(){
					alert("Error. Data Tidak Tersimpan");
				}
		  });
		  
		$("#txtnorek"+id_pilihan).val(nama);
		$("#txtnorek1"+id_pilihan).val(kode);
	}
	$(function() {
		
		$("#tgl").datepicker({'dateFormat':'dd-mm-yy'});
	});
	
	var i=0;
	var specialKeys = new Array();
	specialKeys.push(8);
	
	$("#btnAdd").click(function(){
		i++;
		$('#tbl_content').append(tmp(i));
	});
	
	$("#form").submit(function(e){
		var totalDebet = 0;
		var totalKredit = 0;
		var i = 1;
		var j = 1;
		var input;
		while( ( input = document.getElementById( 'debet_'+i ) ) !== null ) {
			totalDebet += parseInt( input.value );
			++i;
		}
		//alert( totalDebet );
		while( ( inputj = document.getElementById( 'kredit_'+j ) ) !== null ) {
			totalKredit += parseInt( inputj.value );
			++j;
		}
		//alert( totalKredit );
		if(totalDebet!=totalKredit){
			alert("Total Debet dan Total Kredit Tidak Sama");
			return false;
		}
					
				e.preventDefault();
				$.ajax({
					type:'POST',
					url:'<?php echo base_url('/hutang/simpan')?>',
					dataType: "json",
					data:$(this).serialize(),
					success:function(result){
						if(result.status){
							$('#sukses').removeClass('collapse');
							$('#sukses').append(result.msg);
							setTimeout(function() {
								$('#sukses').addClass("collapse");
							}, 2000);
						}else{
							$('#rusak').removeClass('collapse');
							$('#rusak').append(result.msg);
						}
						console.log(result.status);
					}
				}).done(function() {
					$("#form").trigger("reset");
					$('#tbl_content').empty();
				});
		
	});
	
	function tmp(id){
		var html_out="";
		html_out += "<tr id='row"+id+"'>";
		html_out += "<td>";
		html_out += "<input type='text' id='txtnorek"+id+"' onfocus='norekFocus("+id+")' class='form-control' name='txt_norek[]' placeholder='Kode Rekening' required/>";
		html_out += "</td><td width='10px'><button type='button' class='btn btn-info' data-toggle='modal' onclick='pilihan("+id+")' data-target='#modal-info'>Coa</button><input type='hidden' name='id_akun[]' id='txtnorek1"+id+"'/></td><td>";
		html_out += "<input type='text' class='form-control' name='txt_debet[]'  id='debet_"+id+"'  value='0' placeholder='Debet'/></td>";
		html_out += "<td><input type='text' class='form-control' id='kredit_"+id+"'  name='txt_kredit[]' placeholder='Kredit' value='0'/></td>";
		html_out += "<td class='text-right'><a href='#' onclick='hapus("+id+")' class='btn btn-sm btn-danger'>Delete</a></td>";
		html_out += "</tr>";
		return html_out;
	} 
	
	function hapus(id){
		$("#row"+id).remove();
	}
	
	function norekFocus(id){
		var dtID;
		$("#txtnorek"+id).autocomplete({
			source: function( request, response ) {
				$.ajax({
					dataType: "json",
					type : 'POST',
					data:{
						term: request.term,
					},
					url: '<?php echo base_url('/coa/getCoa')?>',
					success: function(data) {
						var dt = [];
						$("#txtnorek"+id).removeClass('ui-autocomplete-loading');
						response(data);
					},
					error: function(data) {
						$("#txtnorek"+id).removeClass('ui-autocomplete-loading');  
					}
				});
			},
			select: function(event, ui) {
				dtID = ui.item.id;
				
						//cek rekening akhir
						$.ajax({
						  type:"post",
						  url:"<?php echo base_url('/coa/getLast');?>",
						  data:"id="+dtID,
						  dataType: 'html',
						  success:
						  function(response){
							 if(response=="No"){
								alert("Bukan rekening node akhir. code : "+dtID);
								$("#txtnorek1"+id).val('');
								$("#txtnorek"+id).val('');
								return false;
							 }
						  },
						  error:
							function(){
								alert("Error. Data Tidak Tersimpan");
							}
					  });
			},
			close: function() {
				$("#txtnorek1"+id).val(dtID);
			}
		});
	}
	
	function IsNumeric(e) {
		var keyCode = e.which ? e.which : e.keyCode
		var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
		return ret;
	}

</script>