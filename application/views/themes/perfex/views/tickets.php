<div class="panel_s">
  <div class="panel-body">
    <h4 class="bold  text-muted pull-left"><?php echo _l('clients_tickets_heading'); ?></h4>
    <a href="<?php echo site_url('clients/open_ticket'); ?>" class="btn btn-info pull-right"><?php echo _l('clients_ticket_open_subject'); ?></a>
  </div></div>
  <div class="panel_s">
    <div class="panel-body">
      <div class="row">
        <?php foreach($ticket_statuses as $status){ ?>
         <div class="col-md-2 border-right">
           <h3 class="bold">
            <a href="<?php echo site_url('clients/tickets/'.$status['ticketstatusid']); ?>"><?php echo total_rows('tbltickets',array('userid'=>get_client_user_id(),'status'=>$status['ticketstatusid'])); ?></a></h3>
            <span class="bold" style="color:<?php echo $status['statuscolor']; ?>"><?php echo ticket_status_translate($status['ticketstatusid']); ?></span>
          </div>
          <?php } ?>
        </div>
        <div class="clearfix"></div>
        <hr />

        <div class="clearfix"></div>
        <?php get_template_part('tickets_table'); ?>
      </div>
    </div>
  </div>
