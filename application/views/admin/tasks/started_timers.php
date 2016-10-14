<?php

if(count($_started_timers)==0){
    echo '<li class="text-center">'._l('no_timers_found').'</li>';
}
foreach($_started_timers as $timer){
    $task = $this->tasks_model->get($timer['task_id']);

    $data = '';
    if($task){
        $data .= '<li class="timer"><a href="#" class="_timer" onclick="init_task_modal('.$timer['task_id'].');return false;">'.$task->name.'</a>';
        $data .= _l('timer_top_started', strftime(get_current_date_format().' %H:%M', $timer['start_time'])) . ' - <span class="text-success"><br />'._l('task_total_logged_time') .' '. format_seconds($this->tasks_model->calc_task_total_time($task->id,' AND staff_id='.get_staff_user_id())).'</span>';
        $data .= '<p class="mtop10"><a href="#" class="label label-danger" onclick="timer_action(this,'.$task->id.','.$timer['id'].'); return false;"><i class="fa fa-clock-o"></i> '._l('task_stop_timer').'</a></p>';
        $data .= '</li>';
        $data .= '<hr />';
    }
    echo $data;
}
