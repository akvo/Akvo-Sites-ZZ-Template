<div class='card'>
	<a href="<?php _e($atts['link']);?>">
		<div class='card-header'>
			<h3 class='card-title'><?php _e($atts['title']);?></h3>
			<div class="card-info row">
				<div class="col-xs-6">
					<time><i class="fa fa-calendar"></i>&nbsp;<?php _e($atts['date']);?></time>
				</div>
				<div class="col-xs-6 text-right">
					<span><?php _e($atts['type']);?></span>
				</div>	
			</div>
			<div class='card-image' style="background-image:url('<?php _e($atts['img']);?>');"></div>
		</div>
		<div class='card-content'>
			<?php echo truncate($atts['content'], 150);?>
		</div>
	</a>	
</div>	
