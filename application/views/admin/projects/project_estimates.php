<?php
/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 26/10/2016
 * Time: 13:25
 */

if(has_permission('estimates','','create')){
    include_once(APPPATH . 'views/admin/etimates/estimates_top_stats.php');
}
?>
<div class="project_estimates">
    <?php include_once(APPPATH.'views/admin/estimates/filter_params.php'); ?>
    <?php $this->load->view('admin/estimates/list_template'); ?>
    <?php $this->load->view('admin/includes/modals/sales_attach_file'); ?>
</div>

