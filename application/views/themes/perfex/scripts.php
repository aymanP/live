<?php if(isset($contracts_by_type_chart)){ ?>
<script>
var contracts_by_type = '<?php echo $contracts_by_type_chart; ?>';
</script>
<?php } ?>
<script src="<?php echo site_url('assets/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/plugins/datatables/datatables.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/plugins/jquery-validation/jquery.validate.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/plugins/jquery-validation/additional-methods.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/plugins/datetimepicker/jquery.datetimepicker.full.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/plugins/Chart.js/Chart.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo template_assets_url(); ?>js/global.js"></script>
<?php if(is_client_logged_in()){ ?>
<script src="<?php echo site_url('assets/plugins/remarkable-bootstrap-notify/bootstrap-notify.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/plugins/dropzone/min/dropzone.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/plugins/moment/moment-with-locales.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/plugins/moment-timezone/moment-timezone-with-data.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/plugins/moment-duration-format/moment-duration-format.js'); ?>"></script>
<script src="<?php echo site_url('assets/plugins/jquery-comments/js/jquery-comments.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/plugins/jquery-circle-progress/circle-progress.js'); ?>"></script>
<script src="<?php echo site_url('assets/plugins/gantt/js/jquery.fn.gantt.min.js'); ?>"></script>
<script src="<?php echo template_assets_url(); ?>js/clients.js"></script>
<script src="<?php echo template_assets_url(); ?>js/client-report.js"></script>
<?php } ?>
<?php
    // DONT REMOVE THIS LINE
    do_action('customers_after_js_scripts_load');
?>
