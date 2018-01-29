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
					<?php echo form_open(get_uri("settings/save_email_settings"), array("id" => "email-settings-form", "class" => "form-horizontal", "role" => "form")); ?>

					<div class="form-group">
						<label for="email_sent_from_address" class="control-label col-lg-3">Email Send Form Address</label>
						<div class="col-lg-4">
						  <?php
						  echo form_input(array(
								"id" => "email_sent_from_address",
								"name" => "email_sent_from_address",
								"value" => get_setting('email_sent_from_address'),
								"class" => "form-control",
								"placeholder" => "Rafeldo29@gmail.com",
								"data-rule-required" => true,
								"data-msg-required" => "field_required",
						  ));
						  ?>
						</div>
					</div>

					<div class="form-group">
						<label for="email_sent_from_name" class="control-label col-lg-3">Email Send Form Name</label>
						<div class="col-lg-4">
						  <?php
						  echo form_input(array(
								"id" => "email_sent_from_name",
								"name" => "email_sent_from_name",
								"value" => get_setting('email_sent_from_name'),
								"class" => "form-control",
								"placeholder" => "Company Name",
								"data-rule-required" => true,
								"data-msg-required" => "field_required",
						  ));
						  ?>
						</div>
					</div>

					<div class="form-group">
						 <label for="use_smtp" class="control-label col-lg-3">Email Use Smtp</label>
						 <div class="col-lg-9">
							  <?php
							  echo form_checkbox(
										 "email_protocol", "smtp", get_setting('email_protocol') === "smtp" ? true : false, "id='use_smtp'"
							  );
							  ?>
						 </div>
					</div>

					<div id="smtp_settings" class="<?php echo get_setting('email_protocol') === "smtp" ? "" : "hide"; ?>">
						<div class="form-group">
							<label for="email_smtp_host" class="control-label col-lg-3">Email Smtp Host</label>
							<div class="col-lg-4">
								<?php
								echo form_input(array(
									 "id" => "email_smtp_host",
									 "name" => "email_smtp_host",
									 "value" => get_setting('email_smtp_host'),
									 "class" => "form-control",
									 "placeholder" => "Email Smtp Host",
									 "data-rule-required" => true,
									 "data-msg-required" => "field_required",
								));
								?>
							</div>
						</div>

						<div class="form-group">
							<label for="email_smtp_user" class="control-label col-lg-3">Email Smtp User</label>
							<div class="col-lg-4">
								<?php
								echo form_input(array(
									 "id" => "email_smtp_user",
									 "name" => "email_smtp_user",
									 "value" => get_setting('email_smtp_user'),
									 "class" => "form-control",
									 "placeholder" => "Email Smtp User",
									 "data-rule-required" => true,
									 "data-msg-required" => "field_required",
								));
								?>
							</div>
						</div>

						<div class="form-group">
							<label for="email_smtp_pass" class="control-label col-lg-3">Email Smtp Password</label>
							<div class="col-lg-4">
								<?php
								echo form_input(array(
									 "id" => "email_smtp_pass",
									 "name" => "email_smtp_pass",
									 "value" => get_setting('email_smtp_pass'),
									 "class" => "form-control",
									 "placeholder" => "Email Smtp Password",
									 "data-rule-required" => true,
									 "data-msg-required" => "field_required",
								));
								?>
							</div>
						</div>
						<div class="form-group">
							<label for="email_smtp_port" class=" control-label col-lg-3">Email Smtp Port</label>
							<div class="col-lg-4">
								<?php
								echo form_input(array(
									 "id" => "email_smtp_port",
									 "name" => "email_smtp_port",
									 "value" => get_setting('email_smtp_port'),
									 "class" => "form-control",
									 "placeholder" => "Email Smtp Port",
									 "data-rule-required" => true,
									 "data-msg-required" => "field_required",
								));
								?>
							</div>
						</div>

						<div class="form-group">
							<label for="email_smtp_security_type" class="control-label col-lg-3">Security Type</label>
							<div class="col-lg-4">
								<?php
								echo form_dropdown(
										  "email_smtp_security_type", array("tls" => "TLS", "ssl" => "SSL" ), get_setting('email_smtp_security_type'), "class='select2 form-control'"
								);
								?>
							</div>
						</div>

					</div>

					<div class="form-group">
						 <label for="send_test_mail_to" class="control-label col-lg-3">Send Test Mail To</label>
						 <div class="col-lg-4">
							  <?php
							  echo form_input(array(
									"id" => "send_test_mail_to",
									"name" => "send_test_mail_to",
									"value" => get_setting('send_test_mail_to'),
									"class" => "form-control",
									"placeholder" => "Keep it blank if you are not interested to send test mail!!!",
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
