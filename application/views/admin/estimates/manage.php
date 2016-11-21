<?php init_head(); ?>
<div id="wrapper">
  <div class="content">
    <div class="row">
      <?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
      <div class="col-md-12" id="small-table">
        <div class="panel_s">
          <div class="panel-body _buttons">
            <?php if(has_permission('estimates','','create')){
              $this->load->view('admin/estimates/estimates_top_stats');
            } ?>
            <?php if(has_permission('estimates','','create')){ ?>
              <a href="<?php echo admin_url('estimates/estimate'); ?>" class="btn btn-info pull-left new"><?php echo _l('create_new_estimate'); ?></a>
              <?php } ?>
              <a href="<?php echo admin_url('estimates/pipeline/'.$switch_pipeline); ?>" class="btn btn-default mleft5 pull-left"><?php echo _l('switch_to_pipeline'); ?></a>
              <div class="display-block text-right">
                <div class="btn-group pull-right mleft4 btn-with-tooltip-group _filter_data" data-toggle="tooltip" data-title="<?php echo _l('filter_by'); ?>">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-filter" aria-hidden="true"></i>
                  </button>
                  <ul class="dropdown-menu width300">
                    <li>
                      <a href="#" data-cview="all" onclick="dt_custom_view('','.table-estimates',''); return false;">
                        <?php echo _l('estimates_list_all'); ?>
                      </a>
                    </li>
                     <li>
                        <a href="#" data-cview="not_sent" onclick="dt_custom_view('not_sent','.table-estimates','not_sent'); return false;">
                          <?php echo _l('estimates_not_sent'); ?>
                        </a>
                      </li>
                    <li class="divider"></li>
                    <?php foreach($estimate_statuses as $status){ ?>
                      <li class="<?php if($this->input->get('status') == $status){echo 'active';} ?>">
                        <a href="#" data-cview="estimates_<?php echo $status; ?>" onclick="dt_custom_view('estimates_<?php echo $status; ?>','.table-estimates','estimates_<?php echo $status; ?>'); return false;">
                          <?php echo format_estimate_status($status,'',false); ?>
                        </a>
                      </li>
                      <?php } ?>
                      <?php if(count($estimates_sale_agents) > 0){ ?>
                        <div class="clearfix"></div>
                        <li class="divider"></li>
                        <li class="dropdown-submenu pull-left">
                          <a href="#" tabindex="-1"><?php echo _l('sale_agent_string'); ?></a>
                          <ul class="dropdown-menu dropdown-menu-left">
                            <?php foreach($estimates_sale_agents as $agent){ ?>
                              <li>
                                <a href="#" data-cview="sale_agent_<?php echo $agent['sale_agent']; ?>" onclick="dt_custom_view(<?php echo $agent['sale_agent']; ?>,'.table-estimates','sale_agent_<?php echo $agent['sale_agent']; ?>'); init_estimates_total(); return false;"><?php echo get_staff_full_name($agent['sale_agent']); ?>
                                </a>
                              </li>
                              <?php } ?>
                            </ul>
                          </li>
                          <?php } ?>
                          <div class="clearfix"></div>
                          <?php if(count($estimates_years) > 0){ ?>
                            <li class="divider"></li>
                            <?php foreach($estimates_years as $year){ ?>
                             <li class="active">
                              <a href="#" data-cview="year_<?php echo $year['year']; ?>" onclick="dt_custom_view(<?php echo $year['year']; ?>,'.table-estimates','year_<?php echo $year['year']; ?>'); init_estimates_total(); return false;"><?php echo $year['year']; ?>
                              </a>
                            </li>
                            <?php } ?>
                            <?php } ?>
                          </ul>
                        </div>
                        <a href="#" class="btn btn-default btn-with-tooltip toggle-small-view hidden-xs" onclick="toggle_small_view('.table-estimates','#estimate'); return false;" data-toggle="tooltip" title="<?php echo _l('estimates_toggle_table_tooltip'); ?>"><i class="fa fa-angle-double-left"></i></a>
                        <?php if(has_permission('estimates','','create')){ ?>
                          <a href="#" class="btn btn-default btn-with-tooltip" onclick="slideToggle('#stats-top'); return false;" data-toggle="tooltip" title="<?php echo _l('view_stats_tooltip'); ?>"><i class="fa fa-bar-chart"></i></a>
                          <?php } ?>

                        </div>
                      </div>
                    </div>
                    <div class="panel_s">
                      <div class="panel-body">
                        <!-- if estimateid found in url -->
                        <?php echo form_hidden('estimateid',$estimateid); ?>
                        <?php
                        $table_data = array(
                         _l('estimate_dt_table_heading_number'),
                         _l('estimate_dt_table_heading_amount'),
                         _l('estimates_total_tax'),
                         _l('invoice_estimate_year'),
                         _l('estimate_dt_table_heading_client'),
                         _l('estimate_dt_table_heading_date'),
                         _l('estimate_dt_table_heading_expirydate'),
                         _l('reference_no'),
                         _l('estimate_dt_table_heading_status'),
                         );
                      //  $custom_fields = get_custom_fields('estimate',array('show_on_table'=>1));
                        foreach($custom_fields as $field){
                         array_push($table_data,$field['name']);
                       }
                       render_datatable($table_data,'estimates'); ?>
                     </div>
                   </div>
                 </div>
                 <div class="col-md-7">
                  <div id="estimate" class="hide">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php $this->load->view('admin/includes/modals/sales_attach_file'); ?>
          <script>var hidden_columns = [2,6,7];</script>
          <?php init_tail(); ?>
          <script>
            $(document).ready(function(){
             init_estimate();
           });
         </script>
       </body>
       </html>
