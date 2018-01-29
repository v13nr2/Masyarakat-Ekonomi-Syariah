<section class="content-header">
	<div class="row">
		<div class="col-md-12">
			<label class="label-header"><?=$judul?> - Periode : <?=$tmp_p?></label>
		</div>
	</div>
</section>
<style> .form-horizontal .control-label2 { text-align: left; } </style>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li><a href="<?=base_url('laporan/jurnal')?>">Jurnal Umum</a></li>
					<li class="active"><a href="<?=base_url('laporan/bukubesar')?>">Buku Besar</a></li>
					<li><a href="<?=base_url('laporan/labarugi')?>">Laba Rugi</a></li>
					<li><a href="<?=base_url('laporan/neraca')?>">Neraca Saldo</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active">
						<form class="form-horizontal" method="get" action="<?=base_url('laporan/bukubesar')?>">
							<div class="form-group">
								<label class="col-lg-1 col-xs-12 text-left control-label control-label2">Periode</label>
								<div class="col-lg-2 col-xs-6">
									<select class="form-control selectnot" name="bulan">
										<?php for($i=1;$i<=12;$i++)
										{
											if(intval(substr($periode, 0, 2)) == $i)
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
						<div class="row"> <div class="col-lg-12">
							<?php
							$tmp_kode_akun 	= "";
							$tmp_saldo 		= 0;
							$tmp_saldo_all 	= 0;
							if(count($bb)>0)
							{
								foreach ($bb as $b)
								{
									if($tmp_kode_akun != $b->kode_akun)
									{
										if($tmp_kode_akun!="")
										{
											echo '</tbody></table>';
											echo '<hr/>';
										}
										$tmp_saldo_all = 0;
										echo '<div class="row">';
										echo '<div class="col-lg-6 col-xs-6 col-sm-6 col-md-6"><b>Nama Akun : ';
										echo $b->nama_akun;
										echo '</b></div>';
										echo '<div class="col-lg-6 col-xs-6 col-sm-6 col-md-6 text-right"><b>Nomor Akun :';
										echo $b->kode_akun;
										echo '</b></div>';
										echo '</div>';
										echo '<table width="100%" class="table table-bordered table-hover datatable-no">';
										echo '<thead><tr>';
										echo '<th width="10%">Tanggal</th>';
										echo '<th width="35%">Keterangan</th>';
										echo '<th width="5%">Ref</th>';
										echo '<th width="12.5%">Debet</th>';
										echo '<th width="12.5%">Kredit</th>';
										echo '<th width="12.5%">S. Debet</th>';
										echo '<th width="12.5%">S. Kredit</th>';
										echo '</tr></thead>';
										echo '<tbody>';
										if($b->uraian=="Saldo Awal")
										{
											echo '<tr style="background-color:#f9f9f9;">';
										}
										else
										{
											echo '<tr>';
										}
										echo '<td class="text-right">'.date_format(date_create($b->tgl_jurnal), "d M Y").'</td>';
										if($b->uraian=="Saldo Awal")
										{
											echo '<td><b><i>'.$b->uraian.'</i></b></td>';
										}
										else
										{
											echo '<td>'.$b->uraian.'</td>';
										}
										echo '<td></td>';
										echo '<td class="text-right">'.number_format($b->debet,2).'</td>';
										echo '<td class="text-right">'.number_format($b->kredit,2).'</td>';
										$tmp_saldo 		= $b->debet - $b->kredit;
										$tmp_saldo_all  += $tmp_saldo;
										if($tmp_saldo_all>0)
										{
											echo '<td class="text-right">'.number_format($tmp_saldo_all,2).'</td>';
											echo '<td class="text-right">'.number_format(0,2).'</td>';
										}
										else
										{
											echo '<td class="text-right">'.number_format(0,2).'</td>';
											echo '<td class="text-right">'.number_format(abs($tmp_saldo_all),2).'</td>';
										}
										echo '</tr>'; $tmp_kode_akun = $b->kode_akun;
									}
									else
										{
											echo '<tr>';
											echo '<td class="text-right">'.date_format(date_create($b->tgl_jurnal), "d M Y").'</td>';
											echo '<td>'.$b->uraian.'</td>';
											echo '<td></td>';
											echo '<td class="text-right">'.number_format($b->debet,2).'</td>';
											echo '<td class="text-right">'.number_format($b->kredit,2).'</td>';
											$tmp_saldo 	= $b->debet - $b->kredit; $tmp_saldo_all  += $tmp_saldo;
											if($tmp_saldo_all>0)
											{
												echo '<td class="text-right">'.number_format($tmp_saldo_all,2).'</td>';
												echo '<td class="text-right">'.number_format(0,2).'</td>';
											}
											else
											{
												echo '<td class="text-right">'.number_format(0,2).'</td>';
												echo '<td class="text-right">'.number_format(abs($tmp_saldo_all),2).'</td>';
											}
											echo '</tr>';
										}
									}
									echo '</table>';
								}
								else
								{
									echo $this->template->not_found_data("Tidak ada data", "Data buku besar periode " . $tmp_p . " tidak ada.");
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
