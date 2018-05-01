<?php get_header();?>

<?php 
	
	global $post, $akvo_filters;
	
	$post_type = get_post_type( $post );
	
	$template = $akvo_filters->get_template( $post_type );

?>

	<div class="container" id="main-page-container">
		<div class="row">
			<?php if( $akvo_filters->is_active( $post_type ) ) :?>
			<div class="col-md-3">
				<?php $akvo_filters->form( $post_type );?>
			</div>
			<?php endif;?>
			<div id="archives-container" class="<?php if( $akvo_filters->is_active( $post_type ) ):?>col-md-9<?php else:?>col-md-12<?php endif;?>">
				<?php if(have_posts()):?>
					<div id="archives-list" class="row" data-target="#archives-list .col-md-4.eq">
         			<?php 
						while ( have_posts() ) : 
							the_post();
							
							/* UPDATE STICKY OPTION TO OFF THAT DOES NOT HAVE THE POST META YET */
							global $post;
							if( 'blog' == $post->post_type ){
								
								$sticky = get_post_meta( $post->ID, '_post_extra_boxes_checkbox', true );
								if( !$sticky ){
									update_post_meta( $post->ID, '_post_extra_boxes_checkbox', 'off' );
								}
								
							}
							/* UPDATE STICKY OPTION TO OFF THAT DOES NOT HAVE THE POST META YET */
							
					?>
         				<div class="<?php if( $template == 'list' ){_e('col-md-12');}else{_e('col-md-4');}?> eq">
         					<?php 
         						global $post_id;
         						
								if( $template == 'list' ){
									$shortcode = '[akvo-list ';
								}
								else{
									$shortcode = '[akvo-card ';
								}
								
         						
        						
        						$img = akvo_featured_img($post_id);
        						if($img){
        							$shortcode .= 'img="'.$img.'" ';
        						}
        						
        						$shortcode .= 'title="'.get_the_title().'" ';
        						$shortcode .= 'date="'.get_the_date().'" ';
        						$shortcode .= 'content="'.get_the_excerpt().'" ';
        						$shortcode .= 'link="'.get_the_permalink().'" ';
        						$shortcode .= 'type="'.$post_type.'"]';
        			
        						echo do_shortcode($shortcode);
         					?>
         				</div>
         			<?php endwhile;?>
         			</div>
         			<?php global $wp_query;if ($wp_query->max_num_pages > 1):?>
         			<div class="row">
						<div class="col-sm-12 text-center">
							<button data-behaviour='ajax-loading' data-list="#archives-list" class="btn btn-default">Load more&nbsp;<i class="fa fa-refresh"></i></button>
						</div>
					</div>
					<?php endif;?>
				<?php else:?>	
				<div class="alert alert-warning">No results were found.</div>
         		<?php endif;?>	
			</div>
		</div>
	</div><!-- End of Main Body Content -->
<?php get_footer();?>	
	
	