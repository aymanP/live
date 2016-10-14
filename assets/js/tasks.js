$(document).ready(function() {
    // Init single task data
    if (typeof(taskid) !== 'undefined' && taskid !== '') {
        init_task_modal(taskid);
    }
    $('body').on('change', 'input[name="checklist-box"]', function() {
        var checked = $(this).prop('checked');
        if (checked == true) {val = 1;} else {val = 0;}
        var listid = $(this).parents('.checklist').data('checklist-id');
        $.get(admin_url + 'tasks/checkbox_action/' + listid + '/' + val);
        recalculate_checklist_items_progress();
    });

    $('body').on('click','.task-single-delete-timesheet',function(e){
        e.preventDefault();
        var r = confirm(confirm_action_prompt);
        if (r == false) {return false;} else {
            var _delete_timesheet_task_id = $(this).data('task-id');
            $.get($(this).attr('href'),function(){
                init_task_modal(_delete_timesheet_task_id);
                setTimeout(function(){
                    reload_tasks_tables();
                },20);
            });
        }
    });

    $('body').on('click','.task-single-add-timesheet',function(e){
        e.preventDefault();
        var start_time = $('body').find('.task-modal-single input[name="timesheet_start_time"]').val();
        var end_time = $('body').find('.task-modal-single input[name="timesheet_end_time"]').val();
        if(start_time != '' && end_time != ''){
            var data = {};
            data.start_time = start_time;
            data.end_time = end_time;
            data.timesheet_task_id = $(this).data('task-id');
            data.timesheet_task_id = $(this).data('task-id');
            data.timesheet_staff_id = $('body').find('.task-modal-single select[name="single_timesheet_staff_id"]').val();
            $.post(admin_url+'tasks/log_time',data).success(function(response){
               response = $.parseJSON(response);
               if (response.success == true) {
                init_task_modal(data.timesheet_task_id);
                alert_float('success', response.message);
                setTimeout(function(){
                    reload_tasks_tables();
                },20);
            } else {
                alert_float('warning', response.message);
            }
        });
        }
    });

    $('body').on('click','.copy_task_action',function(){
        var data = {};
        var copy_task_assignees,copy_task_followers,copy_task_checklist_items,copy_task_attachments;
        data.copy_from = $(this).data('task-copy-from');
        data.copy_task_assignees = $('body').find('#copy_task_assignees').prop('checked');
        data.copy_task_followers = $('body').find('#copy_task_followers').prop('checked');
        data.copy_task_checklist_items = $('body').find('#copy_task_checklist_items').prop('checked');
        data.copy_task_attachments = $('body').find('#copy_task_attachments').prop('checked');
        $.post(admin_url+'tasks/copy',data).success(function(response){
            response = $.parseJSON(response);
            if(response.success == true){
                init_task_modal(response.new_task_id);
                reload_tasks_tables();
            }
            alert_float(response.alert_type,response.message);
        });
        return false;
    });

    $('body').on('click','.new-task-to-milestone',function(e){
        e.preventDefault();
        var milestone_id = $(this).parents('.milestone-column').data('milestone-id');
        new_task(admin_url+'tasks/task?rel_type=project&rel_id='+project_id+'&milestone_id='+milestone_id);
    });

    // Focus on subject when adding new task
    $('body').on('shown.bs.modal', '#_task_modal', function() {
        if (typeof(taskid) == 'undefined' || taskid == '') {
            tinyMCE.execCommand('mceAddControl', false, 'tinymce-task');
            $('body').find('#_task_modal input[name="name"]').focus();
        }
    });

    // Remove the tinymce description task editor
    $('body').on('hidden.bs.modal', '#_task_modal', function() {
        tinymce.remove('.tinymce-task');
    });

    // Focus on subject when adding new task
    $('body').on('hidden.bs.modal', '.task-modal-single', function() {
        taskid = '';
    });

    // when click close modal task tracking stats fix to do not close both modals
    $('body').on('click', '.close-task-stats', function() {
        $('#task-tracking-stats-modal').modal('hide');
    });

    // FIx for scroll
    $('body').on('hidden.bs.modal', '#task-tracking-stats-modal,#_task_modal,.task-modal-single,#sales_attach_file', function(event) {
        var task_single_open = $('.task-modal-single:visible').length;
        var estimate_pipeline_open = $('.estimate-pipeline:visible').length;
        var proposal_pipeline_open = $('.proposal-pipeline-modal:visible').length;
        // Fix for scroll
        task_single_open && $('body').addClass('modal-open');
        estimate_pipeline_open && $('body').addClass('modal-open');
        proposal_pipeline_open && $('body').addClass('modal-open');
    });

    $('body').on('blur', 'textarea[name="checklist-description"]', function() {
        var description = $(this).val();
        var listid = $(this).parents('.checklist').data('checklist-id');
        $.post(admin_url + 'tasks/update_checklist_item', {
            description: description,
            listid: listid
        });
    });

    // Assign task to staff member
    $('body').on('change', 'select[name="select-assignees"]', function() {
        $('body').append('<div class="dt-loader"></div>');
        var data = {};
        data.assignee = $('select[name="select-assignees"]').val();
        data.taskid = taskid;
        $.post(admin_url + 'tasks/add_task_assignees', data).success(function(response) {
            $('body').find('.dt-loader').remove();
            response = $.parseJSON(response);
            reload_tasks_tables();
            init_task_modal(taskid);
        });
    });

    // Add follower to task
    $('body').on('change', 'select[name="select-followers"]', function() {
        var data = {};
        data.follower = $('select[name="select-followers"]').val();
        data.taskid = taskid;
        $('body').append('<div class="dt-loader"></div>');
        $.post(admin_url + 'tasks/add_task_followers', data).success(function(response) {
            response = $.parseJSON(response);
            $('body').find('.dt-loader').remove();
            init_task_modal(taskid);
        });
    });

    $('body').on('show.bs.modal', '#task-tracking-stats-modal', function(event) {
     setTimeout(function(){
       tracking_chart = new Chart($('body').find('#task-tracking-stats-chart'),{
        type:'line',
        data:task_tracking_stats_data,
    },1000);
   });
 });
});

