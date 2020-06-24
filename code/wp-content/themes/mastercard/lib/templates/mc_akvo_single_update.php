<?php

	$Parsedown = new Parsedown();



?>
<ol class="breadcrumb" style="margin-bottom: 50px;">
	<li><a href="<?php _e( $this->url('home') );?>">Home</a></li>
	<li><a href="<?php _e( $this->url('updates') );?>">All Updates</a></li>
	<li class='active'><?php echo $project_update->title;?></li>
</ol>
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
	.header4 nav.navbar-fixed-top .navbar-container{ border: none; }
</style>
