<?php
/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 16/11/2016
 * Time: 18:04
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
<!--            --><?php //if(has_permission('supplier_invoices','','create')){ ?>
<!--                <a href="--><?php //echo admin_url('supplier_invoices/invoice'); ?><!--" class="btn btn-info pull-left new new-invoice-list">--><?php //echo _l('create_new_invoice'); ?><!--</a>-->
<!--            --><?php //} ?>



            <?php if (has_permission('suppliers_invoices', '', 'create')) { ?>
                <a href="#" data-toggle="modal" data-target="#new_supplier_invoice" class="btn btn-info pull-left new new-invoice-list"><?php echo _l('create_new_invoice'); ?></a>
            <?php } ?>
            <div class="display-block text-right">
                <div class="btn-group pull-right mleft4 invoice-view-buttons btn-with-tooltip-group _filter_data" data-toggle="tooltip" data-title="<?php echo _l('filter_by'); ?>">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-filter" aria-hidden="true"></i>
                    </button>
                    <ul class="dropdown-menu width300">
                        <li>
                            <a href="#" data-cview="all" onclick="dt_custom_view('','.table-supplier_invoices',''); return false;">
                                <?php echo _l('invoices_list_all'); ?>
                            </a>
                        </li>
                        <li class="<?php if($custom_view == 'not_sent'){echo 'active';} ?>">
                            <a href="#" data-cview="not_sent" onclick="dt_custom_view('not_sent','.table-supplier_invoices','not_sent'); return false;">
                                <?php echo _l('invoices_list_not_sent'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-cview="not_have_payment" onclick="dt_custom_view('not_have_payment','.table-supplier_invoices','not_have_payment'); return false;">
                                <?php echo _l('invoices_list_not_have_payment'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-cview="recurring" onclick="dt_custom_view('recurring','.table-supplier_invoices','recurring'); return false;">
                                <?php echo _l('invoices_list_recuring'); ?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <?php foreach($invoices_statuses as $status){ ?>
                            <li class="<?php if($status == $chosen_invoice_status){echo 'active';} ?>">
                                <a href="#" data-cview="invoices_<?php echo $status; ?>" onclick="dt_custom_view('invoices_<?php echo $status; ?>','.table-supplier_invoices','invoices_<?php echo $status; ?>'); return false;"><?php echo format_invoice_status($status,'',false); ?></a>
                            </li>
                        <?php } ?>
                        <?php if(count($invoices_years) > 0){ ?>
                            <li class="divider"></li>
                            <?php foreach($invoices_years as $year){ ?>
                                <li class="active">
                                    <a href="#" data-cview="year_<?php echo $year['year']; ?>" onclick="dt_custom_view(<?php echo $year['year']; ?>,'.table-supplier_invoices','year_<?php echo $year['year']; ?>'); init_supplier_invoices_total(); return false;"><?php echo $year['year']; ?>
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
                                            <a href="#" data-cview="sale_agent_<?php echo $agent['sale_agent']; ?>" onclick="dt_custom_view(<?php echo $agent['sale_agent']; ?>,'.table-supplier_invoices','sale_agent_<?php echo $agent['sale_agent']; ?>'); init_supplier_invoices_total(); return false;"><?php echo get_staff_full_name($agent['sale_agent']); ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <div class="clearfix"></div>
                        <li class="divider"></li>

                    </ul>
                </div>
                <a href="#" class="btn btn-default btn-with-tooltip toggle-small-view hidden-xs" onclick="toggle_small_view('.table-invoices','#supplier_invoice'); return false;" data-toggle="tooltip" title="<?php echo _l('invoices_toggle_table_tooltip'); ?>"><i class="fa fa-angle-double-left"></i></a>
                <?php if(has_permission('invoices','','create')){ ?>
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
            $_op = _l('options');
            if(has_permission('invoices','','delete')){
                $_op .= '<div class="checkbox hide mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="estimates"><label></label></div>';
            }
            array_push($table_data, $_op);

            render_datatable($table_data,'estimates');
            ?>
        </div>
    </div>
</div>
<div class="col-md-7">
    <div id="supplier_invoice" class="hide">
    </div>
</div>



<?php if (has_permission('invoices', '', 'create') ) { ?>
    <div class="modal fade" id="new_supplier_invoice" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open(admin_url('supplier_invoices/invoice'));
       //    echo form_open(admin_url('supplier_invoices/invoice_upload_file/'.$invoice->id)),array('id'=>'project-expense-form','class'=>'dropzone dz-clickable');?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><?php echo _l('create_new_invoice'); ?></h4>
                </div>
                <div class="modal-body">
                    <!----MODAL BODY --->

                    <div class="panel-body ">
                        <?php if(isset($invoice)){ ?>
                            <?php  echo format_invoice_status($invoice->status); ?>
                            <hr />
                        <?php } ?>
                        <?php do_action('before_render_invoice_template'); ?>
                        <?php if(isset($invoice)){
                            echo form_hidden('merge_current_invoice',$invoice->id);
                        }
                        ?>
                        <div class="row" id="merge">
<!--                            --><?php //if(isset($invoice)){
//                                $this->load->view('admin/supplier_invoices/merge_invoice',array('invoices_to_merge'=>$invoices_to_merge));
//                            }
//                            ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12 container ">
                                <p class="bold">
                                    <?php echo _l('invoice_estimate_general_options'); ?>
                                </p>
                                <hr />
                                <?php
                                $selected = (isset($invoice) ? $invoice->supplierid : '');
                                if($selected == ''){
                                    $selected = (isset($supplier_id) ? $supplier_id: '');
                                }
                                ?>
                                <?php $auto_toggle_class = (isset($invoice) || isset($do_not_auto_toggle) ? '' : 'auto-toggle'); ?>
                                <div class="f_client_id">
                                    <?php echo render_select('supplierid',$suppliers,array('supplierid','company'),'invoice_select_supplier',$selected,array(),array(),'',$auto_toggle_class); ?>
                                </div>
                                <?php
                                if(!isset($invoice_from_project)){ ?>
                                    <div class="form-group projects-wrapper<?php if(!isset($invoice) && !isset($supplier_id)){ echo ' hide';} ?>">
                                        <label for="project_id"><?php echo _l('project'); ?></label>
                                        <select name="project_id" class="selectpicker projects" data-live-search="true" data-width="100%" data-non-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                            <option value=""></option>
                                            <?php
                                            $where = array();
                                            if(isset($invoice) || isset($supplier_id)){
                                                if(!isset($supplier_id)){
                                                    $where['supplierid'] = $invoice->supplierid;
                                                } else {
                                                    $where['supplierid'] = $supplier_id;
                                                }

                                                $projects = $this->projects_model->get('', $where);
                                                foreach($projects as $project){
                                                    $selected = '';
                                                    if(isset($invoice)){
                                                        if($project['id'] == $invoice->project_id){
                                                            $selected = 'selected';
                                                        }
                                                    }
                                                    echo '<option value="'.$project['id'].'" '.$selected.'>'.$project['name'].'</option>';
                                                }
                                            }

                                            ?>
                                        </select>
                                    </div>
                                <?php } ?>

                                <?php
                                $next_invoice_number = get_option('next_invoice_number');
                                $format = get_option('invoice_number_format');
                                $prefix = get_option('invoice_prefix');
                                //
                                if ($format == 1) {
                                    // Number based
                                    $__number = $next_invoice_number;
                                    if(isset($invoice)){
                                        $__number = $invoice->number;
                                    }
                                } else {
                                    if(isset($invoice)){
                                        $__number = $invoice->number;
                                        $prefix = $prefix.$invoice->year.'/';
                                    } else {
                                        $__number = $next_invoice_number;
                                        $prefix = $prefix.get_option('invoice_year').'/';
                                    }
                                }
                                $_invoice_number = str_pad($__number,  STR_PAD_LEFT);
                                if(isset($invoice)){
                                    $isedit = 'true';
                                    $data_original_number = $invoice->number;
                                } else {
                                    $isedit = 'false';
                                    $data_original_number = 'false';
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="number"><?php echo _l('invoice_add_edit_number'); ?></label>
                                            <div class="input-group" style="width:100%">
                                                <!--                        <span class="input-group-addon">--><?php //echo $prefix; ?><!--</span>-->
                                                <input type="text" name="number" class="form-control" value="<?php echo $_invoice_number; ?>" data-isedit="<?php echo $isedit; ?>" data-original-number="<?php echo $data_original_number; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description"><?php echo _l('invoice_subject'); ?></label>
                                            <div class="input-group" style="width:100%">
                                                <input type="text" name="description" style="width:100%" class="form-control" data-isedit="<?php echo $isedit; ?> id="autocomplete_main" placeholder="<?php echo _l('invoice_subject_placeholder'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php $value = (isset($invoice) ? _d($invoice->date) : _d(date('Y-m-d'))); ?>
                                        <?php echo render_date_input('date','invoice_add_edit_date',$value); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php $value = (isset($invoice) ? _d($invoice->duedate) : _d(date('Y-m-d', strtotime('+' . get_option('invoice_due_after') . ' DAY', strtotime(date('Y-m-d')))))); ?>
                                        <?php echo render_date_input('duedate','invoice_add_edit_duedate',$value); ?>
                                    </div>
                                </div>

                                <?php $rel_id = (isset($invoice) ? $invoice->id : false); ?>
                                <?php echo render_custom_fields('invoice',$rel_id); ?>
                            </div>

                        </div>
                    </div>
                    <div class="panel-body mtop10 "style="padding-bottom:0px !important;padding-top:0px !important">
                        <div class="row" >

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="taxname"><?php echo _l('invoice_table_tax_heading'); ?></label>
                                    <div class="input-group" style="width:100%">
                                        <!--                        <input type="text" name="tva" style="width:100%" class="form-control" data-isedit="--><?php //echo $isedit; ?><!-- id="autocomplete_main" placeholder="--><?php //echo _l('invoice_subject_placeholder'); ?><!--">-->
                                        <?php
                                        $default_tax = get_option('default_tax');
                                        $default_tax_name = '';
                                        $default_tax_name = explode('+',$default_tax);
                                        $select = '<select class="selectpicker display-block tax main-tax" data-width="100%" name="taxname" multiple data-live-search="true">';
                                        $no_tax_selected = '';
                                        if($default_tax == ''){
                                            $no_tax_selected = 'selected';
                                        }
                                        $select .= '<option value="" '.$no_tax_selected.'>'._l('no_tax').'</option>';
                                        foreach($taxes as $tax){
                                            $selected = '';
                                            if(is_array($default_tax_name)){
                                                if(in_array($tax['name'] . '|'.$tax['taxrate'],$default_tax_name)){
                                                    $selected = ' selected ';
                                                }
                                            }
                                            $select .= '<option value="'.$tax['name'].'|'.$tax['taxrate'].'"'.$selected.'data-taxrate="'.$tax['taxrate'].'" data-taxname="'.$tax['name'].'" data-subtext="'.$tax['name'].'">'.$tax['taxrate'].'%</option>';
                                        }
                                        $select .= '</select>';
                                        echo $select;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="subtotal"><?php echo _l('invoice_table_amount_heading'); ?></label>
                                    <div class="input-group" style="width:100%">
                                        <!--                        <input type="text" name="ht_amount" style="width:100%" class="form-control" data-isedit="--><?php //echo $isedit; ?><!-- id="autocomplete_main" placeholder="--><?php //echo _l('invoice_subject_placeholder'); ?><!--">-->
                                        <input type="number" value="" class="form-control pull-left" name="subtotal">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="total"><?php echo _l('invoice_total'); ?></label>
                                    <div class="input-group" style="width:100%">
                                        <!--                        <input type="text" name="ttc_amount" style="width:100%" class="form-control" data-isedit="--><?php //echo $isedit; ?><!-- id="autocomplete_main" placeholder="--><?php //echo _l('invoice_subject_placeholder'); ?><!--">-->
                                        <input type="number" value="" class="form-control pull-left" name="total">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>

                    <div class="row" style="margin:0px !important">
                        <div class="col-md-12 mtop15" >
                            <div class="panel-body" style="padding: 0px">
                                <?php $value = (isset($invoice) ? clear_textarea_breaks($invoice->suppliernote) : get_option('predefined_suppliernote_invoice')); ?>
                                <?php echo render_textarea('suppliernote','add_edit_description',$value,array(),array(),'mtop15'); ?>
                                <?php echo form_open_multipart('admin/misc/upload_supplier_sales_file',array('id'=>'sales-upload','class'=>'dropzone')); ?>

                                <input type="file" name="file" multiple aria-required="true" /> </br>
                                <?php echo form_close(); ?>

                                <button type="submit" class="btn-tr btn btn-info mleft10 text-right pull-right" <?php if((isset($invoice) && $invoice->status == 2 && !is_admin()) || (isset($invoice) && $invoice->status == 5)){echo 'disabled';} ?>>
                                    <?php echo _l('submit'); ?>
                                </button>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                            </div>
                        </div>
                    </div>
                    <!--                    </div>-->







                    <!--- END MODAL BODY ---->
                </div>
                <!--                <div class="modal-footer">-->
                <!--                    <button type="button" class="btn btn-default" data-dismiss="modal">--><?php //echo _l('close'); ?><!--</button>-->
                <!--                    <button type="submit" class="btn btn-info">--><?php //echo _l('submit'); ?><!--</button>-->
                <!--                </div>-->
            </div>
            <!-- /.modal-content -->

        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>

