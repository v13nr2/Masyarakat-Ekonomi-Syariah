<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login | Sistem Akuntansi</title>
	<meta name="author" content="rafeldo123">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="icon" href="<?=base_url('assets/logons.png')?>">
	<link rel="stylesheet" href="<?=base_url('assets/bootstrap/css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/plugins/font-awesome/css/font-awesome.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/plugins/ionicons/css/ionicons.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/dist/css/main.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/plugins/iCheck/square/blue.css')?>">
	<style>
		.login-page2{
			 background-color: #2ecc71;
		 }
	</style>
</head>
<body class="hold-transition login-page2">
	<div class="login-box">
		<div class="login-logo">
			<a href="<?=base_url()?>" class="kunci">Sistem <b>Akuntansi</b></a>
		</div>
		<?php if($this->session->userdata($this->config->item('ses_message')))
		{
			echo $this->session->userdata($this->config->item('ses_message'));
			 $this->session->unset_userdata($this->config->item('ses_message'));
		}
		?>
		<div class="login-box-body">
			<p class="login-box-msg kunci">Masuk Sistem</p>
			<?php $attributes = array('method' => 'POST', 'autocomplete' => 'off'); echo form_open('', $attributes); ?>
			<?php /*<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">*/ ?>
			<div class="form-group has-feedback">
				<input type="text" name="your_email" class="form-control" placeholder="Email" autofocus="" required="">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" name="your_password" class="form-control" placeholder="Kata Sandi " required="">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<?php
			/*<div class="row"> <div class="col-xs-6"> <div class="form-group has-feedback"> <input type="text" class="form-control" name="captchanya" placeholder="Captcha" required=""> </div> </div> <div class="col-xs-6"> <div class="form-group has-feedback"> <input type="text" name="dicekya" class="form-control" readonly="" value="<?php echo $this->session->userdata('captcha_login'); ?>"> </div> </div> </div>*/ ?>
			<div class="row">
				<?php /*<div class="col-xs-8"> <div class="checkbox icheck"> <label><input type="checkbox"> Remember Me</label>
				</div>
				</div>*/ ?>
				<div class="col-xs-12">
					<button type="submit" name="btnlogin" value="dologin" class="btn kunci btn-success btn-block btn-flat">Masuk</button>
				</div>
			</div>
			<?php echo form_close();
			//</form> ?>
			<?php
			/*<br/>
			<div class="row">
				<div class="col-lg-12">
					<a href="registrasi" class="text-center">Daftar Baru Disini</a>
				</div>
			</div>*/ ?>
			<?php
			/*<br/>
			<a href="#">Lupa kata sandi Anda?</a><br>*/ ?>
		</div>
	</div>
	<script src="<?=base_url('assets/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
	<script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
	<script src="<?=base_url('assets/plugins/iCheck/icheck.min.js')?>"></script>
	<script src="<?=base_url('assets/customnan/jquery.lock.min.js')?>"></script>
	<script> $(function () {$('input').iCheck({checkboxClass: 'icheckbox_square-blue', radioClass: 'iradio_square-blue', increaseArea: '10%'}); $(".kunci").lock(); }); </script>
</body>
</html>
