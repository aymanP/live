<?php echo form_open_multipart(admin_url('projects/upload_file/'.$project->id),array('class'=>'dropzone','id'=>'project-files-upload')); ?>
<input type="file" name="file" multiple />
<?php echo form_close(); ?>
<small class="mtop5"><?php echo _l('project_file_visible_to_customer'); ?></small><br />
<input type="checkbox" name="visible_to_customer" class="switch-box input-xs" data-size="mini">
<div class="clearfix mtop25"></div>
<div class="container-fluid">
    <div class="table-responsive">
        <table class="table dt-table" data-order-col="4" data-order-type="desc">
            <thead>
                <tr>
                    <th><?php echo _l('project_file_filename'); ?></th>
                    <th><?php echo _l('project_file__filetype'); ?></th>
                    <th><?php echo _l('project_file_visible_to_customer'); ?></th>
                    <th><?php echo _l('project_file_uploaded_by'); ?></th>
                    <th><?php echo _l('project_file_dateadded'); ?></th>
                    <th><?php echo _l('options'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($files as $file){ ?>
                <tr>
                    <td>
                        <?php if(is_image(PROJECT_ATTACHMENTS_FOLDER .$project->id.'/'.$file['file_name'])){
                            echo '<a href="'.site_url('uploads/projects/'.$project->id.'/'.$file['file_name']).'" download><img class="project-file-image img-responsive" src="'.site_url('uploads/projects/'.$project->id.'/'.$file['file_name']).'" width="100"></a>';
                            }
                            ?>
                        <a href="<?php echo site_url('uploads/projects/'.$project->id.'/'.$file['file_name']); ?>"> <?php echo $file['file_name']; ?></a>
                    </td>
                    <td><?php echo $file['filetype']; ?></td>
                    <td>
                        <?php
                            $checked = '';
                            if($file['visible_to_customer'] == 1){
                                $checked = 'checked';
                            }
                            ?>
                        <input type="checkbox" class="switch-box input-xs" data-size="mini" data-id="<?php echo $file['id']; ?>" data-switch-url="<?php echo ADMIN_URL; ?>/projects/change_file_visibility" <?php echo $checked; ?>>
                    </td>
                    <td>
                        <?php if($file['staffid'] != 0){
                            $_data = '<a href="' . admin_url('staff/profile/' . $file['staffid']). '">' .staff_profile_image($file['staffid'], array(
                                'staff-profile-image-small'
                                )) . '</a>';
                            $_data .= ' <a href="' . admin_url('staff/member/' . $file['staffid'])  . '">' . get_staff_full_name($file['staffid']) . '</a>';
                            echo $_data;
                            } else {
                     echo ' <img src="'.contact_profile_image_url($file['contact_id'],'thumb').'" class="client-profile-image-small mrigh5">
                     <a href="'.admin_url('clients/client/'.get_user_id_by_contact_id($file['contact_id']).'?contactid='.$file['contact_id']).'">'.get_contact_full_name($file['contact_id']).'</a>';
                            }
                            ?>
                    </td>
                    <td data-order="<?php echo $file['dateadded']; ?>"><?php echo _dt($file['dateadded']); ?></td>
                    <td>
                        <button type="button" data-toggle="modal" data-original-file-name="<?php echo $file['file_name']; ?>" data-filetype="<?php echo $file['filetype']; ?>" data-path="<?php echo PROJECT_ATTACHMENTS_FOLDER .$project->id.'/'.$file['file_name']; ?>" data-target="#send_file" class="btn btn-info btn-icon"><i class="fa fa-envelope"></i></button>
                        <?php if($file['staffid'] == get_staff_user_id() || has_permission('projects','','delete')){ ?>
                        <a href="<?php echo admin_url('projects/remove_file/'.$project->id.'/'.$file['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php include_once(APPPATH . 'views/admin/clients/modals/send_file_modal.php'); ?>
