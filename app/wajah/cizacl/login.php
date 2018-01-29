<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>APLIKASI AKUNTING MES</title>
<link href="<?php echo base_url('css/cizacl/login.css');?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('css/cizacl/ui-cizacl/jquery-ui-1.8.14.custom.css');?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url('js/cizacl/jquery-1.6.1.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/cizacl/jquery-ui-1.8.14.custom.min.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('login_js/scripts');?>"></script>
</head>
<body>
<div id="content">
	<h1><?php echo $this->lang->line('login')?></h1>
	<div id="jq_msg"></div>
	<div id="content-login">
		<form name="form1" id="form1" action="#">
			<table width="100%" border="0" cellspacing="0" cellpadding="5">
				<tr>
					<td width="30%" align="right" valign="middle"><?php echo $this->lang->line('username')?></td>
					<td width="70%"><input type="text" name="username" id="username" size="30" /></td>
				</tr>
				<tr>
					<td align="right" valign="middle"><?php echo $this->lang->line('password')?></td>
					<td><input type="password" name="password" id="password" size="30" /></td>
				</tr>
				<tr>
					<td align="right" valign="middle">&nbsp;</td>
					<td><button type="submit" class="cizacl_btn_check"><?php echo $this->lang->line('submit')?></button>
						&nbsp;
						<button type="reset" class="cizacl_btn_del"><?php echo $this->lang->line('cancel')?></button></td>
				</tr>
			</table>
		</form>
	</div>
</div>
</body>
</html>