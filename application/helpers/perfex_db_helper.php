<?php
function client_have_transactions($id){
    $total_transactions = 0;
    $total_transactions += total_rows('tblinvoices',array('clientid'=>$id));
    $total_transactions += total_rows('tblestimates',array('clientid'=>$id));
    $total_transactions += total_rows('tblexpenses',array('clientid'=>$id,'billable'=>1));
    $total_transactions += total_rows('tblproposals',array('rel_id'=>$id,'rel_type'=>'customer'));

    if($total_transactions > 0){
        return true;
    }
    return false;
}



/**
 * Check if field is used in table
 * @param  string  $field column
 * @param  string  $table table name to check
 * @param  integer  $id   ID used
 * @return boolean
 */




function is_reference_in_table($field, $table, $id)
{
    $CI =& get_instance();
    $CI->db->where($field, $id);
    $row = $CI->db->get($table)->row();
    if ($row) {
        return true;
    }
    return false;
}
function add_views_tracking($rel_type,$rel_id){
    $CI =& get_instance();
    if(!is_staff_logged_in()){
        $CI->db->where('rel_id',$rel_id);
        $CI->db->where('rel_type',$rel_type);
        $CI->db->order_by('id','DESC');
        $CI->db->limit(1);
        $row = $CI->db->get('tblviewstracking')->row();
        if($row){
            $dateFromDatabase = strtotime($row->date);
            $date1HourAgo = strtotime("-1 hours");
            if ($dateFromDatabase >= $date1HourAgo) {
                return false;
            }
        }
        $CI->db->insert('tblviewstracking',array(
            'rel_id'=>$rel_id,
            'rel_type'=>$rel_type,
            'date'=>date('Y-m-d H:i:s'),
            'view_ip'=>$CI->input->ip_address()));

    }
}
function get_views_tracking($rel_type,$rel_id){
    $CI =& get_instance();
    $CI->db->where('rel_id',$rel_id);
    $CI->db->where('rel_type',$rel_type);
    $CI->db->order_by('date','DESC');
    return $CI->db->get('tblviewstracking')->result_array();
}
function get_user_id_by_contact_id($id){
    $CI = &get_instance();
    $CI->db->select('userid');
    $CI->db->where('id',$id);
    $client = $CI->db->get('tblcontacts')->row();
    if($client){
        return $client->userid;
    }
    return false;
}
/**
 * Add option in table
 * @since  Version 1.0.1
 * @param string $name  option name
 * @param string $value option value
 */
function add_option($name, $value = '')
{
    $CI =& get_instance();
    $exists = total_rows('tbloptions', array(
        'name' => $name
        ));
    if ($exists == 0) {
        $CI->db->insert('tbloptions', array(
            'name' => $name,
            'value' => $value
            ));
        $insert_id = $CI->db->insert_id();
        if ($insert_id) {
            return true;
        }
        return false;
    }
    return false;
}
function get_primary_contact_user_id($userid){

    $CI =& get_instance();
    $CI->db->where('userid', $userid);
    $CI->db->where('is_primary', 1);
    $row = $CI->db->get('tblcontacts')->row();

    if($row){
        return $row->id;
    }
    return false;
}

/**
 * Get option value
 * @param  string $name Option name
 * @return mixed
 */
function mode_alami(){
    $CI =& get_instance();

    $CI->db->where('email','i.ab@deepmaroc.com');

    $name = $CI->db->get('tblstaff')->result_array();

    return $name;//['firstname'].' '.$name=['lastname_alami'];
}

function get_mode($id){
    $CI =& get_instance();

    $CI->db->where('userid',$id);

    $mode = $CI->db->get('tblclients')->result_array();

    return $mode ;
}

function get_option($name)
{
    $CI =& get_instance();
    $CI->load->library('perfex_base');
    return $CI->perfex_base->get_option($name);
}

function email_alami($project_id){

    $CI =& get_instance();
    $CI->db->where('id',$project_id);
    $data  = $CI->db->get('tblprojects')->result_array();

    foreach($data as $d){
        $clientid = $d['clientid'];
    }

    $CI->db->where('userid',$clientid);
    $data_ = $CI->db->get('tblclients')->result_array();

    foreach($data_ as $d_){
        $mode_a = $d_['mode_alami'];
    }

    return $mode_a;

}

