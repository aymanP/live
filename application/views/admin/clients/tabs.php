<ul class="nav nav-tabs no-margin" role="tablist">
    <?php if(isset($client)){ ?>
    <li>
        <div class="btn-group pull-left btn-customer-options">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-cog"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-left">
            <?php if(has_permission('customers','','create') || is_customer_admin($client->userid)){ ?>
                <li>
                    <a href="<?php echo admin_url('clients/login_as_client/'.$client->userid); ?>" target="_blank">
                    <i class="fa fa-share-square-o"></i> <?php echo _l('login_as_client'); ?>
                    </a>
                </li>
            <?php } ?>
                <?php if(has_permission('customers','','delete')){ ?>
                <li>
                    <a href="<?php echo admin_url('clients/delete/'.$client->userid); ?>" class="text-danger delete-text _delete" data-toggle="tooltip" data-title="<?php echo _l('client_delete_tooltip'); ?>" data-placement="bottom"><i class="fa fa-remove"></i> <?php echo _l('delete'); ?>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </li>
    <?php } ?>
    <li class="active">
        <?php
            $url_profile = admin_url('clients/client');
              if(isset($client)){
                 $url_profile = admin_url('clients/client/'.$client->userid.'?group=profile');
              }
            ?>
        <a href="<?php echo $url_profile; ?>" data-group="profile">
        <?php echo _l( 'client_add_edit_profile'); ?>
        </a>
    </li>
    <?php if(isset($client)) { ?>

    <?php if(has_permission('invoices','','view')){ ?>
    <li>
        <a href="<?php echo admin_url('clients/client/'.$client->userid.'?group=invoices'); ?>" data-group="invoices">
        <?php echo _l( 'client_invoices_tab'); ?>
        </a>
    </li>
    <li>
        <?php } ?>
        <?php if(has_permission('estimates','','view')){ ?>
        <a href="<?php echo admin_url('clients/client/'.$client->userid.'?group=estimates'); ?>" data-group="estimates">
        <?php echo _l( 'client_estimates_tab'); ?>
        </a>
    </li>
    <?php } ?>
     <?php if(has_permission('proposals','','view')){ ?>
    <li>
        <a href="<?php echo admin_url('clients/client/'.$client->userid.'?group=proposals'); ?>" data-group="proposals">
        <?php echo _l( 'proposals'); ?>
        </a>
    </li>
    <?php } ?>
     <?php if(has_permission('expenses','','view')){ ?>
    <li>
        <a href="<?php echo admin_url('clients/client/'.$client->userid.'?group=expenses'); ?>" data-group="expenses">
        <?php echo _l( 'client_expenses_tab'); ?>
        </a>
    </li>
    <?php } ?>
    <?php if(has_permission('payments','','view')){ ?>
    <li>
        <a href="<?php echo admin_url('clients/client/'.$client->userid.'?group=payments'); ?>" data-group="payments">
        <?php echo _l( 'client_payments_tab'); ?>
        </a>
    </li>
    <?php } ?>
    <li>
        <a href="<?php echo admin_url('clients/client/'.$client->userid.'?group=projects'); ?>" data-group="projects">
        <?php echo _l( 'projects'); ?>
        </a>
    </li>

    <?php if(has_permission('contracts','','view')){ ?>
    <li>
        <a href="<?php echo admin_url('clients/client/'.$client->userid.'?group=contracts'); ?>" data-group="contracts">
        <?php echo _l( 'contracts_invoices_tab'); ?>
        </a>
    </li>
    <?php } ?>
    <?php if((get_option('access_tickets_to_none_staff_members') == 1 && !is_staff_member()) || is_staff_member()){ ?>
    <li>
        <a href="<?php echo admin_url('clients/client/'.$client->userid.'?group=tickets'); ?>" data-group="tickets">
        <?php echo _l( 'contracts_tickets_tab'); ?>
        </a>
    </li>
    <?php } ?>
    <li>
        <a href="<?php echo admin_url('clients/client/'.$client->userid.'?group=tasks'); ?>" data-group="tasks">
        <?php echo _l( 'tasks'); ?>
        </a>
    </li>
    <li>
        <a href="<?php echo admin_url('clients/client/'.$client->userid.'?group=reminders'); ?>" data-group="reminders">
        <?php echo _l( 'client_reminders_tab'); ?>
        </a>
    </li>

    <li>
        <a href="<?php echo admin_url('clients/client/'.$client->userid.'?group=attachments'); ?>" data-group="attachments">
        <?php echo _l( 'customer_attachments'); ?>
        </a>
    </li>
    <li>
        <a href="<?php echo admin_url('clients/client/'.$client->userid.'?group=map'); ?>" data-group="map">
        <?php echo _l( 'customer_map'); ?>
        </a>
    </li>
    <li>
        <a href="<?php echo admin_url('clients/client/'.$client->userid.'?group=notes'); ?>" data-group="notes">
        <?php echo _l( 'contracts_notes_tab'); ?>
        </a>
    </li>
    <?php } ?>
</ul>
