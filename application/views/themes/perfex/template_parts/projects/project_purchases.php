<?php
/**
 * Created by PhpStorm.
 * User: DevTWO
 * Date: 02/11/2016
 * Time: 11:02
 */
?>

<div class="col-md-12" id="small-table">
    <div class="panel_s">

        <input type="hidden" name="purchaseid" value="">

        <div class="table-responsive">


            <table class="table dt-table" data-order-col="1" data-order-type="desc">


                <thead>
                <tr>
                    <th><?php echo _l('reference_no'); ?></th>
                    <th><?php echo _l('purchase_title'); ?></th>

                    <th><?php echo _l('options'); ?></th>
                </tr>
                </thead>

                <tbody>

                <?php foreach($purchase as $purchas){ ?>
                    <tr>
                    <td>
                        <a target= "_blank" href="<?php echo site_url('uploads/purchases/'.$purchas['id_purchase'].'/'.$purchas['Titre'].'.jpg'); ?>"> <?php echo $purchas['Reference']; ?></a>

                    </td>
                    <td>
                        <?php echo $purchas['Titre']?>
                    </td>


                        <td>
                            <button type="button" data-toggle="modal" data-original-file-name="<?php echo $file['file_name']; ?>" data-filetype="<?php echo $file['filetype']; ?>"
                                    data-path="<?php echo PROJECT_ATTACHMENTS_FOLDER .$purchas['id_roject'].'/'.$file['file_name']; ?>" data-target="#send_file" class="btn btn-info btn-icon">
                                <i class="fa fa-envelope"></i>
                            </button>

                        </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!--  <a href="#" class="btn btn-info pull-left" onclick="new_task_from_relation('.table-rel-tasks'); return false;">Ajouter un bon de commande</a>
             ADD PURCHASE MODEL-->


        </div>

    </div>