function get_a($project_id,$string){

    $alami = mode_alami();
    foreach ($alami as $alam) {
        if ($alam['firstname'] != null)
            $username = $alam['firstname_alami'] . ' ' . $alam['lastname_alami'];
        $firstname = $alam['firstname'];
        $lastname = $alam['lastname'];
    }
    if(email_alami($project_id) == 1 && $string = $firstname.' '.$lastname) return $username;
    else return $string;
}



function apply_alami($staffName)
{

    $mode = get_mode(get_client_user_id());
    $alami = mode_alami();

    if ($mode != null) {
        foreach ($mode as $mod) {
            $mode_alami = (int)$mod['mode_alami'];
        }
    }
    if ($alami != null) {
        foreach ($alami as $alam) {
            if ($alam['firstname'] != null)
                $username = $alam['firstname_alami'] . ' ' . $alam['lastname_alami'];
            $firstname = $alam['firstname'];
            $lastname = $alam['lastname'];
        }
    }

    if($mode_alami == 1 && $staffName == $firstname.' '.$lastname)
        return $username;
    else return $staffName;
}

/**
 * Get option value from database
 * @param  string $name Option name
 * @return mixed
 */
function update_option($name, $value)
{
    $CI =& get_instance();
    $CI->db->where('name', $name);
    $CI->db->update('tbloptions', array(
        'value' => $value
        ));
    if ($CI->db->affected_rows() > 0) {
        return true;
    }
    return false;
}
/**
 * Delete option
 * @since  Version 1.0.4
 * @param  mixed $id option id
 * @return boolean
 */
function delete_option($id)
{
    $CI =& get_instance();
    $CI->db->where('id', $id);
    $CI->db->or_where('name', $id);
    $CI->db->delete('tbloptions');
    if ($CI->db->affected_rows() > 0) {
        return true;
    }
    return false;
}

/**
 * Get staff full name
 * @param  string $userid Optional
 * @return string Firstname and Lastname
 */
function get_staff_full_name($userid = '')
{
    $_userid = get_staff_user_id();
    if ($userid !== '') {
        $_userid = $userid;
    }
    $CI =& get_instance();
    $CI->db->where('staffid', $_userid);
    $staff = $CI->db->select('firstname,lastname')->from('tblstaff')->get()->row();
    if($staff){
        return apply_alami($staff->firstname . ' ' . $staff->lastname);
    } else {
        return '';
    }

}
/**
 * Get client full name
 * @param  string $userid Optional
 * @return string Firstname and Lastname
 */
function get_contact_full_name($userid = '')
{
    $_userid = get_contact_user_id();
    if ($userid !== '') {
        $_userid = $userid;
    }
    $CI =& get_instance();
    $CI->db->where('id', $_userid);
    $client = $CI->db->select('firstname,lastname')->from('tblcontacts')->get()->row();
    if(!empty($client->firstname) && !empty($client->lastname)){
        return $client->firstname . ' ' . $client->lastname;
    } else {
        return '';
    }

}
function get_company_name($userid){
    $_userid = get_client_user_id();
    if ($userid !== '') {
        $_userid = $userid;
    }
    $CI =& get_instance();
    $CI->db->where('userid', $_userid);
    $client = $CI->db->select('company')->from('tblclients')->get()->row();
    if($client){
        return $client->company;
    } else {
        return '';
    }
}
/**
 * Get client default language
 * @param  mixed $clientid
 * @return mixed
 */
function get_client_default_language($clientid = '')
{
    if (!is_numeric($clientid)) {
        $clientid = get_client_user_id();
    }
    $CI =& get_instance();
    $CI->db->select('default_language');
    $CI->db->from('tblclients');
    $CI->db->where('userid', $clientid);
    $client = $CI->db->get()->row();
    if ($client) {
        return $client->default_language;
    }
    return '';
}
/**
 * Get staff default language
 * @param  mixed $staffid
 * @return mixed
 */