function recalculate_checklist_items_progress() {
    var total_finished = $('input[name="checklist-box"]:checked').length;
    var total_checklist_items = $('input[name="checklist-box"]').length;
    var percent = 0;
    if (total_checklist_items == 0) {
        // remove the heading for checklist items
        $('body').find('.chk-heading').remove();
        $('.checklist-items-wrapper').addClass('hide');
    } else {
        $('.checklist-items-wrapper').removeClass('hide');
    }
    if (total_checklist_items > 2) {
        percent = (total_finished * 100) / total_checklist_items;
    } else {
        $('.task-progress-bar').parents('.progress').addClass('hide');
        return false;
    }
    $('.task-progress-bar').css('width', percent.toFixed(2) + '%');
    $('.task-progress-bar').text(percent.toFixed(2) + '%');
}

function delete_checklist_item(id, field) {
    var r = confirm(confirm_action_prompt);
    if (r == false) {return false;} else {
        $.get(admin_url + 'tasks/delete_checklist_item/' + id, function(response) {
            if (response.success == true) {
                $(field).parents('.checklist').remove();
                recalculate_checklist_items_progress();
            }
        }, 'json');
    }
}

function add_task_checklist_item() {
    $.post(admin_url + 'tasks/add_checklist_item', {
        taskid: taskid
    }).success(function() {
        init_tasks_checklist_items(true);
    });
}
function init_tasks_checklist_items(is_new) {
    $.post(admin_url + 'tasks/init_checklist_items', {
        taskid: taskid
    }).success(function(data) {
        $('#checklist-items').html(data);
        if (typeof(is_new) != 'undefined') {
            $('body').find('.checklist textarea').eq(0).focus();
        }
        update_checklist_order();
        var total_checklist_items = $('body').find('input[name="checklist-box"]').length;
        if (total_checklist_items == 0) {
            $('.checklist-items-wrapper').addClass('hide');
        } else {
            $('.checklist-items-wrapper').removeClass('hide');
        }
    });
}

function remove_task_attachment(link, id) {
    var r = confirm(confirm_action_prompt);
    if (r == false) {
        return false;
    } else {
        $.get(admin_url + 'tasks/remove_task_attachment/' + id, function(response) {
            if (response.success == true) {
                $(link).parents('li').remove();
            }
        }, 'json');
    }
}

function add_task_comment() {
    var comment = tinyMCE.activeEditor.getContent();
    if (comment == '') {
        return;
    }
    var data = {};
    data.content = comment;
    data.taskid = taskid;
    $('body').append('<div class="dt-loader"></div>');
    $.post(admin_url + 'tasks/add_task_comment', data).success(function(response) {
        response = $.parseJSON(response);
        $('body').find('.dt-loader').remove();
        if (response.success == true) {
            init_task_modal(taskid);
        }
    });
}

