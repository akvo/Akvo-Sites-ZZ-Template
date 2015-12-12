<?php

namespace AkvopediaWidget\Gadget;

class AkvopediaGadget {

	private $options;

	private $title;

	private $title_id;

	private $div_id;

	private $clazz;

	private static $gadget_loaded = false;

	public function __construct( $title, $title_id, $div_id, $options = array(), $clazz = null )
	{
		$this->title = $title;
		$this->title_id = $title_id;
		$this->div_id = $div_id;
		$this->options = $options;
		$this->options['page'] = $title;
		$this->clazz = $clazz == null ? 'embedded-akvopedia' : $clazz;
	}

	private function javascript() {
		$script = "//<!--\n" .
			'(function($, document) {' .
			'    var init = function() { ' .
			'    $("#' . $this->div_id . '").akvopedia({';
		$first = true;
		foreach ($this->options as $key => $value ) {
			if ($first) {
				$first = false;
			} else {
				$script .= ',';
			}
			$script .=
				$key . ': ';
			if (is_bool( $value )) {
				$script .= $value ? 'true' : 'false';
			} else if (is_array( $value )) {
				$script .= '[';
				foreach ( $value as $val ) {
					$script .= '"' . $val . '"';
				}
				$script .= ']';
			} else if ( $key == 'scrollToElement' ) {
				$script .= '$("' . $value . '")';
			} else {
				$script .= '"' . $value . '"';
			}
		}
		$script .=
			'    });' .
			'    $("#' . $this->div_id . '").on("akvopedia:title-updated", function(event, title) {' .
			'       $("#' . $this->title_id . '").html(title);' .
			'    });' .
			'  };' .
			'  $(document).ready(function () {' .
            '       if ( typeof($.fn["akvopedia"]) !== "function" ) {' .
            '           $(window).on("akvopedia:gadget-loaded", init);' .
			'       } else {' .
            '          init();' .
            '       }' .
			'  });' .
			'})(jQuery, document);' .
			"\n//-->";
		return $script;
	}

	private function html()  {
		$html = '<div class="' . $this->clazz . '" id="' . $this->div_id . '"><noscript>' .
			'<iframe style="position: absolute; top: 4em; right:1em; left:1em; bottom:1em; height:90%; width:97%;" src="https://akvopedia.org/contentonly/' . $this->title . '</iframe>' .
			'</noscript></div>';
		return $html;
	}

	private function script() {
		$s = '';
		if ( !self::$gadget_loaded ) {
			self::$gadget_loaded = true;
			$s = '<script async="async" defer="defer" src="http://akvopedia.org/resources/akvopedia-gadget/akvopedia-gadget-1.9.js"></script>';
		}
		return $s . '<script>' . $this->javascript() . '</script>';
	}

	public function getRendered() {
		return $this->script() . $this->html();
	}

	public function getScript() {
		return $this->script();
	}

	public function getHtmlElement() {
		return $this->html();
	}

}