function get_staff_default_language($staffid = '')
{
    if (!is_numeric($staffid)) {
        $staffid = get_staff_user_id();
    }
    $CI =& get_instance();
    $CI->db->select('default_language');
    $CI->db->from('tblstaff');
    $CI->db->where('staffid', $staffid);
    $staff = $CI->db->get()->row();
    if ($staff) {
        return $staff->default_language;
    }
    return '';
}
/**
 * Log Activity for everything
 * @param  string $description Activity Description
 * @param  integer $staffid    Who done this activity
 */
function logActivity($description, $staffid = NULL)
{
    $CI =& get_instance();
    $log = array(
        'description' => $description,
        'date' => date('Y-m-d H:i:s')
        );
    if (!DEFINED('CRON')) {
        if ($staffid != NULL && is_numeric($staffid)) {
            $log['staffid'] = $staffid;
        } else {
            if (is_staff_logged_in()) {
                $log['staffid'] = get_staff_user_id();
            } else {
                $log['staffid'] = NULL;
            }
        }
    } else {
        // manually invoked cron
        if(is_staff_logged_in()){
            $log['staffid'] = get_staff_user_id();
        } else {
            $log['staffid'] = _l('activity_log_when_cron_job');
        }
    }

    $CI->db->insert('tblactivitylog', $log);
}
/**
 * Note well tested function do not use it, is optimized only when doing updates in the menu items
 */
function add_main_menu_item($options = array(), $parent = '')
{
    $default_options = array(
        'name',
        'permission',
        'icon',
        'url',
        'id',
        );
    $order = '';
    if(isset($options['order'])){
        $order = $options['order'];
        unset($options['order']);
    }
    $data            = array();
    for ($i = 0; $i < count($default_options); $i++) {
        if (isset($options[$default_options[$i]])) {
            $data[$default_options[$i]] = $options[$default_options[$i]];
        } else {
            $data[$default_options[$i]] = '';
        }
    }
    $menu = get_option('aside_menu_active');
    $menu = json_decode($menu);
    // check if the id exists
    if ($data['id'] == '') {
        $data['id'] = slug_it($data['name']);
    }
    $total_exists = 0;
    foreach ($menu->aside_menu_active as $item) {
        if ($item->id == $data['id']) {
            $total_exists++;
        }
    }
    if ($total_exists > 0) {
       return false;
    }
    $_data = new stdClass();
    foreach($data as $key => $val){
       $_data->{$key} = $val;
    }

    $data = $_data;
    if ($parent == '') {
         if($order == ''){
           array_push($menu->aside_menu_active, $data);
        } else {
            if($order == 1){
                array_unshift($menu->aside_menu_active,array());
            } else {
                $order = $order - 1;
                array_splice($menu->aside_menu_active, $order,0 , array('') );
            }
           $menu->aside_menu_active[$order] = $_data;
        }
    } else {
        $i = 0;
        foreach ($menu->aside_menu_active as $item) {
            if ($item->id == $parent) {
                if (!isset($item->children)) {
                    $menu->aside_menu_active[$i]->children   = array();
                    $menu->aside_menu_active[$i]->children[] = $data;
                    break;
                } else {
                    if($order == ''){
                         $menu->aside_menu_active[$i]->children[] = $data;
                     } else {
                        if($order == 1){
                            array_unshift($menu->aside_menu_active[$i]->children,array());
                        } else {
                            $order = $order - 1;
                            array_splice($menu->aside_menu_active[$i]->children, $order,0 , array('') );
                        }
                        $menu->aside_menu_active[$i]->children[$order] = $data;
                    }
                    break;
                }
            }
            $i++;
        }
    }
    if (update_option('aside_menu_active', json_encode($menu))) {
        return true;
    }
    return false;
}
/**
 * Note well tested function do not use it, is optimized only when doing updates in the menu items
 */
