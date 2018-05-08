<div class='list-widget'>
	<div class="row">
		<div class='col-sm-6'>
			<h3 class='list-title' style="margin-top: 0;"><a href="<?php _e($atts['link']);?>"><?php _e($atts['title']);?></a></h3>
			<p class="small"><i class="fa fa-calendar"></i>&nbsp;&nbsp;<?php _e($atts['date']);?></p>
		</div>
		<div class='col-sm-6'>
			<div style="min-height: 50px;"><?php echo truncate($atts['content'], 130);?></div>
			<?php
				$types = array();
				if( isset( $atts['type'] ) ){
					$types = explode( ',', $atts['type'] );
				}
			?>
			<?php if( count( $types ) ):?>
			<ul class="small list-inline">
				<?php foreach( $types as $type ): ?>
				<li><span class='badge'><?php _e( $type );?></span></li>
				<?php endforeach;?>
			</ul>
			<?php endif; ?>
		</div>
	</div>	
</div>	

