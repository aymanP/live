var leads_update_req;
window.onbeforeunload = function() {
    if (leads_update_req) {
        return 'Request in progress....are you sure you want to continue? If you have a lot of leads takes time to update all leads orders. If this still shows after couple of minutes refresh your page.';
    }
};
// JS files used for leads
$(document).ready(function() {
    if (typeof(c_leadid) != 'undefined') {
        if (c_leadid != '') {
            init_lead(c_leadid);
        }
    }
    // Status color change
    $('body').on('click', '.leads-kan-ban .cpicker', function() {
        var color = $(this).data('color');
        var status_id = $(this).parents('.panel-heading-bg').data('status-id');
        $.post(admin_url + 'leads/change_status_color', {
            color: color,
            status_id: status_id
        });
    });

    $('body').on('click','.new-lead-from-status',function(e){
        e.preventDefault();
        var status_id = $(this).parents('.kan-ban-col').data('col-status-id');
        init_lead_modal_data('undefined',admin_url+'leads/lead?status_id='+status_id);
    });

    $('body').on('change', 'input.include_leads_custom_fields', function() {
        var val = $(this).val();
        var fieldid = $(this).data('field-id');
        if (val == 2) {
            $('#merge_db_field_' + fieldid).removeClass('hide');
        } else {
            $('#merge_db_field_' + fieldid).addClass('hide');
        }
        if (val == 3) {
            $('#merge_db_contact_field_' + fieldid).removeClass('hide');
        } else {
            $('#merge_db_contact_field_' + fieldid).addClass('hide');
        }
    });
    // Open convert lead to client modal
    $('body').on('click', '.convert_lead_to_client_modal', function() {
        $('#convert_lead_to_client_modal').modal('toggle');
    });
    // Custom close to convert lead to client modal
    $('body').on('click', '.convert-client-close-modal', function() {
        $('#convert_lead_to_client_modal').modal('hide');
    });
    // Scroll fix
    $('body').on('hidden.bs.modal','#convert_lead_to_client_modal',function(event){
        var lead_modal_open = $('.lead-modal:visible').length;
        if(lead_modal_open > 0){
            $('body').addClass('modal-open');
        }
    });
    // Auto focus the lead name if user is adding new lead
    $('body').on('shown.bs.modal','.lead-modal',function(e){
        if($('body').find('.lead-modal input[name="leadid"]').length == 0){
            $('body').find('.lead-modal input[name="name"]').focus();
        }
    });
    // On hidden lead modal some actions need to be operated here
    $('.lead-modal').on('hidden.bs.modal', function(event) {
        // clear the hash
        if (!$('.lead-modal').is(':visible')) {
            history.pushState("", document.title, window.location.pathname + window.location.search);
        }
        // in case the convert to client modal is open to prevent the transparent modal screen
        $('#convert_lead_to_client_modal').modal('hide');
        $('.reminder-modal').modal('hide');
    });

    // Set hash on modal tab change
    $('body').on('click', '.lead-modal a[data-toggle="tab"]', function() {
        window.location.hash = this.hash;
    });

    // Submit notes on lead modal do ajax not the regular request
    $('body').on('submit', '.lead-modal #lead-notes', function() {
        var form = $(this);
        var data = $(form).serialize();
        $.post(form.attr('action'), data).success(function(lead_id) {
            init_lead_modal_data(lead_id);
        });
        return false;
    });

    // Add additional server params $_POST
    var LeadsServerParams = {
        "custom_view": "[name='custom_view']",
        "assigned": "[name='view_assigned']",
        "status": "[name='view_status']",
        "source": "[name='view_source']",
    }
    // Init the table
    var headers_leads = $('.table-leads').find('th');
    var not_sortable_leads = (headers_leads.length - 1);
    initDataTable('.table-leads', admin_url + 'leads?table_leads=true', [not_sortable_leads], [not_sortable_leads], LeadsServerParams);
    $('select[name="view_assigned"],select[name="view_status"],select[name="view_source"]').on('change', function() {
        $('.table-leads').DataTable().ajax.reload();
    });
    // When adding if lead is contacted today
    $('body').on('change', 'input[name="contacted_today"]', function() {
        var checked = $(this).prop('checked');
        if (checked == false) {
            $('.lead-select-date-contacted').removeClass('hide');
        } else {
            $('.lead-select-date-contacted').addClass('hide');
        }
    });

    $('body').on('change', 'input[name="contacted_indicator"]', function() {
        var val = $(this).val();
        if (val == 'yes') {
            $('.lead-select-date-contacted').removeClass('hide');
        } else {
            $('.lead-select-date-contacted').addClass('hide');
        }
    });
});

