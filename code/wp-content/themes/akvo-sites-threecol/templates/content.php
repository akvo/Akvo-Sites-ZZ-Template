<?php 
$type = get_post_type();
if ($type == 'post') {
	$type = 'news';
}
if ($filter == true) {
	blokmaker(6,$type);
}
else {
	blokmaker(4, $type);
}
?>