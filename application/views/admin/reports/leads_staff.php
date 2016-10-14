<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <a href="<?php echo admin_url('reports/leads'); ?>" class="btn btn-success"><?php echo _l('switch_to_staff_report'); ?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 animated fadeIn">
                <div class="panel_s">
                    <div class="panel-body">
                    <?php echo form_open($this->uri->uri_string().'?type=staff'); ?>
                       <div class="row">
                        <div class="col-md-4">
                            <?php echo render_date_input('staff_report_from_date','from_date',_d($this->input->post('staff_report_from_date'))); ?>
                        </div>
                        <div class="col-md-4">
                            <?php echo render_date_input('staff_report_to_date','to_date',_d($this->input->post('staff_report_to_date'))); ?>
                        </div>
                        <div class="col-md-4 text-left">
                            <button type="submit" class="btn btn-info label-margin"><?php echo _l('generate'); ?></button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    <hr />
                    <canvas class="leads-staff-report chart mtop20" height="100" id="leads-staff-report"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php init_tail(); ?>
<script>
    window.onload = function(){
        new Chart($('#leads-staff-report'),{
            data:<?php echo $leads_staff_report; ?>,
            type:'bar',
            options:{responsive:true}
        })
    };
</script>
</body>
</html>
