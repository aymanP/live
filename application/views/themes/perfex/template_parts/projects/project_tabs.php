<ul class="nav nav-tabs no-margin" role="tablist">
    <li role="presentation" class="active">
        <a data-group="project_overview" href="<?php echo site_url('clients/project/'.$project->id.'?group=project_overview'); ?>" role="tab"><i class="fa fa-th" aria-hidden="true"></i> <?php echo _l('project_overview'); ?></a>
    </li>
    <li>
        <a data-group="project_purchases" href="<?php echo site_url('clients/project/'.$project->id.'?group=project_purchases'); ?>" role="tab"><i class="fa fa-files-o" aria-hidden="true"></i> <?php echo _l('project_purchase'); ?></a>
    </li>
    <?php if($project->settings->view_tasks == 1){ ?>
    <li role="presentation">
        <a data-group="project_tasks" href="<?php echo site_url('clients/project/'.$project->id.'?group=project_tasks'); ?>" role="tab"><i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo _l('tasks'); ?></a>
    </li>
    <?php } ?>
    <li role="presentation">
        <a data-group="project_files" href="<?php echo site_url('clients/project/'.$project->id.'?group=project_files'); ?>" role="tab"><i class="fa fa-files-o" aria-hidden="true"></i> <?php echo _l('project_files'); ?></a>
    </li>
    <?php if($project->settings->view_gantt == 1){ ?>
    <li role="presentation">
        <a data-group="project_gantt" href="<?php echo site_url('clients/project/'.$project->id.'?group=project_gantt'); ?>" role="tab"><i class="fa fa-line-chart" aria-hidden="true"></i> <?php echo _l('project_gant'); ?></a>
    </li>
    <?php } ?>
    <?php if($project->settings->view_milestones == 1){ ?>
    <li role="presentation">
        <a data-group="project_milestones" href="<?php echo site_url('clients/project/'.$project->id.'?group=project_milestones'); ?>" role="tab"><i class="fa fa-rocket" aria-hidden="true"></i> <?php echo _l('project_milestones'); ?></a>
    </li>
    <?php } ?>
    <?php if($project->settings->view_timesheets == 1){ ?>
    <li role="presentation">
        <a data-group="project_timesheets" href="<?php echo site_url('clients/project/'.$project->id.'?group=project_timesheets'); ?>" role="tab"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo _l('project_timesheets'); ?></a>
    </li>
    <?php } ?>
     <?php if(has_contact_permission('support')){ ?>
    <li role="presentation">
        <a data-group="project_tickets" href="<?php echo site_url('clients/project/'.$project->id.'?group=project_tickets'); ?>" role="tab"><i class="fa fa-life-ring" aria-hidden="true"></i> <?php echo _l('project_tickets'); ?></a>
    </li>
    <?php } ?>
    <li role="presentation">
        <a data-group="project_discussions" href="<?php echo site_url('clients/project/'.$project->id.'?group=project_discussions'); ?>" role="tab"><i class="fa fa-commenting" aria-hidden="true"></i> <?php echo _l('project_discussions'); ?></a>
    </li>
     <?php if(has_contact_permission('invoices')){ ?>
    <li role="presentation">
        <a data-group="project_invoices" href="<?php echo site_url('clients/project/'.$project->id.'?group=project_invoices'); ?>" role="tab"><i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo _l('project_invoices'); ?></a>
    </li>
    <?php } ?>

    <?php if(has_contact_permission('estimates')){ ?>
    <li role="presentation">
        <a data-group="project_estimates" href="<?php echo site_url('clients/project/'.$project->id.'?group=project_estimates'); ?>" role="tab"><i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo _l('project_estimates'); ?></a>
    </li>
    <?php } ?>
     <?php if($project->settings->view_activity_log == 1){ ?>
      <li role="presentation">
        <a data-group="project_activity" href="<?php echo site_url('clients/project/'.$project->id.'?group=project_activity'); ?>" role="tab"><i class="fa fa-exclamation" aria-hidden="true"></i> <?php echo _l('project_activity'); ?></a>
    </li>
     <?php } ?>

</ul>
