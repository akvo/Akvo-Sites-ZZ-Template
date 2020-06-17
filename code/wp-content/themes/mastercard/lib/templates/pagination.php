<nav data-list="#cards-list" class="navigation pagination" role="navigation" aria-label="Posts" data-behaviour="ajax-pagination">
	<h2 class="screen-reader-text">Posts navigation</h2>
	<div class="nav-links">
		<?php if( $current_page != 1 ):?>
    <a class="next page-numbers" data-page="<?php _e( $current_page - 1 );?>" href="?<?php _e( 'card-page=' . ($current_page - 1) );?>">Previous</a>
    <?php endif; ?>
    <?php
      $mid_size = 1;
      for( $i = 1; $i <= $num_pages; $i++ ){
        if( ( $i == 1 ) || ( $i == $current_page - $mid_size ) || ( $i == $current_page ) || ( $i == $current_page + $mid_size ) || ( $i == $num_pages ) ){

          if( ( $i == $current_page - $mid_size && $i != 1 ) || ( $i == $current_page + $mid_size && $i != $num_pages ) ){
            echo '<span class="page-numbers dots">…</span>';
          }
          elseif ( $i == $current_page ) {

            if( $i-1 > 1  ){
                $this->page_num( $i-1, $current_page );
            }
            $this->page_num( $i, $current_page );
            if( $i+1 < $num_pages  ){
              $this->page_num( $i+1, $current_page );
            }
          }
          else{
            $this->page_num( $i, $current_page );
          }
        }
      }
    ?>
    <?php if( $current_page != $num_pages ):?>
    <a class="next page-numbers" data-page="<?php _e( $current_page + 1 );?>" href="?<?php _e( 'card-page=' . ( $current_page + 1 ) );?>">Next</a>
    <?php endif;?>
  </div>
</nav>
<style>
	nav.navigation.pagination{ background: none;  }

	nav.navigation.pagination .page-numbers {
		color: #fe9c15;
    text-decoration: none;
    display: inline-block;
    padding: 7px 10px;
    margin: 0 2px 0 0;
    line-height: 1;
    border-radius: 50%;
	}
	nav.navigation.pagination .page-numbers.dots{ color: #999; }
	nav.navigation.pagination .page-numbers.current, nav.navigation.pagination .page-numbers:hover {
		background: #eee;
	}
	nav.navigation.pagination .page-numbers.prev, nav.navigation.pagination .page-numbers.next {
    text-decoration: underline;
    padding: 7px 0;
	}
	nav.navigation.pagination .page-numbers.dots:hover, nav.navigation.pagination .page-numbers.prev:hover, nav.navigation.pagination .page-numbers.next:hover {
    background: none;
	}
</style>
