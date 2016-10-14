<?php init_head(); ?>
<div id="wrapper">
  <div class="content">
   <div class="row">
    <?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
    <div class="col-md-12">
     <?php $this->load->view('admin/includes/widgets/top_stats'); ?>
    </div>
    <div class="col-md-8">
     <?php $this->load->view('admin/includes/widgets/finance_overview'); ?>
     <?php $this->load->view('admin/includes/widgets/user_data'); ?>
     <div class="row">
     <?php if(is_staff_member()){ ?>
      <div class="col-md-6">
       <?php $this->load->view('admin/includes/widgets/leads_chart'); ?>
     </div>
     <?php } ?>
     <div class="col-md-<?php if(!is_staff_member()){echo 12;}else{echo 6;};?>">
       <?php $this->load->view('admin/includes/widgets/projects_chart'); ?>
     </div>
   </div>
   <?php $this->load->view('admin/includes/widgets/calendar'); ?>
   <?php $this->load->view('admin/includes/widgets/weekly_payments_chart'); ?>
 </div>
 <div class="col-md-4">
  <?php $this->load->view('admin/includes/widgets/todos'); ?>
  <?php $this->load->view('admin/includes/widgets/upcoming_events'); ?>
  <?php $this->load->view('admin/includes/widgets/tickets_chart'); ?>
  <?php $this->load->view('admin/includes/widgets/projects_activity'); ?>
</div>
</div>
</div>
</div>
<script>
 google_api = '<?php echo $google_api_key; ?>';
 calendarIDs = '<?php echo json_encode($google_ids_calendars); ?>';
</script>
<?php init_tail(); ?>
<?php $this->load->view('admin/utilities/calendar_template'); ?>
<script>
 var weekly_payments_statistics;
 $(document).ready(function() {
   if ($('#tickets-awaiting-reply-by-department').length > 0) {
           // Tickets awaiting reply by department chart
           var tickets_dep_chart = new Chart($('#tickets-awaiting-reply-by-department'), {
             type: 'doughnut',
             data: <?php echo $tickets_awaiting_reply_by_department; ?>
           });
         }
         if ($('#tickets-awaiting-reply-by-status').length > 0) {
           // Tickets awaiting reply by department chart
           new Chart($('#tickets-awaiting-reply-by-status'), {
             type: 'doughnut',
             data: <?php echo $tickets_reply_by_status; ?>
           });
         }
         if ($('#leads_status_stats').length > 0) {
           // Leads overview status
           new Chart($('#leads_status_stats'), {
             type: 'doughnut',
             data: <?php echo $leads_status_stats; ?>
           });
         }

       // Projects statuses
       new Chart($('#projects_status_stats'), {
         type: 'bar',
         data: <?php echo $projects_status_stats; ?>
       });
       // Payments statistics
       init_weekly_payment_statistics();
       $('select[name="currency"]').on('change', function() {
         init_weekly_payment_statistics();
       });
     });

 function init_weekly_payment_statistics() {
   if ($('#weekly-payment-statistics').length > 0) {
     if (typeof(weekly_payments_statistics) !== 'undefined') {
       weekly_payments_statistics.destroy();
     }
     var currency = $('select[name="currency"]').val();
     $.get(admin_url + 'home/weekly_payments_statistics/' + currency, function(response) {
       weekly_payments_statistics = new Chart($('#weekly-payment-statistics'), {
         type: 'bar',
         data: response,
         options: {
           responsive: true
         },
       });
     }, 'json');
   }
 }
</script>
</body>
</html>
