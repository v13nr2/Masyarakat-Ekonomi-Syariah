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

<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>


<section class="content">
  <div class="panel panel-default">
    <div class="container">
      <div class="row>">
        <div class="col-lg-12">
              <h1 class="page-header">Tiket Support</h1>
              <p>
                Dengan sistem Tiket Support Anda dapat melaporkan pertanyaan/masalah Anda dan akan kami jawab.
                Sistem ini mirip email, hanya saja berbasis web dan semua tiket tercatat di database kami untuk tracking/monitoring yang lebih baik.
                Saat kami merespon tiket Anda, Anda akan diberitahu lewat email.
              </p>

              <p style="align: right;">
                <a href="<?=base_url()?>ticket/submitticket">
                  <img src="<?php echo base_url().'assets/images/icon/add.png';?>" height="50px" title="Tambah Ticket Support Baru">
                </a>
              </p>

              <table class="dtable table responsive table-bordered table-hover display" cellspacing="0" id="example" >
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Subjek</th>
                    <th>Status</th>
                    <th>Type</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                      <td>30/06/2017 10:36</td>
                      <td><a href="<?=base_url()?>ticket/viewticket/1">Pembatalan pesanan</a></td>
                      <td>Ditutup</td>
                      <td>Normal</td>
                  </tr>
                </tbody>
              </table>
        </div>
      </div>
    </div>
  </div>
</section>
