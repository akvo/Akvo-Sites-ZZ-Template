<header id="top" role="banner" class="header4">
	<nav id="header" class="navbar navbar-fixed-top">
		<div id="header-container" class="container navbar-container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="logobrand">
					<a id="brand" class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php bloginfo('template_url'); ?>/images/logos/akvologowhite.png">
					</a>
				</div>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<?php 
					wp_nav_menu( array( 
						'theme_location' 	=> 'header-menu', 
						'menu_id' 			=> 'menu-main', 
						'menu_class' 		=> 'nav navbar-nav',
						'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
						'walker'            => new WP_Bootstrap_Navwalker(),
					) ); 
				?>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#search"><i class="fa fa-search" aria-hidden="true"></i></a></li>
				</ul>
			</div>
		</div><!-- /.container -->
	</nav><!-- /.navbar -->
</header>
<div id="search">
	<button type="button" class="close">×</button>
	<?php get_search_form(); ?>
</div>
<!-- Progress Bar -->
<progress value="0" id="progressBar">
	<div class="progress-container">
		<span class="progress-bar"></span>
	</div>		
</progress>