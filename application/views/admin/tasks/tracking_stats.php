<div class="modal fade" id="task-tracking-stats-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-task-stats" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo _l('task_statistics'); ?></h4>
            </div>
            <div class="modal-body">
                <canvas class="chart" id="task-tracking-stats-chart" style="height:500px;"></canvas>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    task_tracking_stats_data = <?php echo $stats; ?>;
</script>
