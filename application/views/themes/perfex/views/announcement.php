<div class="panel_s">
    <div class="panel-body">
        <h4 class="bold no-margin"><?php echo $announcement->name; ?></h4>
        <div class="mtop5"><?php echo _l('announcement_date',_d($announcement->dateadded)); ?></div>
        <?php if($announcement->showname == 1){
            if($mode != null)
            {
                foreach ($mode as $mod){
                    $mode_alami = (int)$mod['mode_alami'];
                }
            }
            if($alami != null){
                foreach($alami as $alam ){
                    if ($alam['firstname'] != null)
                        $username = $alam['firstname_alami'].' '.$alam['lastname_alami'];
                    $firstname = $alam['firstname'];
                    $lastname = $alam['lastname'];
                }
            }
            if($mode_alami == 1 && $announcement->firstname == $firstname && $announcement->lastname == $lastname) {
                echo _l('announcement_from') . ' ' .$username;
            }
            else
            echo _l('announcement_from') . ' ' . $announcement->firstname . ' ' .$announcement->lastname; } ?>
    </div>
</div>
<div class="panel_s">
    <div class="panel-body">
        <?php echo $announcement->message; ?>
    </div>
</div>
