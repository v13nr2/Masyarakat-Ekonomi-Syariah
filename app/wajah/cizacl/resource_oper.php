<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->cizacl->name?>-<?php echo $this->lang->line('version')?><?php echo $this->cizacl->version?></title>
<?php echo $this->cizacl->css() ?><?php echo $this->cizacl->scripts() ?>
<script type="text/javascript" src="<?php echo site_url('cizacl_js/resource_oper')?>"></script>
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
			<td width="150"><?php echo $this->lang->line('type')?></td>
			<td><?php echo form_dropdown($form['type']['name'], $form['type']['options'], $form['type']['selected'], $form['type']['attributes'])?></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('name')?></td>
			<td><?php echo form_input($form['name'])?></td>
		</tr>
		<tr id="tr_controller">
			<td><?php echo $this->lang->line('controller')?></td>
			<td><?php echo form_dropdown($form['controller']['name'], $form['controller']['options'], $form['controller']['selected'], $form['controller']['attributes'])?></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('description')?></td>
			<td><?php echo form_textarea($form['description'])?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><button type="submit" class="cizacl_btn_save"><?php echo $form['submit']?></button></td>
		</tr>
	</table>
	<?php echo form_close()?> </div>
</body>
</html>
