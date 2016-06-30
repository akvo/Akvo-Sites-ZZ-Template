
    <?php
        global $post_id;
        
        
        $post_type = get_post_type($post_id);
        
        $shortcode = '[akvo-card ';
        
        
        $img = '';
        if ($post_type == 'video') {
    		$img = convertYoutubeImg(get_post_meta( get_the_ID(), '_video_extra_boxes_url', true ));
    	}
    	else{  	
        	$img = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
        }
        
        
        if($img){
        	$shortcode .= 'img="'.$img.'" ';
        }
        
        
        
        $shortcode .= 'title="'.get_the_title().'" date="'.get_the_date().'" content="'.get_the_excerpt().'" link="'.get_the_permalink().'" type="'.$post_type.'"]';
        			
        echo do_shortcode($shortcode);
    ?>
