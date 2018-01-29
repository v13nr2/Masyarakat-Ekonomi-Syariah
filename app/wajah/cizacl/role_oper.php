<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->cizacl->name?>-<?php echo $this->lang->line('version')?><?php echo $this->cizacl->version?></title>
<?php echo $this->cizacl->css() ?><?php echo $this->cizacl->scripts() ?>
<script type="text/javascript" src="<?php echo site_url('cizacl_js/role_oper')?>"></script>
</head>

<body>

<div id="container">
	<p>&nbsp;</p>
	<div id="jq_msg"></div>
	<p>&nbsp;</p>
	<?php echo form_open($form['action'],$form['attributes'],$form['hidden'])?>
	<table width="100%">
		<tr>
			<td width="150"><?php echo $this->lang->line('role_name')?></td>
			<td><?php echo form_input($form['name'])?></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('inherit_by')?></td>
			<td><?php echo form_multiselect($form['inherit']['name'], $form['inherit']['options'], $form['inherit']['selected'], $form['inherit']['attributes'])?></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('redirect_to')?></td>
			<td><?php echo form_dropdown($form['redirect']['name'], $form['redirect']['options'], $form['redirect']['selected'], $form['redirect']['attributes'])?></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('description')?></td>
			<td><?php echo form_input($form['description'])?></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('default_role')?></td>
			<td><?php echo form_dropdown($form['default']['name'], $form['default']['options'], $form['default']['selected'], $form['default']['attributes'])?></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('order')?></td>
			<td><?php echo form_input($form['order'])?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><button type="submit" class="cizacl_btn_save"><?php echo $form['submit']?></button></td>
		</tr>
	</table>
	<?php echo form_close()?> </div>
</body>
</html>
