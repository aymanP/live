<?php

$dimensions = $pdf->getPageDimensions();
if($tag != ''){
    $pdf->SetFillColor(240,240,240);
    $pdf->SetDrawColor(245,245,245);
    $pdf->SetXY(0,0);
    $pdf->SetFont($font_name,'B',15);
    $pdf->SetTextColor(0);
    $pdf->SetLineWidth(0.75);
    $pdf->StartTransform();
    $pdf->Rotate(-35,109,235);
    $pdf->Cell(100,1,mb_strtoupper($tag,'UTF-8'),'TB',0,'C','1');
    $pdf->StopTransform();
    $pdf->SetFont($font_name,'',$font_size);
    $pdf->setX(10);
    $pdf->setY(10);
}

$pdf_text_color_array = hex2rgb(get_option('pdf_text_color'));
if(is_array($pdf_text_color_array) && count($pdf_text_color_array) == 3){
    $pdf->SetTextColor($pdf_text_color_array[0],$pdf_text_color_array[1],$pdf_text_color_array[2]);
}

$info_right_column = '';
$info_left_column = '';

if(get_option('show_status_on_pdf_ei') == 1){
    // Top
    if ($status == 1) {
        $status = _l('estimate_status_draft');
        $bg_status = '119, 119, 119';
    } else if ($status == 2) {
        $status = _l('estimate_status_sent');
        $bg_status = '3, 169, 244';
    } else if ($status == 3) {
        $status = _l('estimate_status_declined');
         $bg_status = '252, 45, 66';
    } else if ($status == 4) {
        $status = _l('estimate_status_accepted');
        $bg_status = '0, 191, 54';
    } else {
        $status = _l('estimate_status_expired');
        $bg_status = '255, 111, 0';
    }
    $info_right_column .= '
    <table style="text-align:center;border-spacing:3px 3px;padding:3px 4px 3px 4px;">
    <tbody>
        <tr>
            <td></td>
            <td></td>
            <td style="background-color:rgb('.$bg_status.');color:#fff;">'.mb_strtoupper($status,'UTF-8') .'</td>
        </tr>
    </tbody>
    </table>';
}

$info_right_column .= '<span style="font-weight:bold;font-size:20px;">'._l('estimate_pdf_heading').'</span><br />';
$info_right_column .= '<b style="color:#4e4e4e"># ' . $estimate_number . '</b>';

// write the first column
$info_left_column .= pdf_logo_url();
$pdf->MultiCell(($dimensions['wk'] / 2) - $dimensions['lm'], 0, $info_left_column, 0, 'J', 0, 0, '', '', true, 0, true, true, 0);
// write the second column
$pdf->MultiCell(($dimensions['wk'] / 2) - $dimensions['rm'], 0, $info_right_column, 0, 'R', 0, 1, '', '', true, 0, true, false, 0);
$pdf->ln(10);

// Get Y position for the separation
$y            = $pdf->getY();
$estimate_info = '<b>' . get_option('invoice_company_name') . '</b><br />';
$estimate_info .= get_option('invoice_company_address') . '<br/>';
$estimate_info .= get_option('invoice_company_city') . ', ';
$estimate_info .= get_option('invoice_company_country_code') . ' ';
$estimate_info .= get_option('invoice_company_postal_code') . ' ';
if(get_option('invoice_company_phonenumber') != ''){
    $estimate_info .= '<br />'.get_option('invoice_company_phonenumber');
}
// check for company custom fields
$custom_company_fields = get_company_custom_fields();
if(count($custom_company_fields) > 0){
    $estimate_info .= '<br />';
}
foreach($custom_company_fields as $field){
    $estimate_info .= $field['label'] . ': ' . $field['value'] . '<br />';
}
$pdf->writeHTMLCell(($swap == '1' ? ($dimensions['wk']) - ($dimensions['lm'] * 2) : ($dimensions['wk'] / 2) - $dimensions['lm']), '', '', $y, $estimate_info, 0, 0, false, true, ($swap == '1' ? 'R' : 'J'), true);

