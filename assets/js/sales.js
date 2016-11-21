$(document).ready(function() {
    // Init invoices top stats
    init_invoices_total();
    // Init expenses total
    init_expenses_total();
    // Make items sortable
    init_estimates_total();
    // Make items sortable
    init_items_sortable();
    // Init items earch
    init_items_search();

    if ($('body').hasClass('estimates-pipeline')) {
        var estimate_id = $('input[name="estimateid"]').val();
        estimate_pipeline_open(estimate_id);
    }
    if ($('body').hasClass('proposals-pipeline')) {
        var proposal_id = $('input[name="proposalid"]').val();
        proposal_pipeline_open(proposal_id);
    }
    // Remove the disabled attribute from the currency input becuase the form dont read it
    $('body').on('submit','._transaction_form',function(){
        // On submit re-calculate total and reorder the items for all cases
        calculate_total();
        reorder_items();
        $('select[name="currency"]').removeAttr('disabled');
        $('select[name="project_id"]').removeAttr('disabled');
        return true;
    });

    $('body').on('click','#autocomplete_main',function(){
     var val = $(this).val();
     if(val == ''){
         $('#autocomplete_main').autocomplete('search',' ');
     }
 });

    $('body').on('change','[name="recurring"]',function(){
        var rec = $(this).val();
        if(rec != 0){
            $('body').find('#recurring_ends_on').removeClass('hide');
        } else {
            $('body').find('#recurring_ends_on').addClass('hide');
            $('body').find('#recurring_ends_on input').val('');
        }
    });

    // add estimate_note
    $('body').on('submit', '#estimate-notes', function() {
        var est_notes = $('#estimate-notes');
        if (est_notes.find('textarea[name="description"]').val() == '') {return;}
        var form = $(this);
        var data = $(form).serialize();
        $.post(form.attr('action'), data).success(function(estimate_id) {
            // Reload the notes
            get_estimate_notes(estimate_id);
            // Reset the note textarea value
            est_notes.find('textarea[name="description"]').val('');
        });
        return false;
    });
    // Show quantity as change we need to change on the table QTY heading for better user experience
    $('body').on('change', 'input[name="show_quantity_as"]', function() {
        $('body').find('th.qty').html($(this).data('text'));
    });
    $('body').on('change','div.invoice input[name="date"]', function() {
        // This function not work on edit
        if ($('input[name="isedit"]').length > 0) {return;}
        var date = $(this).val();
        if (date != '') {
           $.post(admin_url+'invoices/get_due_date',{date:date}).success(function(formated){
               $('input[name="duedate"]').val(formated);
           });
       } else {
           $('input[name="duedate"]').val('');
       }
   });

    $('#sales_attach_file').on('hidden.bs.modal', function(e) {
        $('#sales_uploaded_files_preview').empty();
        $('.dz-file-preview').empty();
    });

    Dropzone.options.salesUpload = {
        createImageThumbnails: false,
        sending: function(file, xhr, formData) {
            formData.append("rel_id", $('body').find('input[name="_attachment_sale_id"]').val());
            formData.append("type", $('body').find('input[name="_attachment_sale_type"]').val());
        },
        complete: function(file) {
            this.removeFile(file);
        },
        success: function(files, response) {
            response = $.parseJSON(response);
            if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                var type = $('body').find('input[name="_attachment_sale_type"]').val()
                var dl_url, delete_function;
                dl_url = 'download/file/sales_attachment/';
                delete_function = 'delete_'+type+'_attachment';
                if(type == 'invoice'){
                    init_invoice(response.rel_id);
                } else if(type == 'estimate'){
                    if ($('body').hasClass('estimates-pipeline')) {
                        estimate_pipeline_open(response.rel_id);
                    } else {
                        init_estimate(response.rel_id);
                    }
                } else if(type == 'proposal'){
                    if ($('body').hasClass('proposals-pipeline')) {
                        proposal_pipeline_open(response.rel_id);
                    }  else {
                        init_proposal(response.rel_id);
                    }
                }
            }
            var data = '';
            if (response.success == true) {
                data += '<div class="display-block" data-attachment-id="'+response.attachment_id+'">';
                data += '<div class="col-md-10">';
                data += '<div class="pull-left"><i class="attachment-icon-preview fa fa-file-o"></i></div>'
                data += '<a href="' + site_url + dl_url + response.key + '">' + response.file_name + '</a>';
                data += '<p class="text-muted">' + response.filetype + '</p>';
                data += '</div>';
                data += '<div class="col-md-2 text-right">';
                data += '<a href="#" class="text-danger" onclick="'+delete_function+'('+response.attachment_id+'); return false;"><i class="fa fa-times"></i></a>';
                data += '</div>';
                data += '<div class="clearfix"></div><hr/>';
                data += '</div>';
                $('#sales_uploaded_files_preview').append(data);
            }
        },
        acceptedFiles: allowed_files,
        error: function(file, response) {
            alert_float('danger', response);
        },
    };
    // remove the preview in the modal after hide
    $('#invoice_attach').on('hidden.bs.modal', function(e) {
        $('.dz-preview').remove();
        $('.invoice-attach-dropzone-preview').remove();
    });


    // Show send to email invoice modal
    $('body').on('click', '.invoice-send-to-client', function(e) {
        e.preventDefault();
        $('#invoice_send_to_client_modal').modal('show');
    });
    // Show send to email estimate modal
    $('body').on('click', '.estimate-send-to-client', function(e) {
        e.preventDefault();
        $('#estimate_send_to_client_modal').modal('show');
    });
    // Send templaate modal custom close function causing problems if is on pipeline view
    $('body').on('click', '.close-send-template-modal', function() {
        $('#estimate_send_to_client_modal').modal('hide');
        $('#proposal_send_to_customer').modal('hide');
    });
    // Include shipping show/hide details
    $('body').on('change', '#include_shipping', function() {
        if ($(this).prop('checked') == true) {
            $('#shipping_details').removeClass('hide');
        } else {
            $('#shipping_details').addClass('hide');
        }
    });
    // Init the billing and shipping details in the field - estimates and invoices
    $('body').on('click', '.save-shipping-billing', function(e) {
        init_billing_and_shipping_details();
    });
    // On change currency recalculate price and change symbol
    $('body').on('change', 'select[name="currency"]', function() {
        init_currency_symbol($(this).val());
    });
    // Dont allow NO TAX and other taxes to be selected together
    $('body').on('change','select.tax',function(){
        var value = $(this).val();
        if (value != null) {
            if (value.indexOf('') > -1) {
                if (value.length > 1) {
                    value.splice(0, 1);
                    $(this).selectpicker('val', value);
                }
            }
        }
    });
    // Recaulciate total on these changes
    $('body').on('change', 'input[name="adjustment"],select.tax', function() {
        calculate_total();
    });
    // Discount type for estimate/invoice
    $('body').on('change', 'select[name="discount_type"]', function() {
        // if discount_type == ''
        if ($(this).val() == '') {
            $('input[name="discount_percent"]').val('');
        }
        // Recalculate the total
        calculate_total();
    });
    // In case user enter discount percent but there is no discount type set
    $('body').on('change', 'input[name="discount_percent"]', function() {
        if ($('select[name="discount_type"]').val() == '') {
            alert('Select discount type');
            $(this).val('');
            return false;
        }
        if ($(this).valid() == true) {
            calculate_total();
        }
    });
    // Add item to preview from the dropdown for invoices estimates
    $('body').on('change', 'select[name="item_select"]', function() {
        var itemid = $(this).selectpicker('val');
        if (itemid != '') {
            add_item_to_preview(itemid);
        }
    });
    // Add task data to preview from the dropdown for invoiecs
    $('body').on('change', 'select[name="task_select"]', function() {
        var taskid = $(this).selectpicker('val');
        if (taskid != '') {
            add_task_to_preview_as_item(taskid);
        }
    });
    // When user record payment check if is online mode
    $('body').on('change', 'select[name="paymentmode"]', function() {
        !$.isNumeric($(this).val()) ? $('.do_not_redirect').removeClass('hide') : $('.do_not_redirect').addClass('hide');
    });
    $('body').on('change', '.f_client_id select[name="clientid"]', function() {
        var val = $(this).val();
        var s_project = $('select[name="project_id"]');
        s_project.empty();
        clear_billing_and_shipping_details();
        if (val == '') {
            $('#merge').empty();
            s_project.selectpicker('refresh');
            $('.projects-wrapper').addClass('hide');
            return false;
        }
        var current_invoice = $('body').find('input[name="merge_current_invoice"]').val();
        $.get(admin_url + 'invoices/client_change_data/' + val + '/' + current_invoice, function(response) {
            $('#merge').html(response.merge_info);
            $('input[name="billing_street"]').val(response['billing_shipping'][0]['billing_street']);
            $('input[name="billing_city"]').val(response['billing_shipping'][0]['billing_city']);
            $('input[name="billing_state"]').val(response['billing_shipping'][0]['billing_state']);
            $('input[name="billing_zip"]').val(response['billing_shipping'][0]['billing_zip']);
            $('select[name="billing_country"]').selectpicker('val', response['billing_shipping'][0]['billing_country']);
            if (!empty(response['billing_shipping'][0]['shipping_street'])) {
                $('input[name="include_shipping"]').prop("checked", true);
                $('input[name="include_shipping"]').change();
            }
            $('input[name="shipping_street"]').val(response['billing_shipping'][0]['shipping_street']);
            $('input[name="shipping_city"]').val(response['billing_shipping'][0]['shipping_city']);
            $('input[name="shipping_state"]').val(response['billing_shipping'][0]['shipping_state']);
            $('input[name="shipping_zip"]').val(response['billing_shipping'][0]['shipping_zip']);
            $('select[name="shipping_country"]').selectpicker('val', response['billing_shipping'][0]['shipping_country']);
            init_billing_and_shipping_details();
            var client_currency = response['client_currency'];
            var s_currency = $('body').find('.ei-template select[name="currency"]');
            client_currency = parseInt(client_currency);
            if (client_currency != 0) {
                s_currency.val(client_currency);
            } else {
                s_currency.val(s_currency.data('base'));
            }
            if(response.projects.length > 0){
                $('.projects-wrapper').removeClass('hide');
                s_project.append('<option value=""></option>');
                $.each(response.projects,function(i,obj){
                    s_project.append('<option value="'+obj.id+'">'+obj.name+'</option>');
                });
            } else {
                $('.projects-wrapper').addClass('hide');
            }
            s_project.selectpicker('refresh');
            s_currency.selectpicker('refresh');
            s_currency.change();
        }, 'json');
    });
    // When customer_id is passed init the data
    if($('input[name="isedit"]').length == 0){
        $('.f_client_id select[name="clientid"]').change();
    }

    $('body').on('click', '#get_shipping_from_customer_profile', function(e) {
        e.preventDefault();
        var include_shipping = $('#include_shipping');
        if (include_shipping.prop('checked') == false) {
            include_shipping.prop('checked', true);
            $('#shipping_details').removeClass('hide');
        }
        var clientid = $('select[name="clientid"]').val();
        if (clientid == '') {
            return;
        }
        $.get(admin_url + 'clients/get_customer_billing_and_shipping_details/' + clientid, function(response) {
            $('input[name="shipping_street"]').val(response[0]['shipping_street']);
            $('input[name="shipping_city"]').val(response[0]['shipping_city']);
            $('input[name="shipping_state"]').val(response[0]['shipping_state']);
            $('input[name="shipping_zip"]').val(response[0]['shipping_zip']);
            $('select[name="shipping_country"]').selectpicker('val', response[0]['shipping_country']);
        }, 'json');
    });
    // Used for formatting money
    accounting.settings.currency.decimal = decimal_separator;
    accounting.settings.currency.thousand = thousand_separator;
    // Used for numbers
    accounting.settings.number.thousand = thousand_separator;
    accounting.settings.number.decimal = decimal_separator;
    accounting.settings.number.precision = 2;
    calculate_total();
});

