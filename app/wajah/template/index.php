<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head> <?=$metadata?>
	<script src="<?=base_url('assets/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
	<script src="<?=base_url('assets/bower_components/raphael/raphael-min.js')?>"></script>
	<script src="<?=base_url('assets/bower_components/morrisjs/morris.min.js')?>"></script>
	<script src="<?=base_url('assets/plugins/select2/select2.min.js')?>"></script>
	<script src="<?=base_url('assets/plugins/select2/i18n/id.js')?>" type="text/javascript"></script>
	<script type="text/javascript"> var change_form = false; function form_change(status) {change_form = status; } </script>
        
        <script src="<?= base_url('assets/bootstrap-3-typeahead/bootstrap3-typeahead.min.js'); ?>" type="text/javascript"></script>
</head>
<body class="hold-transition skin-red fixed sidebar-mini">
	<?php /* layout-boxed sidebar-collapse*/ ?>
	<span class='nprogress-logo fade out'></span>
	<div class="wrapper">
		<?=$headernya?><?=$sidebarnya?>
		<div class="content-wrapper" id="contentLTE">
			<?php 
					echo $contentnya;
			?>
		</div>
	</div>
	
	<script src="<?=base_url('assets/customnan/jquery-ui.min.js')?>"></script>
	<script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
	<script src="<?=base_url('assets/plugins/datepicker/bootstrap-datepicker.js')?>"></script>
	<script src="<?=base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	<script src="<?=base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
	<script src="<?=base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js')?>"></script>
	<script src="<?=base_url('assets/plugins/fastclick/fastclick.js')?>"></script>
	<script src="<?=base_url('assets/nprogress/nprogress.js')?>"></script>
	<script src="<?=base_url('assets/validatoreng/jquery.validationEngine-id.js')?>"></script>
	<script src="<?=base_url('assets/validatoreng/jquery.validationEngine.js')?>"></script>
	<script src="<?=base_url('assets/validetta/validetta.js')?>"></script>
	<script src="<?=base_url('assets/customnan/jquery-nan.js')?>"></script>
	<script src="<?=base_url('assets/customnan/jquery-price-nan.js')?>"></script>
	<script src="<?=base_url('assets/customnan/jquery.lock.min.js')?>"></script>
	<script src="<?=base_url('assets/customnan/jquery-ui-1.9.20.js')?>"></script>
	<script src="<?=base_url('assets/dist/js/app.js')?>"></script>
	<script src="<?=base_url('assets/dist/js/demo.js')?>"></script>
	<script src="<?=base_url('assets/notificatoin_handler.js')?>"></script>
	<!--
	<script src="<?=base_url('assets/app.js')?>"></script>
	<script src="<?=base_url('assets/general_helper.js')?>"></script>
	<script src="<?=base_url('assets/app.minjs')?>"></script>
	-->
    
    
	<script type="text/javascript">
		/*
			<!--
			terima kasih sudah mengunjungi aplikasi Akuntansi buatan kami.
			semoga hari Anda menyenangkan.
			-->
		*/
		function currentTime(){
			currentDate = new Date();
			monthNames = [ "Januari", "Februari", "Maret", "April", "Mei", "Juni",
			"Juli", "Agustus", "September", "Oktober", "November", "Desember" ];
			dayNames = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];

			fullDate = dayNames[currentDate.getDay()] + ", " + currentDate.getDate() + " " + monthNames[currentDate.getMonth()] + " " + currentDate.getFullYear();

			$('#timereal').text(fullDate + " " + ("0" + currentDate.getHours()).slice(-2) + ":"+ ("0" + currentDate.getMinutes()).slice(-2));

			setTimeout(function(){
				currentTime();
			}, 1000);
		}
		NProgress.start();
		setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
		currentTime();

		$(".kunci").lock();
	</script>
</body>
</html>
