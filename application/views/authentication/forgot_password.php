<?php $this->load->view('authentication/includes/head.php'); ?>

   <?php $attributes = array('class' => 'form-signin animated fadeInLeft', 'role'=> 'form', 'id' => 'forgotpass',  'novalidate' => 'true'); ?>
   <?=form_open($this->uri->uri_string(), $attributes)?>

   <div class="logo"><?php echo get_company_logo(); ?></div>
   <?php echo validation_errors('<div class="alert alert-danger text-center">', '</div>'); ?>
   <?php if($this->session->flashdata('message-danger')){ ?>
    <div class="alert alert-danger">
     <?php echo $this->session->flashdata('message-danger'); ?>
    </div>
   <?php } ?>

   <div class="forgotpass-info"><?php echo _l('admin_auth_forgot_password_heading'); ?></h1></div>

     <div class="form-group">
      <label for="email"><?php echo _l('admin_auth_forgot_password_email'); ?></label>
      <input type="text" class="form-control" name="email" id="email" value="<?php set_value('email'); ?>" placeholder="Email">
     </div>

     <input type="submit" class="btn btn-primary" value="<?php echo _l('admin_auth_forgot_password_button'); ?>" />
     <div class="forgotpassword"><a href="">Go to login</a></div>
     <button type="submit" class="btn btn-info btn-block"><?php echo _l('customer_forgot_password_submit'); ?></button>

   <?php echo form_close(); ?>
  </div>
</div>

</body>
</html>

