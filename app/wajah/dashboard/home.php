

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo number_format($nilaikas[0]["jumlah"]);?></h3>

              <p>Debet Kas</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo number_format($nilaiaset[0]["jumlah"]);?><sup style="font-size: 20px"></sup></h3>

              <p>Nilai Aset</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo number_format($nilaipiutang[0]["jumlah"]);?></h3>

              <p>Jumlah Piutang</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo number_format($nilaiutang[0]["jumlah"]);?></h3>

              <p>Jumlah Utang</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-md-6">
          <h3>Audit Trail</h3>
          <table width="100%" class="table table-striped table-bordered table-hover">

            <tbody>
                <?php 
                    foreach($log as $r){
                ?>
              <tr><td><b><?php echo $r["log_user"];?></b> <?php echo $r["log_desc"];?> pada <b><?php echo $r["log_time"];?></b></td></tr>
              <?php } ;?>
            </tbody>
          </table>
        </div>

        <div class="col-md-6">
            
            <h3>Web Services</h3>
            <table width="100%" border=1 class="table table-striped table-bordered table-hover">
                <tr>
                    <td width="20px"><b>Laporan Bulan</b></td>
                    <td width="20px">&nbsp;</td>
                    <td width="20px">&nbsp;</td>
                    <td width="20px">&nbsp;</td>
                </tr>
                <tr>
                    <td><select id="bulan" name="bulan" class="form-control">
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8" selected>Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">Nopember</option>
                        <option value="12">Desember</option>
                    </select></td><td>
                    <select id="tahun" name="tahun" class="form-control">
                        <option value="<?php $tahunmin = date('Y') - 1; echo $tahunmin;?>"><?php $tahunmin = date('Y') - 1; echo $tahunmin;?></option>
                        <option value="<?php $tahun = date('Y'); echo $tahun;?>"><?php $tahun = date('Y'); echo $tahun;?></option>
                        <option value="<?php $tahunplus = date('Y') + 1; echo $tahunplus;?>"><?php $tahunplus = date('Y') + 1; echo $tahunplus;?></option>
                    </select>&nbsp;<img id="imgLoader_1" src="<?php echo base_url();?>assets/images/loadingAnimation.gif
"></td>
                    <td><input type="button" class="btn btn-success btn-min" onclick="tojson($('#bulan').val(),$('#tahun').val());" value="Posting"></td><td>&nbsp;</td>
                    
                </tr>
            </table>
                    
          <h3>Pajak</h3>
          <table width="100%" class="table table-striped table-bordered table-hover">

            <tbody>
              <tr><td><b>Pembelian Barang</b> No Transaksi 32423432 pada<b>17-08-2017</b></td></tr>
              <tr><td><b>PPH Pegawai</b> No Transaksi 32423432 pada<b>17-08-2017</b></td></tr>
              
            </tbody>
          </table>
        </div>
        <!-- /.content -->
      </div>
  <!-- /.content-wrapper -->
  <script>
        server = "<?php echo $server;?>";
        $('#imgLoader_1').hide();
      function tojson(bulan,tahun){
          
        $('#imgLoader_1').show();
          $.ajax({
				  type:"get",
				  url:"<?php echo site_url('services/getLaporanAktivitas');?>",
				  data:"organisasi_id=1&bulan="+bulan+"&tahun="+tahun,
				  dataType: 'json',
				  success:
				  function(response){
					 TableData = JSON.stringify(response);
					 $.ajax({
        				  type:"post",
        				  url:server+"/index.php/services/aktivitas",
        				  data: "pTableData=" + TableData,
                          dataType: "html",
        				  success: function(data){
                                 $('#imgLoader_1').hide();
                                alert(data);
                            },
                            error: function(errorMsg) {
                                alert(errorMsg);
                            }
        			  })
				  },
				  error:
					function(){
						alert("Error. Ajax Service");
					}
			  })
      }
  </script>

 
