<?php
	
	$inc_files = array(
		'colors.php', 
		'events.php', 
		'header-menu.php', 
		'logo.php', 
		'article.php', 
		'search.php',
		'external-assets.php',		// HEADER AND FOOTER SECTION
		'fonts.php',
		'carousel.php'
	);
	
	foreach($inc_files as $inc_file){
		include( $inc_file );
	}
		