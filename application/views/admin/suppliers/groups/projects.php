<?php
/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 08/11/2016
 * Time: 16:43
 */

?>


<?php if(isset($supplier)){ ?>
    <?php if(has_permission('projects','','create')){ ?>
        <a href="<?php echo admin_url('projects/project?supplier_id='.$supplier->supplierid); ?>" class="btn btn-info"><?php echo _l('new_project'); ?></a>
    <?php } ?>
    <?php render_datatable(array(
        _l('project_name'),
        _l('project_supplier'),
        _l('project_start_date'),
        _l('project_deadline'),
        _l('project_status'),
        _l('project_billing_type'),
        _l('project_datecreated'),
        _l('options')
    ),'projects-single-client'); ?>
<?php } ?>

