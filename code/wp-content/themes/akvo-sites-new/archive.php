<?php get_header();?>
	<div class="container" id="main-page-container">
		<div class="row">
			<?php global $post;?>
			<?php if(is_akvo_filter_form($post_type)):?>
			<div class="col-md-3">
				<?php akvo_filter_form(get_post_type($post));?>
			</div>
			<?php endif;?>
			<div id="archives-container" class="<?php if(is_akvo_filter_form($post_type)):?>col-md-9<?php else:?>col-md-12<?php endif;?>">
				<?php if(have_posts()):?>
					<div id="archives-list" class="row" data-target="#archives-list .col-md-4.eq">
         			<?php while ( have_posts() ) : the_post();?>
         				<div class="col-md-4 eq">
         					<?php 
         						global $post_id;
         						
         						$shortcode = '[akvo-card ';
        						
        						$img = akvo_featured_img($post_id);
        						if($img){
        							$shortcode .= 'img="'.$img.'" ';
        						}
        						
        						$shortcode .= 'title="'.get_the_title().'" ';
        						$shortcode .= 'date="'.get_the_date().'" ';
        						$shortcode .= 'content="'.get_the_excerpt().'" ';
        						$shortcode .= 'link="'.get_the_permalink().'" ';
        						$shortcode .= 'type="'.get_post_type($post).'"]';
        			
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
	
	