// Estimate to
$client_details = '<b>' ._l('estimate_to') . '</b><br />';
$client_details .= $estimate->client->company . '<br />';
$client_details .= $estimate->billing_street . '<br />';
if(!empty($estimate->billing_city)){
    $client_details .= $estimate->billing_city;
}
if(!empty($estimate->billing_state)){
    $client_details .=', '.$estimate->billing_state;
}
$billing_country = get_country_short_name($estimate->billing_country);
if(!empty($estimate->billing_state)){
    $client_details .= '<br />'.$billing_country;
}
if(!empty($estimate->billing_zip)){
    $client_details .= ', ' .$estimate->billing_zip;
}
if (!empty($estimate->client->vat)) {
    $client_details .= '<br />'._l('estimate_vat') . ': ' . $estimate->client->vat;
}
// check for invoice custom fields which is checked show on pdf
$pdf_custom_fields              = get_custom_fields('customers', array(
    'show_on_pdf' => 1
));
if(count($pdf_custom_fields) > 0){
    $client_details .= '<br />';
    foreach ($pdf_custom_fields as $field) {
        $value = get_custom_field_value($estimate->clientid, $field['id'], 'customers');
        if ($value == '') {continue;}
        $client_details .= $field['name'] . ': ' . $value . '<br />';
    }
}
$pdf->writeHTMLCell(($dimensions['wk'] / 2) - $dimensions['rm'], '', '', ($swap == '1' ? $y : ''), $client_details, 0, 1, false, true, ($swap == '1' ? 'J' : 'R'), true);
$pdf->Ln(5);
// ship to to
if($estimate->include_shipping == 1 && $estimate->show_shipping_on_estimate == 1){
    $pdf->Ln(5);
    $shipping_details = '<b>' ._l('ship_to') . '</b><br />';
    $shipping_details .= $estimate->shipping_street . '<br />' . $estimate->shipping_city . ', ' . $estimate->shipping_state .'<br />'.
    get_country_short_name($estimate->shipping_country) . ', ' . $estimate->shipping_zip;
    $pdf->writeHTMLCell(($dimensions['wk'] - ($dimensions['rm'] + $dimensions['lm'])), '', '', '', $shipping_details, 0, 1, false, true, ($swap == '1' ? 'L' : 'R'), true);
    $pdf->Ln(5);
}
// Dates
$pdf->Cell(0, 0, _l('estimate_data_date') . ': ' . _d($estimate->date), 0, 1, ($swap == '1' ? 'L' : 'R'), 0, '', 0);
if (!empty($estimate->expirydate)) {
    $pdf->Cell(0, 0, _l('estimate_data_expiry_date') . ': ' . _d($estimate->expirydate), 0, 1, ($swap == '1' ? 'L' : 'R'), 0, '', 0);
}
if (!empty($estimate->reference_no)) {
    $pdf->Cell(0, 0, _l('reference_no') . ': ' . $estimate->reference_no, 0, 1, ($swap == '1' ? 'L' : 'R'), 0, '', 0);
}
if($estimate->sale_agent != 0){
    if(get_option('show_sale_agent_on_estimates') == 1){
        $mode = get_mode((int)$estimate->clientid);
        $alami = mode_alami();
        if($mode != null)
        {
            foreach ($mode as $mod){
                // if($mod->mode_alami != null)
                $mode_alami = (int) $mod['mode_alami'];
            }
        }
        if($alami != null){
            foreach($alami as $alam ){
                if ($alam['firstname'] != null)
                    $username = $alam['firstname_alami'].' '.$alam['lastname_alami'];
                $firstname = $alam['firstname'];
                $lastname = $alam['lastname'];
            }
        }
        if($mode_alami == 1 && get_staff_full_name($estimate->sale_agent) == $firstname.' '.$lastname) {
            $adminName =  $username;
        }
        else $adminName = get_staff_full_name($estimate->sale_agent);
       $pdf->Cell(0, 0, _l('sale_agent_string') . ': ' . $username, 0, 1, ($swap == '1' ? 'L' : 'R'), 0, '', 0);
   }
}
// check for estimate custom fields which is checked show on pdf
$pdf_custom_fields = get_custom_fields('estimate',array('show_on_pdf'=>1));
foreach($pdf_custom_fields as $field){
    $value = get_custom_field_value($estimate->id,$field['id'],'estimate');
    if($value == ''){continue;}
    $pdf->Cell(0, 0, $field['name'] . ': ' .  $value, 0, 1, ($swap == '1' ? 'L' : 'R'), 0, '', 0);
}
// The Table
$pdf->Ln(5);
$item_width = 38;
// If show item taxes is disabled in PDF we should increase the item width table heading
if(get_option('show_tax_per_item') == 0){
    $item_width = $item_width + 15;
}