// Init single invoice
function init_invoice(id) {
    var _invoiceid = $('input[name="invoiceid"]').val();
    // Check if invoice passed from url, hash is prioritized becuase is last
    if (_invoiceid != '' && !window.location.hash) {
        id = _invoiceid;
        // Clear the current invoice value in case user click on the left sidebar invoices
        $('input[name="invoiceid"]').val('');
    } else {
        // check first if hash exists and not id is passed, becuase id is prioritized
        if(window.location.hash && !id) {
            id = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
        }
    }
    if (typeof(id) == 'undefined' || id == '') { return; }
    if (!$('body').hasClass('small-table')) {
        toggle_small_view('.table-invoices', '#invoice');
    }
    $('input[name="invoiceid"]').val(id);
    do_hash_helper(id);
    $('#invoice').load(admin_url + 'invoices/get_invoice_data_ajax/' + id);
    if (is_mobile()) {
        $('html, body').animate({
            scrollTop: $('#invoice').offset().top + 150
        }, 600);
    }
}
function init_supplier_invoice(id) {
    var _invoiceid = $('input[name="invoiceid"]').val();
    // Check if invoice passed from url, hash is prioritized becuase is last
    if (_invoiceid != '' && !window.location.hash) {
        id = _invoiceid;
        // Clear the current invoice value in case user click on the left sidebar invoices
        $('input[name="invoiceid"]').val('');
    } else {
        // check first if hash exists and not id is passed, becuase id is prioritized
        if(window.location.hash && !id) {
            id = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
        }
    }
    if (typeof(id) == 'undefined' || id == '') { return; }
    if (!$('body').hasClass('small-table')) {
        toggle_small_view('.table-supplier_invoices', '#supplier_invoice');
    }
    $('input[name="invoiceid"]').val(id);
    do_hash_helper(id);
    $('#supplier_invoice').load(admin_url + 'supplier_invoices/get_invoice_data_ajax/' + id);
    if (is_mobile()) {
        $('html, body').animate({
            scrollTop: $('#supplier_invoice').offset().top + 150
        }, 600);
    }
}
// Init single Estimate
function init_estimate(id) {
    var _estimateid = $('input[name="estimateid"]').val();

    // Check if estimate passed from url, hash is prioritized becuase is last
    if (_estimateid != '' && !window.location.hash) {
        id = _estimateid;
        // Clear the current estimate value in case user click on the left sidebar invoices
        $('input[name="estimateid"]').val('');
    } else {
        // check first if hash exists and not id is passed, becuase id is prioritized
        if(window.location.hash && !id) {
            id = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
        }
    }
    if (typeof(id) == 'undefined' || id == '') { return;}

    if (!$('body').hasClass('small-table')) {
        toggle_small_view('.table-estimates', '#estimate');
    }
    $('input[name="estimateid"]').val(id);
    do_hash_helper(id);
    $('#estimate').load(admin_url + 'estimates/get_estimate_data_ajax/' + id);

    if (is_mobile()) {
        $('html, body').animate({
            scrollTop: $('#estimate').offset().top + 150
        }, 600);
    }
}

