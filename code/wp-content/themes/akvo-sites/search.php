<?php get_template_part('templates/page', 'header'); ?>

<div class="col-md-12">

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
<?php endif; ?>

<div class="row">

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'search'); ?>
<?php endwhile; ?>

</div>

</div>

<div class="col-md-12 text-center">
<?php wp_pagenavi(); ?>
</div>