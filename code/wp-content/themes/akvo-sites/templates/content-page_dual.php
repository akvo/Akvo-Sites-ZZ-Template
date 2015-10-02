<?php 
$yt = get_post_meta( get_the_ID(), '_channels_youtube', true );
$flickr = get_post_meta( get_the_ID(), '_channels_flickr', true );
$flickr_handle = get_post_meta( get_the_ID(), '_channels_flickr_handle', true );

?>

<div class="col-md-12 article">
	<div class="bg">
        <div class="main-image">
          <?php
            $map = get_post_meta( get_the_ID(), '_map_option_address', true );
            if(!empty($map)) {
                flexmap_show_map(array(
                    'width' => '100%',
                    'height' => '400px',
                    'address' => $map
                ));
            } 
            else {
                the_post_thumbnail( 'large' ); 
            }
        ?>
        </div>

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
            	<?php use Roots\Sage\Titles; ?>
        		<h1><?= Titles\title(); ?></h1>
            </div>
            <div class="col-lg-8 col-lg-offset-2">
                <div class="meta single"></div>
            </div>
            <div class="col-lg-10 col-lg-offset-1">
                <div class="entry-content dual">
                 	<?php the_content(); ?>
                </div>
            </div>

            <?php if (!empty($yt)) { ?>
            <div class="col-lg-12">
                <?php echo do_shortcode($yt); ?>
            </div>
            <?php } ?>

            <?php if (!empty($flickr)) { ?>
            <div class="col-lg-12">
                <?php echo show_flickr($flickr,$flickr_handle); ?>
            </div>
            <?php } 
            $url = get_post_meta( get_the_ID(), '_flow_url_url', true );
            if (!empty($url)) {
            ?>
            <div class="col-md-12">
                <div style="padding:0 15px 5px 15px;">
                    <iframe id="responive_iframe" src="<?php echo $url; ?>" frameborder="0" allowfullscreen width="100%" scrolling="no"></iframe>
                    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/scripts/iframeResizer.min.js"></script>
                    <script>iFrameResize({log:false})</script>
                </div>
            </div>
            <?php } ?>
            <?php
            $url_iframe = get_post_meta( get_the_ID(), '_iframe_url_url', true );
            $url_iframe_ht = get_post_meta( get_the_ID(), '_iframe_url_pix', true );
            if (!empty($url_iframe)) {
            ?>
            <div class="col-md-12">
                <div style="padding:0 15px 5px 15px;">
                    <iframe src="<?php echo $url_iframe; ?>" frameborder="0" width="100%" height="<?php echo $url_iframe_ht; ?>" scrolling="auto"></iframe>
                </div>
            </div>
            <?php } ?>
        </div>
	</div>
</div>