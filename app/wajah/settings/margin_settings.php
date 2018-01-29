<section class="content-header">
	<div class="row">
		<div class="col-md-5">
			<label class="label-header"><?=$judul?></label>
		</div>
	</div>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<?php if($errors!=""){ echo $errors; } if(validation_errors() != false) {echo alert_php2('', 'validate', validation_errors()); } ?>
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-user"></i>
					<h3 class="box-title"><?=$judul?></h3>
				</div>
				<div class="box-body">
					<?php echo form_open(get_uri("settings/save_margin_settings"), array("id" => "email-settings-form", "class" => "form-horizontal", "role" => "form")); ?>

					<div class="form-group">
						<label for="email_sent_from_address" class="control-label col-lg-3">Header Margin</label>
						<div class="col-lg-4">
						  <?php
						  echo form_input(array(
								"id" => "email_sent_from_address",
								"name" => "email_sent_from_address",
								"value" => get_setting('email_sent_from_address'),
								"class" => "form-control",
								"placeholder" => "",
								"data-rule-required" => true,
								"data-msg-required" => "field_required",
						  ));
						  ?>
						</div>
					</div>

					<div class="form-group">
						<label for="email_sent_from_name" class="control-label col-lg-3">Left Margin</label>
						<div class="col-lg-4">
						  <?php
						  echo form_input(array(
								"id" => "email_sent_from_name",
								"name" => "email_sent_from_name",
								"value" => get_setting('email_sent_from_name'),
								"class" => "form-control",
								"placeholder" => "",
								"data-rule-required" => true,
								"data-msg-required" => "field_required",
						  ));
						  ?>
						</div>
					</div>

					<div class="form-group">
						<label for="email_sent_from_name" class="control-label col-lg-3">Right Margin</label>
						<div class="col-lg-4">
						  <?php
						  echo form_input(array(
								"id" => "email_sent_from_name",
								"name" => "email_sent_from_name",
								"value" => get_setting('email_sent_from_name'),
								"class" => "form-control",
								"placeholder" => "",
								"data-rule-required" => true,
								"data-msg-required" => "field_required",
						  ));
						  ?>
						</div>
					</div>

					<div class="form-group">
						<label for="email_sent_from_name" class="control-label col-lg-3">Bottom Margin</label>
						<div class="col-lg-4">
						  <?php
						  echo form_input(array(
								"id" => "email_sent_from_name",
								"name" => "email_sent_from_name",
								"value" => get_setting('email_sent_from_name'),
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
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
    $(document).ready(function() {

        $("#email-settings-form").appForm({
            isModal: false,
            onSubmit: function() {
                appLoader.show();
            },
            onSuccess: function(result) {
                appLoader.hide();
                appAlert.success(result.message, {duration: 10000});
            },
            onError: function() {
                appLoader.hide();
            }
        });

        $("#use_smtp").click(function() {
            if ($(this).is(":checked")) {
                $("#smtp_settings").removeClass("hide");
            } else {
                $("#smtp_settings").addClass("hide");
            }
        });

        $("#email-settings-form .select2").select2();
    });
</script>
