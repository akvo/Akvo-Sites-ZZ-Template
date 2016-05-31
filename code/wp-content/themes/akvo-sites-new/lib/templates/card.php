<div class='card'>
	<a href="<?php _e($atts['link']);?>">
		<div class='card-header'>
			<h3 class='card-title'><?php _e($atts['title']);?></h3>
			<div class="card-info">
				<time><i class="fa fa-calendar"></i>&nbsp;<?php _e($atts['date']);?></time>
				<span class='pull-right'><?php _e($atts['type']);?></span>
			</div>
			<div class='card-image' style="background-image:url('<?php _e($atts['img']);?>');"></div>
		</div>
		<div class='card-content'>
			<?php _e($atts['content']);?>
		</div>
	</a>	
</div>	
