 $(window).load(function(){
    var height = $(document).outerHeight(true);
    $('.proposal-right').height(height + 'px');
});
 $(document).ready(function(){

    $.extend($.validator.messages, {
        required: field_is_required
    });

    $.validator.setDefaults({
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'text-danger',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length || element.parent('.checkbox').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
    init_progress_bars();
    jQuery.datetimepicker.setLocale(locale);
    init_datepicker();
    $('body').tooltip({
     selector: '[data-toggle="tooltip"]'
 });

    $('.article_useful_buttons button').on('click',function(e){
      e.preventDefault();
      var data = {};
      data.answer = $(this).data('answer');
      data.articleid = $('input[name="articleid"]').val();
      $.post(window.location.href,data).success(function(response){
         response = $.parseJSON(response);
         if(response.success == true){
            $(this).focusout();
        }
        $('.answer_response').html(response.message);
    });
  });
    $('body').on('click','[data-loading-text]',function(){
        var form = $(this).data('form');
        if(form != null){
            if($(form).valid()){
                $(this).button('loading');
            }
        } else {
            $(this).button('loading');
        }
    });

    $('#survey_form').validate();
    var survey_fields_required = $('#survey_form').find('[data-required="1"]');
    $.each(survey_fields_required, function() {
        $(this).rules("add", {
            required: true
        });
    });

});
 function init_progress_bars() {
    setTimeout(function() {
        $('.progress .progress-bar').each(function() {
            var bar = $(this);
            var perc = bar.attr("data-percent");
            var current_perc = 0;
            var progress = setInterval(function() {
                if (current_perc >= perc) {
                    clearInterval(progress);
                    if (perc == 0) {
                        bar.css('width', 0 + '%');
                    }
                } else {
                    current_perc += 1;
                    bar.css('width', (current_perc) + '%');
                }
                if(!bar.hasClass('no-percent-text')){
                    bar.text((current_perc) + '%');
                }
            }, 10);
        });
    }, 300);
}
function init_datepicker() {
    var datepickers = $('.datepicker');
    var datetimepickers = $('.datetimepicker');
    var opt;
    $.each(datepickers, function() {
        var opt = {
            format: date_format,
            timepicker: false,
            lazyInit: true,
        };
        var max_date = $(this).data('date-end-date');
        var min_date = $(this).data('date-min-date');
        if (max_date) {
            opt.maxDate = max_date;
        }
        if (min_date) {
            opt.minDate = min_date;
        }
        $(this).datetimepicker(opt);
    });
    var opt_time;
    $.each(datetimepickers, function() {
        opt_time = {
            format: date_format + ' H:i',
            lazyInit: true,
        };
        var max_date = $(this).data('date-end-date');
        var min_date = $(this).data('date-min-date');
        if (max_date) {
            opt_time.maxDate = max_date;
        }
        if (min_date) {
            opt_time.minDate = min_date;
        }
        $(this).datetimepicker(opt_time);
    });
    $('.calendar-icon').on('click', function() {
        $(this).parents('.date').find('.datepicker').datetimepicker('show');
        $(this).parents('.date').find('.datetimepicker').datetimepicker('show');
    });
}
function is_mobile() {
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        return true;
    }
    return false;
}
