<div class="col-md-12 task-single-col no-padding">
    <div class="panel_s">
        <div class="panel-body">
            <?php if($task->finished == 1){
                echo '<div class="ribbon success"><span>'._l('task_finished').'</span></div>';
                } ?>
            <div class="row padding-5 task-info-wrapper">
                <div class="col-md-12">
                    <div class="label label-<?php echo get_task_priority_class($task->priority); ?> task-info pull-left">
                        <h5 class="no-margin"><i class="fa pull-left fa-bolt"></i>
                            <?php echo _l('task_single_priority'); ?>: <?php echo task_priority($task->priority); ?>
                        </h5>
                    </div>
                    <div class="label <?php if(date('Y-m-d') > $task->startdate && total_rows('tbltaskstimers',array('task_id'=>$task->id)) == 0 && $task->finished != 1){echo 'label-danger';}else{echo 'label-default';} ?> mleft10 task-info pull-left">
                        <h5 class="no-margin"><i class="fa pull-left fa-margin"></i>
                            <?php echo _l('task_single_start_date'); ?>: <?php echo _d($task->startdate); ?>
                        </h5>
                    </div>
                    <div class="label mleft10 task-info pull-left <?php if(!$task->finished){echo ' label-danger'; }else{echo 'label-info';} ?><?php if(!$task->duedate){ echo ' hide';} ?>">
                        <h5 class="no-margin"><i class="fa pull-left fa-calendar"></i>
                            <?php echo _l('task_single_due_date'); ?>: <?php echo _d($task->duedate); ?>
                        </h5>
                    </div>
                    <?php if($task->finished == 1){ ?>
                    <div class="label mleft10 pull-left task-info label-success" data-toggle="tooltip" data-title="<?php echo _dt($task->datefinished); ?>" data-placement="bottom">
                        <h5 class="no-margin"><i class="fa pull-left fa-check"></i>
                            <?php echo _l('task_single_finished'); ?>: <?php echo time_ago($task->datefinished); ?>
                        </h5>
                    </div>
                    <?php } ?>
                    <button type="button" class="close task-m-close custom-close-btn" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        </div>
        <div class="panel_s">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="title-wrapper pull-left">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="no-margin">
                                                <?php echo $task->name; ?>
                                            </h3>
                                        </div>
                                        <?php if($task->billed == 1){ ?>
                                        <div class="col-md-12">
                                            <?php  echo '<p class="text-success no-margin">'._l('task_is_billed','<a href="'.admin_url('invoices/list_invoices/'.$task->invoice_id).'" target="_blank">'.format_invoice_number($task->invoice_id)). '</a></p>'; ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php if($task->is_public == 0){ ?>
                                    <div class="clearfix"></div>
                                    <small class="text-muted no-margin<?php if($task->rel_type == 'project'){echo ' hide';} ?>">
                                    <?php echo _l('task_is_private'); ?>
                                    <?php if(has_permission('tasks','','edit')) { ?> -
                                    <a href="#" onclick="make_task_public(<?php echo $task->id; ?>); return false;">
                                    <?php echo _l('task_view_make_public'); ?>
                                    </a>
                                    <?php } ?>
                                    </small>
                                    <?php } ?>
                                    <?php if($this->tasks_model->is_task_assignee(get_staff_user_id(),$task->id)){
                                        foreach($task->assignees as $assignee){
                                            if($assignee['assigneeid'] == get_staff_user_id() && get_staff_user_id() != $assignee['assigned_from'] && $assignee['assigned_from'] != 0){
                                                echo '<br /><small class="text-muted">'._l('task_assigned_from','<a href="'.admin_url('profile/'.$assignee['assigned_from']).'" target="_blank">'.get_staff_full_name($assignee['assigned_from'])).'</a></small>';
                                                break;
                                            }
                                        }
                                     } ?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <hr />
                                    <div class="col-md-12">
                                       <?php if($task->finished == 0){ ?>
                                        <p class="no-margin pull-left" style="margin-right:5px !important;">
                                            <a href="#" class="btn btn-default" onclick="mark_complete(<?php echo $task->id; ?>); return false;" data-toggle="tooltip" title="<?php echo _l('task_single_mark_as_complete'); ?>">
                                                <i class="fa fa-check"></i>
                                            </a>
                                        </p>
                                        <?php } else if($task->finished == 1){ ?>
                                            <p class="no-margin pull-left" style="margin-right:5px !important;">
                                                <a href="#" class="btn btn-success" onclick="unmark_complete(<?php echo $task->id; ?>); return false;" data-toggle="tooltip" title="<?php echo _l('task_unmark_as_complete'); ?>">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </p>
                                            <?php } ?>
                                        <?php if(has_permission('tasks','','create')){ ?>
                                        <p class="no-margin pull-left mright5">
                                            <a href="#" class="btn btn-default mright5" data-toggle="tooltip" data-title="<?php echo _l('task_statistics'); ?>" onclick="task_tracking_stats(<?php echo $task->id; ?>); return false;">
                                            <i class="fa fa-bar-chart"></i>
                                            </a>
                                        </p>
                                        <?php } ?>
                                        <p class="no-margin pull-left mright5">
                                            <a href="#" class="btn btn-default mright5" data-toggle="tooltip" data-title="<?php echo _l('task_timesheets'); ?>"onclick="slideToggle('#task_single_timesheets'); return false;">
                                            <i class="fa fa-th-list"></i>
                                            </a>
                                        </p>
                                        <?php if($task->billed == 0){
                                            $is_assigned = $this->tasks_model->is_task_assignee(get_staff_user_id(),$task->id);
                                            if(!$this->tasks_model->is_timer_started($task->id)) { ?>
                                        <p class="no-margin pull-left"<?php if(!$is_assigned){ ?> data-toggle="tooltip" data-title="<?php echo _l('task_start_timer_only_assignee'); ?>"<?php } ?>>
                                            <a href="#" class="mbot10 btn<?php if(!$is_assigned){echo ' disabled btn-default';}else {echo ' btn-success';} ?>" onclick="timer_action(this,<?php echo $task->id; ?>); return false;">
                                            <i class="fa fa-clock-o"></i> <?php echo _l('task_start_timer'); ?>
                                            </a>
                                        </p>
                                        <?php } else { ?>
                                        <p class="no-margin pull-left">
                                            <a href="#" class="btn mbot10 btn-danger<?php if(!$is_assigned){echo ' disabled';} ?>" onclick="timer_action(this,<?php echo $task->id; ?>,<?php echo $this->tasks_model->get_last_timer($task->id)->id; ?>); return false;">
                                            <i class="fa fa-clock-o"></i> <?php echo _l('task_stop_timer'); ?>
                                            </a>
                                        </p>
                                        <?php } ?>
                                        <?php } ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                        <?php if($this->tasks_model->is_task_assignee(get_staff_user_id(),$task->id) || total_rows('tbltaskstimers',array('task_id'=>$task->id,'staff_id'=>get_staff_user_id())) > 0){ ?>
                                        <p class="task-time-logged">
                                            <span class="text-muted"><?php echo _l('task_user_logged_time'); ?></span>
                                            <b>
                                            <?php echo format_seconds($this->tasks_model->calc_task_total_time($task->id,' AND staff_id='.get_staff_user_id())); ?>
                                            </b>
                                        </p>
                                        <?php } ?>
                                        <?php if(has_permission('tasks','','create')){ ?>
                                        <p class="task-time-logged">
                                            <span class="text-success"><?php echo _l('task_total_logged_time'); ?></span>
                                            <b>
                                            <?php echo format_seconds($this->tasks_model->calc_task_total_time($task->id)); ?>
                                            </b>
                                        </p>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <?php echo form_open_multipart('admin/tasks/upload_file',array('id'=>'task-attachment','class'=>'inline-block')); ?>
                                    <?php echo form_close(); ?>
                                </div>

                                <?php
                                    if(!empty($task->rel_id)){
                                      echo '<div class="task-single-related-wrapper">';
                                      echo '<hr />';
                                      $task_rel_data = get_relation_data($task->rel_type,$task->rel_id);
                                      $task_rel_value = get_relation_values($task_rel_data,$task->rel_type);
                                      echo '<h4 class="bold">'._l('task_single_related').': <a href="'.$task_rel_value['link'].'">'.$task_rel_value['name'].'</a></h4>';
                                      echo '</div>';
                                    }
                                    ?>
                                <hr />
                                <div class="row">
                                    <div class="col-md-3 mtop5">
                                        <i class="fa fa-users"></i> <span class="bold"><?php echo _l('task_single_assignees'); ?></span>
                                    </div>
                                    <div class="col-md-9" id="assignees">
                                        <?php
                                            $_assignees = '';
                                            foreach ($task->assignees as $assignee) {
                                              $_remove_assigne = '';
                                              if(has_permission('tasks','','edit') || has_permission('tasks','','create')){
                                                $_remove_assigne = ' <a href="#" class="remove-task-user" onclick="remove_assignee(' . $assignee['id'] . ',' . $task->id . '); return false;"><i class="fa fa-remove"></i></a>';
                                            }
                                            $_assignees .= '
                                            <span class="task-user" data-toggle="tooltip" data-title="'.get_staff_full_name($assignee['assigneeid']).'">
                                                <a href="' . admin_url('profile/' . $assignee['assigneeid']) . '">' . staff_profile_image($assignee['assigneeid'], array(
                                                  'staff-profile-image-small'
                                                  )) .'</a> ' . $_remove_assigne . '</span>
                                            </span>';
                                            }

                                            if ($_assignees == '') {
                                            $_assignees = '<div class="bold mtop5 text-danger task-connectors-no-indicator display-block">'._l('task_no_assignees').'</div>';
                                            }
                                            echo $_assignees;
                                            ?>
                                    </div>
                                </div>
                                <?php if(count($task->followers) > 0){ ?>
                                <div class="row mtop30">
                                    <div class="col-md-3 mtop5">
                                        <i class="fa fa-transgender"></i> <span class="bold"><?php echo _l('task_single_followers'); ?></span>
                                    </div>
                                    <div class="col-md-9" id="followers">
                                        <?php
                                            $_followers        = '';
                                            foreach ($task->followers as $follower) {
                                              $_remove_follower = '';
                                              if(has_permission('tasks','','edit') || has_permission('tasks','','create')){
                                                $_remove_follower = ' <a href="#" class="remove-task-user" onclick="remove_follower(' . $follower['id'] . ',' . $task->id . '); return false;"><i class="fa fa-remove"></i></a>';
                                            }
                                            $_followers .= '
                                            <span class="task-user" data-toggle="tooltip" data-title="'.get_staff_full_name($follower['followerid']).'">
                                                <a href="' . admin_url('profile/' . $follower['followerid']) . '">' . staff_profile_image($follower['followerid'], array(
                                                  'staff-profile-image-small'
                                                  )) . '</a> ' . $_remove_follower . '</span>
                                            </span>';
                                            }
                                            if ($_followers == '') {
                                            $_followers = '<div class="bold mtop5 task-connectors-no-indicator display-block">'._l('task_no_followers').'</div>';
                                            }
                                            echo $_followers;
                                            ?>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-md-3">
                                <?php if(has_permission('tasks','','edit') || has_permission('tasks','','create')){ ?>
                                <div class="text-left">
                                    <select data-width="100%" id="add_task_assignees" class="text-muted task-action-select selectpicker<?php if(total_rows('tblstafftaskassignees',array('taskid'=>$task->id)) == 0){echo 'task-assignees-dropdown-indicator';} ?>" name="select-assignees" data-live-search="true" title='<?php echo _l('task_single_assignees_select_title'); ?>' data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>"></select>
                                </div>
                                <?php } ?>
                                <?php if(has_permission('tasks','','edit') || has_permission('tasks','','create')){ ?>
                                <div class="text-left">
                                    <select data-width="100%" class="text-muted selectpicker task-action-select mtop10" name="select-followers" data-live-search="true" title='<?php echo _l('task_single_followers_select_title'); ?>' data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>"></select>
                                </div>
                                <?php } ?>
                                <a href="#" onclick="add_task_checklist_item(); return false">
                                <span class="label mtop10 label-default label-task-action new-checklist-item"><i class="fa fa-plus-circle pull-left"></i>
                                <?php echo _l('add_checklist_item'); ?>
                                </span>
                                </a>
                                <a href="#" class="add-task-attachments">
                                <span class="label mtop10 label-default label-task-action"><i class="fa fa-paperclip pull-left"></i>
                                <?php echo _l('add_task_attachments'); ?>
                                </span>
                                </a>
                                <?php if(has_permission('tasks','','create')){ ?>
                                <?php
                                    $copy_template = "";
                                    if(total_rows('tblstafftaskassignees',array('taskid'=>$task->id)) > 0){
                                        $copy_template .= "<div class='checkbox checkbox-primary'><input type='checkbox' name='copy_task_assignees' id='copy_task_assignees'><label for='copy_task_assignees'>"._l('task_single_assignees')."</label></div>";
                                    }
                                    if(total_rows('tblstafftasksfollowers',array('taskid'=>$task->id)) > 0){
                                       $copy_template .= "<div class='checkbox checkbox-primary'><input type='checkbox' name='copy_task_followers' id='copy_task_followers'><label for='copy_task_followers'>"._l('task_single_followers')."</label></div>";
                                    }
                                    if(total_rows('tbltaskchecklists',array('taskid'=>$task->id)) > 0){
                                     $copy_template .= "<div class='checkbox checkbox-primary'><input type='checkbox' name='copy_task_checklist_items' id='copy_task_checklist_items'><label for='copy_task_checklist_items'>"._l('task_checklist_items')."</label></div>";
                                    }
                                    if(total_rows('tblstafftasksattachments',array('taskid'=>$task->id)) > 0){
                                    $copy_template .= "<div class='checkbox checkbox-primary'><input type='checkbox' name='copy_task_attachments' id='copy_task_attachments'><label for='copy_task_attachments'>"._l('task_view_attachments')."</label></div>";
                                    }
                                    $copy_template .= "<div class='text-center'>";
                                    $copy_template .= "<button type='button' data-task-copy-from='".$task->id."' class='btn btn-success copy_task_action'>"._l('copy_task_confirm')."</button>";
                                    $copy_template .= "</div>";
                                    ?>
                                <a href="#" onclick="return false;" data-placement="bottom" data-toggle="popover" data-content="<?php echo $copy_template; ?>" data-html="true"><span class="label mtop10 label-default label-task-action"><i class="fa fa-clone pull-left"></i> <?php echo _l('task_copy'); ?></span></a>
                                <?php } ?>
                                <?php if(has_permission('tasks','','edit')) { ?>
                                <a href="#" class="edit_task" onclick="edit_task(<?php echo $id; ?>); return false;">
                                <span class="label label-default label-task-action mtop10">
                                <i class="fa fa-pencil-square pull-left"></i>
                                <?php echo _l('task_single_edit'); ?>
                                </span>
                                </a>
                                <?php } ?>
                                <?php if(has_permission('tasks','','delete')){ ?>
                                <a href="<?php echo admin_url('tasks/delete_task/'.$task->id); ?>">
                                <span class="label label-default mtop10 label-task-action task-delete _delete">
                                <i class="fa fa-remove pull-left"></i>
                                <?php echo _l('task_single_delete'); ?>
                                </span>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr />
                </div>

                <?php
                    $custom_fields = get_custom_fields('tasks');
                    if(count($custom_fields) > 0){ ?>
                <div class="row">
                    <?php foreach($custom_fields as $field){ ?>
                    <?php $value = get_custom_field_value($task->id,$field['id'],'tasks');
                        if($value == ''){continue;} $custom_fields_found = true;?>
                    <div class="col-md-9">
                        <span class="bold"><?php echo ucfirst($field['name']); ?></span>
                        <br />
                        <div class="text-left">
                            <?php echo $value; ?>
                        </div>
                    </div>
                    <?php } ?>
                    <?php
                     // Add separator if custom fields found for output
                     if(isset($custom_fields_found)){?>
                    <div class="clearfix"></div>
                    <hr />
                    <?php } ?>
                </div>
                <?php } ?>

                <div id="task_single_timesheets" class="<?php if(!$this->session->flashdata('task_single_timesheets_open')){echo 'hide';} ?>">
                <div class="table-responsive">
                    <table class="table table-striped">
                     <thead>
                        <tr>
                            <th><?php echo _l('timesheet_user'); ?></th>
                            <th><?php echo _l('timesheet_start_time'); ?></th>
                            <th><?php echo _l('timesheet_end_time'); ?></th>
                            <th><?php echo _l('timesheet_time_spend'); ?></th>
                            <th><?php echo _l('options'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $timers_found = false;
                        foreach($task->timesheets as $timesheet){ ?>
                            <?php if(has_permission('tasks','','edit') || has_permission('tasks','','create') || has_permission('tasks','','delete') || $timesheet['staff_id'] == get_staff_user_id()){
                                $timers_found = true; ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo admin_url('staff/profile/' . $timesheet['staff_id']); ?>" target="_blank"><?php echo staff_profile_image($timesheet['staff_id'], array('staff-profile-xs-image mright5'
                                            )); ?> <?php echo get_staff_full_name($timesheet['staff_id']); ?></a>
                                    </td>
                                    <td><?php echo strftime(get_current_date_format().' %H:%M:%I', $timesheet['start_time']); ?></td>
                                    <td>
                                        <?php if($timesheet['end_time'] !== NULL){
                                         echo strftime(get_current_date_format().' %H:%M:%I', $timesheet['end_time']);
                                     }
                                     ?>
                                 </td>
                                 <td>
                                    <?php
                                    if($timesheet['time_spent'] == NULL){
                                        echo format_seconds(time() - $timesheet['start_time']);
                                    } else {
                                        echo format_seconds($timesheet['time_spent']);
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php echo icon_btn('tasks/delete_timesheet/'.$timesheet['id'], 'remove', 'task-single-delete-timesheet btn-danger',array('data-task-id'=>$task->id)); ?>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                            <?php if($timers_found == false){ ?>
                               <tr>
                                   <td colspan="5" class="text-center bold"><?php echo _l('no_timers_found'); ?></td>
                               </tr>
                               <?php } ?>
                               <?php
                               if($task->billed == 0){ ?>
                                <?php if($is_assigned || count($task->assignees) > 0){

                                   ?>
                                   <tr class="odd">
                                    <td colspan="2">
                                        <label class="control-label">
                                            <?php echo _l('task_single_log_user'); ?>
                                        </label>
                                        <br />
                                        <select name="single_timesheet_staff_id" class="selectpicker">
                                            <?php foreach($task->assignees as $assignee){
                                                if(!has_permission('tasks','','create') && !has_permission('tasks','','edit') && $assignee['assigneeid'] != get_staff_user_id() && $task->rel_type == 'project' && !has_permission('projects','','edit')){continue;}
                                                $selected = '';
                                                if($assignee['assigneeid'] == get_staff_user_id()){
                                                    $selected = ' selected';
                                                }
                                                ?>
                                                <option<?php echo $selected; ?> value="<?php echo $assignee['assigneeid']; ?>" >
                                                <?php echo get_staff_full_name($assignee['assigneeid']); ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td colspan="1">
                                        <?php echo render_datetime_input('timesheet_start_time','task_log_time_start','',array(),array(),'','input-sm'); ?>
                                    </td>
                                    <td colspan="1">
                                        <?php echo render_datetime_input('timesheet_end_time','task_log_time_end','',array(),array(),'','input-sm'); ?>
                                    </td>
                                    <td>
                                        <button data-task-id="<?php echo $task->id; ?>" class="btn btn-success task-single-add-timesheet" style="margin-top:23px"><i class="fa fa-plus"></i></button>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                <?php if(count($task->attachments) > 0){ ?>
                <div class="row">
                    <div class="col-md-12" id="attachments">
                        <h4 class="bold"><?php echo _l('task_view_attachments'); ?></h4>
                        <ul class="list-unstyled">
                            <?php foreach($task->attachments as $attachment){ ?>
                            <li class="mbot10">
                                <i class="<?php echo get_mime_class($attachment['filetype']); ?>"></i>
                                <a href="<?php echo site_url('download/file/taskattachment/'.$attachment['id']); ?>" download>
                                <?php echo $attachment['file_name']; ?>
                                </a>
                                <?php if($attachment['staffid'] == get_staff_user_id() || has_permission('tasks','','delete')){ ?>
                                <a href="#" class="pull-right text-danger" onclick="remove_task_attachment(this,<?php echo $attachment['id']; ?>); return false;">
                                <i class="fa fa fa-times"></i>
                                </a>
                                <?php } ?>
                                <span class="pull-right mright10">
                                    <?php
                                    if($attachment['staffid'] != 0){
                                        echo get_staff_full_name($attachment['staffid']);
                                    } else {
                                        echo get_contact_full_name($attachment['contact_id']);
                                    }
                                    ?>
                                </span>

                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                    <hr />
                </div>
                <?php } ?>
                <div class="row checklist-items-wrapper hide">
                    <div class="col-md-12">
                        <div id="checklist-items" class="">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr />
                </div>
                <div class="row">
                    <div class="col-md-12 mbot30" id="description">
                        <h4 class="bold"><?php echo _l('task_view_description'); ?></h4>
                        <?php echo check_for_links($task->description); ?>
                    </div>
                </div>
                <div class="row">
                   <div class="col-md-12">
                   <a href="#" onclick="slideToggle('.tasks-comments'); return false;" ><h4 class="bold mbot20"><?php echo _l('task_comments'); ?></h4></a>
                </div>
            </div>
                <div class="row tasks-comments" <?php if(count($task->comments) == 0){echo 'style="display:none"';} ?>>
                    <div class="col-md-12">
                        <textarea name="comment" id="task_comment" rows="5" class="form-control mtop15"></textarea>
                        <button type="button" class="btn btn-info mtop10 pull-right" onclick="add_task_comment();">
                        <?php echo _l('task_single_add_new_comment'); ?>
                        </button>
                        <div class="clearfix"></div>
                    </div>
                    <div id="task-comments">
                        <?php
                            $comments = '';
                            foreach ($task->comments as $comment) {
                              $comments .= '<div class="col-md-12 mbot10 mtop10" data-commentid="' . $comment['id'] . '">';
                              if($comment['staffid'] != 0){
                                 $comments .= '<a href="' . admin_url('profile/' . $comment['staffid']) . '">' . staff_profile_image($comment['staffid'], array(
                                    'staff-profile-image-small',
                                    'media-object img-circle pull-left mright10'
                                    )) . '</a>';
                             } else {
                              $comments .= '<img src="'.contact_profile_image_url($comment['contact_id']).'" class="client-profile-image-small media-object img-circle pull-left mright10">';
                            }
                            if ($comment['staffid'] == get_staff_user_id() || is_admin()) {
                              $comment_added = strtotime($comment['dateadded']);
                              $minus_1_hour = strtotime('-1 hours');
                              if(get_option('client_staff_add_edit_delete_task_comments_first_hour') == 0 || (get_option('client_staff_add_edit_delete_task_comments_first_hour') == 1 && $comment_added >= $minus_1_hour) || is_admin()){
                                $comments .= '<span class="pull-right"><a href="#" onclick="remove_task_comment(' . $comment['id'] . '); return false;"><i class="fa fa-times text-danger"></i></span></a>';
                                $comments .= '<span class="pull-right mright5"><a href="#" onclick="edit_task_comment(' . $comment['id'] . '); return false;"><i class="fa fa-pencil-square-o"></i></span></a>';
                            }
                            }

                            $comments .= '<div class="media-body">';
                            if($comment['staffid'] != 0){
                            $comments .= '<a href="' . admin_url('profile/' . $comment['staffid']) . '" target="_blank">' . get_staff_full_name($comment['staffid']) . '</a> <br />';
                            } else {
                            $comments .= '<span class="label label-info mtop5 inline-block">'._l('is_customer_indicator').'</span><br /><a href="' . admin_url('clients/client/'.get_user_id_by_contact_id($comment['contact_id']) .'?contactid='.$comment['contact_id'] ) . '" class="pull-left" target="_blank">' . get_contact_full_name($comment['contact_id']) . '</a> <br />';
                            }
                            $comments .= '<div data-edit-comment="'.$comment['id'].'" class="hide"><textarea rows="5" class="form-control mtop10 mbot10">'.clear_textarea_breaks($comment['content']).'</textarea>
                            <button type="button" class="btn btn-info pull-right" onclick="save_edited_comment('.$comment['id'].')">'._l('submit').'</button>
                            <button type="button" class="btn btn-default pull-right mright5" onclick="cancel_edit_comment('.$comment['id'].')">'._l('cancel').'</button>
                            </div>';
                            $comments .= '<div class="comment-content">'.check_for_links($comment['content']) . '</div><br />';
                            $comments .= '<small class="mtop10 text-muted">' . _dt($comment['dateadded']) . '</small>';
                            $comments .= '</div>';
                            $comments .= '<hr />';
                            $comments .= '</div>';
                            }
                            echo $comments;
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    taskid = '<?php echo $task->id; ?>'
    init_selectpicker();
    init_datepicker();
    // Multiple dropzone appending input to body fix
    $('.dz-hidden-input').remove();
    Dropzone.autoDiscover = false;
    var tasksAttachmentsDropzone = new Dropzone("#task-attachment", {
    clickable: '.add-task-attachments',
    autoProcessQueue: true,
    createImageThumbnails: false,
    addRemoveLinks: false,
    dictDefaultMessage:drop_files_here_to_upload,
    dictFallbackMessage:browser_not_support_drag_and_drop,
    dictRemoveFile:remove_file,
    dictMaxFilesExceeded:you_can_not_upload_any_more_files,
    previewTemplate: '<div style="display:none"></div>',
    maxFiles: 10,
    acceptedFiles:allowed_files,
    error:function(file,response){
    alert_float('danger',response);
    },
    });
    tasksAttachmentsDropzone.on("sending", function(file, xhr, formData) {
    formData.append("taskid", taskid);
    });
    // On post added success
    tasksAttachmentsDropzone.on('complete', function(files, response) {
    if (tasksAttachmentsDropzone.getUploadingFiles().length === 0 && tasksAttachmentsDropzone.getQueuedFiles().length === 0) {
    init_task_modal(taskid);
    }
    });

</script>
