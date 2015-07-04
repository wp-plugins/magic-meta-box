<?php
/*
Plugin Name: Magic Meta Box
Plugin URI: https://wordpress.org/plugins/magic-meta-box/
Description: Easy To Create Metabox For Your Theme
Version: 2.2
Author: Abdelrhman ElGreatly
License: GPLv2
*/
class MagicMetaBox {

    protected $meta_box;
    protected $id;
    static $prefix = '_mmb-gs_';
	static $count_metabox = 0;
	static $count_repeat_js = array();
	static $show_metabox = array();
    // create meta box based on given data
    public function __construct($id, $opts) {
       	require_once plugin_dir_path( __FILE__ ) . 'shortcode/shortcode.php';
        if (!is_admin())
            return;
        $this->meta_box = $opts;
        $this->id = $id;

        add_action('add_meta_boxes', array(&$this, 'gsmb_add'));

        add_action('save_post', array(&$this, 'gsmb_save'));

        add_action('admin_enqueue_scripts', array(&$this, 'gsmb_add_metabox_style'));

        add_action('admin_enqueue_scripts', array(&$this, 'gsmb_add_metabox_script'));

        require_once plugin_dir_path( __FILE__ ) . 'includes/metabox-ajax.php';
    }

    function gsmb_add_metabox_style() {
        if (is_admin()) {

            wp_enqueue_style('wp-color-picker');
			wp_register_style('fonts', plugins_url( 'css/fonts.css', __FILE__ ));
            wp_enqueue_style('fonts');
			
            wp_register_style('jqueryUICSS', plugins_url( 'css/jquery-ui.min.css', __FILE__ ));
            wp_enqueue_style('jqueryUICSS');
            
            wp_register_style('select2CSS', plugins_url( 'css/select2.min.css', __FILE__ ));
            wp_enqueue_style('select2CSS');
            
            wp_register_style('jquery-ui-timepicker-addon-css', plugins_url( 'css/jquery-ui-timepicker-addon.min.css', __FILE__ ));
            wp_enqueue_style('jquery-ui-timepicker-addon-css');
            
            /* style Theme Option */
            wp_register_style('metaBoxGeneratorCSS', plugins_url( 'css/metabox.css', __FILE__ ));
            wp_enqueue_style('metaBoxGeneratorCSS');
        }
    }

    function gsmb_add_metabox_script() {
        if (is_admin()) {
            wp_enqueue_media();
            
            wp_register_script('googleMapJS', 'https://maps.googleapis.com/maps/api/js?libraries=places');
            wp_enqueue_script('googleMapJS');
            
            wp_register_script('mapJS', plugins_url( 'js/meta-box-map.js', __FILE__ ), array('jquery'));

            wp_register_script('select2JS', plugins_url( 'js/select2.min.js', __FILE__ ), array('jquery'));
            wp_enqueue_script('select2JS');

            wp_register_script('jquery-ui-timepicker-addon-js', plugins_url( 'js/jquery-ui-timepicker-addon.min.js', __FILE__ ), array('jquery-ui-datepicker', 'jquery-ui-slider', 'jquery'));
            wp_enqueue_script('jquery-ui-timepicker-addon-js');

            wp_register_script('metaboxGallery', plugins_url( 'js/metabox-gallery.js', __FILE__ ), array('jquery'));
            wp_localize_script('metaboxGallery', 'gs_meta_Ajax', array('ajaxurl' => admin_url('admin-ajax.php')));
            wp_enqueue_script('metaboxGallery');
            // Registers and enqueues the required javascript.
            wp_register_script('metaboxImage', plugins_url( 'js/meta-box-image.js', __FILE__ ), array('jquery'));
            wp_localize_script('metaboxImage', 'meta_image', array(
                'title' => __('Upload an Image', 'gs_metabox'),
                'button' => __('Use this image', 'gs_metabox'),
                    )
            );
            wp_enqueue_script('metaboxImage');
			
            wp_register_script('metaboxFile', plugins_url( 'js/meta-box-file.js', __FILE__ ), array('jquery'));
            wp_localize_script('metaboxFile', 'meta_file', array(
                'title' => __('Upload an file', 'gs_metabox'),
                'button' => __('Use this file', 'gs_metabox'),
                'pdf_image' => includes_url() . 'images/media/document.png',
                'video_image' => includes_url() . 'images/media/video.png',
                'audio_image' => includes_url() . 'images/media/audio.png',
               )
            );
            wp_enqueue_script('metaboxFile');
            // Add the color picker css file
            wp_register_script('metabox_js', plugins_url( 'js/metabox.js', __FILE__ ), array('wp-color-picker', 'jquery-ui-datepicker', 'jquery-ui-spinner', 'jquery-ui-slider'));
			
			wp_register_script('show-hide-metabox', plugins_url( 'js/show-hide-metabox.js', __FILE__ ), array('jquery'));
        }
    }

    // Add meta box for multiple post types
    public function gsmb_add() {
        foreach ($this->meta_box['pages'] as $page) {
            add_meta_box($this->id, $this->meta_box['title'], array(&$this, 'gsmb_show'), $page, $this->meta_box['context'], $this->meta_box['priority']);
        }
    }

