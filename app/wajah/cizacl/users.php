<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->cizacl->name?>-<?php echo $this->lang->line('version')?><?php echo $this->cizacl->version?></title>
<?php echo $this->cizacl->css() ?><?php echo $this->cizacl->scripts() ?>
<script type="text/javascript" src="<?php echo site_url('cizacl_js/users')?>"></script>
</head>

<body>
<div id="header"></div>
<div id="container">
	<h1><?php echo $this->lang->line('users_management')?></h1>
	<p align="right">
		<button type="button" onclick="view();" class="cizacl_btn_view"><?php echo $this->lang->line('view')?></button>
		&nbsp;
		<button type="button" onclick="add();" class="cizacl_btn_add"><?php echo $this->lang->line('add')?></button>
		&nbsp;
		<button type="button" onclick="edit();" class="cizacl_btn_edit"><?php echo $this->lang->line('edit')?></button>
		&nbsp;
		<button type="button" onclick="del();" class="cizacl_btn_del"><?php echo $this->lang->line('del')?></button>
	</p>
	<p>&nbsp;</p>
	<table id="users_table" class="jqgrid">
	</table>
	<div id="users_navigator"></div>
</div>
</body>
</html>
