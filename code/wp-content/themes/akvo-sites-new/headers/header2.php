<header class="banner header2" role="banner">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2 logo">
			<?php
				$home_url = home_url('/');
						
				if ( is_multisite() ) {
					// should execute only for multisites
					$current_site = get_current_site();
					if( ICL_LANGUAGE_CODE == 'sw' && isset($current_site->domain) && $current_site->domain == "afrialliance.org" ) {
						$home_url = 'http://afrialliance.org/';
					}
				}
			?>
				<a class="brand" href="<?php _e($home_url); ?>">
				<?php if ( get_theme_mod( 'akvo_logo' ) ) : 
					/* set the image url */
					$image_url = esc_url( get_theme_mod( 'akvo_logo' ) );
				    /* store the image ID in a var */
					$image_id = pn_get_attachment_id_from_url($image_url);
							
					$akvo_logo_size = get_theme_mod( 'akvo_logo_size' ) ? 'large' : 'medium';
							
          			/* retrieve the thumbnail size of our image */
					$image_thumb = wp_get_attachment_image_src($image_id, $akvo_logo_size);
				?>
					<img src='<?php echo $image_thumb[0]; ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
				<?php else : ?>
					<img src="<?php bloginfo('template_url'); ?>/dist/images/logo-sample.svg">
				<?php endif; ?>
					<p><?php bloginfo('description');?></p>
				</a>
			</div>
			<div class="col-sm-8 wrap-search-menu">
				<div class="hidden-xs"><?php get_search_form();?></div>
                <nav class="navbar-collapse collapse" role="navigation" aria-expanded="true" style="">
				<?php if (has_nav_menu('primary_navigation')){
					wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav']);
					}
				?>
				</nav>
				<div class="navbar-header menu-mobile">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<i class="fa fa-bars fa-2x"></i>
					</button>

					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".search-collapse">
						<span class="sr-only">Toggle search</span>
						<i class="fa fa-search fa-2x"></i>
					</button>

				</div>
			</div>
            <div class="col-sm-2">
            	<?php if ( is_active_sidebar( 'sub-header' ) ) : ?>
			    <div id="sub-header" class="clearfix"><?php dynamic_sidebar( 'sub-header' ); ?></div>
      			<?php endif; ?>
            </div>
		</div>
		<div class="row">
			<div class="col-md-12 navi">
				<div class="collapse search-collapse"> <?php get_search_form();?></div>
			</div>
		</div>
			
		<?php if ( !is_front_page() && function_exists('bcn_display')): ?> 
		<div class="row">
			<div class="col-md-12">
				<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
					<?php bcn_display();?>
				</div>
			</div>
		</div>
		<?php endif;?>
	</div>
</header>