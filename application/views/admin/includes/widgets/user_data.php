  <div class="panel_s user-data">
   <div class="panel-body home-activity">
     <ul class="nav nav-tabs" role="tablist">
       <?php if(is_admin()){ ?>
         <li role="presentation" class="active">
          <a href="#home_tab_activity" aria-controls="home_tab_activity" role="tab" data-toggle="tab">
            <?php echo _l('home_latest_activity'); ?>
          </a>
        </li>
        <?php } ?>
        <li role="presentation" class="<?php if(!is_admin()){ echo 'active'; } ?>">
          <a href="#home_tab_tasks" aria-controls="home_tab_tasks" role="tab" data-toggle="tab">
            <?php echo _l('home_my_tasks'); ?>
          </a>
        </li>
        <li role="presentation">
          <a href="#home_my_projects" aria-controls="home_my_projects" role="tab" data-toggle="tab">
            <?php echo _l('home_my_projects'); ?>
          </a>
        </li>
        <?php if((get_option('access_tickets_to_none_staff_members') == 1 && !is_staff_member()) || is_staff_member()){ ?>
         <li role="presentation">
          <a href="#home_tab_tickets" aria-controls="home_tab_tickets" role="tab" data-toggle="tab">
            <?php echo _l('home_tickets'); ?>
          </a>
        </li>
        <?php } ?>
        <?php if(is_staff_member()){ ?>
         <li role="presentation">
          <a href="#home_announcements" aria-controls="home_announcements" role="tab" data-toggle="tab">
            <?php echo _l('home_announcements'); ?>
            <?php if($total_undismissed_announcements != 0){ echo '<span class="badge">'.$total_undismissed_announcements.'</span>';} ?>
          </a>
        </li>
        <?php } ?>
      </ul>
      <div class="tab-content">
       <?php if(is_admin()){ ?>
         <div role="tabpanel" class="tab-pane active" id="home_tab_activity">
          <a href="<?php echo admin_url('utilities/activity_log'); ?>"><?php echo _l('home_widget_view_all'); ?></a>
          <div class="clearfix"></div>
          <div class="activity-feed">
           <?php foreach($activity_log as $log){ ?>
            <div class="feed-item">
             <div class="date"><?php echo time_ago($log['date']); ?></div>
             <div class="text">
               <?php if($log['staffid'] != 0){ ?>
                <a href="<?php echo admin_url('profile/'.$log["staffid"]); ?>">
                 <?php echo get_staff_full_name($log['staffid']); ?>
               </a><br />
               <?php } ?>
               <?php echo $log['description']; ?></div>
             </div>
             <?php } ?>
           </div>
         </div>
         <?php } ?>
         <div role="tabpanel" class="tab-pane <?php if(!is_admin()){ echo 'active'; } ?>" id="home_tab_tasks">
          <a href="<?php echo admin_url('tasks/list_tasks'); ?>"><?php echo _l('home_widget_view_all'); ?></a>
          <div class="clearfix"></div>
          <hr />
          <?php
          if(count($tasks) == 0){
            echo '<p class="bold text-success text-center">'. _l('no_tasks_found') . '</p>';
          }
          foreach($tasks as $task){ ?>
            <div class="widget-task" data-widget-task-id="<?php echo $task['id']; ?>">
             <div class="row">
              <div class="col-md-12">
               <a href="#" class="pull-left" onclick="mark_complete(<?php echo $task['id']; ?>); return false;" data-placement="right" data-toggle="tooltip" title="<?php echo _l('task_single_mark_as_complete'); ?>"><i class="fa fa-check task-icon task-unfinished-icon"></i></a>
               <a href="#" onclick="init_task_modal(<?php echo $task['id']; ?>); return false;"><?php echo $task['name']; ?></a>
               <div class="clearfix mtop10"></div>
               <?php echo strip_tags(substr($task['description'],0,150)) . '...' ?>
             </div>
             <div class="col-md-12 mtop10">
               <span class="label <?php if(total_rows('tbltaskchecklists',array('finished'=>0,'taskid'=>$task['id'])) == 0){echo 'label-default-light';}else{echo 'label-danger';} ?> pull-left mright5">
                 <i class="fa fa-th-list"></i> <?php echo total_rows('tbltaskchecklists',array('finished'=>0,'taskid'=>$task['id'])); ?>
               </span>
               <span class="label label-default-light pull-left mright5">
                 <i class="fa fa-paperclip"></i> <?php echo total_rows('tblstafftasksattachments',array('taskid'=>$task['id'])); ?>
               </span>
               <span class="label label-default-light pull-left">
                 <i class="fa fa-comments"></i> <?php echo total_rows('tblstafftaskcomments',array('taskid'=>$task['id'])); ?>
               </span>
             </div>
           </div>
           <hr />
         </div>
         <?php } ?>
       </div>
       <?php if((get_option('access_tickets_to_none_staff_members') == 1 && !is_staff_member()) || is_staff_member()){ ?>
         <div role="tabpanel" class="tab-pane" id="home_tab_tickets">
           <a href="<?php echo admin_url('tickets'); ?>"><?php echo _l('home_widget_view_all'); ?></a>
           <div class="clearfix"></div>
           <div class="_filters _hidden_inputs hidden tickets_filters">
           <?php
           // On home only show on hold, open and in progress
           echo form_hidden('ticket_status_1',true);
           echo form_hidden('ticket_status_2',true);
           echo form_hidden('ticket_status_4',true);
           ?>
           </div>
           <?php echo AdminTicketsTableStructure(); ?>
         </div>
         <?php } ?>
         <div role="tabpanel" class="tab-pane" id="home_my_projects">
          <a href="<?php echo admin_url('projects'); ?>"><?php echo _l('home_widget_view_all'); ?></a>
          <div class="clearfix"></div>
          <?php render_datatable(array(
            _l('project_name'),
            _l('project_start_date'),
            _l('project_deadline'),
            _l('project_status'),
            ),'staff-projects'); ?>
          </div>
          <?php if(is_staff_member()){ ?>
           <div role="tabpanel" class="tab-pane" id="home_announcements">
            <?php if(is_admin()){ ?>
              <a href="<?php echo admin_url('announcements'); ?>"><?php echo _l('home_widget_view_all'); ?></a>
              <div class="clearfix"></div>
              <?php } ?>
              <?php render_datatable(array(_l('announcement_name'),_l('announcement_date_list'),_l('options')),'announcements'); ?>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>

