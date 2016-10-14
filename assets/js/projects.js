  $(window).load(function() {
    fix_project_overview_height();
    fix_phases_height();
  });
  $(window).resize(function() {
    fix_project_overview_height();
    fix_phases_height();
  });
  var expenseDropzone;
  $(document).ready(function() {

      // in case invoice hash found in url
      init_invoice();

      for (var i = -10; i < $('.task-phase').not('.color-not-auto-adjusted').length / 2; i++) {
        var r = 120;
        var g = 169;
        var b = 56;
        $('.task-phase:eq(' + (i + 10) + ')').not('.color-not-auto-adjusted').css('background', color(r - (i * 13), g - (i * 13), b - (i * 13))).css('border', '1px solid ' + color(r - (i * 13), g - (i * 13), b - (i * 13)));
      };

      fix_phases_height();

      $('body').on('click', '.milestone-column .cpicker,.milestone-column .reset_milestone_color', function(e) {
        e.preventDefault();
        var color = $(this).data('color');
        var invoker = $(this);
        var milestone_id = invoker.parents('.milestone-column').data('milestone-id');
        $.post(admin_url + 'projects/change_milestone_color', {
          color: color,
          milestone_id: milestone_id
        }).success(function(){
          // Reset color needs reload
          if(color == ''){
            window.location.reload();
          } else {
            invoker.parents('.milestone-column').find('.reset_milestone_color').removeClass('hide');
            invoker.parents('.milestone-column').find('.panel-heading').addClass('color-white').removeClass('task-phase');
            invoker.parents('.milestone-column').find('.edit-milestone-phase').addClass('color-white');
          }
        })
      });

      $("body").find('.milestone-tasks-wrapper').sortable({
        connectWith:'.ms-task',
        helper:'clone',
        items:'li.sortable',
        placeholder: 'ui-sortable-placeholder',
        update: function(event, ui) {
          if (this === ui.item.parent()[0]) {
            data = {};
            data.milestone_id = $(ui.item.parent()[0]).parents('.milestone-column').data('milestone-id');
            data.task_id = $(ui.item).data('task-id');
            $.post(admin_url+'projects/update_task_milestone',{data});
            fix_phases_height();
          }
        }
      });

      Dropzone.options.projectFilesUpload = {
        paramName: "file",
        addRemoveLinks: true,
        accept: function(file, done) {
          done();
        },
        success: function(file, response) {
          if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
            window.location.reload();
          }
        },
        acceptedFiles: allowed_files,
        error: function(file, response) {
          alert_float('danger', response);
        },
        sending: function(file, xhr, formData) {
          formData.append("visible_to_customer", $('input[name="visible_to_customer"]').prop('checked'));
        }
      };

      if ($('#dropzoneDragArea').length > 0) {
        Dropzone.autoDiscover = false;
        expenseDropzone = new Dropzone("#project-expense-form", {
          autoProcessQueue: false,
          clickable: '#dropzoneDragArea',
          acceptedFiles: allowed_files,
          previewsContainer: '.dropzone-previews',
          dictDefaultMessage:drop_files_here_to_upload,
          dictFallbackMessage:browser_not_support_drag_and_drop,
          dictRemoveFile:remove_file,
          dictMaxFilesExceeded:you_can_not_upload_any_more_files,
          addRemoveLinks: true,
          maxFiles: 1,
          error: function(file, response) {
            alert_float('danger', response);
          },
          success: function(file, response) {
            response = $.parseJSON(response);
            if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
              window.location.reload();
            }
          },

        });
      }

      _validate_form($('#project-expense-form'), {
        category: 'required',
        date: 'required',
        amount: 'required',
        currency: 'required'
      }, projectExpenseSubmitHandler);

      gantt = $("#gantt").gantt({
        source: gantt_data,
        minScale: "years",
        maxScale: "years",
        itemsPerPage: 20,
        navigate: 'scroll',
        onRender:function(){
          var rm = $('#gantt .leftPanel .name .fn-label:empty').parents('.name').css('background','initial');
          $('#gantt .leftPanel .spacer').html('<span class="gantt_project_name"><i class="fa fa-cubes"></i> '+$('.project-name').text()+'</span>');
          var _percent = $('input[name="project_percent"]').val();
          $('#gantt .leftPanel .spacer').append('<div style="padding:10px 20px 10px 20px;"><div class="progress mtop5 progress-bar-mini"><div class="progress-bar progress-bar-success no-percent-text" role="progressbar" aria-valuenow="'+_percent+'" aria-valuemin="0" aria-valuemax="100" style="width: 0%" data-percent="'+_percent+'"></div></div></div>');
          init_progress_bars();
        },
        onItemClick:function(data){
          init_task_modal(data.task_id);
        },
        onAddClick:function(dt, rowId){
          var fmt = new DateFormatter();
          var d0 = new Date(+dt);
          var d1 = fmt.formatDate(d0, date_format);
          new_task(admin_url+'tasks/task?rel_type=project&rel_id='+project_id+'&start_date='+d1);
        }
      });

        // Expenses additional server params
        var Expenses_ServerParams = {};
        $.each($('._hidden_inputs._filters input'),function(){
          Expenses_ServerParams[$(this).attr('name')] = '[name="'+$(this).attr('name')+'"]';
        });
        _table_api = initDataTable('.table-project-expenses', admin_url + 'projects/expenses/' + project_id, 'undefined', 'undefined', Expenses_ServerParams, [4, 'DESC']);
        if(_table_api){
          _table_api.column(0).visible(false, false).columns.adjust().draw(false);
        }
        init_rel_tasks_table(project_id, 'project');
        initDataTable('.table-notes', admin_url + 'projects/notes/' + project_id, [4], [4], 'undefined', [1, 'DESC']);
        initDataTable('.table-milestones', admin_url + 'projects/milestones/' + project_id, [2], [2]);
        initDataTable('.table-timesheets', admin_url + 'projects/timesheets/' + project_id, [5], [5], 'undefined', [2, 'DESC']);
        initDataTable('.table-project-discussions', admin_url + 'projects/discussions/' + project_id, [4], [4], 'undefined', [1, 'DESC']);
        _validate_form($('#milestone_form'), {
          name: 'required',
          due_date: 'required'
        });
        _validate_form($('#copy_form'), {
          start_date: 'required',
          deadline: 'required'
        });

        _validate_form($('#discussion_form'), {
          subject: 'required',
        }, manage_discussion);

        var timesheet_rules = {};
        var time_sheets_form_elements = $('#timesheet_form').find('select');
        $.each(time_sheets_form_elements, function() {
          var name = $(this).attr('name');
          timesheet_rules[name] = 'required';
        });
        timesheet_rules['start_time'] = 'required';
        timesheet_rules['end_time'] = 'required';
        _validate_form($('#timesheet_form'), timesheet_rules, manage_timesheets);

        $('#discussion').on('hidden.bs.modal', function(event) {
          $('#discussion input[name="subject"]').val('');
          $('#discussion textarea[name="description"]').val('');
          $('#discussion input[name="show_to_customer"]').prop('checked', true);
          $('#discussion .add-title').removeClass('hide');
          $('#discussion .edit-title').removeClass('hide');
        });

        $('#milestone').on('hidden.bs.modal', function(event) {
          $('#additional_milestone').html('');
          $('#milestone input[name="due_date"]').val('');
          $('#milestone input[name="name"]').val('');
          $('#milestone input[name="milestone_order"]').val($('.table-milestones tbody tr').length + 1);
          $('#milestone .add-title').removeClass('hide');
          $('#milestone .edit-title').removeClass('hide');
        });

        $('#timesheet').on('hidden.bs.modal', function(event) {
          $('#timesheet select[name="timesheet_staff_id"]').removeAttr('data-staff_id');
          $('#timesheet select[name="timesheet_staff_id"]').empty();
          $('#timesheet select[name="timesheet_staff_id"]').selectpicker('refresh');
          $('#timesheet select[name="timesheet_task_id"]').selectpicker('val', '');
          $('input[name="timer_id"]').val('');
        });

        $('#timesheet select[name="timesheet_task_id"]').on('change', function() {
          var _task_id = $(this).val();
          var staff_id;
          var select_staff = $('#timesheet select[name="timesheet_staff_id"]');
          if (select_staff.attr('data-staff_id')) {
            staff_id = select_staff.attr('data-staff_id');
          }
          $.get(admin_url + 'projects/timesheet_task_assignees/' + _task_id + '/' + project_id + '/' + staff_id, function(response) {
            select_staff.html(response);
            select_staff.selectpicker('refresh');
          });
        });

        $('input[name="tasks"].copy').on('change', function() {
          var checked = $(this).prop('checked');
          if (checked) {
            var copy_assignees = $('input[name="task_include_assignees"]').prop('checked');
            var copy_followers = $('input[name="task_include_followers"]').prop('checked');
            if (copy_assignees || copy_followers) {
              $('input[name="members"].copy').prop('checked', true);
            }
          }
        });

        $('input[name="task_include_assignees"],input[name="task_include_followers"]').on('change', function() {
          var checked = $(this).prop('checked');
          if (checked == true) {
            $('input[name="members"].copy').prop('checked', true);
          }
        });

        $('body').on('change', '#project_invoice_select_all_tasks', function() {
          var checked = $(this).prop('checked');
          if (checked == true) {
            $('input[name="tasks[]"]').prop('checked', true);
          } else {
            $('input[name="tasks[]"]').prop('checked', false);
          }
        });

        $('input[name="members"].copy').on('change', function() {
          var checked = $(this).prop('checked');
          var checked_tasks = $('input[name="tasks"].copy').prop('checked');
          if (!checked) {
            if (checked_tasks) {
              $('input[name="task_include_assignees"]').prop('checked', false);
              $('input[name="task_include_followers"]').prop('checked', false);
            }
          } else {
            if (checked_tasks) {
              $('input[name="task_include_assignees"]').prop('checked', true);
              $('input[name="task_include_followers"]').prop('checked', true);
            }
          }
        });
      });

  function fix_project_overview_height() {
    var maxPhaseHeight = Math.max.apply(null, $("div.project-overview-column .panel-body").map(function() {
      return $(this).outerHeight();
    }).get());
    $('div.project-overview-column .panel-body').css('min-height', maxPhaseHeight + 'px');
  }

  function fix_phases_height() {
    if(is_mobile()){return;}
    var maxPhaseHeight = Math.max.apply(null, $("div.tasks-phases .panel-body").map(function() {
      return $(this).outerHeight();
    }).get());
    $('div.tasks-phases .panel-body').css('min-height', maxPhaseHeight + 'px');
  }

  function milestones_switch_view() {
    $('#milestones-table').toggleClass('hide');
    $('.tasks-phases').toggleClass('hide');
    if ($('#milestones-table').hasClass('hide')) {
      $('.new-task-phase').removeClass('hide');
    } else {
      $('.new-task-phase').addClass('hide');
    }
    fix_phases_height();
  }

  function manage_discussion(form) {
    var data = $(form).serialize();
    var url = form.action;
    $.post(url, data).success(function(response) {
      response = $.parseJSON(response);
      if (response.success == true) {
        alert_float('success', response.message);
      }
      $('.table-project-discussions').DataTable().ajax.reload();
      $('#discussion').modal('hide');
    });
    return false;
  }

  function manage_timesheets(form) {
    var data = $(form).serialize();
    var url = form.action;
    $.post(url, data).success(function(response) {
      response = $.parseJSON(response);
      if (response.success == true) {
        alert_float('success', response.message);
      } else {
        alert_float('warning', response.message);
      }
      $('.table-timesheets').DataTable().ajax.reload();
      $('#timesheet').modal('hide');
    });
  }

  function edit_timesheet(invoker, id) {
    $('#timesheet select[name="timesheet_staff_id"]').attr('data-staff_id', $(invoker).data('timesheet_staff_id'));
    $('select[name="timesheet_task_id"]').selectpicker('val',$(invoker).data('timesheet_task_id'));
    $('input[name="timer_id"]').val(id);
    $('input[name="start_time"]').val($(invoker).data('start_time'));
    $('input[name="end_time"]').val($(invoker).data('end_time'));
    $('select[name="timesheet_task_id"]').change();
    $('#timesheet').modal('show');
  }


  function new_discussion() {
    $('#discussion').modal('show');
    $('#discussion .edit-title').addClass('hide');
  }

  function new_milestone() {
    $('#milestone').modal('show');
    $('#milestone .edit-title').addClass('hide');
  }

  function new_timesheet() {
    $('#timesheet').modal('show');
  }

  function edit_milestone(invoker, id) {
    $('#additional_milestone').append(hidden_input('id', id));
    $('#milestone input[name="name"]').val($(invoker).data('name'));
    $('#milestone input[name="due_date"]').val($(invoker).data('due_date'));
    $('#milestone input[name="milestone_order"]').val($(invoker).data('order'));
    $('#milestone').modal('show');
    $('#milestone .add-title').addClass('hide');
  }

  function edit_discussion(invoker, id) {
    $('#additional_discussion').append(hidden_input('id', id));
    $('#discussion input[name="subject"]').val($(invoker).data('subject'));
    $('#discussion textarea[name="description"]').val($(invoker).data('description'));

    var show_to_customer = $(invoker).data('show-to-customer');
    var checked = true;
    if (show_to_customer == 0) {
      checked = false;
    }
    $('#discussion input[name="show_to_customer"]').prop('checked', checked);
    $('#discussion').modal('show');
    $('#discussion .add-title').addClass('hide');
  }

  function mass_stop_timers(only_billable) {
    $.get(admin_url + 'projects/mass_stop_timers/' + project_id + '/' + only_billable, function(response) {
      alert_float(response.type, response.message);
      setTimeout(function() {
        $('body').find('.modal-backdrop').eq(0).remove();
        init_timers();
        reload_tasks_tables();
        pre_invoice_project();
      }, 500);
    }, 'json');
  }

  function pre_invoice_project() {
    $.get(admin_url + 'projects/get_pre_invoice_project_info/' + project_id, function(response) {
      $('#pre_invoice_project').html(response);
      $('#pre_invoice_project_settings').modal('show');
    });
  }

  function invoice_project(project_id) {
    $('#pre_invoice_project_settings').modal('hide');
    var data = {};

    data.type = $('input[name="invoice_data_type"]:checked').val();
    data.project_id = project_id;
    data.tasks = $("#tasks_who_will_be_billed input:checkbox:checked").map(function() {
      return $(this).val();
    }).get();

    data.expenses = $("#expenses_who_will_be_billed input:checkbox:checked").map(function() {
      return $(this).val();
    }).get();

    $.post(admin_url + 'projects/get_invoice_project_data/', data).success(function(response) {
      $('#invoice_project').html(response);
      $('#invoice-project-modal').modal('show');
          // Fix scroll for modal
          setTimeout(function() {
            $('body').addClass('modal-open');
          }, 500);
        });
  }

  function delete_project_discussion(id) {
    var r = confirm(confirm_action_prompt);
    if (r == false) {
      return false;
    } else {
      $.get(admin_url + 'projects/delete_discussion/' + id, function(response) {
        alert_float(response.alert_type, response.message);
        $('.table-project-discussions').DataTable().ajax.reload();
      }, 'json');
    }
  }

  function copy_project() {
    $('#copy_project').modal('show');
  }

  function projectExpenseSubmitHandler(form) {
    $.post(form.action, $(form).serialize()).success(function(response) {
      response = $.parseJSON(response);
      if (response.expenseid) {
        if (typeof(expenseDropzone) !== 'undefined') {
          if (expenseDropzone.getQueuedFiles().length > 0) {
            expenseDropzone.options.url = admin_url + 'expenses/add_expense_attachment/' + response.expenseid;
            expenseDropzone.processQueue();
          } else {
            window.location.assign(response.url);
          }
        } else {
          window.location.assign(response.url);
        }
      } else {
        window.location.assign(response.url);
      }
    });
    return false;
  }
