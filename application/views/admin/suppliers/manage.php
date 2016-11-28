<?php
/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 07/11/2016
 * Time: 11:07
 */
?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="_buttons">
                            <?php if (has_permission('suppliers','','create')) { ?>
                                <a href="<?php echo admin_url('suppliers/supplier'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                    <?php echo _l('new_supplier'); ?></a>
                                <a href="<?php echo admin_url('suppliers/import'); ?>" class="btn btn-info pull-left display-block mright5">
                                    <?php echo _l('import_suppliers'); ?></a>
                            <?php } ?>
                            <div class="visible-xs">
                                <div class="clearfix"></div>
                            </div>
                            <div class="btn-group pull-right btn-with-tooltip-group _filter_data" data-toggle="tooltip" data-title="<?php echo _l('filter_by'); ?>">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-filter" aria-hidden="true"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-left" style="width:300px;">
                                    <li class="active"><a href="#" data-cview="all" onclick="dt_custom_view('','.table-clients',''); return false;"><?php echo _l('suppliers_sort_all'); ?></a></li>
                                    <li class="divider"></li>
                                    <?php if(count($groups) > 0){ ?>
                                        <li class="dropdown-submenu pull-left groups">
                                            <a href="#" tabindex="-1"><?php echo _l('supplier_groups'); ?></a>
                                            <ul class="dropdown-menu dropdown-menu-left">
                                                <?php foreach($groups as $group){ ?>
                                                    <li><a href="#" data-cview="supplier_group_<?php echo $group['id']; ?>" onclick="dt_custom_view('supplier_group_<?php echo $group['id']; ?>','.table-clients','supplier_group_<?php echo $group['id']; ?>'); return false;"><?php echo $group['name']; ?></a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <div class="clearfix"></div>
                                        <li class="divider"></li>
                                    <?php } ?>
                                    <li class="dropdown-submenu pull-left invoice">
                                        <a href="#" tabindex="-1"><?php echo _l('invoices'); ?></a>
                                        <ul class="dropdown-menu dropdown-menu-left">
                                            <?php foreach($invoice_statuses as $status){ ?>
                                                <li>
                                                    <a href="#" data-cview="invoices_<?php echo $status; ?>" data-cview="1" onclick="dt_custom_view('invoices_<?php echo $status; ?>','.table-suppliers','invoices_<?php echo $status; ?>'); return false;"><?php echo _l('supplier_have_invoices_by',format_invoice_status($status,'',false)); ?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <div class="clearfix"></div>
                                    <li class="divider"></li>
<!--                                    <li class="dropdown-submenu pull-left estimate">-->
<!--                                        <a href="#" tabindex="-1">--><?php //echo _l('estimates'); ?><!--</a>-->
<!--                                        <ul class="dropdown-menu dropdown-menu-left">-->
<!--                                            --><?php //foreach($estimate_statuses as $status){ ?>
<!--                                                <li>-->
<!--                                                    <a href="#" data-cview="estimates_<?php //echo $status; ?>" onclick="dt_custom_view('estimates_<?php //echo $status; ?>','.table-suppliers','estimates_<?php //echo $status; ?>'); return false;"> -->
                                                        <?php //echo _l('supplier_have_estimates_by',format_estimate_status($status,'',false)); ?>
<!--                                                    </a>-->
<!--                                                </li>-->
<!--                                            --><?php //} ?>
<!--                                        </ul>-->
<!--                                    </li>-->
<!--                                    <div class="clearfix"></div>-->
<!--                                    <li class="divider"></li>-->
                                    <li class="dropdown-submenu pull-left project">
                                        <a href="#" tabindex="-1"><?php echo _l('projects'); ?></a>
                                        <ul class="dropdown-menu dropdown-menu-left">
                                            <?php foreach($project_statuses as $status){ ?>
                                                <li>
                                                    <a href="#" data-cview="projects_<?php echo $status; ?>" onclick="dt_custom_view('projects_<?php echo $status; ?>','.table-suppliers','projects_<?php echo $status; ?>'); return false;">
                                                        <?php echo _l('customer_have_projects_by',_l('project_status_'.$status)); ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <div class="clearfix"></div>
                                    <li class="divider"></li>
                                    <li class="dropdown-submenu pull-left proposal">
                                        <a href="#" tabindex="-1"><?php echo _l('proposals'); ?></a>
                                        <ul class="dropdown-menu dropdown-menu-left">
                                            <?php foreach($proposal_statuses as $status){ ?>
                                                <li>
                                                    <a href="#" data-cview="proposals_<?php echo $status; ?>" onclick="dt_custom_view('proposals_<?php echo $status; ?>','.table-suppliers','proposals_<?php echo $status; ?>'); return false;">
                                                        <?php echo _l('supplier_have_proposals_by',format_proposal_status($status,'',false)); ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <div class="clearfix"></div>
                                    <?php if(count($contract_types) > 0) { ?>
                                        <li class="divider"></li>
                                        <li class="dropdown-submenu pull-left contract_types">
                                            <a href="#" tabindex="-1"><?php echo _l('contract_types'); ?></a>
                                            <ul class="dropdown-menu dropdown-menu-left">
                                                <?php foreach($contract_types as $type){ ?>
                                                    <li>
                                                        <a href="#" data-cview="contract_type_<?php echo $type['id']; ?>" onclick="dt_custom_view('contract_type_<?php echo $type['id']; ?>','.table-suppliers','contract_type_<?php echo $type['id']; ?>'); return false;">
                                                            <?php echo _l('supplier_have_contracts_by_type',$type['name']); ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <?php if(has_permission('suppliers','','view')) { ?>
                            <hr />
                            <div class="row mbot15">
                                <div class="col-md-12">
                                    <h3 class="text-success no-margin"><?php echo _l('suppliers_summary'); ?></h3>
                                </div>
                                <div class="col-md-2 col-xs-6 border-right">
                                    <h3 class="bold"><?php echo total_rows('tblsuppliers'); ?></h3>
                                    <span class="text-success bold"><?php echo _l('suppliers_summary_total'); ?></span>
                                </div>
                                <div class="col-md-2 col-xs-6 border-right">
                                    <h3 class="bold"><?php echo total_rows('tblsuppliercontacts',array('active'=>1)); ?></h3>
                                    <span class="text-info bold"><?php echo _l('customers_summary_active'); ?></span>
                                </div>
                                <div class="col-md-2  col-xs-6 border-right">
                                    <h3 class="bold"><?php echo total_rows('tblsuppliercontacts',array('active'=>0)); ?></h3>
                                    <span class="text-danger bold"><?php echo _l('customers_summary_inactive'); ?></span>
                                </div>
                                <div class="col-md-2 col-xs-6">
                                    <h3 class="bold"><?php echo total_rows('tblsuppliercontacts','last_login = DATE('.date('Y-m-d').')'); ?></h3>
                                    <span class="text-muted bold"><?php echo _l('customers_summary_logged_in_today'); ?></span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="_filters _hidden_inputs hidden">
                    <?php
                    foreach($groups as $group){
                        echo form_hidden('customer_group_'.$group['id']);
                    }
//                    foreach($contract_types as $type){
//                        echo form_hidden('contract_type_'.$type['id']);
//                    }
                    foreach($invoice_statuses as $status){
                        echo form_hidden('invoices_'.$status);
                    }
//                    foreach($estimate_statuses as $status){
//                        echo form_hidden('estimates_'.$status);
//                    }
                    foreach($project_statuses as $status){
                        echo form_hidden('projects_'.$status);
                    }
                    foreach($proposal_statuses as $status){
                        echo form_hidden('proposals_'.$status);
                    }
                    ?>
                </div>

                 <?php /*
                $table_data = array();
                $_table_data = array(
                    _l('settings_general_company_logo'),
                    _l('clients_list_company'),
                    _l('contact_primary'),
                    _l('company_primary_email'),
                    _l('clients_list_phone'),
                    _l('customer_groups'),
                    _l('customer_active'),
                    _l('customer_mode_alami'),
                );
                foreach($_table_data as $_t){
                    array_push($table_data,$_t);
                }
                $custom_fields = get_custom_fields('customers',array('show_on_table'=>1));
                foreach($custom_fields as $field){
                    array_push($table_data,$field['name']);
                }
                $_op = _l('options');
                if(has_permission('customers','','delete')){
                    $_op .= '<div class="checkbox hide mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="clients"><label></label></div>';
                }
                array_push($table_data, $_op);

                render_datatable($table_data,'clients');*/
                ?>
                <!-- meeeeeeee -->
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="clearfix"></div>
                        <?php
                        $table_data = array();
                        $_table_data = array(
                            _l('settings_general_company_logo'),
                            _l('suppliers_list_company'),
                            _l('contact_primary'),
                            _l('company_primary_email'),
                            _l('suppliers_list_phone'),
                            _l('customer_groups'),
                        );
                        foreach($_table_data as $_t){
                            array_push($table_data,$_t);
                        }
                        $custom_fields = get_custom_fields('suppliers',array('show_on_table'=>1 ));
                        foreach($custom_fields as $field){
                            array_push($table_data,$field['name']);
                        }
                        $_op = _l('options');
                        if(has_permission('suppliers','','delete')){
                            $_op .= '<div class="checkbox hide mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="clients"><label></label></div>';
                        }
                        array_push($table_data, $_op);

                        render_datatable($table_data,'clients');
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>

<script>
    var CustomersServerParams = {};
    $.each($('._hidden_inputs._filters input'),function(){
        CustomersServerParams[$(this).attr('name')] = '[name="'+$(this).attr('name')+'"]';
    });
    var headers_clients = $('.table-clients').find('th');
    var not_sortable_clients = (headers_clients.length - 1);
   initDataTable('.table-clients', window.location.href, [not_sortable_clients], [not_sortable_clients], CustomersServerParams);
</script>
</body>
</html>

