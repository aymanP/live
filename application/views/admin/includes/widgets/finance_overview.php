  <?php  if(has_permission('invoices','','view') || has_permission('proposals','','view') || has_permission('estimates','','view')){ ?>
   <div class="finance-summary">
    <div class="panel_s">

     <div class="panel-body">

      <div class="row home-summary">
       <?php if(has_permission('invoices','','view')){
        $total_invoices = total_rows('tblinvoices');
        $total_unpaid = total_rows('tblinvoices',array('status'=>1));
        $total_overdue = total_rows('tblinvoices',array('status'=>4));
        $total_not_sent = total_rows('tblinvoices',array('sent'=>0,'status !='=>2));
        $total_partialy = total_rows('tblinvoices',array('status'=>3));
        $total_paid = total_rows('tblinvoices',array('status'=>2));
        $percent_unpaid = ($total_invoices > 0 ? number_format(($total_unpaid * 100) / $total_invoices,2) : 0);
        $percent_overdue = ($total_invoices > 0 ? number_format(($total_overdue * 100) / $total_invoices,2) : 0);
        $percent_not_sent = ($total_invoices > 0 ? number_format(($total_not_sent * 100) / $total_invoices,2) : 0);
        $percent_partialy = ($total_invoices > 0 ? number_format(($total_partialy * 100) / $total_invoices,2) : 0);
        $percent_paid = ($total_invoices > 0 ? number_format(($total_paid * 100) / $total_invoices,2) : 0);
        ?>

        <div class="col-md-6 col-lg-4 col-sm-6">
         <div class="row">
          <div class="col-md-12">
           <p class="text-dark text-uppercase"><?php echo _l('home_invoice_overview'); ?></p>
           <hr class="no-mtop" />
         </div>
         <div class="col-md-12 text-stats-wrapper">
           <a href="<?php echo admin_url('invoices/list_invoices?status=1'); ?>" class="text-danger mbot10 inline-block">
             <span class="_total bold"><?php echo $total_unpaid; ?></span> <?php echo _l('invoice_status_unpaid'); ?>
           </a>
         </div>
         <div class="col-md-12 text-right progress-finance-status">
          <?php echo $percent_unpaid; ?>%
          <div class="progress no-margin progress-bar-mini">
            <div class="progress-bar progress-bar-danger no-percent-text not-dynamic" role="progressbar" aria-valuenow="<?php echo $percent_unpaid; ?>" aria-valuemin="0" aria-valuemax="100" style="width: 0%" data-percent="<?php echo $percent_unpaid; ?>">
            </div>
          </div>
        </div>
        <div class="col-md-12 text-stats-wrapper">
         <a href="<?php echo admin_url('invoices/list_invoices?status=4'); ?>" class="text-warning mbot10 inline-block">
          <span class="_total bold"><?php echo $total_overdue; ?></span> <?php echo _l('home_invoice_overdue'); ?>
        </a>
      </div>
      <div class="col-md-12 text-right progress-finance-status">
       <?php echo $percent_overdue; ?>%
       <div class="progress no-margin progress-bar-mini">
         <div class="progress-bar progress-bar-warning no-percent-text not-dynamic" role="progressbar" aria-valuenow="<?php echo $percent_overdue; ?>" aria-valuemin="0" aria-valuemax="100" style="width: 0%" data-percent="<?php echo $percent_overdue; ?>">
         </div>
       </div>
     </div>
     <div class="col-md-12 text-stats-wrapper">
      <a href="<?php echo admin_url('invoices/list_invoices?custom_view=not_sent'); ?>" class="text-muted inline-block mbot10">
       <span class="_total bold"><?php echo $total_not_sent; ?></span> <?php echo _l('home_invoice_not_sent'); ?>
     </a>
   </div>
   <div class="col-md-12 text-right progress-finance-status">
    <?php echo $percent_not_sent; ?>%
    <div class="progress no-margin progress-bar-mini">
      <div class="progress-bar progress-bar-default no-percent-text not-dynamic" role="progressbar" aria-valuenow="<?php echo $percent_not_sent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: 0%" data-percent="<?php echo $percent_not_sent; ?>">
      </div>
    </div>
  </div>
  <div class="col-md-12 text-stats-wrapper">
   <a href="<?php echo admin_url('invoices/list_invoices?status=3'); ?>" class="text-warning mbot10 inline-block">
    <span class="_total bold"><?php echo $total_partialy; ?></span> <?php echo _l('home_invoice_partialy_paid'); ?>
  </a>
</div>
<div class="col-md-12 text-right progress-finance-status">
 <?php echo $percent_partialy; ?>%
 <div class="progress no-margin progress-bar-mini">
   <div class="progress-bar progress-bar-danger no-percent-text not-dynamic" role="progressbar" aria-valuenow="<?php echo $percent_partialy; ?>" aria-valuemin="0" aria-valuemax="100" style="width: 0%" data-percent="<?php echo $percent_partialy; ?>">
   </div>
 </div>
</div>
<div class="col-md-12 text-stats-wrapper">
  <a href="<?php echo admin_url('invoices/list_invoices?status=2'); ?>" class="text-success mbot10 inline-block">
   <span class="_total bold"><?php echo $total_paid; ?></span> <?php echo _l('home_invoice_paid'); ?>
 </a>
</div>
<div class="col-md-12 text-right progress-finance-status">
  <?php echo $percent_paid; ?>%
  <div class="progress no-margin progress-bar-mini">
    <div class="progress-bar progress-bar-success no-percent-text not-dynamic" role="progressbar" aria-valuenow="<?php echo $percent_paid; ?>" aria-valuemin="0" aria-valuemax="100" style="width: 0%" data-percent="<?php echo $percent_paid; ?>">
    </div>
  </div>
</div>
</div>
</div>
<?php } ?>
<?php if(has_permission('estimates','','view')){ ?>
 <div class="col-md-6 col-lg-4 col-sm-6">
  <div class="row">
   <div class="col-md-12 text-stats-wrapper">
    <p class="text-dark text-uppercase"><?php echo _l('home_estimate_overview'); ?></p>
    <hr class="no-mtop" />
  </div>
  <?php foreach($estimate_statuses as $status){
    $percent_data = get_estimates_percent_by_status($status);
    ?>
    <div class="col-md-12 text-stats-wrapper">
     <a href="<?php echo admin_url('estimates/list_estimates?status='.$status); ?>" class="text-<?php echo estimate_status_color_class($status,true); ?> mbot10 inline-block">
      <span class="_total bold"><?php echo $percent_data['total_by_status']; ?></span>
    </span> <?php echo format_estimate_status($status,'',false); ?>
  </a>
</div>
<div class="col-md-12 text-right progress-finance-status">
  <?php echo $percent_data['percent']; ?>%
  <div class="progress no-margin progress-bar-mini">
   <div class="progress-bar progress-bar-<?php echo estimate_status_color_class($status); ?> no-percent-text not-dynamic" role="progressbar" aria-valuenow="<?php echo $percent_data['percent']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: 0%" data-percent="<?php echo $percent_data['percent']; ?>">
   </div>
 </div>
</div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if(has_permission('proposals','','view')){ ?>
 <div class="col-md-12 col-sm-6 col-lg-4">
  <div class="row">
   <div class="col-md-12 text-stats-wrapper">
    <p class="text-dark text-uppercase"><?php echo _l('home_proposal_overview'); ?></p>
    <hr class="no-mtop" />
  </div>
  <?php foreach($proposal_statuses as $status){
    $percent_data = get_proposals_percent_by_status($status);
    ?>
    <div class="col-md-12 text-stats-wrapper">
      <a href="<?php echo admin_url('proposals/list_proposals?status='.$status); ?>" class="text-<?php echo proposal_status_color_class($status,true); ?> mbot10 inline-block">
        <span class="_total bold"><?php echo $percent_data['total_by_status']; ?></span> <?php echo format_proposal_status($status,'',false); ?>
      </a>
    </div>
    <div class="col-md-12 text-right progress-finance-status">
     <?php echo $percent_data['percent']; ?>%
     <div class="progress no-margin progress-bar-mini">
      <div class="progress-bar progress-bar-<?php echo proposal_status_color_class($status); ?> no-percent-text not-dynamic" role="progressbar" aria-valuenow="<?php echo $percent_data['percent']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: 0%" data-percent="<?php echo $percent_data['percent']; ?>">
      </div>
    </div>
  </div>
  <?php } ?>
  <div class="clearfix"></div>
</div>
</div>
<?php } ?>
</div>
  <?php if(has_permission('invoices','','view')){ ?>
    <hr />
          <div id="invoices_total"></div>
      <?php } ?>
</div>

</div>
</div>
<?php } ?>

