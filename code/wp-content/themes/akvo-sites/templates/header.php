<header class="banner" role="banner">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 logo">
				<a class="brand" href="<?= esc_url(home_url('/')); ?>">
					<?php if ( get_theme_mod( 'akvo_logo' ) ) : 
          // set the image url
					$image_url = esc_url( get_theme_mod( 'akvo_logo' ) );
          // store the image ID in a var
					$image_id = pn_get_attachment_id_from_url($image_url);
          // retrieve the thumbnail size of our image
					$image_thumb = wp_get_attachment_image_src($image_id, 'medium');
					?>
					<img src='<?php echo $image_thumb[0]; ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
				<?php else : ?>
					<img src="<?= get_template_directory_uri(); ?>/dist/images/logo-sample.svg">
				<?php endif; ?>
			</a>
		</div>
		<div class="col-sm-6 wrap-search-menu">
			<div class="hidden-xs">
				<?php get_template_part('templates/searchform'); ?>
			</div>
			<div class="navbar-header menu-mobile">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
					<i class="fa fa-bars fa-2x"></i>
				</button>

				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".search-collapse">
					<span class="sr-only"><?= __('Toggle search', 'sage'); ?></span>
					<i class="fa fa-search fa-2x"></i>
				</button>

				<?php 
				if ( ! function_exists( 'is_plugin_active' ) ) require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
				if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) { ?>
				<div class="langbar">
					<?php do_action('icl_language_selector');  ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 navi">
			<div class="collapse search-collapse">
				<?php get_template_part('templates/searchform'); ?>
			</div>

			<nav class="collapse navbar-collapse" role="navigation">

				<?php
				if (has_nav_menu('primary_navigation')) :
					wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav']);
				endif;
				if ( is_plugin_active( 'google-website-translator/google-website-translator.php' ) && !is_user_logged_in() ) { ?>
				<div style="display:none;"><?php echo do_shortcode('[prisna-google-website-translator]'); ?></div>
				<?php 
			} 
          // elseif (is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' )) {
          //   do_action('icl_language_selector'); 
          // } 
			?>

		</nav>
	</div>
</div>
<?php if ( !is_front_page() )  { ?> 
<div class="row">
	<div class="col-md-12">
		<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
			<?php if(function_exists('bcn_display'))
			{
				bcn_display();
			}?>
		</div>
	</div>
</div>
<?php } ?>
</div>
</header>
