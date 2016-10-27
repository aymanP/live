<?php
/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 26/10/2016
 * Time: 13:24
 */
?>
<div class="modal fade estimate-project" id="estimate-project-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <?php echo form_open('admin/projects/estimate_project/'.$project->id,array('id'=>'estimate_project_form','class'=>'_transaction_form')); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <span class="edit-title"><?php echo _l('estimate_project'); ?></span>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php $this->load->view('admin/estimates/estimate_template'); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
    init_selectpicker();
    init_datepicker();
    init_items_sortable();
    init_items_search();
    validate_estimate_form('#estimate_project_form');
    $('#estimate-project-modal #clientid').change();
    $('input[name="show_quantity_as"]:checked').change();
    calculate_total();
</script>

