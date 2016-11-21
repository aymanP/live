<?php
/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 08/11/2016
 * Time: 16:44
 */

?>


<?php if(isset($supplier)){ ?>
    <a href="#" data-toggle="modal" data-target=".reminder-modal"><i class="fa fa-bell-o"></i> <?php echo _l('set_reminder'); ?></a>
    <hr />
    <?php render_datatable(array( _l( 'reminder_description'), _l( 'reminder_date'), _l( 'reminder_staff'), _l( 'reminder_is_notified'), _l( 'options'), ), 'reminders');
    $this->load->view('admin/includes/modals/reminder',array('id'=>$supplier->supplierid,'name'=>'supplier','members'=>$members,'reminder_title'=>_l('set_reminder')));
} ?>

