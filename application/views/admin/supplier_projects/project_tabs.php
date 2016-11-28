<ul class="nav nav-tabs no-margin" role="tablist">
    <li class="active">
        <a data-group="project_overview" href="<?php echo admin_url('supplier_projects/view/'.$project->id.'?group=project_overview'); ?>" role="tab"><i class="fa fa-th" aria-hidden="true"></i> <?php echo _l('project_overview'); ?></a>
    </li>
    <li>
        <a data-group="project_tasks" href="<?php echo admin_url('supplier_projects/view/'.$project->id.'?group=project_tasks'); ?>" role="tab"><i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo _l('tasks'); ?></a>
    </li>
    <li>
        <a data-group="project_files" href="<?php echo admin_url('supplier_projects/view/'.$project->id.'?group=project_files'); ?>" role="tab"><i class="fa fa-files-o" aria-hidden="true"></i> <?php echo _l('project_files'); ?></a>
    </li>
    <li>
        <a data-group="project_gantt" href="<?php echo admin_url('supplier_projects/view/'.$project->id.'?group=project_gantt'); ?>" role="tab"><i class="fa fa-line-chart" aria-hidden="true"></i> <?php echo _l('project_gant'); ?></a>
    </li>
    <li>
        <a data-group="project_milestones" href="<?php echo admin_url('supplier_projects/view/'.$project->id.'?group=project_milestones'); ?>" role="tab"><i class="fa fa-rocket" aria-hidden="true"></i> <?php echo _l('project_milestones'); ?></a>
    </li>
    <li>
        <a data-group="project_timesheets" href="<?php echo admin_url('supplier_projects/view/'.$project->id.'?group=project_timesheets'); ?>" role="tab"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo _l('project_timesheets'); ?></a>
    </li>
<!--    <li>-->
<!--        <a data-group="project_discussions" href="--><?php //echo admin_url('supplier_projects/view/'.$project->id.'?group=project_discussions'); ?><!--" role="tab"><i class="fa fa-commenting" aria-hidden="true"></i> --><?php //echo _l('project_discussions'); ?><!--</a>-->
<!--    </li>-->
<!--    --><?php //if((get_option('access_tickets_to_none_staff_members') == 1 && !is_staff_member()) || is_staff_member()){ ?>
<!--    <li>-->
<!--        <a data-group="project_tickets" href="--><?php //echo admin_url('supplier_projects/view/'.$project->id.'?group=project_tickets'); ?><!--" role="tab"><i class="fa fa-life-ring" aria-hidden="true"></i> --><?php //echo _l('project_tickets'); ?><!--</a>-->
<!--    </li>-->
<!--    --><?php //} ?>
    <?php if(has_permission('invoices','','view')){ ?>
    <li>
        <a data-group="project_invoices" href="<?php echo admin_url('supplier_projects/view/'.$project->id.'?group=project_invoices'); ?>" role="tab"><i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo _l('project_invoices'); ?></a>
    </li>
    <?php } ?>
    <?php if(has_permission('estimates','','view')){ ?>
<!--    <li>-->
<!--        <a data-group="project_estimates" href="--><?php //echo admin_url('supplier_projects/view/'.$project->id.'?group=project_estimates'); ?><!--" role="tab"><i class="fa fa-sun-o" aria-hidden="true"></i> --><?php //echo _l('project_estimates'); ?><!--</a>-->
<!--    </li>-->
    <?php } ?>

<!--    --><?php //if(has_permission( 'expenses','','create') || has_permission('expenses','','view')){ ?>
<!--    <li>-->
<!--        <a data-group="project_expenses" href="--><?php //echo admin_url('supplier_projects/view/'.$project->id.'?group=project_expenses'); ?><!--" role="tab"><i class="fa fa-sort-amount-asc" aria-hidden="true"></i> --><?php //echo _l('project_expenses'); ?><!--</a>-->
<!--    </li>-->
<!--    --><?php //} ?>
    <li>
        <a data-group="project_notes" href="<?php echo admin_url('supplier_projects/view/'.$project->id.'?group=project_notes'); ?>" role="tab"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo _l('project_notes'); ?></a>
    </li>
     <?php if(has_permission('projects','','create')){ ?>
    <li>
        <a data-group="project_activity" href="<?php echo admin_url('supplier_projects/view/'.$project->id.'?group=project_activity'); ?>" role="tab"><i class="fa fa-exclamation" aria-hidden="true"></i> <?php echo _l('project_activity'); ?></a>
    </li>
    <?php } ?>
</ul>
