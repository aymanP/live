<?php
/**
 * Created by PhpStorm.* User: DevTREE* Date: 26/10/2016* Time: 15:17
 */
?>
<div class="col-md-12" id="small-table">
    <div class="panel_s">
        <div class=" _buttons">
            <?php if(has_permission('estimates','','create')){
                $this->load->view('admin/estimates/estimates_top_stats');
            } ?>
           <!-- <?php if(has_permission('estimates','','create')){ ?>
                <a href="<?php echo admin_url('estimates/estimate'); ?>" class="btn btn-info pull-left new"><?php echo _l('create_new_estimate'); ?></a>
            <?php } ?> -->
            <!--<a href="<?php echo admin_url('estimates/pipeline/'.$switch_pipeline); ?>" class="btn btn-default mleft5 pull-left"><?php echo _l('switch_to_pipeline'); ?></a>-->
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
                                <a href="#" data-cview="estimates_<?php echo $status; ?>" onclick="dt_custom_view('estimates_<?php echo $status; ?>//','.table-estimates','estimates_<?php echo $status; ?>//'); return false;">
><?php echo format_estimate_status($status,'',false); ?>
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
                                            <a href="#" data-cview="sale_agent_<?php echo $agent['sale_agent']; ?>" onclick="dt_custom_view(<?php echo $agent['sale_agent']; ?>//,'.table-estimates','sale_agent_<?php echo $agent['sale_agent']; ?>//'); init_estimates_total(); return false;"><?php echo get_staff_full_name($agent['sale_agent']); ?>
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
                                    <a href="#" data-cview="year_<?php echo $year['year']; ?>" onclick="dt_custom_view(<?php echo $year['year']; ?>//,'.table-estimates','year_<?php echo $year['year']; ?>//'); init_estimates_total(); return false;"><?php echo $year['year']; ?>
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

        <input type="hidden" name="estimateid" value="">
        <div class="table-responsive">
            <table class="table dt-table" data-order-col="1" data-order-type="desc">


                <thead>
                <tr>
                    <th><?php echo _l('estimate_dt_table_heading_number'); ?></th>
                    <th><?php echo _l('estimate_dt_table_heading_amount'); ?></th>
                    <th><?php echo _l('estimates_total_tax'); ?></th>
                    <th><?php echo _l('invoice_estimate_year'); ?></th>
                    <th><?php echo _l('estimate_dt_table_heading_client'); // ?></th>
                    <th><?php echo _l('estimate_dt_table_heading_date'); ?></th>
                    <th><?php echo _l('estimate_dt_table_heading_expirydate'); ?></th>
                    <th><?php echo _l('reference_no'); ?></th>

                    <th><?php echo _l('estimate_dt_table_heading_status'); ?></th>
                    <?php
                    $custom_fields = get_custom_fields('estimate',array('show_on_client_portal'=>1));
                    foreach($custom_fields as $field){ ?>
                        <th><?php echo $field['name']; ?></th>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach($estimates as $estimate){ ?>
                    <tr>
                        <td data-order="<?php echo $estimate['number']; ?>"><a href="#" onclick="init_estimate(<?php echo $estimate['id']; ?>); return false;"><?php echo format_estimate_number($estimate['id']); ?></a></td>
                        <td data-order="<?php echo $estimate['total']; ?>"><?php echo format_money($estimate['total'], $estimate['symbol']);; ?></td>
                        <td data-order="<?php echo $estimate['total_tax']; ?>"><?php echo format_money($estimate['total_tax'], $estimate['symbol']);; ?></td>
                        <td data-order="<?php echo $estimate['year']; ?>"><?php echo $estimate['year']; ?></td>
                        <td data-order="<?php echo $estimate['company']; ?>"><a href="<?php echo admin_url('/clients/client/'.$estimate['clientid']) ?>"><?php echo $estimate['company']; ?></td></a>
                        <td data-order="<?php echo $estimate['datecreated']; ?>"><?php echo _d($estimate['datecreated']); ?></td>
                        <td data-order="<?php echo $estimate['expirydate']; ?>"><?php echo _d($estimate['expirydate']); ?></td>
                        <td data-order="<?php echo $estimate['refernce_no']; ?>"><?php echo $estimate['reference_no'];; ?></td>
                        <td><?php echo format_estimate_status($estimate['status'], 'inline-block', true); ?></td>
                        <?php foreach($custom_fields as $field){ ?>
                            <td><?php echo get_custom_field_value($estimate['id'],$field['id'],'estimate'); ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<div class="col-md-7">
    <div id="estimate" class="hide">
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
<div id="tacking-stats"></div>
<!-- Tracking stats chart for task END -->
<!-- Add/edit task modal start -->
<div id="_task"></div>
<!-- Add/edit task modal end -->
<script src="http://localhost/CRM/live/assets/plugins/jquery/jquery.min.js"></script>
<script>
</script>
<script src="http://localhost/CRM/live/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="http://localhost/CRM/live/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="http://localhost/CRM/live/assets/plugins/metisMenu/metisMenu.min.js"></script>
<script src="http://localhost/CRM/live/assets/plugins/datatables/datatables.min.js"></script>
<script src="http://localhost/CRM/live/assets/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="http://localhost/CRM/live/assets/plugins/tinymce/tinymce.min.js"></script>
<script src="http://localhost/CRM/live/assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="http://localhost/CRM/live/assets/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="http://localhost/CRM/live/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="http://localhost/CRM/live/assets/plugins/moment/moment-with-locales.min.js"></script>
<script src="http://localhost/CRM/live/assets/plugins/moment-timezone/moment-timezone-with-data.min.js"></script>
<script src="http://localhost/CRM/live/assets/plugins/moment-duration-format/moment-duration-format.js"></script>
<script src="http://localhost/CRM/live/assets/plugins/datetimepicker/jquery.datetimepicker.full.min.js"></script>
<script src="http://localhost/CRM/live/assets/plugins/prism/prism.js"></script>
<script src="http://localhost/CRM/live/assets/plugins/remarkable-bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="http://localhost/CRM/live/assets/plugins/Chart.js/Chart.min.js" type="text/javascript"></script>
<script src="http://localhost/CRM/live/assets/plugins/dropzone/min/dropzone.min.js"></script>
<script src="http://localhost/CRM/live/assets/plugins/jquery.are-you-sure/jquery.are-you-sure.js"></script>
<!-- are you sure safari fix -->
<script src="http://localhost/CRM/live/assets/plugins/jquery.are-you-sure/ays-beforeunload-shim.js"></script>
<!-- are you sure safari fix -->
<script src="http://localhost/CRM/live/assets/plugins/accounting.js/accounting.min.js"></script>
<script src="http://localhost/CRM/live/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="http://localhost/CRM/live/assets/js/newsfeed.js"></script>
<script src="http://localhost/CRM/live/assets/js/leads.js"></script>
<script src="http://localhost/CRM/live/assets/js/sales.js"></script>
<script src="http://localhost/CRM/live/assets/js/tasks.js"></script>
<script src="http://localhost/CRM/live/assets/js/main.js"></script>
<script>
</script>


<input type="file" multiple="multiple" class="dz-hidden-input" accept=".gif,.png,.jpeg,.jpg,.pdf,.doc,.txt,.docx,.xls,.zip,.rar,.xls,.mp4,.psd,.ai,.ind,.indx" style="visibility: hidden; position: absolute; top: 0px; left: 0px; height: 0px; width: 0px;">