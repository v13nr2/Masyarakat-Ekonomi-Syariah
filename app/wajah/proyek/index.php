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
					<li class="active"><a href="<?=base_url('proyek/detail');?>?id=<?php echo $_GET["id"];?>&idProyek=<?php echo $_GET["idProyek"];?>">DATA</a></li>
					<li><a href="<?=base_url('proyek/resume');?>?id=<?php echo $_GET["id"];?>&idProyek=<?php echo $_GET["idProyek"];?>">POSISI KEUANGAN</a></li>
					<li><a href="<?=base_url('proyek/kasmasuk');?>?id=<?php echo $_GET["id"];?>&idProyek=<?php echo $_GET["idProyek"];?>">KAS MASUK</a></li>
					<li><a href="<?=base_url('proyek/kaskeluar');?>?id=<?php echo $_GET["id"];?>&idProyek=<?php echo $_GET["idProyek"];?>">KAS KELUAR</a></li>
				</ul> <div class="tab-content">
					<div class="tab-pane active">
						<form class="form-horizontal" method="get" action="<?=base_url('laporan/jurnal')?>">
							
							<div class="col-md-12">
								<div class="form-group">
									<div class="col-sm-7">
										<B>PROGRAM : 
										<?php
											foreach($proyek_detail as $p){
											?>
											<input type="hidden" value="<?php echo $p->id_program;?>" name="program">
											<?php									
												echo $p->no_program;
											}
										?>
										</B>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<div class="col-sm-7">
										<B>PROYEK : 
										<?php
											foreach($proyek_detail as $p){
												?>
											<input type="hidden" value="<?php echo $p->id;?>" name="proyek">
											<?php	
												echo $p->nama_proyek;
											}
										?>
										</B>
									</div>
								</div>
							</div>
						</form>
						<hr/>
						<div class="row">
							<div class="col-lg-12">
								
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
