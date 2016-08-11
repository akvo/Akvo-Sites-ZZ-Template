<div id="cards-list" data-target=".col-md-4.eq" class="row" data-url="<?php _e($url);?>">
	<?php foreach($data as $item):?>
		<div class="col-md-4 eq">
		<?php
			
			
			//print_r($item);
			
			$att_str = '';
			
			if($item['title']){
				$att_str .= ' title="'.$item['title'].'"';
			}
			
			if($item['date']){
				$att_str .= ' date="'.$item['date'].'"';
			}
			
			if($item['img']){
				$att_str .= ' img="'.$item['img'].'"';
			}	
			
			if($item['content']){
				$att_str .= ' content="'.$item['content'].'"';
			}
			
			if($item['link']){
				$att_str .= ' link="'.$item['link'].'"';
			}
			
			if($item['type']){
				$att_str .= ' type="'.$item['type'].'"';
			}
			
			if($item['type-text']){
				$att_str .= ' type-text="'.$item['type-text'].'"';
			}
			
			$shortcode = '[akvo-card '.$att_str.']';
			 
			//echo $shortcode;
			
			echo do_shortcode($shortcode);
		?>
		</div>
	<?php endforeach;?>
</div>	
<?php if($atts['pagination']):?>
<div class="row">
	<div class="col-sm-12 text-center">
		<button data-behaviour='ajax-loading' data-list="#cards-list" class="btn btn-default">Load more&nbsp;<i class="fa fa-refresh"></i></button>
	</div>
</div>
<?php endif;?>