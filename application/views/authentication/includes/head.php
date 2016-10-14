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

  <!--<link rel="SHORTCUT ICON" href=favicon.ico"/> -->
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
    <?php echo generate_slider()['html']; ?>

    .cb-slideshow,
    .cb-slideshow:after {
      position: fixed;
      width: 100%;
      height: 100%;
      top: 0px;
      left: 0px;
      z-index: 0;
    }

    .cb-slideshow li span {
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0px;
      left: 0px;
      color: transparent;
      background-size: cover;
      background-position: 50% 50%;
      background-repeat: no-repeat;
      opacity: 0;
      z-index: 0;
      -webkit-backface-visibility: hidden;
      -webkit-animation: imageAnimation 24s linear infinite 0s;
      -moz-animation: imageAnimation 24s linear infinite 0s;
      -o-animation: imageAnimation 24s linear infinite 0s;
      -ms-animation: imageAnimation 24s linear infinite 0s;
      animation: imageAnimation 24s linear infinite 0s;


    }
    .cb-slideshow li div {
      z-index: 1000;
      position: absolute;
      bottom: 30px;
      left: 0px;
      width: 100%;
      text-align: center;
      opacity: 0;
    }

    <?php echo generate_slider()['css']; ?>

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

    <body class="login" cz-shortcut-listen="true"">
<?php echo generate_slider($this->uri->uri_string())['html']; ?>
    <div class="container-fluid">
    <div class="row" style="margin-bottom:0px">

