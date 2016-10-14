<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$aColumns = array('name', 'start_date', 'deadline','status');
$sIndexColumn = "id";
$sTable = 'tblprojects';
$additionalSelect = array('id');
$join = array(
    'JOIN tblclients ON tblclients.userid = tblprojects.clientid',
    );

$where = array();
array_push($where,' AND tblprojects.id IN (SELECT project_id FROM tblprojectmembers WHERE staff_id='.get_staff_user_id().')');

$result = data_tables_init($aColumns,$sIndexColumn,$sTable,$join,$where,$additionalSelect);

$output = $result['output'];
$rResult = $result['rResult'];

foreach ( $rResult as $aRow )
{
    $row = array();
    for ( $i=0 ; $i<count($aColumns) ; $i++ )
    {
        $_data = $aRow[ $aColumns[$i] ];

        if($aColumns[$i] == 'start_date' || $aColumns[$i] == 'deadline'){
            $_data = _d($_data);
        } else if($aColumns[$i] == 'name'){
            $_data = '<a href="'.admin_url('projects/view/'.$aRow['id']).'">'.$_data.'</a>';
        } else if($aColumns[$i] == 'status'){
          if($_data == 1){
            $label = 'default';
          } else if($_data == 2){
            $label = 'info';
          } else if($_data == 3){
             $label = 'warning';
          } else {
             $label = 'success';
          }
          $status = '<span class="label label-'.$label.' inline-block">'._l('project_status_'.$_data).'</span>';
          $_data = $status;
      }

        $row[] = $_data;
    }
    $output['aaData'][] = $row;
}
