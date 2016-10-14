 <?php
if(has_permission('invoices','','create')){
 include_once(APPPATH . 'views/admin/invoices/invoices_top_stats.php');
}
?>
 <div class="project_invoices">
    <?php include_once(APPPATH.'views/admin/invoices/filter_params.php'); ?>
    <?php $this->load->view('admin/invoices/list_template'); ?>
    <?php $this->load->view('admin/includes/modals/sales_attach_file'); ?>
</div>