// Init single Estimate
function init_proposal(id) {
    var _proposal_id = $('input[name="proposal_id"]').val();
    // Check if proposal passed from url, hash is prioritized becuase is last
    if (_proposal_id != '' && !window.location.hash) {
        id = _proposal_id;
        // Clear the current proposal value in case user click on the left sidebar invoices
        $('input[name="proposal_id"]').val('');
    } else {
        // check first if hash exists and not id is passed, becuase id is prioritized
        if(window.location.hash && !id) {
            id = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
        }
    }
    if (typeof(id) == 'undefined' || id == '') {return;}
    if (!$('body').hasClass('small-table')) {
        toggle_small_view('.table-proposals', '#proposal');
    }
    $('input[name="proposal_id"]').val(id);
    do_hash_helper(id);
    $('#proposal').load(admin_url + 'proposals/get_proposal_data_ajax/' + id);

    if (is_mobile()) {
        $('html, body').animate({
            scrollTop: $('#proposal').offset().top + 150
        }, 600);
    }
}

function clear_billing_and_shipping_details() {
    $('input[name="billing_street"]').val('');
    $('input[name="billing_city"]').val('');
    $('input[name="billing_state"]').val('');
    $('input[name="billing_zip"]').val('');
    $('select[name="billing_country"]').selectpicker('val', '');
    $('input[name="include_shipping"]').prop("checked", false);
    $('input[name="include_shipping"]').change();
    $('input[name="shipping_street"]').val('');
    $('input[name="shipping_city"]').val('');
    $('input[name="shipping_state"]').val('');
    $('input[name="shipping_zip"]').val('');
    $('select[name="shipping_country"]').selectpicker('val', '');
    init_billing_and_shipping_details();
}