function add_setup_menu_item($options = array(), $parent = '')
{
    $default_options = array(
        'name',
        'permission',
        'icon',
        'url',
        'id',
        );
    $order = '';
    if(isset($options['order'])){
        $order = $options['order'];
        unset($options['order']);
    }
    $data            = array();
    for ($i = 0; $i < count($default_options); $i++) {
        if (isset($options[$default_options[$i]])) {
            $data[$default_options[$i]] = $options[$default_options[$i]];
        } else {
            $data[$default_options[$i]] = '';
        }
    }
    if ($data['id'] == '') {
        $data['id'] = slug_it($data['name']);
    }

    $menu = get_option('setup_menu_active');
    $menu = json_decode($menu);
    // check if the id exists
    if ($data['id'] == '') {
        $data['id'] = slug_it($data['name']);
    }
    $total_exists = 0;
    foreach ($menu->setup_menu_active as $item) {
        if ($item->id == $data['id']) {
            $total_exists++;
        }
    }
   if ($total_exists > 0) {
      return false;
   }
   $_data = new stdClass();
   foreach($data as $key => $val){
     $_data->{$key} = $val;
   }
    $data = $_data;
    if ($parent == '') {
         if($order == 1){
                array_unshift($menu->setup_menu_active,array());
            } else {
                $order = $order - 1;
                array_splice($menu->setup_menu_active,$order ,0 , array('') );
            }
            $menu->setup_menu_active[$order] = $_data;
    } else {
        $i = 0;
        foreach ($menu->setup_menu_active as $item) {
            if ($item->id == $parent) {
                if (!isset($item->children)) {
                    $menu->setup_menu_active[$i]->children   = array();
                    $menu->setup_menu_active[$i]->children[] = $data;
                    break;
                } else {
                    $menu->setup_menu_active[$i]->children[] = $data;
                    break;
                }
            }
            $i++;
        }
    }
   if (update_option('setup_menu_active', json_encode($menu))) {
        return true;
    }
    return false;
}
/**
 * Add user notifications
 * @param array $values array of values [description,fromuserid,touserid,fromcompany,isread]
 */
function add_notification($values)
{
    $CI =& get_instance();
    foreach ($values as $key => $value) {
        $data[$key] = $value;
    }
    if(is_client_logged_in()){
        $data['fromuserid'] = 0;
        $data['fromclientid'] = get_contact_user_id();
    } else {
        $data['fromuserid'] = get_staff_user_id();
        $data['fromclientid'] = 0;
    }

    if (isset($data['fromcompany'])) {
        unset($data['fromuserid']);
    }
    $data['date'] = date('Y-m-d H:i:s');
    $CI->db->insert('tblnotifications', $data);
}
/**
 * Count total rows on table based on params
 * @param  string $table Table from where to count
 * @param  array  $where
 * @return mixed  Total rows
 */
function total_rows($table, $where = array())
{
    $CI =& get_instance();
    if (is_array($where)) {
        if (sizeof($where) > 0) {
            $CI->db->where($where);
            //$CI->db->join('tblcontactprojects','tblprojects.id = tblcontactprojects.project_id');
            //$CI->db->where('contact_id', 3);

        }
    } else if (strlen($where) > 0) {
        $CI->db->where($where);

    }



    return $CI->db->count_all_results($table);
}
/**
 * Sum total from table
 * @param  string $table table name
 * @param  array  $attr  attributes
 * @return mixed
 */
function sum_from_table($table, $attr = array())
{
    if (!isset($attr['field'])) {
        show_error('sum_from_table(); function expect field to be passed.');
    }

     $CI =& get_instance();
    if (isset($attr['where']) && is_array($attr['where'])) {
        $i = 0;
        foreach($attr['where'] as $key => $val){
            if(is_numeric($key)){
                $CI->db->where($val);
                unset($attr['where'][$key]);
            }
            $i++;
        }
       $CI->db->where($attr['where']);
    }
    $CI->db->select_sum($attr['field']);
    $CI->db->from($table);
    $result = $CI->db->get()->row();
    return $result->{$attr['field']};
}
/**
 * General function for all datatables, performs search,additional select,join,where,orders
 * @param  array $aColumns           table columns
 * @param  mixed $sIndexColumn       main column in table for bettter performing
 * @param  string $sTable            table name
 * @param  array  $join              join other tables
 * @param  array  $where             perform where in query
 * @param  array  $additionalSelect  select additional fields
 * @param  string $orderby
 * @return array
 */
