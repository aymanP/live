<?php if(isset($client)){ ?>
<?php if(has_permission('projects','','create')){ ?>
        <a href="<?php echo admin_url('projects/project?customer_id='.$client->userid); ?>" class="btn btn-info"><?php echo _l('new_project'); ?></a>
<?php } ?>
<?php render_datatable(array(
    _l('project_name'),
    _l('project_customer'),
    _l('project_start_date'),
    _l('project_deadline'),
    _l('project_status'),
    _l('project_billing_type'),
    _l('project_datecreated'),
    _l('options')
    ),'projects-single-client'); ?>
    <?php } ?>
