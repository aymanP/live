<?php
/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 08/11/2016
 * Time: 16:42
 */

?>


<?php if(isset($supplier)){ ?>
    <?php if(has_permission('estimates','','create')){ ?>
        <a href="<?php echo admin_url('estimates/estimate?supplier_id='.$supplier->supplierid); ?>" class="btn btn-info"><?php echo _l('create_new_estimate'); ?></a>
    <?php } ?>
    <?php if(has_permission('estimates','','view')){ ?>
        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#client_zip_estimates"><?php echo _l('zip_estimates'); ?></a>
        <?php
        $table_data = array(_l('estimate_dt_table_heading_number'),
            _l('estimate_dt_table_heading_amount'),
            _l('estimates_total_tax'),
            _l('invoice_estimate_year'),
            _l('estimate_dt_table_heading_client'),
            _l('estimate_dt_table_heading_date'),
            _l('estimate_dt_table_heading_expirydate'),
            _l('reference_no'),
            _l('estimate_dt_table_heading_status'));

        $custom_fields = get_custom_fields('estimate',array('show_on_table'=>1));
        foreach($custom_fields as $field){
            array_push($table_data,$field['name']);
        }
        render_datatable($table_data, 'estimates-single-client');
        include_once(APPPATH . 'views/admin/suppliers/modals/zip_estimates.php');
        ?>
    <?php } ?>
<?php } ?>

