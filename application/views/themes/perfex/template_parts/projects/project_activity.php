<div class="mtop15"></div>
<div class="activity-feed">
    <?php if($project->settings->view_activity_log == 1){ ?>
        <?php foreach($activity as $activity){
            if($mode != null)
            {
                foreach ($mode as $mod){
                    $mode_alami = (int)$mod['mode_alami'];
                }
            }
            if($alami != null){
                foreach($alami as $alam ){
                    if ($alam['firstname'] != null)
                        $username = $alam['firstname_alami'].' '.$alam['lastname_alami'];
                    $firstname = $alam['firstname'];
                    $lastname = $alam['lastname'];
                }
            }
            ?>
            <div class="feed-item">
                <div class="date"><?php echo time_ago($activity['dateadded']); ?></div>
                <?php if($activity['staff_id'] != 0){

                    if($mode_alami == 1 && get_staff_full_name($activity['staff_id']) == $firstname.' '.$lastname) {
                        $fullname = $username.' - ';
                    } else
                    {$fullname = get_staff_full_name($activity['staff_id']) . ' - ';}
                    ?>
                    <?php echo staff_profile_image($activity['staff_id'],array('staff-profile-image-small','pull-left mright10')); ?>
                    <?php } else if($activity['contact_id'] != 0){

                    if($mode_alami == 1 && get_contact_full_name($activity['contact_id']) == $firstname.' '.$lastname) {
                         $fullname = $username.' - ';
                    }

                       else  $fullname = get_contact_full_name($activity['contact_id']) . ' - ';
                        ?>
                        <img src="<?php echo contact_profile_image_url($activity['contact_id']); ?>" class="client-profile-image-small pull-left mright10">
                        <?php } else {$fullname = '[CRON] ';} ?>
                        <div class="media-body">
                            <div class="display-block">
                                <h5 class="bold no-margin">
                                    <?php echo $fullname. $activity['description']; ?>
                                </h5>
                                <p class="text-muted"><?php echo $activity['additional_data']; ?></p>
                            </div>
                        </div>
                        <hr />
                    </div>
                    <?php } ?>
                    <?php } ?>
                </div>
