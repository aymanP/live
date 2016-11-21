<?php
/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 09/11/2016
 * Time: 13:04
 */

?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$aColumns = array('firstname', 'lastname', 'email', 'phonenumber', 'active', 'last_login');
$sIndexColumn = "id";
$sTable = 'tblsuppliercontacts';
$join = array();

$custom_fields = get_custom_fields('supplier_contacts',array('show_on_table'=>1));

$i = 0;
foreach($custom_fields as $field){
    array_push($aColumns,'ctable_'.$i.'.value as cvalue_'.$i);
    array_push($join,'LEFT JOIN tblcustomfieldsvalues as ctable_'.$i . ' ON tblsuppliercontacts.id = ctable_'.$i . '.relid AND ctable_'.$i . '.fieldto="'.$field['fieldto'].'" AND ctable_'.$i . '.fieldid='.$field['id']);
    $i++;
}

$where = array();
$where = array('WHERE supplierid='.$supplier_id);

// Fix for big queries. Some hosting have max_join_limit
if(count($custom_fields) > 4){
    @$this->_instance->db->query('SET SQL_BIG_SELECTS=1');
}

$result = data_tables_init($aColumns,$sIndexColumn,$sTable,$join,$where,array('tblsuppliercontacts.id as id','supplierid','is_primary'));

$output = $result['output'];
$rResult = $result['rResult'];

foreach ( $rResult as $aRow )
{
    $row = array();
    for ( $i=0 ; $i<count($aColumns) ; $i++ )
    {
        if(strpos($aColumns[$i],'as') !== false && !isset($aRow[ $aColumns[$i] ])){
            $_data = $aRow[ strafter($aColumns[$i],'as ')];
        } else {
            $_data = $aRow[ $aColumns[$i] ];
        }
        if ($aColumns[$i] == 'active') {
            $checked = '';
            if ($aRow['active'] == 1) {
                $checked = 'checked';
            }
            $_data = '<input type="checkbox" class="switch-box input-xs" data-size="mini" data-id="' . $aRow['id'] . '" data-switch-url="'.ADMIN_URL.'/suppliers/change_supplier_contact_status" ' . $checked . '>';
            // For exporting
            $_data .= '<span class="hide">' . ($checked == 'checked' ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';
        } else if($aColumns[$i] == 'last_login'){
            if(!empty($_data)){
                $_data = time_ago($_data);
            }
        } else if($aColumns[$i] == 'firstname'){
            $_data = '<a href="#" onclick="supplier_contact('.$aRow['supplierid'].','.$aRow['id'].');return false;">'.$_data.'</a>';
        }

        $row[] = $_data;
    }
    $options = '';
    $options .= icon_btn('#','pencil-square-o','btn-default',array('onclick'=>'contact('.$aRow['supplierid'].','.$aRow['id'].');return false;'));
    if(has_permission('suppliers','','delete') || is_supplier_admin($aRow['supplierid'])){
        if($aRow['is_primary'] == 0){
            $options .= icon_btn('suppliers/delete_contact/'.$aRow['supplierid'].'/'.$aRow['id'],'remove','btn-danger _delete');
        }
    }

    $row[] = $options;
    $output['aaData'][] = $row;
}

