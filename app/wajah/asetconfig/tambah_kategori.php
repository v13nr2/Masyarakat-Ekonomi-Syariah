  <script type="text/javascript">
$(document).ready(function(){
	$.each($('.kanan'), function()
    {
       $(this).keyup( function(){ 
	   		$(this).val(formatCurrency($(this).val()));
		} );
    });
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

<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				 <a href="<?=base_url()?>asetconfig/kategori"  ><img src="<?php echo base_url().'assets/images/icon/list2.png';?>" height="50px" title="Daftar Kategori Aset"></a>
			</div>
		</div>
	</div>
</div>
<div class="panel panel-default">
  <div class="panel-heading"><b>Tambah Kategori Aset</b></div>
  <div class="panel-body">
  <?php  if(validation_errors() != false) {echo alert_php2('', 'validate', validation_errors()); } ?>
  <?php echo $this->session->flashdata('pesan')?>
     <form action="<?=base_url()?>asetconfig/insert_kategori" method="post" enctype="multipart/form-data">
       <table class="table table-striped">
          <tr>
          <td style="width:25%;">Kategori Aset</td>
          <td>
            <div class="col-sm-10">
				
                <input type="text" name="jenis" class="form-control" value="">
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


    </div> <!-- /container -->
	<script>
	
		$('#document').ready(function(){
			$('#tgl').datepicker({
				format: 'dd/mm/yyyy',
				startDate: '-3d'
			});
		});
	
	</script>
