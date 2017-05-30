<header class="banner" role="banner">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 logo">
			<?php
				$header_option = get_option('sage_header_options');
						 
				$search_flag = true;
						 
				if($header_option && isset($header_option['hide_search']) && $header_option['hide_search']){
					$search_flag = false;
				}
						 
				$home_url = home_url('/');
						
				if ( is_multisite() ) {
					// should execute only for multisites
					$current_site = get_current_site();
					if( ICL_LANGUAGE_CODE == 'fr' && isset($current_site->domain) && $current_site->domain == "afrialliance.org" ) {
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
			<div class="col-sm-6 wrap-search-menu">
				<?php if( $search_flag ):?>
				<div class="hidden-xs"><?php get_search_form();?></div>
				<?php else: ?>
					<?php if ( is_active_sidebar( 'replace-search' ) ){ dynamic_sidebar( 'replace-search' ); }?>
				<?php endif;?>
					
				<div class="navbar-header menu-mobile">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<i class="fa fa-bars fa-2x"></i>
					</button>
					
					<?php if( $search_flag ):?>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".search-collapse">
						<span class="sr-only">Toggle search</span>
						<i class="fa fa-search fa-2x"></i>
					</button>
					<?php endif;?>
				</div>
					
				<?php if ( is_active_sidebar( 'sub-header' ) ) : ?>
				<div id="sub-header" class="clearfix">
					<?php dynamic_sidebar( 'sub-header' ); ?>
				</div>
      			<?php endif; ?>
      		</div>
		</div>
		<div class="row">
			<div class="col-md-12 navi">
				
				<?php if( $search_flag ):?>
				<div class="collapse search-collapse">
					<?php get_search_form();?>	
				</div>
				<?php endif;?>
				
				<nav class="navbar-collapse collapse" role="navigation" aria-expanded="true" style="">
				<?php
					if (has_nav_menu('primary_navigation')){
						wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav']);
					}
				?>
				<?php if ( is_plugin_active( 'google-website-translator/google-website-translator.php' ) && !is_user_logged_in() ) : ?>
					<div style="display:none;"><?php echo do_shortcode('[prisna-google-website-translator]'); ?></div>
				<?php endif;?>
				</nav>
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
	