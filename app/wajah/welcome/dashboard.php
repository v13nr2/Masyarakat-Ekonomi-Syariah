<section class="content-header">
	<div class="row">
		<div class="col-md-12">
			<label class="label-header"><?=$judul?></label>
		</div>
	</div>
</section>
<section class="content">
	<?php if($tipe_company=="Free")
	{
		echo '<div class="row">';
		echo '<div class="col-lg-12">';
		echo alert_php2('', 'info', 'Saat ini anda menggunakan fitur <i><b>FREE</b></i> dengan limit pengguna dan transaksi penjurnalan Anda. Silahkan upgrade fitur anda.');
		echo '</div>';
		echo '</div>';
	}
	?>
	<div class="row">
		<div class="col-lg-8">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Grafik Laba Rugi <?=date('Y')?></h3>
				</div>
				<div class="box-body">
					<?php if(count($chart_labarugi)==0) {echo alert_php2('', 'danger', 'Belum ada data.', 't'); } else {echo '<div id="laba_chart"></div>'; } ?>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Laba Rugi <?=date('Y')?></h3>
				</div>
				<div class="box-body">
					<table class="table table-border table-striped">
						<thead>
							<tr>
								<th>Bulan</th>
								<th class="text-right">Nominal</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($chart_labarugi as $lb) {
								echo '<tr>';
								echo '<td>'.$lb->periode.'</td>';
								echo '<td class="text-right">'.rupiah2($lb->laba_rugi, ".", 2, "Rp").'</td>';
								echo '</tr>';
							}
							if(count($chart_labarugi)==0) {
								echo '<tr><td colspan="2">Belum ada data.</td></tr>';
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<?php if(count($chart_labarugi)!=0) { ?>
	<script>
	Morris.Bar({
		element: 'laba_chart',
		data: <?php echo json_encode($chart_labarugi);?>,
		xkey: 'periode',
		ykeys: ['laba_rugi'],
		labels: ['Laba Rugi'],
		resize: true,
		hideHover: 'auto',
		parseTime: false
	});
	</script>
<?php } ?>
