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

    <title>Freelance Cockpit</title>

    <link href="http://demo.freelancecockpit.com/assets/blueline/css/bootstrap.min.css?ver=3.0.0" rel="stylesheet">
    <link rel="stylesheet" href="http://demo.freelancecockpit.com/assets/blueline/css/plugins/animate.css?ver=3.0.0" />
    <link rel="stylesheet" href="http://demo.freelancecockpit.com/assets/blueline/css/plugins/nprogress.css" />
    <link href="http://demo.freelancecockpit.com/assets/blueline/css/blueline.css?ver=3.0.0" rel="stylesheet">
    <link href="http://demo.freelancecockpit.com/assets/blueline/css/user.css?ver=3.0.0" rel="stylesheet" />
    <link rel="stylesheet" href="http://demo.freelancecockpit.com/assets/blueline/css/ionicons.min.css?ver=3.0.0" />

    <style>body{
            background: #D8DCE3;
        } .btn-primary, .progress-bar, .popover-title, .dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover, .fc-state-default, .chosen-container-multi .chosen-choices li.search-choice{
              background: #28a9f1;
          }.nav-sidebar > li > a:hover{
               background: rgba(40, 169, 241, 0.11);
               transition: background 0.2s ease;
           }.table-head, #main .action-bar, #message .header, .form-header, .notification-center__header a.active{
                box-shadow: 0 -2px 0 0 #28a9f1 inset;
            }.form-header{
                 color: #28a9f1;
             }.nav.nav-sidebar>li.active>a, .modal-header, .ui-slider-range, .ui-slider-handle:before,.list-group-item.active, .list-group-item.active:hover, .list-group-item.active:focus,.icon-frame{
                  background-image: none;
                  background: #28a9f1;
              }.sidebar-bg{
                   background: #2c3e4d;
               } .user_online__indicator{
                     border-color: #2c3e4d;
                 } .sidebar a, .sidebar h4, .nav>li>a, .nav-sidebar span.menu-icon i{
                       color: #FFFFFF;
                   } .mainnavbar{
                         background: #FFFFFF;
                     } .topbar__icon_alert{
                           border-color: #FFFFFF;
                       } .mainnavbar{
                             color: #333333;
                         } </style>    <script type="text/javascript">
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
        })(); </script>
    <link rel="SHORTCUT ICON" href="http://demo.freelancecockpit.com/assets/blueline/img/favicon.ico"/>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login" style="background-image:url('http://demo.freelancecockpit.com/assets/blueline/images/backgrounds/field.jpg')">
<div class="container-fluid">
    <div class="row" style="margin-bottom:0px">
            <?php $attributes = array('class' => 'form-signin form-register animated fadeInLeft', 'role'=> 'form', 'id' => 'login',  'novalidate' => 'true'); ?>
            <?=form_open('clients/register', $attributes)?>


            <div class="logo"><?php echo get_company_logo(); ?></div>
            <div class="row">
                <div class="header"><?php echo _l('clients_register_heading'); ?><hr></div>

                    <div class="col-md-6">
                        <h5 class="bold"><?php echo _l('client_register_company_info'); ?></h5>
                        <div class="form-group">
                            <label class="control-label" for="company"><?php echo _l('clients_company'); ?></label>
                            <input type="text" class="form-control" name="company" id="company" value="<?php echo set_value('company'); ?>">
                            <?php echo form_error('company'); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="vat"><?php echo _l('clients_vat'); ?></label>
                            <input type="text" class="form-control" name="vat" id="vat" value="<?php echo set_value('vat'); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="phonenumber"><?php echo _l('clients_phone'); ?></label>
                            <input type="text" class="form-control" name="phonenumber" id="phonenumber" value="<?php echo set_value('phonenumber'); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="lastname"><?php echo _l('clients_country'); ?></label>
                            <select name="country" class="form-control" id="country">
                                <option value=""></option>
                                <?php foreach(get_all_countries() as $country){ ?>
                                    <option value="<?php echo $country['country_id']; ?>" <?php if(get_option('customer_default_country') == $country['country_id']){echo 'selected';} ?> <?php echo set_select('country', $country['country_id']); ?>><?php echo $country['short_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="city"><?php echo _l('clients_city'); ?></label>
                            <input type="text" class="form-control" name="city" id="city" value="<?php echo set_value('city'); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="address"><?php echo _l('clients_address'); ?></label>
                            <input type="text" class="form-control" name="address" id="address" value="<?php echo set_value('address'); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="zip"><?php echo _l('clients_zip'); ?></label>
                            <input type="text" class="form-control" name="zip" id="zip" value="<?php echo set_value('zip'); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="state"><?php echo _l('clients_state'); ?></label>
                            <input type="text" class="form-control" name="state" id="state" value="<?php echo set_value('state'); ?>">
                        </div>
                        <?php echo render_custom_fields( 'customers','',array('show_on_client_portal'=>1)); ?>
                    </div>
                    <div class="col-md-6">
                        <h5 class="bold"><?php echo _l('client_register_contact_info'); ?></h5>
                        <div class="form-group">
                            <label class="control-label" for="firstname"><?php echo _l('clients_firstname'); ?></label>
                            <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo set_value('firstname'); ?>">
                            <?php echo form_error('firstname'); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="lastname"><?php echo _l('clients_lastname'); ?></label>
                            <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo set_value('lastname'); ?>">
                            <?php echo form_error('lastname'); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="email"><?php echo _l('clients_email'); ?></label>
                            <input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email'); ?>">
                            <?php echo form_error('email'); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="contact_phonenumber"><?php echo _l('clients_phone'); ?></label>
                            <input type="text" class="form-control" name="contact_phonenumber" id="contact_phonenumber" value="<?php echo set_value('contact_phonenumber'); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="title"><?php echo _l('contact_position'); ?></label>
                            <input type="text" class="form-control" name="title" id="title" value="<?php echo set_value('title'); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="password"><?php echo _l('clients_register_password'); ?></label>
                            <input type="password" class="form-control" name="password" id="password">
                            <?php echo form_error('password'); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="passwordr"><?php echo _l('clients_register_password_repeat'); ?></label>
                            <input type="password" class="form-control" name="passwordr" id="passwordr">
                            <?php echo form_error('passwordr'); ?>
                        </div>
                        <?php echo render_custom_fields( 'contacts','',array('show_on_client_portal'=>1)); ?>
                    </div>
                    <?php if(get_option('use_recaptcha_customers_area') == 1 && get_option('recaptcha_secret_key') != '' && get_option('recaptcha_site_key') != '' && is_connected('google.com')){ ?>
                        <div class="col-md-12">
                            <div class="g-recaptcha" data-sitekey="<?php echo get_option('recaptcha_site_key'); ?>"></div>
                            <?php echo form_error('g-recaptcha-response'); ?>
                        </div>
                    <?php } ?>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <a href="<?php echo site_url('/clients'); ?>">Go to login</a>
                    </div>
                    <div class="col-md-6">
                        <input type="submit" class="btn btn-success" value="<?php echo _l('clients_register_string'); ?>" />
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>

</body>
</html>
