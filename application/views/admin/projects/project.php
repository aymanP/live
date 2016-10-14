<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
            <?php echo form_open($this->uri->uri_string(),array('id'=>'project_form')); ?>
            <div class="col-md-7">
                <div class="panel_s">
                    <div class="panel-heading">
                        <?php echo $title; ?>
                    </div>
                    <div class="panel-body">
                        <?php
                            $disable_type_edit = '';
                            if(isset($project)){
                                if($project->billing_type != 1){
                                    if(total_rows('tblstafftasks',array('rel_id'=>$project->id,'rel_type'=>'project','billable'=>1,'billed'=>1)) > 0){
                                        $disable_type_edit = 'disabled';
                                    }
                                }
                            }
                            ?>
                        <?php $value = (isset($project) ? $project->name : ''); ?>
                        <?php echo render_input('name','project_name',$value); ?>
                        <?php $selected = (isset($project) ? $project->clientid : '');
                            if($selected == ''){
                                $selected = (isset($customer_id) ? $customer_id: '');
                            }
                        ?>
                        <?php $auto_toggle_class = (isset($project) || isset($do_not_auto_toggle) ? '' : 'auto-toggle'); ?>
                        <?php echo render_select('clientid',$customers,array('userid',array('company')),'project_customer',$selected,array(),array(),'',$auto_toggle_class); ?>

                        <?php $selected = (isset($project) ? $project->contactid : ''); ?>
                        <?php
                        $selected = array();
                        if(isset($project_contacts)){
                            foreach($project_contacts as $contact){
                                array_push($selected,$contact);
                            }
                        }

                        echo render_select('contactid[]',$contacts, array('id',array('firstname', 'lastname')),'Contact',$selected,array( 'multiple'=>true)); ?>



                        <div class="form-group">
                            <div class="checkbox checkbox-success">
                                <input type="checkbox" <?php if((isset($project) && $project->progress_from_tasks == 1) || !isset($project)){echo 'checked';} ?> name="progress_from_tasks" id="progress_from_tasks">
                                <label for="progress_from_tasks"><?php echo _l('calculate_progress_through_tasks'); ?></label>
                            </div>
                        </div>


                        <?php
                            if(isset($project) && $project->progress_from_tasks == 1){
                                $value = $this->projects_model->calc_progress_by_tasks($project->id);
                            } else if(isset($project) && $project->progress_from_tasks == 0){
                                $value = $project->progress;
                            } else {
                                $value = 0;
                            }
                        ?>
                        <label for=""><?php echo _l('project_progress'); ?> <span class="label_progress"><?php echo $value; ?>%</span></label>
                        <?php echo form_hidden('progress',$value); ?>
                        <div class="project_progress_slider project_progress_slider_horizontal mbot15"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="billing_type"><?php echo _l('project_billing_type'); ?></label>
                                    <div class="clearfix"></div>
                                    <select name="billing_type" class="selectpicker" id="billing_type" data-width="100%" <?php echo $disable_type_edit ; ?> data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                        <option value=""></option>
                                        <option value="1" <?php if(isset($project) && $project->billing_type == 1){echo 'selected'; } ?>><?php echo _l('project_billing_type_fixed_cost'); ?></option>
                                        <option value="2" <?php if(isset($project) && $project->billing_type == 2){echo 'selected'; } ?>><?php echo _l('project_billing_type_project_hours'); ?></option>
                                        <option value="3" data-subtext="<?php echo _l('project_billing_type_project_task_hours_hourly_rate'); ?>" <?php if(isset($project) && $project->billing_type == 3){echo 'selected'; } ?>><?php echo _l('project_billing_type_project_task_hours'); ?></option>
                                    </select>
                                    <?php if($disable_type_edit != ''){
                                        echo '<p class="text-danger">'._l('cant_change_billing_type_billed_tasks_found').'</p>';
                                        }
                                        ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status"><?php echo _l('project_status'); ?></label>
                                    <div class="clearfix"></div>
                                    <select name="status" id="status" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                        <?php foreach($statuses as $status){ ?>
                                          <option value="<?php echo $status; ?>" <?php if(!isset($project) && $status == 2 || (isset($project) && $project->status == $status)){echo 'selected';} ?>><?php echo _l('project_status_'.$status); ?></option>
                                          <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php if(isset($project)){ ?>
                        <div class="form-group mark_all_tasks_as_completed hide">
                            <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="mark_all_tasks_as_completed" id="mark_all_tasks_as_completed">
                                <label for="mark_all_tasks_as_completed"><?php echo _l('project_mark_all_tasks_as_completed'); ?></label>
                            </div>
                        </div>
                        <?php } ?>
                        <div id="project_cost" class="<?php if(!isset($project) || (isset($project) && $project->billing_type != 1)){echo 'hide';} ?>">
                            <?php $value = (isset($project) ? $project->project_cost : ''); ?>
                            <?php echo render_input('project_cost','project_total_cost',$value,'number'); ?>
                        </div>
                        <div id="project_rate_per_hour" class="<?php if(!isset($project) || (isset($project) && $project->billing_type != 2)){echo 'hide';} ?>">
                            <?php $value = (isset($project) ? $project->project_rate_per_hour : ''); ?>
                            <?php
                                $input_disable = array();
                                if($disable_type_edit != ''){
                                    $input_disable['disabled'] = true;
                                }
                                ?>
                            <?php echo render_input('project_rate_per_hour','project_rate_per_hour',$value,'number',$input_disable); ?>
                        </div>
                        <?php
                            $selected = array();
                            if(isset($project_members)){
                                foreach($project_members as $member){
                                    array_push($selected,$member['staff_id']);
                                }
                            }

                        echo render_select('project_members[]',$staff,array('staffid',array('firstname','lastname')),'project_members',$selected,array('multiple'=>true));
                            ?>
                        <div class="row">
                            <div class="col-md-6">
                                <?php $value = (isset($project) ? _d($project->start_date) : ''); ?>
                                <?php echo render_date_input('start_date','project_start_date',$value); ?>
                            </div>
                            <div class="col-md-6">
                                <?php $value = (isset($project) ? _d($project->deadline) : ''); ?>
                                <?php echo render_date_input('deadline','project_deadline',$value); ?>
                            </div>
                        </div>
                        <?php $rel_id_custom_field = (isset($project) ? $project->id : false); ?>
                        <?php echo render_custom_fields('projects',$rel_id_custom_field); ?>
                        <p class="bold"><?php echo _l('project_description'); ?></p>
                        <?php $contents = ''; if(isset($project)){$contents = $project->description;} ?>
                        <?php echo render_textarea('description','',$contents,array(),array(),'','tinymce'); ?>
                        <button type="submit" data-form="#project_form" class="btn btn-info pull-right" autocomplete="off" data-loading-text="<?php echo _l('wait_text'); ?>"><?php echo _l('submit'); ?></button>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="panel_s">
                    <div class="panel-heading">
                        <?php echo _l('project_settings'); ?>
                    </div>
                    <div class="panel-body">
                        <?php foreach($settings as $setting){ ?>
                        <div class="checkbox checkbox-primary">
                            <?php
                                $checked = ' checked';
                                if(isset($project)){
                                    if($project->settings->{$setting} == 0){
                                        $checked = '';
                                    }
                                } else {
                                    foreach($last_project_settings as $_l_setting) {
                                        if($setting == $_l_setting['name']){
                                            if($_l_setting['value'] == 0){
                                                $checked = '';
                                            }
                                        }
                                    }
                                } ?>
                            <input type="checkbox" name="settings[<?php echo $setting; ?>]" <?php echo $checked; ?> id="<?php echo $setting; ?>">
                            <label for="<?php echo $setting; ?>"><?php echo _l('project_allow_client_to',_l('project_setting_'.$setting)); ?></label>
                        </div>
                        <hr class="no-margin" />
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
    $(document).ready(function(){
        $('select[name="billing_type"]').on('change',function(){
            var type = $(this).val();
            if(type == 1){
                $('#project_cost').removeClass('hide');
                $('#project_rate_per_hour').addClass('hide');
            } else if(type == 2){
                $('#project_cost').addClass('hide');
                $('#project_rate_per_hour').removeClass('hide');
            } else {
                $('#project_cost').addClass('hide');
                $('#project_rate_per_hour').addClass('hide');
            }
        });
        _validate_form($('form'),{name:'required',clientid:'required',start_date:'required',deadline:'required',billing_type:'required'});

        $('select[name="status"]').on('change',function(){
            var status = $(this).val();
            if(status == 4){
                $('.mark_all_tasks_as_completed').removeClass('hide');
            } else {
                $('.mark_all_tasks_as_completed').addClass('hide');
                $('.mark_all_tasks_as_completed input').prop('checked',false);
            }
        });
        $('form').on('submit',function(){
            $('select[name="billing_type"]').prop('disabled',false);
            $('input[name="project_rate_per_hour"]').prop('disabled',false);
        });
        var progress_input = $('input[name="progress"]');
        var progress_from_tasks = $('#progress_from_tasks');
        var progress = progress_input.val();
        $('.project_progress_slider').slider({
            min:0,
            max:100,
            value:progress,
            disabled:progress_from_tasks.prop('checked'),
            slide: function( event, ui ) {
                progress_input.val( ui.value );
                $('.label_progress').html(ui.value+'%');
            }
        });
        progress_from_tasks.on('change',function(){
            var _checked = $(this).prop('checked');
            $('.project_progress_slider').slider({disabled:_checked});
        });

        $('select[name="clientid"]').on('change',function(){
            var client_id = $(this).val();

            $.get(admin_url + 'projects/get_contacts_by_client/' + client_id, function(response) {
                $('select[name="contactid[]"]').find("option").remove();
                $('select[name="contactid[]"]').append($('<option value=""></option>'));

                $.each(response, function(key, value) {
                    $('select[name="contactid[]"]').append($('<option>', { value: value.id }).text(value.firstname+ ' '+value.lastname));
                });
                $('.selectpicker').selectpicker('refresh');
            }, 'json');
        });

    });



</script>
</body>
</html>
