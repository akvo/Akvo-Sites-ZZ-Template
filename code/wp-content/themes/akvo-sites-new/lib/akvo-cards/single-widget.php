<?php
	
	add_action( 'widgets_init', create_function( '', 'register_widget("post_widget");' ) );
	/**
 	* Adds widget.
 	*/
	class post_widget extends WP_Widget {

		/**
		* Widget setup.
		*/
		function __construct() {
    		
    		$widget_ops = array(
            	'classname' => 'single_post',
            	'description' => 'Displays a single post widget'
        	);

        	parent::__construct( 'post_widget', 'Single Post Widget', $widget_ops );

    		
    		
		}

		/**
		* How to display the widget on the screen.
		*/
		function widget( $args, $instance ) {
    
			extract( $args );
    
			static $counters = array();

			if (!isset($counters[$instance['type']])) {
      			$counters[$instance['type']] = 0;
    		}
			$url = admin_url('admin-ajax.php')."?action=akvo_card&type=".$instance['type']."&offset=".$counters[$instance['type']]."&rsr-id=".$instance['rsr-id'];
			
			
			
			echo "<div data-behaviour='reload-html' data-url='".$url."'></div>";
			
    		$counters[$instance['type']]++;
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
				'media' => 'Media Library'
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
	
	
	/* register Foo_Widget widget
	function register_post_widget() {
    	register_widget( 'post_widget' );	
    }
	add_action( 'widgets_init', 'register_post_widget' );
	*/
?>