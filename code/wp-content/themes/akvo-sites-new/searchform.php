<?php global $akvo;?>
<div class="search-wrap">
	<form role="search" method="get" class="search-form form-inline" action="<?php _e(esc_url(home_url('/'))); ?>">
	  <label class="sr-only"><?php _e('Search for:', 'sage'); ?></label>  
	    <input type="search" value="<?php _e(get_search_query()); ?>" name="s" class="search-field form-control" placeholder="<?php _e( $akvo->header_options['search_text'] );?>" required>
	    <span class="input-group-btn">
	      <button type="submit" class="search-submit btn btn-default"><i class="fa fa-search"></i></button>
	    </span>
	</form>
</div>
