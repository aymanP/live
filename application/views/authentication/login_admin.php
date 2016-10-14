<?php $this->load->view('authentication/includes/head.php'); ?>



            <?php $attributes = array('class' => 'form-signin animated fadeInLeft', 'role'=> 'form', 'id' => 'login',  'novalidate' => 'true'); ?>
            <?=form_open($this->uri->uri_string(), $attributes)?>

            <div class="logo">
                <?php echo get_company_logo(); ?>
            </div>

            <?php echo validation_errors('<div id="error" class="animated shake">', '</div>'); ?>
            <?php if($this->session->flashdata('message-danger')){ ?>
                <div class="alert alert-danger">
                    <?php echo $this->session->flashdata('message-danger'); ?>
                </div>
            <?php } ?>
            <?php if($this->session->flashdata('message-success')){ ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('message-success'); ?>
                </div>
            <?php } ?>

            <div class="form-group">
                <label for="email"><?php echo _l('admin_auth_login_email'); ?></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo _l('admin_auth_login_email'); ?>">
            </div>
            <div class="form-group">
                <label for="password"><?php echo _l('admin_auth_login_password'); ?></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="<?php echo _l('admin_auth_login_password'); ?>">
            </div>

            <div class="form-remember">
                <label for="remember">
                    <input type="checkbox" id="remember" name="remember"> <?php echo _l('admin_auth_login_remember_me'); ?>
                </label>
            </div>

            <input type="submit" class="btn btn-primary fadeoutOnClick" value="<?php echo _l('admin_auth_login_button'); ?>" style="pointer-events: all; cursor: pointer;">
            <div class="forgotpassword"><a href="<?php echo site_url('authentication/forgot_password'); ?>"><?php echo _l('admin_auth_login_fp'); ?></a></div>


            <?php if(get_option('recaptcha_secret_key') != '' && get_option('recaptcha_site_key') != '' && is_connected('google.com')){ ?>
                <div class="g-recaptcha" data-sitekey="<?php echo get_option('recaptcha_site_key'); ?>"></div>
            <?php } ?>

            <br clear="both">
            <br clear="both">
                <a href="<?php echo site_url('/authentication/admin'); ?>"><div class="admin-login"><?php print_r(form_open($this->uri->uri_string(),$attributes));?><?php echo _l('login_as_admin'); ?></div></a>
                <a href="<?php echo site_url('/clients/login'); ?>"><div class="client-login"><?php echo _l('login_as_client') ; ?></div></a>
            <br clear="both">
            <?php echo form_close(); ?>
    </div>
</div>


</body>
</html>
