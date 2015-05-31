(function($){

    "use strict";

	jQuery(document).ready(function(){
		jQuery('.date').datepicker();

		// Map
		var $gmap = $('#gmap_loc');
		if($gmap.length) {
			var $input = $gmap.prev();
			var zoom = 2;
			var lat = 0;
			var lng = 0;
			var address = '';
			
			var setLabels = function(lt, ln, zm, ad) {
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
			    		case 'address':
		    				$(this).find('strong').text(ad);
			    			break;
			    	}
			    });
			//    $("#lt_meta_address").val(ad);
			};
			
			if($input.length && $input.val()) {
				var parts = $input.val().split(';');
				
				if(typeof parts[0] != 'undefined') {
					lat = parts[0];
				}
				
				if(typeof parts[1] != 'undefined') {
					lng = parts[1];
				}
				
				if(typeof parts[2] != 'undefined') {
					zoom = parseInt(parts[2], 10);
				}

				if(typeof parts[3] != 'undefined') {
					address = parts[3];
				}
				setLabels(lat, lng, zoom, address);
			}
			
			var mapOptions = {
				scrollwheel : true,
				zoom : zoom,
				center : new google.maps.LatLng(lat, lng),
			};
			
			var map = new google.maps.Map($gmap[0], mapOptions);
			var geocoder = new google.maps.Geocoder();  
			
			google.maps.event.addListener(map, 'click', function(event) {
			    var coords = event.latLng.toString();

			    // Get Address
				var point = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());
				geocoder.geocode({ 'latLng': point }, function (results, status) {
					if (status !== google.maps.GeocoderStatus.OK) {
					  alert(status);
					}
					// This is checking to see if the Geoeode Status is OK before proceeding
					if (status == google.maps.GeocoderStatus.OK) {
						var real_address = (results[0].formatted_address);
						$input.val([event.latLng.lat(), event.latLng.lng(), map.getZoom(), real_address].join(';'));
						setLabels(event.latLng.lat(), event.latLng.lng(), map.getZoom(), real_address);
					}
				});

			});



		}
	});
})(jQuery);