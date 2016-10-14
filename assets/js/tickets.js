$(document).ready(function() {
    // Add predefined reply click
    $('.add_predefined_reply').on('click', function(e) {
        e.preventDefault();
        var message = $(this).parents('li').find('.message').html();
        tinymce.activeEditor.execCommand('mceInsertContent', false, message);
        $('#insert_predefined_reply').modal('hide');
    });

    $('.block-sender').on('click', function() {
        var sender = $(this).data('sender');
        if (sender == '') {
            alert('No Sender Found');
            return false;
        }
        $.post(admin_url + 'tickets/block_sender', {
            sender: sender
        }).success(function() {
            window.location.reload();
        });
    });

    // Admin ticket note add
    $('.add_note_ticket').on('click', function(e) {
        e.preventDefault();
        var note_description = $('textarea[name="note_description"]').val();
        var ticketid = $('input[name="ticketid"]').val();
        if (note_description == '') {
            return;
        }
        $.post(admin_url + 'misc/add_note/' + ticketid + '/ticket', {
            description: note_description
        }).success(function() {
            window.location.reload();
        });
    });

    // Update ticket settings from settings tab
    $('.save_changes_settings_single_ticket').on('click', function(e) {
        e.preventDefault();
        var data = {};
        var service = $('select[name="service"]').val();
        data.subject = $('input[name="subject"]').val();
        data.userid = $('input[name="userid"]').val();
        data.contactid = $('select[name="contactid"]').val();
        data.department = $('select[name="department"]').val();
        data.priority = $('select[name="priority"]').val();
        data.ticketid = $('input[name="ticketid"]').val();
        data.assigned = $('select[name="assigned"]').val();
        data.project_id = $('select[name="project_id"]').val();
        data.custom_fields = [];
        var _cfield_data;
        $('[name^="custom_fields"]').map(function() {
            data.custom_fields.push([$(this).data('fieldto'),$(this).data('fieldid'),this.value]);
        }).get();
        if (typeof(service) !== 'undefined') {
            data.service = service;
        }
        $.post(admin_url + 'tickets/update_single_ticket_settings', data).success(function(response) {
            response = $.parseJSON(response);
            if (response.success == true) {
                if (typeof(response.department_reassigned) !== 'undefined') {
                    window.location.href = admin_url + 'tickets/';
                } else {
                    window.location.reload();
                }
            }
        });
    });

    // Change ticket status without replying
    $('select[name="status_top"]').on('change', function() {
        var status = $(this).val();
        var ticketid = $('input[name="ticketid"]').val();
        $.get(admin_url + 'tickets/change_status_ajax/' + ticketid + '/' + status, function(response) {
            alert_float(response.alert, response.message);
        }, 'json');
    });

    // Select ticket user id
    $('body.ticket select[name="contactid"]').on('change', function() {
        var contactid = $(this).val();
        if (contactid != '') {
            $.post(admin_url + 'tickets/ticket_change_data/',{contact_id:contactid}).success(function(response){
                response = $.parseJSON(response);
                $('input[name="to"]').val(response.contact_data.firstname + ' ' + response.contact_data.lastname);
                $('input[name="email"]').val(response.contact_data.email);
                $('input[name="userid"]').val(response.contact_data.userid);
                $('#project_id').empty();
                $('#project_id').append('<option value="0" selected></option>');
                $.each(response.projects,function(i,obj){
                    $('#project_id').append('<option value="'+obj.id+'">'+obj.name+'</option>');
                });
                $('#project_id').selectpicker('refresh');
            });
        } else {
            $('input[name="to"]').val('');
            $('input[name="email"]').val('');
            $('input[name="contactid"]').val('');
        }
    });

    // + button for adding more attachments
    $('.add_more_attachments').on('click', function() {
        if($(this).hasClass('disabled')){return false;}
        var total_attachments = $('input[name="attachments[]"]').length;
        if (total_attachments >= maximum_allowed_ticket_attachments) {
            return false;
        }
        var newattachment = $('.attachments').find('.attachment').eq(0).clone().appendTo('.attachments');
        $(newattachment).find('input').val('');
        $(newattachment).find('i').removeClass('fa-plus').addClass('fa-minus');
        $(newattachment).find('button').removeClass('add_more_attachments').addClass('remove_attachment').removeClass('btn-success').addClass('btn-danger');
    });
    // Remove attachment
    $('body').on('click', '.remove_attachment', function() {
        $(this).parents('.attachment').remove();
    });
});

// Insert ticket knowledge base link modal
function insert_ticket_knowledgebase_link(id) {
    $.get(admin_url + 'knowledge_base/get_article_by_id_ajax/' + id, function(response) {
        var textarea = $('textarea[name="message"]');
        tinymce.activeEditor.execCommand('mceInsertContent', false, site_url + 'knowledge_base/' + response.slug);
        $('#insert_knowledge_base_link').modal('hide');
    }, 'json');
}
