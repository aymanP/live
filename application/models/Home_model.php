<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home_model extends CRM_Model
{
    private $is_admin;
    function __construct()
    {
        parent::__construct();
        $this->is_admin = is_admin();
    }
    /**
     * @return array
     * Used in home dashboard page
     * Return all upcoming events this week
     */
    public function get_upcoming_events()
    {

        $this->db->where('(start BETWEEN "' . date('Y-m-d', strtotime('monday this week')) . '" AND "' . date('Y-m-d', strtotime('sunday this week')) . '")');
        $this->db->where('userid', get_staff_user_id());
        $this->db->or_where('public', 1);
        $this->db->order_by('start','desc');
        $this->db->limit(6);
        return $this->db->get('tblevents')->result_array();
    }
    /**
     * @param  integer (optional) Limit upcoming events
     * @return integer
     * Used in home dashboard page
     * Return total upcoming events next week
     */
    public function get_upcoming_events_next_week($limit = 4)
    {
        $monday_this_week = date('Y-m-d', strtotime('monday next week'));
        $sunday_this_week = date('Y-m-d', strtotime('sunday next week'));
        $this->db->where('(start BETWEEN "' . $monday_this_week . '" AND "' . $sunday_this_week . '")');
        $this->db->where('userid', get_staff_user_id());
        $this->db->or_where('public', 1);
        $this->db->limit($limit);
        return $this->db->count_all_results('tblevents');
    }
    /**
     * @param  mixed
     * @return array
     * Used in home dashboard page, currency passed from javascript (undefined or integer)
     * Displays weekly payment statistics (chart)
     */
    public function get_weekly_payments_statistics($currency)
    {
        $this->db->select('amount,tblinvoicepaymentrecords.date');
        $this->db->from('tblinvoicepaymentrecords');
        $this->db->join('tblinvoices', 'tblinvoices.id = tblinvoicepaymentrecords.invoiceid');
        $this->db->where('CAST(tblinvoicepaymentrecords.date as DATE) >= "' . date('Y-m-d', strtotime('monday this week', strtotime('last sunday'))) . '" AND CAST(tblinvoicepaymentrecords.date as DATE) <= "' . date('Y-m-d', strtotime('sunday this week', strtotime('last sunday'))) . '"');
        $this->db->where('tblinvoices.status !=',5);
        if ($currency != 'undefined') {
            $this->db->where('currency', $currency);
        }
        $payments = $this->db->get()->result_array();
        $chart    = array(
            'labels' => get_weekdays(),
            'datasets' => array(
                array(
                    'label' => _l('home_weekly_payment_records'),
                    'backgroundColor' => 'rgba(37,155,35,0.2)',
                    'borderColor' => "#84c529",
                    'borderWidth'=>1,
                    'tension'=>false,
                    'data' => array(
                        0,
                        0,
                        0,
                        0,
                        0,
                        0,
                        0
                    )
                )
            )
        );
        foreach ($payments as $payment) {
            $payment_day = date('l', strtotime($payment['date']));
            $i           = 0;
            foreach (get_weekdays_original() as $day) {
                if ($payment_day == $day) {
                    $chart['datasets'][0]['data'][$i] += $payment['amount'];
                }
                $i++;
            }
        }
        return $chart;
    }

    public function projects_status_stats(){
        $statuses = array(1,2,3,4);
        $colors      = get_system_favourite_colors();

        $chart = array(
            'labels'=>array(),
            'datasets'=>array()
            );

        $_data = array();
        $_data['data'] = array();
        $_data['backgroundColor'] = array();
        $_data['hoverBackgroundColor'] = array();

        $i = 0;
        $has_permission = has_permission('projects','','view');
        foreach ($statuses as $status) {
            $this->db->where('status', $status);
            if(!$has_permission){
                $this->db->where('id IN (SELECT project_id FROM tblprojectmembers WHERE staff_id='.get_staff_user_id().')');
            }

            array_push($chart['labels'],_l('project_status_'.$status));
            array_push($_data['backgroundColor'],$colors[$i]);
            array_push($_data['hoverBackgroundColor'],adjust_color_brightness($colors[$i],-20));
            array_push($_data['data'],$this->db->count_all_results('tblprojects'));

            $i++;
        }
        $chart['datasets'][] = $_data;
        $chart['datasets'][0]['label'] = _l('home_stats_by_project_status');
        return $chart;
    }
    public function leads_status_stats(){
        $this->load->model('leads_model');
        $statuses = $this->leads_model->get_status();
        $colors      = get_system_favourite_colors();
        $chart = array(
            'labels'=>array(),
            'datasets'=>array()
            );

        $_data = array();
        $_data['data'] = array();
        $_data['backgroundColor'] = array();
        $_data['hoverBackgroundColor'] = array();

        foreach ($statuses as $status) {
            $this->db->where('status',$status['id']);
            if(!$this->is_admin){
                $this->db->where('(addedfrom = '.get_staff_user_id().' OR is_public = 1 OR assigned = '.get_staff_user_id().')');
            }
            array_push($chart['labels'],$status['name']);
            array_push($_data['backgroundColor'],$status['color']);
            array_push($_data['hoverBackgroundColor'],adjust_color_brightness($status['color'],-20));
            array_push($_data['data'],$this->db->count_all_results('tblleads'));
        }

        $chart['datasets'][] = $_data;
        return $chart;

    }
    /**
     * Display total tickets awaiting reply by department (chart)
     * @return array
     */
    public function tickets_awaiting_reply_by_department()
    {
        $this->load->model('departments_model');
        $departments = $this->departments_model->get();
        $colors      = get_system_favourite_colors();
        $chart = array(
            'labels'=>array(),
            'datasets'=>array()
            );

        $_data = array();
        $_data['data'] = array();
        $_data['backgroundColor'] = array();
        $_data['hoverBackgroundColor'] = array();

        $i           = 0;
        foreach ($departments as $department) {
            if (!$this->is_admin) {
                if (get_option('staff_access_only_assigned_departments') == 1) {
                    $staff_deparments_ids = $this->departments_model->get_staff_departments(get_staff_user_id(), true);
                    $departments_ids = array();
                    if (count($staff_deparments_ids) == 0) {
                        $departments = $this->departments_model->get();
                        foreach($departments as $department){
                            array_push($departments_ids,$department['departmentid']);
                        }
                    } else {
                     $departments_ids = $staff_deparments_ids;
                     }
                     if(count($departments_ids) > 0){
                        $this->db->where('department IN (SELECT departmentid FROM tblstaffdepartments WHERE departmentid IN (' . implode(',', $departments_ids) . ') AND staffid="'.get_staff_user_id().'")');
                    }
                }
            }
            $this->db->where_in('status', array(
                1,
                2,
                4
            ));

            $this->db->where('department', $department['departmentid']);
            $total = $this->db->count_all_results('tbltickets');

            if ($total > 0) {
                $color = '#333';
                if (isset($colors[$i])) {
                    $color = $colors[$i];
                }
                array_push($chart['labels'],$department['name']);
                array_push($_data['backgroundColor'],$color);
                array_push($_data['hoverBackgroundColor'],adjust_color_brightness($color,-20));
                array_push($_data['data'],$total);
            }
            $i++;
        }

        $chart['datasets'][] = $_data;
        return $chart;
    }
    /**
     * Display total tickets awaiting reply by status (chart)
     * @return array
     */
    public function tickets_awaiting_reply_by_status()
    {
        $this->load->model('tickets_model');
        $statuses             = $this->tickets_model->get_ticket_status();
        $_statuses_with_reply = array(
            1,
            2,
            4
        );

        $chart = array(
            'labels'=>array(),
            'datasets'=>array()
            );

        $_data = array();
        $_data['data'] = array();
        $_data['backgroundColor'] = array();
        $_data['hoverBackgroundColor'] = array();

        foreach ($statuses as $status) {
            if (in_array($status['ticketstatusid'], $_statuses_with_reply)) {

                if (!$this->is_admin) {
                    if (get_option('staff_access_only_assigned_departments') == 1) {
                        $staff_deparments_ids = $this->departments_model->get_staff_departments(get_staff_user_id(), true);
                        $departments_ids = array();
                        if (count($staff_deparments_ids) == 0) {
                            $departments = $this->departments_model->get();
                            foreach($departments as $department){
                                array_push($departments_ids,$department['departmentid']);
                            }
                        } else {
                           $departments_ids = $staff_deparments_ids;
                       }
                       if(count($departments_ids) > 0){
                        $this->db->where('department IN (SELECT departmentid FROM tblstaffdepartments WHERE departmentid IN (' . implode(',', $departments_ids) . ') AND staffid="'.get_staff_user_id().'")');
                    }
                }
            }

                $this->db->where('status', $status['ticketstatusid']);
                $total = $this->db->count_all_results('tbltickets');
                if ($total > 0) {
                    array_push($chart['labels'],ticket_status_translate($status['ticketstatusid']));
                    array_push($_data['backgroundColor'],$status['statuscolor']);
                    array_push($_data['hoverBackgroundColor'],adjust_color_brightness($status['statuscolor'],-20));
                    array_push($_data['data'],$total);
                }
            }
        }

        $chart['datasets'][] = $_data;
        return $chart;
    }
}