function init_billing_and_shipping_details() {

    var billing_street = $('input[name="billing_street"]').val();
    billing_street = (billing_street != '' ? billing_street : '--');

    var billing_city = $('input[name="billing_city"]').val();
    billing_city = (billing_city != '' ? billing_city : '--');

    var billing_state = $('input[name="billing_state"]').val();
    billing_state = (billing_state != '' ? billing_state : '--');

    var billing_zip = $('input[name="billing_zip"]').val();
    billing_zip = (billing_zip != '' ? billing_zip : '--');

    var billing_country = $("#billing_country option:selected").data('subtext');
    if (typeof(billing_country) == 'undefined') {
        billing_country = '--';
    }

    var include_shipping = $('input[name="include_shipping"]').prop('checked');

    var shipping_street = '';
    if (include_shipping) {
        shipping_street = $('input[name="shipping_street"]').val();
    }
    shipping_street = (shipping_street != '' ? shipping_street : '--');

    var shipping_city = '';
    if (include_shipping) {
        shipping_city = $('input[name="shipping_city"]').val();
    }
    shipping_city = (shipping_city != '' ? shipping_city : '--');

    var shipping_state = '';
    if (include_shipping) {
        shipping_state = $('input[name="shipping_state"]').val();
    }
    shipping_state = (shipping_state != '' ? shipping_state : '--');

    var shipping_zip = '';
    if (include_shipping) {
        shipping_zip = $('input[name="shipping_zip"]').val();
    }
    shipping_zip = (shipping_zip != '' ? shipping_zip : '--');

    var shipping_country = '';
    if (include_shipping) {
        var shipping_country = $("#shipping_country option:selected").data('subtext');
    }
    if (typeof(shipping_country) == 'undefined' || shipping_country == '') {
        shipping_country = '--';
    }

    $('.billing_street').text(billing_street);
    $('.billing_city').text(billing_city);
    $('.billing_state').text(billing_state);
    $('.billing_zip').text(billing_zip);
    $('.billing_country').text(billing_country);

    $('.shipping_street').text(shipping_street);
    $('.shipping_city').text(shipping_city);
    $('.shipping_state').text(shipping_state);
    $('.shipping_zip').text(shipping_zip);
    $('.shipping_country').text(shipping_country);
    $('#billing_and_shipping_details').modal('hide');
}
// Record payment function
function record_payment(id) {
    if (typeof(id) == 'undefined' || id == '') {
        return;
    }
    $('#invoice').load(admin_url + 'invoices/record_invoice_payment_ajax/' + id);
}
// Add item to preview
function add_item_to_preview(itemid) {
    $.get(admin_url + 'invoice_items/get_item_by_id/' + itemid, function(response) {
        if (!response.taxname) {
            response.taxname = '';
        }
        $('input[name="description"]').val(response.description);
        $('input[name="long_description"]').val(response.long_description);
        $('input[name="quantity"]').val(1);
        $('.main select.tax').selectpicker('val', response.taxname + '|' + response.taxrate);
        $('input[name="rate"]').val(response.rate);
    }, 'json');
}
// Add task to preview
function add_task_to_preview_as_item(task_id) {
    $.get(admin_url + 'tasks/get_billable_task_data/' + task_id, function(response) {
        response.taxname = $('select.main-tax').selectpicker('val');
        $('input[name="description"]').val(response.name);
        $('input[name="long_description"]').val('');
        $('input[name="quantity"]').val(response.total_hours);
        $('input[name="rate"]').val(response.hourly_rate);
        $('input[name="task_id"]').val(task_id);
    }, 'json');
}
// Clear the items added to preview
function clear_main_values(default_taxes) {
    // Get the last taxes applied to be available for the next item
    var last_taxes_applied = $('table.items tbody').find('tr:last-child').find('select').selectpicker('val');
    $('input[name="description"]').val('');
    $('input[name="long_description"]').val('');
    $('input[name="quantity"]').val(1);
    $('.main select.tax').selectpicker('val', last_taxes_applied);
    $('input[name="rate"]').val('');
    $('input[name="item-search"]').val('');
    $('.item-search .dropdown-menu').html('');
    $('input[name="task_id"]').val('');
}
// Invoices to merge
$('body').on('change', 'input[name="invoices_to_merge[]"]', function() {
    var checked = $(this).prop('checked');
    var _id = $(this).val();
    if (checked == true) {
        $.get(admin_url + 'invoices/get_merge_data/' + _id, function(response) {
            $.each(response.items, function(i, obj) {
                add_item_to_table(obj, 'undefined', _id);
            });
        }, 'json');
    } else {
        // Remove the appended invoice to merge
        $('body').find('[data-merge-invoice="' + _id + '"]').remove();
    }
})
// Append the added items to the preview to the table as items
function add_item_to_table(data, itemid, merge_invoice) {
    // If not custom data passed get from the preview
    if (typeof(data) == 'undefined' || data == 'undefined') {
        data = get_main_values();
    }
    var table_row = '';
    var item_key = $('body').find('tbody .item').length + 1;
    table_row += '<tr class="sortable item" data-merge-invoice="' + merge_invoice + '">';
    table_row += '<td class="dragger">';
    // Check if quantity is number
    if (isNaN(data.qty)) {
        data.qty = 1;
    }
    // Check if rate is number
    if (data.rate == '' || isNaN(data.rate)) {
        data.rate = 0;
    }
    var amount = data.rate * data.qty;
    amount = accounting.formatNumber(amount);
    var tax_name = 'newitems[' + item_key + '][taxname][]';
    $('body').append('<div class="dt-loader"></div>');
    $.when(get_taxes_dropdown_template(tax_name, data.taxname)).then(function(tax_dropdown) {
        // order input
        table_row += '<input type="hidden" class="order" name="newitems[' + item_key + '][order]">';
        table_row += '</td>';
        table_row += '<td class="bold description"><input type="text" name="newitems[' + item_key + '][description]" class="form-control input-transparent" value="' + data.description + '"></td>';
        table_row += '<td><textarea name="newitems[' + item_key + '][long_description]" class="form-control input-transparent">' + data.long_description + '</textarea></td>';
        table_row += '<td><input type="number" min="0" onblur="calculate_total();" onchange="calculate_total();" data-quantity name="newitems[' + item_key + '][qty]" value="' + data.qty + '" class="form-control input-transparent"></td>';
        table_row += '<td class="rate"><input type="text" data-toggle="tooltip" title="' + item_field_not_formated + '" onblur="calculate_total();" onchange="calculate_total();" name="newitems[' + item_key + '][rate]" value="' + data.rate + '" class="form-control input-transparent"></td>';
        table_row += '<td class="taxrate">' + tax_dropdown + '</td>';
        table_row += '<td class="amount">' + amount + '</td>';
        table_row += '<td><a href="#" class="btn btn-danger pull-left" onclick="delete_item(this,' + itemid + '); return false;"><i class="fa fa-trash"></i></a></td>';
        table_row += '</tr>';
        $.when($('table.items tbody').append(table_row)).then(calculate_total);
        var billed_task = $('input[name="task_id"]').val();
        if (billed_task != '') {
            $('#billed-tasks').append(hidden_input('billed_tasks['+item_key+'][]', billed_task));
        }
        init_selectpicker();
        clear_main_values();
        reorder_items();
        $('body').find('.dt-loader').remove();
        return true;
    });
    return false;
}
// Get taxes dropdown selectpicker template / Causing problems with ajax becuase is fetching from server
function get_taxes_dropdown_template(name, taxname) {
    jQuery.ajaxSetup({async:false});
    var d =  $.post(admin_url + 'misc/get_taxes_dropdown_template/', {
        name: name,
        taxname: taxname
    });
    jQuery.ajaxSetup({async:true});
    return d;
}
// Fix for reordering the items the tables to show the full width
function fixHelperTableHelperSortable(e, ui) {
    ui.children().each(function() {
        $(this).width($(this).width());
    });
    return ui;
}
function init_items_search() {
    if (!$('#autocomplete_main').length) {return;}
    // Items search
    $.ajax({
        type: "POST",
        url: admin_url + 'invoice_items/get_all_items_ajax',
        dataType: 'json',
        success: function(response) {
            $('#autocomplete_main').autocomplete({
                source: response,
                sortResults: false,
                open: function(event, ui)
                {
                 // If is not mobile increase the width of the items autocomplete
                 if(!is_mobile()){
                    $("#autocomplete_main").autocomplete ("widget").css("width","350px");
                }
            }
        }).autocomplete('instance')._renderItem = function(ul, item) {
                return $("<li class='item-auto-search' onclick='add_item_to_preview(" + item.itemid + "); return false;'>")
                .append("<a href='#' class='bold'>" + item.label + "<br><span class='text-muted'>" + item.long_description + "</span></a>")
                .appendTo(ul);
            }
        }
    });
}

