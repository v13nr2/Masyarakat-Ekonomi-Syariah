<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->cizacl->name?>-<?php echo $this->lang->line('version')?><?php echo $this->cizacl->version?></title>
<?php echo $this->cizacl->css() ?><?php echo $this->cizacl->scripts() ?>
</head>

<body>
<div id="header_cb">
	<h2><?php echo $this->lang->line('view_user')?></h2>
</div>
<div id="container">
	<p>&nbsp;</p>
	<table width="100%" cellpadding="5" cellspacing="0">
		<tr>
			<td width="100"><?php echo $this->lang->line('name')?></td>
			<td><strong><?php echo $row->user_profile_name?></strong></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('surname')?></td>
			<td><strong><?php echo $row->user_profile_surname?></strong></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('email')?></td>
			<td><strong><?php echo $row->user_profile_email?></strong></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('username')?></td>
			<td><strong><?php echo $row->user_username?></strong></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('password')?></td>
			<td><em><?php echo $this->lang->line('cannot_see')?></em></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('role')?></td>
			<td><strong><?php echo $row->cizacl_role_name?></strong></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('state')?></td>
			<td><strong><?php echo $row->user_status_name?></strong></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('added_by')?></td>
			<td><strong><?php echo $this->cizacl_mdl->getUser($row->user_profile_added_by)?></strong></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('added_on')?></td>
			<td><strong><?php echo $this->cizacl_mdl->mktime_format($row->user_profile_added)?></strong></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('edited_by')?></td>
			<td><strong><?php echo $this->cizacl_mdl->getUser($row->user_profile_edited_by,'')?></strong></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('edited_on')?></td>
			<td><strong><?php echo $this->cizacl_mdl->mktime_format($row->user_profile_edited)?></strong></td>
		</tr>
	</table>
</div>
</body>
</html>
