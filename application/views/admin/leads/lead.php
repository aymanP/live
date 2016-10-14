<div class="fadeIn">
    <?php if(isset($lead)){
        if($lead->lost == 1){
            echo '<div class="ribbon danger"><span>'._l('lead_lost').'</span></div>';
        } else if($lead->junk == 1){
            echo '<div class="ribbon warning"><span>'._l('lead_junk').'</span></div>';
        } else {
            if (total_rows('tblclients', array(
                'leadid' => $lead->id))) {
                echo '<div class="ribbon success"><span>'._l('lead_is_client').'</span></div>';
        }
        }
    }
    ?>
<button type="button" class="close leads-kanban-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active" >
        <a href="#tab_lead_profile" aria-controls="tab_lead_profile" role="tab" data-toggle="tab">
        <?php echo _l('lead_profile'); ?>
        </a>
    </li>
    <?php if(isset($lead)){ ?>
    <?php if(count($mail_activity) > 0){ ?>
    <li role="presentation">
        <a href="#tab_email_activity" aria-controls="tab_email_activity" role="tab" data-toggle="tab">
        <?php echo _l('lead_email_activity'); ?>
        </a>
    </li>
    <?php } ?>
    <li role="presentation">
        <a href="#activity" aria-controls="activity" role="tab" data-toggle="tab">
        <?php echo _l('lead_add_edit_activity'); ?>
        </a>
    </li>
    <?php if(has_permission('proposals','','view')){ ?>
    <li role="presentation">
        <a href="#tab_proposals_leads" aria-controls="tab_proposals_leads" role="tab" data-toggle="tab">
        <?php echo _l('proposals'); ?>
        </a>
    </li>
    <?php } ?>
    <li role="presentation">
        <a href="#tab_tasks_leads" aria-controls="tab_tasks_leads" role="tab" data-toggle="tab">
        <?php echo _l('tasks'); ?>
        </a>
    </li>
    <li role="presentation">
        <a href="#attachments" aria-controls="attachments" role="tab" data-toggle="tab">
        <?php echo _l('lead_attachments'); ?>
        </a>
    </li>
    <li role="presentation">
        <a href="#lead_reminders" aria-controls="lead_reminders" role="tab" data-toggle="tab">
        <?php echo _l('leads_reminders_tab'); ?>
        </a>
    </li>
    <li role="presentation">
        <a href="#lead_notes" aria-controls="lead_notes" role="tab" data-toggle="tab">
        <?php echo _l('lead_add_edit_notes'); ?>
        </a>
    </li>
    <?php } ?>
