<form method="GET" data-behaviour='ajax-form' data-target="#archives-container">
	<?php 
		foreach($akvo_filters[$post_type] as $slug => $arr){
			akvo_dropdown_filters($arr);
		}
	?>
	<div class='form-group'>
		<input type="hidden" name="akvo-search" value="1" />
		<button type="submit" class="btn btn-default">Apply Filters&nbsp;<i class="fa fa-refresh"></i></button>
	</div>
</form>