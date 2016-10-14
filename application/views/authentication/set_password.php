<?php $this->load->view('authentication/includes/head.php'); ?>
  <?php $attributes = array('class' => 'form-signin animated fadeInLeft', 'role'=> 'form', 'id' => 'forgotpass',  'novalidate' => 'true'); ?>
  <?=form_open($this->uri->uri_string(), $attributes)?>

  <?php echo get_company_logo(); ?>

  <?php echo form_open($this->uri->uri_string()); ?>
  <?php echo validation_errors('<div class="alert alert-danger text-center">', '</div>'); ?>
  <?php if($this->session->flashdata('message-danger')){ ?>
  <div class="alert alert-danger">
    <?php echo $this->session->flashdata('message-danger'); ?>
  </div>
  <?php } ?>
  <div class="forgotpass-info"><?php echo _l('admin_auth_set_password_heading'); ?></h1></div>

  <?php echo render_input('password','admin_auth_set_password','','password'); ?>

  <?php echo render_input('passwordr','admin_auth_set_password_repeat','','password'); ?>


<?php echo form_close(); ?>

 </div>
</div>

</body>

</html>