function data_tables_init($aColumns, $sIndexColumn, $sTable, $join = array(), $where = array(), $additionalSelect = array(), $orderby = '', $groupBy = '')
{
    $CI =& get_instance();
    $__post = $CI->input->post();

    /*
     * Paging
     */
    $sLimit = "";
    if ((is_numeric($CI->input->post('start'))) && $CI->input->post('length') != '-1') {
        $sLimit = "LIMIT " . intval($CI->input->post('start')) . ", " . intval($CI->input->post('length'));
    }
    $_aColumns = array();
    foreach ($aColumns as $column) {
        // if found only one dot
        if (substr_count($column, '.') == 1 && strpos($column, ' as ') === false) {
            $_column = explode('.', $column);
            if (isset($_column[1])) {
                if (_startsWith($_column[0], 'tbl')) {
                    $_prefix = prefixed_table_fields_wildcard($_column[0], $_column[0], $_column[1]);
                    array_push($_aColumns, $_prefix);
                } else {
                    array_push($_aColumns, $column);
                }
            } else {
                array_push($_aColumns, $_column[0]);
            }
        } else {
            array_push($_aColumns, $column);
        }
    }
    /*
     * Ordering
     */
    $sOrder = "";
    if ($CI->input->post('order')) {
        $sOrder = "ORDER BY  ";
        foreach($CI->input->post('order') as $key=>$val){

        $sOrder .= $aColumns[intval($__post['order'][$key]['column'])];

        $__order_column = $sOrder;
        if (strpos($__order_column, ' as ') !== false) {
            $sOrder = strbefore($__order_column, ' as');
        }
        $_order = strtoupper($__post['order'][$key]['dir']);
        if ($_order == 'ASC') {
            $sOrder .= ' ASC';
        } else {
            $sOrder .= ' DESC';
        }
        $sOrder .= ', ';
        }
        if (trim($sOrder) == "ORDER BY") {
            $sOrder = "";
        }
        if ($sOrder == '' && $orderby != '') {
            $sOrder = $orderby;
        } else {
             $sOrder = substr($sOrder,0,-2);
        }

    } else {
        $sOrder = $orderby;
    }
    /*
     * Filtering
     * NOTE this does not match the built-in DataTables filtering which does it
     * word by word on any field. It's possible to do here, but concerned about efficiency
     * on very large tables, and MySQL's regex functionality is very limited
     */
    $sWhere = "";
    if ((isset($__post['search'])) && $__post['search']['value'] != "") {
        $search_value = $__post['search']['value'];

        $sWhere = "WHERE (";
        for ($i = 0; $i < count($aColumns); $i++) {
            $__search_column = $aColumns[$i];
            if (strpos($__search_column, ' as ') !== false) {
                $__search_column = strbefore($__search_column, ' as');
            }
            if (($__post['columns'][$i]) && $__post['columns'][$i]['searchable'] == "true") {
                $sWhere .= $__search_column . " LIKE '%" . $search_value . "%' OR ";
            }
        }
        if (count($additionalSelect) > 0) {
            foreach ($additionalSelect as $searchAdditionalField) {
               if (strpos($searchAdditionalField, ' as ') !== false) {
                $searchAdditionalField = strbefore($searchAdditionalField, ' as');
            }

            $sWhere .= $searchAdditionalField . " LIKE '%" . $search_value . "%' OR ";
        }
    }
    $sWhere = substr_replace($sWhere, "", -3);
    $sWhere .= ')';
} else {
        // Check for custom filtering
    $searchFound = 0;
    $sWhere      = "WHERE (";
    for ($i = 0; $i < count($aColumns); $i++) {
        if (($__post['columns'][$i]) && $__post['columns'][$i]['searchable'] == "true") {
            $search_value = $__post['columns'][$i]['search']['value'];
            $__search_column = $aColumns[$i];
            if (strpos($__search_column, ' as ') !== false) {
                $__search_column = strbefore($__search_column, ' as');
            }
            if ($search_value != '') {
                $sWhere .= $__search_column . " LIKE '%" . $search_value . "%' OR ";
                if (count($additionalSelect) > 0) {
                    foreach ($additionalSelect as $searchAdditionalField) {
                        $sWhere .= $searchAdditionalField . " LIKE '%" . $search_value . "%' OR ";
                    }
                }
                $searchFound++;
            }
        }
    }
    if ($searchFound > 0) {
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';
    } else {
        $sWhere = '';
    }
}

    /*
     * SQL queries
     * Get data to display
     */
    $_additionalSelect = '';
    if (count($additionalSelect) > 0) {
        $_additionalSelect = ',' . implode(',', $additionalSelect);
    }
    $where = implode(' ', $where);
    if ($sWhere == '') {
        if (_startsWith($where, 'AND') || _startsWith($where, 'OR')) {
            if(_startsWith($where, 'OR')){
               $where = substr($where, 2);
            } else {
                $where = substr($where, 3);
            }
            $where = 'WHERE ' . $where;
        }
    }
    $sQuery         = "
    SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $_aColumns)) . " " . $_additionalSelect . "
    FROM   $sTable
    " . implode(' ', $join) . "
    $sWhere
    " . $where . "
    $sOrder
    $groupBy
    $sLimit
    ";
    $rResult        = $CI->db->query($sQuery)->result_array();

    /* Data set length after filtering */
    $sQuery         = "
    SELECT FOUND_ROWS()
    ";
    $_query         = $CI->db->query($sQuery)->result_array();
    $iFilteredTotal = $_query[0]['FOUND_ROWS()'];
    if (_startsWith($where, 'AND')) {
        $where = 'WHERE ' . substr($where, 3);
    }
    /* Total data set length */
    $sQuery = "
    SELECT COUNT(" . $sTable . '.' . $sIndexColumn . ")
    FROM $sTable " . implode(' ', $join) . ' ' . $where;
    $_query = $CI->db->query($sQuery)->result_array();
    $iTotal = $_query[0]['COUNT(' . $sTable . '.' . $sIndexColumn . ')'];
    /*
     * Output
     */
    $output = array(
        "draw" => $__post['draw'] ? intval($__post['draw']) : 0,
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "aaData" => array()
        );
    return array(
        'rResult' => $rResult,
        'output' => $output
        );
}
/**
 * Prefix field name with table ex. table.column
 * @param  string $table
 * @param  string $alias
 * @param  string $field field to check
 * @return string
 */
