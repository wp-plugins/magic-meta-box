<?php
	switch($type){
		case 'text': ?>
				<input type="text" name="<?php echo $id ?>" id="<?php echo $id ?>" value="<?php echo esc_attr($value); ?>" <?php if(isset($pattern) && !empty($pattern)){  ?> pattern="<?php echo $pattern ?>" <?php } ?> 
				<?php if(isset($placeholder) && !empty($placeholder)){  ?> placeholder="<?php echo $placeholder ?>" <?php } ?>  />
			<?php
			break;
		case 'password': ?>
				<input type="password" name="<?php echo $id ?>" id="<?php echo $id ?>" value="<?php echo esc_attr($value); ?>" <?php if(isset($pattern) && !empty($pattern)){  ?> pattern="<?php echo $pattern ?>" <?php } ?> 
				<?php if(isset($placeholder) && !empty($placeholder)){  ?> placeholder="<?php echo $placeholder ?>" <?php } ?>  />
			<?php
			break;
		case 'textarea': ?>
			<textarea name="<?php echo $id ?>" id="<?php echo $id ?>" rows="<?php echo isset($row)? $row : '5' ?>" cols="<?php echo isset($cols)? $cols : '50' ?>" 
			<?php if(isset($placeholder) && !empty($placeholder)){  ?> placeholder="<?php echo $placeholder ?>" <?php } ?> ><?php echo esc_attr($value); ?></textarea>
			<?php
			break;
		case 'url': ?>
				<input type="url" name="<?php echo $id ?>" id="<?php echo $id ?>" value="<?php echo esc_url($value); ?>" <?php if(isset($placeholder) && !empty($placeholder)){  ?> placeholder="<?php echo $placeholder ?>" <?php } ?>  />
			<?php
			break;
		case 'email': ?>
				<input type="email" name="<?php echo $id ?>" id="<?php echo $id ?>" value="<?php echo esc_attr($value); ?>" <?php if(isset($placeholder) && !empty($placeholder)){  ?> placeholder="<?php echo $placeholder ?>" <?php } ?>  />
			<?php
			break;
		case 'date': ?>
				<input type="text" class="datepicker" data-date_format="<?php echo $date_format ?>" name="<?php echo $id ?>" id="<?php echo $id ?>" value="<?php echo $value ?>" <?php if(isset($placeholder) && !empty($placeholder)){  ?> placeholder="<?php echo $placeholder ?>" <?php } ?>  readonly />
			<?php
			break;
		case 'DateTime': ?>
				<input type="text" class="datetimepicker" data-date_format="<?php echo $date_format ?>" data-time_format="<?php echo $time_format ?>" data-time_zone="<?php echo $time_zone ?>"  name="<?php echo $id ?>" id="<?php echo $id ?>" <?php if(isset($placeholder) && !empty($placeholder)){  ?> placeholder="<?php echo $placeholder ?>" <?php } ?>  value="<?php echo $value ?>" readonly />
			<?php
			break;
		case 'time': ?>
				<input type="text" class="timepicker" data-time_format="<?php echo $time_format ?>" data-time_zone="<?php echo $time_zone ?>"  name="<?php echo $id ?>" id="<?php echo $id ?>" value="<?php echo $value ?>" <?php if(isset($placeholder) && !empty($placeholder)){  ?> placeholder="<?php echo $placeholder ?>" <?php } ?>  readonly />
			<?php
			break;
		case 'num': ?>
				<input type="text" class="numberType" name="<?php echo $id ?>" id="<?php echo $id ?>" value="<?php echo esc_attr($value) ?>" />
			<?php
			break;
		case 'checkbox': ?>
			<input type="checkbox" name="<?php echo $id ?>" id="<?php echo $id ?>" <?php checked($value, 'true') ?> value="true" />
			<?php
			break;
		case 'multicheckbox':
			if(!empty($options)){
				foreach ($options as $key => $checkValue) { ?>
					<input type="checkbox" name="<?php echo $id ?>[<?php echo $checkValue ?>]" id="<?php echo $id ?>[<?php echo $checkValue ?>]" <?php isset($value[$checkValue])? checked($value[$checkValue], 'true') : '' ?> value="true" />
					<label for="<?php echo $id ?>[<?php echo $checkValue ?>]"><?php echo $checkValue ?></label><br />
				<?php }
			}elseif($post_type == 'taxonomy'){
				$taxonomy_args = array(
						'orderby' => 'name',
						'parent' => 0,
						'hide_empty' => false,
						);
				$taxonomies_type = $taxonomy_type;
				$taxonomies = get_terms($taxonomies_type,$taxonomy_args);
				?>
				<div class="multiCheckContainer">
				<?php
				foreach ( $taxonomies as $taxonomy ) { ?>
					<div class="multiCheckMetaBox">
						<input type="checkbox" name="<?php echo $id ?>[<?php echo $taxonomy->name ?>]" id="<?php echo $id ?>[<?php echo $taxonomy->name ?>]" <?php isset($value[$taxonomy->name])? checked($value[$taxonomy->name], 'true') : '' ?> value="true" />
						<label for="<?php echo $id ?>[<?php echo $taxonomy->name ?>]"><?php echo $taxonomy->name ?></label><br />
					</div>
						<?php 
						$sub_taxonomies = get_term_children( $taxonomy->term_id, $taxonomies_type[0] );
						if(!empty($sub_taxonomies)){
							foreach ( $sub_taxonomies as $sub_taxonomy ) {
								$term = get_term_by( 'id', $sub_taxonomy, $taxonomies_type[0] );
								
								?>
								<div class="multiCheckMetaBox childTaxonomy">
									<input type="checkbox" name="<?php echo $id ?>[<?php echo $term->name ?>]" id="<?php echo $id ?>[<?php echo $term->name ?>]" <?php isset($value[$term->name])? checked($value[$term->name], 'true') : '' ?> value="true" />
									<label for="<?php echo $id ?>[<?php echo $term->name ?>]"><?php echo $term->name ?></label>
								</div>
						<?php } ?>
						<?php
						}
						?>
					</div>
					<?php
				} ?>
				<?php
			}
			break;
		case 'radio': ?>
			<?php foreach($options as $opt_value=>$opt_name): ?>
				<label class="radioMetabox">
				<input type="radio" name="<?php echo $id?>" id="<?php echo $id?>_<?php echo $opt_value ?>" value="<?php echo $opt_value?>" <?php checked($value, $opt_value)?> />
				<?php echo $opt_name ?>
				</label>
			<?php endforeach ?>		
			<?php
			break;
		case 'select': ?>
			<select class="selectMetabox" name="<?php echo $id ?>" id="<?php echo $id ?>">
				<?php if(!empty($default_option)){ ?>
					<option value="default"><?php echo $default_option ?></option>
				<?php }else{ ?>
					<option value="default">Select an Option</option>
				<?php } ?>
				<?php if(!empty($options)){ ?>
					<?php foreach ($options as $opt_value=>$opt_name): ?>
						<option <?php selected($value, $opt_value)?> value="<?php echo $opt_value ?>"><?php echo $opt_name?></option>
					<?php endforeach ?>
				<?php }elseif($post_type == 'user'){
						if(!empty($user_args)){
							$user_args = $user_args;
						}else{
							$user_args = array(
								'orderby' => 'id',
							);
						}
						$user_query = new WP_User_Query($user_args);
						if ( ! empty( $user_query->results ) ) {
							foreach ( $user_query->results as $user ) { 
								?>
								<option <?php selected($value, ($return_by == 'id')? $user->ID : $user->display_name )?> value="<?php echo ($return_by == 'id')? $user->ID : $user->display_name; ?>"><?php echo $user->display_name ?></option>
						<?php }
						}
					}elseif($post_type == 'taxonomy'){
						$taxonomy_args = array(
							'orderby' => 'name',
							'hide_empty' => false
						);
						$taxonomies_type = $taxonomy_type;
						$taxonomies = get_terms($taxonomies_type,$taxonomy_args);
						foreach ( $taxonomies as $taxonomy ) { ?>
							<option <?php selected($value, ($return_by == 'id')? $taxonomy->term_id : $taxonomy->name )?> value="<?php echo ($return_by == 'id')? $taxonomy->term_id : $taxonomy->name ?>"><?php echo $taxonomy->name ?></option>
						<?php }
					}else{
						$taxonomy_query = array();
						if(isset($relation) && !empty($relation)){
							$taxonomy_query = array(
								'relation' => $relation,
							);
						}
						if(isset($selected_taxonomy) && !empty($selected_taxonomy)){
							foreach ($selected_taxonomy as $taxonomy_key => $taxonomy_value) {
									$taxonomy_query[] = array(
										'taxonomy' => $taxonomy_key,
										'field'    => 'slug',
										'terms'    => $taxonomy_value,
									);		
							}
						}
						$post_args = array(
							'post_type' => $post_type,
							'tax_query' => $taxonomy_query
						);
						$select_posts = get_posts($post_args);
						foreach ($select_posts as $key => $select_post) {	
							setup_postdata( $select_post );
							?>
						<option <?php selected($value, ($return_by == 'id')? $select_post->ID : $select_post->post_title)?> value="<?php echo ($return_by == 'id')? $select_post->ID : $select_post->post_title; ?>"><?php echo $select_post->post_title ?></option>
						<?php 
						}
						wp_reset_postdata();
				} ?>
			</select>
			<?php
			break;
		case 'multiselect': 
		?>
			<select class="selectMetabox" name="<?php echo $id ?>[]" id="<?php echo $id ?>" multiple>
				<?php if(!empty($options)){ ?>
					<?php foreach ($options as $opt_value=>$opt_name):
						$selectedMulti = '';
						foreach($value as $valueSelect){
							echo $valueSelect . ' - ' . $opt_value;
							if($valueSelect == $opt_value){
								$selectedMulti = selected($valueSelect, $opt_value,false);
							}
						}
						?>
						<option <?php echo $selectedMulti ?> value="<?php echo $opt_value ?>"><?php echo $opt_name?></option>
					<?php endforeach ?>
				<?php }elseif($post_type == 'user'){
						if(!empty($user_args)){
							$user_args = $user_args;
						}else{
							$user_args = array(
								'orderby' => 'id',
							);
						}
						$user_query = new WP_User_Query($user_args);
						if ( ! empty( $user_query->results ) ) {
							foreach ( $user_query->results as $user ) {
								$selectedMulti = '';
								$userInfo;
								if($return_by == 'id') {
									$userInfo = $user->ID;
								}else {
									$userInfo = $user->display_name;
								}
								foreach($value as $valueSelect){
									if($valueSelect == $userInfo ){
										$selectedMulti = selected($valueSelect, ($return_by == 'id')? $user->ID : $user->display_name,false);
									}
								}
								?>
								<option <?php echo $selectedMulti ?> value="<?php echo ($return_by == 'id')? $user->ID : $user->display_name; ?>"><?php echo $user->display_name ?></option>
						<?php }
						}
					}elseif($post_type == 'taxonomy'){
						$taxonomy_args = array(
							'orderby' => 'name',
							'hide_empty' => false
						);
						$taxonomies_type = $taxonomy_type;
						$taxonomies = get_terms($taxonomies_type,$taxonomy_args);
						foreach ( $taxonomies as $taxonomy ) {
							$selectedMulti = '';
							$taxonomyInfo;
							if($return_by == 'id') {
								$taxonomyInfo = $taxonomy->term_id;
							}else {
								$taxonomyInfo = $taxonomy->name;
							}
							foreach($value as $valueSelect){
								if($valueSelect == $taxonomyInfo){
									$selectedMulti = selected($valueSelect, ($return_by == 'id')? $taxonomy->term_id : $taxonomy->name,false);
								}
							}
							 ?>
							<option <?php echo $selectedMulti ?> value="<?php echo ($return_by == 'id')? $taxonomy->term_id : $taxonomy->name ?>"><?php echo $taxonomy->name ?></option>
						<?php }
					}else{
						$taxonomy_query = array();
						if(isset($relation) && !empty($relation)){
							$taxonomy_query = array(
								'relation' => $relation,
							);
						}
						if(isset($selected_taxonomy) && !empty($selected_taxonomy)){
							foreach ($selected_taxonomy as $taxonomy_key => $taxonomy_value) {
									$taxonomy_query[] = array(
										'taxonomy' => $taxonomy_key,
										'field'    => 'slug',
										'terms'    => $taxonomy_value,
									);		
							}
						}
						$post_args = array(
							'post_type' => $post_type,
							'tax_query' => $taxonomy_query
						);
						$multi_select_posts = get_posts($post_args);
						foreach ($multi_select_posts as $key => $multi_select_post) {
							setup_postdata( $multi_select_post );
							$selectedMulti = '';
							$postInfo;
							if($return_by == 'id') {
								$postInfo = $multi_select_post->ID;
							}else {
								$postInfo = $multi_select_post->post_title;
							}
							foreach($value as $valueSelect){
								if($valueSelect == $postInfo){
									$selectedMulti = selected($valueSelect, ($return_by == 'id')? $multi_select_post->ID : $multi_select_post->post_title,false);
								}
							}
							?>
							<option <?php echo $selectedMulti ?> value="<?php echo ($return_by == 'id')? $multi_select_post->ID : $multi_select_post->post_title; ?>"><?php echo $multi_select_post->post_title ?></option>
							<?php 
						}
						wp_reset_postdata();
					} ?>
			</select>
			<?php
			break;
		case 'color': ?>
				<input type="text" class="gs-color" name="<?php echo $id ?>" id="<?php echo $id ?>" value="<?php echo $value ?>" />
			<?php
			break;
		case 'image': ?>
			<div class="imageUploadMeta <?php echo !empty($value['url'])? 'activeImage' : '' ?>">
				<div class="metaboxImage">
					<img src="<?php if ( isset ( $value['url'] ) ){ echo $value['url']; } ?>" id="<?php echo $id ?>_image" />
					<div class="removeImage"></div>
				</div>
			    <input type="hidden" class="holdURL" name="<?php echo $id ?>[url]" id="<?php echo $id ?>_url" value="<?php if ( isset ( $value['url'] ) ){ echo $value['url']; } ?>" />
			    <input type="hidden" class="holdID" name="<?php echo $id ?>[id]" id="<?php echo $id ?>_id" value="<?php if ( isset ( $value['id'] ) ){ echo $value['id']; } ?>" />
			    <input type="hidden" class="holdTitle" name="<?php echo $id ?>[title]" id="<?php echo $id ?>_title" value="<?php if ( isset ( $value['title'] ) ){ echo $value['title']; } ?>" />
			    <input type="hidden" class="holdAlt" name="<?php echo $id ?>[alt]" id="<?php echo $id ?>_alt" value="<?php if ( isset ( $value['alt'] ) ){ echo $value['alt']; } ?>" />
			    <input type="hidden" class="holdEditLink" name="<?php echo $id ?>[edit]" id="<?php echo $id ?>_edit" value="<?php if ( isset ( $value['edit'] ) ){ echo $value['edit']; } ?>" />
			    <input type="button" class="meta-image-button button" value="<?php _e( 'Upload Image', 'gs_metabox' )?>" />
		    </div>
		    <?php
		    break;
		case 'gallery':
			$gallery_ids = array();
			if(isset($value['id'])){
				$gallery_ids = explode(",", $value['id']);
			}
		    //echo do_shortcode('[gallery link="none" ids="'.$value.'"]');
			?>
			<div class="galleryContainer">
				<div class="galleryImages">
					<?php
					foreach ($gallery_ids as $gallery_id) {
						echo wp_get_attachment_image($gallery_id);	
					} ?>
				</div>
				<div class="metaboxGallery">
					<input id="<?php echo $id ?>_url" class="galleryURLs" type="hidden" name="<?php echo $id ?>[url]" value="<?php echo isset($value['url'])? $value['url'] : '' ?>" />
					<input id="<?php echo $id ?>_id" class="galleryIDs" type="hidden" name="<?php echo $id ?>[id]" value="<?php echo isset($value['id'])? $value['id'] : '' ?>" />
					<input id="<?php echo $id ?>_title" class="galleryTitles" type="hidden" name="<?php echo $id ?>[title]" value="<?php echo isset($value['title'])? $value['title'] : '' ?>" />
					<input id="<?php echo $id ?>_alt" class="galleryAlts" type="hidden" name="<?php echo $id ?>[alt]" value="<?php echo isset($value['alt'])? $value['alt'] : '' ?>" />
					<input id="<?php echo $id ?>_edit" class="galleryEdits" type="hidden" name="<?php echo $id ?>[edit]" value="<?php echo isset($value['edit'])? $value['edit'] : '' ?>" />
					<input class="manage_gallery button" title="Manage gallery" type="button" value="Manage gallery" />
					<input class="clear_gallery button" title="clear gallery" type="button" value="clear gallery" />
				</div>
			</div>
			<?php
			break;
		case 'file': ?>
			<div class="imageUploadMeta <?php echo !empty($value)? 'activeImage' : '' ?>">
				<div class="filesContent">
					<div class="metaboxImage">
						<?php 
						if(!empty($value['url'])){
							if(strrpos($value['url'],'.jpg') || strrpos($value['url'],'.jpeg') || strrpos($value['url'],'.png') || strrpos($value['url'],'.gif') ){ ?>
								<img src="<?php if ( isset ( $value['url'] ) ){ echo $value['url']; } ?>" id="<?php echo $id ?>_file" />
							<?php }elseif(strrpos($value['url'],'.mp4') || strrpos($value['url'],'.webm') || strrpos($value['url'],'.mkv') || strrpos($value['url'],'.flv') || strrpos($value['url'],'.vob') || strrpos($value['url'],'.ogv') || strrpos($value['url'],'.ogg') || strrpos($value['url'],'.drc') || strrpos($value['url'],'.mng') || strrpos($value['url'],'.avi') || strrpos($value['url'],'.mov') || strrpos($value['url'],'.wmv') || strrpos($value['url'],'.yuv') || strrpos($value['url'],'.rmvb') || strrpos($value['url'],'.rm') || strrpos($value['url'],'.m4p') || strrpos($value['url'],'.m4v') || strrpos($value['url'],'.mpg') || strrpos($value['url'],'.mp2') || strrpos($value['url'],'.svi') || strrpos($value['url'],'.mxf') || strrpos($value['url'],'.qt')){ ?>
									<img src="<?php echo includes_url() ?>images/media/video.png" id="<?php echo $id ?>_file" />
							<?php }elseif(strrpos($value['url'],'.mp3') || strrpos($value['url'],'.mpc') || strrpos($value['url'],'.msv') || strrpos($value['url'],'.wav') || strrpos($value['url'],'.mmf') || strrpos($value['url'],'.m4a') || strrpos($value['url'],'.wma') || strrpos($value['url'],'.wv')){ ?>
									<img src="<?php echo includes_url() ?>images/media/audio.png" id="<?php echo $id ?>_file" />
								<?php }else{ ?>
								<img src="<?php echo includes_url() ?>images/media/document.png" id="<?php echo $id ?>_file" />
							<?php } ?>
						<?php }else { ?>
								<img src="" id="<?php echo $id ?>_file" />	
						<?php } ?>
						<div class="removeImage"></div>
					</div>
					<div class="metaboxImageTitle">
						<a href="<?php echo isset($value['edit'])? $value['edit'] : ''  ?>">
							<p><?php echo isset($value['title'])? $value['title'] : '' ?></p>
						</a>
					</div>
				</div>
			    <input type="hidden" class="holdURL" name="<?php echo $id ?>[url]" id="<?php echo $id ?>_url" value="<?php if ( isset ( $value['url'] ) ){ echo $value['url']; } ?>" />
			    <input type="hidden" class="holdID" name="<?php echo $id ?>[id]" id="<?php echo $id ?>_id" value="<?php if ( isset ( $value['id'] ) ){ echo $value['id']; } ?>" />
			    <input type="hidden" class="holdTitle" name="<?php echo $id ?>[title]" id="<?php echo $id ?>_title" value="<?php if ( isset ( $value['title'] ) ){ echo $value['title']; } ?>" />
			    <input type="hidden" class="holdAlt" name="<?php echo $id ?>[alt]" id="<?php echo $id ?>_alt" value="<?php if ( isset ( $value['alt'] ) ){ echo $value['alt']; } ?>" />
			    <input type="hidden" class="holdEditLink" name="<?php echo $id ?>[edit]" id="<?php echo $id ?>_edit" value="<?php if ( isset ( $value['edit'] ) ){ echo $value['edit']; } ?>" />
			    <input type="button" class="meta-file-button button" value="<?php _e( 'Upload File or Image', 'gs_metabox' )?>" />
		    </div>
		    <?php
		    break;
		case 'embed': ?>
				<div class="embedContainer">
					<textarea type="text" class="embed" rows="3" cols="50" name="<?php echo $id ?>" id="<?php echo $id ?>" <?php if(isset($placeholder) && !empty($placeholder)){  ?> placeholder="<?php echo $placeholder ?>" <?php } ?> ><?php echo esc_attr($value) ?></textarea>
					<input type="button" class="button embedButton" value="Preview">
					<div class="embedIframe"><?php echo isset($value)? $value : '' ?></div>
				</div>
			<?php
			break;
		case 'slider': ?>
				<div class="sliderMetaboxContainer">
					<span class="showSliderValue"><?php echo $value; ?></span>
					<div class="clearfix">
						<span class="minSlider"><?php echo $min ?></span>
						<div class="sliderMetabox" data-content="<?php echo $value ?>" data-animate="<?php echo $speed ?>" data-max="<?php echo $max ?>" data-min="<?php echo $min ?>" data-orientation="<?php echo $orientation ?>"
							 data-range="<?php echo $range ?>" data-step="<?php echo $step ?>" data-value="<?php echo isset($value)? $value : $slider_value ?>" data-values="<?php echo $slider_values ?>" 
							 name="<?php echo $id ?>_slider" id="<?php echo $id ?>_slider"></div>
						<span class="maxSlider"><?php echo $max ?></span>
					</div>
					<input type="hidden" class="inputSliderMetabox" name="<?php echo $id ?>" id="<?php echo $id ?>" value="<?php echo $value ?>" />
				</div>
			<?php
			break;
		case 'map': ?>
			<div class="mapMetaboxContainer">
				<?php 
					$fieldattrs = $field;
					$fieldattrs['id'] = $id;
					$fieldattrs['value'] = $value;
					do_action('add_map_fields', $fieldattrs); 
				?>
				<input type="text" name="mapInput" class="controls" id="mapInput" />
				<div class="mapMetabox" style="width: 100%;height: 300px;"></div>
				<input type="hidden" class="markerPositionLat" name="<?php echo $id; ?>[lat]" id="<?php echo $id; ?>[lat]" value="<?php echo (isset($value['lat']) && !empty($value['lat']))? $value['lat'] : 27.0881198382541 ?>" />
				<input type="hidden" class="markerPositionLng" name="<?php echo $id; ?>[lng]" id="<?php echo $id; ?>[lng]" value="<?php echo (isset($value['lng']) && !empty($value['lng']))? $value['lng'] : 29.756923124999958 ?>" />
				<input type="hidden" class="mapZoom" name="<?php echo $id; ?>[zoom]" id="<?php echo $id; ?>[zoom]" value="<?php echo (isset($value['zoom']) && !empty($value['zoom']))? $value['zoom'] : 4 ?>" />
				<input type="button" class="button shortcodePreviewButton" value="Show Shortcode">
				<code class="shortcodePreview"></code>
			</div>
		<?php
			$map_dinamic_options = array(
				'lat' => (isset($value['lat']) && !empty($value['lat']))? $value['lat'] : 27.0881198382541,
				'lng' => (isset($value['lng']) && !empty($value['lng']))? $value['lng'] : 29.756923124999958,
				'zoom' => (isset($value['zoom']) && !empty($value['zoom']))? $value['zoom'] : 4
			);
			wp_localize_script('mapJS', 'map_dinamic_options', $map_dinamic_options);
			wp_enqueue_script('mapJS');
			break;
		case 'wp_editor': 
			wp_editor( $value,  $id );
			break;
		case 'editor': ?>
			<div id="wp-<?php echo $id ?>-media-buttons" class="wp-media-buttons">
        		<a href="#" class="button insert-media add_media" data-editor="<?php echo $id ?>" title="Add Media">
        			<span class="wp-media-buttons-icon"></span> Add Media
        		</a>
        	</div>
			<textarea class="textareaTinyMCE" id="<?php echo $id ?>" name="<?php echo $id ?>" style="min-height: 300px;"><?php echo isset($value)? $value : '' ?></textarea>
			<?php
			break;
	}
$fieldattrs = $field;
$fieldattrs['id'] = $id;
$fieldattrs['value'] = $value;
do_action('gs_add_custom_field_type', $fieldattrs);

if (isset($desc)) {
    echo '<p class="metaboxDescription">' . $desc . '</p>';
}
$type = '';
$name = '';
$id = '';
$desc = '';
$std = '';
$placeholder = '';
$tab = '';
$options = array();
$post_type = '';
$default_option = '';
$taxonomy_type = array();
$selected_taxonomy = array();
$relation = 'OR';
$return_by = '';
$user_args = array();
$time_zone = FALSE;
$date_format = 'yy-mm-dd';
$time_format = 'hh-mm tt';
