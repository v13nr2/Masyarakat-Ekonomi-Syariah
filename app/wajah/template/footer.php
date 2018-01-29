<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 0.1
    </div>
    <?php
    if (date('Y') == "2016") {
        echo '<strong>Copyright &copy; 2016 <a href="">raf</a>.</strong> All rights reserved.';
    } else {
        echo '<strong>Copyright &copy; 2016-' . date('Y') . ' <a href="">raf</a>.</strong> All rights reserved.';
    }
    ?>
</footer>


<script src="<?php echo base_url() ?>/js/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url() ?>/js/custom_menu.js"></script>

