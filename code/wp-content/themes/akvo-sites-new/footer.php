	<footer class="content-info" role="contentinfo">
		
		<div class="twitter">
			<div class="container">
				<div class="row">
					<?php 
						
						global $akvo;
						
						$footer_cols = 3; 
						
						$akvo_options = $akvo->get_option();
						if( isset( $akvo_options['footer'] ) && isset( $akvo_options['footer']['cols_num'] ) ){
							$footer_cols = $akvo_options['footer']['cols_num'];
						}
						
						$col_class='col-md-4';
						if( $footer_cols == 2 ){ $col_class = 'col-md-6';}
						elseif( $footer_cols == 1 ){ $col_class = 'col-md-12';}
						
						for( $i=1; $i<=$footer_cols; $i++ ):
					?>
					<div class="<?php _e( $col_class );?>">
						<?php dynamic_sidebar( 'sidebar-footer-'.$i ); ?>
					</div>
					<?php endfor;?>
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