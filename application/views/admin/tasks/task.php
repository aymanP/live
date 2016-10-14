<?php echo form_open(admin_url('tasks/task/'.$id),array('id'=>'task-form')); ?>
<div class="modal fade" id="_task_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">
                <?php echo $title; ?>
            </h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        $rel_type = '';
                        $rel_id = '';
                        if(isset($task) || ($this->input->get('rel_id') && $this->input->get('rel_type'))){
                          if($this->input->get('rel_id')){
                            $rel_id = $this->input->get('rel_id');
                            $rel_type = $this->input->get('rel_type');
                          } else {
                            $rel_id = $task->rel_id;
                            $rel_type = $task->rel_type;
                          }
                          ?>
                    <?php echo form_hidden('task_rel_id',$rel_id); ?>
                    <div class="clearfix"></div>
                    <?php } ?>
                    <?php
                        if(isset($task) && $task->billed == 1){
                          echo '<p class="text-success">'._l('task_is_billed',format_invoice_number($task->invoice_id)). '</p>';
                        }
                        ?>
                    <div class="checkbox checkbox-primary non-project-details<?php if($rel_type == 'project'){echo ' hide';} ?>">
                        <input type="checkbox" id="task_is_public" name="is_public" <?php if(isset($task)){if($task->is_public == 1){echo 'checked';}}; ?>>
                        <label for="task_is_public" data-toggle="tooltip" title="<?php echo _l('task_public_help'); ?>"><?php echo _l('task_public'); ?></label>
                    </div>
                    <div class="checkbox checkbox-primary">
                        <input type="checkbox" id="task_is_billable" name="billable" <?php if(isset($task)){if($task->billable == 1){echo 'checked';}} else {echo 'checked';}; ?>>
                        <label for="task_is_billable" data-toggle="tooltip" title="<?php echo _l('task_billable_help'); ?>"><?php echo _l('task_billable'); ?></label>
                    </div>
                    <div class="project-details checkbox checkbox-primary<?php if($rel_type != 'project' && $rel_id == ''){echo ' hide';} ?>">
                        <input type="checkbox" id="task_visible_to_client" name="visible_to_client" <?php if(isset($task)){if($task->visible_to_client == 1){echo 'checked';}} else {echo 'checked';}; ?>>
                        <label for="task_visible_to_client"><?php echo _l('task_visible_to_client'); ?></label>
                    </div>
                    <div class="task-hours hide">
                        <?php $value = (isset($task) ? $task->hourly_rate : 0); ?>
                        <?php echo render_input('hourly_rate','task_hourly_rate',$value); ?>
                    </div>
                    <div class="project-details<?php if($rel_type != 'project' && $rel_id == ''){echo ' hide';} ?>">
                        <div class="form-group">
                            <label for="milestone"><?php echo _l('task_milestone'); ?></label>
                            <select name="milestone" id="milestone" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>"></select>
                        </div>
                    </div>
                    <?php $value = (isset($task) ? $task->name : ''); ?>
                    <?php echo render_input('name','task_add_edit_subject',$value); ?>
                    <div class="form-group">
                        <label for="priority" class="control-label"><?php echo _l('task_add_edit_priority'); ?></label>
                        <select name="priority" class="selectpicker" id="priority" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                            <option value="1"><?php echo _l('task_priority_low'); ?></option>
                            <option value="2"><?php echo _l('task_priority_medium'); ?></option>
                            <option value="3"><?php echo _l('task_priority_high'); ?></option>
                            <option value="4"><?php echo _l('task_priority_urgent'); ?></option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?php if(isset($task)){
                                $value = _d($task->startdate);
                            } else if(isset($start_date)){
                                $value = $start_date;
                            } else {
                                $value = _d(date('Y-m-d'));
                            }
                        ?>
                            <?php echo render_date_input('startdate','task_add_edit_start_date',$value); ?>
                        </div>
                        <div class="col-md-6">
                            <?php $value = (isset($task) ? _d($task->duedate) : ''); ?>
                            <?php echo render_date_input('duedate','task_add_edit_due_date',$value,$project_end_date_attrs); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rel_type" class="control-label"><?php echo _l('task_related_to'); ?></label>
                                <select name="rel_type" class="selectpicker" id="rel_type" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                    <option value=""></option>
                                    <option value="project"
                                        <?php if(isset($task) || $this->input->get('rel_type')){if($rel_type == 'project'){echo 'selected';}} ?>><?php echo _l('project'); ?></option>
                                    <option value="invoice" <?php if(isset($task) || $this->input->get('rel_type')){if($rel_type == 'invoice'){echo 'selected';}} ?>>
                                        <?php echo _l('invoice'); ?>
                                    </option>
                                    <option value="customer"
                                        <?php if(isset($task) || $this->input->get('rel_type')){if($rel_type == 'customer'){echo 'selected';}} ?>> <?php echo _l('client'); ?></option>
                                    <option value="estimate" <?php if(isset($task) || $this->input->get('rel_type')){if($rel_type == 'estimate'){echo 'selected';}} ?>><?php echo _l('estimate'); ?></option>
                                    <option value="contract" <?php if(isset($task) || $this->input->get('rel_type')){if($rel_type == 'contract'){echo 'selected';}} ?>><?php echo _l('contract'); ?></option>
                                    <option value="ticket" <?php if(isset($task) || $this->input->get('rel_type')){if($rel_type == 'ticket'){echo 'selected';}} ?>><?php echo _l('ticket'); ?></option>
                                    <option value="expense" <?php if(isset($task) || $this->input->get('rel_type')){if($rel_type == 'expense'){echo 'selected';}} ?>><?php echo _l('expense'); ?></option>
                                    <option value="lead" <?php if(isset($task) || $this->input->get('rel_type')){if($rel_type == 'lead'){echo 'selected';}} ?>><?php echo _l('lead'); ?></option>
                                    <option value="proposal" <?php if(isset($task) || $this->input->get('rel_type')){if($rel_type == 'proposal'){echo 'selected';}} ?>><?php echo _l('proposal'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 label-margin">
                            <div class="form-group hide" id="rel_id_wrapper">
                                <select name="rel_id" id="rel_id" class="selectpicker" data-width="100%" data-live-search="true" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>"></select>
                            </div>
                        </div>
                    </div>
                    <?php if(isset($task) && $task->finished == 1 && (has_permission('create') || has_permission('edit'))){
                        echo render_datetime_input('datefinished','task_finished',_dt($task->datefinished));
                    }
                    ?>
                    <?php $rel_id_custom_field = (isset($task) ? $task->id : false); ?>
                    <?php echo render_custom_fields('tasks',$rel_id_custom_field); ?>
                    <hr />
                    <p class="bold"><?php echo _l('task_add_edit_description'); ?></p>
                    <?php $contents = ''; if(isset($task)){$contents = $task->description;} ?>
                    <?php echo render_textarea('description','',$contents,array(),array(),'','tinymce-task'); ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
            <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
<script>
var _milestone_selected_data;
_milestone_selected_data = undefined;
<?php if(isset($_milestone_selected_data)){ ?>
    _milestone_selected_data = '<?php echo json_encode($_milestone_selected_data); ?>';
    _milestone_selected_data = $.parseJSON(_milestone_selected_data);
<?php } ?>
    _validate_form($('#task-form'), {
    name: 'required',
    startdate: 'required'
    },task_form_handler);
    init_relation_data();
    $('select[name="rel_type"]').on('change', function() {
        init_relation_data();
    });
    init_datepicker();
    init_selectpicker();
    init_editor('.tinymce-task',{height:200});
    $('#rel_id').on('change',function(){
     var rel_id = $(this).val();
     if(rel_id != ''){
     var rel_type = $('select[name="rel_type"]').val();
     if(rel_type == 'project'){
       $.get(admin_url + 'projects/get_rel_project_data/'+rel_id+'/'+taskid,function(project){
         $("select[name='milestone']").html(project.milestones);
         if(typeof(_milestone_selected_data) != 'undefined'){
            $("select[name='milestone']").val(_milestone_selected_data.id);
            $('input[name="duedate"]').val(_milestone_selected_data.due_date)
         }
         $("select[name='milestone']").selectpicker('refresh');
         if(project.billing_type == 3){
           $('.task-hours').addClass('project-task-hours');
         } else {
           $('.task-hours').removeClass('project-task-hours');
         }
         init_project_details(rel_type);
       },'json');
     }
     }
    });
    function init_relation_data(data) {
        var data = {};
        var task_rel_id = $('input[name="task_rel_id"]');
        var type = $('select[name="rel_type"]');
        data.type = type.val();
        init_project_details(data.type);
        if (task_rel_id.length > 0) {
        if (data.type == '') {
          return;
        } else {
          $('#rel_id_wrapper').removeClass('hide');
          data.rel_id = task_rel_id.val();
        }
        } else {
        if (data.type == '') {
          $('#rel_id_wrapper').addClass('hide');
        return;
        } else {
          $('#rel_id_wrapper').removeClass('hide');
        }
        }
        $.post(admin_url + 'misc/get_relation_data', data).success(function(response) {
          $('#rel_id').html(response);
          $('#rel_id').selectpicker('refresh');
          $('#rel_id').change();
        });
    }
    function init_project_details(type){
    var wrap = $('.non-project-details');
    var wrap_task_hours = $('.task-hours');
    if(type == 'project'){
      if(wrap_task_hours.hasClass('project-task-hours') == true){
        wrap_task_hours.removeClass('hide');
      } else {
        wrap_task_hours.addClass('hide');
      }
      wrap.addClass('hide');
      $('.project-details').removeClass('hide');
    } else {
      wrap_task_hours.removeClass('hide');
      wrap.removeClass('hide');
        $('.project-details').addClass('hide');
      }
    }
</script>
