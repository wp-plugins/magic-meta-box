<?php
add_action('wp_ajax_gs_meta_gallery','gs_meta_gallery');
add_action('wp_ajax_nopriv_gs_meta_gallery','gs_meta_gallery');
function gs_meta_gallery(){
	$gallery_ids = explode(',', $_POST['ids']);
	if(!empty($gallery_ids)){
		$image_urls = array();
		foreach ($gallery_ids as $image_id) {
			$image = wp_get_attachment_image_src($image_id);
			$image_urls[] = $image[0];
		}
		echo json_encode($image_urls);
	}
	die;
}
