// JS File used in events
$(document).ready(function() {
    var _isRTL;
    if (isRTL == 'true') {
        _isRTL = true;
    } else {
        _isRTL = false;
    }
    validate_calendar_form();
    var settings = {
        customButtons: {},
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,viewFullCalendar'
        },
        loading: function(isLoading, view) {
            if (!isLoading) { // isLoading gives boolean value
                $('.dt-loader').addClass('hide');
            } else {
                $('.dt-loader').removeClass('hide');
            }
        },
        editable: true,
        eventLimit: 3,
        lang: locale,
        isRTL: _isRTL,
        eventSources: [{
            url: admin_url + 'utilities/get_calendar_data',
            type: 'GET',
            error: function() {
                alert('There was an error while fetching calendar data!');
            }
        }, ],
        eventRender: function(event, element) {
            element.attr('title', event._tooltip);
            element.attr('onclick', event.onclick);
            element.attr('data-toggle', 'tooltip');
            if (!event.url) {
                element.click(function() {
                    view_event(event.eventid);
                });
            }
        },
        eventStartEditable: false,
        dayClick: function(date, jsEvent, view) {
            $('#newEventModal').modal('show');
            date = date.toDate();
            $.post(admin_url+'misc/format_date',{date:date}).success(function(formated){
                $("input[name='start'].datetimepicker").val(formated);
            })
            return false;
        },
        firstDay: parseInt(calendar_first_day),
    }
    if ($('body').hasClass('home')) {
        settings.customButtons.viewFullCalendar = {
            text: calendar_expand,
            click: function() {
                window.location.href = admin_url + 'utilities/calendar';
            }
        }
    }
    if(is_staff_member == 1){
        if (google_api != '') {
            settings.googleCalendarApiKey = google_api;
        }
        if (calendarIDs != '') {
            calendarIDs = $.parseJSON(calendarIDs);
            if (calendarIDs.length != 0) {
                if (google_api != '') {
                    for (var i = 0; i < calendarIDs.length; i++) {
                        var _gcal = {};
                        _gcal.googleCalendarId = calendarIDs[i];
                        settings.eventSources.push(_gcal);
                    }
                } else {
                    alert('You have setup Google Calendar IDS but you dont have specified Google API key. To setup Google API key navigate to Setup->Settings->Misc->Misc');
                }
            }
        }
    }
    // Init calendar
    $('#calendar').fullCalendar(settings);
});

function view_event(id) {
    if (typeof(id) == 'undefined') {
        return;
    }
    $.post(admin_url + 'utilities/view_event/' + id).success(function(response) {
        $('#event').html(response);
        $('#viewEvent').modal('show');
        init_datepicker();
        validate_calendar_form();
    });
}

function delete_event(id) {
    $.get(admin_url + 'utilities/delete_event/' + id, function(response) {
        window.location.reload();
    }, 'json');
}

function validate_calendar_form() {
    _validate_form('._event form', {
        title: 'required',
        start: 'required'
    }, calendar_form_handler);
}
function calendar_form_handler(form) {
    $.post(form.action, $(form).serialize(), function(response) {
        response = $.parseJSON(response);
        if (response.success == true) {
            alert_float('success', response.message);
            setTimeout(function() {
                window.location.reload();
            }, 1500)
        }
    });

    return false;
}
