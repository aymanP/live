<?php
/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 26/10/2016
 * Time: 17:13
 */
?>
<div class="_filters _hidden_inputs">
    <?php
    foreach($estimates_sale_agents as $agent){
        echo form_hidden('sale_agent_'.$agent['sale_agent']);
    }
    foreach($estimates_statuses as $_status){
        $val = '';
        if($_status == $chosen_estimate_status){
            $val = $_status;
        }
        echo form_hidden('estimate_'.$_status,$val);
    }
    foreach($estimates_years as $year){
        echo form_hidden('year_'.$year['year'],$year['year']);
    }

    echo form_hidden('not_sent',$this->input->get('custom_view'));
    echo form_hidden('not_have_payment');
    echo form_hidden('recurring');
    echo form_hidden('project_id');
    ?>
</div>
