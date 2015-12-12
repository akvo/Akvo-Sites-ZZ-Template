<?php
$attached = get_post_meta( get_the_ID(), 'attached_cmb2_attached_posts', true );

$yt = get_post_meta( get_the_ID(), '_channels_youtube', true );
$flickr = get_post_meta( get_the_ID(), '_channels_flickr', true );
$flickr_handle = get_post_meta( get_the_ID(), '_channels_flickr_handle', true );

ob_start();
dynamic_sidebar('sidebar');
$sidebar = ob_get_clean();  // get the contents of the buffer and turn it off.
if ($sidebar) { ?>
<div class="col-md-9">
<?php } else { ?>
<div class="col-md-12">
<?php } ?>
  <?php while (have_posts()) : the_post(); 
  $type = get_post_type();
  $titleAttrs = '';
  if ($type == 'akvopedia') {
    $akvopedia_title_id = 'akvopedia-title-' . get_the_ID();
    $akvopedia = true;
    $titleAttrs = ' id="' . $akvopedia_title_id . '"';
  }
  ?>
  <article <?php post_class(); ?>>
    <div class="bg">
      <?php if ($type != 'media') { ?>
      <div class="main-image">
        <?php 
        if (in_array($type, array('video','testimonial'), true )) {
          $url = convertYoutube(get_post_meta( get_the_ID(), '_video_extra_boxes_url', true ));
          ?>
          <div class='embed-container'>
            <?php echo $url; ?>
          </div>
          <?php
        }
        else {
          $map = get_post_meta( get_the_ID(), '_map_option_address', true );
          if(!empty($map)) {
              flexmap_show_map(array(
                  'width' => '100%',
                  'height' => '400px',
                  'address' => $map
              ));
          }
          else {
            the_post_thumbnail( 'full' );
          }
        }        
        ?>
      </div>
      <?php } ?>
      <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
          <header>
            <h1 class="entry-title"<?php echo $titleAttrs;?>><?php the_title(); ?></h1>
          </header>
        </div>
        <div class="col-lg-12">
          <div class="meta">
            <div class="row">
              <div class="col-lg-10 col-lg-offset-1">
                <?php get_template_part('templates/entry-meta'); ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-10 col-lg-offset-1">
          <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
              <div class="entry-content">
                <?php the_content();
                if ($type == 'media') {
                  $id = get_the_ID();
                  $author = get_post_meta( $id, '_media_lib_author', true );
                  $dld = get_post_meta( $id, '_media_lib_file', true );
                  $filename = basename($dld).PHP_EOL;
                  $dld2 = get_post_meta( $id, '_media_lib_file2', true );
                  $filename2 = basename($dld2).PHP_EOL;
                  $dld3 = get_post_meta( $id, '_media_lib_file3', true );
                  $filename3 = basename($dld3).PHP_EOL;
                  $dld4 = get_post_meta( $id, '_media_lib_file4', true );
                  $filename4 = basename($dld4).PHP_EOL;
                  $filearray = array(
                    $dld => $filename,
                    $dld2 => $filename2,
                    $dld3 => $filename3,
                    $dld4 => $filename4
                  );
                  $location = get_the_terms( $id, 'countries' );
                  $language = get_the_terms( $id, 'languages' );
                  $category = get_the_terms( $id, 'category' );
                  $type_tax = get_the_terms( $id, 'types' );
                  if (!empty($author)) { ?>
                  <p><b>Author</b>: <?php echo $author;?></p>
                  <?php } 
                  if (!empty($location)) { ?>
                  <p><b>Location</b>: <?php 
                  foreach($location as $loc) {
                    echo $loc->name;
                  }
                  ?></p>
                  <?php }
                  if (!empty($language)) { ?>
                  <p><b>Language</b>: <?php 
                  foreach($language as $lang) {
                    echo $lang->name;
                  }
                  ?></p>
                  <?php }
                  if (!empty($category)) { ?>
                  <p><b>Category</b>: <?php 
                  foreach($category as $cat) {
                    echo $cat->name;
                  }
                  ?></p>
                  <?php }
                  if (!empty($type_tax)) { ?>
                  <p><b>Type</b>: <?php 
                  foreach($type_tax as $type) {
                    echo $type->name;
                  }
                  ?></p>
                  <?php } ?>
                  <p>
                  <?php 
                  foreach ($filearray as $file => $name) {
                    if (!empty($file)) {
                      echo "<a href=\"$file\" class=\"btn btn-default\">$name</a> ";
                    }
                  }
                  ?>
                  </p>
                  <?php
                } ?>
                
              </div>
            </div>
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
            <?php } ?>

        <?php if (in_array($type, array('post','map','flow') )) {
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
          <?php
          }
          $url_iframe = get_post_meta( get_the_ID(), '_iframe_url_url', true );
          $url_iframe_ht = get_post_meta( get_the_ID(), '_iframe_url_pix', true );
          if (!empty($url_iframe)) {
          ?>
          <div class="col-md-12">
              <div style="padding:0 15px 5px 15px;">
                  <iframe src="<?php echo $url_iframe; ?>" frameborder="0" width="100%" height="<?php echo $url_iframe_ht; ?>" scrolling="auto"></iframe>
              </div>
          </div>
          <?php }
        } ?>
      </div>
    </div>

    <?php if ($type == 'post' || $type == 'blog') { ?>
      <?php comments_template('/templates/comments.php'); ?>
    <?php } ?>

  </article>
</div>
<?php endwhile; ?>

<?php
ob_start();
dynamic_sidebar('sidebar');
$sidebar = ob_get_clean();  // get the contents of the buffer and turn it off.
if ($sidebar) { ?>
<div class="col-md-3" id="siderbar">
  <?php dynamic_sidebar( 'sidebar' ); ?>
</div>
<?php }
?>