</ul>
<!-- Tab panes -->
<div class="tab-content">
    <!-- from leads modal -->
    <div role="tabpanel" class="tab-pane active" id="tab_lead_profile">
        <?php $this->load->view('admin/leads/profile'); ?>
    </div>
    <?php if(isset($lead)){ ?>
    <?php if(count($mail_activity) > 0){ ?>
    <div role="tabpanel" class="tab-pane" id="tab_email_activity">
        <?php foreach($mail_activity as $_mail_activity){ ?>
        <div class="media-left">
            <i class="fa fa-envelope"></i>
        </div>
        <div class="media-body">
            <h4 class="bold no-margin"><?php echo $_mail_activity['subject']; ?></h4>
            <hr />
            <?php echo $_mail_activity['body']; ?><small class="text-muted display-block"><?php echo _dt($_mail_activity['dateadded']); ?></small>
            <hr />
        </div>
        <div class="clearfix"></div>
        <?php } ?>
    </div>
    <?php } ?>
    <div role="tabpanel" class="tab-pane" id="activity">
        <div class="panel_s mtop20">
         <div class="activity-feed">
             <?php foreach($activity_log as $log){ ?>
              <div class="feed-item">
               <div class="date"><?php echo time_ago($log['date']); ?></div>
               <div class="text">
                   <?php if($log['staffid'] != 0){ ?>
                      <a href="<?php echo admin_url('profile/'.$log["staffid"]); ?>">
                      <?php echo staff_profile_image($log['staffid'],array('staff-profile-xs-image pull-left mright5'));
                      ?>
                     </a>
                     <?php
                     }
                     $additional_data = '';
                     if(!empty($log['additional_data'])){
                        $additional_data = unserialize($log['additional_data']);
                    }
                    echo _l($log['description'],$additional_data); ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
    <?php if(has_permission('proposals','','view')){ ?>
    <div role="tabpanel" class="tab-pane" id="tab_proposals_leads">
      <?php if(has_permission('proposals','','create')){ ?>
        <a href="<?php echo admin_url('proposals/proposal?rel_type=lead&rel_id='.$lead->id); ?>" class="btn btn-info"><?php echo _l('new_proposal'); ?></a>
    <?php } ?>
        <?php
            $table_data = array(
                _l('id'),
                _l('proposal_subject'),
                _l('proposal_total'),
                _l('proposal_open_till'),
                _l('proposal_date_created'),
                _l('proposal_status'));
            $custom_fields = get_custom_fields('proposal',array('show_on_table'=>1));
            foreach($custom_fields as $field){
                array_push($table_data,$field['name']);
            }
            render_datatable($table_data,'proposals-lead'); ?>
    </div>
    <?php } ?>
    <div role="tabpanel" class="tab-pane" id="tab_tasks_leads">
        <?php init_relation_tasks_table(array('data-new-rel-id'=>$lead->id,'data-new-rel-type'=>'lead')); ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="lead_reminders">
        <a href="#" data-toggle="modal" data-target=".reminder-modal"><i class="fa fa-bell-o"></i> <?php echo _l('lead_set_reminder_title'); ?></a>
        <hr />
        <?php render_datatable(array( _l( 'reminder_description'), _l( 'reminder_date'), _l( 'reminder_staff'), _l( 'reminder_is_notified'), _l( 'options'), ), 'reminders-leads'); ?>
        <?php $this->load->view('admin/includes/modals/reminder',array('id'=>$lead->id,'name'=>'lead','members'=>$members,'reminder_title'=>_l('lead_set_reminder_title'))); ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="attachments">
        <?php echo form_open('admin/leads/add_lead_attachment',array('class'=>'dropzone mtop30','id'=>'lead-attachment-upload')); ?>
        <?php echo form_close(); ?>
        <div class="mtop30" id="lead_attachments">
            <?php $this->load->view('admin/leads/leads_attachments_template', array('attachments'=>$lead->attachments)); ?>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="lead_notes">
        <?php echo form_open(admin_url('leads/add_note/'.$lead->id),array('id'=>'lead-notes')); ?>
        <?php echo render_textarea('description'); ?>
                 <button type="submit" class="btn btn-info pull-right"><?php echo _l('lead_add_edit_add_note'); ?></button>
                 <div class="clearfix"></div>
        <div class="lead-select-date-contacted hide">
            <?php echo render_datetime_input('custom_contact_date','lead_add_edit_datecontacted'); ?>
        </div>
        <div class="radio radio-primary">
            <input type="radio" name="contacted_indicator" id="contacted_indicator_yes" value="yes">
            <label for="contacted_indicator_yes"><?php echo _l('lead_add_edit_contected_this_lead'); ?></label>
        </div>
        <div class="radio radio-primary">
            <input type="radio" name="contacted_indicator" id="contacted_indicator_no" value="no" checked>
            <label for="contacted_indicator_no"><?php echo _l('lead_not_contacted'); ?></label>
        </div>
        <?php echo form_close(); ?>
        <hr />
        <div class="panel_s mtop20">
            <?php foreach($notes as $note){ ?>
            <div class="media lead-note">
                <div class="media-left">
                    <a href="<?php echo admin_url('profile/'.$note["addedfrom"]); ?>">
                    <?php echo staff_profile_image($note['addedfrom'],array('staff-profile-image-small','media-object')); ?>
                    </a>
                </div>
                <div class="media-body">
                    <?php if($note['addedfrom'] == get_staff_user_id() || is_admin()){ ?>
                    <a href="#" class="pull-right text-danger" onclick="delete_lead_note(this,<?php echo $note['id']; ?>);return false;"><i class="fa fa fa-times"></i></a>
                    <?php } ?>
                    <h5 class="media-heading mtop10 bold"><?php echo get_staff_full_name($note['addedfrom']); ?></h5>
                    <?php echo $note['description']; ?><small class="text-muted display-block"><?php echo _dt($note['dateadded']); ?></small>
                </div>
                <hr />
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
</div>
<script>
    init_selectpicker();
    validate_lead_form(lead_profile_form_handler);
    init_datepicker();
    <?php if(isset($lead)){ ?>
        validate_lead_convert_to_client_form();
        init_form_reminder();
        initDataTable('.table-reminders-leads', admin_url + 'misc/get_reminders/' + <?php echo $lead->id ;?> + '/' + 'lead', [4], [4]);
        initDataTable('.table-proposals-lead', admin_url + 'proposals/proposal_relations/' + <?php echo $lead->id ;?> + '/lead','undefined', 'undefined','undefined',[4,'DESC']).column(0).visible(false, false).columns.adjust().draw(false);

        init_rel_tasks_table(<?php echo $lead->id; ?>,'lead','.table-rel-tasks-leads');
        new Dropzone("#lead-attachment-upload", {
            addRemoveLinks: false,
            dictDefaultMessage:drop_files_here_to_upload,
            dictFallbackMessage:browser_not_support_drag_and_drop,
            dictRemoveFile:remove_file,
            dictMaxFilesExceeded:you_can_not_upload_any_more_files,
            sending: function(file, xhr, formData) {
                formData.append("leadid", <?php echo $lead->id; ?>);
            },
            acceptedFiles:allowed_files,
            error:function(file,response){
                   alert_float('danger',response);
               },
            success: function(file) {
                if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                    init_lead_modal_data(<?php echo $lead->id; ?>);
                }
            }
        });
        <?php } ?>
        $('body').find('.nav-tabs a[href="' + window.location.hash + '"]').tab('show');

</script>

</div>
