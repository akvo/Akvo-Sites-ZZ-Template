<?php global $akvo;?>
<header class="banner header2" role="banner">
	<div class="container"> 
    	<?php get_template_part('partials/logo-search');?>	
     </div>
     <div>
     	<div class="affix-menu">	
  			<nav class="navbar affix-top" data-spy="affix" data-offset-top="60">
  				
  				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<i class="fa fa-bars fa-2x"></i>
				</button>
			
				<?php if( $akvo->search_flag ):?>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".search-collapse">
					<span class="sr-only">Toggle search</span>
					<i class="fa fa-search fa-2x"></i>
				</button>
				<?php endif;?>
			
  				<?php
            		wp_nav_menu( array(
            			'menu'              => 'primary',
	                	'theme_location'    => 'primary_navigation',
    	            	'depth'             => 2,
        	        	'container'         => 'div',
            	    	'container_class'   => 'collapse navbar-collapse',
	        			'container_id'      => 'bs-example-navbar-collapse-1',
    	            	'menu_class'        => 'nav navbar-nav',
        	        	'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            	    	'walker'            => new wp_bootstrap_navwalker())
            		);
        		?>
  			
			</nav>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1">
			<?php if( $akvo->search_flag ):?>
			<div class="collapse search-collapse">
				<?php get_search_form();?>	
			</div>
			<?php endif;?>
		</div>
	</div>
</header>

