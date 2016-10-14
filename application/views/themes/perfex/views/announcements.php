<div class="panel_s">
    <div class="panel-body">
        <h4 class="bold no-margin"><?php echo _l('announcements'); ?></h4>
    </div>
</div>
<div class="panel_s">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table dt-table">
                <thead>
                    <tr>
                        <th><?php echo _l('announcement_name'); ?></th>
                        <th><?php echo _l('announcement_date_list'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($announcements as $announcement){ ?>
                    <tr>
                        <td><a href="<?php echo site_url('clients/announcement/'.$announcement['announcementid']); ?>"><?php echo $announcement['name']; ?></a></td>
                        <td><?php echo _d($announcement['dateadded']); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
