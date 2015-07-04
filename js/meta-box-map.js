jQuery(document).ready(function($){
	var	marker_position = new google.maps.LatLng(map_dinamic_options.lat, map_dinamic_options.lng);
	var	map_position = new google.maps.LatLng(map_dinamic_options.lat, map_dinamic_options.lng);
	var	zoom = parseInt(map_dinamic_options.zoom);
	var marker;
	var map;
	function initialize() {
		var mapOptions = {
			zoom: zoom,
			center: map_position 
		};
		map = new google.maps.Map($('.mapMetabox')[0],mapOptions);
		// To add the marker to the map, use the 'map' property
		marker = new google.maps.Marker({
		    map:map,
		    draggable:true,
		    animation: google.maps.Animation.DROP,
		    position: marker_position
		});
		
		// Create the search box and link it to the UI element.
  var input = ($('#mapInput')[0]);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  var searchBox = new google.maps.places.SearchBox(input);

  // Listen for the event fired when the user selects an item from the
  // pick list. Retrieve the matching places for that item.
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };
      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);
  });

  // Bias the SearchBox results towards places that are within the bounds of the
  // current map's viewport.
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
		google.maps.event.addListener(map, 'click', set_new_position_marker);
		google.maps.event.addListener(marker, 'click', toggleBounce);
		google.maps.event.addListener(marker, 'dragend', get_position_marker);
		google.maps.event.addListenerOnce(map, 'tilesloaded', function(){
			$('.tabsMetabox li').click(function(){
				$this = $(this);
				$this.parent().children().removeClass('nav-tab-active');
				$this.addClass('nav-tab-active');
				$this.closest('.inside').find('.tableWithTabs tr').each(function(){
					if($this.attr('id') == $(this).data('tab')){
						$(this).addClass('showTab');
						$(this).removeClass('hideTab');
					}else{
						$(this).removeClass('showTab');
						$(this).addClass('hideTab');
					}
					$('.tabsMetabox').addClass('showHideOpen');
				});
			});
			$('.tabsMetabox').each(function(){
				$(this).find('li').first().click();
			});
		});
	}
	function set_new_position_marker(event) {
		var	new_position = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());
		marker.setPosition(new_position);
		$('.mapMetaboxContainer .markerPositionLat').val(marker.getPosition().A);
	    $('.mapMetaboxContainer .markerPositionLng').val(marker.getPosition().F);
	    $('.mapMetaboxContainer .mapZoom').val(map.getZoom());
	}
	function toggleBounce() {
		if (marker.getAnimation() != null) {
			marker.setAnimation(null);
		} else {
			marker.setAnimation(google.maps.Animation.BOUNCE);
		}
	}
	
	function get_position_marker(){
	    $('.mapMetaboxContainer .markerPositionLat').val(marker.getPosition().A);
	    $('.mapMetaboxContainer .markerPositionLng').val(marker.getPosition().F);
	    $('.mapMetaboxContainer .mapZoom').val(map.getZoom());
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);
	$('.shortcodePreviewButton').click(function(){
		var shortcodeString = '[google_map lat="' + $('.mapMetaboxContainer .markerPositionLat').val() + '" lng="' + $('.mapMetaboxContainer .markerPositionLng').val() + '" zoom="' + $('.mapMetaboxContainer .mapZoom').val() + '"]';
		$(this).closest('.mapMetaboxContainer').find('.shortcodePreview').html(shortcodeString).addClass('showShortcode');
	});
	
});
