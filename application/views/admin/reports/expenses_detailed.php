<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <a href="<?php echo admin_url('reports/expenses'); ?>" class="btn btn-default"><?php echo _l('go_back'); ?></a>
                       <?php $this->load->view('admin/expenses/filter_by_template'); ?>
                   </div>
               </div>
               <div class="panel_s">
                <div class="panel-body">
                    <div class="clearfix"></div>
                    <?php
                    $table_data = array(
                        _l('expense_dt_table_heading_category'),
                        _l('expense_dt_table_heading_amount'),
                        _l('expenses_report_tax'),
                        _l('expenses_report_total_tax'),
                        _l('expenses_list_billable'),
                        _l('expense_dt_table_heading_date'),
                        _l('expense_dt_table_heading_customer'),
                        _l('expense_dt_table_heading_reference_no'),
                        _l('expense_dt_table_heading_payment_mode'),
                        );
                    $custom_fields = get_custom_fields('expenses',array('show_on_table'=>1));
                    foreach($custom_fields as $field){
                        array_push($table_data,$field['name']);
                    }
                    render_datatable($table_data,'expenses'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php init_tail(); ?>
<script>
   var Expenses_ServerParams = {};
    $.each($('._hidden_inputs._filters input'),function(){
        Expenses_ServerParams[$(this).attr('name')] = '[name="'+$(this).attr('name')+'"]';
    });
   initDataTable('.table-expenses', window.location.href, 'undefined', 'undefined', Expenses_ServerParams, [2, 'DESC']);
</script>
</body>
</html>
