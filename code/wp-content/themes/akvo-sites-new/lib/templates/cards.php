
<div class="row">
	<?php foreach($data as $item):?>
	
		<div class="col-md-4 eq">
		<?php
			
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
			
			$shortcode = '[akvo-card '.$att_str.']';
			 
			echo do_shortcode($shortcode);
		?>
		</div>
	<?php endforeach;?>
</div>	


<style>
	
</style>