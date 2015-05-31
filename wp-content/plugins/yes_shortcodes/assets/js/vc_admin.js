/**
 * Custom functions for visual composer functionality 
 * Attach global event handlers or declare functions to be called
 * at field render time
 * - this file is used to call google maps in shortcode admin backend and also font icons stuff
 */

(function($) {"use strict";

	$(document).ready(function() {
		
		/**
		 * Attaches event handler for pe_icon_field font icon picker
		 */
		$(document).on('click', '.font-icons-container span', function(){
			var $this = $(this);
			$this.parent().find('.selected').removeClass('selected');
			
			$this.parent().prev().val($this.attr('class'));
			
			$this.addClass('selected');
		});
		
		
	});

})(jQuery); 


/**
 * At pe_icon_field render, scroll icon picker div to selected element, if any
 */
function align_selected_font_icon() {
	jQuery(document).ready(function($) {
		$('.font-icons-container').each(function(){
			var $this = $(this);
			if($this.find('.selected').position()) {
				$this.scrollTop( 0 );
				$this.scrollTop( $this.find('.selected').position().top );
			}
		});
	});
}


/**
 * Render google map widget for choosing location and zoom level 
 */
function init_gmap_loc() {
	jQuery(document).ready(function($) {
		var $gmap = $('#gmap_loc');
		if($gmap.length) {
			var $input = $gmap.prev();
			var zoom = 2;
			var lat = 0;
			var lng = 0;
			
			var setLabels = function(lt, ln, zm) {
				$gmap.parent().find('label').each(function(){
			    	switch($(this).attr('class')) {
			    		case 'lat':
			    			$(this).find('strong').text(lt);
			    			break;
		    			case 'lng':
		    				$(this).find('strong').text(ln);
			    			break;
		    			case 'zoom':
		    				$(this).find('strong').text(zm);
			    			break;
			    	}
			    });
			};
			
			if($input.length && $input.val()) {
				var parts = $input.val().split(',');
				
				if(typeof parts[0] != 'undefined') {
					lat = parts[0];
				}
				
				if(typeof parts[1] != 'undefined') {
					lng = parts[1];
				}
				
				if(typeof parts[2] != 'undefined') {
					zoom = parseInt(parts[2], 10);
				}
				
				setLabels(lat, lng, zoom);
			}
			
			var mapOptions = {
				scrollwheel : true,
				zoom : zoom,
				center : new google.maps.LatLng(lat, lng),
			};
			
			var map = new google.maps.Map($gmap[0], mapOptions);
			
			google.maps.event.addListener(map, 'click', function(event) {
			    var coords = event.latLng.toString();
			    console.log(coords);
			    $input.val([event.latLng.lat(), event.latLng.lng(), map.getZoom()].join(','));
			    
			    setLabels(event.latLng.lat(), event.latLng.lng(), map.getZoom());
			});
		}
	});
}

