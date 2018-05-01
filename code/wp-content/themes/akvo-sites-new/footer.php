	<footer class="content-info" role="contentinfo">
		
		<div class="twitter">
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
		<div class="custom">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<?php dynamic_sidebar('sidebar-footer-4'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="fixed">
			<div class="container">
				Powered by <a href="http://www.akvo.org" target="_blank">akvo.org</a>
				<p class="small">some rights reserved</p>
			</div>
		</div>
	</footer>
	
</body>
</html>

<?php wp_footer();?>