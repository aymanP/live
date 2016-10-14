        <div id="proposal-wrapper">
            <div class="row proposal-wrapper">
                <div class="col-md-9 proposal-left">
                    <div class="row">
                        <?php echo form_hidden('proposal_id',$proposal->id); ?>
                        <div class="mtop30">
                            <h1><?php echo $proposal->subject; ?></h1>
                            <hr />
                            <?php echo $proposal->content; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 proposal-right">
                    <div class="row proposal-right-content">
                        <div class="col-md-12 mtop30">
                            <?php if(is_staff_logged_in() && has_permission('proposals','','view')){ ?>
                            <a href="<?php echo admin_url('proposals/list_proposals/'.$proposal->id); ?>" class="btn btn-info pull-right"><?php echo _l('goto_admin_area'); ?></a>
                            <?php } else if(is_client_logged_in() && has_contact_permission('proposals')){ ?>
                                  <a href="<?php echo site_url('clients/proposals/'); ?>" class="btn btn-info pull-right"><?php echo _l('client_go_to_dashboard'); ?></a>
                            <?php } ?>
                            <?php echo '<a href="'.site_url().'"><img src="'.site_url('uploads/company/'.get_option('company_logo')).'"></a>'; ?>
                            <div class="row mtop10">
                                <div class="col-md-12">
                                    <address>
                                        <span class="bold"><?php echo get_option('invoice_company_name'); ?></span><br>
                                        <?php echo get_option('invoice_company_address'); ?><br>
                                        <?php echo get_option('invoice_company_city'); ?>, <?php echo get_option('invoice_company_country_code'); ?> <?php echo get_option('invoice_company_postal_code'); ?><br>
                                        <?php if(get_option('invoice_company_phonenumber') != ''){ ?>
                                        <abbr title="Phone">P:</abbr> <a href="tel:<?php echo get_option('invoice_company_phonenumber'); ?>"><?php echo get_option('invoice_company_phonenumber'); ?></a>
                                        <?php } ?>
                                        <?php
                                            ?>
                                    </address>
                                    <hr />
                                    <address>
                                        <span class="bold"><?php echo _l('proposal_to'); ?>:</span><br />
                                        <?php
                                            if(!empty($proposal->proposal_to)){
                                              echo $proposal->proposal_to . '<br />';
                                            }
                                            if(!empty($proposal->address)){
                                              echo $proposal->address . '<br />';
                                            }
                                            if(!empty($proposal->email)){
                                              echo '<a href="mailto:'.$proposal->email.'">' . $proposal->email . '</a><br />';
                                            }
                                            if(!empty($proposal->phone)){
                                              echo '<abbr title="Phone">P: </abbr>' . '<a href="tel:'.$proposal->phone.'">'.$proposal->phone.'</a>';
                                            }
                                            ?>
                                    </address>
                                    <?php
                                        $custom_fields = get_custom_fields('proposal');
                                        foreach($custom_fields as $field){ ?>
                                    <?php $value = get_custom_field_value($proposal->id,$field['id'],'proposal');
                                        if($value == ''){continue;} ?>
                                    <br /> <span class="bold"><?php echo ucfirst($field['name']); ?>: </span><?php echo $value; ?>
                                    <?php } ?>
                                </div>
                            </div>

                            <?php if(count($proposal->attachments) > 0 && $proposal->visible_attachments_to_customer_found == true){ ?>
                                <div class="clearfix"></div>
                                <hr />
                                <p class="bold mbot15"><?php echo _l('proposal_files'); ?></p>
                                <?php foreach($proposal->attachments as $attachment){
                              // Do not show hidden attachments to customer
                                    if($attachment['visible_to_customer'] == 0){continue;}
                                    ?>
                                    <div class="col-md-12 row mbot15">
                                        <div class="pull-left"><i class="<?php echo get_mime_class($attachment['filetype']); ?>"></i></div>
                                        <a href="<?php echo site_url('download/file/sales_attachment/'.$attachment['attachment_key']); ?>"><?php echo $attachment['file_name']; ?></a>
                                    </div>
                                    <?php } ?>
                                    <?php } ?>

                            <?php if($proposal->total != 0){ ?>
                            <h4 class="bold"><?php echo _l('proposal_total_info',format_money($proposal->total,$this->currencies_model->get($proposal->currency)->symbol)); ?></h4>
                            <?php } ?>
                        </div>
                        <div class="col-md-8 mtop15">
                            <?php if(($proposal->status != 2 && $proposal->status != 3)){
                                if(date('Y-m-d',strtotime($proposal->open_till)) < date('Y-m-d')){
                                  echo '<span class="warning-bg proposal-status">'._l('proposal_expired').'</span>';
                                } else { ?>
                            <?php echo form_open($this->uri->uri_string()); ?>
                            <button type="submit" data-loading-text="<?php echo _l('wait_text'); ?>" autocomplete="off" class="btn btn-success btn-block"><?php echo _l('proposal_accept_info'); ?></button>
                            <?php echo form_hidden('action','accept_proposal'); ?>
                            <?php echo form_close(); ?>
                            <?php echo form_open($this->uri->uri_string()); ?>
                            <button type="submit" data-loading-text="<?php echo _l('wait_text'); ?>" autocomplete="off" class="btn btn-danger btn-block mtop10"><?php echo _l('proposal_decline_info'); ?></button>
                            <?php echo form_hidden('action','decline_proposal'); ?>
                            <?php echo form_close(); ?>
                            <?php echo form_open($this->uri->uri_string()); ?>
                            <button type="submit" class="btn btn-default btn-block mtop10"><i class="fa fa-file-pdf-o"></i> <?php echo _l('proposal_pdf_info'); ?></button>
                            <?php echo form_hidden('action','proposal_pdf'); ?>
                            <?php echo form_close(); ?>
                            <?php } ?>
                            <!-- end expired proposal -->
                            <?php } else {
                                if($proposal->status == 2){
                                  echo '<span class="danger-bg proposal-status">'._l('proposal_status_declined').'</span>';
                                } else if($proposal->status == 3){
                                  echo '<span class="success-bg proposal-status">'._l('proposal_status_accepted').'</span>';
                                }
                                } ?>
                        </div>
                        <div class="clearfix"></div>
                        <?php if($proposal->allow_comments == 1){ ?>
                        <?php
                            $proposal_comments = '';
                            echo '<hr />';
                            foreach ($comments as $comment) {
                              $proposal_comments .= '<div class="col-md-12 proposal_comment mtop10 mbot10" data-commentid="' . $comment['id'] . '">';
                              if($comment['staffid'] != 0){
                               $proposal_comments .= staff_profile_image($comment['staffid'], array(
                                'staff-profile-image-small',
                                'media-object img-circle pull-left mright10'
                                ));
                             }
                            $proposal_comments .= '<div class="media-body">';
                            if($comment['staffid'] != 0){
                              $proposal_comments .= get_staff_full_name($comment['staffid']).'<br />';
                            }
                            $proposal_comments .= check_for_links($comment['content']) . '<br />';
                            $proposal_comments .= '<small class="mtop10 text-muted">' . _dt($comment['dateadded']) . '</small>';
                            $proposal_comments .= '</div>';
                            $proposal_comments .= '</div>';

                            }
                            echo $proposal_comments;
                            ?>
                        <div class="clearfix"></div>
                        <div class="col-md-12">
                            <?php echo form_open($this->uri->uri_string()) ;?>
                            <div class="proposal-comment">
                                <textarea name="content" id="content" rows="4" class="form-control mtop15"></textarea>
                                <button type="submit" class="btn btn-info mtop10 pull-right"><?php echo _l('proposal_add_comment'); ?></button>
                                <?php echo form_hidden('action','proposal_comment'); ?>
                            </div>
                            <?php echo form_close(); ?>
                            <div class="clearfix"></div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
