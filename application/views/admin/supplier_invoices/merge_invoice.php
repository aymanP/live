<?php if(count($invoices_to_merge) > 0){ ?>
<div class="col-md-12">
    <h4 class="bold text-success"><?php echo _l('invoices_available_for_merging'); ?></h4>
        <?php foreach($invoices_to_merge as $_inv){ ?>
        <div class="checkbox checkbox-success">
            <input type="checkbox" name="invoices_to_merge[]" value="<?php echo $_inv->id; ?>">
            <label for=""><a href="<?php echo admin_url('supplier_invoices/list_invoice/'.$_inv->id); ?>" data-toggle="tooltip" data-title="<?php echo format_invoice_status($_inv->status,'',false); ?>" target="_blank"><?php echo format_invoice_number($_inv->id); ?></a> - <?php echo format_money($_inv->total,$_inv->symbol); ?></label>
        </div>
        <?php if($_inv->discount_total > 0){
                echo _l('invoices_merge_discount',format_money($_inv->discount_total,$_inv->symbol)) . '<br />';
            }
            ?>
        <?php } ?>
</div>
<div class="col-md-12">
<hr />
    <p class="text-danger">
        <?php echo _l('invoice_merge_number_warning'); ?>
    </p>
    <p>
    <div class="checkbox">
        <input type="checkbox" checked name="cancel_merged_invoices" id="cancel_merged_invoices">
        <label for="cancel_merged_invoices"><?php echo _l('invoices_merge_cancel_merged_invoices'); ?></label>
    </div>
    </p>
    <hr />
</div>
<?php } ?>
