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
		map = new google.maps.Map($('#metaboxGoogleMap')[0],mapOptions);
		// To add the marker to the map, use the 'map' property
		marker = new google.maps.Marker({
		    map:map,
		    draggable:false,
		    animation: google.maps.Animation.DROP,
		    position: marker_position
		});
	}
	//marker.setAnimation(google.maps.Animation.BOUNCE);
	google.maps.event.addDomListener(window, 'load', initialize);
});
