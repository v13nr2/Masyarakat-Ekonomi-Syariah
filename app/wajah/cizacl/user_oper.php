<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->cizacl->name?>-<?php echo $this->lang->line('version')?><?php echo $this->cizacl->version?></title>
<?php echo $this->cizacl->css() ?><?php echo $this->cizacl->scripts() ?>
<script type="text/javascript" src="<?php echo site_url('cizacl_js/user_oper')?>"></script>
</head>

<body>
<div id="header_cb">
	<h2><?php echo $body['title']?></h2>
</div>
<div id="container">
	<p>&nbsp;</p>
	<div id="jq_msg"></div>
	<p>&nbsp;</p>
	<?php echo form_open($form['action'],$form['attributes'],$form['hidden'])?>
	<table width="100%">
		<tr>
			<td width="150"><?php echo $this->lang->line('name')?></td>
			<td><?php echo form_input($form['name'])?></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('surname')?></td>
			<td><?php echo form_input($form['surname'])?></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('email')?></td>
			<td><?php echo form_input($form['email'])?></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('username')?></td>
			<td><?php echo form_input($form['username'])?></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('password')?></td>
			<td><?php echo form_password($form['pwd'])?></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('role')?></td>
			<td><?php echo form_dropdown($form['role']['name'],$form['role']['options'],$form['role']['selected'],$form['role']['attributes'])?></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('state')?></td>
			<td><?php echo form_dropdown($form['status']['name'],$form['status']['options'],$form['status']['selected'],$form['status']['attributes'])?></td>
		</tr>
		<tr>
			<td align="right">&nbsp;</td>
			<td><button type="submit" class="cizacl_btn_save"><?php echo $form['submit']?></button></td>
		</tr>
	</table>
	<?php echo form_close()?> </div>
</body>
</html>
