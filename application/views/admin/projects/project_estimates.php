<?php
/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 26/10/2016
 * Time: 13:25
 */


    include_once(APPPATH . 'views\admin\estimates\estimates_top_stats.php');

?>


<div class="project_estimates">
    <?php include_once(APPPATH.'views/admin/estimates/filter_params.php'); ?>

    <?php include_once(APPPATH.'views/admin/estimates/list_template.php'); ?>


    <div class="col-md-7">
        <div id="estimate" class="hide">
        </div>
    </div>
    <?php $this->load->view('admin/includes/modals/sales_attach_file'); ?>
</div>

<script>var hidden_columns = [2,6,7];</script>
<?php init_tail(); ?>
<script>
    $(document).ready(function(){
        init_estimate();
    });


</script>
<script>
    init_items_sortable(true);
    init_btn_with_tooltips();
    init_datepicker();
    init_selectpicker();
    init_form_reminder();
    get_estimate_notes(<?php echo $estimate->id; ?>);
    init_rel_tasks_table(<?php echo $estimate->id; ?>,'estimate');
    initDataTable('.table-reminders', admin_url + 'misc/get_reminders/' + <?php echo $estimate->id ;?> + '/' + 'estimate', [4], [4]);
</script>
<script>var hidden_columns = [2,6,7];</script>

<script>
    $(document).ready(function(){
        init_estimate();
    }); </script>