function init_items_sortable(preview_table) {
    $("body").find('.items tbody').sortable({
        helper: fixHelperTableHelperSortable,
        handle: '.dragger',
        placeholder: 'ui-placeholder',
        itemPath: '> tbody',
        itemSelector: 'tr.sortable',
        items: "tr.sortable",
        update: function() {
            if(typeof(preview_table) == 'undefined'){
                reorder_items();
            } else {
                // If passed from the admin preview there is other function for re-ordering
                save_ei_items_order();
            }
        },
        sort: function(event, ui) {
            // Firefox fixer when dragging
            var $target = $(event.target);
            if (!/html|body/i.test($target.offsetParent()[0].tagName)) {
                var top = event.pageY - $target.offsetParent().offset().top - (ui.helper.outerHeight(true) / 2);
                ui.helper.css({
                    'top': top + 'px'
                });
            }
        }
    });
}
// Save the items from order from the admin preview
function save_ei_items_order(){
    var rows = $('.table.invoice-items-preview.items tbody tr,.table.estimate-items-preview.items tbody tr');
    var i = 1;
    var order = [];
    var _order_id,type;
    var item_id;
    if($('.table.items').hasClass('invoice-items-preview')){
        type = 'invoice';
    } else if($('.table.items').hasClass('estimate-items-preview')){
        type = 'estimate';
    } else {
        return false;
    }
    $.each(rows, function() {
        order.push([$(this).data('item-id'), i]);
            // update item number when reordering
            $(this).find('td.item_no').html(i);
            i++;
        });
    setTimeout(function(){
        $.post(admin_url+'misc/update_ei_items_order/'+type,{data:order});
    },50);
}
// Reoder the items in table edit for estimate and invoices
function reorder_items() {
    var rows = $('.table.table-main-invoice-edit tbody tr.item,.table.table-main-estimate-edit tbody tr.item');
    var i = 1;
    $.each(rows, function() {
        $(this).find('input.order').val(i);
        i++;
    });
}
// Get the preview main values
function get_main_values() {
    var response = {};
    response.description = $('input[name="description"]').val();
    response.long_description = $('input[name="long_description"]').val();
    response.qty = $('input[name="quantity"]').val();
    response.taxname = $('.main select.tax').selectpicker('val');
    response.rate = $('input[name="rate"]').val();
    return response;
}
// Calculate invoice total - NOT RECOMENDING EDIT THIS FUNCTION BECUASE IS VERY SENSITIVE
function calculate_total() {
    var taxes = {};
    var subtotal = 0;
    var rows = $('.table.table-main-invoice-edit tbody tr.item,.table.table-main-estimate-edit tbody tr.item');
    var discount_area = $('tr#discount_percent');
    var discount_percent = $('input[name="discount_percent"]').val();
    var total_discount_calculated = 0;

    var discount_type = $('select[name="discount_type"]').val();
    $('.tax-area').remove();
    $.each(rows, function() {
        var quantity = $(this).find('[data-quantity]').val();
        if (quantity == '') {
            quantity = 1;
            $(this).find('[data-quantity]').val(1);
        }
        var _amount = parseFloat($(this).find('td.rate input').val()) * quantity;
        $(this).find('td.amount').html(accounting.formatNumber(_amount));
        subtotal += _amount;
        var row = $(this);
        var item_taxes = $(this).find('select.tax').selectpicker('val');
        if (item_taxes) {
            $.each(item_taxes, function(i, taxname) {
                var taxrate = row.find('select.tax [value="' + taxname + '"]').data('taxrate');
                var calculated_tax = (_amount / 100 * taxrate);
                if (!taxes.hasOwnProperty(taxname)) {
                    if (taxrate != 0) {
                        var _tax_name = taxname.split('|');
                        $(discount_area).after('<tr class="tax-area"><td>' + _tax_name[0] + '(' + taxrate + '%)</td><td id="tax_id_' + slugify(taxname) + '"></td></tr>');
                        var calculated_tax = (_amount / 100 * taxrate);
                        taxes[taxname] = calculated_tax;
                    }
                } else {
                    // Increment total from this tax
                    var __calculated_tax = taxes[taxname];
                    __calculated_tax += calculated_tax;
                    taxes[taxname] = __calculated_tax;
                }
            });
        }
    });
    if (discount_percent != '' && discount_type == 'before_tax') {
        // Calculate the discount total
        total_discount_calculated = (subtotal * discount_percent) / 100;
    }
    var total = 0;
    $.each(taxes, function(taxname, total_tax) {
        if (discount_percent != '' && discount_type == 'before_tax') {
            total_tax_calculated = (total_tax * discount_percent) / 100;
            total_tax = (total_tax - total_tax_calculated);
        }
        total += total_tax;
        total_tax = accounting.formatNumber(total_tax)
        $('#tax_id_' + slugify(taxname)).html(total_tax);
    });
    total = (total + subtotal);
    if (discount_percent != '' && discount_type == 'after_tax') {
        // Calculate the discount total
        var total_discount_calculated = (total * discount_percent) / 100;
    }
    total = total - total_discount_calculated;
    var adjustment = $('input[name="adjustment"]').val();
    adjustment = parseFloat(adjustment);

    // Check if adjustment not empty
    if (!isNaN(adjustment)) {
        total = total + adjustment;
    }
    // Append, format to html and display
    $('.discount_percent').html('-' + accounting.formatNumber(total_discount_calculated) + hidden_input('discount_percent', discount_percent) + hidden_input('discount_total', total_discount_calculated));
    $('.adjustment').html(accounting.formatNumber(adjustment) + hidden_input('adjustment', adjustment.toFixed(2)))
    $('.subtotal').html(subtotal = accounting.formatNumber(subtotal) + hidden_input('subtotal', subtotal.toFixed(2)));
    $('.total').html(format_money(total) + hidden_input('total', total.toFixed(2)));
}
// Deletes invoice items
function delete_item(row, itemid) {
    $(row).parents('tr').addClass('animated fadeOut', function() {
        setTimeout(function() {
            $(row).parents('tr').remove();
            calculate_total();
        }, 300)
    });
    // If is edit we need to add to input removed_items to track activity
    if ($('input[name="isedit"]').length > 0) {
        $('#removed-items').append(hidden_input('removed_items[]', itemid));
    }
}
// Format money functions
function format_money(total) {
    if (currency_placement === 'after') {
        return accounting.formatMoney(total, {
            format: "%v %s"
        });
    } else {
        return accounting.formatMoney(total);
    }
}

