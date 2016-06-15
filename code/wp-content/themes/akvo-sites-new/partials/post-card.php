
    <?php
        global $post_id;
        $shortcode = '[akvo-card ';
          	
        $img = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
        if($img){
        	$shortcode .= 'img="'.$img.'" ';
        }
        $shortcode .= 'title="'.get_the_title().'" date="'.get_the_date().'" content="'.get_the_excerpt().'" link="'.get_the_permalink().'"]';
        			
        echo do_shortcode($shortcode);
    ?>
