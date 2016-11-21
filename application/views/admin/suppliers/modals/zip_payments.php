<?php
/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 08/11/2016
 * Time: 17:59
 */

?>

<!-- Modal -->
<div class="modal fade" id="supplier_zip_payments" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php echo form_open('admin/suppliers/zip_payments/'.$supplier->supplierid); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo _l('supplier_zip_payments'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        if($supplier->company != ''){
                            $file_name = slug_it($supplier->company);
                        } else {
                            $file_name = slug_it($supplier->firstname . ' ' .$supplier->lastname);
                        }
                        ?>
                        <?php
                        array_unshift($payment_modes,array('id'=>'','name'=>_l('supplier_zip_status_all')));
                        echo render_select('paymentmode',$payment_modes,array('id','name'),'supplier_zip_payment_modes'); ?>
                        <div class="clearfix mbot15"></div>
                        <?php include(APPPATH .'views/admin/suppliers/modals/modal_zip_date_picker.php'); ?>
                        <?php echo form_hidden('file_name',$file_name); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

