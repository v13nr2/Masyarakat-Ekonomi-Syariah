  <style type="text/css">
  .btn {
    width: 70px;
    height: 35px;
  }
  th {
  text-align: center;
  }
  .modal-footer .btn {
    width: 75px;
  }
  .container a{
    text-decoration: none;
  }
  </style>

<section class="content">

  <div class="row">

  <p><h2>List Keuangan Karyawan November 2017 </h2></p>                                          
  <table class="table table-condensed table-striped table-bordered table-hover table-responsive">
    <tr>
      <th width="50px">No</th>
      <th>Nama Pegawai</th>
      <th>Jabatan</th>
      <th width="100px"></th>
    </tr>
    <?php $no=1; foreach ($karyawan as $b)
              {
                ?>
            <tr>
              <td height="50" style="padding: 10px;"><?php echo $no;?></td>
              <td style="padding: 10px;"><a href="#demo_<?php echo $b->id;?>" data-toggle="collapse"><span class="glyphicon glyphicon-collapse-down"><?php echo $b->nama_pegawai;?></span></a></td>
              <td style="padding: 10px;"></td>
              <td align="center"><?php echo $b->jabatan;?></td>
            </tr> 
            <tr id="demo_<?php echo $b->id;?>" class="collapse">
            <!-- <div id="demo" class="collapse">  -->
              <td rowspan="4" colspan="4">
              <table width="100%" border="1" style="border-collapse: collapse;">
                  <th width="50px">
                    
                  </th>
                  <th width="50px">
                    No.
                  </th>
                  <th>
                    Parameter
                  </th>
                  <th>
                    Jumlah
                  </th>
                  <th width="100px">
                    Posting
                  </th>
                  <?php $no2 = 1; $jumlahSub = 0; foreach ($listKeu as $k) {
                    if($k->pegawai_id===$b->id){
                   ?>
                     
                      <tr>
                        <td></td>
                        <td align="center"><?php echo $no2; ?></td>
                        <td><?php echo $k->nama_keuangan;?></td>
                        <td><input type="text" name="sdf" id="<?php echo $b->id;?>_<?php echo $k->id;?>" value="<?php echo $k->jumlah; $jumlahSub = $jumlahSub + $k->jumlah?>"></td>
                        <td align="center" style="padding: 10px;"><button type="button" onclick="postingParam(<?php echo $b->id;?>, <?php echo $k->id;?>, $('#'+<?php echo $b->id;?>+'_'+<?php echo $k->id;?>).val(), '<?php echo $k->id_akun_debet;?>','<?php echo $k->id_akun_kredit;?>');" class="btn btn-success">Posting</button></td>
                      </tr>
                  <?php $no2++; }} ?>
              <tr>
                <td ></td>
                <td colspan="2">Total</td>
                <td><?php echo number_format($jumlahSub);?></td>
                <td align="center" ><button type="button" onclick="Cetak(<?php echo $b->id;?>)" class="btn btn-success">Cetak</button></td>
              </tr>
              </table>
              </div>
              </td>
            </tr>
            <tr>
            </tr>
            <tr>
            </tr>
            <tr>
            </tr>
        <?php $no++; } ?>
    
  </table>
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <table class="table table-condensed table-responsive" rules="all">
            <tr>
              <td width="50">No.</td>
              <td>Nama Parameter Gaji</td>
              <td>Jumlah</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Gaji</td>
              <td></td>
            </tr>
            <tr>
              <td>2</td>
              <td>Kesehatan</td>
              <td></td>
            </tr>
            <tr>
              <td>3</td>
              <td>Pinjaman</td>
              <td></td>
            </tr>
            <tr>
              <td>4</td>
              <td>Lorem</td>
              <td></td>
            </tr>
            <tr>
              <td>5</td>
              <td>Lorem</td>
              <td></td>
            </tr>

          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
          <span class="glyphicon glyphicon-remove"></span>
          Close
          </button>
          <button type="button" class="btn btn-success">
            <span class="glyphicon glyphicon-floppy-disk"></span>
            Save  
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
  </div>
</section>
<script>
  function postingParam(idkaryawan, paramgaji, nilai, gldebet, glkredit){
    jawab = confirm('Apakah data sudah benar ?');
    if(jawab){
      //alert(idkaryawan+', '+paramgaji+', '+nilai+', '+gldebet+', '+glkredit);
      $('#imgLoader_1').show();
            $.ajax({
            type:"post",
            url:"<?php echo site_url('services/paramgaji');?>",
            data:"organisasi_id=1&idkaryawan="+idkaryawan+"&paramgaji="+paramgaji+"&nilai="+nilai+"&d="+gldebet+"&k="+glkredit,
            dataType: 'html',
            success:
            function(response){
              alert(response);
             
            },
            error:
            function(){
              alert("Error. Ajax Service");
            }
          })

    }
  }
</script>