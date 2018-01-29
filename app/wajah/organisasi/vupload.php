
<head>
    <title><?php echo$titel;?></title> <!-- variabel diambil dari controller -->
    
    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet"> <!-- Custom styles for this template -->
<style>

    body{
        margin:20px 10%;
    }
</style>
</head>

<div class="container">
      <!-- Main component for a primary marketing message or call to action -->
<div class="panel panel-default">
  <div class="panel-heading"><b> Daftar File IMage</b></div>
  <div class="panel-body">
    
    <?php echo $this->session->flashdata('pesan');?>
    <p>
        <a href="<?php echo base_url();?>upload/add" class="btn btn-success">Tambah</a>
    </p>
  <table class="table table-bordered table-striped">
    <tr>
      <th>Keterangan File</th>
      <th>Tipe File</th>
      <th>Gambar File</th>
    </tr>
    <?php  if(empty($query)){ ?> <!-- jika data kosong kita tampilkan pesan -->
    <tr>
        <td colspan="3">Data tidak ada</td>
    </tr>
    <?php }else{
    foreach($query as $rowdata){ ?> <!-- menampilkan data dari query dengan looping -->
    <tr>
      <td><?php echo $rowdata->ket_gbr;?></td>
      <td><?php echo $rowdata->tipe_gbr;?></td>
      <td><img src="assets/uploads/<?php echo $rowdata->nm_gbr;?>" height="100px"></td>
    </tr>
    <?php }}?>
  </table>

</div>
</div>
</div>
