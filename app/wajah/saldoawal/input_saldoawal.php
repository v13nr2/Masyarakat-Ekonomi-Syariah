<section class="content-header">
	<div class="row">
		<div class="col-md-12">
			<label class="label-header">Input <?=$judul?></label>
		</div>
	</div>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<?php if($errors!="") echo $errors; $display = ""; if($mobile==1)
			{
				$display = "hidden";
				echo alert_php2(
					'Peringatan.',
					'danger',
					'<br/>Sangat disarankan menggunakan laptop atau pc untuk menginput saldo awal');
				}
				echo alert_php2(
					'Info',
					'info',
					'. Untuk pertama kali menggunakan <b>Sistem Akuntansi</b> ini silahkan masukkan nilai saldo awal pada perusahaan Anda.', 't'
				); ?>
				<div class="box box-primary">
					<div class="box-body">
						<form id="formNS" class="form-horizontal" autocomplete="off" action="<?=base_url('saldoawal')?>" method="POST">
							<div class="form-group">
								<div class="row">
									<div class="col-lg-4">
										<label class="col-lg-12 col-xs-12 text-left control-label control-label2" style="text-align: left;">Periode Awal</label>
										<div class="col-lg-12 col-xs-12">
											<input type="text" class="form-control datenan" readonly="" name="periode" value="<?=$periode?>" id="periode" />
										</div>
									</div>
								</div>
							</div>
							<table width="100%" class="table table-striped table-bordered">
								<thead>
									<tr class="th-warna">
										<th width="20%">Kode Akun</th>
										<th width="40%">Nama Akun</th>
										<th width="20%" class="text-right" id="str_debet">Debet</th>
										<th width="20%" class="text-right" id="str_kredit">Kredit</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; foreach ($akun as $b)
									{
										echo '<tr>';
										echo '<input type="hidden" name="id_akun[]" value="'.$b->id_akun.'" />';
										echo '<td style="vertical-align:middle;">'.$b->kode_akun.'</td>';
										echo '<td style="vertical-align:middle;">'.$b->nama_akun.'</td>';
										echo '<td><input type="text" onchange="change_debet()" value="0" id="debet'.$i.'" class="fc-ns form-control text-right debet" name="debet[]" onfocus="focus_harga(this)" onblur="blur_harga(this)" /></td>';
										echo '<td><input type="text" onchange="change_kredit()" value="0" id="kredit'.$i.'" class="fc-ns form-control text-right kredit" onfocus="focus_harga(this)" onblur="blur_harga(this)" name="kredit[]" /></td>';
										echo '</tr>';
										$i++;
									} ?>
									<tr>
										<td colspan="2" style="vertical-align:middle;" class="text-right"><b>Total Saldo Awal</b></td>
										<td><input type="text" name="total_debet" id="total_debet" class="form-control fc-ns text-right kunci" readonly="" value="0" /></td>
										<td><input type="text" name="total_kredit" id="total_kredit" class="form-control fc-ns text-right kunci" readonly="" value="0" /></td>
									</tr>
								</tbody>
							</table>
							<input type="hidden" name="baris" value="<?=$i?>" />
							<div class="form-group">
								<div class="col-lg-12">
									<button type="button" class="btn btn-success" onclick="simpan_saldo()"><i class="fa fa-save"></i> Simpan</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript">
	function simpan_saldo()
	{
		var periode = $("#periode").val();
		swal({
			title: "Saldo Awal",
			text: "Apa Anda yakin ingin menyimpan data saldo awal pada periode " + periode + "?",
			type: "warning", showCancelButton: true,
			confirmButtonClass: "btn-primary",
			confirmButtonText: "Ya Simpan",
			closeOnConfirm: false, cancelButtonText: "Tidak", html: true
		},
		function (isConfirm)
		{
			if (isConfirm)
			{
				var debet 	= to_normal($("#total_debet").val());
				var kredit 	= to_normal($("#total_kredit").val());
				if(parseFloat(debet) != parseFloat(kredit))
				{
					swal({
						title: "Saldo tidak balance",
						text: "Nilai total Debet harus sama dengan Kredit.",
						type: "error"
					});
				}
				else if(parseFloat(debet) == 0 && parseFloat(kredit) == 0)
				{
					swal({
						title: "Tidak Valid",
						text: "Saldo awal tidak boleh nol.",
						type: "error"
					});
				}
				else
				{$("#formNS").submit(); }
			}
		});
	}
	var _rowCount = <?=$i?>;
	function change_debet()
	{
		form_change(true);
		total = 0;
		for (i = 1;
			i < _rowCount; i++)
			{total += parseFloat(to_normal($("#debet" + i).val()));
		}
		document.getElementById("total_debet").value = to_decimal(total);
		$("#str_debet").html("Debet (Rp " + to_decimal(total) + ")");
	}
	function change_kredit()
	{
		form_change(true);
		total = 0;
		for (i = 1; i < _rowCount; i++)
		{
			total += parseFloat(to_normal($("#kredit" + i).val()));
		}
		document.getElementById("total_kredit").value = to_decimal(total);
		$("#str_kredit").html("Kredit (Rp " + to_decimal(total) + ")");
	}
</script>
