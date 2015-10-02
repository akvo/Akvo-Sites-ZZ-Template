<?php 

$type = get_post_type();
if ($type == 'post') {
	$type = 'news';
}

blokmaker(3, $type);

?>