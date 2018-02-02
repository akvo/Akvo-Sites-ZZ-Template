<div id="cards-list" data-target=".col-md-4.eq" class="row" data-url="<?php _e($url);?>" data-paged="akvo-paged">
	<?php foreach($data as $item):?>
		<div class="col-md-4 eq">
		<?php
			$shortcode = '[akvo-card';
			foreach($item as $key=>$val){
				$shortcode .= ' '.$key.'="'.$val.'"';	
			}
			$shortcode .= ']';
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