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
					<li><a href="<?=base_url('laporan/labarugi')?>">Laba Rugi</a></li>
					<li class="active"><a href="<?=base_url('laporan/neraca')?>">Neraca Saldo</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active">
						<form class="form-horizontal" method="get" action="<?=base_url('laporan/neraca')?>">
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
						 <legend></legend>
						 <div class="row">
							 <div class="col-lg-12 text-center">
								 <h4><b>PT MAJU JAYA</b></h4>
								 <h4><b>NERACA</b></h4>
								 <h4><b>Per <?=$lastday?></b></h4>
							 </div>
						 </div>
						 <div class="row">
							 <div class="col-lg-6">
								 <table width="100%" class="table table-striped table-bordered">
									 <thead>
										 <tr class="th-warna">
											 <th width="40%">AKTIVA</th>
											 <th width="20%" class="text-right" id="str_kredit">Nominal</th>
										 </tr>
									 </thead>
									 <tbody>
										 <?php $total_debet = 0; foreach ($neraca as $b)
										 {if($b->jenis=="Aktiva")
											 {
												 echo '<tr>';
												 echo '<td>' .$b->nama_akun. '</td>';
												 echo '<td class="text-right">' .rupiah2($b->amount). '</td>';
												 echo '</tr>'; $total_debet += $b->amount;
											 }
										 }
										 echo '<tr>';
										 echo '<td class="text-right"><b>Total Aktiva</b></td>';
										 echo '<td class="text-right">' .rupiah2($total_debet). '</td>';
										 echo '</tr>'; ?>
									 </tbody>
								 </table>
							 </div>
							 <div class="col-lg-6">
								 <table width="100%" class="table table-striped table-bordered">
									 <thead>
										 <tr class="th-warna">
											 <th width="40%">PASIVA</th>
											 <th width="20%" class="text-right" id="str_kredit">Nominal</th>
										 </tr>
									 </thead>
									 <tbody>
										 <?php $total_kredit = 0; foreach ($neraca as $b)
										 {
											 if($b->jenis=="Pasiva")
											 {
												 $amount = $b->amount * -1;
												 echo '<tr>';
												 echo '<td>' .$b->nama_akun. '</td>';
												 echo '<td class="text-right">' .rupiah2($amount). '</td>';
												 echo '</tr>'; $total_kredit += $b->amount;
											 }
										 }
										 echo '<tr>';
										 echo '<td class="text-right"><b>Total Pasiva</b></td>';
										 echo '<td class="text-right">' .rupiah2(abs($total_kredit)). '</td>';
										 echo '</tr>';
										 ?>
									 </tbody>
								 </table>
							 </div>
							 <?php /*<div class="col-lg-12"> <table width="100%" class="table table-striped table-bordered"> <thead> <tr class="th-warna"> <th width="20%">Kode Akun</th> <th width="40%">Nama Akun</th> <th width="20%" class="text-right" id="str_debet">Debet</th> <th width="20%" class="text-right" id="str_kredit">Kredit</th> </tr> </thead> <tbody> <?php $total_debet = 0; $total_kredit = 0; foreach ($neraca as $b) {echo '<tr>'; echo '<td>' .$b->kode_akun. '</td>'; echo '<td>' .$b->nama_akun. '</td>'; echo '<td class="text-right">' .rupiah2($b->debet). '</td>'; echo '<td class="text-right">' .rupiah2($b->kredit). '</td>'; echo '</tr>'; $total_debet += $b->debet; $total_kredit += $b->kredit; } echo '<tr>'; echo '<td colspan="2" class="text-right"><b>Total</b></td>'; echo '<td class="text-right">' .rupiah2($total_debet). '</td>'; echo '<td class="text-right">' .rupiah2($total_kredit). '</td>'; echo '</tr>'; ?> </tbody> </table> </div>*/ ?> </div> </div> </div> </div> </div>
						 </div>
					 </section>
