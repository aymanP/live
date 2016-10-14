<?php
    $is_admin = is_admin();
    $i = 0;
    foreach ($statuses as $status) {
      $settings = '';
      foreach(get_system_favourite_colors() as $color){
        $color_selected_class = 'cpicker-small';
        if($color == $status['color']){
          $color_selected_class = 'cpicker-big';
        }
        $settings .= "<div class='kanban-cpicker cpicker ".$color_selected_class."' data-color='".$color."' style='background:".$color.";border:1px solid ".$color."'></div>";
      }
      ?>
<ul class="kan-ban-col" data-col-status-id="<?php echo $status['id']; ?>">
    <li class="kan-ban-col-wrapper">
        <div class="border-right panel_s">
        <?php
            $status_color = '';
            if(!empty($status["color"])){
              $status_color = 'style="background:'.$status["color"].';border:1px solid '.$status['color'].'"';
            }
        ?>
        <div class="panel-heading-bg primary-bg" <?php echo $status_color; ?> data-status-id="<?php echo $status['id']; ?>">
            <div class="kan-ban-step-indicator<?php if($status['isdefault'] == 1){ echo ' kan-ban-step-indicator-full'; } ?>"></div>
            <i class="fa fa-reorder pointer"></i>
            <span class="heading pointer" <?php if($is_admin){ ?> data-order="<?php echo $status['statusorder']; ?>" data-color="<?php echo $status['color']; ?>" data-name="<?php echo $status['name']; ?>" onclick="edit_status(this,<?php echo $status['id']; ?>); return false;" <?php } ?>><?php echo $status['name']; ?>
            </span>
            <a href="#" onclick="return false;" class="pull-right color-white kanban-color-picker kanban-stage-color-picker<?php if($status['isdefault'] == 1){ echo ' kanban-stage-color-picker-last'; } ?>" data-placement="bottom" data-toggle="popover" data-content="
            <div class='text-center'>
            <button type='button' return false;' class='btn btn-success btn-block mtop10 new-lead-from-status'>
            <?php echo _l('new_lead'); ?>
            </button>
            </div>
            <hr />
            <div class='kan-ban-settings cpicker-wrapper'>
            <?php echo $settings; ?>
            </div>" data-html="true" data-trigger="focus">
            <i class="fa fa-angle-down"></i>
            </a>
        </div>
        <div class="kan-ban-content-wrapper">
            <div class="kan-ban-content">
                <ul class="status leads-status sortable" data-lead-status-id="<?php echo $status['id']; ?>">
                    <?php
                        $limit = get_option('leads_kanban_limit');
                        $defaut_leads_kanban_sort = get_option('defaut_leads_kanban_sort');
                        $defaut_leads_kanban_sort_type = get_option('defaut_leads_kanban_sort_type');
                          if(!is_numeric($limit)){
                           $limit = 500;
                          }
                          $this->db->select('tblleads.name as lead_name,tblleadssources.name as source_name,tblleads.id as id,assigned,email,phonenumber,company,dateadded,status,lastcontact');
                          $this->db->from('tblleads');
                          $this->db->join('tblleadssources','tblleadssources.id=tblleads.source','left');
                          $this->db->where('status', $status['id']);
                          if (!$is_admin) {
                             $this->db->where('(assigned = '.get_staff_user_id().' OR addedfrom='.get_staff_user_id().' OR is_public=1)');
                          }
                        if ($this->input->get('search')) {
                           $q = $this->input->get('search');
                           $this->db->where('(tblleads.name LIKE "%'.$q.'%" OR tblleadssources.name LIKE "%'.$q.'%" OR email LIKE "%'.$q.'%" OR phonenumber LIKE "%'.$q.'%" OR company LIKE "%'.$q.'%")');
                        }
                        if($this->input->get('sort_by')){
                         $this->db->order_by($this->input->get('sort_by'),$this->input->get('sort'));
                        } else {
                         $this->db->order_by($defaut_leads_kanban_sort, $defaut_leads_kanban_sort_type);
                        }
                        $this->db->limit($limit);
                        $leads = $this->db->get()->result_array();
                        foreach ($leads as $lead) {
                         $lead_already_client_tooltip = '';
                         if (total_rows('tblclients', array(
                           'leadid' => $lead['id']
                           ))) {
                           $lead_already_client_tooltip = ' data-toggle="tooltip" title="' . _l('lead_have_client_profile') . '"';
                        }
                    if ($lead['status'] == $status['id']) { ?>
                    <li data-lead-id="<?php echo $lead['id']; ?>"<?php echo $lead_already_client_tooltip; ?> class="<?php if(total_rows('tblclients',array('leadid'=>$lead['id'])) > 0 && get_option('lead_lock_after_convert_to_customer') == 1 && !$is_admin){echo 'not-sortable';} ?>">
                        <div class="panel-body lead-body">
                            <div class="row">
                                <div class="col-md-12 lead-name">
                                    <a href="#" onclick="init_lead(<?php echo $lead['id']; ?>);return false;">
                                        <h5 class="bold"><?php echo $lead['lead_name']; ?></h5>
                                    </a>
                                </div>
                                <div class="col-md-6 text-muted">
                                    <small  class="text-dark"><?php echo _l('leads_canban_source', $lead['source_name']); ?></small>
                                     <?php
                                    if ($lead['assigned'] != 0) { ?>
                                    <br />
                                    <a href="<?php echo admin_url('profile/' . $lead['assigned']); ?>" data-placement="right" data-toggle="tooltip" title="<?php echo get_staff_full_name($lead['assigned']); ?>" class="mtop5 inline-block">
                                    <?php echo staff_profile_image($lead['assigned'], array(
                                        'staff-profile-image-small'
                                        )); ?></a>
                                <?php  } ?>
                                </div>
                                <div class="col-md-6 text-right text-muted">
                                    <?php if(is_date($lead['lastcontact']) && $lead['lastcontact'] != '0000-00-00 00:00:00'){ ?>
                                    <small class="text-dark"><?php echo _l('leads_dt_last_contact'); ?> <span class="bold"><?php echo time_ago($lead['lastcontact']); ?></span></small><br />
                                    <?php } ?>
                                    <small class="text-dark"><?php echo _l('lead_created'); ?>: <span class="bold"><?php echo time_ago($lead['dateadded']); ?></span></small><br />
                                    <?php $total_notes = total_rows('tblnotes', array(
                                        'rel_id' => $lead['id'],
                                        'rel_type'=>'lead',
                                        )); ?>
                                    <span class="mright5 mtop5 inline-block text-muted" data-toggle="tooltip" data-placement="left" data-title="<?php echo _l('leads_canban_notes',$total_notes); ?>">
                                    <i class="fa fa-sticky-note-o"></i> <?php echo $total_notes; ?>
                                    </span>
                                    <?php $total_attachments = total_rows('tblleadattachments', array(
                                      'leadid' => $lead['id']
                                      )); ?>
                                    <span class="mtop5 inline-block text-muted" data-placement="left" data-toggle="tooltip" data-title="<?php echo _l('lead_kan_ban_attachments',$total_attachments); ?>">
                                   <i class="fa fa-paperclip"></i>
                                      <?php echo $total_attachments; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php } } ?>
                </ul>
            </div>
        </div>
    </li>
</ul>
<?php $i++; } ?>
