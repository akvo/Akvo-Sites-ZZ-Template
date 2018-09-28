(function( $ ) {	
	
	var api = wp.customize;
	
	api.controlConstructor['ajax_dropdown'] = api.Control.extend( {
		
		ready: function() {
			
			var control = this;
			
			// HIDE THE SELECT FIELD BY DEFAULT
			control.getSelectField().hide();
			
			api.section( control.section() ).container.on( 'expanded', function() {
				
				control.getOptionsFromServer();
				
			});
			
			
			/*
			this.container.on( 'change', 'select',
				function() {
					control.setting.set( jQuery( this ).val() );
				}
			);
			*/
		},
		
		getSelectField: function(){
			var control 	= this,
				$select 	= control.container.find('[data-behaviour~=ajax-dropdown-control]');
			return $select;
		},
		
		getOptionsFromServer: function(){
			
			var control 	= this,
				$select 	= control.container.find('[data-behaviour~=ajax-dropdown-control]'),
				url 		= $select.data('url'),
				$loading 	= control.container.find('.loading');
			
			// HIDE THE SELECT FIELD
			$select.hide();
			
			// SHOW LOADING
			$loading.show();
			
			// AJAX REQUEST
			$.getJSON( url, function( data ) {
				
				// RESET THE OPTIONS IN THE SELECT DROPDOWN
				$select.find('option').remove();
				
				// ADD THE OPTIONS FROM THE SERVER INTO THE SELECT FIELD
				_.each( data, function( label, choice ) {
				
					var $option = $( document.createElement('option') )
					$option.attr( 'value', choice );
					$option.html( label );
					
					if( control.setting.get() == choice ){
						$option.attr( 'selected', 'selected' );
					}
					
					$select.append( $option );
					
				});
				
				// SHOW THE SELECT FIELD
				$select.show();
				
				// HIDE THE LOADING
				$loading.hide();
				
			});
		}
	} );
	
	
})( jQuery );
	