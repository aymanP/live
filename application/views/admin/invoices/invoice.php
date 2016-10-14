<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<?php
			include_once(APPPATH . 'views/admin/includes/alerts.php');
			echo form_open($this->uri->uri_string(),array('id'=>'invoice-form','class'=>'_transaction_form'));
			if(isset($invoice)){
				echo form_hidden('isedit');
			}
			?>
			<div class="col-md-12">
				<?php $this->load->view('admin/invoices/invoice_template'); ?>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
<?php init_tail(); ?>
<script>
	$(document).ready(function(){
		validate_invoice_form();
	    // Init accountacy currency symbol
	    init_currency_symbol($('select[name="currency"]').val());
	});
</script>
</body>
</html>

