<?php
/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 08/11/2016
 * Time: 16:44
 */

?>

<?php if(isset($supplier)){
    init_relation_tasks_table(array( 'data-new-rel-id'=>$supplier->supplierid,'data-new-rel-type'=>'supplier'));
} ?>
