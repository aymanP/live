<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active">
        <a href="#misc" aria-controls="misc" role="tab" data-toggle="tab"><?php echo _l('settings_group_misc'); ?></a>
      </li>
      <li role="presentation">
        <a href="#leads" aria-controls="leads" role="tab" data-toggle="tab"><?php echo _l('leads'); ?></a>
      </li>
      <li role="presentation">
        <a href="#tasks" aria-controls="tasks" role="tab" data-toggle="tab"><?php echo _l('tasks'); ?></a>
      </li>
      <li role="presentation">
        <a href="#set_newsfeed" aria-controls="set_newsfeed" role="tab" data-toggle="tab"><?php echo _l('settings_group_newsfeed'); ?></a>
      </li>
       <li role="presentation">
        <a href="#set_recaptcha" aria-controls="set_recaptcha" role="tab" data-toggle="tab"><?php echo _l('re_captcha'); ?></a>
      </li>
    </ul>
  </div>
  <div class="col-md-6">
    <div class="tab-content mtop30">
      <div role="tabpanel" class="tab-pane active" id="misc">
        <?php echo render_input('settings[google_api_key]','settings_google_api',get_option('google_api_key')); ?>
        <hr />
        <?php echo render_input('settings[tables_pagination_limit]','settings_general_tables_limit',get_option('tables_pagination_limit'),'number'); ?>
        <hr />
        <?php echo render_input('settings[auto_check_for_new_notifications]','auto_check_for_new_notifications',get_option('auto_check_for_new_notifications'),'number'); ?>
        <hr />
        <?php echo render_input('settings[limit_top_search_bar_results_to]','settings_limit_top_search_bar_results',get_option('limit_top_search_bar_results_to'),'number'); ?>
        <hr />
        <?php echo render_select('settings[default_staff_role]',$roles,array('roleid','name'),'settings_general_default_staff_role',get_option('default_staff_role'),array(),array('data-toggle'=>'tooltip','title'=>'settings_general_default_staff_role_tooltip')); ?>
        <hr />
        <?php echo render_input('settings[media_max_file_size_upload]','settings_media_max_file_size_upload',get_option('media_max_file_size_upload'),'number'); ?>
        <hr />
          <?php echo render_yes_no_option('show_help_on_setup_menu','show_help_on_setup_menu'); ?>
      </div>
      <div role="tabpanel" class="tab-pane" id="tasks">
        <?php echo render_yes_no_option('show_all_tasks_for_project_member','show_all_tasks_for_project_member'); ?>
        <hr />
        <?php render_yes_no_option('client_staff_add_edit_delete_task_comments_first_hour','settings_client_staff_add_edit_delete_task_comments_first_hour'); ?>
        <hr />
        <?php render_yes_no_option('auto_stop_tasks_timers_on_new_timer','auto_stop_tasks_timers_on_new_timer'); ?>
     </div>
      <div role="tabpanel" class="tab-pane" id="leads">
       <?php echo render_input('settings[leads_kanban_limit]','settings_leads_kanban_limit',get_option('leads_kanban_limit'),'number'); ?>
       <hr />
         <?php echo render_select('settings[leads_default_status]',$leads_statuses,array('id','name'),'leads_default_status',get_option('leads_default_status')); ?>
        <br />
         <?php echo render_select('settings[leads_default_source]',$leads_sources,array('id','name'),'leads_default_source',get_option('leads_default_source')); ?>
         <hr />
       <div class="row">

        <div class="col-md-7">
          <label for="defaut_leads_kanban_sort" class="control-label"><?php echo _l('defaut_leads_kanban_sort'); ?></label>
          <select name="settings[defaut_leads_kanban_sort]" id="defaut_leads_kanban_sort" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
            <option value=""></option>
            <option value="dateadded" <?php if(get_option('defaut_leads_kanban_sort') == 'dateadded'){echo 'selected'; }?>><?php echo _l('leads_sort_by_datecreated'); ?></option>
            <option value="leadorder" <?php if(get_option('defaut_leads_kanban_sort') == 'leadorder'){echo 'selected'; }?>><?php echo _l('leads_sort_by_kanban_order'); ?></option>
            <option value="lastcontact" <?php if(get_option('defaut_leads_kanban_sort') == 'lastcontact'){echo 'selected'; }?>><?php echo _l('leads_sort_by_lastcontact'); ?></option>
          </select>
        </div>
        <div class="col-md-5">
         <div class="mtop30 text-right">
          <div class="radio radio-inline radio-primary">
            <input type="radio" id="k_desc" name="settings[defaut_leads_kanban_sort_type]" value="asc" <?php if(get_option('defaut_leads_kanban_sort_type') == 'asc'){echo 'checked';} ?>>
            <label for="k_desc"><?php echo _l('order_ascending'); ?></label>
          </div>
          <div class="radio radio-inline radio-primary">
            <input type="radio" id="k_asc" name="settings[defaut_leads_kanban_sort_type]" value="desc" <?php if(get_option('defaut_leads_kanban_sort_type') == 'desc'){echo 'checked';} ?>>
            <label for="k_asc"><?php echo _l('order_descending'); ?></label>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      </div>
      <hr />
      <?php echo render_yes_no_option('lead_lock_after_convert_to_customer','lead_lock_after_convert_to_customer'); ?>
  </div>
  <div role="tabpanel" class="tab-pane" id="set_newsfeed">
   <?php echo render_input('settings[newsfeed_maximum_files_upload]','settings_newsfeed_max_file_upload_post',get_option('newsfeed_maximum_files_upload'),'number'); ?>
   <hr />
   <?php echo render_input('settings[newsfeed_maximum_file_size]','settings_newsfeed_max_file_size',get_option('newsfeed_maximum_file_size'),'number'); ?>
 </div>
  <div role="tabpanel" class="tab-pane" id="set_recaptcha">
     <p class="text-info"><?php echo _l('recaptcha_help_settings'); ?></p>
     <?php echo render_input('settings[recaptcha_secret_key]','recaptcha_secret_key',get_option('recaptcha_secret_key')); ?>
     <?php echo render_input('settings[recaptcha_site_key]','recaptcha_site_key',get_option('recaptcha_site_key')); ?>
    <hr />
    <?php echo render_yes_no_option('use_recaptcha_customers_area','use_recaptcha_customers_area'); ?>
  </div>
</div>

</div>