function init_lead(id) {
    if(init_lead_modal_data(id)){
        $('.lead-modal').modal('show');
    }
}
function validate_lead_form(formHandler) {
    _validate_form($('#lead_form'), {
        name: 'required',
        status: 'required',
        source: 'required',
        email: {
            email: true,
            remote: {
                url: admin_url + "leads/email_exists",
                type: 'post',
                data: {
                    email: function() {
                        return $('input[name="email"]').val();
                    },
                    leadid: function() {
                        return $('input[name="leadid"]').val();
                    }
                }
            }
        }
    }, formHandler);
}

function validate_lead_convert_to_client_form() {
    _validate_form($('#lead_to_client_form'), {
        'company': 'required',
        password: {
            required: {
                depends: function(element) {
                    var sent_set_password = $('input[name="send_set_password_email"]');
                    if (sent_set_password.prop('checked') == false) {
                        return true;
                    }
                }
            }
        },
        email: {
            required: true,
            email: true,
            remote: {
                url: site_url + "admin/misc/contact_email_exists",
                type: 'post',
                data: {
                    email: function() {
                        return $('#lead_to_client_form input[name="email"]').val();
                    },
                    userid: ''
                }
            }
        }

    });
}
// Lead profile data function form handler
function lead_profile_form_handler(form) {
    form = $(form);
    var data = form.serialize();
    var serializeArray = $(form).serializeArray();
    var leadid = $('.lead-modal').find('input[name="leadid"]').val();
    $.post(form.attr('action'), data).success(function(response) {
        response = $.parseJSON(response);
        if (response.id) {
            leadid = response.id;
        }
        init_lead_modal_data(leadid);
        // If is from kanban reload the list tables
        if ($.fn.DataTable.isDataTable('.table-leads')) {
            $('.table-leads').DataTable().ajax.reload();
        }
    }).error(function(data){
        alert_float('danger',data.responseText);
        return false;
    });
    return false;
}