// Reload followers select field and removes the already added follower from the select field
function reload_followers_select() {
    $.get(admin_url + 'tasks/reload_followers_select/' + taskid, function(response) {
        $('select[name="select-followers"]').html(response);
        $('select[name="select-followers"]').selectpicker('refresh');
    });
}
// Reload assignes select field and removes the already added assignees from the select field
function reload_assignees_select() {
    $.get(admin_url + 'tasks/reload_assignees_select/' + taskid, function(response) {
        $('select[name="select-assignees"]').html(response);
        $('select[name="select-assignees"]').selectpicker('refresh');
    });
}
// Deletes task comment from database
function remove_task_comment(commentid) {
    var r = confirm(confirm_action_prompt);
    if (r == false) {return false;} else {
        $.get(admin_url + 'tasks/remove_comment/' + commentid, function(response) {
            if (response.success == true) {
                $('[data-commentid="' + commentid + '"]').remove();
            }
        }, 'json');
    }
}
// Remove task assignee
function remove_assignee(id, taskid) {
    var r = confirm(confirm_action_prompt);
    if (r == false) {return false;} else {
        $.get(admin_url + 'tasks/remove_assignee/' + id + '/' + taskid, function(response) {
            if (response.success == true) {
                alert_float('success', response.message);
            } else {
                alert_float('warning', response.message);
            }
            init_task_modal(taskid);
        }, 'json');
    }
}
// Remove task follower
function remove_follower(id, taskid) {
    var r = confirm(confirm_action_prompt);
    if (r == false) {return false;} else {
        $.get(admin_url + 'tasks/remove_follower/' + id + '/' + taskid, function(response) {
            if (response.success == true) {
                alert_float('success', response.message);
                init_task_modal(taskid);
            }
        }, 'json');
    }
}

// Marking task as complete
function mark_complete(task_id) {
    $('body').append('<div class="dt-loader"></div>');
    $.get(admin_url + 'tasks/mark_complete/' + task_id, function(response) {
        $('body').find('.dt-loader').remove();
        if (response.success == true) {
            reload_tasks_tables();
            if ($('.task-modal-single').is(':visible')) {
                init_task_modal(task_id);
            }
            alert_float('success', response.message);
            if ($('body').hasClass('home')) {
                $('body').find('[data-widget-task-id="' + task_id + '"]').remove();
            }
        }
    }, 'json');
}

function reload_tasks_tables() {
    if ($.fn.DataTable.isDataTable('.table-tasks')) {
        $('.table-tasks').DataTable().ajax.reload();
    }
    if ($.fn.DataTable.isDataTable('.table-rel-tasks')) {
        $('.table-rel-tasks').DataTable().ajax.reload();
    }
    if ($.fn.DataTable.isDataTable('.table-rel-tasks-leads')) {
        $('.table-rel-tasks-leads').DataTable().ajax.reload();
    }
    if ($.fn.DataTable.isDataTable('.table-timesheets')) {
        $('.table-timesheets').DataTable().ajax.reload();
    }
}

// Marking task as complete
function unmark_complete(task_id) {
    $('body').append('<div class="dt-loader"></div>');
    $.get(admin_url + 'tasks/unmark_complete/' + task_id, function(response) {
        $('body').find('.dt-loader').remove();
        if (response.success == true) {
            reload_tasks_tables();
            if ($('.task-modal-single').is(':visible')) {
                init_task_modal(task_id);
            }
            alert_float('success', response.message);
        }
    }, 'json');
}

function make_task_public(task_id) {
    $.get(admin_url + 'tasks/make_public/' + task_id, function(response) {
        if (response.success == true) {
            reload_tasks_tables();
            init_task_modal(task_id);
        }
    }, 'json');
}

function new_task(url) {
    var _url = admin_url + 'tasks/task';
    if (typeof(url) != 'undefined') {
        _url = url;
    }
    $.get(_url, function(response) {
        $('#_task').html(response)
        $('body').find('#_task_modal').modal('show');
    });
}

function new_task_from_relation(table, rel_type, rel_id) {
    if (typeof(rel_type) == 'undefined' && typeof(rel_id) == 'undefined') {
        rel_id = $(table).data('new-rel-id');
        rel_type = $(table).data('new-rel-type');
    }
    var url = admin_url + 'tasks/task?rel_id=' + rel_id + '&rel_type=' + rel_type;
    new_task(url);
}

