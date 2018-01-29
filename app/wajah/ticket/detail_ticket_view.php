<link rel="stylesheet" type="text/css" href="assets/datatables/media/css/dataTables.bootstrap4.min.css"/>

<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>

<style type="text/css">
.dataTables_filter {
  margin-right: 10px;
}

.panel
{
  margin-left: 0;
  margin-right: 0;
  margin-top: 15px;
  position: relative;
  padding: 0 15px 15px;
}

.panel-default
{
  color: #333;
  background-color: #ffffff;
  border-color: #ddd;
}


</style>


<section class="content">
  <div class="row">
  	<div class="col-md-12">
  		<div class="box">
  			<div class="box-header">
  		      <h1 class="page-header">Lihat Tiket #<?=$idticket;?></h1>
            <p>
              <b>Nama Tiket:</b><br/>
              Pembatalan Pesanan
            </p>
            <p>
              <b>Detail:</b><br/>
              Saya ingin melakukan pembatalan pesanan<br/>
              nomor tagihan : #643742<br/>
              Terima kasih<br/>
              Dony<br/>
            </p>
  			</div>
  		</div>

      <div class="box box-info">
  			<div class="box-header">
            <p>
              <b>Nama Tiket:</b><br/>
              Pembatalan Pesanan
            </p>
            <p>
              <b>Detail:</b><br/>
              Dengan hormat,<br/>
              <br/>
              Kami informasikan tagihan anda telah kami batalkan. Silahkan anda cek kembali.<br/>
              <br/>
              Terima kasih atas kepercayaan anda dalam menggunakan jasa dan layanan PT. ABC.<br/>
              <br/>
              <br/>
              Best regards,<br/>
              Wahyu<br/>
              info@ab.com<br/>
              <br/>
              Terima kasih atas kepercayaan anda!<br/>
              <br/>
              ===================================<br/>
              <br/>
              PT. ABC<br/>
              Gedung Batre Lt. 10<br/>
              Jl. Kuningan Hijau No. 8<br/>
              Jakarta 12710<br/>
              http://www.abc.com<br/>
              info@abc.com<br/>
              Telp. (021) 5269300<br/>
              Fax. (021) 5269300<br/>
              <br/>
              layanan pelanggan :<br/>
              * Technical Support - 24 jam<br/>
              * Billing, Finance & Administrasi - Senin - Jum?at ( 08.30 - 16.30 )<br/>
              * Info, Sales, Marketing - Senin - Jum?at ( 08.30 - 16.30 )<br/>
            </p>
  			</div>
  		</div>

      <div class="box">
  			<div class="box-header">
            <p>
              <h1 class="page-header">Balasan Tiket #<?=$idticket;?></h1>
              <form>
                <div class="form-group">
                  <label for="inputIDTicket">ID Tiket</label>
                  <input type="text" class="form-control" id="inputIDTicket" value="1" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Subjek Tiket</label>
                  <input type="text" class="form-control" id="inputNameTicket" value="Pembatalan Pesanan" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Isi Pesan</label>
                  <textarea class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-default">Simpan</button>
                <a href="<?=base_url()?>ticket" class="btn btn-default">Batal</a>
              </form>
            </p>
  			</div>
  		</div>
  	</div>
  </div>
</section>
