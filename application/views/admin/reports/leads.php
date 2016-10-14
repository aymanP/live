<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <a href="<?php echo admin_url('reports/leads?type=staff'); ?>" class="btn btn-success"><?php echo _l('switch_to_general_report'); ?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 animated fadeIn">
                <div class="panel_s">
                    <div class="panel-heading">
                        <?php echo _l('report_this_week_leads_conversions'); ?>
                    </div>
                    <div class="panel-body">
                        <canvas class="leads-this-week chart" id="leads-this-week"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 animated fadeIn">
                <div class="panel_s">
                    <div class="panel-heading">
                        <?php echo _l('report_leads_sources_conversions'); ?>
                    </div>
                    <div class="panel-body">
                        <canvas class="leads-sources-report chart" id="leads-sources-report"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-12 animated fadeIn">
                <div class="panel_s">
                    <div class="panel-heading">
                        <?php echo _l('report_leads_monthly_conversions'); ?>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <?php
                                    echo '<select name="month" class="selectpicker" data-none-selected-text="'._l('dropdown_non_selected_tex').'">' . PHP_EOL;
                                    for ($m=1; $m<=12; $m++) {
                                    	$_selected = '';
                                    	if($m == date('m')){
                                    		$_selected  = ' selected';
                                    	}
                                    	echo '  <option value="' . $m . '"'.$_selected.'>' . _l(date('F', mktime(0,0,0,$m,1))) . '</option>' . PHP_EOL;
                                    }
                                    echo '</select>' . PHP_EOL;
                                    ?>
                            </div>
                        </div>
                        <canvas class="leads-monthly chart mtop20" id="leads-monthly" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
    var MonthlyLeadsChart;
    $(document).ready(function() {
        $.get(admin_url + 'reports/leads_monthly_report/' + $('select[name="month"]').val(), function(response) {
            var ctx = $('#leads-monthly').get(0).getContext('2d');
            MonthlyLeadsChart = new Chart(ctx,{
                'type':'bar',
                data:response,
                options:{responsive:true},
            });
        }, 'json');

        $('select[name="month"]').on('change', function() {
            MonthlyLeadsChart.destroy();
            $.get(admin_url + 'reports/leads_monthly_report/' + $('select[name="month"]').val(), function(response) {
                var ctx = $('#leads-monthly').get(0).getContext('2d');
                MonthlyLeadsChart = new Chart(ctx,{
                'type':'bar',
                data:response,
                options:{responsive:true},
            });
            }, 'json');
        });
            new Chart($("#leads-this-week"),{
                type:'pie',
                data:<?php echo $leads_this_week_report; ?>,
            });
            new Chart($('#leads-sources-report'),{
                type:'bar',
                data:<?php echo $leads_sources_report; ?>,
                options:{responsive:true},
            });
    });
</script>
</body>
</html>
