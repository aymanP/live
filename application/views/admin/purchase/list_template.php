<?php
/**
 * Created by PhpStorm.
 * User: DevTWO
 * Date: 01/11/2016
 * Time: 15:11
 */
?>

<div class="col-md-12" id="small-table">
    <div class="panel_s">

        <input type="hidden" name="purchaseid" value="">

        <div class="table-responsive">


            <table class="table dt-table" data-order-col="1" data-order-type="desc">


                <thead>
                <tr>
                    <th><?php echo _l('reference_no'); //echo project['id']; ?></th>
                    <th><?php echo _l('purchase_title'); ?></th>
                    <th><?php echo _l('purchase_tva'); ?></th>
                    <th><?php echo _l('purchase_amount'); ?></th>
                    <th><?php echo _l('project_file_uploaded_by'); ?></th>
                    <th><?php echo _l('project_file_dateadded'); ?></th>
                    <th><?php echo _l('options'); ?></th>
                </tr>
                </thead>

                <tbody>


                <?php foreach($purchase as $purchas)
                      {
                          //$val = 1;


                                  foreach($purchase_files as $file)
                                  {
                                      if($file['id_purchase'] == $purchas['id_purchase'])
                                          $f = $file;
                                  }

                                //$val=0;
                                  //$ci->load->model(purchase_model);
                                 // $f = $ci->purchase_model->get_file($purchas['id_purchase']);
                            //  echo $f['id'];


                          ?>
                    <tr>
                        <td>
                            <a target= "_blank" href="<?php echo site_url('uploads/purchases/'.$project->id.'/'.$f['attachment']); ?>">
                                <?php
                                    echo $purchas['Reference'];
                               // print_r($f );
                                /*
                                    echo 'id='.$purchas['id_purchase'];
                                    foreach($staff as $staf)
                                        echo 'staffid='.$staf['staffid'];*/

                                ?></a>

                        </td>
                        <td>
                            <?php echo $purchas['Titre']; //echo $project->id;?>
                        </td>
                        <td>
                            <?php echo $purchas['TVA']?>
                        </td>
                        <td>
                            <?php echo $purchas['montant']?>
                        </td>
                        <td>
                            <?php
                               // print_r($purchase_files) ;

                          foreach($purchase_files as $file)
                          {
                              if($file['id_purchase'] == $purchas['id_purchase'])
                              {

                                    if($file['staffid'] != 0)
                                    {
                                         $_data = '<a href="' . admin_url('staff/profile/' . $file['staffid']). '">' .staff_profile_image($file['staffid'], array(
                                            'staff-profile-image-small')) . '</a>';
                                         $_data .= ' <a href="' . admin_url('staff/member/' . $file['staffid'])  . '">' . get_staff_full_name($file['staffid']) . '</a>';
                                        echo $_data;
                                    } else
                                    {
                                         echo ' <img src="'.contact_profile_image_url($file['contact_id'],'thumb').'" class="client-profile-image-small mrigh5">
                                                <a href="'.admin_url('clients/client/'.get_user_id_by_contact_id($file['contact_id']).'?contactid='.$file['contact_id']).'"
                                                >'.get_contact_full_name($file['contact_id']).'</a>';
                                    }
                            ?>
                        </td>
                        <td data-order="<?php echo $file['dateadd']; ?>">
                            <?php echo _dt($file['dateadd']); ?>
                        </td>
                        <td>
                            <button type="button" data-toggle="modal" data-original-file-name="<?php echo $file['attachment']; ?>" data-filetype="<?php echo $file['filetype']; ?>"
                                    data-path="<?php echo site_url('uploads/purchases/'.$project->id.'/'.$f['attachment']); ?>" data-target="#send_file" class="btn btn-info btn-icon">
                                <i class="fa fa-envelope"></i>
                            </button>
                            <?php if($file['staffid'] == get_staff_user_id() || has_permission('projects','','delete')){ ?>
                                <a href="<?php echo admin_url('projects/remove_file/'.$project->id.'/'.$file['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                            <?php } ?>
                        </td>

                    </tr>
                            <?php }}} ?>
                </tbody>
            </table>



            <!--<a href="#" class="btn btn-info pull-left" onclick="new_task_from_relation('.table-rel-tasks'); return false;">Ajouter un bon de commande</a>-->
            <button type="button" data-toggle="modal" data-file-name="<?php echo $project->id; ?>" data-target="<?php echo "#purchase"?>"  class="btn btn-info pull-left">
                Ajouter un bon de commande
                 </button>


        </div>

    </div>
    <?php include_once(APPPATH . 'views/admin/clients/modals/send_file_modal.php'); ?>
    <div class="modal fade" id="<?php echo "purchase"?>" tabindex="-1" role="dialog" >
        <div class="modal-dialog " >
            <div class="modal-content">
                <?php echo form_open(admin_url('projects/purchase_upload_file/'.$project->id),array('id'=>'project-expense-form','class'=>'dropzone dz-clickable')); ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><?php echo _l('add_new', _l('expense_lowercase')); ?></h4>
                </div>
                <?php //echo form_close(); ?>
                <?php //echo form_open('admin/Projects/add_purchase'); ?>
                <!--<form action="" id="purchase_form" method="post" accept-charset="utf-8" novalidate="novalidate">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Ajouter bon de commande au projet : <?php echo $project->id; ?> </h4>
                    </div>-->
                    <div class="modal-body">



                        <div class="row">
                            <div class="col-md-6">

                                <div class="input-group">
                                    <label> Réference </label>
                                    <input type="hidden" name="id" value="<?php echo $project->id; ?>" />
                                    <input type="text" class="form-control" placeholder="Tapez ici ..." name="reference" value="" />
                                    <?php //echo $this->input->post('position');?>
                                </div>
                            </div>
                        </div> </br>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="input-group">
                                    <label> Titre : </label>
                                    <input type="hidden" name="id" value="<?php echo $project->id; ?>" />
                                    <input type="text" class="form-control" placeholder="Tapez ici ..." name="titre" value="" />
                                    <?php //echo $this->input->post('position');?>
                                </div>
                            </div>
                        </div> </br>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="input-group">
                                    <label> TVA </label>
                                    <input type="hidden" name="id" value="<?php echo $project->id; ?>" />
                                    <input type="text" class="form-control" placeholder="Tapez ici ..." name="TVA" value="" />
                                    <?php //echo $this->input->post('position');?>
                                </div>
                            </div>
                        </div> </br>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="input-group">
                                    <label >Montant :</label>
                                    <input type="hidden" name="id" value="<?php echo $project->id; ?>" />
                                    <input type="text" class="form-control" placeholder="Exemple:10200.20 ..." name="montant" value="" />

                                </div>
                            </div>
                        </div>
                        <div id="dropzoneDragArea" name="file" class="dz-default dz-message">
                            <input type="file" name="file" />
                            <span><?php echo _l('expense_add_edit_attach_receipt'); ?></span>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
                    </div>
                <!--</form>--> <?php echo form_close(); ?>
            </div>
        </div>

    </div>
