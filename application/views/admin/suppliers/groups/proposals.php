<?php
/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 08/11/2016
 * Time: 16:43
 */

?>


<?php if(isset($supplier)){ ?>
    <?php if(has_permission('proposals','','create')){ ?>
        <a href="<?php echo admin_url('proposals/proposal?rel_type=supplier&rel_id='.$supplier->supplierid); ?>" class="btn btn-info"><?php echo _l('new_proposal'); ?></a>
    <?php } ?>
    <?php if(has_permission('proposals','','view')){ ?>
        <?php
        $table_data = array(
            _l('id'),
            _l('proposal_subject'),
            _l('proposal_total'),
            _l('proposal_open_till'),
            _l('proposal_date_created'),
            _l('proposal_status'));
        $custom_fields = get_custom_fields('proposal',array('show_on_table'=>1));
        foreach($custom_fields as $field){
            array_push($table_data,$field['name']);
        }
        render_datatable($table_data,'proposals-client-profile');
        ?>
    <?php } ?>
<?php } ?>

