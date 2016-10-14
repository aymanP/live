<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?php if (isset($title)){
      echo $title;
    }
    ?>
  </title>
  <link href="<?php echo site_url('assets/css/reset.css'); ?>" rel="stylesheet">
  <?php if(get_option('favicon') != ''){ ?>
  <link href="<?php echo site_url('uploads/company/'.get_option('favicon')); ?>" rel="shortcut icon">
  <?php } ?>
  <link href="<?php echo site_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <?php if(get_option('rtl_support_client') == 1){ ?>
  <link rel="stylesheet" href="<?php echo site_url('assets/plugins/bootstrap-arabic/css/bootstrap-arabic.min.css'); ?>">
  <?php } ?>
  <script src="<?php echo site_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
  <!-- Bootstrap -->
  <link href="<?php echo site_url('assets/plugins/datatables/datatables.min.css'); ?>" rel="stylesheet">
  <link href='<?php echo site_url('assets/plugins/open-sans-fontface/open-sans.css'); ?>' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/plugins/font-awesome/css/font-awesome.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo site_url('assets/plugins/animate.css/animate.min.css'); ?>">
  <link href="<?php echo site_url('assets/plugins/datetimepicker/jquery.datetimepicker.css'); ?>" rel="stylesheet">
  <?php if(is_client_logged_in()){ ?>
  <link href="<?php echo site_url('assets/plugins/dropzone/min/basic.min.css'); ?>" rel='stylesheet'>
  <link href="<?php echo site_url('assets/plugins/dropzone/min/dropzone.min.css'); ?>" rel='stylesheet'>
  <link href='<?php echo site_url('assets/plugins/gantt/css/style.css'); ?>' rel='stylesheet' />
  <link href='<?php echo site_url('assets/plugins/jquery-comments/css/jquery-comments.css'); ?>' rel='stylesheet' />
  <?php } ?>
  <link rel="stylesheet" href="<?php echo site_url('assets/css/bs-overides.css'); ?>">
  <link href="<?php echo template_assets_url(); ?>css/style.css" rel="stylesheet" type='text/css'>
  <?php if(file_exists(FCPATH.'assets/css/custom.css')){ ?>
  <link href="<?php echo site_url('assets/css/custom.css'); ?>" rel="stylesheet" type='text/css'>
  <?php } ?>
  <?php if(get_option('use_recaptcha_customers_area') == 1 && get_option('recaptcha_secret_key') != '' && get_option('recaptcha_site_key') != '' && is_connected('google.com')){ ?>
       <script src='https://www.google.com/recaptcha/api.js'></script>
  <?php } ?>
  <?php $isRTL = (get_option('rtl_support_admin') == 0 ? 'false' : 'true'); ?>
  <?php render_custom_styles(array('general','tabs','buttons','customers','modals')); ?>
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
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <script>
        <?php if(is_staff_logged_in()){  ?>
        var admin_url = '<?php echo admin_url(); ?>';
        <?php } ?>
        var site_url = '<?php echo site_url(''); ?>';
        // Settings required for javascript
        var maximum_allowed_ticket_attachments = '<?php echo get_option("maximum_allowed_ticket_attachments"); ?>';
        var use_services = '<?php echo get_option("services"); ?>';
        var tables_pagination_limit = '<?php echo get_option("tables_pagination_limit"); ?>';
        var date_format = '<?php echo get_option("dateformat"); ?>';
        date_format = date_format.split('|');
        date_format = date_format[0];
        var dt_lang = <?php echo json_encode(get_datatables_language_array()); ?>;
        var discussions_lang = <?php echo json_encode(get_project_discussions_language_array()); ?>;
        var confirm_action_prompt = '<?php echo _l('confirm_action_prompt'); ?>';
        var field_is_required = '<?php echo _l('clients_required_field'); ?>';
        // Discussions
        var locale;
        <?php if(isset($locale)){ ?>
          locale = '<?php echo $locale; ?>';
        <?php } ?>
        var allowed_files = '<?php echo get_option('allowed_files'); ?>';
      </script>
    </head>
    <body class="customers <?php if(isset($bodyclass)){echo $bodyclass; } ?>" <?php if(get_option('rtl_support_client') == 1){ echo 'dir="rtl"';} ?>>

