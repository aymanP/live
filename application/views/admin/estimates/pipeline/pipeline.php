<?php
$is_admin = is_admin();
$fields_client = $this->db->list_fields('tblclients');
$fields_estimates = $this->db->list_fields('tblestimates');
$i = 0;
foreach ($estimate_statuses as $status) { ?>
    <ul class="kan-ban-col">
        <li class="kan-ban-col-wrapper">
            <div class="border-right panel_s">
                <div class="panel-heading-bg <?php echo estimate_status_color_class($status); ?>-bg">
                <div class="kan-ban-step-indicator<?php if($i == count($estimate_statuses) -1){ echo ' kan-ban-step-indicator-full'; } ?>"></div>
                    <?php echo estimate_status_by_id($status); ?>
                </div>
                <div class="kan-ban-content-wrapper">
                    <div class="kan-ban-content">
                        <ul class="sortable status pipeline-status" data-status-id="<?php echo $status; ?>">
                            <?php
                            $this->db->select('id,status');
                            $this->db->from('tblestimates');
                            $this->db->where('status', $status);
                            $this->db->join('tblclients','tblclients.userid = tblestimates.clientid','left');

                            if ($this->input->get('search')) {
                               $q = $this->input->get('search');
                               $this->db->like('company', $q);

                               foreach($fields_client as $field){
                                 $this->db->or_like('tblclients.'.$field,$q);
                             }
                             foreach($fields_estimates as $field){
                                 $this->db->or_like('tblestimates.'.$field,$q);
                             }
                         }
                         if($this->input->get('sort_by')){
                           $this->db->order_by('tblestimates.'.$this->input->get('sort_by'),$this->input->get('sort'));
                       } else {
                        $this->db->order_by(get_option('default_estimates_pipeline_sort'), get_option('defaut_estimates_pipeline_sort_type'));
                    }
                    $estimates = $this->db->get()->result_array();
                    foreach ($estimates as $estimate) {
                        if ($estimate['status'] == $status) {
                           $_estimate = $this->estimates_model->get($estimate['id']); ?>
                           <li data-estimate-id="<?php echo $estimate['id']; ?>">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="bold pipeline-heading"><a href="#" onclick="estimate_pipeline_open(<?php echo $estimate['id']; ?>); return false;"><?php echo format_estimate_number($estimate['id']); ?></a>
                                            <a href="<?php echo admin_url('estimates/estimate/'.$estimate['id']); ?>" target="_blank" class="pull-right"><small><i class="fa fa-pencil-square-o" aria-hidden="true"></i></small></a>
                                        </h4>
                                        <h5 class="bold">
                                            <a href="<?php echo admin_url('clients/client/'.$_estimate->clientid); ?>" target="_blank">
                                                <?php echo $_estimate->client->company; ?>
                                            </a>
                                        </h5>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <span class="bold">
                                                    <?php echo _l('estimate_total') . ':' . format_money($_estimate->total,$_estimate->symbol); ?>
                                                </span>
                                                <br />
                                                <?php echo _l('estimate_data_date') . ': ' . _d($_estimate->date); ?>
                                                <?php if(is_date($_estimate->expirydate) || !empty($_estimate->expirydate)){
                                                    echo '<br />';
                                                    echo _l('estimate_data_expiry_date') . ': ' . _d($_estimate->expirydate);
                                                } ?>
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <small><i class="fa fa-paperclip"></i> <?php echo _l('estimate_notes'); ?>: <?php echo total_rows('tblnotes', array(
                                                    'rel_id' => $_estimate->id,
                                                    'rel_type' => 'estimate',
                                                    )); ?></small>
                                            </div>
                                        </div>
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