function show_transactions_by_year(id,table) {
    var original = id;
    id = do_filter_active(id);
    if(id == ''){
        $('input[name="year_'+original+'"]').val(id);
    } else {
        $('input[name="year_'+id+'"]').val(id);
    }
    $(table).DataTable().ajax.reload();

}
// Set the currency symbol for accounting
function init_currency_symbol(id) {
    $.get(admin_url + 'currencies/get_currency_symbol/' + id, function(response) {
        accounting.settings.currency.symbol = response.symbol;
        calculate_total();
    }, 'json');
}
function delete_invoice_attachment(id) {
    var r = confirm(confirm_action_prompt);
    if (r == false) {
        return false;
    } else {
        $.get(admin_url + 'invoices/delete_attachment/' + id, function(success) {
            if (success == 1) {
                $('body').find('[data-attachment-id="'+id+'"]').remove();
                init_invoice($('body').find('input[name="_attachment_sale_id"]').val());
            }
        }).fail(function(error){
            alert_float('danger', error.responseText);
        });
    }
}
function delete_estimate_attachment(id) {
    var r = confirm(confirm_action_prompt);
    if (r == false) {
        return false;
    } else {
        $.get(admin_url + 'estimates/delete_attachment/' + id, function(success) {
            if (success == 1) {
             $('body').find('[data-attachment-id="'+id+'"]').remove();
             var rel_id = $('body').find('input[name="_attachment_sale_id"]').val();
             if ($('body').hasClass('estimates-pipeline')) {
                estimate_pipeline_open(rel_id)
            }  else {
                init_estimate(rel_id);
            }
        }
    }).fail(function(error){
        alert_float('danger', error.responseText);
    });
}
}
function delete_proposal_attachment(id) {
    var r = confirm(confirm_action_prompt);
    if (r == false) {
        return false;
    } else {
        $.get(admin_url + 'proposals/delete_attachment/' + id, function(success) {
            if (success == 1) {
               var rel_id = $('body').find('input[name="_attachment_sale_id"]').val();
               $('body').find('[data-attachment-id="'+id+'"]').remove();

               if ($('body').hasClass('proposals-pipeline')) {
                proposal_pipeline_open(rel_id)
            }  else {
                init_proposal(rel_id);
            }
        }
    }).fail(function(error){
        alert_float('danger', error.responseText);
    });
}
}
function toggle_sales_attachment_visibility(attachment_id,rel_id,invoker){
    $.get(admin_url+'misc/toggle_sales_attachment_visibility/'+attachment_id,function(response){
        if(response == 1){
            $(invoker).find('i').removeClass('fa fa-toggle-off').addClass('fa fa-toggle-on');
        } else {
            $(invoker).find('i').removeClass('fa fa-toggle-on').addClass('fa fa-toggle-off');
        }
    });
}
function init_invoices_total() {
    if ($('#invoices_total').length == 0) {return;}

    var _years = $('._filters._hidden_inputs').find('input[name^="year"]');
    var years = [];
    $.each(_years,function(){
        var _y = $(this).val();
        if(_y != ''){
            years.push(_y);
        }
    });

    var _agents = $('._filters._hidden_inputs').find('input[name^="sale_agent"]');
    var agents = [];
    $.each(_agents,function(){
        var _a = $(this).val();
        if(_a != ''){
            agents.push(_a);
        }
    });

    var _modes = $('._filters._hidden_inputs').find('input[name^="invoice_payments_by_"]');
    var modes = [];
    $.each(_modes,function(){
        var _m = $(this).val();
        if(_m != ''){
            modes.push(_m);
        }
    });

    var currency = $('body').find('select[name="total_currency"]').val();
    var data = {
        currency: currency,
        years:years,
        agents:agents,
        payment_modes:modes,
        init_total: true,
    };

    var project_id = $('input[name="project_id"]').val();
    var customer_id = $('.customer_profile input[name="userid"]').val();
    if (typeof(project_id) != 'undefined') {
        data.project_id = project_id;
    } else if (typeof(customer_id) != 'undefined') {
        data.customer_id = customer_id;
    }
    $.post(admin_url + 'invoices/get_invoices_total', data).success(function(response) {
        $('#invoices_total').html(response);
    });
}

