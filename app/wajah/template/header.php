<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<header class="main-header">
	<a href="<?=base_url()?>" class="logo">
		<span class="logo-mini kunci"><b>SAK</b></span> <span class="logo-lg kunci"><b>AKUNTANSI</b></span>
	</a>
	<nav class="navbar navbar-static-top">
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="<?=base_url('assets/dist/img/avatar5.png')?>" class="user-image" alt="User Image">
						<span class="hidden-xs kunci">
						    <?php 
						    $pdata = $this->session->userdata('session_data'); //Retrive ur session

		                    $nama = $pdata['ses_nama'];
						    echo $nama; ?></span>
					</a>
					<ul class="dropdown-menu">
						<li class="user-header">
							<img src="<?=base_url('assets/dist/img/avatar5.png')?>" class="img-circle" alt="User Image">
							<p class="kunci"> <?php echo $this->session->userdata($this->config->item('ses_name')); ?>
								<small> terdaftar sejak <?php echo date_format(date_create($this->session->userdata($this->config->item('ses_create'))), "M Y"); ?> </small>
							</p>
						</li>
						<?php /*<li class="user-body"> <div class="row"> <div class="col-xs-4 text-center"> <a href="#">Followers</a> </div> <div class="col-xs-4 text-center"> <a href="#">Sales</a> </div> <div class="col-xs-4 text-center"> <a href="#">Friends</a> </div> </div> </li>*/ ?>
						<li class="user-footer">
							<div class="pull-left">
								<a href="<?=base_url('profil')?>" class="btn btn-default btn-flat">Profile</a>
							</div>
							<div class="pull-right">
								<a href="<?=base_url('logout')?>" class="btn btn-default btn-flat">Keluar</a>
							</div>
						</li>
					</ul>
				</li>
				<li> <a href="<?=base_url().'dokumentasi'?>"><i class="fa fa-info"></i></a> </li>
			</ul>
		</div>
	</nav>
</header>
