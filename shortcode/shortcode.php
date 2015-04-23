<?php 
add_action('wp_enqueue_scripts', 'add_shortcode_script');
function add_shortcode_script(){
	wp_register_script('googleMapFrontEndJS','https://maps.googleapis.com/maps/api/js?libraries=places');
	wp_enqueue_script('googleMapFrontEndJS');

	wp_register_script('mapFrontEndJS', plugins_url( 'js/meta-box-map-front-end.js', dirname(__FILE__) ), array('jquery'), '', TRUE);
}
function add_google_map( $atts ) {
	$atts = shortcode_atts( array('lat' => 27.0881198382541,'lng' => 29.756923124999958, 'zoom' => 4, 'width' => '100%', 'height' => '500px' ), $atts, 'google_map' );
	extract($atts);
	$map_dinamic_options = array(
		'lat' => $lat,
		'lng' => $lng,
		'zoom' => $zoom
	);
	$google_map_sortcode = '<div id="metaboxGoogleMap" style="width:'. $width .'; height:'. $height .';"></div>';
	wp_localize_script('mapFrontEndJS', 'map_dinamic_options', $map_dinamic_options);
	wp_enqueue_script('mapFrontEndJS');
	return $google_map_sortcode;
}
add_shortcode( 'gs_google_map', 'add_google_map' );
?>