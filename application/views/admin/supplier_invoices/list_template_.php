<?php
/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 14/11/2016
 * Time: 14:51
 */
?>
<div class="col-md-12" id="small-table">
    <div class="panel_s">
        <div class="panel-body _buttons">
            <?php
            if(has_permission('supplier_invoices','','create')){
                $this->load->view('admin/supplier_invoices/invoices_top_stats');
            }
            ?>
            <?php if(has_permission('supplier_invoices','','create')){ ?>
                <a href="<?php echo admin_url('supplier_invoices/invoice'); ?>" class="btn btn-info pull-left new new-invoice-list"><?php echo _l('create_new_invoice'); ?></a>
            <?php } ?>
            <div class="display-block text-right">
                <div class="btn-group pull-right mleft4 invoice-view-buttons btn-with-tooltip-group _filter_data" data-toggle="tooltip" data-title="<?php echo _l('filter_by'); ?>">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-filter" aria-hidden="true"></i>
                    </button>
                    <ul class="dropdown-menu width300">
                        <li>
                            <a href="#" data-cview="all" onclick="dt_custom_view('','.table-invoices',''); return false;">
                                <?php echo _l('invoices_list_all'); ?>
                            </a>
                        </li>
                        <li class="<?php if($custom_view == 'not_sent'){echo 'active';} ?>">
                            <a href="#" data-cview="not_sent" onclick="dt_custom_view('not_sent','.table-invoices','not_sent'); return false;">
                                <?php echo _l('invoices_list_not_sent'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-cview="not_have_payment" onclick="dt_custom_view('not_have_payment','.table-invoices','not_have_payment'); return false;">
                                <?php echo _l('invoices_list_not_have_payment'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-cview="recurring" onclick="dt_custom_view('recurring','.table-invoices','recurring'); return false;">
                                <?php echo _l('invoices_list_recuring'); ?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <?php foreach($invoices_statuses as $status){ ?>
                            <li class="<?php if($status == $chosen_invoice_status){echo 'active';} ?>">
                                <a href="#" data-cview="invoices_<?php echo $status; ?>" onclick="dt_custom_view('invoices_<?php echo $status; ?>','.table-invoices','invoices_<?php echo $status; ?>'); return false;"><?php echo format_invoice_status($status,'',false); ?></a>
                            </li>
                        <?php } ?>
                        <?php if(count($invoices_years) > 0){ ?>
                            <li class="divider"></li>
                            <?php foreach($invoices_years as $year){ ?>
                                <li class="active">
                                    <a href="#" data-cview="year_<?php echo $year['year']; ?>" onclick="dt_custom_view(<?php echo $year['year']; ?>,'.table-invoices','year_<?php echo $year['year']; ?>'); init_invoices_total(); return false;"><?php echo $year['year']; ?>
                                    </a>
                                </li>
                            <?php } ?>
                        <?php } ?>
                        <?php if(count($invoices_sale_agents) > 0){ ?>
                            <div class="clearfix"></div>
                            <li class="divider"></li>
                            <li class="dropdown-submenu pull-left">
                                <a href="#" tabindex="-1"><?php echo _l('sale_agent_string'); ?></a>
                                <ul class="dropdown-menu dropdown-menu-left">
                                    <?php foreach($invoices_sale_agents as $agent){ ?>
                                        <li>
                                            <a href="#" data-cview="sale_agent_<?php echo $agent['sale_agent']; ?>" onclick="dt_custom_view(<?php echo $agent['sale_agent']; ?>,'.table-invoices','sale_agent_<?php echo $agent['sale_agent']; ?>'); init_invoices_total(); return false;"><?php echo get_staff_full_name($agent['sale_agent']); ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <div class="clearfix"></div>
                        <li class="divider"></li>
                        <?php foreach($payment_modes as $mode){ ?>
                            <li>
                                <a href="#" data-cview="invoice_payments_by_<?php echo $mode['id']; ?>" onclick="dt_custom_view('<?php echo $mode['id']; ?>','.table-invoices','invoice_payments_by_<?php echo $mode['id']; ?>'); init_invoices_total(); return false;">
                                    <?php echo _l('invoices_list_made_payment_by',$mode['name']); ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <a href="#" class="btn btn-default btn-with-tooltip toggle-small-view hidden-xs" onclick="toggle_small_view('.table-invoices','#invoice'); return false;" data-toggle="tooltip" title="<?php echo _l('invoices_toggle_table_tooltip'); ?>"><i class="fa fa-angle-double-left"></i></a>
                <?php if(has_permission('supplier_invoices','','create')){ ?>
                    <a href="#" class="btn btn-default btn-with-tooltip" onclick="slideToggle('#stats-top'); return false;" data-toggle="tooltip" title="<?php echo _l('view_stats_tooltip'); ?>"><i class="fa fa-bar-chart"></i></a>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="panel_s">
        <div class="panel-body">
            <!-- if invoiceid found in url -->
            <?php echo form_hidden('invoiceid',$invoiceid); ?>
            <?php
            $table_data = array(
                _l('invoice_dt_table_heading_number'),
                _l('invoice_dt_table_heading_amount'),
                _l('invoice_total_tax'),
                _l('invoice_estimate_year'),
                _l('invoice_dt_table_heading_date'),
                _l('invoice_dt_table_heading_supplier'),
                _l('invoice_dt_table_heading_duedate'),
                _l('invoice_dt_table_heading_status'));
            $custom_fields = get_custom_fields('supplier_invoice',array('show_on_table'=>1));
            foreach($custom_fields as $field){
                array_push($table_data,$field['name']);
            }

            render_datatable($table_data,'invoices');
            ?>
        </div>
    </div>
</div>
<div class="col-md-7">
    <div id="supplier_invoice" class="hide">
    </div>
</div>

