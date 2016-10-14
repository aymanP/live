<?php if(isset($client)){ ?>
  <?php if(has_permission('contracts','','create')){ ?>
        <a href="<?php echo admin_url('contracts/contract?customer_id='.$client->userid); ?>" class="btn btn-info"><?php echo _l('new_contract'); ?></a>
<?php } ?>
    <?php if(has_permission('contracts','','view')){ ?>
       <?php
       $table_data = array(
        _l('contract_list_subject'),
        _l('contract_list_client'),
        _l('contract_types_list_name'),
        _l('contract_list_start_date'),
        _l('contract_list_end_date'),
        );
       $custom_fields = get_custom_fields('contracts',array('show_on_table'=>1));
       foreach($custom_fields as $field){
        array_push($table_data,$field['name']);
    }
    array_push($table_data,_l('options'));
    render_datatable($table_data, 'contracts-single-client'); ?>
    <?php } ?>
    <?php } ?>
