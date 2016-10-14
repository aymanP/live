<?php init_head(); ?>

<div id="wrapper" class="customer_profile">
	<div class="content">
		<div class="row">
			<?php dump(generate_slider()); ?>
			<?php dump($sliders); ?>
			<?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>
			<div class="col-md-12">
				<div class="panel_s">
					<div class="panel-heading">
						<span class="client-profile-company"><?php echo _l('admin_home_slider_title'); ?></span>
						<div class="clearfix"></div>
					</div>
					<div class="panel-body">
						<div>
							<div class="tab-content">
								<?php echo form_open_multipart(admin_url('utilities/upload_slider/'.$slider->id),array('class'=>'dropzone','id'=>'slider-upload')); ?>
								<input type="file" name="file" multiple />
								<?php echo form_close(); ?>
								<div class="attachments">
									<div class="container-fluid">
										<div class="table-responsive mtop25">
											<table class="table dt-table" id="slidertable">
												<thead>
												<tr>
													<th><?php echo _l('customer_attachments_file'); ?></th>
													<th></th>
												</tr>
												</thead>
												<tbody>
												<?php foreach($sliders as $key => $value){
													$download_indicator = 'id';
													if($type == 'invoice'){
														if(!has_permission('invoices','','view')){continue;}
														$url = site_url() .'download/file/sales_attachment/';
														$upload_path = FRONTEND_SLIDER_FOLDER;
														$key_indicator = 'rel_id';
														$download_indicator = 'attachment_key';
													}
													?>
														<tr data-id="<?php echo $value['id']; ?>">
														<td>
															<i class="<?php echo get_mime_class($value['filetype']); ?>"></i>
															<a data-toggle="tooltip" data-title="<?php echo _l('customer_file_from',ucfirst($type)); ?>" href="<?php echo $url . $value[$download_indicator]; ?>"><?php echo $value['name']; ?></a>
															<br />
															<small class="text-muted"> <?php echo $value['image']; ?></small>
														</td>
														<td>
															<?php $path = $upload_path . $value[$key_indicator] . '/' . $value['file_name'];
															if(is_image($path)){
																$base64 = base64_encode(file_get_contents($path));
																$src = 'data: '.get_mime_by_extension($value['file_name']).';base64,'.$base64;
																?>
																<button type="button" class="btn btn-info btn-icon" data-placement="bottom" data-html="true" data-toggle="popover" data-content='<img src="<?php echo $src; ?>" class="img img-responsive mbot20">' data-trigger="focus"><i class="fa fa-eye"></i></button>
															<?php } ?>
															<button type="button" data-toggle="modal" data-file-name="<?php echo $value['file_name']; ?>" data-filetype="<?php echo $value['filetype']; ?>" data-path="<?php echo $path; ?>" data-target="#rename" class="btn btn-default btn-icon"><i class="fa fa-pencil-square-o"></i></button>
																<a href="<?php echo admin_url('utilities/delete_slider/'.$value['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
														</td>

													</tr>
												<?php } ?>
												</tbody>
											</table>

											<a href="#" onclick="save_menu();return false;" class="btn btn-info"><?php echo _l('utilities_save_slider_order'); ?></a>


										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade in" id="rename" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding-left: 6px;">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<?php echo form_open('admin/Utilities/rename_image'); ?>
			<form action="" id="rename_form" method="post" accept-charset="utf-8" novalidate="novalidate">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Renommer l'image  : <?php echo $value['name']; ?> </h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">

							<div class="input-group">
								<input type="hidden" name="id" value="<?php echo $value['id']; ?>" />
								<input type="text" class="form-control" placeholder="Tapez ici ..." name="rename" value="" />
								<?php echo form_error('rename'); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
					<button type="submit" class="btn btn-info" data-loading-text="Please wait..." autocomplete="off" data-form="#rename_form">Enregistrer</button>
				</div>
			</form> <?php echo form_close(); ?>        </div>
	</div>
</div>
<?php init_tail(); ?>
<script>
	Dropzone.options.sliderUpload = {
		paramName: "file",
		addRemoveLinks: false,
		accept: function(file, done) {
			done();
		},
		acceptedFiles:allowed_files,
		error:function(file,response){
			alert_float('danger',response);
		},
		success: function(file, response) {
			window.location.reload();
		}
	};
</script>



<script>
	$('table tbody').sortable({
		helper: fixWidthHelper
	}).disableSelection();

	function fixWidthHelper(e, ui) {
		ui.children().each(function() {
			$(this).width($(this).width());
		});
		return ui;
	}
</script>

<script src="<?php echo site_url(); ?>assets/plugins/jquery-nestable/jquery.nestable.js"></script>
<link href="<?php echo site_url(); ?>assets/plugins/font-awesome-icon-picker/css/fontawesome-iconpicker.min.css" rel="stylesheet">
<script src="<?php echo site_url(); ?>assets/plugins/font-awesome-icon-picker/js/fontawesome-iconpicker.min.js"></script>
<script>


	function save_menu() {
		var altr = $('#slidertable > tbody  > tr');
		var arr = [];
		var i = 1;

		$.each(altr, function() {
			var id = $(this).data("id");
			arr[i++] = id;
		});
		
	}

</script>

