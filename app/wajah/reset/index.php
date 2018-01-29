
<section class="content-header">
	<div class="row">
		<div class="col-md-5">
			<label class="label-header">RESET SISTEM, CAREFULL!!</label>
		</div>
	</div>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-user"></i>
				</div>
				<div class="box-body">
					<form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?=base_url().'resetsistem/reset_it'; ?>">
						
						<div class="form-group">
							<div class="col-lg-2"></div>
							<div class="col-lg-4">
								<button type="submit" value="simpan" name="btnSimpan" class="btn btn-success btn-min"><i class="fa fa-save"></i> Reset</button>
								<?=anchor('home', '<i class="fa fa-angle-left"></i> Kembali', array('class'=>'btn btn-danger btn-min'))?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
