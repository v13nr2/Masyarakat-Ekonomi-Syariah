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
					<li class="active"><a href="<?=base_url('proyek/resume');?>?id=<?php echo $_GET["id"];?>&idProyek=<?php echo $_GET["idProyek"];?>">POSISI KEUANGAN</a></li>
					<li><a href="<?=base_url('proyek/kasmasuk');?>?id=<?php echo $_GET["id"];?>&idProyek=<?php echo $_GET["idProyek"];?>">KAS MASUK</a></li>
					<li><a href="<?=base_url('proyek/kaskeluar');?>?id=<?php echo $_GET["id"];?>&idProyek=<?php echo $_GET["idProyek"];?>">KAS KELUAR</a></li>
				</ul> <div class="tab-content">
					<div class="tab-pane active">
						<form class="form-horizontal" method="get" action="<?=base_url('laporan/jurnal')?>">
							
							
							
						</form>
						<hr/>
						<div class="row">
							<div class="col-lg-12">
								<table width="100%" id="dtcustomt" class="table table-striped table-bordered table-hover">
            						<thead>
            							<th>Nomor Jurnal</th>
            							
            							<th>Nomor Bukti</th>
            							<th>Memo</th>
            							<th>Kode Akun</th>
            							<th>Nama Akun</th>
            							<th>Debet</th>
            							<th>Kredit</th>
            						</thead>
            						<tbody>
            							<?php 
            							$totaldebet = 0;
            							$totalkredit = 0;
            							$nomorJurnalDua = "";
            							$nomorJurnal = "";
            							$no=0;foreach ($akun as $b)
            							{
            							echo '<tr>';
            							
            							    $nomorJurnal = $b->no_jurnal;
            							    
            							    if($nomorJurnalDua == $nomorJurnal){
            							        
            								    echo '<td><font color="#CCCCCC">'.$b->no_jurnal.'</font></td>';
            								    echo '<td><font color="#CCCCCC">'.$b->no_bukti.'</font></td>';
            								    echo '<td><font color="#CCCCCC">'.$b->memo.'</td>';
            							    } else 
            							    {
            							        
            								    echo '<td>'.$b->no_jurnal.'</td>';
            								    echo '<td>'.$b->no_bukti.'</td>';
            								echo '<td>'.$b->memo.'</td>';
            							        
            							        
            							    }
            							
            							    $nomorJurnalDua = $b->no_jurnal;
            							    
            								echo '<td>'.$b->kode_akun.'</td>';
            								echo '<td>'.$b->nama_akun.'</td>';
            								echo '<td align="right">'.number_format($b->debet).'</td>';
            								$totaldebet = $totaldebet + $b->debet;
            								$totalkredit = $totalkredit + $b->kredit;
            								echo '<td align="right">'.number_format($b->kredit).'</td>';
            								?>
            							
            								<?php echo '</tr>';
            							}  ?>
            							<tr>
            							    
            							    
            							    <td></td>
            							    <td></td>
            							    <td></td>
            							    <td></td>
            							    <td>TOTAL</td>
            							    <td align="right"><?php echo number_format($totaldebet);?></td>
            							    <td align="right"><?php echo number_format($totalkredit);?></td>
            							</tr>
            						</tbody>
            					</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
