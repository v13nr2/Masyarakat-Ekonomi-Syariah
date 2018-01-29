<section class="content-header">
	<div class="row">
		<div class="col-md-12">
			<label class="label-header"><?=$judul?></label>
		</div>
	</div>
</section>
<style> .form-horizontal .control-label2 { text-align: left; } </style>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li><a href="<?=base_url('proyek/detail');?>?id=<?php echo $_GET["id"];?>&idProyek=<?php echo $_GET["idProyek"];?>">DATA</a></li>
					<li><a href="<?=base_url('proyek/resume');?>?id=<?php echo $_GET["id"];?>&idProyek=<?php echo $_GET["idProyek"];?>">POSISI KEUANGAN</a></li>
					<li><a href="<?=base_url('proyek/kasmasuk');?>?id=<?php echo $_GET["id"];?>&idProyek=<?php echo $_GET["idProyek"];?>">KAS MASUK</a></li>
					<li class="active"><a href="<?=base_url('proyek/kaskeluar');?>?id=<?php echo $_GET["id"];?>&idProyek=<?php echo $_GET["idProyek"];?>">KAS KELUAR</a></li>
				</ul> <div class="tab-content">
					<div class="tab-pane active">
						<form class="form-horizontal" method="get" action="<?=base_url('laporan/jurnal')?>">
												
						</form>
						<hr/>
						<div class="row">
							<div class="col-lg-12">
								
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">PENGELUARAN KAS / BANK</h3>
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
					<div class="col-md-4">
						<div class="form-group ui-widget">
							<label class="control-label col-sm-6" for="nama">No Jurnal</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="nojurnal" name="nojurnal" placeholder="Nomor Jurnal" required>
								<input type="hidden" class="form-control" id="txtsupp" name="txtsupp"/>
							</div>
						</div>
					</div>
					-->
					<div class="col-md-4">
						<div class="form-group ui-widget">
							<label class="control-label col-sm-5" for="nama">Kas/Bank</label>
							<div class="col-sm-7">
								<select name="coa_kredit"  class="form-control" required>
								<option value="">-Pilih-</option>
								<?php
									foreach($kasbank as $p){
										if($p->id_akun==$akun){
											$select = "selected";
										}else{
											$select = "";
										}
										echo "<option $select value='$p->id_akun'>$p->nama_akun</option>";
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group ui-widget">
							<label class="control-label col-sm-5" for="nama">No. Bukti</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="nobukti" name="nobukti" placeholder="Nomor Nota" required>
								<input type="hidden" class="form-control" id="nonota" name="nonota"/>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label col-sm-5" for="nama">Tanggal</label>
							<div class="col-sm-7">
								<input type="text" name="tgl" class="form-control" id="tgl" placeholder="Tanggal" required>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label col-sm-5" for="nama">Memo</label>
							<div class="col-sm-7">
								<input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Keterangan" required>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label col-sm-5" for="nama">Program</label>
							<div class="col-sm-7">
								
								<?php
									foreach($proyek_detail as $p){
									?>
									<input type="hidden" value="<?php echo $p->id_program;?>" name="program">
									<?php									
										echo $p->no_program;
									}
								?>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label col-sm-5" for="nama">Proyek</label>
							<div class="col-sm-7">
								<?php
									foreach($proyek_detail as $p){
										?>
									<input type="hidden" value="<?php echo $p->id;?>" name="proyek">
									<?php	
										echo $p->nama_proyek;
									}
								?>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label col-sm-5" for="nama">Sumber Dana</label>
							<div class="col-sm-7">
								<select name="sumberdana"  class="form-control" required>
								<option value="">-Pilih-</option>
								<?php
									foreach($sumberdana as $p){
								
										echo "<option $select value='$p->id'>$p->kategori_dana</option>";
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label col-sm-5" for="nama">Departemen</label>
							<div class="col-sm-7">
							<select name="departemen"  class="form-control">
								<option value="">-Pilih-</option>
								<?php
									foreach($departemen as $p){
										
										echo "<option $select value='$p->id'>$p->nama_departemen</option>";
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label col-sm-5" for="nama">Penyedia</label>
							<div class="col-sm-7">
								<select name="penyedia"  id="penyedia" class="form-control" required>
								<option value="">-- Pilih Penyedia --</option>
													<?php
													foreach($penyedia as $p){
														if($p->nama_penyedia==$nama_penyedia){
															$select = "";
														}else{
															$select = "";
														}
														echo "<option $select value='$p->nama_penyedia'>$p->nama_penyedia</option>";
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
											<th width="50%">Debet</th>
											<th width="10px"></th>
											<th width="25%">Keterangan</th>
											<th width="25%">Jumlah</th>
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
	</section>
 <script type="text/javascript">
$(document).ready(function(){
/* 	$.each($('.kanan'), function()
    {
       $(this).keyup( function(){ 
	   		$(this).val(formatCurrency($(this).val()));
		} );
    }); */


});

function formatCurrency(num) {
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+','+
		num.substring(num.length-(4*i+3));
		//return (((sign)?'':'-') + '$' + num + '.' + cents);
		return (((sign)?'':'-') + num);
	}

function clearNum(number){
	while(String(number).indexOf(',') > -1){
	 number = String(number).replace(',','');
	}
	return number;
}
	function hitungSusut(){
		nilai = clearNum(document.getElementById("nilai").value) * 1;
		bagi = clearNum(document.getElementById("bagi").value) * 1;
		tarif = clearNum(document.getElementById("tarif").value) * 1;
		susut = nilai / 1 * tarif / 100;
		document.getElementById("susut").value = formatCurrency(susut);
		document.getElementById("tarif").value = 100/bagi;
	}
	
	var id_pilihan = "";
	function pilihan(x){
		id_pilihan = x;
		//alert(id_pilihan);
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
					$("#"+id_pilihan).val('');
					$("#rek_"+id_pilihan).val('');
					return false;
				 }
			  },
			  error:
				function(){
					alert("Error. Data Tidak Tersimpan");
				}
		  });
		  
		$("#"+id_pilihan).val(nama);
		$("#rek_"+id_pilihan).val(kode);
	}
	