// Go to edit view
function edit_task(_task_id) {
    if (typeof(_task_id) != 'undefined') {
        taskid = _task_id;
    }
    $.get(admin_url + 'tasks/task/' + taskid, function(response) {
        $('#_task').html(response)
        $('body').find('#_task_modal').modal('toggle');
    });
}
function task_form_handler(form) {
    tinymce.triggerSave();
    var data = $(form).serialize();
    var url = form.action;
    $.post(url, data).success(function(response) {
        response = $.parseJSON(response);
        if (response.success == true) {
            alert_float('success', response.message);
        }
        if (!$('body').hasClass('project')) {
            $('#_task_modal').modal('hide');
            reload_tasks_tables();
            if (response.id) {
                init_task_modal(response.id);
                taskid = response.id;
            } else {
                init_task_modal(taskid);
            }
        } else {
            $('#_task_modal').modal('hide');
            var _r_task_id;
            if (response.id) {
                _r_task_id = response.id;
            } else {
                _r_task_id = taskid;
            }
            // reload page on project area
            var location = window.location.href;
            var parameters = new Array();
            location = location.split('?');
            var group = get_url_param('group');
            if (group) {
                parameters['group'] = group;
            }
            parameters['taskid'] = _r_task_id;
            window.location.href = buildUrl(location[0], parameters)
        }
    }).fail(function(error) {
        var response = $.parseJSON(error.responseText);
        alert_float('danger', response.message);
    });
    return false;
}

function timer_action(e, task_id, timer_id) {
    if (typeof(timer_id) == 'undefined') {
        timer_id = '';
    }
    $(e).addClass('disabled');
    $.get(admin_url + 'tasks/timer_tracking/' + task_id + '/' + timer_id, function(response) {
        $(e).removeClass('disabled');
        if ($('.task-modal-single').is(':visible')) {
            init_task_modal(task_id);
        }
        init_timers();
        reload_tasks_tables();
    }, 'json');
}

function init_task_modal(taskid) {
    tinymce.remove('#task_comment');
    $.post(admin_url + 'tasks/get_task_data/', {
        taskid: taskid
    }).success(function(response) {
        taskid = taskid;
        $('.task-modal-single .modal-content .data').html(response);
        init_editor('#task_comment', {
            height: 150
        });
        reload_followers_select();
        reload_assignees_select();
        init_tasks_checklist_items();
        $('.task-modal-single').modal('show');

        $('body').find('.task-single-col').addClass('fadeIn');
    });
}

function task_tracking_stats(id) {
    $.get(admin_url + 'tasks/task_tracking_stats/' + id, function(response) {
        $('body').find('#tacking-stats').html(response);
        $('#task-tracking-stats-modal').modal('toggle');
    });
}
function init_timers() {
    $.get(admin_url + 'tasks/get_staff_started_timers', function(response) {
        if (response.timers_found) {$('.top-timers').addClass('text-warning');} else {$('.top-timers').removeClass('text-warning');
    }
    $('.started-timers-top').html(response.html);
}, 'json');
}
function edit_task_comment(id) {
    var edit_wrapper = $('[data-edit-comment="' + id + '"]');
    edit_wrapper.next().addClass('hide');
    edit_wrapper.removeClass('hide');
    init_editor('[data-edit-comment="' + id + '"] textarea', {
        height: 150
    });
    tinymce.triggerSave();
}

function cancel_edit_comment(id) {
    var edit_wrapper = $('[data-edit-comment="' + id + '"]');
    tinymce.remove('[data-edit-comment="' + id + '"] textarea');
    edit_wrapper.addClass('hide');
    edit_wrapper.next().removeClass('hide');
}

function save_edited_comment(id) {
    tinymce.triggerSave();
    var data = {};
    data.id = id;
    data.content = $('[data-edit-comment="' + id + '"]').find('textarea').val();
    $.post(admin_url + 'tasks/edit_comment', data).success(function(response) {
        response = $.parseJSON(response);
        if (response.success == true) {
            alert_float('success', response.message);
            init_task_modal(taskid);
        } else {
            cancel_edit_comment(id);
        }
        tinymce.remove('[data-edit-comment="' + id + '"] textarea');
    });
}
function update_checklist_order() {
  var order = [];
  var status = $('body').find('.checklist');
  var i = 1;
  $.each(status, function() {
      order.push([$(this).data('checklist-id'), i]);
      i++;
  });
  var data = {}
  data.order = order;
  $.post(admin_url + 'tasks/update_checklist_order', data);
}
