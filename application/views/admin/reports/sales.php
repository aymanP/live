<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-heading">
                        <?php echo _l('sales_report_heading'); ?>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="selectpicker" id="report-group-change" name="report-group-change" data-width="100%" data-title="<?php echo _l('reports_sales_select_report_type'); ?>" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                        <option value=""></option>
                                        <option value="total-income" <?php if($this->input->get('report_income')){echo 'selected';} ?>><?php echo _l('report_sales_type_income'); ?></option>
                                        <option value="invoices-report"><?php echo _l('invoice_report'); ?></option>
                                        <option value="payment-modes"><?php echo _l('payment_modes_report'); ?></option>
                                        <option value="customers-report"><?php echo _l('report_sales_type_customer'); ?></option>
                                        <option value="customers-group"><?php echo _l('report_by_customer_groups'); ?></option>
                                    </select>
                                </div>
                                <?php if(isset($currencies)){ ?>
                                <div id="currency" class="form-group mtop15 hide" data-toggle="tooltip" title="<?php echo _l('report_sales_base_currency_select_explanation'); ?>">
                                    <select class="selectpicker" name="currency" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                        <?php foreach($currencies as $currency){
                                            $selected = '';
                                            if($currency['isdefault'] == 1){
                                            	$selected = 'selected';
                                            }
                                            ?>
                                        <option value="<?php echo $currency['id']; ?>" <?php echo $selected; ?> data-subtext="<?php echo $currency['name']; ?>"><?php echo $currency['symbol']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <?php } ?>
                                <div class="invoice-status hide mbot15">
                                    <select name="invoice_status" class="selectpicker" multiple data-width="100%">
                                        <option value="" selected><?php echo _l('invoice_status_report_all'); ?></option>
                                        <?php foreach($invoice_statuses as $status){ if($status ==5){continue;} ?>
                                        <option value="<?php echo $status; ?>"><?php echo format_invoice_status($status,'',false) ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="income-years" class="hide mbot15">
                                    <select class="selectpicker" name="payments_years" data-width="100%" onchange="total_income_bar_report();" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                        <?php foreach($payments_years as $year) { ?>
                                        <option value="<?php echo $year['year']; ?>"<?php if($year['year'] == date('Y')){echo 'selected';} ?>>
                                            <?php echo $year['year']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div id="date-range" class="hide animated mbot15 mtop15">
                                    <label for="report-from" class="control-label"><?php echo _l('report_sales_from_date'); ?></label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control datepicker" id="report-from" name="report-from">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar calendar-icon"></i>
                                        </div>
                                    </div>
                                    <label for="report-to" class="control-label"><?php echo _l('report_sales_to_date'); ?></label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control datepicker" disabled="disabled" id="report-to" name="report-to">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar calendar-icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group hide" id="report-time">
                                    <select class="selectpicker" name="months-report" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                        <option value=""><?php echo _l('report_sales_months_all_time'); ?></option>
                                        <option value="3"><?php echo _l('report_sales_months_three_months'); ?></option>
                                        <option value="6"><?php echo _l('report_sales_months_six_months'); ?></option>
                                        <option value="12"><?php echo _l('report_sales_months_twelve_months'); ?></option>
                                        <option value="custom"><?php echo _l('report_sales_months_custom'); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php if(total_rows('tblinvoices',array('status'=>5))> 0){ ?>
                        <p class="text-danger">
                            <?php echo _l('sales_report_cancelled_invoices_not_included'); ?>
                        </p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel_s hide" id="report">
                    <div class="panel-heading">
                        <?php echo _l('reports_sales_generated_report'); ?>
                    </div>
                    <div class="panel-body">
                        <canvas id="chart" class="animated fadeIn" height="100"></canvas>
                        <canvas id="chart-payment-modes" class="animated fadeIn" height="100"></canvas>
                        <div id="customers-report" class="hide">
                            <?php render_datatable(array(
                                _l('reports_sales_dt_customers_client'),
                                _l('reports_sales_dt_customers_total_invoices'),
                                _l('reports_sales_dt_items_customers_amount'),
                                _l('reports_sales_dt_items_customers_amount_with_tax'),
                                ),'customers-report'); ?>
                        </div>
                        <canvas id="customers-group-gen" class="animated fadeIn" height="100"></canvas>
                        <div id="invoices-report" class="hide">
                            <div class="row mbot15">
                                <div class="col-md-12">
                                    <div class="col-md-3 border-right text-center">
                                        <h4 class="bold"><?php echo _l('report_invoice_total_amount_without_tax'); ?></h4>
                                        <span class="bold font-medium invoice-report-amount-without-taxes"></span>
                                    </div>
                                    <div class="col-md-3 border-right text-center">
                                        <h4 class="bold"><?php echo _l('report_invoice_total_taxes'); ?></h4>
                                        <span class="bold font-medium invoice-report-taxes"></span>
                                    </div>
                                    <div class="col-md-3 border-right text-center">
                                        <h4 class="bold"><?php echo _l('report_invoice_total_amount_with_tax'); ?></h4>
                                        <span class="bold font-medium invoice-report-amount-with-taxes"></span>
                                    </div>
                                    <div class="col-md-3 border-right text-center">
                                        <h4 class="bold"><?php echo _l('report_invoice_discount'); ?></h4>
                                        <span class="bold font-medium invoice-report-discounts"></span>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="clearfix"></div>
                            <?php render_datatable(array(
                                _l('report_invoice_number'),
                                _l('report_invoice_customer'),
                                _l('report_invoice_date'),
                                _l('report_invoice_duedate'),
                                _l('report_invoice_amount'),
                                _l('report_invoice_amount_with_tax'),
                                _l('report_invoice_total_tax'),
                                _l('invoice_discount'),
                                _l('report_invoice_amount_open'),
                                _l('report_invoice_status'),
                                ),'invoices-report'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
    var salesChart;
    var groupsChart;
    var paymentMethodsChart;
    var customersTable;
    var report_from = $('input[name="report-from"]');
    var report_to = $('input[name="report-to"]');
    var report_customers = $('#customers-report');
    var report_customers_groups = $('#customers-group');
    var report_invoices = $('#invoices-report');
    var date_range = $('#date-range');
    var report_from_choose = $('#report-time');
    var fnServerParams = {
        "report_months": '[name="months-report"]',
        "report_from": '[name="report-from"]',
        "report_to": '[name="report-to"]',
        "report_currency": '[name="currency"]',
        "invoice_status": '[name="invoice_status"]',
    }
    $(document).ready(function() {

        $('select[name="currency"],select[name="invoice_status"]').on('change', function() {
            gen_reports();
        });
        $('select[name="invoice_status"]').on('change', function() {
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
        report_from.on('change', function() {
            var val = $(this).val();
            var report_to_val = report_to.val();
            if (val != '') {
                report_to.attr('disabled', false);
                if (report_to_val != '') {
                    gen_reports();
                }
            } else {
                report_to.attr('disabled', true);
            }
        });

        report_to.on('change', function() {
            var val = $(this).val();
            if (val != '') {
                gen_reports();
            }
        });

        $('select[name="months-report"]').on('change', function() {
            var val = $(this).val();

            report_to.attr('disabled', true);
            report_to.val('');
            report_from.val('');
            if (val == 'custom') {
                date_range.addClass('fadeIn').removeClass('hide');
                return;
            } else {
                if (!date_range.hasClass('hide')) {
                    date_range.removeClass('fadeIn').addClass('hide');
                }
            }
            gen_reports();
        });
        // Main report group change and reinit data
        $('select[name="report-group-change"]').on('change', function() {
            var report_wrapper = $('#report');
            if (report_wrapper.hasClass('hide')) {
                report_wrapper.removeClass('hide');
            }
            $('.invoice-status').addClass('hide');
            $('#customers-group-gen').addClass('hide');
            report_customers_groups.addClass('hide');
            report_customers.addClass('hide');
            report_invoices.addClass('hide');
            $('#income-years').addClass('hide');
            $('#chart').addClass('hide');
            $('#chart-payment-modes').addClass('hide');
            report_from_choose.addClass('hide');
            // Clear custom date picker
            report_to.val('');
            report_from.val('');
            $('#currency').removeClass('hide');
            var report = $(this).val();
            if (report == '') {
                date_range.addClass('hide');
                report_wrapper.addClass('hide');
                report_from_choose.addClass('hide');
                return;
            } else {
                if (report != 'total-income' && report != 'payment-modes') {
                    report_from_choose.removeClass('hide');
                }
            }
            if (report == 'total-income') {
                $('#chart').removeClass('hide');
                $('#income-years').removeClass('hide');
                date_range.addClass('hide');
            } else if (report == 'customers-report') {
                report_customers.removeClass('hide');
            } else if (report == 'customers-group') {
                $('#customers-group-gen').removeClass('hide');
            } else if (report == 'invoices-report') {
                report_invoices.removeClass('hide');
                $('.invoice-status').removeClass('hide');
            } else if(report == 'payment-modes'){
                 $('#chart-payment-modes').removeClass('hide');
            }
            gen_reports();
        });
        var report_selected = $('select[name="report-group-change"]').val();
        if(report_selected != ''){
            $('select[name="report-group-change"]').change();
        }
    });

    // Generate total income bar
    function total_income_bar_report() {
        if (typeof(salesChart) !== 'undefined') {
            salesChart.destroy();
        }
        var data = {};
        data.year = $('select[name="payments_years"]').val();
        var currency = $('#currency');
        if (currency.length > 0) {
            data.report_currency = $('select[name="currency"]').val();
        }
        $.post(admin_url + 'reports/total_income_report', data).success(function(response) {
            response = $.parseJSON(response);
            salesChart = new Chart($('#chart'),{
                type:'bar',
                data:response,
                options:{responsive:true}
            })
        });
    }
    function report_by_payment_modes(){
        if (typeof(paymentMethodsChart) !== 'undefined') {
            paymentMethodsChart.destroy();
        }
        var data = {};
        data.year = $('select[name="payments_years"]').val();
        var currency = $('#currency');
        if (currency.length > 0) {
            data.report_currency = $('select[name="currency"]').val();
        }
        $.post(admin_url + 'reports/report_by_payment_modes', data).success(function(response) {
            response = $.parseJSON(response);
            paymentMethodsChart = new Chart($('#chart-payment-modes'),{
                type:'bar',
                data:response,
                options:{responsive:true}
            })
        });

    }

    // Generate customers report
    function customers_report() {
        if ($.fn.DataTable.isDataTable('.table-customers-report')) {
            $('.table-customers-report').DataTable().destroy();
        }

        initDataTable('.table-customers-report', admin_url + 'reports/customers_report', false, false, fnServerParams);
    }

    function report_by_customer_groups() {
        if (typeof(groupsChart) !== 'undefined') {
            groupsChart.destroy();
        }
        var data = {};
        data.months_report = $('select[name="months-report"]').val();
        data.report_from = report_from.val();
        data.report_to = report_to.val();

        var currency = $('#currency');
        if (currency.length > 0) {
            data.report_currency = $('select[name="currency"]').val();
        }
        $.post(admin_url + 'reports/report_by_customer_groups', data).success(function(response) {
            response = $.parseJSON(response);
            groupsChart = new Chart($('#customers-group-gen'),{
                type:'line',
                data:response
            });
        });
    }

    function invoices_report() {
        if ($.fn.DataTable.isDataTable('.table-invoices-report')) {
            $('.table-invoices-report').DataTable().destroy();
        }
        initDataTable('.table-invoices-report', admin_url + 'reports/invoices_report', false, false, fnServerParams);
        var data = {};
        data.months_report = $('select[name="months-report"]').val();
        data.report_from = report_from.val();
        data.report_to = report_to.val();
        data.invoice_status = $('select[name="invoice_status"]').selectpicker('val');
        var currency = $('#currency');
        if (currency.length > 0) {
            data.report_currency = $('select[name="currency"]').val();
        }
        $.post(admin_url + 'reports/invoices_report_total', data).success(function(response) {
            response = $.parseJSON(response);
            $('.invoice-report-amount-without-taxes').html(response.total_without_tax);
            $('.invoice-report-amount-with-taxes').html(response.total_with_tax);
            $('.invoice-report-taxes').html(response.taxes);
            $('.invoice-report-discounts').html(response.discounts);
        });
    }

    // Main generate report function
    function gen_reports() {
        if (!$('#chart').hasClass('hide')) {
            total_income_bar_report();
        } else if(!$('#chart-payment-modes').hasClass('hide')){
            report_by_payment_modes();
        } else if (!report_customers.hasClass('hide')) {
            customers_report();
        } else if (!$('#customers-group-gen').hasClass('hide')) {
            report_by_customer_groups();
        } else if (!report_invoices.hasClass('hide')) {
            invoices_report();
        }
    }
</script>
</body>
</html>
