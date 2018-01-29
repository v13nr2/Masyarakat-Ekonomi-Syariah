<section class="content-header">
	<div class="row">
		<div class="col-md-12">
			<label class="label-header"><?=$judul?> - Periode : <?=$tmp_p?></label>
		</div>
	</div>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li><a href="<?=base_url('laporan/jurnal')?>">Jurnal Umum</a></li>
					<li><a href="<?=base_url('laporan/bukubesar')?>">Buku Besar</a></li>
					<li class="active"><a href="<?=base_url('laporan/labarugi')?>">Laba Rugi</a></li>
					<li><a href="<?=base_url('laporan/neraca')?>">Neraca Saldo</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active">
						<form class="form-horizontal" method="get" action="<?=base_url('laporan/labarugi')?>">
							<div class="form-group">
								<label class="col-lg-1 col-xs-12 text-left control-label control-label2">Periode</label>
								<div class="col-lg-2 col-xs-6">
									<select class="form-control selectnot" name="bulan">
										<?php for($i=1;$i<=12;$i++) {if(intval(substr($periode, 0, 2)) == $i)
											{
												echo '<option value="'.$i.'" selected>'.bulan($i).'</option>';
											}
											else
											{
												echo '<option value="'.$i.'">'.bulan($i).'</option>';
											}
										}
										?>
									</select>
								</div>
								<div class="col-lg-2 col-xs-6">
									<select class="form-control selectnot" name="tahun">
										<?php for($i=2015;$i<=date('Y');$i++)
										{
											if(substr($periode, 3, 4)==$i)
											{
												echo '<option value="'.$i.'" selected>'.$i.'</option>';
											}
											else
											{
												echo '<option value="'.$i.'">'.$i.'</option>';
											}
										}
										?>
									</select>
								</div>
								<div class="col-lg-2 col-xs-6">
									<button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Cari</button>
								</div>
							</div>
						</form>
						<hr/>
						<div class="row">
							<div class="col-lg-12">
								<?php if(count($labarugi)>0)
								{
									echo '<table width="100%" class="table">
									<thead>
									<tr>
									<!--<th width="20%">Kode Akun</th>
									<th width="30%">Nama Akun</th>
									<th width="25%" class="text-right">Beban</th>
									<th width="25%" class="text-right">Penjualan</th>-->
									</tr>
									</thead>
									<tbody>';
									$tmp_tipe = "";
									$total_pendapatan = 0;
									$total_beban = 0;
									$lewat_pendapatan = "";
									foreach ($labarugi as $b)
									{
										$b->amount = abs($b->amount);
										if($lewat_pendapatan=="")
										{
											if($b->no_urut > 2)
											$lewat_pendapatan = "jumlah pendapatan";
										}
										if($lewat_pendapatan=="jumlah pendapatan")
										{
											echo '<tr class="active">';
											echo '<td class="text-left" colspan="3"><b>Total Pendapatan</b></td>';
											echo '<td class="text-right"><b><i>'.number_format($total_pendapatan,2).'</i></b></td>';
											echo '</tr>'; $lewat_pendapatan = "sudah dijumlah";
										}
										if($tmp_tipe!=$b->nama_tipe_akun)
										{
											echo '<tr>';
											echo '<td colspan="4"><b>'.$b->nama_tipe_akun.'</b></td>';
											echo '</tr>'; $tmp_tipe = $b->nama_tipe_akun;
										}
										echo '<tr>';
										echo '<td class="text-right">'.$b->kode_akun.'</td>';
										echo '<td>'.$b->nama_akun.'</td>'; if($b->no_depan=="4" || $b->no_depan=="6")
										{
											echo '<td class="text-right"></td>';
											echo '<td class="text-right">'.number_format($b->amount, 2).'</td>';
											$total_pendapatan += $b->amount;
										}
										else
										{
											echo '<td class="text-right">'.number_format($b->amount, 2).'</td>';
											echo '<td class="text-right"></td>'; $total_beban += $b->amount;
										}
										echo '</tr>';
									}
									echo '<tr class="active">';
									echo '<td colspan="3" class="text-left"><b>Total Beban</b></td>';
									echo '<td class="text-right"><b><i>('.number_format($total_beban,2).')</i></b></td>';
									echo '</tr>';
									$laba_rugi = $total_pendapatan - $total_beban; if($labarugi>0)
									{
										echo '<tr class="info">';
										echo '<td colspan="2"></td>';
										echo '<td class="text-right"><b>Laba '.$tmp_p.'</b></td>';
									}
									else
									{
										echo '<tr class="danger">';
										echo '<td colspan="2"></td>';
										echo '<td class="text-right"><b>Rugi '.$tmp_p.'</b></td>';
									}
									echo '<td class="text-right"><b><i>'.number_format($laba_rugi, 2).'</i></b></td>';
									echo '</tr>';
									echo '</tbody></table>';
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
