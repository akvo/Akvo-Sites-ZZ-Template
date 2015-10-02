<?php
$type=get_post_type(); 
if($type == 'post') $type='news';

?>

<time class="updated date" datetime="<?= get_the_time('c'); ?>"><?= get_the_date(); ?></time>
<span <?php post_class('type'); ?>><?php _e($type, 'sage'); ?></span>
<!-- <span class="byline author vcard"><?= __('By', 'sage'); ?> <?= get_the_author(); ?></span>
 --><div class="social">
	<?php if (function_exists('synved_social_share_markup')) echo synved_social_share_markup(); ?>
</div>