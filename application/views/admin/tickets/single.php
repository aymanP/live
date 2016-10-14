<?php init_head(); ?>
<style>
	#ribbon_<?php echo $ticket->ticketid; ?> span::before {
		border-top: 3px solid <?php echo $ticket->statuscolor; ?>;
		border-left: 3px solid <?php echo $ticket->statuscolor; ?>;
	}
</style>
<?php set_ticket_open($ticket->adminread,$ticket->ticketid); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
			<div class="col-md-12">
				<div class="panel_s">
					<div class="panel-body">
						<?php echo '<div class="ribbon" id="ribbon_'.$ticket->ticketid.'"><span style="background:'.$ticket->statuscolor.'">'.ticket_status_translate($ticket->ticketstatusid).'</span></div>'; ?>
						<ul class="nav nav-tabs no-margin" role="tablist">
							<li role="presentation" class="<?php if(!$this->session->flashdata('active_tab')){echo 'active';} ?>">
								<a href="#addreply" aria-controls="addreply" role="tab" data-toggle="tab">
									<?php echo _l('ticket_single_add_reply'); ?>
								</a>
							</li>
							<li role="presentation">
								<a href="#note" aria-controls="note" role="tab" data-toggle="tab">
									<?php echo _l('ticket_single_add_note'); ?>
								</a>
							</li>
							<li role="presentation">
								<a href="#othertickets" aria-controls="othertickets" role="tab" data-toggle="tab">
									<?php echo _l('ticket_single_other_user_tickets'); ?>
								</a>
							</li>
							<li role="presentation">
								<a href="#tasks" aria-controls="tasks" role="tab" data-toggle="tab">
									<?php echo _l('tasks'); ?>
								</a>
							</li>
							<li role="presentation" class="<?php if($this->session->flashdata('active_tab_settings')){echo 'active';} ?>">
								<a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">
									<?php echo _l('ticket_single_settings'); ?>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="panel_s">
					<div class="panel-body">
						<div class="row">
							<div class="col-md-8">
								<?php if(!empty($ticket->priority_name)){ ?>
								<span class="label label-default inline-block">
									<?php echo _l('ticket_single_priority',ticket_priority_translate($ticket->priorityid)); ?>
								</span>
								<?php } ?>
								<?php if($ticket->lastreply !== NULL){ ?>
								<span class="label label-primary inline-block" data-toggle="tooltip" title="<?php echo time_ago_specific($ticket->lastreply); ?>">
									<?php echo _l('ticket_single_last_reply',time_ago($ticket->lastreply)); ?>
								</span>
								<?php } ?>
								<h3>#<?php echo $ticket->ticketid; ?> - <?php echo $ticket->subject; ?></h3>
								<hr />
							</div>
							<div class="col-md-4 text-right">
								<div class="row">
									<div class="col-md-6 col-md-offset-6">
										<?php echo render_select('status_top',$statuses,array('ticketstatusid','name'),'ticket_single_change_status_top',$ticket->status,array(),array(),'','',false); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-content">

							<div role="tabpanel" class="tab-pane <?php if(!$this->session->flashdata('active_tab')){echo 'active';} ?>" id="addreply">

								<?php if(sizeof($ticket->ticket_notes) > 0){ ?>
								<div class="row">
									<div class="col-md-12">
										<h4 class="bold"><?php echo _l('ticket_single_private_staff_notes'); ?></h4>
										<div class="ticketstaffnotes">
											<div class="table-responsive">
											<table>
												<tbody>
													<?php foreach($ticket->ticket_notes as $note){ ?>
													<tr>
														<td>
														<span class="bold">
														<?php echo staff_profile_image($note['addedfrom'],array('staff-profile-xs-image')); ?> <a href="<?php echo admin_url('staff/profile/'.$note['addedfrom']); ?>"><?php echo _l('ticket_single_ticket_note_by',get_staff_full_name($note['addedfrom'])); ?>
														</a>
														</span>
														<br />
														<br />
														<?php echo $note['description']; ?>
														</td>
														<td align="right">
															<span class="bold">
																<?php echo _l('ticket_single_note_added',_dt($note['dateadded'])); ?>
															</span>
														</td>
														<td align="right" width="25">
															<?php
															if($note['addedfrom'] == get_staff_user_id() || is_admin()){ ?>
															<a href="<?php echo admin_url('misc/delete_note/'.$note["id"]); ?>" class="mright10 _delete text-danger">
																<i class="fa fa-remove"></i>
															</a>
															<?php } ?>
														</td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
							<div>
							<?php echo form_open_multipart($this->uri->uri_string(),array('id'=>'single-ticket-form')); ?>
							<?php echo form_hidden('ticketid',$ticket->ticketid); ?>
							<div class="form-group">
							<?php echo render_textarea('message','','',array(),array(),'','tinymce'); ?>
							</div>
							<div class="panel_s ticket-reply-tools">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-5">
											<?php echo render_select('status',$statuses,array('ticketstatusid','name'),'ticket_single_change_status',5,array(),array(),'','',false); ?>
											<?php if($ticket->assigned !== get_staff_user_id()){ ?>
											<div class="checkbox checkbox-primary">
												<input type="checkbox" name="assign_to_current_user" id="assign_to_current_user">
												<label for="assign_to_current_user"><?php echo _l('ticket_single_assign_to_me_on_update'); ?></label>
											</div>
											<?php } ?>
										</div>
										<?php
										$use_knowledge_base = get_option('use_knowledge_base');
										?>
										<div class="col-md-7 _buttons mtop20">
											<a class="btn btn-default pull-right mleft10" data-toggle="modal" data-target="#insert_predefined_reply">
												<?php echo _l('ticket_single_insert_predefined_reply'); ?></a>
												<?php if($use_knowledge_base == 1){ ?>
												<a class="btn btn-default pull-right" data-toggle="modal" data-target="#insert_knowledge_base_link">
													<?php echo _l('ticket_single_insert_knowledge_base_link'); ?></a>
													<?php } ?>
												</div>
												<?php
												include_once(APPPATH . 'views/admin/includes/modals/insert_predefined_reply.php');
												if($use_knowledge_base == 1){
													include_once(APPPATH . 'views/admin/includes/modals/insert_knowledge_base_link.php');
												}
												?>
											</div>
											<hr />
											<div class="row attachments">
												<div class="attachment">
													<div class="col-md-5 mbot15">
														<label for="attachment" class="control-label">
																<?php echo _l('ticket_single_attachments'); ?>
															</label>
														<div class="input-group">
															<input type="file" class="form-control" name="attachments[]" accept="<?php echo get_ticket_form_accepted_mimes(); ?>">
															<span class="input-group-btn">
																<button class="btn btn-success add_more_attachments" type="button"><i class="fa fa-plus"></i></button>
																</span>
														</div>
													</div>
													<div class="clearfix"></div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<button type="submit" class="btn btn-info" data-form="#single-ticket-form" autocomplete="off" data-loading-text="<?php echo _l('wait_text'); ?>">
														<?php echo _l('ticket_single_add_response'); ?>
													</button>
												</div>
											</div>
										</div>
									</div>
									<?php echo form_close(); ?>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane" id="note">
									<div class="form-group">
										<label for="note_description"><?php echo _l('ticket_single_note_heading'); ?></label>
										<textarea class="form-control" name="note_description" rows="5"></textarea>
									</div>
									<a class="btn btn-info pull-right add_note_ticket"><?php echo _l('ticket_single_add_note'); ?></a>
								</div>
								<div role="tabpanel" class="tab-pane" id="othertickets">
									<?php echo AdminTicketsTableStructure(); ?>
								</div>
								<div role="tabpanel" class="tab-pane" id="tasks">
									<?php init_relation_tasks_table(array('data-new-rel-id'=>$ticket->ticketid,'data-new-rel-type'=>'ticket')); ?>
								</div>
								<div role="tabpanel" class="tab-pane <?php if($this->session->flashdata('active_tab_settings')){echo 'active';} ?>" id="settings">
									<div class="row">
										<div class="col-md-6">
											<div class="col-md-12 row">
												<?php echo render_input('subject','ticket_settings_subject',$ticket->subject); ?>
											</div>
											<div class="col-md-12 row">
												<div class="form-group">
										<label for="contactid"><?php echo _l('ticket_settings_client'); ?></label>
										<select name="contactid" id="contactid" class="selectpicker" data-width="100%" data-live-search="true" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
										<option value=""></option>
											<?php
											foreach($contacts as $contact) { ?>
												<option value="<?php echo $contact['id']; ?>" data-subtext="<?php echo get_company_name($contact['userid']); ?>" <?php if($contact['id'] == $ticket->contactid){echo 'selected';} ?>><?php echo $contact['firstname'] . ' ' . $contact['lastname']; ?></option>
												<?php } ?>
											</select>
											<?php echo form_hidden('userid',$ticket->userid); ?>
										</div>

											</div>
											<div class="col-md-12 row">
												<?php echo render_input('to','ticket_settings_to',$ticket->submitter,'text',array('disabled'=>true)); ?>
											</div>
											<div class="col-md-12 row">
												<?php
												if($ticket->userid != 0){
													echo render_input('email','ticket_settings_email',$ticket->email,'email',array('disabled'=>true));
												} else {
													echo render_input('email','ticket_settings_email',$ticket->ticket_email,'email',array('disabled'=>true));
												}
												?>
											</div>
										</div>
										<div class="col-md-6">
											<?php echo render_select('department',$departments,array('departmentid','name'),'ticket_settings_departments',$ticket->department); ?>
												<?php echo render_select('priority',$priorities,array('priorityid','name'),'ticket_settings_priority',$ticket->priority); ?>
												<div class="form-group">
												<label for="project_id"><?php echo _l('project'); ?></label>
													<select name="project_id" id="project_id" class="selectpicker" data-width="100%" data-live-search="true" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
												<option value="0"></option>
												<?php foreach($projects as $project){
													$selected = '';
													if($ticket->project_id == $project['id']){
														$selected = 'selected';
													}
													?>
													<option <?php echo $selected; ?> value="<?php echo $project['id']; ?>"><?php echo $project['name']; ?></option>
													<?php } ?>
												</select>
												</div>
													<?php if(get_option('services') == 1){ ?>
												<?php echo render_select('service',$services,array('serviceid','name'),'ticket_settings_service',$ticket->service); ?>
											<?php } ?>
											<div class="form-group">
												<label for="assigned" class="control-label">
													<?php echo _l('ticket_settings_assign_to'); ?>
												</label>
												<select name="assigned" id="assigned" class="form-control selectpicker" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
													<option value=""><?php echo _l('ticket_settings_none_assigned'); ?></option>
													<?php foreach($staff as $member){ ?>
													<option value="<?php echo $member['staffid']; ?>" <?php if($ticket->assigned == $member['staffid']){echo 'selected';} ?>>
														<?php echo $member['firstname'] . ' ' . $member['lastname'] ; ?>
													</option>
													<?php } ?>
												</select>
											</div>
											 <?php echo render_custom_fields('tickets',$ticket->ticketid); ?>

										</div>
									</div>
									<div class="row">
										<div class="col-md-12 text-center mtop25">
											<a href="#" class="btn btn-info save_changes_settings_single_ticket">
												<?php echo _l('submit'); ?>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel_s mtop20">
						<div class="panel-body <?php if($ticket->admin == NULL){echo 'client-reply';} ?>">
							<div class="row">
								<div class="col-md-3 border-right">
									<p>
										<?php if($ticket->admin == NULL || $ticket->admin == 0){ ?>
										<?php if($ticket->userid != 0){ ?>
										<a href="<?php echo admin_url('clients/client/'.$ticket->userid.'?contactid='.$ticket->contactid); ?>"
											><?php echo $ticket->submitter; ?>
										</a>
										<?php } else {
											echo $ticket->submitter;
											?>
											<br />
											<a href="mailto:<?php echo $ticket->ticket_email; ?>"><?php echo $ticket->ticket_email; ?></a>
											<hr />
											<?php
											if(total_rows('tblticketsspamcontrol',array('type'=>'sender','value'=>$ticket->ticket_email)) == 0){ ?>
											<button type="button" data-sender="<?php echo $ticket->ticket_email; ?>" class="btn btn-danger block-sender"><?php echo _l('block_sender'); ?></button>
											<?php
										} else {
											echo '<span class="label label-danger">'._l('sender_blocked').'</span>';
										}
									}
								}else {  ?>
								<a href="<?php echo admin_url('profile/'.$ticket->admin); ?>"><?php echo $ticket->opened_by; ?></a>
								<?php } ?>
							</p>
							<p class="text-muted">
								<?php if($ticket->admin !== NULL || $ticket->admin != 0){
									echo _l('ticket_staff_string');
								} else {
									if($ticket->userid != 0){
										echo _l('ticket_client_string');
									}
								}
								?>
							</p>
						</div>
						<div class="col-md-9">
							<div class="row">
								<div class="col-md-12 text-right">
									<a href="#" onclick="edit_ticket_message(<?php echo $ticket->ticketid; ?>,'ticket'); return false;"><i class="fa fa-pencil-square-o"></i></a>
								</div>
							</div>
							<div data-ticket-id="<?php echo $ticket->ticketid; ?>">
								<?php echo check_for_links($ticket->message); ?>
							</div><br />
							<p>-----------------------------</p>
							<?php if(filter_var($ticket->ip, FILTER_VALIDATE_IP)){ ?>
							<p>IP: <?php echo $ticket->ip; ?></p>
							<?php } ?>

							<?php if(count($ticket->attachments) > 0){
								echo '<hr />';
								foreach($ticket->attachments as $attachment){ ?>
								<a href="<?php echo site_url('download/file/ticket/'. $attachment['id']); ?>" class="display-block mbot5"><i class="<?php echo get_mime_class($attachment['filetype']); ?>"></i> <?php echo $attachment['file_name']; ?></a>
								<?php }
							} ?>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<?php echo _l('ticket_posted',_dt($ticket->date)); ?>
				</div>
			</div>
			<?php foreach($ticket_replies as $reply){ ?>
			<div class="panel_s">
				<div class="panel-body <?php if($reply['admin'] == NULL){echo 'client-reply';} ?>">
					<div class="row">
						<div class="col-md-3 border-right">
							<p>
								<?php if($reply['admin'] == NULL || $reply['admin'] == 0){ ?>
								<?php if($reply['userid'] != 0){ ?>
								<a href="<?php echo admin_url('clients/client/'.$reply['userid'].'?contactid='.$reply['contactid']); ?>"><?php echo $reply['submitter']; ?></a>
								<?php } else { ?>
								<?php echo $reply['submitter']; ?>
								<br />
								<a href="mailto:<?php echo $reply['reply_email']; ?>"><?php echo $reply['reply_email']; ?></a>
								<?php } ?>
								<?php }  else { ?>
								<a href="<?php echo admin_url('profile/'.$reply['admin']); ?>"><?php echo $reply['submitter']; ?></a>
								<?php } ?>
							</p>
							<p class="text-muted">
								<?php if($reply['admin'] !== NULL || $reply['admin'] != 0){
									echo _l('ticket_staff_string');
								} else {
									if($reply['userid'] != 0){
										echo _l('ticket_client_string');
									}
								}
								?>
							</p>
							<hr />
							<a href="<?php echo admin_url('tickets/delete_ticket_reply/'.$ticket->ticketid .'/'.$reply['id']); ?>" class="text-danger pull-left _delete"><span class="label label-danger"><?php echo _l('delete_ticket_reply'); ?></span></a>
								<div class="clearfix"></div>
						</div>
						<div class="col-md-9">
							<div class="row">
								<div class="col-md-12 text-right">
									<a href="#" onclick="edit_ticket_message(<?php echo $reply['id']; ?>,'reply'); return false;"><i class="fa fa-pencil-square-o"></i></a>
								</div>
							</div>
							<div class="clearfix"></div>
							<div data-reply-id="<?php echo $reply['id']; ?>">
								<?php echo check_for_links($reply['message']); ?>
							</div><br />
							<p>-----------------------------</p>
							<?php if(filter_var($reply['ip'], FILTER_VALIDATE_IP)){ ?>
							<p>IP: <?php echo $reply['ip']; ?></p>
							<?php } ?>
							<?php if(count($reply['attachments']) > 0){
								echo '<hr />';
								foreach($reply['attachments'] as $attachment){ ?>
								<a href="<?php echo site_url('download/file/ticket/'. $attachment['id']); ?>" class="display-block mbot5"><i class="<?php echo get_mime_class($attachment['filetype']); ?>"></i> <?php echo $attachment['file_name']; ?></a>
								<?php }
							} ?>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<span><?php echo _l('ticket_posted',_dt($reply['date'])); ?></span>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>

</div>
</div>
<!-- Modal -->
<div class="modal fade" id="ticket-message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<?php echo form_open(admin_url('tickets/edit_message')); ?>
		<div class="modal-content">
			<div id="edit-ticket-message-additional"></div>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><?php echo _l('ticket_message_edit'); ?></h4>
			</div>
			<div class="modal-body">
				 <?php echo render_textarea('data','','',array(),array(),'','tinymce-ticket-edit'); ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<?php init_tail(); ?>
<script src="<?php echo site_url(); ?>assets/js/tickets.js"></script>
<script>
	var Ticket_message_editor;
	var edit_ticket_message_additional = $('#edit-ticket-message-additional');
	var headers_tasks = $('.table-rel-tasks').find('th');
	var not_sortable_tasks = (headers_tasks.length - 1);
	init_rel_tasks_table(<?php echo $ticket->ticketid; ?>,'ticket');

	function edit_ticket_message(id,type){
		edit_ticket_message_additional.empty();
		var message;
		if(type == 'ticket'){
			message = $('[data-ticket-id="'+id+'"]').html();
		} else {
			message = $('[data-reply-id="'+id+'"]').html();
		}
		init_ticket_edit_editor();
		tinyMCE.activeEditor.setContent(message);
		$('#ticket-message').modal('show');
		edit_ticket_message_additional.append(hidden_input('type',type));
		edit_ticket_message_additional.append(hidden_input('id',id));
		edit_ticket_message_additional.append(hidden_input('main_ticket',$('input[name="ticketid"]').val()));
	}
	function init_ticket_edit_editor(){
		if(typeof(Ticket_message_editor) !== 'undefined'){
			return true;
		}
		Ticket_message_editor = init_editor('.tinymce-ticket-edit');
	}
</script>
</body>
</html>
