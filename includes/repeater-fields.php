<?php
$count_repeat = 0;
$data = (self::gsmb_get($id) == null)? get_post_meta($post->ID,$id,true) : array(); 
?>
<div class="containerAddNew">
	<div class="contentRepeater">
<?php

do{ 
    ?>
<div class="repeaterWrapper">
    <?php
    foreach ($repeat_fields as $opt){
    	$value_field;
		$field_id =  $id .'[' .$count_repeat . '][' . $opt['id'] .']';
    	if(!isset($data[$count_repeat][$opt['id']])) {
			$value_field = isset($opt['std'])? $opt['std'] : '';
		}
		if(!isset($opt['std'])) {
			$opt['std'] = '';
		}
    	$value_field = isset($data[$count_repeat][$opt['id']])? $data[$count_repeat][$opt['id']] : $opt['std'];
        switch($opt['type']){
            case 'text': ?>
                <div class="elementContent">
                    <div class="metaLabelContainer">
                        <label for="<?php echo $field_id; ?>"><?php echo $opt['name'] ?></label>
                    </div>
                    <div class="contentMetaDesc">
                        <input type="text" name="<?php echo $field_id ?>" id="<?php echo $field_id ?>"
                         value="<?php echo esc_attr($value_field) ?>" <?php if(isset($opt['pattern']) && !empty($opt['pattern'])){  ?> pattern="<?php echo $opt['pattern'] ?>" <?php } ?>
                         <?php if(isset($opt['placeholder']) && !empty($opt['placeholder'])){  ?> placeholder="<?php echo $opt['placeholder'] ?>" <?php } ?> />
               		</div>
               		<?php 
               			if(isset($opt['desc'])) {
							echo '<p class="metaboxDescription">'.$opt['desc'].'</p>';
						}
               		?>
                </div>
                <?php
                break;
			case 'password': ?>
                <div class="elementContent">
                    <div class="metaLabelContainer">
                        <label for="<?php echo $field_id; ?>"><?php echo $opt['name'] ?></label>
                    </div>
                    <div class="contentMetaDesc">
                        <input type="password" name="<?php echo $field_id ?>" id="<?php echo $field_id ?>"
                         value="<?php echo esc_attr($value_field) ?>" <?php if(isset($opt['pattern']) && !empty($opt['pattern'])){  ?> pattern="<?php echo $opt['pattern'] ?>" <?php } ?>
                         <?php if(isset($opt['placeholder']) && !empty($opt['placeholder'])){  ?> placeholder="<?php echo $opt['placeholder'] ?>" <?php } ?> />
               		</div>
               		<?php 
               			if(isset($opt['desc'])) {
							echo '<p class="metaboxDescription">'.$opt['desc'].'</p>';
						}
               		?>
                </div>
                <?php
                break;
			case 'textarea': ?>      
                <div class="elementContent">
                    <div class="metaLabelContainer">
                        <label for="<?php echo $field_id ?>"><?php echo $opt['name'] ?></label>
                    </div>
                    <div class="contentMetaDesc">
                    	<textarea class="textarea" name="<?php echo $field_id ?>" <?php if(isset($opt['placeholder']) && !empty($opt['placeholder'])){  ?> placeholder="<?php echo $opt['placeholder'] ?>" <?php } ?> rows="5" cols="50"><?php echo esc_attr($value_field); ?></textarea>
                    </div>
                	<?php 
               			if(isset($opt['desc'])) {
							echo '<p class="metaboxDescription">'.$opt['desc'].'</p>';
						}
               		?>
                </div>
                <?php
                break;
			case 'url': ?>
                <div class="elementContent">
                    <div class="metaLabelContainer">
                        <label for="<?php echo $field_id ?>"><?php echo $opt['name'] ?></label>
                    </div>
                    <div class="contentMetaDesc">
                        <input type="url" name="<?php echo $field_id ?>" id="<?php echo $field_id ?>"
                         <?php if(isset($opt['placeholder']) && !empty($opt['placeholder'])){  ?> placeholder="<?php echo $opt['placeholder'] ?>" <?php } ?> value="<?php echo esc_url($value_field) ?>" />
               		</div>
               		<?php 
               			if(isset($opt['desc'])) {
							echo '<p class="metaboxDescription">'.$opt['desc'].'</p>';
						}
               		?>
                </div>
                <?php
                break;
			case 'email': ?>
                <div class="elementContent">
                    <div class="metaLabelContainer">
                        <label for="<?php echo $field_id ?>"><?php echo $opt['name'] ?></label>
                    </div>
                    <div class="contentMetaDesc">
                        <input type="email" name="<?php echo $field_id ?>" id="<?php echo $field_id ?>"
                         <?php if(isset($opt['placeholder']) && !empty($opt['placeholder'])){  ?> placeholder="<?php echo $opt['placeholder'] ?>" <?php } ?> value="<?php echo esc_attr($value_field) ?>" />
               		</div>
               		<?php 
               			if(isset($opt['desc'])) {
							echo '<p class="metaboxDescription">'.$opt['desc'].'</p>';
						}
               		?>
                </div>
                <?php
                break;
			case 'date': ?>
                <div class="elementContent">
                    <div class="metaLabelContainer">
                        <label for="<?php echo $field_id ?>"><?php echo $opt['name'] ?></label>
                    </div>
                    <div class="contentMetaDesc">
                        <input type="text" class="datepicker" data-date_format="<?php echo $opt['date_format'] ?>" name="<?php echo $field_id ?>" id="<?php echo $field_id ?>"
                         value="<?php echo $value_field ?>" <?php if(isset($opt['placeholder']) && !empty($opt['placeholder'])){  ?> placeholder="<?php echo $opt['placeholder'] ?>" <?php } ?> readonly />
               		</div>
               		<?php 
               			if(isset($opt['desc'])) {
							echo '<p class="metaboxDescription">'.$opt['desc'].'</p>';
						}
               		?>
                </div>
                <?php
                break;
			case 'DateTime': ?>
                <div class="elementContent">
                    <div class="metaLabelContainer">
                        <label for="<?php echo $field_id ?>"><?php echo $opt['name'] ?></label>
                    </div>
                    <div class="contentMetaDesc">
                        <input type="text" class="datetimepicker" data-date_format="<?php echo $opt['date_format'] ?>" data-time_format="<?php echo $opt['time_format'] ?>" 
                        	data-time_zone="<?php echo $opt['time_zone'] ?>" name="<?php echo $field_id ?>" id="<?php echo $field_id ?>"
                         value="<?php echo $value_field ?>" <?php if(isset($opt['placeholder']) && !empty($opt['placeholder'])){  ?> placeholder="<?php echo $opt['placeholder'] ?>" <?php } ?> readonly />
               		</div>
               		<?php 
               			if(isset($opt['desc'])) {
							echo '<p class="metaboxDescription">'.$opt['desc'].'</p>';
						}
               		?>
                </div>
                <?php
                break;
			case 'time': ?>
                <div class="elementContent">
                    <div class="metaLabelContainer">
                        <label for="<?php echo $field_id ?>"><?php echo $opt['name'] ?></label>
                    </div>
                    <div class="contentMetaDesc">
                        <input type="text" class="timepicker" data-time_format="<?php echo $opt['time_format'] ?>" data-time_zone="<?php echo $opt['time_zone'] ?>" name="<?php echo $field_id ?>" id="<?php echo $field_id ?>"
                        value="<?php echo $value_field ?>" <?php if(isset($opt['placeholder']) && !empty($opt['placeholder'])){  ?> placeholder="<?php echo $opt['placeholder'] ?>" <?php } ?> readonly />
               		</div>
               		<?php 
               			if(isset($opt['desc'])) {
							echo '<p class="metaboxDescription">'.$opt['desc'].'</p>';
						}
               		?>
                </div>
                <?php
                break;
			case 'num': ?>
                <div class="elementContent">
                    <div class="metaLabelContainer">
                        <label for="<?php echo $field_id ?>"><?php echo $opt['name'] ?></label>
                    </div>
                    <div class="contentMetaDesc">
                        <input type="text" class="numberType" name="<?php echo $field_id ?>" id="<?php echo $field_id ?>"
                         value="<?php echo esc_attr($value_field); ?>" />
               		</div>
               		<?php 
               			if(isset($opt['desc'])) {
							echo '<p class="metaboxDescription">'.$opt['desc'].'</p>';
						}
               		?>
                </div>
                <?php
                break;
			case 'checkbox': ?>
                <div class="elementContent">
                    <div class="metaLabelContainer">
                        <label for="<?php echo $field_id ?>"><?php echo $opt['name'] ?></label>
                    </div>
                    <div class="contentMetaDesc">
                        <input type="checkbox" name="<?php echo $field_id ?>" id="<?php echo $field_id ?>" 
                        <?php isset($value_field)? checked($value_field,'true') : '' ?> value="true" />
                    </div>
               		<?php 
               			if(isset($opt['desc'])) {
							echo '<p class="metaboxDescription">'.$opt['desc'].'</p>';
						}
               		?>
                </div>
                <?php
                break;
			case 'multicheckbox': ?>
				<div class="elementContent">
                    <div class="metaLabelContainer">
                        <label for="<?php echo $field_id ?>"><?php echo $opt['name'] ?></label>
                    </div>
                    <div class="contentMetaDesc">
	                    <?php
	                    if(!empty($opt['options'])){
	                    	foreach ($opt['options'] as $opt_value=>$opt_name) { ?>
								<input type="checkbox" name="<?php  echo $id ?>[<?php echo $count_repeat ?>][<?php echo $opt['id'] ?>][<?php echo $opt_value ?>]"
								id="<?php  echo $id ?>[<?php echo $count_repeat ?>][<?php echo $opt['id'] ?>]<?php echo $opt['name'] ?>[<?php echo $opt_value ?>]" <?php isset($value_field[$opt_value])? checked($value_field[$opt_value], 'true') : '' ?> value="true" />
								<label for="<?php  echo $id ?>[<?php echo $count_repeat ?>][<?php echo $opt['id'] ?>]<?php echo $opt['name'] ?>[<?php echo $opt_value ?>]"><?php echo $opt_name ?></label><br />
							<?php }
	                    }elseif($opt['post_type'] == 'taxonomy'){
							$taxonomy_args = array(
									'orderby' => 'name',
									'parent' => 0,
									'hide_empty' => false,
									);
							$taxonomies_type = $opt['taxonomy_type'];
							$taxonomies = get_terms($taxonomies_type,$taxonomy_args);
							?>
							<?php
							foreach ( $taxonomies as $taxonomy ) { ?>
								<div class="multiCheckMetaBox">
									<input type="checkbox" name="<?php echo $id ?>[<?php echo $count_repeat ?>][<?php echo $opt['id'] ?>][<?php echo $taxonomy->name ?>]" id="<?php echo $id ?>[<?php echo $count_repeat ?>][<?php echo $opt['id'] ?>][<?php echo $taxonomy->name ?>]" <?php isset($value_field[$taxonomy->name])? checked($value_field[$taxonomy->name], 'true') : '' ?> value="true" />
									<label for="<?php echo $id ?>[<?php echo $count_repeat ?>][<?php echo $opt['id'] ?>][<?php echo $taxonomy->name ?>]"><?php echo $taxonomy->name ?></label><br />
								</div>
									<?php 
									$sub_taxonomies = get_term_children( $taxonomy->term_id, $taxonomies_type[0] );
									if(!empty($sub_taxonomies)){
										foreach ( $sub_taxonomies as $sub_taxonomy ) {
											$term = get_term_by( 'id', $sub_taxonomy, $taxonomies_type[0] );
											
											?>
											<div class="multiCheckMetaBox childTaxonomy">
												<input type="checkbox" name="<?php echo $id ?>[<?php echo $count_repeat ?>][<?php echo $opt['id'] ?>][<?php echo $term->name ?>]" id="<?php echo $id ?>[<?php echo $count_repeat ?>][<?php echo $opt['id'] ?>][<?php echo $term->name ?>]" <?php isset($value_field[$term->name])? checked($value_field[$term->name], 'true') : '' ?> value="true" />
												<label for="<?php echo $id ?>[<?php echo $count_repeat ?>][<?php echo $opt['id'] ?>][<?php echo $term->name ?>]"><?php echo $term->name ?></label>
											</div>
									<?php }
									}
									?>
								<?php
							} ?>
							<?php
	                    } ?>
					</div>
					<?php 
               			if(isset($opt['desc'])) {
							echo '<p class="metaboxDescription">'.$opt['desc'].'</p>';
						}
               		?>
				</div>
				<?php
				break;
			case 'radio': ?>
                <div class="elementContent">
                    <div class="metaLabelContainer">
                        <label for="<?php echo $field_id ?>"><?php echo $opt['name'] ?></label>
                    </div>
                    <div class="contentMetaDesc">
                        <?php foreach($opt['options'] as $opt_value=>$opt_name): ?>
                                <label class="radioMetaRepeater">
                                <input type="radio" name="<?php echo $field_id ?>" 
                                        id="<?php echo $field_id ?>_<?php echo $opt_value ?>" 
                                        value="<?php echo $opt_value?>" <?php isset($value_field)? checked($value_field, $opt_value) : '' ?> />
                                <?php echo $opt_name ?>
                                </label>
                        <?php endforeach ?>	
                    </div>
                    <?php 
               			if(isset($opt['desc'])) {
							echo '<p class="metaboxDescription">'.$opt['desc'].'</p>';
						}
               		?>
                </div>
                    <?php
                    break;
            case 'select': ?>
                <div class="elementContent">
                    <div class="metaLabelContainer">
                        <label for="<?php echo $field_id ?>"><?php echo $opt['name'] ?></label>
                    </div>
                    <div class="contentMetaDesc selectContainer">
                        <select class="select selectMetabox" name="<?php echo $field_id ?>" id="<?php echo $field_id ?>">
                                <?php if(!empty($opt['default_option'])){ ?>
									<option value="default"><?php echo $opt['default_option']; ?></option>
								<?php }else{ ?>
									<option value="default">Select an Option</option>
								<?php } ?>
                                <?php if(!empty($opt['options'])){ ?>
	                                <?php foreach ($opt['options'] as $opt_value=>$opt_name): ?>
	                                        <option <?php isset($value_field)? selected($value_field, $opt_value) : '' ?> value="<?php echo $opt_value?>"><?php echo $opt_name?></option>
	                                <?php endforeach ?>
                                <?php }elseif($opt['post_type'] == 'user'){
									if(!empty($opt['user_args'])){
										$user_args = $opt['user_args'];
									}else{
										$user_args = array(
											'orderby' => 'id',
										);
									}
									$user_query = new WP_User_Query($user_args);
									if ( ! empty( $user_query->results ) ) {
										foreach ( $user_query->results as $user ) { ?>
											<option <?php isset($value_field)? selected($value_field, ($opt['return_by'] == 'id')? $user->ID : $user->display_name  ) : ''?> value="<?php echo ($opt['return_by'] == 'id')? $user->ID : $user->display_name; ?>"><?php echo $user->display_name ?></option>
									<?php }
									}
								}elseif($opt['post_type'] == 'taxonomy'){
									$taxonomy_args = array('orderby' => 'name');
									$taxonomies_type = $opt['taxonomy_type'];
									$taxonomies = get_terms($taxonomies_type,$taxonomy_args);
									foreach ( $taxonomies as $taxonomy ) { ?>
										<option <?php isset($value_field)? selected($value_field, ($opt['return_by'] == 'id')? $taxonomy->term_id : $taxonomy->name ) : '' ?> value="<?php echo ($opt['return_by'] == 'id')? $taxonomy->term_id : $taxonomy->name ?>"><?php echo $taxonomy->name ?></option>
									<?php }
								}else{
									if(isset($opt['relation']) && !empty($opt['relation'])){
										$taxonomy_query = array(
											'relation' => $opt['relation'],
										);
									}
									if(isset($opt['selected_taxonomy']) && !empty($opt['selected_taxonomy'])){
										foreach ($opt['selected_taxonomy'] as $taxonomy_key => $taxonomy_value) {
												$taxonomy_query[] = array(
													'taxonomy' => $taxonomy_key,
													'field'    => 'slug',
													'terms'    => $taxonomy_value,
												);		
										}
									}
									$post_args = array(
										'post_type' => $opt['post_type'],
										'tax_query' => $taxonomy_query
									);
									$select_posts = get_posts($post_args);
									foreach ($select_posts as $key => $select_post) {	
										setup_postdata( $select_post );
										?>
									<option <?php selected($value_field, ($opt['return_by'] == 'id')? $select_post->ID : $select_post->post_title)?> value="<?php echo ($opt['return_by'] == 'id')? $select_post->ID : $select_post->post_title; ?>"><?php echo $select_post->post_title ?></option>
									<?php 
									}
									wp_reset_postdata();
							} ?>
                        </select>
                    </div>
                    <?php 
               			if(isset($opt['desc'])) {
							echo '<p class="metaboxDescription">'.$opt['desc'].'</p>';
						}
               		?>
                </div>
                <?php
                break;
			case 'multiselect': ?>
                <div class="elementContent">
                    <div class="metaLabelContainer">
                        <label for="<?php echo $field_id ?>"><?php echo $opt['name'] ?></label>
                    </div>
                    <div class="contentMetaDesc selectContainer">
                        <select class="select selectMetabox multiSelect" name="<?php echo $field_id ?>[]" id="<?php echo $field_id ?>" multiple>
                                <?php if(!empty($opt['options'])){ ?>
	                                <?php foreach ($opt['options'] as $opt_value=>$opt_name): 
	                                	$selectedMulti = '';
										if(isset($value_field)){
											foreach($value_field as $valueSelect){
												if($valueSelect == $opt_value){
													$selectedMulti = selected($valueSelect, $opt_value,false);
												}
											}
										}
	                                	?>
	                                        <option <?php echo $selectedMulti; ?> value="<?php echo $opt_value?>"><?php echo $opt_name?></option>
	                                <?php endforeach ?>
                                <?php }elseif($opt['post_type'] == 'user'){
									if(!empty($opt['user_args'])){
										$user_args = $opt['user_args'];
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
											if($opt['return_by'] == 'id') {
												$userInfo = $user->ID;
											}else {
												$userInfo = $user->display_name;
											}
											if(isset($value_field)){
												foreach($value_field as $valueSelect){
													if($valueSelect == $userInfo){
														$selectedMulti = selected($valueSelect, ($opt['return_by'] == 'id')? $user->ID : $user->display_name,false);
													}
												}
											}
											?>
											<option <?php echo $selectedMulti; ?> value="<?php echo ($opt['return_by'] == 'id')? $user->ID : $user->display_name; ?>"><?php echo $user->display_name ?></option>
									<?php }
									}
								}elseif($opt['post_type'] == 'taxonomy'){
									$taxonomy_args = array(
										'orderby' => 'name',
										'hide_empty' => false,
									);
									$taxonomies_type = $opt['taxonomy_type'];
									$taxonomies = get_terms($taxonomies_type,$taxonomy_args);
									foreach ( $taxonomies as $taxonomy ) {
										$selectedMulti = '';
										$taxonomyInfo;
										if($opt['return_by'] == 'id') {
											$taxonomyInfo = $taxonomy->term_id;
										}else {
											$taxonomyInfo = $taxonomy->name;
										}
										if(isset($value_field)){
											foreach($value_field as $valueSelect){
												if($valueSelect == $taxonomyInfo){
													$selectedMulti = selected($valueSelect, ($opt['return_by'] == 'id')? $taxonomy->term_id : $taxonomy->name,false);
												}
											}	
										}
										 ?>
										<option <?php echo $selectedMulti; ?> value="<?php echo ($opt['return_by'] == 'id')? $taxonomy->term_id : $taxonomy->name ?>"><?php echo $taxonomy->name ?></option>
									<?php }
								}else{
									if(isset($opt['relation']) && !empty($opt['relation'])){
										$taxonomy_query = array(
											'relation' => $opt['relation'],
										);
									}
									if(isset($opt['selected_taxonomy']) && !empty($opt['selected_taxonomy'])){
										foreach ($opt['selected_taxonomy'] as $taxonomy_key => $taxonomy_value) {
												$taxonomy_query[] = array(
													'taxonomy' => $taxonomy_key,
													'field'    => 'slug',
													'terms'    => $taxonomy_value,
												);		
										}
									}
									$post_args = array(
										'post_type' => $opt['post_type'],
										'tax_query' => $taxonomy_query
									);
									$multi_select_posts = get_posts($post_args);
									foreach ($multi_select_posts as $key => $multi_select_post) {
										setup_postdata( $multi_select_post );
										$selectedMulti = '';
										$postInfo;
										if($opt['return_by'] == 'id') {
											$postInfo = $multi_select_post->ID;
										}else {
											$postInfo = $multi_select_post->post_title;
										}
										foreach($value_field as $valueSelect){
											if($valueSelect == $postInfo){
												$selectedMulti = selected($valueSelect, ($opt['return_by'] == 'id')? $multi_select_post->ID : $multi_select_post->post_title,false);
											}
										}
										?>
										<option <?php echo $selectedMulti ?> value="<?php echo ($opt['return_by'] == 'id')? $multi_select_post->ID : $multi_select_post->post_title; ?>"><?php echo $multi_select_post->post_title ?></option>
										<?php 
									}
									wp_reset_postdata();
								} ?>
                        </select>
                    </div>
                    <?php 
               			if(isset($opt['desc'])) {
							echo '<p class="metaboxDescription">'.$opt['desc'].'</p>';
						}
               		?>
                </div>
                <?php
                break;
			case 'color': ?>
					<div class="elementContent">
                    <div class="metaLabelContainer">
                        <label for="<?php echo $field_id ?>"><?php echo $opt['name'] ?></label>
                    </div>
                    <div class="contentMetaDesc">
                        <input type="text" class="gs-color" name="<?php echo $field_id ?>" id="<?php echo $field_id ?>"
                         value="<?php echo isset($value_field)? $value_field : '' ?>" />
               		</div>
               		<?php 
               			if(isset($opt['desc'])) {
							echo '<p class="metaboxDescription">'.$opt['desc'].'</p>';
						}
               		?>
                </div>
				<?php
				break;
			case 'image': ?>
				 <div class="elementContent">
				 	<div class="metaLabelContainer">
                        <label for="<?php echo $field_id ?>"><?php echo $opt['name'] ?></label>
                    </div>
                    <div class="contentMetaDesc">
						<div class="imageUploadMeta <?php echo !empty($value_field['url'])? 'activeImage' : '' ?>">
							<div class="metaboxImage">
								<img src="<?php echo isset($value_field['url'])? $value_field['url'] : '' ?>" id="<?php echo $id ?>_image" />
								<div class="removeImage"></div>
							</div>
						    <input type="hidden" class="holdURL" name="<?php echo $field_id ?>[url]" id="<?php echo $field_id ?>_url" 
						    		value="<?php if ( isset ( $value_field['url'] ) ){ echo $value_field['url']; } ?>" />
						   	<input type="hidden" class="holdID" name="<?php echo $field_id ?>[id]" id="<?php echo $field_id ?>_id" 
						    		value="<?php if ( isset ( $value_field['id'] ) ){ echo $value_field['id']; } ?>" />
						    <input type="hidden" class="holdTitle" name="<?php echo $field_id ?>[title]" id="<?php echo $field_id ?>_title" 
						    		value="<?php if ( isset ( $value_field['title'] ) ){ echo $value_field['title']; } ?>" />
						    <input type="hidden" class="holdAlt" name="<?php echo $field_id ?>[alt]" id="<?php echo $field_id ?>_alt" 
						    		value="<?php if ( isset ( $value_field['alt'] ) ){ echo $value_field['alt']; } ?>" />
						    <input type="hidden" class="holdEditLink" name="<?php echo $field_id ?>[edit]" id="<?php echo $field_id ?>_edit" 
						    		value="<?php if ( isset ( $value_field['edit'] ) ){ echo $value_field['edit']; } ?>" />
						    <input type="button" class="meta-image-button button" value="<?php _e( 'Upload Image', 'gs_metabox' )?>" />
					    </div>
				    </div>
				    <?php 
               			if(isset($opt['desc'])) {
							echo '<p class="metaboxDescription">'.$opt['desc'].'</p>';
						}
               		?>
			    </div>
			    <?php
			    break;
			case 'gallery': ?>
					<div class="elementContent">
					 	<div class="metaLabelContainer">
                            <label for="<?php  echo $id ?>[<?php echo $count_repeat ?>][<?php echo $opt['id'] ?>]"><?php echo $opt['name'] ?></label>
                        </div>
                        <div class="contentMetaDesc">
	                        <?php
	                        $gallery_ids = array();
	                        if(isset($value_field['id'])){
	                        	$gallery_ids = explode(",", $value_field['id']);
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
									<input type="hidden" class="galleryURLs" name="<?php echo $field_id ?>[url]" id="<?php echo $field_id ?>_url" 
						    				value="<?php if ( isset ( $value_field['url'] ) ){ echo $value_field['url']; } ?>" />
								   	<input type="hidden" class="galleryIDs" name="<?php echo $field_id ?>[id]" id="<?php echo $field_id ?>_id" 
								    		value="<?php if ( isset ( $value_field['id'] ) ){ echo $value_field['id']; } ?>" />
								    <input type="hidden" class="galleryTitles" name="<?php echo $field_id ?>[title]" id="<?php echo $field_id ?>_title" 
								    		value="<?php if ( isset ( $value_field['title'] ) ){ echo $value_field['title']; } ?>" />
								    <input type="hidden" class="galleryAlts" name="<?php echo $field_id ?>[alt]" id="<?php echo $field_id ?>_alt" 
								    		value="<?php if ( isset ( $value_field['alt'] ) ){ echo $value_field['alt']; } ?>" />
								    <input type="hidden" class="galleryEdits" name="<?php echo $field_id ?>[edit]" id="<?php echo $field_id ?>_edit" 
								    		value="<?php if ( isset ( $value_field['edit'] ) ){ echo $value_field['edit']; } ?>" />
									<input class="manage_gallery button" title="Manage gallery" type="button" value="Manage gallery" />
									<input class="clear_gallery button" title="clear gallery" type="button" value="clear gallery" />
								</div>
							</div>
						</div>
						 <?php 
               			if(isset($opt['desc'])) {
								echo '<p class="metaboxDescription">'.$opt['desc'].'</p>';
							}
                   		?>
					</div>
				<?php
				break;
			case 'file': ?>
				 <div class="elementContent">
				 	<div class="metaLabelContainer">
                        <label for="<?php echo $field_id ?>"><?php echo $opt['name'] ?></label>
                    </div>
                    <div class="contentMetaDesc">
						<div class="imageUploadMeta <?php echo !empty($value_field['url'])? 'activeImage' : '' ?>">
							<div class="filesContent">
								<div class="metaboxImage">
									<?php if(strrpos($value_field['url'],'.jpg') || strrpos($value_field['url'],'.jpeg') || strrpos($value_field['url'],'.png') || strrpos($value_field['url'],'.gif') ){ ?>
										<img src="<?php echo isset($value_field['url'])? $value_field['url'] : '' ?>" id="<?php echo $id ?>_file" />
									<?php }elseif(strrpos($value_field['url'],'.mp4') || strrpos($value_field['url'],'.webm') || strrpos($value_field['url'],'.mkv') || strrpos($value_field['url'],'.flv') || strrpos($value_field['url'],'.vob') || strrpos($value_field['url'],'.ogv') || strrpos($value_field['url'],'.ogg') || strrpos($value_field['url'],'.drc') || strrpos($value_field['url'],'.mng') || strrpos($value_field['url'],'.avi') || strrpos($value_field['url'],'.mov') || strrpos($value_field['url'],'.wmv') || strrpos($value_field['url'],'.yuv') || strrpos($value_field['url'],'.rmvb') || strrpos($value_field['url'],'.rm') || strrpos($value_field['url'],'.m4p') || strrpos($value_field['url'],'.m4v') || strrpos($value_field['url'],'.mpg') || strrpos($value_field['url'],'.mp2') || strrpos($value_field['url'],'.svi') || strrpos($value_field['url'],'.mxf') || strrpos($value_field['url'],'.qt')){ ?>
										<img src="<?php echo includes_url() ?>images/media/video.png" id="<?php echo $id ?>_file" /> 
									<?php }elseif(strrpos($value_field['url'],'.mp3') || strrpos($value_field['url'],'.mpc') || strrpos($value_field['url'],'.msv') || strrpos($value_field['url'],'.wav') || strrpos($value_field['url'],'.mmf') || strrpos($value_field['url'],'.m4a') || strrpos($value_field['url'],'.wma') || strrpos($value_field['url'],'.wv')){ ?>
										<img src="<?php echo includes_url() ?>images/media/audio.png" id="<?php echo $id ?>_file" /> 
									<?php }else{ ?>
										<img src="<?php echo includes_url() ?>images/media/document.png" id="<?php echo $id ?>_file" />
									<?php } ?>
									<div class="removeImage"></div>
								</div>
								<div class="metaboxImageTitle">
									<a href="<?php echo isset($value_field['edit'])? $value_field['edit'] : ''  ?>">
										<p><?php echo isset($value_field['title'])? $value_field['title'] : '' ?></p>
									</a>
								</div>
							</div>
						  <input type="hidden" class="holdURL" name="<?php echo $field_id ?>[url]" id="<?php echo $field_id ?>_url" 
						    		value="<?php if ( isset ( $value_field['url'] ) ){ echo $value_field['url']; } ?>" />
						   	<input type="hidden" class="holdID" name="<?php echo $field_id ?>[id]" id="<?php echo $field_id ?>_id" 
						    		value="<?php if ( isset ( $value_field['id'] ) ){ echo $value_field['id']; } ?>" />
						    <input type="hidden" class="holdTitle" name="<?php echo $field_id ?>[title]" id="<?php echo $field_id ?>_title" 
						    		value="<?php if ( isset ( $value_field['title'] ) ){ echo $value_field['title']; } ?>" />
						    <input type="hidden" class="holdAlt" name="<?php echo $field_id ?>[alt]" id="<?php echo $field_id ?>_alt" 
						    		value="<?php if ( isset ( $value_field['alt'] ) ){ echo $value_field['alt']; } ?>" />
						    <input type="hidden" class="holdEditLink" name="<?php echo $field_id ?>[edit]" id="<?php echo $field_id ?>_edit" 
						    		value="<?php if ( isset ( $value_field['edit'] ) ){ echo $value_field['edit']; } ?>" />
						    <input type="button" class="meta-file-button button" value="<?php _e( 'Upload File or Image', 'gs_metabox' )?>" />
					    </div>
				    </div>
				    <?php 
               			if(isset($opt['desc'])) {
							echo '<p class="metaboxDescription">'.$opt['desc'].'</p>';
						}
               		?>
			    </div>
			    <?php
			    break;
			case 'embed': ?>
                <div class="elementContent">
                    <div class="metaLabelContainer">
                        <label for="<?php echo $field_id ?>"><?php echo $opt['name'] ?></label>
                    </div>
                    <div class="contentMetaDesc">
                        <div class="embedContainer">
						<textarea type="text" class="embed" rows="3" cols="50" <?php if(isset($opt['placeholder']) && !empty($opt['placeholder'])){  ?> placeholder="<?php echo $opt['placeholder'] ?>" <?php } ?> name="<?php echo $field_id ?>" id="<?php echo $field_id ?>"><?php echo isset($value_field)? esc_attr($value_field) : '' ?></textarea>
						<input type="button" class="button embedButton" value="Preview">
						<div class="embedIframe"><?php echo isset($value_field)? $value_field : '' ?></div>
					</div>
               		</div>
               		<?php 
               			if(isset($opt['desc'])) {
							echo '<p class="metaboxDescription">'.$opt['desc'].'</p>';
						}
               		?>
                </div>
                <?php
                
                break;
			case 'slider': ?>
                <div class="elementContent">
                    <div class="metaLabelContainer">
                        <label for="<?php echo $field_id ?>"><?php echo $opt['name'] ?></label>
                    </div>
                    <div class="contentMetaDesc">
                        <div class="sliderMetaboxContainer">
							<span class="showSliderValue"><?php echo isset($value_field)? $value_field : $opt['slider_value']; ?></span>
							<div class="clearfix">
								<span class="minSlider"><?php echo $opt['min'] ?></span>
								<div class="sliderMetabox" data-content="0" data-animate="<?php echo $speed ?>" data-max="<?php echo $max ?>" data-min="<?php echo $min ?>" data-orientation="<?php echo $orientation ?>"
									 data-range="<?php echo $range ?>" data-step="<?php echo $step ?>" data-value="<?php echo isset($value_field)? $value_field : $opt['slider_value'] ?>" data-values="<?php echo $opt['slider_value'] ?>" 
									 name="<?php echo $field_id ?>_slider" id="<?php echo $id ?>-<?php echo $count_repeat ?>-<?php echo $opt['id'] ?>_slider"></div>
								<span class="maxSlider"><?php echo $opt['max'] ?></span>
							</div>
							<input type="hidden" class="inputSliderMetabox" name="<?php echo $id ?>[<?php echo $count_repeat ?>][<?php echo $opt['id'] ?>]" id="<?php echo $id ?>-<?php echo $count_repeat ?>-<?php echo $opt['id'] ?>" value="<?php echo isset($value_field)? $value_field : $opt['slider_value'] ?>" />
						</div>
               		</div>
               		<?php 
               			if(isset($opt['desc'])) {
							echo '<p class="metaboxDescription">'.$opt['desc'].'</p>';
						}
               		?>
                </div>
                <?php
                break;
			case 'editor': ?>
				<div class="elementContent">
				 	<div class="metaLabelContainer">
                        <label for="<?php echo $field_id ?>"><?php echo $opt['name'] ?></label>
                    </div>
                    <div class="contentMetaDesc tinymceContentMetaDesc">
                    	<div id="wp-<?php echo $id ?>-<?php echo $count_repeat ?>-<?php echo $opt['id'] ?>-media-buttons" class="wp-media-buttons">
                    		<a href="#" class="button insert-media add_media" data-editor="<?php echo $id ?>-<?php echo $count_repeat ?>-<?php echo $opt['id'] ?>" title="Add Media">
                    			<span class="wp-media-buttons-icon"></span> Add Media
                    		</a>
                    	</div>
						<textarea class="textareaTinyMCE" id="<?php echo $id ?>-<?php echo $count_repeat ?>-<?php echo $opt['id'] ?>" name="<?php echo $field_id ?>" style="min-height: 200px;"><?php echo isset($value_field)? $value_field : '' ?></textarea>
						<?php 
						if(isset($opt['desc'])) {
							echo '<p class="metaboxDescription">'.$opt['desc'].'</p>';
						}	
						?>
						
					</div>
				</div>
				<?php
				break;
        } 
		$fieldopt = $opt;
		$fieldopt['id'] = $field_id;
		$fieldopt['value'] = $value_field;
        do_action('gs_add_custom_repeated_field_type', $fieldopt);
        ?>
        <?php
        } ?>
        <span class="removeMeta icon-cancel-circled" data-number_metabox="<?php echo self::$count_metabox ?>" data-number="<?php echo $repeat_count_add; ?>"></span>                        
        </div>
        <?php
        $count_repeat++;
}while($count_repeat < count($data));
self::$count_repeat_js[self::$count_metabox][$repeat_count_add] = $count_repeat; 
?>
	</div>
    <span class="addNewMeta" data-number_metabox="<?php echo self::$count_metabox ?>" data-number="<?php echo $repeat_count_add; ?>"><?php echo __('Add New'); ?></span>
</div>
<?php
self::$count_metabox++;
$repeat_count_add++;

$type = '';
$name = '';
$id = '';
$desc = '';

$opt['type'] = '';
$opt['name'] = '';
$opt['id'] = '';
$opt['desc'] = '';
$opt['std'] = '';
$opt['placeholder'] = '';
$opt['tab'] = '';
$opt['options'] = array();
$opt['post_type'] = '';
$opt['default_option'] = '';
$opt['taxonomy_type'] = array();
$opt['selected_taxonomy'] = array();
$opt['relation'] = 'OR';
$opt['return_by'] = '';
$opt['user_args'] = array();
$opt['time_zone'] = FALSE;
$opt['date_format'] = 'yy-mm-dd';
$opt['time_format'] = 'hh-mm tt';
?>