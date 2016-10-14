<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <META Http-Equiv="Cache-Control" Content="no-cache">
    <META Http-Equiv="Pragma" Content="no-cache">
    <META Http-Equiv="Expires" Content="0">
    <meta name="robots" content="none" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="18000">

    <title><?php echo get_option('companyname'); ?> - Authentication</title>

    <link rel="SHORTCUT ICON" href=favicon.ico"/>
    <?php if(get_option('recaptcha_secret_key') != '' && get_option('recaptcha_site_key') != '' && is_connected('google.com')){ ?>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php } ?>
    <?php if(file_exists(FCPATH.'assets/css/custom.css')){ ?>
        <link href="<?php echo site_url('assets/css/custom.css'); ?>" rel="stylesheet">
    <?php } ?>
    <?php render_custom_styles(array('general','buttons')); ?>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="<?php echo site_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo site_url('assets/plugins/animate/animate.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('assets/css/authentication/login.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/slideshow.css'); ?>" />

    <style>
        .cb-slideshow li:nth-child(1) span {
            background-image: url(<?php echo site_url('media/homeslideruploads/1.jpg'); ?>);
        }
        .cb-slideshow li:nth-child(2) span {
            background-image: url(<?php echo site_url('media/homeslideruploads/2.jpg'); ?>);
            -webkit-animation-delay: 6s;
            -moz-animation-delay: 6s;
            -o-animation-delay: 6s;
            -ms-animation-delay: 6s;
            animation-delay: 6s;
        }
        .cb-slideshow li:nth-child(3) span {
            background-image: url(<?php echo site_url('media/homeslideruploads/3.jpg'); ?>);
            -webkit-animation-delay: 12s;
            -moz-animation-delay: 12s;
            -o-animation-delay: 12s;
            -ms-animation-delay: 12s;
            animation-delay: 12s;
        }
        .cb-slideshow li:nth-child(4) span {
            background-image: url(<?php echo site_url('media/homeslideruploads/4.jpg'); ?>);
            -webkit-animation-delay: 18s;
            -moz-animation-delay: 18s;
            -o-animation-delay: 18s;
            -ms-animation-delay: 18s;
            animation-delay: 18s;
        }
        .cb-slideshow li:nth-child(5) span {
            background-image: url(<?php echo site_url('media/homeslideruploads/5.jpg'); ?>);
            -webkit-animation-delay: 24s;
            -moz-animation-delay: 24s;
            -o-animation-delay: 24s;
            -ms-animation-delay: 24s;
            animation-delay: 24s;
        }
        .cb-slideshow li:nth-child(6) span {
            background-image: url(<?php echo site_url('media/homeslideruploads/6.jpg'); ?>);
            -webkit-animation-delay: 30s;
            -moz-animation-delay: 30s;
            -o-animation-delay: 30s;
            -ms-animation-delay: 30s;
            animation-delay: 30s;
        }


    </style>
    <script type="text/javascript">
        WebFontConfig = {
            google: { families: [ 'Open+Sans:400italic,400,300,600,700:latin' ] }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>

<body class="login" cz-shortcut-listen="true">
<ul class="cb-slideshow">
    <li><span>Image 01</span></li>
    <li><span>Image 02</span></li>
    <li><span>Image 03</span></li>
    <li><span>Image 04</span></li>
    <li><span>Image 05</span></li>
    <li><span>Image 06</span></li>
</ul>
<div class="container-fluid">
    <div class="row" style="margin-bottom:0px">

