
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
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label">Tanggal</label> : 
								<?=$header['tgl_jurnal']?>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label">No Jurnal</label> : 
								<?=$header['no_jurnal']?>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label">No Butki</label> : 
								<?=$header['no_bukti']?>
							</div>
						</div>
						<div class="col-md-3">
							<label class="control-label">Memo</label> : 
							<?=$header['memo']?>
						</div>
					</div>
					<br/>
					<div class="row">
						<div class="col-lg-12">
							<table class="table table-bordered nanda" width="100%" border=1 style="border-collapse:collapse">
								<tr class="th-warna">
									<th width="30%">Akun</th>
									<th width="30%">Uraian</th>
									<th width="20%" class="text-right">Debet</th>
									<th width="20%" class="text-right">Kredit</th>
								</tr> <?php $total_d = 0; $total_k = 0; foreach ($detail as $d)
								{
									echo '<tr>';
									echo '<td>'.$d->kode_akun . " - " . $d->nama_akun.'</td>';
									echo '<td>'.$d->uraian.'</td>';
									echo '<td align="right">'.rupiah2($d->debet, ".", 2).'</td> <td align="right">'.rupiah2($d->kredit, ".", 2).'</td>';
									echo '</tr>'; $total_d += $d->debet; $total_k += $d->kredit;
								}
								echo '<tr style="font-weight:bold;">';
								echo '<td colspan="2" class="text-right">TOTAL</td>';
								echo '<td align="right">'.rupiah2($total_d, ".", 2).'</td> <td align="right">'.rupiah2($total_k, ".", 2).'</td>';
								echo '</tr>'; ?>
							</table>
						</div>
					</div>
					<legend></legend>
				</div>
			</div>
		</div>
	</div>
</section>