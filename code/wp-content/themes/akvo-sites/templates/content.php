<?php 
$type = get_post_type();
if ($type == 'post') {
	$type = 'news';
}
if ($filter == true) {
	blokmaker(4,$type);
}
else {
	blokmaker(3, $type);
}
?>