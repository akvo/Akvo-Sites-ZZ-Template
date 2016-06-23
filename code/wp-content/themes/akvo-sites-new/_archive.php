<?php get_header();?>
	<div class="container" id="main-page-container">
		<div class="row">
			<?php if(have_posts()):?>
         		<?php while ( have_posts() ) : the_post();?>
        		<div class="col-md-4 eq">
        			<?php echo do_shortcode('[akvo-card content="'.get_the_excerpt().'" title="'.get_the_title().'" date="'.get_the_date().'" link="'.get_the_permalink().'"]');?>
        		</div> 				
            	<?php endwhile;?>
          	<?php endif;?>
        </div>
	</div><!-- End of Main Body Content -->
<?php get_footer();?>	
	
	