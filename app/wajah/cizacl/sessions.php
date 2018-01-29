<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->cizacl->name?>-<?php echo $this->lang->line('version')?><?php echo $this->cizacl->version?></title>
<?php echo $this->cizacl->css() ?><?php echo $this->cizacl->scripts() ?>
<script type="text/javascript" src="<?php echo site_url('cizacl_js/sessions')?>"></script>
</head>

<body>
<div id="header"></div>
<div id="container">
	<h1><?php echo $this->lang->line('sessions_management')?></h1>
	<p align="right">
		<button type="button" onclick="del()" class="cizacl_btn_del"><?php echo $this->lang->line('del')?></button>
	</p>
	<p>&nbsp;</p>
	<table id="sessions_table">
	</table>
	<div id="sessions_navigator"></div>
</div>
</body>
</html>
