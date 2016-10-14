<?php init_head(); ?>
<div id="wrapper">
  <div class="content">
    <div class="row">
      <?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
      <?php if(isset($member)){ ?>
       <div class="col-md-12">
        <div class="panel_s no-margin">
          <div class="panel-body no-padding-bottom">
            <?php $this->load->view('admin/staff/stats'); ?>
          </div>
        </div>
      </div>
      <div class="member">
        <?php echo form_hidden('isedit'); ?>
        <?php echo form_hidden('memberid',$member->staffid); ?>
      </div>
      <?php } ?>
      <?php echo form_open($this->uri->uri_string(),array('class'=>'staff-form')); ?>
      <div class="col-md-6">
        <div class="panel_s">
          <div class="panel-heading">
            <?php echo $title; ?>
          </div>
          <div class="panel-body">
            <div class="checkbox checkbox-primary">
              <?php
              $checked = '';
              if(isset($member)) {
               if($member->is_not_staff == 1){
                $checked = ' checked';
              }
            }
            ?>
            <input type="checkbox" value="1" name="is_not_staff" id="is_not_staff" <?php echo $checked; ?>>
            <label for="is_not_staff" data-toggle="tooltip"><?php echo _l('is_not_staff_member'); ?></label>
          </div>
          <?php $value = (isset($member) ? $member->firstname : ''); ?>
          <?php $attrs = (isset($member) ? array() : array('autofocus'=>true)); ?>
          <?php echo render_input('firstname','staff_add_edit_firstname',$value,'text',$attrs); ?>
          <?php $value = (isset($member) ? $member->lastname : ''); ?>
          <?php echo render_input('lastname','staff_add_edit_lastname',$value); ?>
          <?php $value = (isset($member) ? $member->email : ''); ?>
          <?php echo render_input('email','staff_add_edit_email',$value,'email'); ?>


          <hr />
          <?php $value = (isset($member) ? $member->firstname_alami : ''); ?>
          <?php echo render_input('firstname_alami','staff_add_edit_alami_firstname',$value,'text',$attrs); ?>
          <?php $value = (isset($member) ? $member->lastname_alami : ''); ?>
          <?php echo render_input('lastname_alami','staff_add_edit_alami_lastname',$value); ?>
          <?php $value = (isset($member) ? $member->email_alami : ''); ?>
          <?php echo render_input('email_alami','staff_add_edit_alami_email',$value,'email'); ?>
          <hr />

          <?php $value = (isset($member) ? $member->phonenumber : ''); ?>
          <?php echo render_input('phonenumber','staff_add_edit_phonenumber',$value); ?>
          <div class="form-group">
            <label for="facebook" class="control-label"><i class="fa fa-facebook"></i> <?php echo _l('staff_add_edit_facebook'); ?></label>
            <input type="text" class="form-control" name="facebook" value="<?php if(isset($member)){echo $member->facebook;} ?>">
          </div>
          <div class="form-group">
            <label for="linkedin" class="control-label"><i class="fa fa-linkedin"></i> <?php echo _l('staff_add_edit_linkedin'); ?></label>
            <input type="text" class="form-control" name="linkedin" value="<?php if(isset($member)){echo $member->linkedin;} ?>">
          </div>
          <div class="form-group">
            <label for="skype" class="control-label"><i class="fa fa-skype"></i> <?php echo _l('staff_add_edit_skype'); ?></label>
            <input type="text" class="form-control" name="skype" value="<?php if(isset($member)){echo $member->skype;} ?>">
          </div>
          <div class="form-group">
            <label for="default_language" class="control-label"><?php echo _l('localization_default_language'); ?></label>
            <select name="default_language" id="default_language" class="form-control selectpicker" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
              <option value=""><?php echo _l('system_default_string'); ?></option>
              <?php foreach(list_folders(APPPATH .'language') as $language){
                $selected = '';
                if(isset($member)){
                 if($member->default_language == $language){
                  $selected = 'selected';
                }
              }
              ?>
              <option value="<?php echo $language; ?>" <?php echo $selected; ?>><?php echo ucfirst($language); ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="departments"><?php echo _l('staff_add_edit_departments'); ?></label>
            <?php foreach($departments as $department){ ?>
              <div class="checkbox checkbox-primary">
                <?php
                $checked = '';
                if(isset($member)){
                 foreach ($staff_departments as $staff_department) {
                  if($staff_department['departmentid'] == $department['departmentid']){
                   $checked = ' checked';
                 }
               }
             }
             ?>
             <input type="checkbox" id="dep_<?php echo $department['departmentid']; ?>" name="departments[]" value="<?php echo $department['departmentid']; ?>"<?php echo $checked; ?>>
             <label for="dep_<?php echo $department['departmentid']; ?>"><?php echo $department['name']; ?></label>
           </div>
           <?php } ?>
         </div>
         <?php $rel_id = (isset($member) ? $member->staffid : false); ?>
         <?php echo render_custom_fields('staff',$rel_id); ?>
         <?php
         $selected = '';
         foreach($roles as $role){
          if(isset($member)){
           if($member->role == $role['roleid']){
            $selected = $role['roleid'];
          }
        } else {
         $default_staff_role = get_option('default_staff_role');
         if($default_staff_role == $role['roleid'] ){
          $selected = $role['roleid'];
        }
      }
    }
    ?>
    <?php echo render_select('role',$roles,array('roleid','name'),'staff_add_edit_role',$selected); ?>
    <hr />
    <div class="table-responsive">
      <table class="table table-bordered roles no-margin">
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
          if(isset($member)){
           $is_admin = is_admin($member->staffid);
         }
         $conditions = get_permission_conditions();
         foreach($permissions as $permission){
          $permission_condition = $conditions[$permission['shortname']];
          ?>
          <tr data-id="<?php echo $permission['permissionid']; ?>">
            <td class="bold">
              <?php
              if(isset($permission_condition['help'])){
                echo '<i class="fa fa-question-circle" data-toggle="tooltip" data-title="'.$permission_condition['help'].'"></i>';
              }
              ?>
              <?php echo $permission['name']; ?></td>
              <td class="text-center">
                <?php if($permission_condition['view'] == true){
                  $statement = '';
                  if(isset($is_admin) && $is_admin){
                   $statement = 'disabled';
                 } else if(isset($member) && has_permission($permission['shortname'],$member->staffid,'view')){
                  $statement = 'checked';
                }
                ?>
                <div class="checkbox">
                  <input type="checkbox" data-can-view <?php echo $statement; ?> name="view[]" value="<?php echo $permission['permissionid']; ?>">
                  <label></label>
                </div>
                <?php } ?>
              </td>
              <td  class="text-center">
                <?php if($permission_condition['edit'] == true){
                  $statement = '';
                  if(isset($is_admin) && $is_admin){
                   $statement = 'disabled';
                 } else if(isset($member) && has_permission($permission['shortname'],$member->staffid,'edit')){
                  $statement = 'checked';
                }
                ?>
                <div class="checkbox">
                  <input type="checkbox" data-can-edit <?php echo $statement; ?> name="edit[]" value="<?php echo $permission['permissionid']; ?>">
                  <label></label>
                </div>
                <?php } ?>
              </td>
              <td  class="text-center">
                <?php if($permission_condition['create'] == true){
                  $statement = '';
                  if(isset($is_admin) && $is_admin){
                   $statement = 'disabled';
                 } else if(isset($member) && has_permission($permission['shortname'],$member->staffid,'create')){
                   $statement = 'checked';
                 }
                 ?>
                 <div class="checkbox">
                  <input type="checkbox" data-can-create <?php echo $statement; ?> name="create[]" value="<?php echo $permission['permissionid']; ?>">
                  <label></label>
                </div>
                <?php } ?>
              </td>
              <td  class="text-center">
                <?php if($permission_condition['delete'] == true){
                  $statement = '';
                  if(isset($is_admin) && $is_admin){
                    $statement = 'disabled';
                  } else if(isset($member) && has_permission($permission['shortname'],$member->staffid,'delete')){
                   $statement = 'checked';
                 }
                 ?>
                 <div class="checkbox checkbox-danger">
                  <input type="checkbox" data-can-delete <?php echo $statement; ?> name="delete[]" value="<?php echo $permission['permissionid']; ?>">
                  <label></label>
                </div>
                <?php } ?>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="form-group">
        <?php if (is_admin()){ ?>
          <div class="row">
            <div class="col-md-12">
              <hr />
              <div class="checkbox checkbox-primary">
                <?php
                $isadmin = '';
                if(isset($member)) {
                 if($member->staffid == get_staff_user_id() || is_admin($member->staffid)){
                  $isadmin = ' checked';
                }
              }
              ?>
              <input type="checkbox" name="administrator" id="administrator" <?php echo $isadmin; ?>>
              <label for="administrator"><?php echo _l('staff_add_edit_administrator'); ?></label>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <div class="clearfix form-group"></div>
      <label for="password" class="control-label"><?php echo _l('staff_add_edit_password'); ?></label>
      <div class="input-group">
        <input type="password" class="form-control password" name="password" autocomplete="off">
        <span class="input-group-addon">
          <a href="#password" class="show_password" onclick="showPassword('password');"><i class="fa fa-eye"></i></a>
        </span>
        <span class="input-group-addon">
          <a href="#" class="generate_password" onclick="generatePassword(this);return false;"><i class="fa fa-refresh"></i></a>
        </span>
      </div>
      <?php if(isset($member)){ ?>
        <p class="text-muted"><?php echo _l('staff_add_edit_password_note'); ?></p>
        <?php if($member->last_password_change != NULL){ ?>
          <?php echo _l('staff_add_edit_password_last_changed'); ?>: <?php echo time_ago($member->last_password_change); ?>
          <?php } } ?>
          <button type="submit" class="btn btn-info pull-right mtop20"><?php echo _l('submit'); ?></button>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?>
    <?php if(isset($member)){ ?>
      <div class="col-md-6">
        <div class="panel_s">
          <div class="panel-heading">
            <?php echo _l('staff_add_edit_notes'); ?>
          </div>
          <div class="panel-body">
            <div class="container-fluid">
             <a href="#" class="btn btn-success" onclick="slideToggle('.usernote'); return false;"><?php echo _l('new_note'); ?></a>
             <div class="clearfix"></div>
             <hr />
             <div class="mbot15 usernote hide inline-block full-width">
              <?php echo form_open(admin_url('misc/add_note/'.$member->staffid . '/staff')); ?>
              <?php echo render_textarea('description','staff_add_edit_note_description','',array('rows'=>5)); ?>
              <button class="btn btn-info pull-right"><?php echo _l('submit'); ?></button>
              <?php echo form_close(); ?>
            </div>
            <div class="table-responsive mtop15">
              <table class="table dt-table" data-order-col="2" data-order-type="desc">
                <thead>
                  <tr>
                    <th width="50%"><?php echo _l('staff_notes_table_description_heading'); ?></th>
                    <th><?php echo _l('staff_notes_table_addedfrom_heading'); ?></th>
                    <th><?php echo _l('staff_notes_table_dateadded_heading'); ?></th>
                    <th><?php echo _l('options'); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($user_notes as $note){ ?>
                    <tr>
                      <td width="50%"><?php echo $note['description']; ?></td>
                      <td><?php echo $note['firstname'] . ' ' . $note['lastname']; ?></td>
                      <td data-order="<?php echo $note['dateadded']; ?>"><?php echo _dt($note['dateadded']); ?></td>
                      <td>
                       <?php if($note['addedfrom'] == get_staff_user_id() || has_permission('staff','','delete')){ ?>
                        <a href="<?php echo admin_url('misc/delete_note/'.$note['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                        <?php } ?>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  <?php init_tail(); ?>
  <script>
    init_roles_permissions();
    $('select[name="role"]').on('change', function() {
      var roleid = $(this).val();
      init_roles_permissions(roleid, true);
    });
    $('input[name="administrator"]').on('change',function(){
      var checked = $(this).prop('checked');
      if(checked == true){
        $('.roles').find('input').prop('disabled',true);
      } else {
        $('.roles').find('input').prop('disabled',false);
      }
    });
    _validate_form($('.staff-form'),{
     firstname:'required',
     lastname:'required',
     username:'required',
     password: {
      required: {
       depends: function(element){
        return ($('input[name="isedit"]').length == 0) ? true : false
      }
    }
  },
  email: {
    required:true,
    email:true,
    remote:{
     url: site_url + "admin/misc/staff_email_exists",
     type:'post',
     data: {
      email:function(){
       return $('input[name="email"]').val();
     },
     memberid:function(){
       return $('input[name="memberid"]').val();
     }
   }

 }
}
});
</script>
</body>
</html>
