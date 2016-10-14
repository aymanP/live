    <a href="#" onclick="new_timesheet();return false;" class="btn btn-info"><?php echo _l('record_timesheet'); ?></a>
    <?php render_datatable(array(
        _l('project_timesheet_user'),
        _l('project_timesheet_task'),
        _l('project_timesheet_start_time'),
        _l('project_timesheet_end_time'),
        _l('project_timesheet_time_spend'),
        _l('options')
        ),'timesheets'); ?>
