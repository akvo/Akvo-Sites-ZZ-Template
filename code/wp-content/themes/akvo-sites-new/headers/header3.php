<header class="banner header3" role="banner">
	<nav class="navbar navbar-default navbar-fixed-top">
  		<div class="container"> 
    		<!-- Brand and toggle get grouped for better mobile display -->
    		<div class="navbar-header">
      			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i> </button>
      			<?php get_template_part('partials/logo');?>
     	 	</div>
    		<!-- Collect the nav links, forms, and other content for toggling -->
    		
    		
    		<?php
            	wp_nav_menu( array(
                	'menu'              => 'primary',
                	'theme_location'    => 'primary_navigation',
                	'depth'             => 2,
                	'container'         => 'div',
                	'container_class'   => 'collapse navbar-collapse',
        			'container_id'      => 'bs-example-navbar-collapse-1',
                	'menu_class'        => 'nav navbar-nav navbar-right',
                	'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                	'walker'            => new wp_bootstrap_navwalker())
            	);
        	?>
    		
    		
    		<!-- /.navbar-collapse --> 
  		</div>
  		<!-- /.container-fluid --> 
	</nav>
</header>
<div style="margin-bottom:90px;"></div>