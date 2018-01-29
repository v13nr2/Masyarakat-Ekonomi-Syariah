
<section class="content">
	<div class="row">
		<div class="col-lg-12">
		
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-files-o"></i>
					<h3 class="box-title"><?=$judul?></h3>
				</div>
				<div class="box-body">
					
					<div class="row">
						<div class="col-lg-12">
							<table class="table table-bordered nanda">
								<tr class="th-warna">
									<th width="10%">No</th>
									<th width="30%">Tanggal Posting</th>
									<th width="20%">Nilai</th>
									<th width="20%">Sisa</th>
									<th width="20%">Posting</th>
								</tr> 
								<tr class="th-warna">
									<th colspan=2>Tanggal Perolehan <?php echo date_format(date_create($header["tgl"]), 'd-m-Y');?></th>
									<th width="20%"></th>
									<th width="20%"><?php echo number_format($header["nilai"],2,",",".");?></th>
									<th width="20%"></th>
								</tr> <?php $sisa = $header["nilai"]; $no = 1; foreach ($detail as $d)
								{
									echo '<tr>';
									echo '<td>'. $no++ .'</td>';
									echo '<td>'.date_format(date_create($d->mano_post), 'd-m-Y').'</td>';
									echo '<td>'.number_format($d->nilai,2,",",".").'</td>';
									echo '<td>';?><?php $sisa = $sisa - ($d->nilai); echo number_format($sisa,2,",",".");  ?><?php echo '</td>';
									echo '<td align="center">';
									echo '<a data-toggle="tooltip" href="'.base_url('aset/posted/'.$d->id).'" title="Posting  '.$judul.'" class="btn btn-success btn-xs">Posting</a>';
									echo '</td>'; echo '</tr>';
								}
								?>
							</table>
						</div>
					</div>
					<legend></legend>
					
				</div>
			</div>
		</div>
	</div>
</section>
