 <div class="activity-feed">
    <?php foreach($activity as $activity){
        ?>
        <div class="feed-item">
           <div class="date"><?php echo time_ago($activity['dateadded']); ?></div>
           <div class="text">
              <?php if($activity['staff_id'] != 0){
                $fullname = get_staff_full_name($activity['staff_id']) . ' - ';
                ?>
                <a href="<?php echo admin_url('profile/'.$activity['staff_id']); ?>"><?php echo staff_profile_image($activity['staff_id'],array('staff-profile-xs-image','pull-left mright10')); ?></a>
                <?php } else if($activity['contact_id'] != 0){
                    $fullname = '<span class="label label-info inline-block mbot5">'._l('is_customer_indicator') . '</span> ' . get_contact_full_name($activity['contact_id']) . ' - ';
                    ?>
                    <a href="<?php echo admin_url('clients/client/'.$activity['contact_id']); ?>">
                        <img src="<?php echo contact_profile_image_url($activity['contact_id']); ?>" class="staff-profile-xs-image pull-left mright10">
                    </a>
                    <?php } else {$fullname = '[CRON] ';} ?>
                    <?php if($activity['visible_to_customer'] == 1){
                        $checked = 'checked';
                    } else {
                        $checked = '';
                    }
                    ?>
                    <div class="pull-right">
                        <small><?php echo _l('project_activity_visible_to_customer'); ?></small><br />
                        <input type="checkbox"<?php if(!has_permission('projects','','create')){echo 'disabled';} ?> class="switch-box input-xs" data-size="mini" data-id="<?php echo $activity['id']; ?>" data-switch-url="<?php echo ADMIN_URL; ?>/projects/change_activity_visibility" <?php echo $checked; ?>>
                    </div>
                    <?php echo $fullname . $activity['description']; ?><br />
                    <?php echo $activity['additional_data']; ?>
                </div>
                <hr />
            </div>
            <?php } ?>
        </div>