function init_supplier_invoices_total() {
    if ($('#invoices_total').length == 0) {return;}

    var _years = $('._filters._hidden_inputs').find('input[name^="year"]');
    var years = [];
    $.each(_years,function(){
        var _y = $(this).val();
        if(_y != ''){
            years.push(_y);
        }
    });

    var _agents = $('._filters._hidden_inputs').find('input[name^="sale_agent"]');
    var agents = [];
    $.each(_agents,function(){
        var _a = $(this).val();
        if(_a != ''){
            agents.push(_a);
        }
    });

    var _modes = $('._filters._hidden_inputs').find('input[name^="invoice_payments_by_"]');
    var modes = [];
    $.each(_modes,function(){
        var _m = $(this).val();
        if(_m != ''){
            modes.push(_m);
        }
    });

    var currency = $('body').find('select[name="total_currency"]').val();
    var data = {
        currency: currency,
        years:years,
        agents:agents,
        payment_modes:modes,
        init_total: true,
    };

    var project_id = $('input[name="project_id"]').val();
    var supplier_id = $('.supplier_profile input[name="supplierid"]').val();
    if (typeof(project_id) != 'undefined') {
        data.project_id = project_id;
    } else if (typeof(supplier_id) != 'undefined') {
        data.supplier_id = supplier_id;
    }
    $.post(admin_url + 'supplier_invoices/get_invoices_total', data).success(function(response) {
        $('#invoices_total').html(response);
    });
}