$qty_heading = _l('estimate_table_quantity_heading');
if($estimate->show_quantity_as == 2){
    $qty_heading = _l('estimate_table_hours_heading');
} else if($estimate->show_quantity_as == 3){
    $qty_heading = _l('estimate_table_quantity_heading') .'/'._l('estimate_table_hours_heading');
}

// Header
$tblhtml = '<table width="100%" bgcolor="#fff" cellspacing="0" cellpadding="5" border="0">
<tr height="30" bgcolor="'.get_option('pdf_table_heading_color').'" style="color:'.get_option('pdf_table_heading_text_color').';">
    <th width="5%;" align="center">#</th>
    <th width="'.$item_width.'%" align="left">'._l('estimate_table_item_heading').'</th>
    <th width="12%" align="right">'.$qty_heading.'</th>
    <th width="15%" align="right">'._l('estimate_table_rate_heading').'</th>';
    if(get_option('show_tax_per_item') == 1){
        $tblhtml .= '<th width="15%" align="right">'._l('estimate_table_tax_heading').'</th>';
    }
    $tblhtml .='<th width="15%" align="right">'._l('estimate_table_amount_heading').'</th>
</tr>';
// Items
$taxes   = array();
$_calculated_taxes = array();
$i       = 1;
$tblhtml .= '<tbody>';
foreach ($estimate->items as $item) {
    $tblhtml .= '<tr style="font-size:'.($font_size-1).'px;">';
    $tblhtml .= '<td  align="center">' . $i . '</td>';
    $tblhtml .= '<td align="left">' . $item['description'] . '<br /><span style="color:#777">'.$item['long_description'].'</span></td>';
    $tblhtml .= '<td align="right">' . floatVal($item['qty']) . '</td>';
    $tblhtml .= '<td align="right">' . _format_number($item['rate']) . '</td>';
    if(get_option('show_tax_per_item') == 1){
        $tblhtml .= '<td align="right">';
    }
    $item_taxes = get_estimate_item_taxes($item['id']);
    if(count($item_taxes) > 0){
        foreach($item_taxes as $tax){
            $calc_tax = 0;
            $tax_not_calc = false;
            if(!in_array($tax['taxname'],$_calculated_taxes)) {
                array_push($_calculated_taxes,$tax['taxname']);
                $tax_not_calc = true;
            }
            if($tax_not_calc == true){
                $taxes[$tax['taxname']] =array();
                $taxes[$tax['taxname']]['total'] = array();
                array_push($taxes[$tax['taxname']]['total'],(($item['qty'] * $item['rate']) / 100 * $tax['taxrate']));
                $taxes[$tax['taxname']]['tax_name'] = $tax['taxname'];
                $taxes[$tax['taxname']]['taxrate'] = $tax['taxrate'];
            } else {
                array_push($taxes[$tax['taxname']]['total'],(($item['qty'] * $item['rate']) / 100 * $tax['taxrate']));
            }
            if(get_option('show_tax_per_item') == 1){
                if((count($item_taxes) > 1 && get_option('remove_tax_name_from_item_table') == false) || get_option('remove_tax_name_from_item_table') == false || mutiple_taxes_found_for_item($item_taxes)){
                    $tblhtml .= str_replace('|',' ',$tax['taxname']) .'%<br />';
                } else {
                    $tblhtml .= $tax['taxrate'] .'%';
                }
            }
        }
    } else {
        if(get_option('show_tax_per_item') == 1){
            $tblhtml .= '0%';
        }
    }
    if(get_option('show_tax_per_item') == 1){
        $tblhtml .= '</td>';
    }
    $i++;
    $tblhtml .= '<td align="right">' . _format_number(($item['qty'] * $item['rate'])) . '</td>';
    $tblhtml .= '</tr>';
}
$tblhtml .= '</tbody>';
$tblhtml .= '</table>';
$pdf->writeHTML($tblhtml, true, false, false, false, '');

