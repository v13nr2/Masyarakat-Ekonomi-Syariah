<?php

if(!empty($margin)){
	foreach($margin as $k){
		$batasatas = $k->batasatas;
		$batasbawah = $k->batasbawah;
		$bataskanan = $k->bataskanan;
		$bataskiri = $k->bataskiri;
	}
}
$px_atas = $batasatas*2.02 * 100;
$px_bawah = $batasbawah*2.02 * 100;
$px_kanan = $bataskanan*2.02 * 100;
$px_kiri = $bataskiri*2.02 * 100;
?>
<section class="content-header">
	<div class="row">
		<div class="col-md-5">
			<label class="label-header">SETTING KUITANSI</label>
		</div>
	</div>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-user"></i>
					<h3 class="box-title">Margin</h3>
				</div>
				<div class="box-body">
					<?php echo form_open(get_uri("settings/save_margin_settings"), array("id" => "email-settings-form", "class" => "form-horizontal", "role" => "form")); ?>

					<div class="form-group">
						<label for="email_sent_from_address" class="control-label col-lg-3">Header Margin (cm)</label>
						<div class="col-lg-4">
						  <?php
						  echo form_input(array(
								"id" => "batasatas",
								"name" => "batasatas",
								"value" => $batasatas,
								"class" => "form-control",
								"placeholder" => "",
								"data-rule-required" => true,
								"data-msg-required" => "field_required",
						  ));
						  ?>
						</div>
					</div>

					<div class="form-group">
						<label for="email_sent_from_name" class="control-label col-lg-3">Left Margin (cm)</label>
						<div class="col-lg-4">
						  <?php
						  echo form_input(array(
								"id" => "bataskiri",
								"name" => "bataskiri",
								"value" => $bataskiri,
								"class" => "form-control",
								"placeholder" => "",
								"data-rule-required" => true,
								"data-msg-required" => "field_required",
						  ));
						  ?>
						</div>
					</div>

					<div class="form-group">
						<label for="email_sent_from_name" class="control-label col-lg-3">Right Margin (cm)</label>
						<div class="col-lg-4">
						  <?php
						  echo form_input(array(
								"id" => "bataskanan",
								"name" => "bataskanan",
								"value" => $bataskanan,
								"class" => "form-control",
								"placeholder" => "",
								"data-rule-required" => true,
								"data-msg-required" => "field_required",
						  ));
						  ?>
						</div>
					</div>

					<div class="form-group">
						<label for="email_sent_from_name" class="control-label col-lg-3">Bottom Margin (cm)</label>
						<div class="col-lg-4">
						  <?php
						  echo form_input(array(
								"id" => "batasbawah",
								"name" => "batasbawah",
								"value" => $batasbawah,
								"class" => "form-control",
								"placeholder" => "",
								"data-rule-required" => true,
								"data-msg-required" => "field_required",
						  ));
						  ?>
						</div>
					</div>

			  </div>
			  <div class="panel-footer">
					<button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span>save</button>
			  </div>

					<?php echo form_close(); ?>
				</div>
	
	<div class="row">	
	<div class="col-lg-12"><H3><a href="<?php echo site_url();?>settings/invoice_to_pdf" >PREVIEW KLIK DISINI</a></H3>
	
    </div>

	</div>
	
</section>