function init_estimates_total() {
    if($('#estimates_total').length == 0){return;}
    var currency = $('body').find('select[name="total_currency"]').val();
    var _years = $('._filters._hidden_inputs').find('input[name^="year"]');
    var years = [];
    $.each(_years,function(){
        var _y = $(this).val();
        if(_y != ''){
            years.push(_y);
        }
    });
    var _agents = $('._filters._hidden_inputs').find('input[name^="sale_agent"]');
    var agents = [];
    $.each(_agents,function(){
        var _a = $(this).val();
        if(_a != ''){
            agents.push(_a);
        }
    });

    var customer_id = '';
    var _customer_id = $('.customer_profile input[name="userid"]').val();
    if (typeof(customer_id) != 'undefined') {
        customer_id = _customer_id;
    }

    $.post(admin_url + 'estimates/get_estimates_total', {
        currency: currency,
        init_total: true,
        years:years,
        agents:agents,
        customer_id:customer_id,
    }).success(function(response) {
        $('#estimates_total').html(response);
    });
}
function init_expenses_total(){
    if($('#expenses_total').length == 0){return;}
    var _f
    var currency = $('select[name="expenses_total_currency"]').val();
    var _years = $('._filters._hidden_inputs').find('input[name^="year"]');
    var years = [];
    $.each(_years,function(){
        _f = $(this).val();
        if(_f != ''){
            years.push(_f);
        }
    });
    var _months = $('._filters._hidden_inputs').find('input[name^="expenses_by_month_"]');
    var months = [];
    $.each(_months,function(){
        _f = $(this).val();
        if(_f != ''){
            months.push(_f);
        }
    });
    var _categories = $('._filters._hidden_inputs').find('input[name^="expenses_by_category_"]');
    var categories = [];
    $.each(_categories,function(){
        _f = $(this).val();
        if(_f != ''){
            categories.push(_f);
        }
    });
    var customer_id = '';
    var _customer_id = $('.customer_profile input[name="userid"]').val();
    if (typeof(customer_id) != 'undefined') {
        customer_id = _customer_id;
    }

    var project_id = '';
    var _project_id = $('input[name="project_id"]').val();
    if (typeof(project_id) != 'undefined') {
        project_id = _project_id;
    }

    $.post(admin_url + 'expenses/get_expenses_total', {
        currency: currency,
        init_total: true,
        months: months,
        years: years,
        categories: categories,
        customer_id: customer_id,
        project_id: project_id,
    }).success(function(response) {
        $('#expenses_total').html(response);
    });
}
function validate_invoice_form(selector){
    if(typeof(selector) == 'undefined'){
        selector = '#invoice-form';
    }
    _validate_form($(selector),{clientid:'required',date:'required',currency:'required',number:{
        required:true,
    }});
    $('body').find('input[name="number"]').rules('add',{
        remote: {
            url: admin_url + "invoices/validate_invoice_number",
            type: 'post',
            data: {
                number: function() {
                    return $('input[name="number"]').val();
                },
                isedit:function(){
                    return $('input[name="number"]').data('isedit');
                },
                original_number:function(){
                    return $('input[name="number"]').data('original-number');
                }
            }
        },
        messages: {
            remote: invoice_number_exists,
        }
    });
}
function validate_estimate_form(selector) {
    if(typeof(selector) == 'undefined'){
        selector = '#estimate-form';
    }
    _validate_form($(selector), {
        clientid: 'required',
        date: 'required',
        currency: 'required',
        number: {required:true}
    });

    $('body').find('input[name="number"]').rules('add',{
        remote: {
            url: admin_url + "estimates/validate_estimate_number",
            type: 'post',
            data: {
              number: function() {
                return $('input[name="number"]').val();
            },
            isedit:function(){
                return $('input[name="number"]').data('isedit');
            },
            original_number:function(){
                return $('input[name="number"]').data('original-number');
            }
        }
    },
    messages: {
        remote: estimate_number_exists,
    }
});

}
// Sort estimates in the pipeline view / switching sort type by click
function estimates_pipeline_sort(type) {
    var sort = $('input[name="sort"]');
    $('input[name="sort_type"]').val(type);
    if (sort.val() == 'ASC') {
        sort.val('DESC');
    } else if (sort.val() == 'DESC') {
        sort.val('ASC');
    } else {
        sort.val('DESC');
    }
    estimate_pipeline($('input[name="search"]').val());
}
// Sort proposals in the pipeline view / switching sort type by click
function proposal_pipeline_sort(type) {
    var sort = $('input[name="sort"]');
    $('input[name="sort_type"]').val(type);
    if (sort.val() == 'ASC') {
        sort.val('DESC');
    } else if (sort.val() == 'DESC') {
        sort.val('ASC');
    } else {
        sort.val('DESC');
    }
    proposals_pipeline($('input[name="search"]').val());
}
// Init estimates pipeline
function estimate_pipeline(search) {
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
    if ($('#kan-ban').length == 0) {
        return;
    }
    $('body').append('<div class="dt-loader"></div>');
    var url = admin_url + 'estimates/get_pipeline';
    url = buildUrl(url, parameters)
    $('#kan-ban').load(url, function() {
        // Set the width of the kanban container
        $('body').find('div.dt-loader').remove();
        var kanbanCol = $('.kan-ban-content-wrapper');
        kanbanCol.css('max-height', (window.innerHeight - 310) + 'px');
        $('.kan-ban-content').css('min-height', (window.innerHeight - 310) + 'px');
        var kanbanColCount = parseInt(kanbanCol.length);
        $('.container-fluid').css('min-width', (kanbanColCount * 360) + 'px');

        $(".status").sortable({
            connectWith: ".pipeline-status",
            helper: 'clone',
            appendTo: '#kan-ban',
            placeholder: "ui-state-highlight-card",
            revert: 'invalid',
            scroll: true,
            scrollSensitivity: 50,
            scrollSpeed: 70,
            start: function(event, ui) {},
            drag: function(event, ui) {
                var st = parseInt($(this).data("startingScrollTop"));
                ui.position.top -= $(this).parent().scrollTop() - st;
            },
            update: function(event, ui) {
                if (this === ui.item.parent()[0]) {
                    var data = {};
                    data.estimateid = $(ui.item).data('estimate-id');
                    data.status = $(ui.item.parent()[0]).data('status-id');
                    var order = [];
                    var status = $(ui.item).parents('.pipeline-status').find('li')
                    var i = 1;
                    $.each(status, function() {
                        order.push([$(this).data('estimate-id'), i]);
                        i++;
                    });
                    data.order = order;
                    $.post(admin_url + 'estimates/update_pipeline', data);
                }
            }
        }).disableSelection();
    });
}
// Init proposals pipeline
function proposals_pipeline(search) {
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
    if ($('#kan-ban').length == 0) {
        return;
    }
    $('body').append('<div class="dt-loader"></div>');
    var url = admin_url + 'proposals/get_pipeline';
    url = buildUrl(url, parameters)
    $('#kan-ban').load(url, function() {

        // Set the width of the kanban container
        $('body').find('div.dt-loader').remove();
        var kanbanCol = $('.kan-ban-content-wrapper');
        kanbanCol.css('max-height', (window.innerHeight - 310) + 'px');
        $('.kan-ban-content').css('min-height', (window.innerHeight - 310) + 'px');
        var kanbanColCount = parseInt(kanbanCol.length);
        $('.container-fluid').css('min-width', (kanbanColCount * 360) + 'px');

        $(".status").sortable({
            connectWith: ".pipeline-status",
            helper: 'clone',
            appendTo: '#kan-ban',
            placeholder: "ui-state-highlight-card",
            revert: 'invalid',
            scroll: true,
            scrollSensitivity: 50,
            scrollSpeed: 70,
            start: function(event, ui) {},
            drag: function(event, ui) {
                var st = parseInt($(this).data("startingScrollTop"));
                ui.position.top -= $(this).parent().scrollTop() - st;
            },
            update: function(event, ui) {
                if (this === ui.item.parent()[0]) {
                    var data = {};
                    data.proposalid = $(ui.item).data('proposal-id');
                    data.status = $(ui.item.parent()[0]).data('status-id');
                    var order = [];
                    var status = $(ui.item).parents('.pipeline-status').find('li')
                    var i = 1;
                    $.each(status, function() {
                        order.push([$(this).data('proposal-id'), i]);
                        i++;
                    });
                    data.order = order;
                    $.post(admin_url + 'proposals/update_pipeline', data);
                }
            }
        }).disableSelection();
    });
}
// Open single proposal in pipeline
function proposal_pipeline_open(id) {
    if (id == '') {return;}

    $.get(admin_url + 'proposals/pipeline_open/' + id, function(response) {

     var visible = $('.proposal-pipeline-modal:visible').length;
     $('#proposal').html(response);
     if(visible == 0){
        $('.proposal-pipeline-modal').modal({show:true,backdrop:'static'});
    } else {
        $('#proposal').find('.modal.proposal-pipeline-modal').addClass('in').css('display','block');
    }

});
}
// Estimate single open in pipeline
function estimate_pipeline_open(id) {
    if (id == '') {return;}
    $.get(admin_url + 'estimates/pipeline_open/' + id, function(response) {
        var visible = $('.estimate-pipeline:visible').length;
        $('#estimate').html(response);
        if(visible == 0){
            $('.estimate-pipeline').modal({show:true,backdrop:'static'});
        } else {
            $('#estimate').find('.modal.estimate-pipeline').addClass('in').css('display','block');
        }
    });
}
// Delete estimate note
function delete_estimate_note(wrapper, id) {
    var r = confirm(confirm_action_prompt);
    if (r == false) {return false;} else {
        $.get(admin_url + 'estimates/delete_note/' + id, function(response) {
            if (response.success == true) {
                $(wrapper).parents('.estimate-note').remove();
            }
        }, 'json');
    }
}
// Get all estimate notes
function get_estimate_notes(id) {
    $.get(admin_url + 'estimates/get_notes/' + id, function(response) {
        $('#estimate_notes_area').html(response);
    });
}
// Proposal merge field into the editor
function insert_proposal_merge_field(field) {
    var key = $(field).text();
    tinymce.activeEditor.execCommand('mceInsertContent', false, key);
}
// Toggle full view for small tables like proposals
function small_table_full_view(){
    $('#small-table').toggleClass('hide');
    $('.small-table-right-col').toggleClass('col-md-12')
    $('.small-table-right-col').toggleClass('col-md-7')
}
