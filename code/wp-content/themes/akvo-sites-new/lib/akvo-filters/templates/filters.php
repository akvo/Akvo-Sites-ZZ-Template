<div class="row">
	<!-- FILTER FORM STARTS HERE -->
	<?php  if( $this->is_active( $atts['post_type'] ) ) :?>
	<div class="col-md-3">
		<?php $this->form( $atts['post_type'] );?>
	</div>
	<?php endif;  ?>
	<!-- FILTER FORM ENDS HERE -->
	<div id="archives-container" class="<?php if( $this->is_active( $atts['post_type'] ) ):?>col-md-9<?php else:?>col-md-12<?php endif;?>">
		<?php
			
			$akvo_filters = $this->get_option();
			
			/* init the request values into the array */
			if( $atts[ 'post_type' ] && isset( $akvo_filters[ $atts[ 'post_type' ] ] ) ){
				$akvo_filters[ $atts[ 'post_type' ] ] = $this->init( $akvo_filters[ $atts[ 'post_type' ] ] );
			}
			
			$shortcode = "[akvo-cards-without-ajax pagination='1' template='".$atts['template']."' posts_per_page='".$atts['posts_per_page']."' type='".$atts['post_type']."'";
			
			$shortcode .= " filter_by='";
			
			$count = 0;
			foreach( $akvo_filters[ $atts[ 'post_type' ] ] as $slug => $arr ){
				
				if( isset( $arr['id'] ) && $arr['id'] ){
					
					if( $count != 0 ){ $shortcode .= ","; }
					
					$shortcode .= $slug.":".$arr['id'];
					
					$count++;
				}
				
				
				
			}
			
			$shortcode .= "']";
			
			echo do_shortcode( $shortcode );
			
		?>		
	</div> <!-- ARCHIVES CONTAINER -->
</div>
