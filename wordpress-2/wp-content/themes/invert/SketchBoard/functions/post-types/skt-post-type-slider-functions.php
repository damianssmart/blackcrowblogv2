<?php
add_action( 'init', 'invert_slider_post_type' );
function invert_slider_post_type() {
	global $invert_shortname;
	register_post_type( 'slides',
	array(
		'labels' => array(
			'name' => ucwords($invert_shortname).__( ' Slides','invert'),
			'singular_name' => __( 'Slide','invert'),
			'add_new' => __('Add Slide','invert'),
			'add_new_item' => __('Add New Slide','invert'),
			'edit_item' => __('Edit Slide','invert'),
			'new_item' => __('New Slide','invert'),
			'all_items' => __('All Slides','invert'),
			'view_item' => __('View Slide','invert')
		),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => false, 
		'hierarchical' => false,
		'menu_icon' => get_template_directory_uri() . '/images/icn_slides.png',
		'rewrite' => array('slug' => 'slides'),
		'supports' => array('title','editor','thumbnail','excerpt','custom-fields')
	));
}

/*---------------------------------------------------------------------*/
/*	ADD SLIDER LINK METABOXES
/*---------------------------------------------------------------------*/
// Add metabox
add_action('admin_init', 'skt_sliderlink_metabox');
function skt_sliderlink_metabox(){
	add_meta_box('sliderlink-metabox', 'Slider Link', 'skt_slider_link_metabox_callback', 'slides', 'normal');
}

// Metabox callback
function skt_slider_link_metabox_callback() { ?>
	<table width="100%">	
		<tr class="alternate">
			<th class="left"><?php _e('Enter Link Text','invert');  ?></th>
			<td>
				<p><input type="text" name="_slider_link_text" id="_slider_link_text" class="regular-text" value="<?php echo get_post_meta(get_the_ID(), '_slider_link_text', true); ?>" ></p>
			</td>
		</tr>
		<tr class="alternate">
			<th class="left"><?php _e('Enter Link','invert');  ?></th>
			<td>
				<p><input type="text" name="_slider_link" id="_slider_link" class="regular-text" value="<?php echo get_post_meta(get_the_ID(), '_slider_link', true); ?>" ></p>
			</td>
		</tr>
	</table>
<?php 
} 

// Action when save post
add_action('save_post', 'skt_admin_save_sliderlink');
function skt_admin_save_sliderlink($post_id){ 
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Check permissions
	if(isset($_POST['post_type'])){
		if ( 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		}
	}
	else{
		if ( !current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}	
		
	if(isset($_POST['_slider_link_text'])){ $skt_slider_link_text = $_POST['_slider_link_text']; }
	if(isset($_POST['_slider_link'])){ $skt_slider_link = $_POST['_slider_link']; }
	global $post;
	if(isset($skt_slider_link_text)){ update_post_meta($post->ID, '_slider_link_text', $skt_slider_link_text); }
	if(isset($skt_slider_link)){ update_post_meta($post->ID, '_slider_link', $skt_slider_link); }
}