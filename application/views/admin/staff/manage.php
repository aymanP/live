<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
			<div class="col-md-12">
			<?php if(has_permission('staff','','create')){ ?>
				<div class="panel_s">
					<div class="panel-body _buttons">
						<a href="<?php echo admin_url('staff/member'); ?>" class="btn btn-info pull-left display-block"><?php echo _l('new_staff'); ?></a>
					</div>
				</div>
				<?php } ?>
				<div class="panel_s">
					<div class="panel-body">
						<div class="clearfix"></div>
						<?php
						$table_data = array(
							_l('staff_dt_name'),
							_l('staff_dt_email'),
							_l('staff_dt_last_Login'),
							_l('staff_dt_active'),
							);
						$custom_fields = get_custom_fields('staff',array('show_on_table'=>1));
						foreach($custom_fields as $field){
							array_push($table_data,$field['name']);
						}
						array_push($table_data,_l('options'));
						render_datatable($table_data,'staff');
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
<script>
	var headers_staff = $('.table-staff').find('th');
	var not_sortable_staff = (headers_staff.length - 1);

	initDataTable('.table-staff', window.location.href, [not_sortable_staff], [not_sortable_staff]);
</script>
</body>
</html>
