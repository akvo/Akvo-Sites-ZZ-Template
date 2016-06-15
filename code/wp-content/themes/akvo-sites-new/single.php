<?php get_header();?>
	<div class="container" id="main-page-container">
		<div class="row">
			<div class="col-md-12">
				<?php if(have_posts()):?>
         			<?php while ( have_posts() ) : the_post();?>
         			<div class="col-lg-10 col-lg-offset-1">
          				<header>
            				<h1 class="entry-title" id="akvopedia-title-219">Water Portal</h1>
          </header>
        </div>
         			
         			
         				<?php the_title();?>
         				<?php the_content();?>
            		<?php endwhile;?>
          		<?php endif;?>
         	</div>
		</div>
	</div><!-- End of Main Body Content -->
<?php get_footer();?>	
	
	