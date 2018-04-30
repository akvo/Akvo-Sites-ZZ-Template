<form method="GET" data-behaviour='ajax-form' data-target="#archives-container">
	<?php 
		foreach($akvo_filters[$post_type] as $slug => $arr){
			akvo_dropdown_filters($arr);
		}
		
		$btn_text = 'Apply Filters';
		
		$custom_btn_text = get_option('akvo_filter_btn_text');
		if($custom_btn_text){
			$btn_text = $custom_btn_text;
		}
		
		global $akvo_filters_sort;
		
	?>
	
	<div class='form-group'>
		<label>Sort by</label>
		<select name="akvo_sort" class='form-control'>
			<?php for( $i = 0; $i < count( $akvo_filters_sort ) ; $i++ ):?>
			<option <?php if( isset( $_REQUEST['akvo_sort'] ) && ( $i == $_REQUEST['akvo_sort'] ) ){ _e("selected='selected'"); }?> value='<?php _e( $i );?>'><?php _e( $akvo_filters_sort[ $i ] );?></option>
			<?php endfor;?>
		</select>
	</div>
	
	<div class='form-group'>
		<input type="hidden" name="akvo-search" value="1" />
		<button type="submit" class="btn btn-default"><?php _e($btn_text);?>&nbsp;<i class="fa fa-refresh"></i></button>
	</div>
</form>