<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$aColumns     = array(
    'surveyid',
    'subject',
    '(SELECT count(questionid) FROM tblsurveyquestions WHERE tblsurveyquestions.surveyid = tblsurveys.surveyid)',
    '(SELECT count(resultsetid) FROM tblsurveyresultsets WHERE tblsurveyresultsets.surveyid = tblsurveys.surveyid)',
    'datecreated',
    'active'
);
$sIndexColumn = "surveyid";
$sTable       = 'tblsurveys';
$result       = data_tables_init($aColumns, $sIndexColumn, $sTable, array(), array(), array(
    'hash'
));
$output       = $result['output'];
$rResult      = $result['rResult'];
foreach ($rResult as $aRow) {
    $row = array();
    for ($i = 0; $i < count($aColumns); $i++) {
        $_data = $aRow[$aColumns[$i]];
        if ($aColumns[$i] == 'subject') {
            $_data = '<a href="' . admin_url('surveys/survey/' . $aRow['surveyid']) . '">' . $_data . '</a>';
        } else if ($aColumns[$i] == 'datecreated') {
            $_data = _dt($_data);
        } else if ($aColumns[$i] == 'active') {
            $checked = '';
            if ($aRow['active'] == 1) {
                $checked = 'checked';
            }
            $_data = '<input type="checkbox" class="switch-box input-xs" data-size="mini" data-id="' . $aRow['surveyid'] . '" data-switch-url="'.ADMIN_URL.'/surveys/change_survey_status" ' . $checked . '>';
            // For exporting
            $_data .= '<span class="hide">' . ($checked == 'checked' ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';
        }
        $row[] = $_data;
    }
    $options = '';
    if (total_rows('tblsurveyresultsets', 'surveyid=' . $aRow['surveyid']) > 0) {
        $options .= icon_btn('surveys/results/' . $aRow['surveyid'], 'area-chart', 'btn-success', array(
            'data-toggle' => 'tooltip',
            'title' => _l('survey_list_view_results_tooltip')
        ));
    }
    $options .= icon_btn(site_url('clients/survey/' . $aRow['surveyid'] . '/' . $aRow['hash']), 'eye', 'btn-default', array(
        'data-toggle' => 'tooltip',
        'title' => _l('survey_list_view_tooltip'),
        'target' => '_blank'
    ));

     $options .= icon_btn('surveys/survey/' . $aRow['surveyid'], 'pencil-square-o');
     if(has_permission('surveys','','delete')){
     $options .= icon_btn('surveys/delete/' . $aRow['surveyid'], 'remove', 'btn-danger _delete');
 }

     $row[]              = $options;
    $output['aaData'][] = $row;
}
