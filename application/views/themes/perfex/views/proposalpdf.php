<?php
$dimensions = $pdf->getPageDimensions();
$pdf_logo_url = pdf_logo_url();
// Fix for logo width on proposal PDF
$pdf_logo_url = str_replace(get_option('pdf_logo_width').'px',(get_option('pdf_logo_width')+50).'px',$pdf_logo_url);
$pdf->writeHTMLCell(($dimensions['wk'] - ($dimensions['rm'] + $dimensions['lm'])), '', '', '', $pdf_logo_url, 0, 1, false, true, 'L', true);

// Get Y position for the separation
$y            = $pdf->getY();
$proposal_info = '<b>' . get_option('invoice_company_name') . '</b><br />';
$proposal_info .= get_option('invoice_company_address') . '<br/>';
$proposal_info .= get_option('invoice_company_city') . ', ';
$proposal_info .= get_option('invoice_company_country_code') . ' ';
$proposal_info .= get_option('invoice_company_postal_code') . ' ';
if(get_option('invoice_company_phonenumber') != ''){
    $proposal_info .= '<br />'.get_option('invoice_company_phonenumber');
}
// Check for company custom fields
$custom_company_fields = get_company_custom_fields();
if(count($custom_company_fields) > 0){
    $proposal_info .= '<br />';
}
foreach($custom_company_fields as $field){
    $proposal_info .= $field['label'] . ': ' . $field['value'] . '<br />';
}
$pdf->writeHTMLCell(($swap == '0' ? (($dimensions['wk'] / 2) - $dimensions['rm']) : ''), '', '', ($swap == '0' ? $y : ''), $proposal_info, 0, 0, false, true, ($swap == '1' ? 'R' : 'J'), true);
// Proposal to
$client_details = '<b>' ._l('proposal_to') . ':</b><br />';
$client_details .= $proposal->proposal_to . '<br />';
if(!empty($proposal->email)){
  $client_details .= $proposal->email . '<br />';
}
if(!empty($proposal->address)){
  $client_details .= $proposal->address . '<br />';
}
$client_details .= $proposal->phone;
$pdf->writeHTMLCell(($dimensions['wk'] / 2) - $dimensions['lm'], '', '', ($swap == '1' ? $y : ''), $client_details, 0, 1, false, true, ($swap == '1' ? 'J' : 'R'), true);
$pdf->ln(6);

$proposal_date = _l('proposal_date') . ': ' . _d($proposal->date);
$open_till = '';
if(!empty($proposal->open_till)){
    $open_till = _l('proposal_open_till'). ': ' . _d($proposal->open_till);
}
$custom_fields_data = '';
$pdf_custom_fields = get_custom_fields('proposal',array('show_on_pdf'=>1));
foreach($pdf_custom_fields as $field){
    $value = get_custom_field_value($proposal->id,$field['id'],'proposal');
    if($value == ''){continue;}
    $custom_fields_data .= $field['name'] . ': ' .  $value;
}
// Add new line if found custom fields so the custom field can go on the next line
if($custom_fields_data != ''){
    $custom_fields_data = '<br />' . $custom_fields_data;
}
// Get the proposals css
$css = file_get_contents(FCPATH.'assets/css/proposals.css');
// Theese lines should aways at the end of the document left side. Dont indent these lines
$html = <<<EOF
<style>
$css
</style>
<h1>$proposal->subject</h1>
$total
<br />
$proposal_date
<br />
$open_till
$custom_fields_data
<br />
<div style="width:675px !important;">
$proposal->content
</div>
EOF;
$pdf->writeHTML($html, true, false, true, false, '');
