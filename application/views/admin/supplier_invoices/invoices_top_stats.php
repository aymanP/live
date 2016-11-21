<?php
/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 14/11/2016
 * Time: 14:58
 */
?>

<div id="stats-top" class="hide">
    <div id="invoices_total"></div>
    <div class="panel_s">
        <div class="panel-body">
            <?php
            $where_all = array('supplierid !=' => intval('0'));
            if(isset($project)){
                $where_all= array('project_id' => $project->id, 'supplierid !=' => intval('0'));
            }
            $total_invoices = total_rows('tblinvoices',$where_all);
            ?>
            <div class="row text-left quick-top-stats">
                <?php foreach($invoices_statuses as $status){ if($status == 5){continue;}

                    $where = array('status'=>$status,'supplierid !=' => intval('0'));
                    if(isset($project)){
//                        $where['project_id'] = $project->id;
                        $where = array('project_id' => $project->id, 'supplierid !=' => intval('0'));
                    }
                    $total_by_status = total_rows('tblinvoices',$where);
                    $percent = ($total_invoices > 0 ? number_format(($total_by_status * 100) / $total_invoices,2) : 0);
                    ?>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-9">
                                <a href="#" data-cview="invoices_<?php echo $status; ?>" onclick="dt_custom_view('invoices_<?php echo $status; ?>','.table-invoices','invoices_<?php echo $status; ?>',true); return false;">
                                    <h5 class="bold"><?php echo format_invoice_status($status,'',false); ?></h5>
                                </a>
                            </div>
                            <div class="col-md-3 text-right bold">
                                <?php echo $total_by_status; ?> / <?php echo $total_invoices; ?>
                            </div>
                            <div class="col-md-12">
                                <div class="progress no-margin">
                                    <div class="progress-bar progress-bar-<?php echo get_invoice_status_label($status); ?>" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%" data-percent="<?php echo $percent; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <hr />
</div>


