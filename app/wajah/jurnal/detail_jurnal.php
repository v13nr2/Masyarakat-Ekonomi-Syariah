<section class="content-header">
	<div class="row">
		<div class="col-md-12">
			<label class="label-header"><?=$judul?></label>
		</div>
	</div>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<?php if($header["dikonfirmasi"]=="Yes")
			{
				echo alert_php2('Jurnal ini sudah dikonfirmasi.', 'success', '');
			}
			elseif($header["dikonfirmasi"]=="No")
			{
				echo alert_php2('Jurnal ini ditolak.', 'danger', '');
			}
			else
			{
				echo alert_php2('Jurnal belum dikonfirmasi.', 'info', '');
			}
			?>
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-files-o"></i>
					<h3 class="box-title"><?=$judul?></h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label">Tanggal</label>
								<input type="text" class="form-control" readonly="" maxlength="15" name="tgl_jurnal" id="tgl_jurnal" value="<?=$header['tgl_jurnal']?>" />
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label">No Jurnal</label>
								<input type="text" class="form-control" data-validetta="required" maxlength="40" name="no_jurnal" id="no_jurnal" value="<?=$header['no_jurnal']?>" readonly="" />
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label">No Butki</label>
								<input type="text" class="form-control" data-validetta="required" maxlength="40" name="no_bukti" id="no_bukti" value="<?=$header['no_bukti']?>" readonly="" />
							</div>
						</div>
						<div class="col-md-3">
							<label class="control-label">Memo</label>
							<textarea class="form-control" rows="3" data-validetta="required" maxlength="160" name="memo" id="memo" style="resize:none;" readonly=""><?=$header['memo']?></textarea>
						</div>
					</div>
					<br/>
					<div class="row">
						<div class="col-lg-12">
							<table class="table table-bordered nanda">
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
									echo '<td class="text-right">'.rupiah2($d->debet, ".", 2).'</td> <td class="text-right">'.rupiah2($d->kredit, ".", 2).'</td>';
									echo '</tr>'; $total_d += $d->debet; $total_k += $d->kredit;
								}
								echo '<tr style="font-weight:bold;">';
								echo '<td colspan="2" class="text-right">TOTAL</td>';
								echo '<td class="text-right">'.rupiah2($total_d, ".", 2).'</td> <td class="text-right">'.rupiah2($total_k, ".", 2).'</td>';
								echo '</tr>'; ?>
							</table>
						</div>
					</div>
					<legend></legend>
					<div class="row">
						<div class="col-lg-12">
							<div class="pull-right">
								<a href="<?=base_url('jurnal/ubah/'.$this->uri->segment(3))?>" class="btn btn-warning btn-sm btn-min"><i class="fa fa-edit"></i> Ubah</a>
								<?=anchor($back, '<i class="fa fa-angle-left"></i> Kembali', array('class'=>'btn btn-danger btn-sm btn-min'))?>
								<?php if($header["dikonfirmasi"]=="" && $this->uri->segment(1)=="konfirmasi")
								{
									echo '<button type="button" onclick="konfirmasi(\''.$header["kode_unik"].'\')" class="btn btn-info btn-sm"><i class="fa fa-check"></i> Konfirmasi</button>';
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>

function konfirmasi(value)
{
	swal({
		title: "",
		text: "Apakah Anda yakin mengkonfirmasi jurnal ini?",
		type: "info",
		showCancelButton: true,
		confirmButtonColor: "#dd4b39",
		confirmButtonText: "Ya, Hapus",
		cancelButtonText: "Batal",
		closeOnConfirm: true, closeOnCancel: true
	},

	function(isConfirm){if (isConfirm)
		{$.ajax({
			type:"POST",
			url:"<?=base_url('jurnal/confirm')?>",
			data:{"jurnal_id":value},
			success: function(resp)
			{
				swal({
					title: "Proses Berhasil!",
					text: "Jurnal berhasil dikonfirmasi",
					type: "success"
				},

				function(){
					window.location.href = '<?=base_url('konfirmasi')?>';
				});
			},
			error: function(xhr, status, error)
			{
				alert(xhr.responseText);
			}
		});
	}
});
}

</script>
