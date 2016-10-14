<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <?php echo form_open($this->uri->uri_string()); ?>
        <div class="row">
            <?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
            <div class="col-md-6">
                <div class="panel_s">
                    <div class="panel-heading">
                        <?php echo $title; ?>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo render_input('name','template_name',$template->name,'text',array('disabled'=>true)); ?>
                                <?php echo render_input('subject','template_subject',$template->subject); ?>
                                <?php echo render_input('fromname','template_fromname',$template->fromname); ?>
                                <?php echo render_input('fromemail','template_fromemail',$template->fromemail,'email',array('data-toggle'=>'tooltip','title'=>'email_template_only_domain_email')); ?>
                                <div class="checkbox checkbox-primary">
                                    <input type="checkbox" name="plaintext" id="plaintext" <?php if($template->plaintext == 1){echo 'checked';} ?>>
                                    <label for="plaintext"><?php echo _l('send_as_plain_text'); ?></label>
                                </div>
                                <div class="checkbox checkbox-primary">
                                    <input type="checkbox" name="disabled" id="disabled" <?php if($template->active == 0){echo 'checked';} ?>>
                                    <label data-toggle="tooltip" title="Disable this email from being sent" for="disabled"><?php echo _l('email_template_disabed'); ?></label>
                                </div>
                                <hr />
                                <p class="bold"><?php echo _l('email_template_email_message'); ?></p>
                                <?php echo render_textarea('message','',$template->message,array(),array(),'','tinymce'); ?>
                                <button type="submit" class="btn btn-info pull-right"><?php echo _l('submit'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel_s">
                        <div class="panel-heading">
                            <?php echo _l('available_merge_fields'); ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <?php if($template->type == 'invoice' || $template->type == 'estimate' || $template->type == 'ticket'){ ?>
                                    <div class=" col-md-12">
                                        <div class="alert alert-warning">
                                            <?php if($template->type == 'ticket'){
                                                echo _l('email_template_ticket_warning');
                                            } else {
                                                echo _l('email_template_contact_warning');
                                            } ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="col-md-12">
                                        <div class="row available_merge_fields_container">
                                            <?php
                                            $available_merge_fields;
                                            foreach($available_merge_fields as $field){
                                             foreach($field as $key => $val){
                                              echo '<div class="col-md-6 merge_fields_col">';
                                              echo '<h5 class="bold">'.ucfirst($key).'</h5>';
                                              foreach($val as $_field){
                                               foreach($_field['available'] as $_available){
                                                if($_available == $template->type){
                                                 echo '<p>'.$_field['name'].'<span class="pull-right"><a href="#" class="add_merge_field">'.$_field['key'].'</a></span></p>';
                                             }
                                         }
                                     }
                                     echo '</div>';
                                 }
                             }
                             ?>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
</div>
<?php echo form_close(); ?>
</div>
</div>
<?php init_tail(); ?>
<script>
    $(document).ready(function() {
        var merge_fields_col = $('.merge_fields_col');
        // If not fields available
        $.each(merge_fields_col, function() {
            var total_available_fields = $(this).find('p');
            if (total_available_fields.length == 0) {
                $(this).remove();
            }
        });
    });

    // Add merge field to tinymce
    $('.add_merge_field').on('click', function(e) {
       e.preventDefault();
       tinymce.activeEditor.execCommand('mceInsertContent', false, $(this).text());
   });

    _validate_form($('form'), {
        name: 'required',
        subject: 'required',
        fromname: 'required'
    });

</script>
</body>
</html>
