<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->cizacl->name?>-<?php echo $this->lang->line('version')?><?php echo $this->cizacl->version?></title>
<?php echo $this->cizacl->css() ?><?php echo $this->cizacl->scripts() ?>
<script type="text/javascript" src="<?php echo site_url('cizacl_js/rule_oper')?>"></script>
</head>

<body>
<div id="header_cb">
	<h2><?php echo $body['title']?></h2>
</div>
<div id="container">
	<p>&nbsp;</p>
	<div id="jq_msg"></div>
	<p>&nbsp;</p>
	<?=form_open($form['action'],$form['attributes'],$form['hidden'])?>
	<table width="100%">
		<tr>
			<td width="35%" align="right"><?php echo $this->lang->line('set_rule')?></td>
			<td width="65%"><?=form_dropdown($form['role']['name'], $form['role']['options'], $form['role']['selected'], $form['role']['attributes'])?></td>
		</tr>
		<tr>
			<td align="right">&nbsp;</td>
			<td align="right"><button type="button" class="cizacl_btn_add" onclick="addRule();"><?php echo $this->lang->line('new_rule')?></button></td>
		</tr>
		<tr>
			<td colspan="2" align="right" valign="top"><table width="100%" id="rules">
					<tr>
						<td width="1%" align="center"><strong>#</strong></td>
						<td width="11%"><strong><?php echo $this->lang->line('rule')?></strong></td>
						<td width="33%"><strong><?php echo $this->lang->line('controller')?></strong></td>
						<td width="33%"><strong><?php echo $this->lang->line('function')?></strong></td>
						<td width="7%"><strong><?php echo $this->lang->line('state')?></strong></td>
						<td width="15%"><strong><?php echo $this->lang->line('description')?></strong></td>
					</tr>
					<tbody>
					</tbody>
				</table></td>
		</tr>
		<tr>
			<td colspan="2" align="right" valign="top">&nbsp;</td>
		</tr>
		<tr>
			<td align="right">&nbsp;</td>
			<td><button type="submit" class="cizacl_btn_save">
				<?=$form['submit']?>
				</button></td>
		</tr>
	</table>
	<?=form_close()?>
</div>
</body>
</html>
