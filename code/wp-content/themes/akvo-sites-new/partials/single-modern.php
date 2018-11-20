<div class='container-fluid' id="main-page-container">
	<?php if( have_posts() ): while( have_posts() ) : the_post();?>
	<?php
		
		$url = get_bloginfo('template_directory')."/dist/images/brushrepeat.jpg";
		
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $image_size );
		if( is_array( $thumbnail ) ){
			$url = $thumbnail[0];
		}
	
	?>
	
	<div class='hero-image' style="background-image:url(<?php _e( $url );?>)">
		<div class='container'> 
			<div class="caption">
				<h1><?php the_title();?></h1>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class='post-content'>
					<div class='author-info'>Written by <?php the_author();?> on <?php the_date();?></div>
					<?php the_content();?>
					<?php comments_template(); ?>
				</div>
			</div>
		</div>
	</div>
	<?php endwhile; endif; ?>
</div>
<style>
	
	body.single-post.body-header5 #main-page-container{
		padding-left: 0;
		padding-right: 0;
	}
	
	.hero-image{
		background-repeat: repeat;
	}
	.hero-image .container{
		position: relative;
		height: 100vh;
	}
	.hero-image .caption{
		position: absolute;
		bottom: 10%;
		left: 0;
		box-sizing: border-box;
		z-index: 10;
	}
	.hero-image h1{
		padding-left: 5px;
		padding-right: 5px;
		font-size: 70px;
		line-height: 1.4;
		background: #fff;
	}
	
	.single .author-info{
		margin: 20px 0;
	}
	
	.single .post-content{
		padding: 20px 0;
	}
	
	.single .entry-content{
		padding: 15px 0;
	}
</style>