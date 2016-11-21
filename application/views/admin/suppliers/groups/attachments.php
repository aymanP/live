<?php
/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 08/11/2016
 * Time: 16:41
 */

?>

<?php if(isset($supplier)){ ?>
    <?php  if(isset($supplier->supplierid)) echo form_open_multipart(admin_url('suppliers/upload_attachment/'.$supplier->supplierid),array('class'=>'dropzone','id'=>'supplier-attachments-upload')); ?>
    <input type="file" name="file" multiple />
    <?php echo form_close(); ?>
    <div class="attachments">
        <div class="container-fluid">
            <div class="table-responsive mtop25">
                <table class="table dt-table">
                    <thead>
                    <tr>
                        <th><?php echo _l('supplier_attachments_file'); ?></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($attachments as $type => $attachment){
                        $download_indicator = 'id';
                        if($type == 'invoice'){
                            if(!has_permission('invoices','','view')){continue;}
                            $url = site_url() .'download/file/sales_attachment/';
                            $upload_path = INVOICE_ATTACHMENTS_FOLDER;
                            $key_indicator = 'rel_id';
                            $download_indicator = 'attachment_key';
                        } else if($type == 'proposal'){
                            if(!has_permission('proposals','','view')){continue;}
                            $url = site_url() .'download/file/sales_attachment/';
                            $upload_path = PROPOSAL_ATTACHMENTS_FOLDER;
                            $key_indicator = 'rel_id';
                            $download_indicator = 'attachment_key';
                        } else if($type == 'estimate'){
                            if(!has_permission('estimates','','view')){continue;}
                            $url = site_url() .'download/file/sales_attachment/';
                            $upload_path = ESTIMATE_ATTACHMENTS_FOLDER;
                            $key_indicator = 'rel_id';
                            $download_indicator = 'attachment_key';
                        } else if($type == 'contracts'){
                            if(!has_permission('contracts','','view')){continue;}
                            $url = site_url() .'download/file/contract/';
                            $key_indicator = 'contractid';
                            $upload_path = CONTRACTS_UPLOADS_FOLDER;
                        } else if($type == 'leads'){
                            $url = site_url() .'download/file/lead_attachment/';
                            $upload_path = LEAD_ATTACHMENTS_FOLDER;
                            $key_indicator = 'leadid';
                        } else if($type == 'tasks'){
                            $url = site_url() .'download/file/taskattachment/';
                            $key_indicator = 'taskid';
                            $upload_path = TASKS_ATTACHMENTS_FOLDER;
                        } else if($type == 'tickets'){
                            $url = site_url() .'download/file/ticket/';
                            $upload_path = TICKET_ATTACHMENTS_FOLDER;
                            $key_indicator = 'ticketid';
                        } else if($type == 'supplier'){
                            $url = site_url() .'download/file/supplier/';
                            $upload_path = SUPPLIER_ATTACHMENTS_FOLDER;
                            $key_indicator = 'supplierid';
                        }
                        ?>
                        <?php foreach($attachment as $_att){ ?>
                            <tr>
                            <td>
                                <i class="<?php echo get_mime_class($_att['filetype']); ?>"></i>
                                <a data-toggle="tooltip" data-title="<?php echo _l('customer_file_from',ucfirst($type)); ?>" href="<?php echo $url . $_att[$download_indicator]; ?>"><?php echo $_att['file_name']; ?></a>
                                <br />
                                <small class="text-muted"> <?php echo $_att['filetype']; ?></small>
                            </td>
                            <td>
                                <?php $path = $upload_path . $_att[$key_indicator] . '/' . $_att['file_name'];
                                if(is_image($path)){
                                    $base64 = base64_encode(file_get_contents($path));
                                    $src = 'data: '.get_mime_by_extension($_att['file_name']).';base64,'.$base64;
                                    ?>
                                    <button type="button" class="btn btn-info btn-icon" data-placement="bottom" data-html="true" data-toggle="popover" data-content='<img src="<?php echo $src; ?>" class="img img-responsive mbot20">' data-trigger="focus"><i class="fa fa-eye"></i></button>
                                <?php } ?>
                                <button type="button" data-toggle="modal" data-file-name="<?php echo $_att['file_name']; ?>" data-filetype="<?php echo $_att['filetype']; ?>" data-path="<?php echo $path; ?>" data-target="#send_file" class="btn btn-info btn-icon"><i class="fa fa-envelope"></i></button>
                                <?php if($type == 'supplier'){ ?>
                                    <a href="<?php echo admin_url('suppliers/delete_attachment/'.$_att['supplierid'].'/'.$_att['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                                <?php } ?>
                            </td>
                        <?php } ?>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    include_once(APPPATH . 'views/admin/suppliers/modals/send_file_modal.php');
} ?>

