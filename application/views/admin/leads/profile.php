<?php if(isset($lead)){ ?>
<div class="btn-group pull-left">
    <button type="button" class="btn btn-default dropdown-toggle mright5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo _l('more'); ?> <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-left">
        <?php if($lead->junk == 0){ ?>
        <?php if($lead->lost == 0 && (total_rows('tblclients',array('leadid'=>$lead->id)) == 0)){ ?>
        <li>
            <a href="#" onclick="lead_mark_as_lost(<?php echo $lead->id; ?>); return false;"><i class="fa fa-mars"></i> <?php echo _l('lead_mark_as_lost'); ?></a>
        </li>
        <?php } else if($lead->lost == 1){ ?>
        <li>
            <a href="#" onclick="lead_unmark_as_lost(<?php echo $lead->id; ?>); return false;"><i class="fa fa-smile-o"></i> <?php echo _l('lead_unmark_as_lost'); ?></a>
        </li>
        <?php } ?>
        <?php } ?>
        <!-- mark as junk -->
        <?php if($lead->lost == 0){ ?>
        <?php if($lead->junk == 0 && (total_rows('tblclients',array('leadid'=>$lead->id)) == 0)){ ?>
        <li>
            <a href="#" onclick="lead_mark_as_junk(<?php echo $lead->id; ?>); return false;"><i class="fa fa fa-times"></i> <?php echo _l('lead_mark_as_junk'); ?></a>
        </li>
        <?php } else if($lead->junk == 1){ ?>
        <li>
            <a href="#" onclick="lead_unmark_as_junk(<?php echo $lead->id; ?>); return false;"><i class="fa fa-smile-o"></i> <?php echo _l('lead_unmark_as_junk'); ?></a>
        </li>
        <?php } ?>
        <?php } ?>
        <?php if((is_lead_creator($lead->id) && $lead_locked == false) || is_admin()){ ?>
        <li>
            <a href="<?php echo admin_url('leads/delete/'.$lead->id); ?>" class="text-danger delete-text _delete" data-toggle="tooltip" title=""><i class="fa fa-remove"></i> <?php echo _l('lead_edit_delete_tooltip'); ?></a>
        </li>
        <?php } ?>
    </ul>
</div>
<?php
    $client = false;
    $convert_to_client_tooltip_email_exists = '';
    if(total_rows('tblcontacts',array('email'=>$lead->email)) > 0 && total_rows('tblclients',array('leadid'=>$lead->id)) == 0){
      $convert_to_client_tooltip_email_exists = _l('lead_email_already_exists');
      $text = _l('lead_convert_to_client');
    } else if (total_rows('tblclients',array('leadid'=>$lead->id))){
      $text = _l('lead_already_converted');
      $client = true;
    } else {
      $text = _l('lead_convert_to_client');
    }
    ?>
<?php if($client && (has_permission('customers','','view') || is_customer_admin(get_client_id_by_lead_id($lead->id)))){ ?>
<a data-toggle="tooltip" class="btn btn-default" title="<?php echo _l('lead_converted_edit_client_profile'); ?>" href="<?php echo admin_url('clients/client/'.get_client_id_by_lead_id($lead->id)); ?>">
<i class="fa fa-user"></i>
</a>
<?php } ?>
<?php if(total_rows('tblclients',array('leadid'=>$lead->id)) == 0){ ?>
<a href="#" data-toggle="tooltip" data-title="<?php echo $convert_to_client_tooltip_email_exists; ?>" class="btn btn-info convert_lead_to_client_modal"><i class="fa fa-refresh"></i>
<?php echo $text; ?>
</a>
<?php } else {
    echo '<p class="mtop15 text-success bold">'.$text.'</p>';
    } ?>
<?php } ?>
<hr />
<div class="clearfix"></div>
<?php
    $form_url = admin_url('leads/lead');
    if(isset($lead)){
      $form_url = admin_url('leads/lead/'.$lead->id);
    }
    ?>
<?php echo form_open($form_url,array('id'=>'lead_form')); ?>
<div class="form-group">
    <div class="checkbox checkbox-primary">
        <input type="checkbox" name="is_public" <?php if(isset($lead)){if($lead->is_public == 1){echo 'checked';}}; ?> id="lead_public">
        <label for="lead_public"><?php echo _l('lead_public'); ?></label>
    </div>
</div>
<?php $value = (isset($lead) ? $lead->name : ''); ?>
<?php echo render_input('name','lead_add_edit_name',$value); ?>
<?php $value = (isset($lead) ? $lead->company : ''); ?>
<?php echo render_input('company','lead_company',$value); ?>
<div class="row">
    <div class="col-md-6">
     <?php $value = (isset($lead) ? $lead->email : ''); ?>
     <?php echo render_input('email','lead_add_edit_email',$value); ?>
 </div>
 <div class="col-md-6">
    <?php $value = (isset($lead) ? $lead->phonenumber : ''); ?>
    <?php echo render_input('phonenumber','lead_add_edit_phonenumber',$value); ?>
