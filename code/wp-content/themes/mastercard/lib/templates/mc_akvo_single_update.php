<?php

	$Parsedown = new Parsedown();



?>
<a class='back-btn' href="<?php echo site_url('updates');?>"><i class="fa fa-arrow-left"></i>&nbsp;See All Updates</a>
<section style="max-width: 600px; margin: 50px auto 100px;">
	<h3><?php echo $project_update->title;?></h3>
	<p class="small text-muted"><?php echo "Published on " . $mc_api->get_published_date( $project_update );?></p>
	<?php $featured_image_url = $mc_api->get_photo_url( $project_update ); if( $featured_image_url ):?>
	<img src="<?php echo $featured_image_url;?>" />
	<?php endif;?>
	<div style="margin: 20px 0;"><?php echo $Parsedown->text( $project_update->text );?></div>
	<div id="disqus_thread"></div>
	<script>

	/**
	*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
	*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
	/*
	var disqus_config = function () {
	this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
	this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
	};
	*/
	(function() { // DON'T EDIT BELOW THIS LINE
	var d = document, s = d.createElement('script');
	s.src = 'https://hangaahazaza.disqus.com/embed.js';
	s.setAttribute('data-timestamp', +new Date());
	(d.head || d.body).appendChild(s);
	})();
	</script>
	<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
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
