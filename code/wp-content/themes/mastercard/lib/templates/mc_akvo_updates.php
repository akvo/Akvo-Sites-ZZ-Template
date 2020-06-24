<div style='margin:30px 0 100px;'>
	<ol class="breadcrumb" style="margin-bottom: 50px;">
		<li><a href="<?php _e( $this->url('home') );?>">Home</a></li>
		<li class='active'>All Updates</li>
	</ol>
	<?php
		$mc_api->list_updates( $response, $atts['limit'] );
		$mc_api->pagination( $total_items, $atts['limit'], $atts['page'] );
	?>
</div>
