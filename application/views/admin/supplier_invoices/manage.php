<?php init_head(); ?>
    <div id="wrapper">
        <div class="content">
            <div class="row">
                <?php
                include_once(APPPATH . 'views/admin/includes/alerts.php');
                include_once(APPPATH.'views/admin/supplier_invoices/filter_params.php');
                $this->load->view('admin/supplier_invoices/list_template');
                ?>
            </div>
        </div>
    </div>
<?php $this->load->view('admin/includes/modals/sales_attach_file'); ?>
    <script>var hidden_columns = [2,6];</script>
<?php init_tail(); ?>
<script>
    var ProjectsServerParams = {};
    $.each($('._hidden_inputs._filters input'),function(){
        ProjectsServerParams[$(this).attr('name')] = '[name="'+$(this).attr('name')+'"]';
    });
    var projects_not_sortable = $('.table-estimates').find('th').length - 1;
    initDataTable('.table-estimates', window.location.href, [projects_not_sortable], [projects_not_sortable], ProjectsServerParams, [3, 'ASC']);
</script>
    <script>
        $(document).ready(function(){
            init_supplier_invoice();
        });
    </script>

    </body>
    </html>

