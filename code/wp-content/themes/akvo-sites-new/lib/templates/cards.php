<ul class='list-inline text-center'>
	<?php foreach($data as $item):?>
	<li>
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
	</li>
	<?php endforeach;?>
</ul>

<style>
	.card{
		text-align: left;
		margin: 10px 5px;
		padding: 20px;
		width:340px;
		font-size: 14px;
		border-radius: 5px;
		background: #f2f2f2;
		height: 440px;
		overflow: hidden;
	}
	.card .card-title{
		margin: 0;
		font-size: 24px;
		height: 56px;
		overflow: hidden;
	}
	
	
	.card .card-info{
		margin: 15px -20px;
		padding: 10px 20px;
		background: #54bce8;
		color: #FFF;
	}
	
	.card .card-image{
		width: 100%;
		height: 150px;
		background-size: cover;
		background-position: center;
		margin: 20px 0;
		
	}
	.card .card-content{
		overflow: hidden;
		max-height: 90px;
	}
	
	.card a[href]{
		text-decoration: none;
		color: inherit;
	}
	
	@media(max-width: 767px){
		.card{
			height: auto;
			width: 100%;
		}
		
		.card .card-title, .card .card-content{
			height: auto;
			overflow: visible;
		}
		.card .card-image{
			height: 250px;
		}	
	}
</style>