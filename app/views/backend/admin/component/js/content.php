<!-- BEGIN VENDOR JS-->
<script src="<?php echo config_item('backend_vendors_url'); ?>js/vendors.min.js" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="<?php echo config_item('backend_vendors_url'); ?>js/extensions/toastr.min.js" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="<?php echo config_item('backend_js_url'); ?>core/app-menu.js" type="text/javascript"></script>
<script src="<?php echo config_item('backend_js_url'); ?>core/app.js" type="text/javascript"></script>
<!-- END MODERN JS-->
<!-- BEGIN PAGE LEVEL JS-->
<?php echo ShowAlert(); ?>
<!-- END PAGE LEVEL JS-->