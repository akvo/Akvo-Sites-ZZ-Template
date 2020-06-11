<?php

	$update_id = isset( $_GET['id'] ) && $_GET['id'] ? $_GET['id'] : 0;

	if( !$update_id ) return;

	$url = "https://rsr.akvo.org/rest/v1/project_update/?format=json&image_thumb_name=big&id=" . $update_id;

	global $mc_api;

	$response = $mc_api->response( $url );

	$project_update = isset( $response->results ) && count( $response->results ) ? $response->results[0] : array();

	if( is_array( $project_update ) ) return;

	//print_r( $project_update );
?>
<a class='back-btn' href="<?php bloginfo('url');?>"><i class="fa fa-arrow-left"></i>&nbsp;Go Back</a>
<section style="max-width: 600px; margin: 50px auto 100px;">
	<h3><?php echo $project_update->title;?></h3>
	<p class="small text-muted"><?php echo "Published on " . $mc_api->get_published_date( $project_update );?></p>
	<?php $featured_image_url = $mc_api->get_photo_url( $project_update ); if( $featured_image_url ):?>
	<img src="<?php echo $featured_image_url;?>" />
	<?php endif;?>
	<div style="margin: 20px 0;"><?php echo nl2br( $project_update->text );?></div>
	<div id="disqus_thread"></div>
	<script>
    /**
     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
     */
		var disqus_config = function () {
        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };

    (function() {  // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');

        s.src = 'https://vineyardhome.disqus.com/embed.js';

        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
	</script>
	<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
</section>
<style>
	.back-btn, .back-btn:hover{
		color: #fe9c15;
		border: #fe9c15 solid 1px;
		padding: 10px;
		text-decoration: none;
	}
	.header4 nav.navbar-fixed-top .navbar-container{ border: none; }
</style>
