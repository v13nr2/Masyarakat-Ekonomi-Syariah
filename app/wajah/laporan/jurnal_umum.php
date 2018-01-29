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
					<li class="active"><a href="<?=base_url('laporan/jurnal')?>">Jurnal Umum</a></li>
					<li><a href="<?=base_url('laporan/bukubesar')?>">Buku Besar</a></li>
					<li><a href="<?=base_url('laporan/labarugi')?>">Laba Rugi</a></li>
					<li><a href="<?=base_url('laporan/neraca')?>">Neraca Saldo</a></li>
				</ul> <div class="tab-content">
					<div class="tab-pane active">
						<form class="form-horizontal" method="get" action="<?=base_url('laporan/jurnal')?>">
							<div class="form-group">
								<label class="col-lg-1 col-xs-12 text-left control-label control-label2">Periode</label>
								<div class="col-lg-2 col-xs-6">
									<select class="form-control selectnot" name="bulan">
										<?php for($i=1;$i<=12;$i++)
										{if(intval(substr($periode, 0, 2)) == $i)
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
								<?php
								$tmp_tgl = "A";
								$all_debet = 0;
								$all_kredit = 0;
								$tmp_debet = 0;
								$tmp_kredit = 0;
								$baris = 0;
								if(count($jurnal)>0)
								{
									echo '<table width="100%" class="table table-bordered table-hover">
									<thead>
									<tr>
									<th width="10%">Tanggal</th>
									<th width="10%">Kode Akun</th>
									<th width="20%">Nama Akun</th>
									<th width="30%">Keterangan</th>
									<th width="15%">Debet</th>
									<th width="15%">Kredit</th>
									</tr>
									</thead>
									<tbody>';
									foreach ($jurnal as $b)
									{if($tmp_tgl!=$b->tgl_jurnal)
										{if($tmp_tgl!="A")
											{
												echo '<tr class="active">';
												echo '<td colspan="4" class="text-right"><b>Total '.date_format(date_create($b->tgl_jurnal), "d M Y").'</b></td>';
												echo '<td class="text-right"><i><b>'.number_format($tmp_debet,2).'</b></i></td>';
												echo '<td class="text-right"><i><b>'.number_format($tmp_kredit,2).'</b></i></td>';
												echo '</tr>';
											}
											$tmp_debet = 0;
											$tmp_kredit = 0;
												echo '<tr>';
												echo '<td><b>'.date_format(date_create($b->tgl_jurnal), "d M Y").'</b></td>';
												$tmp_tgl = $b->tgl_jurnal;
											}
											else
											{
												echo '<tr>';
												echo '<td></td>';
											}
											echo '<td>'.$b->kode_akun.'</td>';
											if($b->kredit==0)
											{
												echo '<td>'.$b->nama_akun.'</td>';
											}
											else
											{
												echo '<td style="padding-left:3em;">'.$b->nama_akun.'</td>';
											}
											echo '<td>'.$b->uraian.'</td>';
											echo '<td class="text-right">'.number_format($b->debet, 2).'</td>';
											echo '<td class="text-right">'.number_format($b->kredit, 2).'</td>';
											echo '</tr>';
											$all_debet += $b->debet;
											$all_kredit += $b->kredit;
											$tmp_debet += $b->debet;
											$tmp_kredit += $b->kredit;
											$baris++;
										}
										if($baris>0)
										{
											echo '<tr style="background-color:#f9f9f9;">';
											echo '<td colspan="4" class="text-right"><b>Total '.date_format(date_create($tmp_tgl), "d M Y").'</b></td>';
											echo '<td class="text-right"><i>'.number_format($tmp_debet,2).'</i></td>';
											echo '<td class="text-right"><i>'.number_format($tmp_kredit,2).'</i></td>';
											echo '</tr>';
										}
										$l = "";
										if($periode!="")
										{
											$b = substr($periode, 0, 2);
											$t = substr($periode, 3, 4);
											$l = $b . "/28/" . $t;
										}
										echo '<tr class="info">';
										echo '<td colspan="4" class="text-right"><b>Total '.$tmp_p.'</b></td>';
										echo '<td class="text-right"><b>'.number_format($all_debet,2).'</b></td>';
										echo '<td class="text-right"><b>'.number_format($all_kredit,2).'</b></td>';
										echo '</tr></tbody></table>';
									}
									else
									{
										echo $this->template->not_found_data("Tidak ada data", "Data jurnal periode " . $tmp_p . " tidak ada.");
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
