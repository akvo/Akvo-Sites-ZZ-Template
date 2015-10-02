<footer class="content-info" role="contentinfo">
	<div class="twitter">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
				<?php if ( ! function_exists( 'is_plugin_active' ) ) require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
          		if ( is_plugin_active( 'devbuddy-twitter-feed/devbuddy-twitter-feed.php' ) ) { ?>
					<section>
						<h3>Latest on Twitter</h3>
						<?php db_twitter_feed() ?>
					</section>
				<?php } ?>
					<?php dynamic_sidebar('sidebar-footer-high'); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="custom">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<?php dynamic_sidebar('sidebar-footer'); ?>
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
