<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
            <div class="col-md-12" id="small-table">
                <div class="panel_s">
                    <div class="panel-body _buttons">
                        <?php if(has_permission('expenses','','create')){ ?>
                            <a href="<?php echo admin_url('expenses/expense'); ?>" class="btn btn-info"><?php echo _l('new_expense'); ?></a>
                            <?php } ?>
                            <?php $this->load->view('admin/expenses/filter_by_template'); ?>
                            <a href="#" onclick="slideToggle('#stats-top'); return false;" class="pull-right btn btn-default mright5 mleft5 btn-with-tooltip" data-toggle="tooltip" title="<?php echo _l('view_stats_tooltip'); ?>"><i class="fa fa-bar-chart"></i></a>
                            <a href="#" class="btn btn-default pull-right btn-with-tooltip toggle-small-view hidden-xs" onclick="toggle_small_view('.table-expenses','#expense'); return false;" data-toggle="tooltip" title="<?php echo _l('invoices_toggle_table_tooltip'); ?>"><i class="fa fa-angle-double-left"></i></a>
                            <div id="stats-top" class="hide">
                                <hr />
                                <div id="expenses_total"></div>
                           </div>
                       </div>
                   </div>
                   <div class="panel_s">
                    <div class="panel-body">
                        <div class="clearfix"></div>
                        <!-- if expenseid found in url -->
                        <?php echo form_hidden('expenseid',$expenseid); ?>
                        <?php
                        $table_data = array(
                            _l('id'),
                            _l('expense_dt_table_heading_category'),
                            _l('expense_dt_table_heading_amount'),
                            _l('expense_receipt'),
                            _l('expense_dt_table_heading_date'),
                            _l('project'),
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
            <div class="col-md-7">
                <div id="expense" class="hide">
                </div>
            </div>
        </div>
    </div>
</div>
<script>var hidden_columns = [5,6,7,8];</script>
<?php init_tail(); ?>
<script>
    $(document).ready(function(){
        // Expenses additional server params
        var Expenses_ServerParams = {};
        $.each($('._hidden_inputs._filters input'),function(){
            Expenses_ServerParams[$(this).attr('name')] = '[name="'+$(this).attr('name')+'"]';
        });
        initDataTable('.table-expenses', window.location.href, 'undefined', 'undefined', Expenses_ServerParams, [4, 'DESC']).column(0).visible(false, false).columns.adjust().draw(false);
        Dropzone.autoDiscover = false;
        init_expense();
    });
    function init_expense(id) {
        var _expenseid = $('body').find('input[name="expenseid"]').val();
            // Check if expense passed from url, hash is prioritized becuase is last
            if (_expenseid !== '' && !window.location.hash) {
                id = _expenseid;
            } else {
                // check first if hash exists and not id is passed, becuase id is prioritized
                if(window.location.hash && !id) {
                    id = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
                }
            }
            if (typeof(id) == 'undefined' || id == '') {
                return;
            }
            $('body').find('input[name="expenseid"]').val('');
            if (!$('body').hasClass('small-table')) {
                toggle_small_view('.table-expenses','#expense');
            }
            $('input[name="expenseid"]').val(id);
            do_hash_helper(id);
            $('#expense').load(admin_url + 'expenses/get_expense_data_ajax/' + id);
            if (is_mobile()) {
              $('html, body').animate({
                scrollTop: $('#expense').offset().top + 150
            }, 600);
          }

      }
</script>
</body>
</html>
