<?php 


	$fbPostsTable = new FB_POSTS_LIST_TABLE;
	
	$fbPostsTable->prepare_items();
	
	$fbPostsTable->search_box( 'Search', 'search-id' );
	
	$fbPostsTable->display();
	
	
	
	/*
	try {
	
		$data = $this->getPagePosts();
		
		if( isset( $data['data'] ) ):?>
			
		<table>
			
		<?php foreach( $data['data'] as $fb_post ){
				echo "<li>";
				echo "<a href='".$fb_post['link']."'>".$fb_post['message']."</a>";
				echo "</li>";
			}
			
			echo "</ul>";
		?>
		
		</table>
		
		<?php endif;
		
		
		
	}catch( Exception $e ){
		print_r( $e );
	} 
	*/
	
	