</script>
<style>
input.kanan{ text-align:right; }
</style>

<script>
	function formatCurrency(num) {
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+','+
		num.substring(num.length-(4*i+3));
		//return (((sign)?'':'-') + '$' + num + '.' + cents);
		return (((sign)?'':'-') + num);
	}

function clearNum(number){
	while(String(number).indexOf(',') > -1){
	 number = String(number).replace(',','');
	}
	return number;
}

		$('#document').ready(function(){
			$('#program').change(function(){
				$("#proyek").empty();
				$.ajax({
				  type:"post",
				  url:"<?php echo base_url('kas/getComboProyek');?>",
				  data:"id="+$('#program').val(),
				  dataType: 'json',
				  success:
				  function(response){
					 //
					 $.each(response, function () {
							$("#proyek").append($("<option></option>").val(this['id']).html(this['nama_proyek']));
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
<script type="text/javascript">
	var id_pilihan = 0;
	function pilihan(x){
		id_pilihan = x;
	}
	
	function inputnilai(x){
		$('#debet_'+x).val(formatCurrency($('#debet_'+x).val()));
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
		
		while( ( inputj = document.getElementById( 'debet_'+j ) ) !== null ) {
			totalDebet += parseInt(  (clearNum(inputj.value)) );
			++j;
		}
		//alert( totalKredit );
		 
			oke = confirm("Akan menjurnal sejumlah "+totalDebet+" ?");
			if(oke == true){
					
				e.preventDefault();
				$.ajax({
					type:'POST',
					url:'<?php echo base_url('/proyek/simpankaskeluar')?>',
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
			} else {
				return false;
			}
		 
				
		
	});
	
	function tmp(id){
		var html_out="";
		html_out += "<tr id='row"+id+"'>";
		html_out += "<td>";
		html_out += "<input type='text' id='txtnorek"+id+"' onfocus='norekFocus("+id+")' class='form-control' name='txt_norek[]' placeholder='Kode Rekening' required/>";
		html_out += "</td><td width='10px'><button type='button' class='btn btn-info' data-toggle='modal' onclick='pilihan("+id+")' data-target='#modal-info'>Coa</button><input type='hidden' name='id_akun[]' id='txtnorek1"+id+"'/></td><td>";
		html_out += "<input type='text' class='form-control' name='txt_keterangan[]'  id='keterangan_"+id+"'  value='' placeholder='Keterangan'/></td>";
		html_out += "<td><input type='text' class='form-control' id='debet_"+id+"'    onkeyup='inputnilai("+id+")'   name='txt_debet[]' placeholder='Debet' value='0'/></td>";
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