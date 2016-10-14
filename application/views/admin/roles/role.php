<?php init_head(); ?>
<div id="wrapper">
<div class="content">
    <div class="row">
        <?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
        <div class="col-md-6">
            <div class="panel_s">
                <div class="panel-heading">
                    <?php echo $title; ?>
                </div>
                <div class="panel-body">
                    <?php if(isset($role)){ ?>
                    <?php if(total_rows('tblstaff',array('role'=>$role->roleid)) > 0){ ?>
                    <div class="alert alert-warning bold">
                        <?php echo _l('change_role_permission_warning'); ?>
                    </div>
                    <?php } ?>
                    <a href="<?php echo admin_url('roles/role'); ?>" class="btn btn-success pull-right mbot20 display-block"><?php echo _l('new_role'); ?></a>
                    <div class="clearfix"></div>
                    <?php } ?>
                    <?php echo form_open($this->uri->uri_string()); ?>
                    <?php $attrs = (isset($role) ? array() : array('autofocus'=>true)); ?>
                    <?php $value = (isset($role) ? $role->name : ''); ?>
                    <?php echo render_input('name','role_add_edit_name',$value,'text',$attrs); ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="bold"><?php echo _l('permission'); ?></th>
                                    <th class="text-center bold"><?php echo _l('permission_view'); ?></th>
                                    <th class="text-center bold"><?php echo _l('permission_edit'); ?></th>
                                    <th class="text-center bold"><?php echo _l('permission_create'); ?></th>
                                    <th class="text-center text-danger bold"><?php echo _l('permission_delete'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $conditions = get_permission_conditions();
                                    foreach($permissions as $permission){
                                    $permission_condition = $conditions[$permission['shortname']];
                                    ?>
                                <tr>
                                    <td class="bold"><?php echo $permission['name']; ?></td>
                                    <td class="text-center">
                                        <?php if($permission_condition['view'] == true){
                                            $statement = '';
                                            if(isset($role)){
                                                if(total_rows('tblrolepermissions',array('roleid'=>$role->roleid,'permissionid'=>$permission['permissionid'],'can_view'=>1)) > 0){
                                                    $statement = 'checked';
                                                }
                                            }
                                            ?>
                                        <div class="checkbox">
                                            <input type="checkbox" <?php echo $statement; ?> name="view[]" value="<?php echo $permission['permissionid']; ?>">
                                            <label></label>
                                        </div>
                                        <?php } ?>
                                    </td>
                                    <td  class="text-center">
                                        <?php if($permission_condition['edit'] == true){
                                            $statement = '';
                                             if(isset($role)){
                                                if(total_rows('tblrolepermissions',array('roleid'=>$role->roleid,'permissionid'=>$permission['permissionid'],'can_edit'=>1)) > 0){
                                                    $statement = 'checked';
                                                }
                                            }
                                            ?>
                                        <div class="checkbox">
                                            <input type="checkbox" <?php echo $statement; ?> name="edit[]" value="<?php echo $permission['permissionid']; ?>">
                                            <label></label>
                                        </div>
                                        <?php } ?>
                                    </td>
                                    <td  class="text-center">
                                        <?php if($permission_condition['create'] == true){
                                            $statement = '';
                                            if(isset($role)){
                                            if(total_rows('tblrolepermissions',array('roleid'=>$role->roleid,'permissionid'=>$permission['permissionid'],'can_create'=>1)) > 0){
                                                $statement = 'checked';
                                            }
                                            }
                                            ?>
                                        <div class="checkbox">
                                            <input type="checkbox" <?php echo $statement; ?> name="create[]" value="<?php echo $permission['permissionid']; ?>">
                                            <label></label>
                                        </div>
                                        <?php } ?>
                                    </td>
                                    <td  class="text-center">
                                        <?php if($permission_condition['delete'] == true){
                                            $statement = '';
                                            if(isset($role)){
                                            if(total_rows('tblrolepermissions',array('roleid'=>$role->roleid,'permissionid'=>$permission['permissionid'],'can_delete'=>1)) > 0){
                                                $statement = 'checked';
                                            }
                                            }
                                            ?>
                                        <div class="checkbox checkbox-danger">
                                            <input type="checkbox" <?php echo $statement; ?> name="delete[]" value="<?php echo $permission['permissionid']; ?>">
                                            <label></label>
                                        </div>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-info pull-right"><?php echo _l('submit'); ?></button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
    _validate_form($('form'),{name:'required'});
</script>
</body>
</html>
