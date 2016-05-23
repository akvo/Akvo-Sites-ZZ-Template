	<footer class="content-info" role="contentinfo">
		<!--div class="twitter">
			<div class="container">
				<div class="row">
					
					<div class="col-md-6 col-md-offset-3">
						<?php if ( ! function_exists( 'is_plugin_active' ) ) require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
							if ( is_plugin_active( 'devbuddy-twitter-feed/devbuddy-twitter-feed.php' ) ) { 
								if(get_option('sage_footer_options') != NULL){ 
									$footer_option = get_option('sage_footer_options');
									if($footer_option['checkbox_twitter'] == 1){
									?>
									<section>
										<h3>Latest on Twitter</h3>
										<?php db_twitter_feed() ?>
									</section>
									<?php 
									} 
								} 
							}?>
						<?php dynamic_sidebar('sidebar-footer-high'); ?>
					</div>
				</div>
			</div>
		</div-->
		<div class="custom">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<?php dynamic_sidebar('sidebar-footer-1'); ?>
					</div>
					<div class="col-md-4">
						<?php dynamic_sidebar('sidebar-footer-2'); ?>
					</div>
					<div class="col-md-4">
						<?php dynamic_sidebar('sidebar-footer-3'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="fixed">
			<div class="container">
				Powered by
				<a href="http://www.akvo.org" target="_blank">akvo.org</a>
				<span class="small">some rights reserved</span>
			</div>
		</div>
	</footer>
	<?php wp_footer();?>
</body>
</html>
