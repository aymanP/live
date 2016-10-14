<?php if(isset($client)){ ?>
    <?php if(has_permission('payments','','view')){ ?>
            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#client_zip_payments"><?php echo _l('zip_payments'); ?></a>
        <?php render_datatable(array(
            _l('payments_table_number_heading'),
            _l('payments_table_invoicenumber_heading'),
            _l('payments_table_mode_heading'),
            _l('payment_transaction_id'),
            _l('payments_table_client_heading'),
            _l('payments_table_amount_heading'),
            _l('payments_table_date_heading'),
            _l('options')
            ),'payments-single-client'); ?>
        <?php include_once(APPPATH . 'views/admin/clients/modals/zip_payments.php'); ?>
        <?php } ?>
        <?php } ?>
