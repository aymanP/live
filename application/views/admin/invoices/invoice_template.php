<div class="panel_s invoice ei-template">
    <div class="panel-body">
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
            <?php if(isset($invoice)){
                $this->load->view('admin/invoices/merge_invoice',array('invoices_to_merge'=>$invoices_to_merge));
                }
                ?>
        </div>
        <div class="row">
            <div class="col-md-6 border-right">
                <p class="bold">
                    <?php echo _l('invoice_estimate_general_options'); ?>
                </p>
                <hr />
                <?php
                    $selected = (isset($invoice) ? $invoice->clientid : '');
                    if($selected == ''){
                        $selected = (isset($customer_id) ? $customer_id: '');
                    }
                    ?>
                <?php $auto_toggle_class = (isset($invoice) || isset($do_not_auto_toggle) ? '' : 'auto-toggle'); ?>
                <div class="f_client_id">
                    <?php echo render_select('clientid',$clients,array('userid','company'),'invoice_select_customer',$selected,array(),array(),'',$auto_toggle_class); ?>
                </div>
                 <?php
                        if(!isset($invoice_from_project)){ ?>
                    <div class="form-group projects-wrapper<?php if(!isset($invoice) && !isset($customer_id)){ echo ' hide';} ?>">
                        <label for="project_id"><?php echo _l('project'); ?></label>
                        <select name="project_id" class="selectpicker projects" data-live-search="true" data-width="100%" data-non-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                            <option value=""></option>
                            <?php
                                $where = array();
                                if(isset($invoice) || isset($customer_id)){
                                  if(!isset($customer_id)){
                                    $where['clientid'] = $invoice->clientid;
                                } else {
                                    $where['clientid'] = $customer_id;
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
                <div class="row">
                    <div class="col-md-12">
                        <a href="#" class="edit_shipping_billing_info" data-toggle="modal" data-target="#billing_and_shipping_details"><i class="fa fa-pencil-square-o"></i></a>
                        <?php include_once(APPPATH .'views/admin/invoices/billing_and_shipping_template.php'); ?>
                    </div>
                    <div class="col-md-6">
                        <p class="bold"><?php echo _l('invoice_bill_to'); ?></p>
                        <address>
                            <span class="billing_street">
                            <?php $billing_street = (isset($invoice) ? $invoice->billing_street : '--'); ?>
                            <?php $billing_street = ($billing_street == '' ? '--' :$billing_street); ?>
                            <?php echo $billing_street; ?></span><br>
                            <span class="billing_city">
                            <?php $billing_city = (isset($invoice) ? $invoice->billing_city : '--'); ?>
                            <?php $billing_city = ($billing_city == '' ? '--' :$billing_city); ?>
                            <?php echo $billing_city; ?></span>,
                            <span class="billing_state">
                            <?php $billing_state = (isset($invoice) ? $invoice->billing_state : '--'); ?>
                            <?php $billing_state = ($billing_state == '' ? '--' :$billing_state); ?>
                            <?php echo $billing_state; ?></span>
                            <br/>
                            <span class="billing_country">
                            <?php $billing_country = (isset($invoice) ? get_country_short_name($invoice->billing_country) : '--'); ?>
                            <?php $billing_country = ($billing_country == '' ? '--' :$billing_country); ?>
                            <?php echo $billing_country; ?></span>,
                            <span class="billing_zip">
                            <?php $billing_zip = (isset($invoice) ? $invoice->billing_zip : '--'); ?>
                            <?php $billing_zip = ($billing_zip == '' ? '--' :$billing_zip); ?>
                            <?php echo $billing_zip; ?></span>
                        </address>
                    </div>
                    <div class="col-md-6">
                        <p class="bold"><?php echo _l('ship_to'); ?></p>
                        <address>
                            <span class="shipping_street">
                            <?php $shipping_street = (isset($invoice) ? $invoice->shipping_street : '--'); ?>
                            <?php $shipping_street = ($shipping_street == '' ? '--' :$shipping_street); ?>
                            <?php echo $shipping_street; ?></span><br>
                            <span class="shipping_city">
                            <?php $shipping_city = (isset($invoice) ? $invoice->shipping_city : '--'); ?>
                            <?php $shipping_city = ($shipping_city == '' ? '--' :$shipping_city); ?>
                            <?php echo $shipping_city; ?></span>,
                            <span class="shipping_state">
                            <?php $shipping_state = (isset($invoice) ? $invoice->shipping_state : '--'); ?>
                            <?php $shipping_state = ($shipping_state == '' ? '--' :$shipping_state); ?>
                            <?php echo $shipping_state; ?></span>
                            <br/>
                            <span class="shipping_country">
                            <?php $shipping_country = (isset($invoice) ? get_country_short_name($invoice->shipping_country) : '--'); ?>
                            <?php $shipping_country = ($shipping_country == '' ? '--' :$shipping_country); ?>
                            <?php echo $shipping_country; ?></span>,
                            <span class="shipping_zip">
                            <?php $shipping_zip = (isset($invoice) ? $invoice->shipping_zip : '--'); ?>
                            <?php $shipping_zip = ($shipping_zip == '' ? '--' :$shipping_zip); ?>
                            <?php echo $shipping_zip; ?></span>
                        </address>
                    </div>
                </div>
                <?php
                    $next_invoice_number = get_option('next_invoice_number');
                    $format = get_option('invoice_number_format');
                    $prefix = get_option('invoice_prefix');
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
                    $_invoice_number = str_pad($__number, get_option('number_padding_invoice_and_estimate'), '0', STR_PAD_LEFT);
                    if(isset($invoice)){
                      $isedit = 'true';
                      $data_original_number = $invoice->number;
                    } else {
                      $isedit = 'false';
                      $data_original_number = 'false';
                    }
                    ?>
                <div class="form-group">
                    <label for="number"><?php echo _l('invoice_add_edit_number'); ?></label>
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo $prefix; ?></span>
                        <input type="text" name="number" class="form-control" value="<?php echo $_invoice_number; ?>" data-isedit="<?php echo $isedit; ?>" data-original-number="<?php echo $data_original_number; ?>">
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
            <div class="col-md-6">
                <div class="panel_s">
                    <p class="bold"><?php echo _l('invoice_add_edit_advanced_options'); ?></p>
                    <hr />

                    <div class="form-group mbot25">
                        <label for="allowed_payment_modes" class="control-label"><?php echo _l('invoice_add_edit_allowed_payment_modes'); ?></label>
                        <br />
                        <?php if(count($payment_modes) > 0){ ?>
                        <?php foreach($payment_modes as $mode){
                            $checked = '';
                            if(isset($invoice)){
                              if($invoice->allowed_payment_modes){
                                foreach(unserialize($invoice->allowed_payment_modes) as $_allowed_payment_mode){
                                  if($_allowed_payment_mode == $mode['id']){
                                    $checked = 'checked';
                                  }
                                }
                              }
                            } else {
                              $checked = 'checked';
                            }
                            ?>
                        <div class="checkbox checkbox-primary checkbox-inline">
                            <input type="checkbox" value="<?php echo $mode['id']; ?>" id="pm_<?php echo $mode['id']; ?>" name="allowed_payment_modes[]" <?php echo $checked; ?>>
                            <label for="pm_<?php echo $mode['id']; ?>"><?php echo $mode['name']; ?></label>
                        </div>
                        <?php } ?>
                        <?php } else { ?>
                        <p><?php echo _l('invoice_add_edit_no_payment_modes_found'); ?></p>
                        <a class="btn btn-info" href="<?php echo admin_url('paymentmodes'); ?>">
                        <?php echo _l('new_payment_mode'); ?>
                        </a>
                        <?php } ?>
                    </div>
                      <div class="row">
                        <div class="col-md-6">
                               <?php
                        $s_attrs = array('disabled'=>true);
                        foreach($currencies as $currency){
                            if($currency['isdefault'] == 1){
                                $s_attrs['data-base'] = $currency['id'];
                            }
                         if(isset($invoice)){
                           if($currency['id'] == $invoice->currency){
                              $selected = $currency['id'];
                           }
                         } else {
                          if($currency['isdefault'] == 1){
                              $selected = $currency['id'];
                          }
                         }
                        }
                        ?>
                    <?php echo render_select('currency',$currencies,array('id','symbol','name'),'invoice_add_edit_currency',$selected,$s_attrs); ?>

                        </div>
                        <div class="col-md-6">
                          <?php
                        $i = 0;
                        $selected = '';
                        foreach($staff as $member){
                         if(isset($invoice)){
                           if($invoice->sale_agent == $member['staffid']) {
                             $selected = $member['staffid'];
                           }
                         }
                         $i++;
                        }
                        echo render_select('sale_agent',$staff,array('staffid',array('firstname','lastname')),'sale_agent_string',$selected);
                        ?>
                        </div>
                        <div class="col-md-6">

                    <div class="form-group">
                        <label for="recurring" class="control-label">
                        <?php echo _l('invoice_add_edit_recurring'); ?>
                        </label>
                        <select class="selectpicker" data-width="100%" name="recurring" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                            <?php for($i = 0; $i <=12; $i++){ ?>
                            <?php
                                $selected = '';
                                if(isset($invoice)){
                                 if($invoice->recurring == $i){
                                   $selected = 'selected';
                                 }
                                }
                                if($i == 0){
                                 $reccuring_string =  _l('invoice_add_edit_recurring_no');
                                } else if($i == 1){
                                 $reccuring_string = _l('invoice_add_edit_recurring_month',$i);
                                } else {
                                 $reccuring_string = _l('invoice_add_edit_recurring_months',$i);
                                }
                                ?>
                            <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $reccuring_string; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                        <label for="discount_type" class="control-label"><?php echo _l('discount_type'); ?></label>
                        <select name="discount_type" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                            <option value=""><?php echo _l('no_discount'); ?></option>
                            <option value="before_tax" <?php
                                if(isset($invoice)){ if($invoice->discount_type == 'before_tax' || $invoice->discount_type == ''){ echo 'selected'; }} else{ echo 'selected';} ?>><?php echo _l('discount_type_before_tax'); ?></option>
                            <option value="after_tax" <?php if(isset($invoice)){if($invoice->discount_type == 'after_tax'){echo 'selected';}} ?>><?php echo _l('discount_type_after_tax'); ?></option>
                        </select>
                    </div>
                        </div>
                    <div id="recurring_ends_on" class="<?php if(!isset($invoice) || (isset($invoice) && $invoice->recurring == 0)){echo 'hide';}?>">
                    <div class="col-md-12">
                      <?php $value = (isset($invoice) ? _d($invoice->recurring_ends_on) : ''); ?>
                      <?php echo render_date_input('recurring_ends_on','recurring_ends_on',$value); ?>
                    </div>
                    </div>
                    </div>
                      <?php $value = (isset($invoice) ? $invoice->adminnote : ''); ?>
                <?php echo render_textarea('adminnote','invoice_add_edit_admin_note',$value); ?>


                    <?php
                        // Check if any recuring invoices are made from this invoice
                        if(isset($invoice) && ($invoice->recurring !== 0 && $invoice->last_recurring_date != NULL)){ ?>
                    <?php if(count($invoice_recurring_invoices)){ ?>
                    <p class="text-muted"><?php echo _l('invoice_add_edit_recuring_invoices_from_invoice'); ?></p>
                    <?php foreach($invoice_recurring_invoices as $recurring){ ?>
                    <ul class="list-unstyled">
                        <li>
                            <a href="<?php echo admin_url('invoices/list_invoices/'.$recurring->id); ?>" target="_blank"><?php echo format_invoice_number($recurring->id); ?></a>
                        </li>
                    </ul>
                    <?php } ?>
                    <?php } ?>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
    <div class="panel-body mtop10">
        <div class="row">
            <div class="col-md-3">
                <?php echo render_select('item_select',$items,array('itemid',array('description')),'','',array('data-none-selected-text'=>_l('add_item')),array(),'no-margin'); ?>
            </div>
            <div class="col-md-3">
                <div class="form-group" data-toggle="tooltip" data-title="<?php echo _l('invoice_task_item_project_tasks_not_included'); ?>">
                    <select name="task_select" data-live-search="true" id="task_select" class="selectpicker no-margin" data-width="100%" data-none-selected-text="<?php echo _l('bill_tasks'); ?>">
                        <option value=""></option>
                        <?php foreach($billable_tasks as $task_billable){ ?>
                        <option  value="<?php echo $task_billable['id']; ?>"<?php if($this->tasks_model->is_timer_started_for_task($task_billable['id'])){ ?>disabled class="text-danger important" data-subtext="<?php echo _l('invoice_task_billable_timers_found'); ?>" <?php } else {
                            $task_rel_data = get_relation_data($task_billable['rel_type'],$task_billable['rel_id']);
                            $task_rel_value = get_relation_values($task_rel_data,$task_billable['rel_type']);
                            ?>
                            data-subtext="<?php echo $task_rel_value['name']; ?>" <?php } ?>><?php echo $task_billable['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6 text-right">
                <div class="mtop10">
                    <span><?php echo _l('show_quantity_as'); ?></span>
                    <div class="radio radio-primary radio-inline">
                        <input type="radio" value="1" id="1" name="show_quantity_as" data-text="<?php echo _l('invoice_table_quantity_heading'); ?>" <?php if(isset($invoice) && $invoice->show_quantity_as == 1){echo 'checked';}else if(!isset($hours_quantity) && !isset($qty_hrs_quantity)){echo'checked';} ?>>
                        <label for="1"><?php echo _l('quantity_as_qty'); ?></label>
                    </div>
                    <div class="radio radio-primary radio-inline">
                        <input type="radio" value="2" id="2" name="show_quantity_as" data-text="<?php echo _l('invoice_table_hours_heading'); ?>" <?php if(isset($invoice) && $invoice->show_quantity_as == 2 || isset($hours_quantity)){echo 'checked';} ?>>
                        <label for="2"><?php echo _l('quantity_as_hours'); ?></label>
                    </div>
                    <div class="radio radio-primary radio-inline">
                        <input type="radio" value="3" id="3" name="show_quantity_as" data-text="<?php echo _l('invoice_table_quantity_heading'); ?>/<?php echo _l('invoice_table_hours_heading'); ?>" <?php if(isset($invoice) && $invoice->show_quantity_as == 3 || isset($qty_hrs_quantity)){echo 'checked';} ?>>
                        <label for="3"><?php echo _l('invoice_table_quantity_heading'); ?>/<?php echo _l('invoice_table_hours_heading'); ?></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive s_table">
            <table class="table invoice-items-table items table-main-invoice-edit">
                <thead>
                    <tr>
                        <th></th>
                        <th width="20%" class="text-left"><?php echo _l('invoice_table_item_heading'); ?></th>
                        <th width="25%" class="text-left"><?php echo _l('invoice_table_item_description'); ?></th>
                        <?php
                            $qty_heading = _l('invoice_table_quantity_heading');
                            if(isset($invoice) && $invoice->show_quantity_as == 2 || isset($hours_quantity)){
                             $qty_heading = _l('invoice_table_hours_heading');
                            }
                            ?>
                        <th width="10%" class="text-left qty"><?php echo $qty_heading; ?></th>
                        <th width="15%" class="text-left"><?php echo _l('invoice_table_rate_heading'); ?></th>
                        <th width="20%" class="text-left"><?php echo _l('invoice_table_tax_heading'); ?></th>
                        <th width="10%" class="text-left"><?php echo _l('invoice_table_amount_heading'); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="main">
                        <td></td>
                        <td>
                            <input type="text" name="description" id="autocomplete_main" class="form-control" placeholder="<?php echo _l('item_description_placeholder'); ?>">
                        </td>
                        <td>
                            <input type="text" name="long_description" class="form-control" placeholder="<?php echo _l('item_long_description_placeholder'); ?>">
                        </td>
                        <td>
                            <input type="number" name="quantity" min="0" value="1" class="form-control" placeholder="<?php echo _l('item_quantity_placeholder'); ?>">
                        </td>
                        <td>
                            <input type="number" name="rate" class="form-control" placeholder="<?php echo _l('item_rate_placeholder'); ?>">
                        </td>
                        <td>
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
                        </td>
                        <td></td>
                        <td>
                            <?php
                                $new_item = 'undefined';
                                if(isset($invoice)){
                                 $new_item = true;
                                }
                                ?>
                            <button type="button" onclick="add_item_to_table('undefined','undefined',<?php echo $new_item; ?>); return false;" class="btn pull-right btn-info"><i class="fa fa-check"></i></button>
                        </td>
                    </tr>
                    <?php if (isset($invoice) || isset($add_items)) {
                        $i               = 1;
                        $items_indicator = 'newitems';
                        if (isset($invoice)) {
                            $add_items       = $invoice->items;
                            $items_indicator = 'items';
                        }
                        foreach ($add_items as $item) {
                            $manual    = false;
                            $table_row = '<tr class="sortable item">';
                            $table_row .= '<td class="dragger">';
                            if (!is_numeric($item['qty'])) {
                                $item['qty'] = 1;
                            }
                            $invoice_item_taxes = get_invoice_item_taxes($item['id']);
                            // passed like string
                            if ($item['id'] == 0) {
                                $invoice_item_taxes = $item['taxname'];
                                $manual             = true;
                            }
                            $table_row .= form_hidden('' . $items_indicator . '[' . $i . '][itemid]', $item['id']);
                            $amount = $item['rate'] * $item['qty'];
                            $amount = _format_number($amount);
                            // order input
                            $table_row .= '<input type="hidden" class="order" name="' . $items_indicator . '[' . $i . '][order]">';
                            $table_row .= '</td>';
                            $table_row .= '<td class="bold description"><input type="text" name="' . $items_indicator . '[' . $i . '][description]" class="form-control input-transparent" value="' . $item['description'] . '"></td>';
                            $table_row .= '<td><textarea name="' . $items_indicator . '[' . $i . '][long_description]" class="form-control input-transparent">' . clear_textarea_breaks($item['long_description']) . '</textarea></td>';
                            $table_row .= '<td><input type="number" min="0" onblur="calculate_total();" onchange="calculate_total();" data-quantity name="' . $items_indicator . '[' . $i . '][qty]" value="' . $item['qty'] . '" class="form-control input-transparent"></td>';
                            $table_row .= '<td class="rate"><input type="text" data-toggle="tooltip" title="' . _l('numbers_not_formated_while_editing') . '" onblur="calculate_total();" onchange="calculate_total();" name="' . $items_indicator . '[' . $i . '][rate]" value="' . $item['rate'] . '" class="form-control input-transparent"></td>';
                            $table_row .= '<td class="taxrate">' . $this->misc_model->get_taxes_dropdown_template('' . $items_indicator . '[' . $i . '][taxname][]', $invoice_item_taxes, 'invoice', $item['id'], true, $manual) . '</td>';
                            $table_row .= '<td class="amount">' . $amount . '</td>';
                            $table_row .= '<td><a href="#" class="btn btn-danger pull-left" onclick="delete_item(this,' . $item['id'] . '); return false;"><i class="fa fa-times"></i></a></td>';
                            $table_row .= '</tr>';
                            if (isset($item['task_id'])) {
                                if (!is_array($item['task_id'])) {
                                    $table_row .= form_hidden('billed_tasks['.$i.'][]', $item['task_id']);
                                } else {
                                    foreach ($item['task_id'] as $task_id) {
                                        $table_row .= form_hidden('billed_tasks['.$i.'][]', $task_id);
                                    }
                                }
                            } else if (isset($item['expense_id'])) {
                                $table_row .= form_hidden('billed_expenses['.$i.'][]', $item['expense_id']);
                            }
                            echo $table_row;
                            $i++;
                        }
                        }
                        ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-8 col-md-offset-4">
            <table class="table text-right">
                <tbody>
                    <tr id="subtotal">
                        <td><span class="bold"><?php echo _l('invoice_subtotal'); ?> :</span>
                        </td>
                        <td class="subtotal">
                        </td>
                    </tr>
                    <tr id="discount_percent">
                        <td>
                            <div class="row">
                                <div class="col-md-5">
                                    <span class="bold"><?php echo _l('invoice_discount'); ?> (%)</span>
                                </div>
                                <div class="col-md-7">
                                    <?php
                                        $discount_percent = 0;
                                        if(isset($invoice)){
                                         if($invoice->discount_percent != 0){
                                           $discount_percent =  $invoice->discount_percent;
                                         }
                                        }
                                        ?>
                                    <input type="number" value="<?php echo $discount_percent; ?>" class="form-control pull-left" min="0" max="100" name="discount_percent">
                                </div>
                            </div>
                        </td>
                        <td class="discount_percent"></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-5">
                                    <span class="bold"><?php echo _l('invoice_adjustment'); ?></span>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" value="<?php if(isset($invoice)){echo _format_number($invoice->adjustment); } else { echo _format_number(0); } ?>" class="form-control pull-left" name="adjustment">
                                </div>
                            </div>
                        </td>
                        <td class="adjustment"></td>
                    </tr>
                    <tr>
                        <td><span class="bold"><?php echo _l('invoice_total'); ?> :</span>
                        </td>
                        <td class="total">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="removed-items"></div>
        <div id="billed-tasks"></div>
        <?php echo form_hidden('task_id'); ?>
        <?php echo form_hidden('expense_id'); ?>
    </div>
    <div class="row">
        <div class="col-md-12 mtop15">
            <div class="panel-body">
                <?php $value = (isset($invoice) ? clear_textarea_breaks($invoice->clientnote) : get_option('predefined_clientnote_invoice')); ?>
                <?php echo render_textarea('clientnote','invoice_add_edit_client_note',$value,array(),array(),'mtop15'); ?>
                <?php $value = (isset($invoice) ? clear_textarea_breaks($invoice->terms) : get_option('predefined_terms_invoice')); ?>
                <?php echo render_textarea('terms','terms_and_conditions',$value,array(),array(),'mtop15'); ?>
                <button type="submit" class="btn-tr btn btn-info mleft10 text-right pull-right" <?php if((isset($invoice) && $invoice->status == 2 && !is_admin()) || (isset($invoice) && $invoice->status == 5)){echo 'disabled';} ?>>
                <?php echo _l('submit'); ?>
                </button>
            </div>
        </div>
    </div>
</div>
