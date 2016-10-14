<div class="col-md-12 no-padding">
    <div class="panel_s">
        <div class="panel-body padding-16">
            <?php if($expense->recurring == 1){
                echo '<div class="ribbon warning"><span>'._l('expense_recurring_indicator').'</span></div>';
                } ?>
            <ul class="nav nav-tabs no-margin" role="tablist">
                <li role="presentation" class="active">
                    <a href="#tab_expense" aria-controls="tab_expense" role="tab" data-toggle="tab">
                    <?php echo _l('expense'); ?>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#tab_tasks" aria-controls="tab_tasks" role="tab" data-toggle="tab">
                    <?php echo _l('tasks'); ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="panel_s">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="bold no-margin"><?php echo $expense->category_name; ?></h3>
                </div>
                <div class="col-md-6 _buttons text-right">
                   <div class="visible-xs">
                        <div class="mtop10"></div>
                    </div>
                    <?php if($expense->billable == 1 && $expense->invoiceid == NULL){ ?>
                    <?php if(has_permission('invoices','','create')){ ?>
                    <a href="<?php echo admin_url('expenses/convert_to_invoice/'.$expense->expenseid); ?>" class="btn mleft10 pull-right btn-success"><?php echo _l('expense_convert_to_invoice'); ?></a>
                    <?php } ?>
                    <?php } else if($expense->invoiceid != NULL){ ?>
                    <?php if(has_permission('invoices','','view')){ ?>
                    <a href="<?php echo admin_url('invoices/list_invoices/'.$expense->invoiceid); ?>" class="btn mleft10 pull-right btn-info"><?php echo format_invoice_number($invoice->id); ?></a>
                    <?php } ?>
                    <?php } ?>
                    <div class="pull-right">
                        <?php if(has_permission('expenses','','edit')){ ?>
                        <a class="btn btn-default mright5 btn-with-tooltip" href="<?php echo admin_url('expenses/expense/'.$expense->expenseid); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo _l('expense_edit'); ?>"><i class="fa fa-pencil-square-o"></i></a>
                        <?php } ?>
                        <?php if(has_permission('expenses','','create')){ ?>
                        <a class="btn btn-default btn-with-tooltip mright5" href="<?php echo admin_url('expenses/copy/'.$expense->expenseid); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo _l('expense_copy'); ?>"><i class="fa fa-clone"></i></a>
                        <?php } ?>
                        <?php if(has_permission('expenses','','delete')){ ?>
                        <a class="btn btn-danger btn-with-tooltip mright5 _delete" href="<?php echo admin_url('expenses/delete/'.$expense->expenseid); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo _l('expense_delete'); ?>"><i class="fa fa-remove"></i></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr />
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane ptop10 active" id="tab_expense">
                    <div class="row">
                        <div class="col-md-6">
                            <p><span class="bold"><?php echo _l('expense_amount'); ?></span> <span class="text-danger bold font-medium"><?php echo format_money($expense->amount,$expense->currency_data->symbol); ?></span>
                                <?php if($expense->paymentmode != '0' && !empty($expense->paymentmode)){
                                 ?>
                                <span class="text-muted"><?php echo _l('expense_paid_via',$expense->payment_mode_name); ?></span>
                                <?php } ?>
                                <?php if($expense->tax != 0){
                                    echo '<br /><span class="bold">'._l('expense_tax') .'</span> ' . $expense->taxrate . ' ('.$expense->tax_name.')';
                                    $total = $expense->amount;
                                    $_total = ($total / 100 * $expense->taxrate);
                                    $total += $_total;
                                    echo ' - ' . format_money($total,$expense->currency_data->symbol);
                                    }
                                    ?>
                                <?php if($expense->billable == 1){
                                    echo '<br />';
                                    echo '<br />';
                                    if($expense->invoiceid == NULL){
                                      echo '<span class="text-danger">'._l('expense_invoice_not_created').'</span>';
                                    } else {
                                      if($invoice->status == 2){
                                        echo '<span class="text-success">'._l('expense_billed').'</span>';
                                      } else {
                                        echo '<span class="text-danger">'._l('expense_not_billed').'</span>';
                                      }
                                    }
                                    } ?>
                            </p>
                            <p><span class="bold"><?php echo _l('expense_date'); ?></span> <span class="text-muted"><?php echo _d($expense->date); ?></span></p>
                            <br />
                            <br />
                            <p class="bold"><?php echo _l('expense_ref_noe'); ?> <span class="text-muted"><?php echo $expense->reference_no; ?></span></p>
                            <?php if($expense->clientid != 0){ ?>
                            <p class="bold"><?php echo _l('expense_customer'); ?></p>
                            <p><a href="<?php echo admin_url('clients/client/'.$expense->clientid); ?>"><?php echo $expense->company; ?></a></p>
                            <?php } ?>
                            <?php if($expense->project_id != 0){ ?>
                             <p class="bold"><?php echo _l('project'); ?></p>
                            <p><a href="<?php echo admin_url('projects/view/'.$expense->project_id); ?>"><?php echo $expense->project_data->name; ?></a></p>
                                <?php } ?>
                            <?php
                                $custom_fields = get_custom_fields('expenses');
                                foreach($custom_fields as $field){ ?>
                            <?php $value = get_custom_field_value($expense->expenseid,$field['id'],'expenses');
                                if($value == ''){continue;} ?>
                            <div class="row mbot10">
                                <div class="col-md-12 mtop5">
                                    <span class="bold"><?php echo ucfirst($field['name']); ?></span>
                                    <br />
                                    <div class="text-left">
                                        <?php echo $value; ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if($expense->note != ''){ ?>
                            <p class="bold"><?php echo _l('expense_note'); ?></p>
                            <p class="text-muted"><?php echo $expense->note; ?></p>
                            <?php } ?>
                        </div>
                        <div class="col-md-6">
                            <h4 class="bold text-success no-margin"><?php echo _l('expense_receipt'); ?></h4>
                            <hr />
                            <?php if(empty($expense->attachment)) { ?>
                            <?php echo form_open('admin/expenses/add_expense_attachment/'.$expense->expenseid,array('class'=>'mtop10 dropzone dropzone-expense-preview dropzone-manual','id'=>'expense-receipt-upload')); ?>
                            <div id="dropzoneDragArea" class="dz-default dz-message">
                                <span><?php echo _l('expense_add_edit_attach_receipt'); ?></span>
                            </div>
                            <?php echo form_close(); ?>
                            <?php }  else { ?>
                            <div class="row">
                                <div class="col-md-10">
                                    <i class="<?php echo get_mime_class($expense->filetype); ?>"></i> <a href="<?php echo site_url('download/file/expense/'.$expense->expenseid); ?>"> <?php echo $expense->attachment; ?></a>
                                </div>
                                <?php if(has_permission('expenses','','delete')){ ?>
                                <div class="col-md-2 text-right">
                                    <a class="_delete text-danger" href="<?php echo admin_url('expenses/delete_expense_attachment/'.$expense->expenseid .'/'.'preview'); ?>" class="text-danger"><i class="fa fa fa-times"></i></a>
                                </div>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane ptop10" id="tab_tasks">
                    <?php init_relation_tasks_table(array('data-new-rel-id'=>$expense->expenseid,'data-new-rel-type'=>'expense')); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    init_btn_with_tooltips();
    init_rel_tasks_table(<?php echo $expense->expenseid; ?>,'expense');
    if($('#dropzoneDragArea').length > 0){
      var expenseDropzone = new Dropzone("#expense-receipt-upload", {
        clickable: '#dropzoneDragArea',
        maxFiles: 1,
        acceptedFiles:allowed_files,
        dictDefaultMessage:drop_files_here_to_upload,
        dictFallbackMessage:browser_not_support_drag_and_drop,
        dictRemoveFile:remove_file,
        dictMaxFilesExceeded:you_can_not_upload_any_more_files,
        success:function(file,response){
          init_expense(<?php echo $expense->expenseid; ?>);
        },
        error:function(file,response){
          alert_float('danger',response);
        },
      });
    }
</script>
