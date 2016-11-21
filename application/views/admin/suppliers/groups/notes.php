<?php
/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 08/11/2016
 * Time: 16:43
 */

?>

<?php if(isset($supplier)){ ?>
    <div class="col-md-12">
        <a href="#" class="btn btn-success" onclick="slideToggle('.usernote'); return false;"><?php echo _l('new_note'); ?></a>
        <hr />
    </div>
    <div class="clearfix"></div>
    <div class="usernote hide">
        <div class="col-md-12">
            <?php echo form_open(admin_url( 'misc/add_note/'.$supplier->supplierid.'/supplier')); ?>
            <?php echo render_textarea( 'description', 'note_description', '',array( 'rows'=>5)); ?>
            <button class="btn btn-info pull-right mbot15">
                <?php echo _l( 'submit'); ?>
            </button>
            <?php echo form_close(); ?>
        </div>
    </div>
    <div class="container-fluid">
        <div class="table-responsive mtop15">
            <table class="table dt-table" data-order-col="2" data-order-type="desc">
                <thead>
                <tr>
                    <th width="50%">
                        <?php echo _l( 'supplier_notes_table_description_heading'); ?>
                    </th>
                    <th>
                        <?php echo _l( 'supplier_notes_table_addedfrom_heading'); ?>
                    </th>
                    <th>
                        <?php echo _l( 'supplier_notes_table_dateadded_heading'); ?>
                    </th>
                    <th>
                        <?php echo _l( 'options'); ?>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($user_notes as $note){ ?>
                    <tr>
                        <td width="50%">
                            <?php echo $note[ 'description']; ?>
                        </td>
                        <td>
                            <?php echo '<a href="'.admin_url( 'profile/'.$note[ 'addedfrom']). '">'.$note[ 'firstname'] . ' ' . $note[ 'lastname'] . '</a>' ?>
                        </td>
                        <td data-order="<?php echo $note['dateadded']; ?>">
                            <?php echo _dt($note[ 'dateadded']); ?>
                        </td>
                        <td>
                            <?php if($note['addedfrom'] == get_staff_user_id() || is_admin()){ ?>
                                <a href="<?php echo admin_url('misc/delete_note/'. $note['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } ?>

