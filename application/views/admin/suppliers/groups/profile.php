<?php
/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 08/11/2016
 * Time: 16:43
 */
?>

<div class="row">
    <?php echo form_open_multipart($this->uri->uri_string(),array('class'=>'client-form', 'id'=>'client_profile_table')); ?>
    <div class="additional"></div>
    <div class="col-md-12">
        <ul class="nav nav-tabs profile-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#contact_info" aria-controls="contact_info" role="tab" data-toggle="tab">
                    <?php echo _l( 'supplier_profile_details'); ?>
                </a>
            </li>
            <li role="presentation">
                <a href="#billing_and_shipping" aria-controls="billing_and_shipping" role="tab" data-toggle="tab">
                    <?php echo _l( 'billing_shipping'); ?>
                </a>
            </li>
            <?php if(isset($supplier)){ ?>
                <li role="presentation">
                    <a href="#contacts" aria-controls="contacts" role="tab" data-toggle="tab">
                        <?php echo _l( 'supplier_contacts'); ?>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#supplier_admins" aria-controls="supplier_admins" role="tab" data-toggle="tab">
                        <?php echo _l( 'supplier_admins'); ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane ptop10 active" id="contact_info">
                <div class="row">
                    <div class="col-md-4">

                        <?php $value=( isset($supplier) ? $supplier->company : ''); ?>
                        <?php $attrs = (isset($supplier) ? array() : array('autofocus'=>true)); ?>
                        <?php echo render_input( 'company', 'supplier_company',$value,'text',$attrs); ?>
                        <?php $value=( isset($supplier) ? $supplier->phonenumber : ''); ?>
                        <?php echo render_input( 'phonenumber', 'supplier_phonenumber',$value); ?>
                        <?php $value=( isset($supplier) ? $supplier->vat : ''); ?>
                        <?php echo render_input( 'vat', 'supplier_vat_number',$value); ?>
                        <?php
                        $s_attrs = array('data-none-selected-text'=>_l('system_default_string'));
                        $selected = '';
                        if(isset($supplier) && supplier_have_transactions($supplier->supplierid)){
                            $s_attrs['disabled'] = true;
                        }
                        foreach($currencies as $currency){
                            if(isset($supplier)){
                                if($currency['id'] == $supplier->default_currency){
                                    $selected = $currency['id'];
                                }
                            }
                        }
                        ?>
                        <?php echo render_select('default_currency',$currencies,array('id','symbol','name'),'invoice_add_edit_currency',$selected,$s_attrs); ?>
                        <div class="form-group">
                            <label for="default_language" class="control-label"><?php echo _l('localization_default_language'); ?>
                            </label>
                            <select name="default_language" id="default_language" class="form-control selectpicker" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                <option value=""><?php echo _l('system_default_string'); ?></option>
                                <?php foreach(list_folders(APPPATH .'language') as $language){
                                    $selected = '';
                                    if(isset($supplier)){
                                        if($supplier->default_language == $language){
                                            $selected = 'selected';
                                        }
                                    }
                                    ?>
                                    <option value="<?php echo $language; ?>" <?php echo $selected; ?>><?php echo ucfirst($language); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php $value=( isset($supplier) ? $supplier->latitude : ''); ?>
                        <?php echo render_input( 'latitude', 'supplier_latitude',$value); ?>
                        <?php $value=( isset($supplier) ? $supplier->longitude : ''); ?>
                        <?php echo render_input( 'longitude', 'supplier_longitude',$value); ?>
                    </div>
                    <div class="col-md-4">
                        <?php $value=( isset($supplier) ? $supplier->address : ''); ?>
                        <?php echo render_input( 'address', 'supplier_address',$value); ?>

                        <?php $value=( isset($supplier) ? $supplier->city : ''); ?>
                        <?php echo render_input( 'city', 'supplier_city',$value); ?>
                        <?php $value=( isset($supplier) ? $supplier->state : ''); ?>
                        <?php echo render_input( 'state', 'supplier_state',$value); ?>
                        <?php $value=( isset($supplier) ? $supplier->zip : ''); ?>
                        <?php echo render_input( 'zip', 'supplier_postal_code',$value); ?>
                        <?php $countries= get_all_countries();
                        $supplier_default_country = get_option('supplier_default_country');
                        $selected =( isset($supplier) ? $supplier->country : $supplier_default_country);
                        echo render_select( 'country',$countries,array( 'country_id',array( 'short_name')), 'suppliers_country',$selected,array('data-none-selected-text'=>_l('dropdown_non_selected_tex')));
                        ?>
                        <?php
                        $selected = array();
                        if(isset($supplier_groups)){
                            foreach($supplier_groups as $group){
                                array_push($selected,$group['groupid']);
                            }
                        }
                        echo render_select('groups_in[]',$groups,array('id','name'),'supplier_groups',$selected,array('multiple'=>true),array(),'','',false);
                        ?>
                    </div>
                    <div class="col-md-4">
                        <?php $rel_id=( isset($supplier) ? $supplier->supplierid : false); ?>
                        <?php echo render_custom_fields( 'suppliers',$rel_id); ?>
                        <?php if($supplier->profile_image == NULL){ ?>
                            <div class="form-group">
                                <label for="profile_image" class="profile-image"><?php echo _l('supplier_profile_image'); ?></label>
                                <input type="file" name="profile_image" class="form-control" id="profile_image">
                            </div>
                        <?php } ?>
                        <?php if($supplier->profile_image != NULL){ ?>
                            <div class="form-group">
                                <div class="row">

                                    <div class="col-md-9">
                                        <?php echo supplier_profile_image($_staff->staffid,array('img','img-responsive','client-profile-image-thumb'),'thumb'); ?>
                                    </div>

                                    <div class="col-md-3 text-right">
                                        <a href="<?php echo admin_url('suppliers/remove_supplier_profile_image'); ?>"><i class="fa fa-remove"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php if(isset($supplier)){ ?>
                <div role="tabpanel" class="tab-pane ptop10" id="contacts">
                    <?php if(has_permission('suppliers','','create') || is_supplier_admin($supplier->supplierid)){ ?>
                        <a href="#" onclick="supplier_contact(<?php echo $supplier->supplierid; ?>); return false;" class="btn btn-info"><?php echo _l('new_contact'); ?></a>
                    <?php } ?>
                    <?php
                    $table_data = array(_l('contact_firstname'),_l('contact_lastname'),_l('supplier_email'),_l('supplier_phonenumber'),_l('contact_active'),_l('suppliers_list_last_login'));
                    $custom_fields = get_custom_fields('supplier_contacts',array('show_on_table'=>1));
                    foreach($custom_fields as $field){
                        array_push($table_data,$field['name']);
                    }
                    array_push($table_data,_l('options'));
                    echo render_datatable($table_data,'contacts'); ?>
                </div>
                <div role="tabpanel" class="tab-pane ptop10" id="supplier_admins">
                    <?php if (has_permission('suppliers', '', 'create') || has_permission('suppliers', '', 'edit')) { ?>
                        <a href="#" data-toggle="modal" data-target="#supplier_admins_assign" class="btn btn-info mbot15"><?php echo _l('assign_admin'); ?></a>
                    <?php } ?>
                    <table class="table dt-table">
                        <thead>
                        <tr>
                            <th><?php echo _l('staff_member'); ?></th>
                            <th><?php echo _l('supplier_admin_date_assigned'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($supplier_admins as $c_admin){ ?>
                            <tr>
                                <td><a href="<?php echo admin_url('profile/'.$c_admin['staff_id']); ?>">
                                        <?php echo staff_profile_image($c_admin['staff_id'], array(
                                            'staff-profile-image-small',
                                            'mright5'
                                        ));
                                        echo get_staff_full_name($c_admin['staff_id']); ?></a>
                                </td>
                                <td data-order="<?php echo $c_admin['date_assigned']; ?>"><?php echo _dt($c_admin['date_assigned']); ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
            <div role="tabpanel" class="tab-pane ptop10" id="billing_and_shipping">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <h4><?php echo _l('billing_address'); ?> <a href="#" class="pull-right text-uppercase billing-same-as-customer"><small class="label label-primary"><?php echo _l('supplier_billing_same_as_profile'); ?></small></a></h4>
                                <?php $value=( isset($supplier) ? $supplier->billing_street : ''); ?>
                                <?php echo render_input( 'billing_street', 'billing_street',$value); ?>
                                <?php $value=( isset($supplier) ? $supplier->billing_city : ''); ?>
                                <?php echo render_input( 'billing_city', 'billing_city',$value); ?>
                                <?php $value=( isset($supplier) ? $supplier->billing_state : ''); ?>
                                <?php echo render_input( 'billing_state', 'billing_state',$value); ?>
                                <?php $value=( isset($supplier) ? $supplier->billing_zip : ''); ?>
                                <?php echo render_input( 'billing_zip', 'billing_zip',$value); ?>
                                <?php $selected=( isset($supplier) ? $supplier->billing_country : $supplier_default_country ); ?>
                                <?php echo render_select( 'billing_country',$countries,array( 'country_id',array( 'short_name')), 'billing_country',$selected,array('data-none-selected-text'=>_l('dropdown_non_selected_tex'))); ?>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo _l('shipping_address'); ?> <a href="#" class="pull-right text-uppercase customer-copy-billing-address"><small class="label label-primary"><?php echo _l('supplier_billing_copy'); ?></small></a></h4>
                                <?php $value=( isset($supplier) ? $supplier->shipping_street : ''); ?>
                                <?php echo render_input( 'shipping_street', 'shipping_street',$value); ?>
                                <?php $value=( isset($supplier) ? $supplier->shipping_city : ''); ?>
                                <?php echo render_input( 'shipping_city', 'shipping_city',$value); ?>
                                <?php $value=( isset($supplier) ? $supplier->shipping_state : ''); ?>
                                <?php echo render_input( 'shipping_state', 'shipping_state',$value); ?>
                                <?php $value=( isset($supplier) ? $supplier->shipping_zip : ''); ?>
                                <?php echo render_input( 'shipping_zip', 'shipping_zip',$value); ?>
                                <?php $selected=( isset($supplier) ? $supplier->shipping_country : $supplier_default_country ); ?>
                                <?php echo render_select( 'shipping_country',$countries,array( 'country_id',array( 'short_name')), 'shipping_country',$selected,array('data-none-selected-text'=>_l('dropdown_non_selected_tex'))); ?>
                            </div>
                            <?php if(isset($supplier) &&
                                (total_rows('tblinvoices',array('supplierid'=>$supplier->supplierid)) > 0 || total_rows('tblestimates',array('supplierid'=>$supplier->supplierid)) > 0)){ ?>
                                <div class="col-md-12">
                                    <div class="alert alert-warning">
                                        <div class="checkbox checkbox-primary">
                                            <input type="checkbox" name="update_all_other_transactions" id="update_all_other_transactions">
                                            <label for="update_all_other_transactions">
                                                <?php echo _l('supplier_update_address_info_on_invoices'); ?><br />
                                            </label>
                                        </div>
                                        <b><?php echo _l('supplier_update_address_info_on_invoices_help'); ?></b>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-info mtop20 only-save customer-form-submiter">
                <?php echo _l( 'submit'); ?>
            </button>
            <?php if(!isset($supplier)){ ?>
                <button class="btn btn-info mtop20 save-and-add-contact customer-form-submiter">
                    <?php echo _l( 'save_supplier_and_add_contact'); ?>
                </button>
            <?php } ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<div id="contact_data"></div>
<?php if(isset($supplier)){ ?>
    <?php if (has_permission('suppliers', '', 'create') || has_permission('suppliers', '', 'edit')) { ?>
        <div class="modal fade" id="supplier_admins_assign" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <?php echo form_open(admin_url('suppliers/assign_admins/'.$supplier->supplierid)); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><?php echo _l('assign_admin'); ?></h4>
                    </div>
                    <div class="modal-body">
                        <?php
                        $selected = array();
                        foreach($supplier_admins as $c_admin){
                            array_push($selected,$c_admin['staff_id']);
                        }
                        echo render_select('supplier_admins[]',$staff,array('staffid',array('firstname','lastname')),'',$selected,array('multiple'=>true),array(),'','',false); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                        <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
                    </div>
                </div>
                <!-- /.modal-content -->
                <?php echo form_close(); ?>
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    <?php } ?>
<?php } ?>

