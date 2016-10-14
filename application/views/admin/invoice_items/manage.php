<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body _buttons">
                        <a href="#" class="btn btn-info pull-left" data-toggle="modal" data-target="#sales_item_modal"><?php echo _l('new_invoice_item'); ?></a>
                    </div>
                </div>
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="clearfix"></div>
                        <?php render_datatable(array(
                            _l('invoice_items_list_description'),
                            _l('invoice_item_long_description'),
                            _l('invoice_items_list_rate'),
                            _l('invoice_items_list_tax'),
                            _l('options'),
                            ),'invoice-items'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="sales_item_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <span class="edit-title"><?php echo _l('invoice_item_edit_heading'); ?></span>
                    <span class="add-title"><?php echo _l('invoice_item_add_heading'); ?></span>
                </h4>
            </div>
            <?php echo form_open('admin/invoice_items/manage',array('id'=>'invoice_item_form')); ?>
            <?php echo form_hidden('itemid'); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <div class="alert alert-warning affect-warning hide">
                        <?php echo _l('changing_items_affect_warning'); ?>
                    </div>
                        <?php echo render_input('description','invoice_item_add_edit_description'); ?>
                        <?php echo render_input('rate','invoice_item_add_edit_rate','','number'); ?>
                        <?php echo render_textarea('long_description','invoice_item_long_description'); ?>
                        <div class="form-group">
                            <label class="control-label" for="tax"><?php echo _l('invoice_item_add_edit_tax'); ?></label>
                            <select class="selectpicker display-block" data-width="100%" name="tax" title='<?php echo _l('invoice_item_add_edit_tax_select'); ?>' data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                <?php foreach($taxes as $tax){ ?>
                                <option value="<?php echo $tax['id']; ?>" data-subtext="<?php echo $tax['name']; ?>"><?php echo $tax['taxrate']; ?>%</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
    initDataTable('.table-invoice-items', window.location.href, [4], [4],'undefined',[0,'ASC']);
    /* INVOICE ITEMS MANAGE FUNCTIONS */
    function manage_invoice_items(form) {
        var data = $(form).serialize();
        var url = form.action;
        $.post(url, data).success(function(response) {
            response = $.parseJSON(response);
            if (response.success == true) {
                $('.table-invoice-items').DataTable().ajax.reload();
                alert_float('success', response.message);
            }
            $('#sales_item_modal').modal('hide');
        });
        return false;
    }
    // Set validation for invoice item form
    _validate_form($('#invoice_item_form'), {
        name: 'required',
        rate: {
            required: true,
        }
    }, manage_invoice_items);

    $('#sales_item_modal').on('show.bs.modal', function(event) {
        $('.affect-warning').addClass('hide');
        var button = $(event.relatedTarget)
        var id = button.data('id');
        $('#sales_item_modal input').val('');
        $('#sales_item_modal textarea').val('');
        $('select[name="tax"]').selectpicker('deselectAll');
        $('#sales_item_modal .add-title').removeClass('hide');
        $('#sales_item_modal .edit-title').addClass('hide');
        // If id found get the text from the datatable
        if (typeof(id) !== 'undefined') {
            $('.affect-warning').removeClass('hide');
            $('input[name="itemid"]').val(id);
            var description = $(button).parents('tr').find('td').eq(0).text();
            var long_description = $(button).parents('tr').find('td').eq(1).text();
            var rate = $(button).parents('tr').find('td').eq(2).text();
            var taxid = $(button).parents('tr').find('td').eq(3).find('span').data('taxid');
            $('#sales_item_modal .add-title').addClass('hide');
            $('#sales_item_modal .edit-title').removeClass('hide');
            $('#sales_item_modal input[name="description"]').val(description);
            $('#sales_item_modal input[name="rate"]').val(rate);
            $('#sales_item_modal textarea').val(long_description);
            $('select[name="tax"]').selectpicker('val', taxid);
        }
    });
    /* END INVOICE ITEMS MANAGE FUNCTIONS */
</script>
</body>
</html>
