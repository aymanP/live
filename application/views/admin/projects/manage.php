<?php init_head(); ?>
<div id="wrapper">
  <div class="content">
    <div class="row">
      <?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
      <div class="col-md-12">
        <div class="panel_s">
          <div class="panel-body _buttons">
            <?php if(has_permission('projects','','create')){ ?>
              <a href="<?php echo admin_url('projects/project'); ?>" class="btn btn-info pull-left display-block">
                <?php echo _l('new_project'); ?>
              </a>
              <?php } ?>
              <div class="btn-group pull-right mleft4 btn-with-tooltip-group _filter_data" data-toggle="tooltip" data-title="<?php echo _l('filter_by'); ?>">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-filter" aria-hidden="true"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-right width300">
                  <li>
                    <a href="#" data-cview="all" onclick="dt_custom_view('','.table-projects',''); return false;">
                      <?php echo _l('expenses_list_all'); ?>
                    </a>
                  </li>
                  <?php
                  // Only show this filter if user has permission for projects view otherwisde wont need this becuase by default this filter will be applied
                  if(has_permission('projects','','view')){ ?>
                  <li>
                    <a href="#" data-cview="my_projects" onclick="dt_custom_view('my_projects','.table-projects','my_projects'); return false;">
                      <?php echo _l('home_my_projects'); ?>
                    </a>
                  </li>
                  <?php } ?>
                  <li class="divider"></li>
                  <?php foreach($statuses as $status){ ?>
                    <li class="<?php if($status != 4){echo 'active';} ?>">
                      <a href="#" data-cview="<?php echo 'project_status_'.$status; ?>" onclick="dt_custom_view('project_status_<?php echo $status; ?>','.table-projects','project_status_<?php echo $status; ?>'); return false;">
                        <?php echo _l('project_status_'.$status); ?>
                      </a>
                    </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="panel_s">
              <div class="panel-body">
               <div class="row mbot15">
                <div class="col-md-12">
                  <h3 class="text-success no-margin"><?php echo _l('projects_summary'); ?></h3>
                  <?php
                  $_where = '';
                  if(!has_permission('projects','','view')){
                    $_where = 'id IN (SELECT project_id FROM tblprojectmembers WHERE staff_id='.get_staff_user_id().')';
                  }
                  ?>
                </div>
                <div class="_filters _hidden_inputs">
                  <?php
                  echo form_hidden('my_projects');
                  foreach($statuses as $status){
                   $value = $status;
                   // Dont show finished projects
                   if($status == 4){$value = '';} ?>
                   <?php echo form_hidden('project_status_'.$status,$value); ?>
                   <div class="col-md-2 col-xs-6 border-right">
                    <?php $where = ($_where == '' ? '' : $_where.' AND ').'clientid != 0 AND status = '.$status; ?>
                    <a href="#" onclick="dt_custom_view('project_status_<?php echo $status; ?>','.table-projects','project_status_<?php echo $status; ?>',true); return false;">
                     <h3 class="bold"><?php echo total_rows('tblprojects',$where); ?></h3>
                     <span class="text-<?php echo get_project_label($status); ?> bold"><?php echo _l('project_status_'.$status); ?></span>
                   </a>
                 </div>
                 <?php } ?>
               </div>
             </div>
             <div class="clearfix"></div>
             <?php echo form_hidden('custom_view'); ?>
             <?php
             $table_data = array(
              _l('project_name'),
              _l('project_customer'),
//              _l('project_supplier'),
              _l('project_start_date'),
              _l('project_deadline'),
              _l('project_status'),
              _l('project_billing_type'),
              _l('project_datecreated'),
              );
             $custom_fields = get_custom_fields('projects',array('show_on_table'=>1));
             foreach($custom_fields as $field){
              array_push($table_data,$field['name']);

            }
            array_push($table_data, _l('options'));

            render_datatable($table_data,'projects'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php init_tail(); ?>
<script>
 var ProjectsServerParams = {};
 $.each($('._hidden_inputs._filters input'),function(){
  ProjectsServerParams[$(this).attr('name')] = '[name="'+$(this).attr('name')+'"]';
});
 var projects_not_sortable = $('.table-projects').find('th').length - 1;
 initDataTable('.table-projects', window.location.href, [projects_not_sortable], [projects_not_sortable], ProjectsServerParams, [3, 'ASC']);
</script>
</body>
</html>