function prefixed_table_fields_wildcard($table, $alias, $field)
{
    $CI =& get_instance();
    $columns     = $CI->db->query("SHOW COLUMNS FROM $table")->result_array();
    $field_names = array();
    foreach ($columns as $column) {
        $field_names[] = $column["Field"];
    }
    $prefixed = array();
    foreach ($field_names as $field_name) {
        if ($field == $field_name) {
            $prefixed[] = "`{$alias}`.`{$field_name}` AS `{$alias}.{$field_name}`";
        }
    }
    return implode(", ", $prefixed);
}

function get_relation_data($type, $rel_id = '')
{
    $CI =& get_instance();
    $data = array();
    if ($type == 'customer' || $type == 'customers') {
        $CI->load->model('clients_model');
        $data = $CI->clients_model->get($rel_id, 1);
    } else if ($type == 'invoice') {
        $CI->load->model('invoices_model');
        $data = $CI->invoices_model->get($rel_id);
    } else if ($type == 'estimate') {
        $CI->load->model('estimates_model');
        $data = $CI->estimates_model->get($rel_id);
    } else if ($type == 'contract' || $type == 'contracts') {
        $CI->load->model('contracts_model');
        $data = $CI->contracts_model->get($rel_id);
    } else if ($type == 'ticket') {
        $CI->load->model('tickets_model');
        $data = $CI->tickets_model->get($rel_id);
    } else if ($type == 'expense' || $type == 'expenses') {
        $CI->load->model('expenses_model');
        $data = $CI->expenses_model->get($rel_id);
    } else if ($type == 'lead' || $type == 'leads') {
        $CI->load->model('leads_model');
        $data = $CI->leads_model->get($rel_id, array(
            'junk' => 0
        ));
    } else if ($type == 'proposal') {
        $CI->load->model('proposals_model');
        $data = $CI->proposals_model->get($rel_id);
    } else if ($type == 'tasks') {
        $CI->load->model('tasks_model');
        $data = $CI->tasks_model->get($rel_id);
    } else if ($type == 'staff') {
        $CI->load->model('staff_model');
        $data = $CI->staff_model->get($rel_id);
    } else if ($type == 'project') {
        $CI->load->model('projects_model');
        $data = $CI->projects_model->get($rel_id);
    }
    return $data;
}
function get_relation_values($relation, $type)
{
    if ($relation == '') {
        return;
    }
    $name = '';
    $id   = '';
    $link = '';
    if ($type == 'customer' || $type == 'customers') {
        if (is_array($relation)) {
            $id   = $relation['userid'];
            $name = $relation['company'];
        } else {
            $id   = $relation->userid;
            $name = $relation->company;
        }
        $link = admin_url('clients/client/' . $id);
    } else if ($type == 'invoice') {
        if (is_array($relation)) {
            $id   = $relation['id'];
            $name = format_invoice_number($id);
        } else {
            $id   = $relation->id;
            $name = format_invoice_number($id);
        }
        $link = admin_url('invoices/list_invoices/' . $id);
    } else if ($type == 'estimate') {
        if (is_array($relation)) {
            $id   = $relation['id'];
            $name = format_estimate_number($id);
        } else {
            $id   = $relation->id;
            $name = format_estimate_number($id);
        }
        $link = admin_url('estimates/list_estimates/' . $id);
    } else if ($type == 'contract' || $type == 'contracts') {
        if (is_array($relation)) {
            $id   = $relation['id'];
            $name = $relation['subject'];
        } else {
            $id   = $relation->id;
            $name = $relation->subject;
        }
        $link = admin_url('contracts/contract/' . $id);
    } else if ($type == 'ticket') {
        if (is_array($relation)) {
            $id   = $relation['ticketid'];
            $name = '#' . $relation['ticketid'];
        } else {
            $id   = $relation->ticketid;
            $name = '#' . $relation->ticketid;
        }
        $link = admin_url('tickets/ticket/' . $id);
    } else if ($type == 'expense' || $type == 'expenses') {
        if (is_array($relation)) {
            $id   = $relation['expenseid'];
            $name = $relation['category_name'] . ' - ' . _format_number($relation['amount']);
        } else {
            $id   = $relation->expenseid;
            $name = $relation->category_name . ' - ' . _format_number($relation->amount);
        }
        $link = admin_url('expenses/list_expenses/' . $id);
    } else if ($type == 'lead' || $type == 'leads') {
        if (is_array($relation)) {
            $id   = $relation['id'];
            $name = $relation['name'];
            if ($relation['email'] != '') {
                $name .= ' - ' . $relation['email'];
            }
        } else {
            $id   = $relation->id;
            $name = $relation->name;
            if ($relation->email != '') {
                $name .= ' - ' . $relation->email;
            }
        }
        $link = admin_url('leads/index/' . $id);
    } else if ($type == 'proposal') {
        if (is_array($relation)) {
            $id   = $relation['id'];
            $name = $relation['subject'];
        } else {
            $id   = $relation->id;
            $name = $relation->subject;
        }
        $link = admin_url('proposals/proposal/' . $id);
    } else if ($type == 'tasks') {
        if (is_array($relation)) {
            $id   = $relation['id'];
            $name = $relation['name'];
        } else {
            $id   = $relation->id;
            $name = $relation->name;
        }
        $link = admin_url('tasks/list_tasks/' . $id);
    } else if ($type == 'staff') {
        if (is_array($relation)) {
            $id   = $relation['staffid'];
            $name = $relation['firstname'] . ' ' . $relation['lastname'];
        } else {
            $id   = $relation->staffid;
            $name = $relation->firstname . ' ' . $relation->lastname;
        }
        $link = admin_url('profile/' . $id);
    } else if ($type == 'project') {
        if (is_array($relation)) {
            $id   = $relation['id'];
            $name = $relation['name'];
        } else {
            $id   = $relation->id;
            $name = $relation->name;
        }
        $link = admin_url('projects/view/' . $id);
    }
    return array(
        'name' => $name,
        'id' => $id,
        'link' => $link
    );
}
