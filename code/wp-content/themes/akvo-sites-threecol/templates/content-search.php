<?php 

$type = get_post_type();
if ($type == 'post') {
	$type = 'news';
}

blokmaker(4, $type);

?>