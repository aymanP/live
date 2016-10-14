 <?php if((get_option('access_tickets_to_none_staff_members') == 1 && !is_staff_member()) || is_staff_member()){ ?>
   <div class="panel_s">
     <div class="panel-body padding-10">
       <div class="row">
        <div class="col-md-12 mbot10">
         <p class="text-muted padding-5"><?php echo _l('home_tickets_awaiting_reply_by_department'); ?></p>
         <hr class="no-mtop" />
         <canvas class="chart" height="175px" id="tickets-awaiting-reply-by-department"></canvas>
       </div>
       <div class="clearfix"></div>
       <hr class="no-margin" />
       <div class="clearfix mtop10"></div>
       <div class="col-md-12">
         <p class="text-muted padding-5"> <?php echo _l('home_tickets_awaiting_reply_by_status'); ?></p>
         <hr class="no-mtop" />
         <canvas class="chart" height="175px" id="tickets-awaiting-reply-by-status"></canvas>
       </div>
     </div>
   </div>
 </div>
 <?php } ?>
