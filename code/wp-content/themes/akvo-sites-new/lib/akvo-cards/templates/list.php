<div class='card-list <?php _e(self::slugify($atts['type']));?>' style="width: 100%;border: #CCC solid 1px;padding: 20px;">
	<div class='card-header'>
		<h3 class='card-title'><a href="<?php _e($atts['link']);?>"><?php _e($atts['title']);?></a></h3>
		<ul class="small list-inline">
			<li><i class="fa fa-calendar"></i>&nbsp;&nbsp;<?php _e($atts['date']);?></li>
			<li><span class='badge'><?php if($atts['type-text']){_e($atts['type-text']);} else{_e($atts['type']);}?></span></li>
		</ul>
	</div>
	<div class='card-content'>
		<?php echo truncate($atts['content'], 130);?>
	</div>
</div>	

