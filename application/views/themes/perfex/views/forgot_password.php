
      <?php $attributes = array('class' => 'form-signin animated fadeInLeft', 'role'=> 'form', 'id' => 'login',  'novalidate' => 'true'); ?>
      <?=form_open($this->uri->uri_string(), $attributes)?>

      <div class="logo"><?php echo get_company_logo(); ?></div>

      <?php echo validation_errors('<div id="error" class="animated shake">', '</div>'); ?>
      <?php if($this->session->flashdata('message-danger')){ ?>
      <div class="alert alert-danger">
        <?php echo $this->session->flashdata('message-danger'); ?>
      </div>
      <?php } ?>

      <div class="forgotpass-info"><?php echo _l('customer_forgot_password_heading'); ?></h1></div>

      <?php echo render_input('email','customer_forgot_password_email',set_value('email'),'email'); ?>

        <button type="submit" class="btn btn-info btn-block"><?php echo _l('customer_forgot_password_submit'); ?></button>

      <?php echo form_close(); ?>

