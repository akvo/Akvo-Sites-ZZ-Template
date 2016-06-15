<div class='card'>
	
		<div class='card-header'>
			<h3 class='card-title'>
				<a href="<?php _e($atts['link']);?>">
					<?php _e($atts['title']);?>
				</a>	
			</h3>
			<div class="card-info">
				<time><i class="fa fa-calendar"></i>&nbsp;<?php _e($atts['date']);?></time>
				<span class='pull-right'><?php _e($atts['type']);?></span>
			</div>
			<div class='card-image' style="background-image:url('<?php _e($atts['img']);?>');"></div>
		</div>
		<div class='card-content'>
			<?php echo truncate($atts['content'], 150);?>
		</div>
		<a class="text-muted card-more" href="<?php _e($atts['link']);?>">Read More &rarr;</a>
	
</div>	
