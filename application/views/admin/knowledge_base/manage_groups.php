<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <a href="#" onclick="new_kb_group(); return false;" class="btn btn-info pull-left display-block"><?php echo _l('new_group'); ?></a>
                    </div>
                </div>
                <div class="panel_s">
                    <div class="panel-body">
                        <?php if(count($groups) > 0){ ?>
                        <div class="container-fluid">
                            <div class="table-responsive">
                                <table class="table dt-table">
                                    <thead>
                                        <th><?php echo _l('group_table_name_heading'); ?></th>
                                        <th><?php echo _l('group_table_isactive_heading'); ?></th>
                                        <th><?php echo _l('options'); ?></th>
                                    </thead>
                                    <tbody>
                                        <?php foreach($groups as $group){ ?>
                                        <tr>
                                            <td><?php echo $group['name']; ?> <span class="badge pull-right"><?php echo total_rows('tblknowledgebase','articlegroup='.$group['groupid']); ?></span></td>
                                            <td>
                                                <input type="checkbox" class="switch-box input-xs" data-size="mini" data-id="<?php echo $group['groupid']; ?>" data-switch-url="<?php echo ADMIN_URL; ?>/knowledge_base/change_group_status" <?php if($group['active'] == 1){echo 'checked';} ?>>
                                            </td>
                                            <td>
                                                <a href="#" onclick="edit_kb_group(this,<?php echo $group['groupid']; ?>); return false" data-name="<?php echo $group['name']; ?>" data-color="<?php echo $group['color']; ?>" data-description="<?php echo clear_textarea_breaks($group['description']); ?>" data-order="<?php echo $group['group_order']; ?>" data-active="<?php echo $group['active']; ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="<?php echo admin_url('knowledge_base/delete_group/'.$group['groupid']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php } else { ?>
                        <p class="no-margin"><?php echo _l('kb_no_groups_found'); ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once(APPPATH.'views/admin/knowledge_base/group.php'); ?>
<?php init_tail(); ?>
</body>
</html>
