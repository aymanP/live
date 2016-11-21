<?php
echo $head;
if($use_navigation == true){
	get_template_part('navigation');
}
?>
<div id="wrapper">
	<div id="content"style="margin-right: 0px;padding-right: 0px;padding-left: 0px;width: 1419px;margin-left: 235px;">
		<div class="container" style="
    width: 1449px;
    margin-right: 0px;
">
			<div class="row">
				<?php get_template_part('alerts'); ?>
				<div class="clearfix"></div>
				<?php echo $view; ?>
			</div>
		</div>
	</div>
	<?php
	echo $footer;
	echo $scripts;
	?>
</div>
</body>
</html>
