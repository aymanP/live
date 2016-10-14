<?php if($project->settings->upload_files == 1){ ?>
<?php echo form_open_multipart(site_url('clients/project/'.$project->id),array('class'=>'dropzone mbot15','id'=>'project-files-upload')); ?>
<input type="file" name="file" multiple class="hide"/>
<?php echo form_close(); ?>
<?php } ?>
<table class="table dt-table">
    <thead>
        <tr>
            <th><?php echo _l('project_file_filename'); ?></th>
            <th><?php echo _l('project_file__filetype'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($files as $file){ ?>
        <tr>
            <td>
                <?php if(is_image(PROJECT_ATTACHMENTS_FOLDER .$project->id.'/'.$file['file_name'])){
                    echo '<a href="'.site_url('uploads/projects/'.$project->id.'/'.$file['file_name']).'" download><img class="project-file-image" src="'.site_url('uploads/projects/'.$project->id.'/'.$file['file_name']).'" width="100"></a>';
                    }
                    ?>
                <a href="<?php echo site_url('uploads/projects/'.$project->id.'/'.$file['file_name']); ?>"><?php echo $file['file_name']; ?></a>
            </td>
            <td><?php echo $file['filetype']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
