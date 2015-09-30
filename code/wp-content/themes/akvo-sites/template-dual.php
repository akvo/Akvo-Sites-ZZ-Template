<?php
/**
 * Template Name: Dual columns
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'page_dual'); ?>
<?php endwhile; ?>