</div>
<div class="clearfix"></div>
<div class="col-md-6">
    <?php $selected = (isset($lead) ? $lead->source : get_option('leads_default_source')); ?>
    <?php echo render_select('source',$sources,array('id','name'),'lead_add_edit_source',$selected); ?>
</div>
<div class="col-md-6">
<?php
$selected = '';
if(isset($lead)){
    $selected = $lead->status;
} else if(isset($status_id)){
    $selected = $status_id;
}
echo render_select('status',$statuses,array('id','name'),'lead_add_edit_status',$selected); ?>
</div>
</div>
<?php
    $selected = '';
    $i = 0;
    foreach($members as $assigned){
        if(!is_staff_member($assigned['staffid'])){
            unset($members[$i]);
        }
     if(isset($lead)){
       if($lead->assigned == $assigned['staffid']){
         $selected = $assigned['staffid'];
       }
     } else {
       if($assigned['staffid'] == get_staff_user_id()){
         $selected = $assigned['staffid'];
       }
     }
     $i++;
    }
    ?>
<?php echo render_select('assigned',$members,array('staffid',array('firstname','lastname')),'lead_add_edit_assigned',$selected); ?>
<?php $rel_id = (isset($lead) ? $lead->id : false); ?>
<?php echo render_custom_fields('leads',$rel_id); ?>
<?php if(!isset($lead)){ ?>
<div class="lead-select-date-contacted hide">
    <?php $value = (isset($contract) ? $contract->dateend : ''); ?>
    <?php echo render_datetime_input('custom_contact_date','lead_add_edit_datecontacted',$value); ?>
</div>
<div class="checkbox checkbox-primary">
    <input type="checkbox" name="contacted_today" id="contacted_today" checked>
    <label for="contacted_today"><?php echo _l('lead_add_edit_contected_today'); ?></label>
</div>
<?php } ?>
<?php if($lead_locked == false){ ?>
<hr />
<button type="submit" class="btn btn-info pull-right"><?php echo _l('submit'); ?></button>
<?php } ?>
<div class="clearfix"></div>
<?php echo form_close(); ?>
<?php if(isset($lead)){ ?>
<div class="modal fade" id="convert_lead_to_client_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <?php echo form_open('admin/leads/convert_to_client',array('id'=>'lead_to_client_form')); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close convert-client-close-modal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo _l('lead_convert_to_client'); ?>
                </h4>
            </div>
            <div class="modal-body">
                <?php echo form_hidden('leadid',$lead->id); ?>
                <?php if(strpos($lead->name,' ') !== false){
                    $_temp = explode(' ',$lead->name);
                    $firstname = $_temp[0];
                    if(isset($_temp[2])){
                      $lastname = $_temp[1] . ' ' . $_temp[2];
                    } else {
                      $lastname = $_temp[1];
                    }
                    } else {
                    $lastname = '';
                    $firstname = $lead->name;
                    }
                    ?>
                <?php echo render_input('firstname','lead_convert_to_client_firstname',$firstname); ?>
                <?php echo render_input('lastname','lead_convert_to_client_lastname',$lastname); ?>
                <?php echo render_input('phonenumber','lead_convert_to_client_phone',$lead->phonenumber); ?>
                <?php echo render_input('company','lead_company',$lead->company); ?>
                <?php echo render_input('email','lead_convert_to_email',$lead->email); ?>
                <?php
                    $not_mergable_customer_fields  = array('userid','datecreated','leadid','default_language','default_currency');
                    $not_mergable_contact_fields  = array('id','userid','email','firstname','lastname','datecreated','is_primary','password','new_pass_key','new_pass_key_requested','last_ip','last_login','last_password_change','active');
                    $customer_fields = $this->db->list_fields('tblclients');
                    $contact_fields = $this->db->list_fields('tblcontacts');
                    $custom_fields = get_custom_fields('leads');
                    $found_custom_fields = false;
                    foreach ($custom_fields as $field) {
                      $value = get_custom_field_value($lead->id, $field['id'], 'leads');
                      if ($value == '') {
                        continue;
                      } else {
                        $found_custom_fields = true;
                      }
                    }
                    if($found_custom_fields == true){
                      echo '<h4 class="bold text-center mtop30">'._l('copy_custom_fields_convert_to_customer').'</h4><hr />';
                    }
                    foreach ($custom_fields as $field) {
                      $value = get_custom_field_value($lead->id, $field['id'], 'leads');
                      if ($value == '') {
                        continue;
                      }
                      ?>
                <p class="bold text-info no-margin"><?php echo $field['name']; ?> (<?php echo $value; ?>)</p>
                <hr />
                <p class="bold no-margin">- <?php echo _l('leads_merge_customer'); ?></p>
                <div class="radio radio-primary">
                    <input type="radio" data-field-id="<?php echo $field['id']; ?>" id="m_1_<?php echo $field['id']; ?>" class="include_leads_custom_fields" checked name="include_leads_custom_fields[<?php echo $field['id']; ?>]" value="1">
                    <label for="m_1_<?php echo $field['id']; ?>" class="font-normal">
                    <span data-toggle="tooltip" data-title="<?php echo _l('copy_custom_fields_convert_to_customer_help'); ?>"><i class="fa fa-info-circle"></i></span> <?php echo _l('lead_merge_custom_field'); ?>
                    </label>
                </div>
                <div class="radio radio-primary">
                    <input type="radio" data-field-id="<?php echo $field['id']; ?>" id="m_2_<?php echo $field['id']; ?>" class="include_leads_custom_fields" name="include_leads_custom_fields[<?php echo $field['id']; ?>]" value="2">
                    <label for="m_2_<?php echo $field['id']; ?>" class="font-normal">
                    <?php echo _l('lead_merge_custom_field_existing'); ?>
                    </label>
                </div>
                <div class="hide" id="merge_db_field_<?php echo $field['id']; ?>">
                    <hr />
                    <select name="merge_db_fields[<?php echo $field['id']; ?>]" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                        <option value=""></option>
                        <?php foreach($customer_fields as $c_field){
                            if(!in_array($c_field, $not_mergable_customer_fields)){
                              echo '<option value="'.$c_field.'">'.str_replace('_',' ',ucfirst($c_field)).'</option>';
                            }
                            }
                            ?>
                    </select>
                    <hr />
                </div>
                <p class="bold no-margin">- <?php echo _l('leads_merge_contact'); ?></p>
                <div class="radio radio-primary">
                    <input type="radio" data-field-id="<?php echo $field['id']; ?>" id="m_3_<?php echo $field['id']; ?>" class="include_leads_custom_fields" name="include_leads_custom_fields[<?php echo $field['id']; ?>]" value="3">
                    <label for="m_3_<?php echo $field['id']; ?>" class="font-normal">
                    <?php echo _l('leads_merge_as_contact_field'); ?>
                    </label>
                </div>
                <div class="radio radio-primary">
                    <input type="radio" data-field-id="<?php echo $field['id']; ?>" id="m_4_<?php echo $field['id']; ?>" class="include_leads_custom_fields" name="include_leads_custom_fields[<?php echo $field['id']; ?>]" value="4">
                    <label for="m_4_<?php echo $field['id']; ?>" class="font-normal">
                    <span data-toggle="tooltip" data-title="<?php echo _l('copy_custom_fields_convert_to_customer_help'); ?>"><i class="fa fa-info-circle"></i></span>
                    <?php echo _l('lead_merge_custom_field'); ?>
                    </label>
                </div>
                <div class="hide" id="merge_db_contact_field_<?php echo $field['id']; ?>">
                    <hr />
                    <select name="merge_db_contact_fields[<?php echo $field['id']; ?>]" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                        <option value=""></option>
                        <?php foreach($contact_fields as $c_field){
                            if(!in_array($c_field, $not_mergable_contact_fields)){
                              echo '<option value="'.$c_field.'">'.str_replace('_',' ',ucfirst($c_field)).'</option>';
                            }
                            }
                            ?>
                    </select>
                </div>
                <hr />
                <div class="radio radio-primary">
                    <input type="radio" data-field-id="<?php echo $field['id']; ?>" id="m_5_<?php echo $field['id']; ?>" class="include_leads_custom_fields" name="include_leads_custom_fields[<?php echo $field['id']; ?>]" value="5">
                    <label for="m_5_<?php echo $field['id']; ?>" class="font-normal">
                    <?php echo _l('lead_dont_merge_custom_field'); ?>
                    </label>
                </div>
                <hr />
                <?php } ?>
                <?php echo form_hidden('original_lead_email',$lead->email); ?>
                <div class="client_password_set_wrapper">
                    <label for="password" class="control-label"><?php echo _l('client_password'); ?></label>
                    <div class="input-group">
                        <input type="password" class="form-control password" name="password" autocomplete="off">
                        <span class="input-group-addon">
                            <a href="#password" class="show_password" onclick="showPassword('password');"><i class="fa fa-eye"></i></a>
                        </span>
                        <span class="input-group-addon">
                            <a href="#" class="generate_password" onclick="generatePassword(this);return false;"><i class="fa fa-refresh"></i></a>
                        </span>
                    </div>
                </div>
                <div class="checkbox checkbox-primary">
                    <input type="checkbox" name="send_set_password_email" id="send_set_password_email">
                    <label for="send_set_password_email">
                    <?php echo _l( 'client_send_set_password_email'); ?>
                    </label>
                </div>
                <div class="checkbox checkbox-primary">
                    <input type="checkbox" name="donotsendwelcomeemail" id="donotsendwelcomeemail">
                    <label for="donotsendwelcomeemail"><?php echo _l('client_do_not_send_welcome_email'); ?></label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default convert-client-close-modal"><?php echo _l('close'); ?></button>
                <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<?php } ?>