    // Callback function to show fields in meta box
    public function gsmb_show($post) {
        // Use nonce for verification
        wp_nonce_field('smartmetabox' . $this->id, $this->id . '_meta_box_nonce');
        ?>
            <?php if (isset($this->meta_box['tabs']) || !empty($this->meta_box['tabs'])) { ?>
            <ul class="tabsMetabox">
                    <?php foreach ($this->meta_box['tabs'] as $key => $value) { ?>
                    <li id="<?php echo $key ?>" class="metaboxGeneratorTab"><?php echo $value; ?></li>
            <?php } ?>
            </ul>
        <?php } ?>
        <?php
        if (isset($this->meta_box['tabs']) || !empty($this->meta_box['tabs'])) {
            echo '<table class="form-table tableWithTabs metaboxTable">';
        } else {
            echo '<table class="form-table metaboxTable">';
        }
        $options = '';
        $repeat_count_add = 0;
		if(isset($this->meta_box['show']) && !empty($this->meta_box['show'])){
			foreach ($this->meta_box['show'] as $key => $metaboxShow) {
				if($key != 'template' && $key != 'post_format' && $key != 'relation'){
					for($i = 0; $i < count($this->meta_box['show'][$key]); $i++){
						if(is_string($metaboxShow[$i])){
							$term_obj = get_term_by('name', $metaboxShow[$i], $key);
							$this->meta_box['show'][$key][$i] = $term_obj->term_id;
						}
					}
				}
			}
			if(!isset($this->meta_box['show']['relation']) || empty($this->meta_box['show']['relation'])){
				$this->meta_box['show']['relation'] = 'or';
			}
			self::$show_metabox[$this->id] = $this->meta_box['show'];
			$show_metabox = array(
	            'show' => self::$show_metabox,
	        );
			wp_localize_script('show-hide-metabox', 'gs_show_hide', $show_metabox);
			wp_enqueue_script('show-hide-metabox');
		}
        foreach ($this->meta_box['fields'] as $field) {
            extract($field);
            $id = self::$prefix . $id;
            $value = self::gsmb_get($field['id']);
            if (empty($value) && !sizeof(self::gsmb_get($field['id'], false))) {
                $value = isset($field['std']) ? $std : '';
            }
            echo '<tr  data-tab="' . $tab . '">',
            '<th style="width:20%"><label for="', $id, '">', $name, '</label>';
            if ($type == 'repeat') {
                if (isset($desc)) {
                    echo '<p class="mainMetaDiscription metaDiscription">' . $desc . '</p>';
                }
            }
            echo '</th> <td>';
            if ($type == 'repeat') {
                include( 'includes/repeater-fields.php' );
            } else {
                include( 'includes/fields.php' );
            }
            echo '</td></tr>';
        }
        $metabox_array = array(
            'count_repeat' => self::$count_repeat_js,
            'ajaxurl' => admin_url('admin-ajax.php'),
            'includes' => includes_url(),
            'theme_url' => get_template_directory_uri(),
        );
        wp_localize_script('metabox_js', 'gs_metabox', $metabox_array);
		wp_enqueue_script('metabox_js');
        echo '</table>';
    }

    // Save data from meta box
    public function gsmb_save($post_id) {
        // verify nonce
        if (!isset($_POST[$this->id . '_meta_box_nonce']) || !wp_verify_nonce($_POST[$this->id . '_meta_box_nonce'], 'smartmetabox' . $this->id)) {
            return $post_id;
        }

        // check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        // check permissions
        if ('post' == $_POST['post_type']) {
            if (!current_user_can('edit_post', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }

        foreach ($this->meta_box['fields'] as $field) {
            $name = self::$prefix . $field['id'];
            if (isset($_POST[$name]) || isset($_FILES[$name])) {
                $old = self::gsmb_get($field['id'], true, $post_id);
                $new = $_POST[$name];
                if ($new != $old) {
                    self::gsmb_set($field['id'], $new, $post_id);
                }
            } elseif ($field['type'] == 'checkbox' || $field['type'] == 'multicheckbox') {
                /*
                 * Checkboxes are not send in POST if they are not checked;
                 * We should set them to 'false' instead of deleting them;
                 * Otherwise, we won't be able to distinguish them from new fields, which have not been saved yet.
                 */
                self::gsmb_set($field['id'], 'false', $post_id);
            } elseif ($field['type'] == 'multiselect') {
                $old = self::gsmb_get($field['id'], true, $post_id);
                $new = $_POST[$name];
                if ($new != $old) {
                    self::gsmb_set($field['id'], $new, $post_id);
                }
            } else {
                self::gsmb_delete($field['id'], $name);
            }
        }
		//die;
    }

    static function gsmb_get($name, $single = true, $post_id = null) {
        global $post;

        return get_post_meta(isset($post_id) ? $post_id : $post->ID, self::$prefix . $name, $single);
    }

    static function gsmb_set($name, $new, $post_id = null) {
        global $post;
        return update_post_meta(isset($post_id) ? $post_id : $post->ID, self::$prefix . $name, $new);
    }

    static function gsmb_delete($name, $post_id = null) {
        global $post;

        return delete_post_meta(isset($post_id) ? $post_id : $post->ID, self::$prefix . $name);
    }

}

;

function add_magic_meta_box($id, $opts) {
    new MagicMetaBox($id, $opts);
}

function gs_get_field($name, $post_id = null, $single = true) {
    global $post;
    return MagicMetaBox::gsmb_get($name, $single, isset($post_id) ? $post_id : $post->ID);
}
