       <?php if(has_permission('payments','','view')){ ?>
        <div class="row" id="weekly_payments">
         <div class="col-md-12">
          <div class="panel_s">
           <div class="panel-body padding-10">
            <div class="col-md-12">
             <p class="text-muted pull-left"><?php echo _l('home_weekly_payment_records'); ?></p>
             <?php if(has_permission('reports','','view')){ ?>
              <a href="<?php echo admin_url('reports/sales'); ?>?report_income=true" class="pull-right"><?php echo _l('home_stats_full_report'); ?></a>
              <div class="clearfix"></div>
              <?php } ?>
              <div class="clearfix"></div>
              <?php if (is_using_multiple_currencies()) { ?>
               <select class="selectpicker pull-left mbot15" name="currency" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                <?php foreach($currencies as $currency){
                 $selected = '';
                 if($currency['isdefault'] == 1){
                   $selected = 'selected';
                 }
                 ?>
                 <option value="<?php echo $currency['id']; ?>" <?php echo $selected; ?> data-subtext="<?php echo $currency['name']; ?>"><?php echo $currency['symbol']; ?></option>
                 <?php } ?>
               </select>
               <?php } ?>
               <canvas class="chart" id="weekly-payment-statistics" height="auto"></canvas>
             </div>
           </div>
         </div>
       </div>
     </div>
     <?php } ?>
