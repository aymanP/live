<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
            <div class="col-md-7">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="bold no-margin"><?php echo $announcement->name; ?></h4>
                        <hr />
                        <p class="text-info no-margin"><?php echo _l('announcement_date',_dt($announcement->dateadded)); ?></p>
                        <?php if($announcement->showname == 1){ ?>
                        <p class="text-muted no-margin"><?php echo _l('announcement_from') . ' <a href="'.admin_url('profile/'.$announcement->userid).'">' .get_staff_full_name($announcement->userid) .'</a>'; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="clearfix"></div>
                        <?php echo $announcement->message; ?>
                    </div>
                </div>
            </div>
            <?php if(count($recent_announcements) > 0){ ?>
            <div class="col-md-5">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="bold no-margin"><?php echo _l('announcements_recents'); ?></h4>
                    </div>
                </div>
                <div class="panel_s">
                    <div class="panel-body">
                        <?php foreach($recent_announcements as $announcement){ ?>
                        <a class="bold" href="<?php echo admin_url('announcements/view/'.$announcement['announcementid']); ?>">
                            <?php echo $announcement['name']; ?></a>
                            <p class="text-muted no-margin"><?php echo _l('announcement_date',_dt($announcement['dateadded'])); ?></p>
                            <?php if($announcement['showname'] == 1){ ?>
                            <p class="text-muted no-margin"><?php echo _l('announcement_from') . ' <a href="'.admin_url('profile/'.$announcement['userid']).'">' .get_staff_full_name($announcement['userid']) .'</a>'; ?></p>
                            <?php } ?>
                            <div class="mtop15">
                                <?php echo strip_tags(mb_substr($announcement['message'],0,250)) . '...'; ?>
                                <hr />
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php init_tail(); ?>
    </body>
    </html>
