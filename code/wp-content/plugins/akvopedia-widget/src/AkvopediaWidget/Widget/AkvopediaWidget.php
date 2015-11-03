<?php

namespace AkvopediaWidget\Widget;

class AkvopediaWidget extends \WP_Widget {

	const AKVOPEDIA_ARTICLE = 'akvopedia_article';

	const COLUMNS = 'akvopedia_columns';

	public function __construct()
	{
		parent::__construct(
			'akvopedia_widget',
			\__('Akvopedia Widget', 'akvopedia'),
			array ('decription' => \__('Display and browse akvopedia articles inside a Wordpress widget.', 'akvopedia'))
		);
	}

	private function c( $field, $instance ) {
		if (isset($this->configuration[$field])) {
			return $this->configuration[$field];
		}
		if (isset($instance[$field])) {
			return $instance[$field];
		}
		return null;
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$title = $this->c(self::AKVOPEDIA_ARTICLE, $instance);
		$id = 'akvopedia-' . $this->id;
		$title_id = 'akvopedia-title-' . $this->id;

		$columns = $this->c(self::COLUMNS, $instance);
		if ($columns < 1 || $columns > 4) {
			$columns = 1;
		}
		$amount = 3 * $columns;
		?>
		<script>
  //<!--
    (function($, document) {
		$(document).ready(function () {
				$('#<?php echo $id; ?>').akvopedia({
					  page: '<?php echo $title; ?>',
					  server: 'https://akvopedia.org'
				});
                $('#<?php echo $id; ?>').on('akvopedia:title-updated', function(event, title) {
					  $('#<?php echo $title_id; ?>').html(title);
				});
		});
    })(jQuery, document);
  //-->
		</script>
		<div class="col-md-<?php echo $amount; ?> eq">
          <div class="box-wrap dyno <?php if(\is_front_page()) echo 'home'; ?>">
		    <div class="header-wrap">
              <h2 id="<?php echo $title_id ?>"><?php echo $title; ?></h2>
            </div>
		    <div class="infobar akvopedia">
	          <span>&nbsp;</span>
              <span class="type"><span>Akvopedia</span></span>
		    </div>
		    <div class="embedded-akvopedia" id="<?php echo $id ?>"><noscript><iframe style="position: absolute; top: 4em; right:1em; left:1em; bottom:1em; height:90%; width:97%;" src="http://akvopedia.org/contentonly/<?php echo $title ?>"></iframe></noscript></div>
		   </div>
	    </div>
		<?php
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		$w = (array) $instance;
		$w = array_merge( array(
				self::AKVOPEDIA_ARTICLE => 'Main Page',
				self::COLUMNS => 1
			), $w);
		$this->text_field( self::AKVOPEDIA_ARTICLE, \__('Akvopedia article:', 'akvopedia'), $w);
		$this->select_field( self::COLUMNS, \__('Columns:', 'akvopedia'), $w,  array(
				1 => 1,
				2 => 2,
				3 => 3,
				4 => 4,
			));
	}

	private function field( $field, $label, $instance, $template ) {
		if (isset($this->configuration[$field])) {
			return;
		}
		$id = $this->get_field_id( $field );
		$name = $this->get_field_name( $field );
		$label = \esc_html($label);
		$value = \esc_attr($instance[$field]);
		echo '<!-- '  . 'return "' . $template . '";' . '-->';
		echo eval ('return "' . $template . '";');
	}

	private function text_field( $field, $label, $instance ) {
		$this->field( $field, $label, $instance,
		'<p><label for=\"$id\">$label</label><input id=\"$id\" name=\"$name\" type=\"text\" value=\"$value\" class=\"widefat\" style=\"width:100%;\" /></p>' );
	}

	private function option( $key, $value, $selected )
	{
		return '<option ' . ( $selected ? 'selected=\"selected\" ' : '' )  . "value=\\\"$value\\\">$key</option>";
	}

	private function select_field( $field, $label, $instance, $options ) {
		$template = '<label for=\"$id\">$label</label><select id=\"$id\" name=\"$name\" class=\"widefat\" style=\"width:100%;\">';
		foreach ($options as $key => $value) {
			$template .= $this->option( $key, $value, $instance[$field] == $value );
		}
		$template .= '</select></p>';
		$this->field( $field, $label, $instance, $template );
	}


	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		return array_merge($old_instance, $new_instance);
	}

}