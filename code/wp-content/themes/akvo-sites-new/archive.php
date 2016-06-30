<?php get_header();?>
	<div class="container" id="main-page-container">
		<div class="row">
			<div class="col-md-12">
				<?php global $post;?>
        		<?php echo do_shortcode('[akvo-cards type="'.get_post_type($post).'" posts_per_page=6 pagination=1]');?>
			</div>
		</div>
	</div><!-- End of Main Body Content -->
<?php get_footer();?>	
	
	