<?php
$alertclass = "";
if($this->session->flashdata('message-success')){
   $alertclass = "success";
} else if ($this->session->flashdata('message-warning')){
   $alertclass = "warning";
} else if ($this->session->flashdata('message-info')){
   $alertclass = "info";
} else if ($this->session->flashdata('message-danger')){
   $alertclass = "danger";
}
if($this->session->flashdata('message-'.$alertclass)){ ?>
    <div class="alert alert-<?php echo $alertclass; ?>">
        <?php echo $this->session->flashdata('message-'.$alertclass); ?>
    </div>
    <div class="clearfix"></div>
    <?php } ?>
    <?php
    $_announcements = get_announcements_for_user(false);
    if(sizeof($_announcements) > 0 && is_client_logged_in() && isset($is_home)){ ?>
        <div class="panel_s">
            <?php foreach($_announcements as $__announcement){ ?>
                <div class="panel-body announcement mbot15">
                    <div class="alert-dismissible" role="alert">
                      <a href="<?php echo site_url('clients/dismiss_announcement/'.$__announcement['announcementid']); ?>" class="close"><span aria-hidden="true">&times;</span></a>
                        <h4 class="bold no-margin font-medium text-info">
                            <?php echo _l('announcement'); ?>! <?php if($__announcement['showname'] == 1){ echo _l('announcement_from') . ' ' . $__announcement['firstname'] . ' ' .$__announcement['lastname']; } ?><br /><small> <?php echo _l('clients_announcement_added') .' '. _dt($__announcement['dateadded']); ?></small></h4>
                        </div>
                        <hr />
                        <h4 class="bold font-medium"><?php echo $__announcement['name']; ?></h4>
                        <?php echo check_for_links($__announcement['message']); ?>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