$pdf->Ln(8);
$tbltotal = '';
$tbltotal .= '<table cellpadding="6">';
$tbltotal .= '
<tr>
    <td align="right" width="80%">'._l('estimate_subtotal').'</td>
    <td align="right" width="20%">' . format_money($estimate->subtotal,$estimate->symbol) . '</td>
</tr>';
if($estimate->discount_percent != 0){
    $tbltotal .= '
    <tr>
        <td align="right" width="80%">'.  _l('estimate_discount') . '('. _format_number($estimate->discount_percent,true) .'%)'.'</td>
        <td align="right" width="20%">-' . format_money($estimate->discount_total,$estimate->symbol) . '</td>
    </tr>';
}
foreach($taxes as $tax){
    $total = array_sum($tax['total']);
    if($estimate->discount_percent != 0 && $estimate->discount_type == 'before_tax'){
        $total_tax_calculated = ($total * $estimate->discount_percent) / 100;
        $total = ($total - $total_tax_calculated);
    }
    // The tax is in format TAXNAME|20
    $_tax_name = explode('|',$tax['tax_name']);
    $tbltotal .= '<tr>
    <td align="right" width="80%">' . $_tax_name[0] . '(' . _format_number($tax['taxrate']) . '%)' . '</td>
    <td align="right" width="20%">' . format_money($total,$estimate->symbol) . '</td>
</tr>';
}
if ($estimate->adjustment != '0.00') {
    $tbltotal .= '<tr>
    <td align="right" width="80%">'._l('estimate_adjustment').'</td>
    <td align="right" width="20%">' . format_money($estimate->adjustment,$estimate->symbol) . '</td>
</tr>';
}
$tbltotal .= '
<tr style="background-color:#f0f0f0;">
    <td align="right" width="80%">'._l('estimate_total').'</td>
    <td align="right" width="20%">' . format_money($estimate->total, $estimate->symbol) . '</td>
</tr>';

$tbltotal .= '</table>';

$pdf->writeHTML($tbltotal, true, false, false, false, '');

if(get_option('total_to_words_enabled') == 1){
     // Set the font bold
     $pdf->SetFont($font_name,'B',$font_size);
     $pdf->Cell(0, 0, _l('num_word').': '.$CI->numberword->convert($estimate->total,$estimate->currency_name), 0, 1, 'C', 0, '', 0);
     // Set the font again to normal like the rest of the pdf
     $pdf->SetFont($font_name,'',$font_size);
     $pdf->Ln(4);
}

if (!empty($estimate->clientnote)) {
    $pdf->Ln(4);
    $pdf->SetFont($font_name,'B',10);
    $pdf->Cell(0, 0, _l('estimate_note'), 0, 1, 'L', 0, '', 0);
    $pdf->SetFont($font_name,'',10);
    $pdf->Ln(2);
    $pdf->MultiCell(190, 0, clear_textarea_breaks($estimate->clientnote),0,'L');
}

if (!empty($estimate->terms)) {
    $pdf->Ln(4);
    $pdf->SetFont($font_name,'B',10);
    $pdf->Cell(0, 0, _l('terms_and_conditions'), 0, 1, 'L', 0, '', 0);
    $pdf->SetFont($font_name,'',10);
    $pdf->Ln(2);
    $pdf->MultiCell(190, 0, clear_textarea_breaks($estimate->terms),0,'L');
}
