 <div class="table-responsive">
  <table class="table dt-table" data-order-col="4" data-order-type="desc">
    <thead>
      <th width="10%"><?php echo _l('clients_tickets_dt_number'); ?></th>
      <th><?php echo _l('clients_tickets_dt_subject'); ?></th>
      <th><?php echo _l('clients_tickets_dt_department'); ?></th>
      <?php if(get_option('services') == 1){ ?>
        <th><?php echo _l('clients_tickets_dt_service'); ?></th>
        <?php } ?>
        <th><?php echo _l('clients_tickets_dt_status'); ?></th>
        <?php
        $custom_fields = get_custom_fields('tickets',array('show_on_client_portal'=>1));
        foreach($custom_fields as $field){ ?>
          <th><?php echo $field['name']; ?></th>
          <?php } ?>
        <th><?php echo _l('clients_tickets_dt_last_reply'); ?></th>
      </thead>
      <tbody>
        <?php foreach($tickets as $ticket){ ?>
          <tr class="<?php if($ticket['clientread'] == 0){echo 'text-danger';} ?>">
            <td data-order="<?php echo $ticket['ticketid']; ?>">#<a href="<?php echo site_url('clients/ticket/'.$ticket['ticketid']); ?>"><?php echo $ticket['ticketid']; ?></a></td>
            <td><a href="<?php echo site_url('clients/ticket/'.$ticket['ticketid']); ?>"><?php echo $ticket['subject']; ?></a></td>
            <td><?php echo $ticket['department_name']; ?></td>
            <?php if(get_option('services') == 1){ ?>
              <td><?php echo $ticket['service_name']; ?></td>
              <?php } ?>
              <td>
                <span class="label inline-block" style="background:<?php echo $ticket['statuscolor']; ?>">
                  <?php echo ticket_status_translate($ticket['ticketstatusid']); ?></span>
                </td>
                <?php foreach($custom_fields as $field){ ?>
                  <td><?php echo get_custom_field_value($ticket['ticketid'],$field['id'],'tickets'); ?></td>
                  <?php } ?>
                <td data-order="<?php echo $ticket['lastreply']; ?>">
                  <?php
                  if ($ticket['lastreply'] == NULL) {
                   echo _l('client_no_reply');
                 } else {
                   echo _dt($ticket['lastreply']);
                 }
                 ?>
               </tr>
               <?php } ?>
             </tbody>
           </table>
         </div>
