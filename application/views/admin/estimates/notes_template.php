<?php foreach($notes as $note){ ?>
<div class="media estimate-note">
    <div class="media-left">
        <a href="<?php echo admin_url('profile/'.$note["addedfrom"]); ?>">
        <?php echo staff_profile_image($note['addedfrom'],array('staff-profile-image-small','media-object')); ?>
        </a>
    </div>
    <div class="media-body">
        <?php if($note['addedfrom'] == get_staff_user_id() || is_admin()){ ?>
        <a href="#" class="pull-right text-danger" onclick="delete_estimate_note(this,<?php echo $note['id']; ?>);return false;"><i class="fa fa fa-times"></i></a>
        <?php } ?>
        <h5 class="media-heading mtop10"><?php echo get_staff_full_name($note['addedfrom']); ?></h5>
        <?php echo $note['description']; ?><small class="text-muted display-block"><?php echo _dt($note['dateadded']); ?></small>
    </div>
    <hr />
</div>
<?php } ?>
