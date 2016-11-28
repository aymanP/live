<?php
/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 07/11/2016
 * Time: 11:08
 */
?>
<ul class="nav nav-tabs no-margin" role="tablist">
    <?php if(isset($supplier)){ ?>
        <li>
            <div class="btn-group pull-left btn-customer-options">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-left">
                    <?php if(has_permission('suppliers','','create') || is_supplier_admin($supplier->supplierid)){ ?>
                        <li>
                            <a href="<?php echo admin_url('suppliers/login_as_supplier/'.$supplier->supplierid); ?>" target="_blank">
                                <i class="fa fa-share-square-o"></i> <?php echo _l('login_as_supplier'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if(has_permission('suppliers','','delete')){ ?>
                        <li>
                            <a href="<?php echo admin_url('suppliers/delete/'.$supplier->supplierid); ?>" class="text-danger delete-text _delete" data-toggle="tooltip" data-title="<?php echo _l('supplier_delete_tooltip'); ?>" data-placement="bottom"><i class="fa fa-remove"></i> <?php echo _l('delete'); ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </li>
    <?php } ?>
    <li class="active">
        <?php
        $url_profile = admin_url('suppliers/supplier');
        if(isset($supplier)){
            $url_profile = admin_url('suppliers/supplier/'.$supplier->supplierid.'?group=profile');
        }
        ?>
        <a href="<?php echo $url_profile; ?>" data-group="profile">
            <?php echo _l( 'supplier_add_edit_profile'); ?>
        </a>
    </li>
    <?php if(isset($supplier)) { ?>

        <?php if(has_permission('invoices','','view')){ ?>
            <li>
                <a href="<?php echo admin_url('suppliers/supplier/'.$supplier->supplierid.'?group=invoices'); ?>" data-group="invoices">
                    <?php echo _l( 'supplier_invoices_tab'); ?>
                </a>
            </li>
        <?php } ?>
<!--        --><?php //if(has_permission('expenses','','view')){ ?>
<!--            <li>-->
<!--                <a href="--><?php //echo admin_url('suppliers/supplier/'.$supplier->supplierid.'?group=expenses'); ?><!--" data-group="expenses">-->
<!--                    --><?php //echo _l( 'supplier_expenses_tab'); ?>
<!--                </a>-->
<!--            </li>-->
<!--        --><?php //} ?>
<!--        --><?php //if(has_permission('payments','','view')){ ?>
<!--            <li>-->
<!--                <a href="--><?php //echo admin_url('suppliers/supplier/'.$supplier->supplierid.'?group=payments'); ?><!--" data-group="payments">-->
<!--                    --><?php //echo _l( 'supplier_payments_tab'); ?>
<!--                </a>-->
<!--            </li>-->
<!--        --><?php //} ?>
        <li>
            <a href="<?php echo admin_url('suppliers/supplier/'.$supplier->supplierid.'?group=projects'); ?>" data-group="projects">
                <?php echo _l( 'projects'); ?>
            </a>
        </li>

<!--        --><?php //if(has_permission('contracts','','view')){ ?>
<!--            <li>-->
<!--                <a href="--><?php //echo admin_url('suppliers/supplier/'.$supplier->supplierid.'?group=contracts'); ?><!--" data-group="contracts">-->
<!--                    --><?php //echo _l( 'contracts_invoices_tab'); ?>
<!--                </a>-->
<!--            </li>-->
<!--        --><?php //} ?>
<!--        --><?php //if((get_option('access_tickets_to_none_staff_members') == 1 && !is_staff_member()) || is_staff_member()){ ?>
<!--            <li>-->
<!--                <a href="--><?php //echo admin_url('suppliers/supplier/'.$supplier->supplierid.'?group=tickets'); ?><!--" data-group="tickets">-->
<!--                    --><?php //echo _l( 'contracts_tickets_tab'); ?>
<!--                </a>-->
<!--            </li>-->
<!--        --><?php //} ?>
<!--        <li>-->
<!--            <a href="--><?php //echo admin_url('suppliers/supplier/'.$supplier->supplierid.'?group=tasks'); ?><!--" data-group="tasks">-->
<!--                --><?php //echo _l( 'tasks'); ?>
<!--            </a>-->
<!--        </li>-->
<!--        <li>-->
<!--            <a href="--><?php //echo admin_url('suppliers/supplier/'.$supplier->supplierid.'?group=reminders'); ?><!--" data-group="reminders">-->
<!--                --><?php //echo _l( 'client_reminders_tab'); ?>
<!--            </a>-->
<!--        </li>-->

        <li>
            <a href="<?php echo admin_url('suppliers/supplier/'.$supplier->supplierid.'?group=attachments'); ?>" data-group="attachments">
                <?php echo _l( 'supplier_attachments'); ?>
            </a>
        </li>
<!--        <li>-->
<!--            <a href="--><?php //echo admin_url('suppliers/supplier/'.$supplier->supplierid.'?group=notes'); ?><!--" data-group="notes">-->
<!--                --><?php //echo _l( 'contracts_notes_tab'); ?>
<!--            </a>-->
<!--        </li>-->
    <?php } ?>
</ul>

