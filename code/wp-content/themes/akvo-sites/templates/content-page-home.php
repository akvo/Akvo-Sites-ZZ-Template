<?php //the_content(); ?>
<?php //wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>

<?php

$args_carousel = array(
	'post_type' => 'carousel'
);

$query_carousel = new WP_Query( $args_carousel );

if ( $query_carousel->have_posts() ) { ?>
	<div class="col-md-12">
		<div id="main-carousel" class="carousel slide fp" data-ride="carousel">
			<div class="row">
				<div class="carousel-inner" role="listbox">

					<ol class="carousel-indicators">
						<?php
						$j = $query_carousel->post_count;
						for ($k = 0 ; $k < $j; $k++){ 
							if ($k == 0) { $active = 'active'; }
							else { $active = ''; }
							echo '<li data-target="#main-carousel" data-slide-to="'.$k.'" class="'.$active.'"></li>';
						}
						?>
					</ol>
	<?php
		
		$i = 0;

		while ( $query_carousel->have_posts() ) {
			$query_carousel->the_post();
			$content = get_the_content();
			$content = apply_filters( 'the_content', get_the_content() );
			$content = str_replace( ']]>', ']]&gt;', $content );

			$linksto = get_post_meta( get_the_ID(), '_carousel_extra_boxes_url', true );
	?>
					<div class="item <?php if(!empty($linksto)) echo 'clickable '; if($i == 0) echo 'active' ; ?>">
						<?php 
						if(!empty($linksto)) echo '<a href="'.$linksto.'" class="boxlink"></a>';
						?>
						<div class="col-sm-6">
							<div class="pic">
								<?php the_post_thumbnail( 'thumb-large' ); ?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="text">
								<h1><?php echo get_the_title(); ?></h1>
								<?php echo $content; ?>
							</div>
						</div>
					</div>
	<?php
		$i++;				
		} ?>
				</div>
			</div>
		</div>
	</div>
<?php
}

?>
<div class="col-md-12">
	<div class="row eq">
		<?php dynamic_sidebar('sidebar-homepage1'); ?>
	</div>
</div>
<div class="col-md-12">
	<div class="row eq">
		<?php dynamic_sidebar('sidebar-homepage2'); ?>
	</div>
</div>