function init_lead_modal_data(id,url) {
    if (typeof(id) == 'undefined') {id = '';}
    var _url = admin_url + 'leads/lead/' + id;
    if(typeof(url) != 'undefined'){_url = url;}
    // get the current hash
    var hash = window.location.hash;
    // clean the modal
    $('.lead-modal .modal-body').html('');
    $.get(_url, function(data) {
        $('.lead-modal .modal-body').html(data);
        $('.lead-modal').modal('show');
        window.location.hash = hash;
    }).error(function(data){
        $('.lead-modal').modal('hide');
        alert_float('danger',data.responseText);
    });
}
// Kanban lead sort
function leads_kanban_sort(type) {
    var sort_type = $('input[name="sort_type"]');
    var sort = $('input[name="sort"]');
    sort_type.val(type);
    if (sort.val() == 'ASC') {
        sort.val('DESC');
    } else if (sort.val() == 'DESC') {
        sort.val('ASC');
    } else {
        sort.val('DESC');
    }
    leads_kanban($('input[name="search"]').val());
}
// Init the leads kanban
function leads_kanban(search) {
    var parameters = new Array();
    if (typeof(search) !== 'undefined') {
        if (search != '') {
            parameters['search'] = search;
        }
    }
    var sort_type = $('input[name="sort_type"]');
    var sort = $('input[name="sort"]').val();
    if (sort_type.val() != '') {
        parameters['sort_by'] = sort_type.val();
        parameters['sort'] = sort;
    }
    parameters['canban'] = true;
    if ($('#kan-ban').length == 0) {
        return;
    }
    var url = admin_url + 'leads';
    url = buildUrl(url, parameters)
    $('body').append('<div class="dt-loader"></div>');
    $('#kan-ban').load(url, function() {
        // Set the width of the kanban container
        $('body').find('div.dt-loader').remove();
        var kanbanCol = $('.kan-ban-content-wrapper');
        kanbanCol.css('max-height', (window.innerHeight - 290) + 'px');
        $('.kan-ban-content').css('min-height', (window.innerHeight - 290) + 'px');
        var kanbanColCount = parseInt(kanbanCol.length);
        $('.container-fluid').css('min-width', (kanbanColCount * 360) + 'px');
        $("#kan-ban").sortable({
            helper: 'clone',
            item: '.kan-ban-col',
            update: function(event, ui) {
                var order = [];
                var status = $('.kan-ban-col');
                var i = 0;
                $.each(status, function() {
                    order.push([$(this).data('col-status-id'), i]);
                    i++;
                });
                var data = {}
                data.order = order;
                $.post(admin_url + 'leads/update_status_order', data);
            }
        });
        $(".status").sortable({
            connectWith: ".leads-status",
            helper: 'clone',
            appendTo: '#kan-ban',
            placeholder: "ui-state-highlight-card",
            revert: 'invalid',
            scroll: true,
            scrollSensitivity: 50,
            scrollSpeed: 70,
            start: function(event, ui) {
                // Save the old status for activity log
                $(ui.item).data('old-status', $(ui.item.parent()[0]).data('lead-status-id'));
            },
            drag: function(event, ui) {
                var st = parseInt($(this).data("startingScrollTop"));
                ui.position.top -= $(this).parent().scrollTop() - st;
            },
            update: function(event, ui) {
                if (this === ui.item.parent()[0]) {
                    var data = {};
                    data.status = $(ui.item.parent()[0]).data('lead-status-id');
                    data.old_status = $(ui.item).data('old-status');
                    data.leadid = $(ui.item).data('lead-id');

                    var order = [];
                    var status = $(ui.item).parents('.leads-status').find('li')
                    var i = 1;
                    $.each(status, function() {
                        order.push([$(this).data('lead-id'), i]);
                        i++;
                    });
                    data.order = order;
                    setTimeout(function() {
                        leads_update_req = $.post(admin_url + 'leads/update_can_ban_lead_status', data).success(function(response) {
                            leads_update_req = null;
                        });
                    }, 200);

                }
            }
        });
        $('.status').sortable({
            cancel: '.not-sortable'
        });
    });
}
// Deleting lead attachments
function delete_lead_attachment(wrapper, id) {
    var r = confirm(confirm_action_prompt);
    if (r == false) {return false;} else {
        $.get(admin_url + 'leads/delete_attachment/' + id, function(response) {
            if (response.success == true) {
                $(wrapper).parents('.lead-attachment-wrapper').remove();
            }
        }, 'json');
    }
}
// Deleting lead note
function delete_lead_note(wrapper, id) {
    var r = confirm(confirm_action_prompt);
    if (r == false) {return false;} else {
        $.get(admin_url + 'leads/delete_note/' + id, function(response) {
            if (response.success == true) {
                $(wrapper).parents('.lead-note').remove();
            }
        }, 'json');
    }
}
// Mark lead as lost function
function lead_mark_as_lost(lead_id) {
    $.get(admin_url + 'leads/mark_as_lost/' + lead_id, function(response) {
        if (response.success == true) {
            alert_float('success', response.message);
        }
        init_lead_modal_data(lead_id);
    }, 'json');
}
// Unmark lead as lost function
function lead_unmark_as_lost(lead_id) {
    $.get(admin_url + 'leads/unmark_as_lost/' + lead_id, function(response) {
        if (response.success == true) {
            alert_float('success', response.message);
        }
        init_lead_modal_data(lead_id);
    }, 'json');
}
// Mark lead as junk function
function lead_mark_as_junk(lead_id) {
    $.get(admin_url + 'leads/mark_as_junk/' + lead_id, function(response) {
        if (response.success == true) {
            alert_float('success', response.message);
        }
        init_lead_modal_data(lead_id);
    }, 'json');
}
// Unmark lead as junk function
function lead_unmark_as_junk(lead_id) {
    $.get(admin_url + 'leads/unmark_as_junk/' + lead_id, function(response) {
        if (response.success == true) {
            alert_float('success', response.message);
        }
        init_lead_modal_data(lead_id);
    }, 'json');
}
// Statuses function for add/edit becuase there is ability to edit the status directly from the lead kanban
$(document).ready(function(){
    _validate_form($('body').find('#leads-status-form'),{name:'required'},manage_leads_statuses);
    $('#status').on('hidden.bs.modal', function(event) {
        $('#additional').html('');
        $('#status input').val('');
        $('.add-title').removeClass('hide');
        $('.edit-title').removeClass('hide');
        $('#status input[name="statusorder"]').val($('table tbody tr').length + 1);
    });
});
// Form handler function for leads status
function manage_leads_statuses(form) {
    var data = $(form).serialize();
    var url = form.action;
    $.post(url, data).success(function(response) {
        window.location.reload();
    });
    return false;
}
// Create lead new status
function new_status(){
    $('#status').modal('show');
    $('.edit-title').addClass('hide');
}
// Edit status function which init the data to the modal
function edit_status(invoker,id){
    $('#additional').append(hidden_input('id',id));
    $('#status input[name="name"]').val( $(invoker).data('name'));
    $('#status .colorpicker-input').colorpicker('setValue',$(invoker).data('color'));
    $('#status input[name="statusorder"]').val($(invoker).data('order'));
    $('#status').modal('show');
    $('.add-title').addClass('hide');
}
