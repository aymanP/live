<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$aColumns         = array(
    'subject',
    'articlegroup'
    );
$sIndexColumn     = "articleid";
$sTable           = 'tblknowledgebase';
$additionalSelect = array(
    'name',
    'groupid',
    'articleid',

    );
$join             = array(
    'LEFT JOIN tblknowledgebasegroups ON tblknowledgebasegroups.groupid = tblknowledgebase.articlegroup'
    );

$where = array();
$filter = array();
$groups = $this->_instance->knowledge_base_model->get_kbg();
$_groups = array();
foreach($groups as $group){
    if($this->_instance->input->post('kb_group_'.$group['groupid'])){
        array_push($_groups,$group['groupid']);
    }
}
if(count($_groups) > 0){
    array_push($filter, 'AND articlegroup IN (' . implode(', ',$_groups) . ')');
}
if(count($filter) > 0){
    array_push($where,'AND ('.prepare_dt_filter($filter).')');
}
$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, $join,$where, $additionalSelect);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = array();
    for ($i = 0; $i < count($aColumns); $i++) {
        $_data = $aRow[$aColumns[$i]];
        if ($aColumns[$i] == 'articlegroup') {
            $_data =  $aRow['name'];
        } else if($aColumns[$i] == 'subject'){
            $_data = '<a href="'.admin_url('knowledge_base/article/'.$aRow['articleid']).'">'.$_data.'</a>';
        }

        $row[] = $_data;
    }
    $options = '';
    $options .= icon_btn('knowledge_base/article/' . $aRow['articleid'], 'pencil-square-o');
    if(has_permission('knowledge_base','','delete')){
        $options .= icon_btn('knowledge_base/delete_article/' . $aRow['articleid'], 'remove', 'btn-danger _delete');
    }

    $row[] = $options;

    $output['aaData'][] = $row;
}
