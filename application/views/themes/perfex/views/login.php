



<div id="showFirst" class="animated fadeInLeft">

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

		<?php if(get_option('allow_registration') == 1){
			$msg = _l('clients_login_heading_register');
		} else {
			$msg = _l('clients_login_heading_no_register');
		}
		?>
		<div class="forgotpass-info"><?php echo $msg; ?></h1></div>

		<div class="form-group">
			<label for="email"><?php echo _l('clients_login_email'); ?></label>
			<input type="text" autofocus="true" class="form-control" name="email" id="email">
			<?php echo form_error('email'); ?>
		</div>
		<div class="form-group">
			<label for="password"><?php echo _l('clients_login_password'); ?></label>
			<input type="password" class="form-control" name="password" id="password">
			<?php echo form_error('password'); ?>
		</div>
		<?php if(get_option('use_recaptcha_customers_area') == 1 && get_option('recaptcha_secret_key') != '' && get_option('recaptcha_site_key') != '' && is_connected('google.com')){ ?>
			<div class="g-recaptcha" data-sitekey="<?php echo get_option('recaptcha_site_key'); ?>"></div>
			<?php echo form_error('g-recaptcha-response'); ?>
		<?php } ?>
		<div class="form-remember">
			<label for="remember">
				<input type="checkbox" name="remember" id="remember"> <?php echo _l('clients_login_remember'); ?>
			</label>
		</div>

		<input type="submit" class="btn btn-primary fadeoutOnClick" value="<?php echo _l('clients_login_login_string'); ?>" style="pointer-events: all; cursor: pointer;">
<!--		<div class="forgotpassword"><a href="--><?php //echo site_url('clients/forgot_password'); ?><!--">--><?php //echo _l('customer_forgot_password'); ?><!--</a></div>-->
	<div class="forgotpassword"><a href="#"  onclick="switchVisible()"><?php echo _l('customer_forgot_password'); ?></a></div>



	<?php if(get_option('allow_registration') == 1) { ?>
			<div class="sub">
				<div class="small">
					<small>You don't have an account?</small>
				</div>
				<hr>
				<a href="<?php echo site_url('/clients/register'); ?>" class="btn btn-success"><?php echo _l('clients_register_string'); ?></a>
			</div>
		<?php } ?>

		<br clear="both">
		<a href="<?php echo site_url('/authentication/admin'); ?>"><div class="admin-login"><?php echo _l('login_as_admin'); ?></div></a>
		<a href="<?php echo site_url('/clients/login'); ?>"><div class="client-login"><?php echo _l('login_as_client'); ?></div></a>
		<br clear="both">

		<?php echo form_close(); ?>
</div>

								<!---------------- Forgot password Begins -------------->
<div class ="animated fadeInLeft" id="showSecond">
		<?php $attributes = array('class' => 'form-signin animated fadeInLeft', 'role'=> 'form', 'id' => 'login',  'novalidate' => 'true'); ?>
		<?=form_open(site_url('clients/forgot_password'), $attributes)?>

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
	<div class="forgotpassword"><a href="#"  onclick="switchVisible()">Go to login</a></div>
		<?php echo form_close(); ?>
</div>

									<!---------------- Forgot password ENDs -------------->

		<style>
			#showSecond {
				display: none;
			}
		</style>
		<script>
			function switchVisible() {
				if (document.getElementById('showFirst')) {

					if (document.getElementById('showFirst').style.display == 'none') {
						document.getElementById('showFirst').style.display = 'block';
						document.getElementById('showSecond').style.display = 'none';
					}
					else {
						document.getElementById('showFirst').style.display = 'none';
						document.getElementById('showSecond').style.display = 'block';
					}
				}
			}
		</script>
		<script>
			$(document).ready(function() {
				$('#showSecond').click(function() {
					$('.showLogin').slideToggle("slow");
				});
			});
		</script>