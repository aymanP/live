<div class="panel_s invoice ei-template col-md-6">
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
        <?php echo form_open(admin_url('supplier_invoices/invoice/'.$invoice->id)); ?>
<!--        <div class="row" id="merge">-->
<!--            --><?php //if(isset($invoice)){
//                $this->load->view('admin/supplier_invoices/merge_invoice',array('invoices_to_merge'=>$invoices_to_merge));
//                }
//                ?>
<!--        </div>-->
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
                                <input type="text" name="number" class="form-control" value="<?php echo $data_original_number; ?>" data-isedit="<?php echo $isedit; ?>" data-original-number="<?php echo $data_original_number; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="subject"><?php echo _l('invoice_subject'); ?></label>
                            <div class="input-group" style="width:100%">
                                <input type="text" name="subject" style="width:100%" class="form-control" data-isedit="<?php echo $isedit; ?> id="autocomplete_main" placeholder="<?php echo _l('invoice_subject_placeholder'); ?>">
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
    <div class="panel-body mtop10">
        <div class="row">

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
                    <label for="ht_amount"><?php echo _l('invoice_table_amount_heading'); ?></label>
                    <div class="input-group" style="width:100%">
                        <input type="text" name="subtotal" value="<?php echo $invoice->subtotal; ?>" class="form-control" data-isedit="<?php echo $isedit; ?> id="autocomplete_main" placeholder="<?php echo _l('invoice_subject_placeholder'); ?>">
<!--                        <input type="number" value="" class="form-control pull-left" name="ht_amount">-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="ttc_amount"><?php echo _l('invoice_total'); ?></label>
                    <div class="input-group" style="width:100%">
                        <input type="text" name="total" value="<?php echo $invoice->total ?>" class="form-control" data-isedit="<?php echo $isedit; ?> id="autocomplete_main" placeholder="<?php echo _l('invoice_subject_placeholder'); ?>">
<!--                        <input type="number" value="" class="form-control pull-left" name="ttc_amount">-->

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mtop15">
            <div class="panel-body">
                <?php $value = (isset($invoice) ? clear_textarea_breaks($invoice->suppliernote) : get_option('predefined_suppliernote_invoice')); ?>
                <?php echo render_textarea('invoicedescription','add_edit_description',$value,array(),array(),'mtop15'); ?>
                <button type="submit" class="btn-tr btn btn-info mleft10 text-right pull-right" <?php if((isset($invoice) && $invoice->status == 2 && !is_admin()) || (isset($invoice) && $invoice->status == 5)){echo 'disabled';} ?>>
                <?php echo _l('submit'); ?>
                </button>
<?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>

<!-- MODAAAAL -->
