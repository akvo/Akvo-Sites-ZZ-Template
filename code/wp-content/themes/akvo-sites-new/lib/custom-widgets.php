<?php

	//weg met de default zooi
	function remove_default_widgets() {
     	unregister_widget('WP_Widget_Pages');
     	unregister_widget('WP_Widget_Calendar');
     	unregister_widget('WP_Widget_Archives');
     	unregister_widget('WP_Widget_Links');
     	unregister_widget('WP_Widget_Meta');
     	unregister_widget('WP_Widget_Search');
     	//unregister_widget('WP_Widget_Text');
     	unregister_widget('WP_Widget_Categories');
     	unregister_widget('WP_Widget_Recent_Posts');
     	unregister_widget('WP_Widget_Recent_Comments');
     	unregister_widget('WP_Widget_RSS');
     	unregister_widget('WP_Widget_Tag_Cloud');
     	unregister_widget('WP_Nav_Menu_Widget');
	

 	}
	add_action('widgets_init', 'remove_default_widgets', 11);

	/**
 	* Adds widget.
 	*/
	class post_widget extends WP_Widget {

		/**
		* Widget setup.
		*/
		function post_widget() {
    		/* Widget settings. */
    		$widget_ops = array( 'classname' => 'single_post', 'description' => __('Displays a single post widget', 'single_post') );
			
    		/* Widget control settings. */
    		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'single-post' );

    		/* Create the widget. */
    		$this->WP_Widget( 'single-post', __('Single post', 'post_widget'), $widget_ops, $control_ops );
		}

		/**
		* How to display the widget on the screen.
		*/
		function widget( $args, $instance ) {
    
			extract( $args );
    
			static $counters = array();

			/* Our variables from the widget settings. */
    		//$columns = $instance['columns'];
    		
    		$type = $instance['type'];
    		$type2 = $type;
    		
    		/*
    		if ($type == 'news') {
      			$type2 = 'post';
    		}
    		*/
    		if (!isset($counters[$type2])) {
      			$counters[$type2] = 0;
    		}

    		/* Before widget (defined by themes). */
    		//echo $before_widget;

    		//rsr update gedoe
			
			/*
			if ($columns == 4) {
				$amount = 12;
			}
			elseif ($columns == 2) {
				$amount = 6;
			}
			elseif ($columns == 3) {
				$amount = 9;
			}
			else {
				$amount = 3;
			}
			*/
			
			

			if ($type == 'project') {
				$c = $counters[$type2];
				$date_format = get_option( 'date_format' );
				$data = do_shortcode('[data_feed name="'.$instance['rsr-id'].'"]');
				$data = json_decode( str_replace('&quot;', '"', $data) );
				$objects = $data->results;
				$title = $objects[$c]->title;
				$text = $objects[$c]->text;
				$date = date($date_format,strtotime($objects[$c]->created_at));
				$thumb = 'http://rsr.akvo.org'.$objects[$c]->photo;
				$link = 'http://rsr.akvo.org'.$objects[$c]->absolute_url;
				$type = 'RSR update';

      			echo do_shortcode('[akvo-card title="'.$title.'" type="RSR Update" link="'.$link.'" img="'.$thumb.'" content="'.$text.'" date="'.$date.'"]');	
    		}
			else {
      			$qargs = array(
        			'post_type' => $type2,
        			'posts_per_page' => 1,
        			'offset' => $counters[$type2],
      			);
      			$query = new WP_Query( $qargs );
      			
      			if ( $query->have_posts() ) { 
        			while ( $query->have_posts() ) {
						$query->the_post();
          				get_template_part( 'partials/post', 'card' );
        			}
        			wp_reset_postdata();
      			}
    		}

    		$counters[$type2]++;
		}

  		/**
   		* Update the widget settings.
   		*/
  		function update( $new_instance, $old_instance ) {
    		$instance = $old_instance;
			
			/* Strip tags for title and name to remove HTML (important for text inputs). */
    		$instance['type'] = $new_instance['type'];
    		$instance['rsr-id'] = $new_instance['rsr-id'];
    		
			return $instance;
  		}

  		/**
   		* Displays the widget settings controls on the widget panel.
   		* Make use of the get_field_id() and get_field_name() function
   		* when creating your form elements. This handles the confusing stuff.
   		*/
		function form( $instance ) {

    		/* Set up some default widget settings. */
    		$defaults = array( 'type' => 'news', 'rsr-id' => 'rsr'); // , 'columns' => '1');
			$instance = wp_parse_args( (array) $instance, $defaults ); 
		
			$post_type_arr = array(
				'news' => 'News',
				'blog' => 'Blog',
				'video' => 'Videos',
				'testimonial' => 'Testimonials',
				'project' => 'RSR Updates',
				'map' => 'Maps',
				'flow' => 'Flow',
				'other' => 'Other'
			);
		
		?>
    		<p>
      			<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e('Type:', 'single_post'); ?></label> 
      			<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat" style="width:100%;">
      				<?php foreach($post_type_arr as $post_type => $val):?>
      				<option <?php if ($post_type == $instance['type']) echo 'selected="selected"'; ?> value="<?php _e($post_type);?>"><?php _e($val);?></option>
        			<?php endforeach;?>
        		</select>
    		</p>
    		
    		<p>
      			<label for="<?php echo $this->get_field_id('rsr-id'); ?>"><?php _e('RSR ID (from data-feed):', 'single_post'); ?></label> 
      			<input id="<?php echo $this->get_field_id('rsr-id'); ?>" type='text' name="<?php echo $this->get_field_name('rsr-id'); ?>" value="<?php _e($instance['rsr-id']);?>" />
      		</p>
      		
    		
			<?php
		}
	}


	// register Foo_Widget widget
	function register_post_widget() {
    	register_widget( 'post_widget' );	
	}
	add_action( 'widgets_init', 'register_post_widget' );

?>