<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <?php if(get_option('favicon') != ''){ ?>
        <link href="<?php echo site_url('uploads/company/'.get_option('favicon')); ?>" rel="shortcut icon">
        <?php } ?>
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?php if (isset($title)){ echo $title; } else { echo get_option('companyname'); } ?></title>
        <link href="<?php echo site_url('assets/css/reset.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <?php if(get_option('rtl_support_admin') == 1){ ?>
        <link href="<?php echo site_url('assets/plugins/bootstrap-arabic/css/bootstrap-arabic.min.css'); ?>" rel="stylesheet">
        <?php } ?>
        <link href="<?php echo site_url('assets/plugins/jquery-ui/jquery-ui.min.css'); ?>" rel="stylesheet">
        <link href='<?php echo site_url('assets/plugins/open-sans-fontface/open-sans.css'); ?>' rel='stylesheet'>
        <link href="<?php echo site_url('assets/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('assets/plugins/datatables/datatables.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('assets/plugins/metisMenu/metisMenu.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('assets/plugins/bootstrap-select/css/bootstrap-select.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('assets/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('assets/plugins/prism/prism.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('assets/plugins/datetimepicker/jquery.datetimepicker.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('assets/plugins/animate/animate.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('assets/plugins/dropzone/min/basic.min.css'); ?>" rel='stylesheet'>
        <link href="<?php echo site_url('assets/plugins/dropzone/min/dropzone.min.css'); ?>" rel='stylesheet'>
        <?php if(isset($calendar_assets)){ ?>
        <link href='<?php echo site_url('assets/plugins/fullcalendar/fullcalendar.min.css'); ?>' rel='stylesheet' />
        <?php } ?>
        <?php if(isset($projects_assets)){ ?>
        <link href='<?php echo site_url('assets/plugins/jquery-comments/css/jquery-comments.css'); ?>' rel='stylesheet' />
        <link href='<?php echo site_url('assets/plugins/gantt/css/style.css'); ?>' rel='stylesheet' />
        <?php } ?>
        <?php if(isset($media_assets)){ ?>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo site_url('assets/plugins/elFinder/css/elfinder.min.css'); ?>">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo site_url('assets/plugins/elFinder/themes/windows-10/css/theme.css'); ?>">
        <?php } ?>
        <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css'); ?>">
        <link href="<?php echo site_url('assets/css/bs-overides.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('assets/css/style.css'); ?>" rel="stylesheet">
        <?php if(file_exists(FCPATH.'assets/css/custom.css')){ ?>
        <link href="<?php echo site_url('assets/css/custom.css'); ?>" rel="stylesheet">
        <?php } ?>
        <?php $isRTL = (get_option('rtl_support_admin') == 0 ? 'false' : 'true'); ?>
        <?php
        if($isRTL == 'true'){
            echo '
            <style>
            div.dataTables_wrapper {
                direction: rtl;
            }
           </style>';
         }
         ?>
        <?php render_custom_styles(array('general','tabs','buttons','admin','modals')); ?>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php render_admin_js_variables(); ?>
        <script>
            var dt_lang = <?php echo json_encode(get_datatables_language_array()); ?>;
            var taskid,task_tracking_stats_data
            var locale = '<?php echo $locale; ?>';
            var isRTL = '<?php echo $isRTL; ?>';
            var tinymce_lang = '<?php echo $tinymce_lang; ?>';
            var _table_api;
        </script>
    </head>
    <?php do_action('before_body_start'); ?>
    <body <?php if(get_option('rtl_support_admin') == 1){ echo 'dir="rtl"';} ?> class="admin <?php if(isset($bodyclass)){echo $bodyclass . ' '; } ?><?php if($this->session->has_userdata('is_mobile') && $this->session->userdata('is_mobile') == true){echo 'hide-sidebar ';} ?><?php if(get_option('rtl_support_admin') == 1){echo 'rtl';} ?>">
        <?php do_action('after_body_start'); ?>
