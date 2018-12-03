<form action="<?php _e( admin_url( 'edit.php?post_type=fb_post&action=import&page='.$_GET['page'] ) );?>" method="POST">
<?php 


	$fbPostsTable = new FB_POSTS_LIST_TABLE;
	
	$fbPostsTable->process_bulk_action();
	
	$fbPostsTable->prepare_items();
	
	
	
	$fbPostsTable->display();
	
	print_r( $_POST );
	
?>
</form>	
<style>
	#image{
		width: 120px;
	}
</style>
	
	
	