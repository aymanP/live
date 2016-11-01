<div class="panel_s ei-template">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6 border-right">
                <p class="bold">
                    <?php echo _l('invoice_estimate_general_options'); ?>
                </p>
                <hr />
                <?php $selected = (isset($estimate) ? $estimate->clientid : '');
                if($selected == ''){
                    $selected = (isset($customer_id) ? $customer_id: '');
                }
                ?>
                <div class="f_client_id">
                    <?php $auto_toggle_class = (isset($estimate) || isset($do_not_auto_toggle)  ? '' : 'auto-toggle'); ?>
                    <?php echo render_select('clientid',$clients,array('userid','company'),'estimate_select_customer',$selected,array(),array(),'',$auto_toggle_class); ?>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="#" class="edit_shipping_billing_info" data-toggle="modal" data-target="#billing_and_shipping_details"><i class="fa fa-pencil-square-o"></i></a>
                        <?php include_once(APPPATH .'views/admin/estimates/billing_and_shipping_template.php'); ?>
                    </div>
                    <div class="col-md-6">
                        <p class="bold"><?php echo _l('invoice_bill_to'); ?></p>
                        <address>
                            <span class="billing_street">
                            <?php $billing_street = (isset($estimate) ? $estimate->billing_street : '--'); ?>
                            <?php $billing_street = ($billing_street == '' ? '--' :$billing_street); ?>
                            <?php echo $billing_street; ?></span><br>
                            <span class="billing_city">
                            <?php $billing_city = (isset($estimate) ? $estimate->billing_city : '--'); ?>
                            <?php $billing_city = ($billing_city == '' ? '--' :$billing_city); ?>
                            <?php echo $billing_city; ?></span>,
                            <span class="billing_state">
                            <?php $billing_state = (isset($estimate) ? $estimate->billing_state : '--'); ?>
                            <?php $billing_state = ($billing_state == '' ? '--' :$billing_state); ?>
                            <?php echo $billing_state; ?></span>
                            <br/>
                            <span class="billing_country">
                            <?php $billing_country = (isset($estimate) ? get_country_short_name($estimate->billing_country) : '--'); ?>
                            <?php $billing_country = ($billing_country == '' ? '--' :$billing_country); ?>
                            <?php echo $billing_country; ?></span>,
                            <span class="billing_zip">
                            <?php $billing_zip = (isset($estimate) ? $estimate->billing_zip : '--'); ?>
                            <?php $billing_zip = ($billing_zip == '' ? '--' :$billing_zip); ?>
                            <?php echo $billing_zip; ?></span>
                        </address>
                    </div>
                    <div class="col-md-6">
                        <p class="bold"><?php echo _l('ship_to'); ?></p>
                        <address>
                            <span class="shipping_street">
                            <?php $shipping_street = (isset($estimate) ? $estimate->shipping_street : '--'); ?>
                            <?php $shipping_street = ($shipping_street == '' ? '--' :$shipping_street); ?>
                            <?php echo $shipping_street; ?></span><br>
                            <span class="shipping_city">
                            <?php $shipping_city = (isset($estimate) ? $estimate->shipping_city : '--'); ?>
                            <?php $shipping_city = ($shipping_city == '' ? '--' :$shipping_city); ?>
                            <?php echo $shipping_city; ?></span>,
                            <span class="shipping_state">
                            <?php $shipping_state = (isset($estimate) ? $estimate->shipping_state : '--'); ?>
                            <?php $shipping_state = ($shipping_state == '' ? '--' :$shipping_state); ?>
                            <?php echo $shipping_state; ?></span>
                            <br/>
                            <span class="shipping_country">
                            <?php $shipping_country = (isset($estimate) ? get_country_short_name($estimate->shipping_country) : '--'); ?>
                            <?php $shipping_country = ($shipping_country == '' ? '--' :$shipping_country); ?>
                            <?php echo $shipping_country; ?></span>,
                            <span class="shipping_zip">
                            <?php $shipping_zip = (isset($estimate) ? $estimate->shipping_zip : '--'); ?>
                            <?php $shipping_zip = ($shipping_zip == '' ? '--' :$shipping_zip); ?>
                            <?php echo $shipping_zip; ?></span>
                        </address>
                    </div>
                </div>
                <?php
                    $next_estimate_number = get_option('next_estimate_number');
                    $format = get_option('estimate_number_format');
                    $prefix = get_option('estimate_prefix');
                    if ($format == 1) {
                      // Number based
                      $__number = $next_estimate_number;
                      if(isset($estimate)){
                        $__number = $estimate->number;
                    }
                    } else {
                      if(isset($estimate)){
                        $__number = $estimate->number;
                        $prefix = $prefix.$estimate->year.'/';
                      } else {
                        $__number = $next_estimate_number;
                        $prefix = $prefix.get_option('estimate_year').'/';
                      }
                    }

                    $_estimate_number = str_pad($__number, get_option('number_padding_invoice_and_estimate'), '0', STR_PAD_LEFT);
                    if(isset($estimate)){
                      $isedit = 'true';
                      $data_original_number = $estimate->number;
                    } else {
                      $isedit = 'false';
                      $data_original_number = 'false';
                    }
                    ?>
                    <div class="form-group">
                    <label for="number"><?php echo _l('estimate_add_edit_number'); ?></label>
                        <div class="input-group">
                            <span class="input-group-addon"><?php echo $prefix; ?></span>
                            <input type="text" name="number" class="form-control" value="<?php echo $_estimate_number; ?>" data-isedit="<?php echo $isedit; ?>" data-original-number="<?php echo $data_original_number; ?>">
                        </div>
                    </div>
                <?php $value = (isset($estimate) ? $estimate->reference_no : ''); ?>
                <?php echo render_input('reference_no','reference_no',$value); ?>
                <div class="row">
                    <div class="col-md-6">
                        <?php $value = (isset($estimate) ? _d($estimate->date) : _d(date('Y-m-d'))); ?>
                        <?php echo render_date_input('date','estimate_add_edit_date',$value); ?>
                    </div>
                    <div class="col-md-6">
                        <?php $value = (isset($estimate) ? _d($estimate->expirydate) : ''); ?>
                        <?php echo render_date_input('expirydate','estimate_add_edit_expirydate',$value); ?>
                    </div>
                </div>

                <div class="clearfix mbot15"></div>
                <?php $rel_id = (isset($estimate) ? $estimate->id : false); ?>
                <?php echo render_custom_fields('estimate',$rel_id); ?>
            </div>
            <div class="col-md-6">
                <div class="panel_s">
                    <p class="bold"><?php echo _l('estimate_add_edit_advanced_options'); ?></p>
                    <hr />
                    <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                    <label class="control-label"><?php echo _l('estimate_status'); ?></label>
                    <select class="selectpicker display-block mbot15" name="status" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                    <?php foreach($estimate_statuses as $status){ ?>
                           <option value="<?php echo $status; ?>" <?php if(isset($estimate) && $estimate->status == $status){echo 'selected';} ?>><?php echo format_estimate_status($status,'',false); ?></option>
                        <?php } ?>
                    </select>
                </div>
                    </div>
                    <div class="col-md-6">
                          <?php
                    $s_attrs = array('disabled'=>true);
                    foreach($currencies as $currency){
                        if($currency['isdefault'] == 1){
                            $s_attrs['data-base'] = $currency['id'];
                        }
                        if(isset($estimate)){
                            if($currency['id'] == $estimate->currency){
                                $selected = $currency['id'];
                            }
                        } else{
                           if($currency['isdefault'] == 1){
                              $selected = $currency['id'];
                           }
                     }
                    }
                    ?>
                <?php echo render_select('currency',$currencies,array('id','symbol','name'),'estimate_add_edit_currency',$selected,$s_attrs); ?>
                    </div>
                    <div class="col-md-6">
                       <?php
                        $i = 0;
                        $selected = '';
                        foreach($staff as $member){
                            if(isset($estimate)){
                                if($estimate->sale_agent == $member['staffid']) {
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
                        <label for="discount_type" class="control-label"><?php echo _l('discount_type'); ?></label>
                        <select name="discount_type" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                            <option value=""><?php echo _l('no_discount'); ?></option>
                            <option value="before_tax" <?php
                                if(isset($estimate)){ if($estimate->discount_type == 'before_tax' || $estimate->discount_type == ''){ echo 'selected'; }} else{ echo 'selected';} ?>><?php echo _l('discount_type_before_tax'); ?></option>
                            <option value="after_tax" <?php if(isset($estimate)){if($estimate->discount_type == 'after_tax'){echo 'selected';}} ?>><?php echo _l('discount_type_after_tax'); ?></option>
                        </select>
                    </div>

                    </div>
                    </div>


                    <?php $value = (isset($estimate) ? $estimate->adminnote : ''); ?>
                    <?php echo render_textarea('adminnote','estimate_add_edit_admin_note',$value,array(),array(),'mtop15'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body mtop10">
        <div class="row">
            <div class="col-md-3">
                <?php echo render_select('item_select',$items,array('itemid',array('description')),'','',array('data-none-selected-text'=>_l('add_item')),array(),'no-margin'); ?>
            </div>
            <div class="col-md-9 text-right">
                <div class="mtop10">
                    <span><?php echo _l('show_quantity_as'); ?></span>
                    <div class="radio radio-primary radio-inline">
                        <input type="radio" value="1" id="1" name="show_quantity_as" data-text="<?php echo _l('estimate_table_quantity_heading'); ?>" <?php if(isset($estimate) && $estimate->show_quantity_as == 1){echo 'checked';}else{echo'checked';} ?>>
                        <label for="1"><?php echo _l('quantity_as_qty'); ?></label>
                    </div>
                    <div class="radio radio-primary radio-inline">
                        <input type="radio" value="2" id="2" name="show_quantity_as" data-text="<?php echo _l('estimate_table_hours_heading'); ?>" <?php if(isset($estimate) && $estimate->show_quantity_as == 2){echo 'checked';} ?>>
                        <label for="2"><?php echo _l('quantity_as_hours'); ?></label>
                    </div>
                    <div class="radio radio-primary radio-inline">
                        <input type="radio" id="3" value="3" name="show_quantity_as" data-text="<?php echo _l('estimate_table_quantity_heading'); ?>/<?php echo _l('estimate_table_hours_heading'); ?>" <?php if(isset($estimate) && $estimate->show_quantity_as == 3){echo 'checked';} ?>>
                        <label for="3"><?php echo _l('estimate_table_quantity_heading'); ?>/<?php echo _l('estimate_table_hours_heading'); ?></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive s_table">
            <table class="table estimate-items-table items table-main-estimate-edit">
                <thead>
                    <tr>
                        <th></th>
                        <th width="20%" class="text-left"><?php echo _l('estimate_table_item_heading'); ?></th>
                        <th width="25%" class="text-left"><?php echo _l('estimate_table_item_description'); ?></th>
                        <th width="10%" class="text-left qty"><?php echo _l('estimate_table_quantity_heading'); ?></th>
                        <th width="15%" class="text-left"><?php echo _l('estimate_table_rate_heading'); ?></th>
                        <th width="20%" class="text-left"><?php echo _l('estimate_table_tax_heading'); ?></th>
                        <th width="10%" class="text-left"><?php echo _l('estimate_table_amount_heading'); ?></th>
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
                                $select = '<select class="selectpicker display-block tax main-tax" data-width="100%" name="taxname" multiple data-none-selected-text="'._l('dropdown_non_selected_tex').'" data-live-search="true">';
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
                                if(isset($estimate)){
                                    $new_item = true;
                                }
                                ?>
                            <button type="button" onclick="add_item_to_table('undefined','undefined',<?php echo $new_item; ?>); return false;" class="btn pull-right btn-info"><i class="fa fa-check"></i></button>
                        </td>
                    </tr>
                    <?php if (isset($estimate) || isset($add_items)) {
                                $i               = 1;
                                $items_indicator = 'newitems';
                                if (isset($estimate)) {
                                    $add_items       = $estimate->items;
                                    $items_indicator = 'items';
                                }

                                foreach ($add_items as $item) {
                                    $manual    = false;
                                    $table_row = '<tr class="sortable item">';
                                    $table_row .= '<td class="dragger">';
                                    if ($item['qty'] == '' || $item['qty'] == 0) {
                                        $item['qty'] = 1;
                                    }
                                    $estimate_item_taxes = get_estimate_item_taxes($item['id']);
                                    if ($item['id'] == 0) {
                                        $estimate_item_taxes = $item['taxname'];
                                        $manual              = true;
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
                                    $table_row .= '<td class="taxrate">' . $this->misc_model->get_taxes_dropdown_template('' . $items_indicator . '[' . $i . '][taxname][]', $estimate_item_taxes, 'estimate', $item['id'], true, $manual) . '</td>';
                                    $table_row .= '<td class="amount">' . $amount . '</td>';
                                    $table_row .= '<td><a href="#" class="btn btn-danger pull-left" onclick="delete_item(this,' . $item['id'] . '); return false;"><i class="fa fa-times"></i></a></td>';
                                    $table_row .= '</tr>';
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
                        <td><span class="bold"><?php echo _l('estimate_subtotal'); ?> :</span>
                        </td>
                        <td class="subtotal">
                        </td>
                    </tr>
                    <tr id="discount_percent">
                        <td>
                            <div class="row">
                                <div class="col-md-5">
                                    <span class="bold"><?php echo _l('estimate_discount'); ?> (%)</span>
                                </div>
                                <div class="col-md-7">
                                    <?php
                                        $discount_percent = 0;
                                        if(isset($estimate)){
                                            if($estimate->discount_percent != 0){
                                                $discount_percent =  $estimate->discount_percent;
                                            }
                                        }
                                        ?>
                                    <input type="number" value="<?php echo $discount_percent; ?>" class="form-control pull-left" min="0" max="100" name="discount_percent">
                                </div>
                            </div>
                        </td>
                        <td class="discount_percent">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-5">
                                    <span class="bold"><?php echo _l('estimate_adjustment'); ?></span>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" value="<?php if(isset($estimate)){echo _format_number($estimate->adjustment); } else { echo _format_number(0); } ?>" class="form-control pull-left" name="adjustment">
                                </div>
                            </div>
                        </td>
                        <td class="adjustment">
                        </td>
                    </tr>
                    <tr>
                        <td><span class="bold"><?php echo _l('estimate_total'); ?> :</span>
                        </td>
                        <td class="total">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="removed-items"></div>
    </div>
    <div class="row">
        <div class="col-md-12 mtop15">
            <div class="panel-body">
                <?php $value = (isset($estimate) ? clear_textarea_breaks($estimate->clientnote) : get_option('predefined_clientnote_estimate')); ?>
                <?php echo render_textarea('clientnote','estimate_add_edit_client_note',$value,array(),array(),'mtop15'); ?>
                <?php $value = (isset($estimate) ? clear_textarea_breaks($estimate->terms) : get_option('predefined_terms_estimate')); ?>
                <?php echo render_textarea('terms','terms_and_conditions',$value,array(),array(),'mtop15'); ?>
                <button type="submit" class="btn-tr btn btn-info mleft10 text-right pull-right">
                    <?php echo _l('submit'); ?>
                </button>
            </div>
        </div>
    </div>
</div>
