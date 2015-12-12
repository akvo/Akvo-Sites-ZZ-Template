<?php get_template_part('templates/page', 'header'); ?>
<?php if (!have_posts()) : ?>
	<div class="alert alert-warning">
		<?php _e('Sorry, no results were found.', 'sage'); ?>
	</div>
<?php endif; ?>
<?php 

if ( is_post_type_archive('media') ) $type = 'media';
elseif ( is_post_type_archive('blog') ) $type = 'blog';
elseif ( is_post_type_archive('video') ) $type = 'video';
elseif ( is_post_type_archive('map') ) $type = 'map';
elseif ( is_post_type_archive('testimonial') ) $type = 'testimonial';
elseif ( is_post_type_archive('flow') ) $type = 'flow';
else $type = 'post';

if ( $type == 'post' || $type == 'blog' ) {

	//query voor sticky/featured voor in de top balk
	$args = array(
		'post_type' => $type,
		'posts_per_page' => 1,
		'meta_key'  => '_post_extra_boxes_checkbox',
		'meta_value' => 'on'
		);

	// $arg2 = array(
	// 	'post_type' => $type,
	// 	'posts_per_page' => 9,
	// );

	$query = new WP_Query( $args );
	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) : $query->the_post();
	?>

	<div class="col-md-12">
		<div class="row carousel eq clickable featured">
			<a href="<?php the_permalink(); ?>" class="boxlink"></a>
			<div class="col-sm-6 eq">
				<div class="text">
					<h1><?php echo truncate(get_the_title(),45); ?></h1>
					<?php the_excerpt(); ?>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="pic">
					<?php 
					if (has_post_thumbnail()) {
						the_post_thumbnail( 'thumb-large' ); 
					}
					else {
						?><img src="<?= get_template_directory_uri(); ?>/dist/images/placeholder800x400.jpg"><?php
					}
					?>
				</div>
			</div>
		</div>
	</div>

<?php endwhile; ?>


<?php wp_reset_postdata(); ?>

<?php else : ?>
	
<?php endif; ?>


<?php } 
ob_start();
dynamic_sidebar('sidebar');
$sidebar = ob_get_clean();  // get the contents of the buffer and turn it off.
if ($sidebar) { 
	$filter = true;
	$class_col = 'col-md-9';
}
else{
	$filter = false; 
	$class_col = 'col-md-12';
}
?>
<div class="<?php echo $class_col;?>">
	<div class="row" id="searchcontent">
		<?php 
		while (have_posts()) : the_post(); 
		if ( get_post_meta( get_the_ID(), '_post_extra_boxes_checkbox', true ) != 'on') {
			set_query_var( 'filter', $filter );
			get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format());
		}
		endwhile; 
		?>
	</div>
</div>

<?php
ob_start();
dynamic_sidebar('sidebar');
$sidebar = ob_get_clean();  // get the contents of the buffer and turn it off.
if ($sidebar) { ?>
<div class="col-md-3" id="siderbar">
	<?php dynamic_sidebar( 'sidebar' ); ?>
</div>
<?php }
?>

<div class="col-md-12 text-center">
	<?php //wp_pagenavi(); ?>
</div>
