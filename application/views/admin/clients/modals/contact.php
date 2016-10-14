<!-- Modal Contact -->
<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <?php echo form_open('admin/clients/contact/'.$customer_id.'/'.$contactid,array('id'=>'contact-form')); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <?php if(isset($contact)){ ?>
                         <img src="<?php echo contact_profile_image_url($contact->id,'thumb'); ?>" class="client-profile-image-thumb">
                         <hr />
                    <?php } ?>
                        <!-- // For email exist check -->
                        <?php echo form_hidden('contactid',$contactid); ?>
                        <?php $value=( isset($contact) ? $contact->firstname : ''); ?>
                        <?php echo render_input( 'firstname', 'client_firstname',$value); ?>
                        <?php $value=( isset($contact) ? $contact->lastname : ''); ?>
                        <?php echo render_input( 'lastname', 'client_lastname',$value); ?>
                        <?php $value=( isset($contact) ? $contact->title : ''); ?>
                        <?php echo render_input( 'title', 'contact_position',$value); ?>
                        <?php $value=( isset($contact) ? $contact->email : ''); ?>
                        <?php echo render_input( 'email', 'client_email',$value, 'email'); ?>
                        <?php $value=( isset($contact) ? $contact->phonenumber : ''); ?>
                        <?php echo render_input( 'phonenumber', 'client_phonenumber',$value); ?>
                        <?php $rel_id=( isset($contact) ? $contact->id : false); ?>
                        <?php echo render_custom_fields( 'contacts',$rel_id); ?>
                        <div class="client_password_set_wrapper">
                            <label for="password" class="control-label">
                            <?php echo _l( 'client_password'); ?>
                            </label>
                        <div class="input-group">
                            <input type="password" class="form-control password" name="password" autocomplete="off">
                            <span class="input-group-addon">
                                <a href="#password" class="show_password" onclick="showPassword('password');"><i class="fa fa-eye"></i></a>
                            </span>
                            <span class="input-group-addon">
                                <a href="#" class="generate_password" onclick="generatePassword(this);return false;"><i class="fa fa-refresh"></i></a>
                            </span>
                        </div>


                            <?php if(isset($contact)){ ?>
                            <p class="text-muted">
                                <?php echo _l( 'client_password_change_populate_note'); ?>
                            </p>
                            <?php if($contact->last_password_change != NULL){
                                echo _l( 'client_password_last_changed');
                                echo time_ago($contact->last_password_change);
                             }
                            } ?>
                        </div>

                        <hr />
                        <div class="checkbox checkbox-primary">
                            <input type="checkbox" name="is_primary" id="contact_primary" <?php if((!isset($contact) && total_rows('tblcontacts',array('is_primary'=>1,'userid'=>$customer_id)) == 0) || (isset($contact) && $contact->is_primary == 1)){echo 'checked';}; ?> <?php if((isset($contact) && total_rows('tblcontacts',array('is_primary'=>1,'userid'=>$customer_id)) == 1 && $contact->is_primary == 1)){echo 'disabled';} ?>>
                            <label for="contact_primary">
                                <?php echo _l( 'contact_primary'); ?>
                            </label>
                        </div>

                        <?php if(!isset($contact)){ ?>
                        <div class="checkbox checkbox-primary">
                            <input type="checkbox" name="donotsendwelcomeemail" id="donotsendwelcomeemail">
                            <label for="donotsendwelcomeemail">
                            <?php echo _l( 'client_do_not_send_welcome_email'); ?>
                            </label>
                        </div>
                        <?php } ?>

                        <div class="checkbox checkbox-primary">
                            <input type="checkbox" name="send_set_password_email" id="send_set_password_email">
                            <label for="send_set_password_email">
                            <?php echo _l( 'client_send_set_password_email'); ?>
                            </label>
                        </div>

                        <div class="checkbox checkbox-primary">
                            <input type="checkbox" name="email_cc" id="email_cc" <?php if((!isset($contact) && total_rows('tblcontacts',array('email_cc'=>1,'userid'=>$customer_id)) == 0) || (isset($contact) && $contact->email_cc == 1)){echo 'checked';}; ?> >
                            <label for="email_cc">
                                <?php echo _l( 'contact_active_cc'); ?>
                            </label>
                        </div>

                        <hr />
                        <p class="bold"><?php echo _l('customer_permissions'); ?></p>
                        <p class="text-danger"><?php echo _l('contact_permissions_info'); ?></p>
                        <?php
                        $default_contact_permissions = array();
                        if(!isset($contact)){
                            $default_contact_permissions = @unserialize(get_option('default_contact_permissions'));
                        }
                        ?>
                        <?php foreach($customer_permissions as $permission){ ?>
                        <div class="col-md-6 row">
                            <div class="row">
                                <div class="col-md-6 mtop10 border-right">
                                    <span class="bold"><?php echo $permission['name']; ?></span>
                                </div>
                                <div class="col-md-6 mtop10">
                                    <input type="checkbox" class="switch-box" <?php if(isset($contact) && has_contact_permission($permission['short_name'],$contact->id) || is_array($default_contact_permissions) && in_array($permission['id'],$default_contact_permissions)){echo 'checked';} ?>  value="<?php echo $permission['id']; ?>" data-size="mini" name="permissions[]">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">  </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                <button type="submit" class="btn btn-info" data-loading-text="<?php echo _l('wait_text'); ?>" autocomplete="off" data-form="#contact-form"><?php echo _l('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
