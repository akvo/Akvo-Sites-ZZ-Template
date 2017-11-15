<?php
	
	$inc_files = array(
		'class-akvo.php',
		'class-akvo-customize.php',
		'class-akvo-fonts.php'
	);
	
	foreach($inc_files as $inc_file){
		include( $inc_file );
	}