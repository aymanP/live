<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
		</div>
		<div class="panel_s">
			<div class="panel-body">
				<?php render_datatable(array(
					_l('payments_table_number_heading'),
					_l('payments_table_invoicenumber_heading'),
					_l('payments_table_mode_heading'),
					_l('payment_transaction_id'),
					_l('payments_table_client_heading'),
					_l('payments_table_amount_heading'),
					_l('payments_table_date_heading'),
					_l('options')
					),'payments'); ?>
				</div>
			</div>
		</div>
	</div>
	<?php init_tail(); ?>
	<script>
   		 initDataTable('.table-payments', window.location.href, [7], [7]);
	</script>
</body>
</html>


