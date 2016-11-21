<?php
/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 14/11/2016
 * Time: 15:27
 */
?>

<div class="_filters _hidden_inputs">
    <?php
    foreach($invoices_sale_agents as $agent){
        echo form_hidden('sale_agent_'.$agent['sale_agent']);
    }
    foreach($invoices_statuses as $_status){
        $val = '';
        if($_status == $chosen_invoice_status){
            $val = $_status;
        }
        echo form_hidden('invoices_'.$_status,$val);
    }
    foreach($invoices_years as $year){
        echo form_hidden('year_'.$year['year'],$year['year']);
    }
    foreach($payment_modes as $mode){
        echo form_hidden('invoice_payments_by_'.$mode['id']);
    }
    echo form_hidden('not_sent',$this->input->get('custom_view'));
    echo form_hidden('not_have_payment');
    echo form_hidden('recurring');
    echo form_hidden('project_id');
    ?>
</div>

