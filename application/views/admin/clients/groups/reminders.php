<?php if(isset($client)){ ?>
<a href="#" data-toggle="modal" data-target=".reminder-modal"><i class="fa fa-bell-o"></i> <?php echo _l('set_reminder'); ?></a>
<hr />
<?php render_datatable(array( _l( 'reminder_description'), _l( 'reminder_date'), _l( 'reminder_staff'), _l( 'reminder_is_notified'), _l( 'options'), ), 'reminders');
    $this->load->view('admin/includes/modals/reminder',array('id'=>$client->userid,'name'=>'customer','members'=>$members,'reminder_title'=>_l('set_reminder')));
    } ?>
