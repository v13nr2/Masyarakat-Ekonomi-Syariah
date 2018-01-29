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
              <h1 class="page-header">Buka Tiket Support Baru</h1>
              <form>
                <div class="form-group">
                  <label for="exampleInputEmail1">Subjek Tiket</label>
                  <input type="text" class="form-control" id="inputNameTicket" placeholder="Subjek Tiket">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Isi Pesan</label>
                  <textarea class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-default">Simpan</button>
                <a href="<?=base_url()?>ticket" class="btn btn-default">Batal</a>
              </form>
        </div>
      </div>
    </div>
  </div>
</section>
