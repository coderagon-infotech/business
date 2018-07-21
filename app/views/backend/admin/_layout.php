<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
    <head>
        <title><?php echo get_CompanyName(); ?><?php echo isset($page_title) ? ' | ' . $page_title : ''; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
        <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
        <meta name="author" content="PIXINVENT">
        <script>
            site_url = '<?php echo site_url(); ?>';
            csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
        </script>
        <link rel="apple-touch-icon" href="<?php echo config_item('backend_images_url'); ?>ico/apple-icon-120.png">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo config_item('backend_images_url'); ?>ico/favicon.ico">
        <!-- Css -->
        <?php include VIEWPATH . backend('admin/component/css/index.php', 1); ?>
        <!-- End Css -->
    </head>
    <body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">
        <!-- Navigation -->
        <?php include VIEWPATH . backend('admin/component/navigation/index.php', 1); ?>
        <!-- End Navigation -->
        <!-- Sidebar -->
        <?php include VIEWPATH . backend('admin/component/sidebar/index.php', 1); ?>
        <!-- End Sidebar -->
        <!-- Page -->
        <?php include VIEWPATH . $page_folder . '/' . $page_name . ".php"; ?>
        <!-- End Page -->
        <!-- Footer -->
        <?php include VIEWPATH . backend('admin/component/footer/index.php', 1); ?>
        <!-- End Footer -->
        <!-- Js -->
        <?php include VIEWPATH . backend('admin/component/js/index.php', 1); ?>
        <!-- End Js -->
    </body>
</html>