<?php
$data = '<div class="row">';
foreach($attachments as $attachment) {
    $data .= '<div class="display-block lead-attachment-wrapper">';
    $data .= '<div class="col-md-10">';
    $data .= '<div class="pull-left"><i class="'.get_mime_class($attachment['filetype']).'"></i></div>';
$data .= '<a href="'.site_url('download/file/lead_attachment/'.$attachment['id']).'">'.$attachment['file_name'].'</a>';
    $data .= '<p class="text-muted">'.$attachment["filetype"].'</p>';
    $data .= '</div>';
    $data .= '<div class="col-md-2 text-right">';
    $data .= '<a href="#" class="text-danger" onclick="delete_lead_attachment(this,'.$attachment['id'].'); return false;"><i class="fa fa fa-times"></i></a>';
    $data .= '</div>';
    $data .= '<div class="clearfix"></div><hr/>';
    $data .= '</div>';
}
$data .= '</div>';
echo $data;
