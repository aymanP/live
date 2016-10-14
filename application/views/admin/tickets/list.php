<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
			<div class="col-md-12">
				<div class="panel_s">
					<div class="panel-body _buttons">
						<a href="<?php echo admin_url('tickets/add'); ?>" class="btn btn-info pull-left display-block mright5">
							<?php echo _l('new_ticket'); ?>
						</a>
						<a href="#" class="btn btn-default btn-with-tooltip" data-toggle="tooltip" data-placement="bottom" data-title="<?php echo _l('tickets_chart_weekly_opening_stats'); ?>" onclick="slideToggle('.weekly-ticket-opening',init_tickets_weekly_chart); return false;"><i class="fa fa-bar-chart"></i></a>
            <div class="btn-group pull-right mleft4 btn-with-tooltip-group _filter_data" data-toggle="tooltip" data-title="<?php echo _l('filter_by'); ?>">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-filter" aria-hidden="true"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-right width300">
                <li>
                  <a href="#" data-cview="all" onclick="dt_custom_view('','.tickets-table',''); return false;">
                    <?php echo _l('task_list_all'); ?>
                  </a>
                </li>
                <li>
                  <a href="" data-cview="my_tickets" onclick="dt_custom_view('my_tickets','.tickets-table','my_tickets'); return false;"><?php echo _l('my_tickets_assigned'); ?></a>
                </li>
                <li class="divider"></li>
                <?php foreach($statuses as $status){ ?>
                  <li class="<?php if($status['ticketstatusid'] == $chosen_ticket_status || $chosen_ticket_status == '' && $status['ticketstatusid'] == 1){echo 'active';} ?>">
                    <a href="#" data-cview="ticket_status_<?php echo $status['ticketstatusid']; ?>" onclick="dt_custom_view('ticket_status_<?php echo $status['ticketstatusid']; ?>','.tickets-table','ticket_status_<?php echo $status['ticketstatusid']; ?>'); return false;">
                      <?php echo ticket_status_translate($status['ticketstatusid']); ?>
                    </a>
                  </li>
                  <?php } ?>
                  <?php if(count($ticket_assignees) > 0 && is_admin()){ ?>
                         <div class="clearfix"></div>
                   <li class="divider"></li>
                   <li class="dropdown-submenu pull-left">
                     <a href="#" tabindex="-1"><?php echo _l('filter_by_assigned'); ?></a>
                     <ul class="dropdown-menu dropdown-menu-left">
                        <?php foreach($ticket_assignees as $as){ ?>
                            <li>
                                <a href="#" data-cview="ticket_assignee_<?php echo $as['assigned']; ?>" onclick="dt_custom_view(<?php echo $as['assigned']; ?>,'.tickets-table','ticket_assignee_<?php echo $as['assigned']; ?>'); return false;"><?php echo get_staff_full_name($as['assigned']); ?></a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="panel_s animated weekly-ticket-opening" style="display:none;">
           <div class="panel-heading-bg">
            <?php echo _l('home_weekend_ticket_opening_statistics'); ?>
          </div>
          <div class="panel-body">
            <canvas class="chart" id="weekly-ticket-openings-chart" height="70"></canvas>
          </div>
        </div>
        <div class="panel_s">
         <div class="panel-body">
          <?php do_action('before_render_tickets_list_table'); ?>
          <?php $this->load->view('admin/tickets/summary'); ?>
          <div class="clearfix"></div>
          <?php echo AdminTicketsTableStructure(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php init_tail(); ?>
<script src="<?php echo site_url(); ?>assets/js/tickets.js"></script>
<script>
  var chart;
  var chart_data = <?php echo $weekly_tickets_opening_statistics; ?>;
  function init_tickets_weekly_chart() {
    if (typeof(chart) !== 'undefined') {
      chart.destroy();
    }
    // Weekly ticket openings statistics
    chart = new Chart($('#weekly-ticket-openings-chart'),{
    	type:'line',
    	data:chart_data,
    	options:{responsive:true}
    });
  }
</script>
</body>
</html>
