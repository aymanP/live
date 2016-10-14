<?php
$i = 0;
foreach ($statuses as $status) { ?>
    <ul class="kan-ban-col">
        <li class="kan-ban-col-wrapper">
            <div class="border-right panel_s">
                <div class="panel-heading-bg <?php echo proposal_status_color_class($status); ?>-bg">
               <div class="kan-ban-step-indicator<?php if($i == count($statuses) -1){ echo ' kan-ban-step-indicator-full'; } ?>"></div>
                    <?php echo format_proposal_status($status,'',false); ?>
                </div>
                <div class="kan-ban-content-wrapper">
                    <div class="kan-ban-content">
                        <ul class="sortable status pipeline-status" data-status-id="<?php echo $status; ?>">
                            <?php
                            $this->db->select('id,status');
                            $this->db->from('tblproposals');
                            $this->db->where('status', $status);
                            if ($this->input->get('search')) {
                               $q = $this->input->get('search');
                               $this->db->like('content', $q);
                               $this->db->or_like('subject', $q);
                               $this->db->or_like('total', $q);
                               $this->db->or_like('open_till', $q);
                               $this->db->or_like('proposal_to', $q);
                               $this->db->or_like('address', $q);
                               $this->db->or_like('email', $q);
                           }
                           if($this->input->get('sort_by')){
                               $this->db->order_by('tblproposals.'.$this->input->get('sort_by'),$this->input->get('sort'));
                           } else {
                             $this->db->order_by(get_option('default_proposals_pipeline_sort'), get_option('defaut_proposals_pipeline_sort_type'));
                        }
                        $proposals = $this->db->get()->result_array();
                        foreach ($proposals as $proposal) {
                            if ($proposal['status'] == $status) {
                               $_proposal = $this->proposals_model->get($proposal['id']); ?>
                               <li data-proposal-id="<?php echo $proposal['id']; ?>">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="bold pipeline-heading">
                                            <a href="#" onclick="proposal_pipeline_open(<?php echo $proposal['id']; ?>); return false;"><?php echo $_proposal->subject; ?></a>
                                                <a href="<?php echo admin_url('proposals/proposal/'.$proposal['id']); ?>" target="_blank" class="pull-right"><small><i class="fa fa-pencil-square-o" aria-hidden="true"></i></small></a>
                                            </h4>
                                            <h5 class="bold">
                                                <?php
                                                if($_proposal->rel_type == 'lead'){
                                                  echo '<a href="#" onclick="init_lead('.$_proposal->rel_id.'); return false;" data-toggle="tooltip" data-title="'._l('lead').'">'.$_proposal->proposal_to.'</a><br />';
                                              } else if($_proposal->rel_type == 'customer'){
                                                  echo '<a href="'.admin_url('clients/client/'.$_proposal->rel_id).'" data-toggle="tooltip" data-title="'._l('client').'">'.$_proposal->proposal_to.'</a><br />';
                                              }
                                              ?>
                                          </h5>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <?php if($_proposal->total != 0){ ?>
                                                    <span class="bold"><?php echo _l('proposal_total'); ?>: <?php echo format_money($_proposal->total,$this->currencies_model->get($_proposal->currency)->symbol); ?></span>
                                                    <br />
                                                    <?php } ?>
                                                    <?php echo _l('proposal_date'); ?>: <?php echo _d($_proposal->date); ?>
                                                    <br />
                                                    <?php echo _l('proposal_open_till'); ?>: <?php echo _d($_proposal->open_till); ?>
                                                    <br />
                                                </div>
                                                <div class="col-md-4 text-right">
                                                    <small><i class="fa fa-comments" aria-hidden="true"></i> <?php echo _l('proposal_comments'); ?>: <?php echo total_rows('tblproposalcomments', array(
                                                        'proposalid' => $_proposal->id
                                                        )); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </li>
</ul>
<?php $i++;} ?>
