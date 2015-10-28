<?php
/*---------------------------------------------------------------*/
/*	ADD PAGETITLE SECTION METABOXES
/*---------------------------------------------------------------*/
// Add metabox
add_action('admin_init', 'skt_pagetitle_metabox');
function skt_pagetitle_metabox(){
	add_meta_box('pagetitle-metabox', 'Page Title Section', 'skt_pagetitle_metabox_callback', 'page');
}

// Metabox callback
function skt_pagetitle_metabox_callback() { 
	global $post;
	$value = get_post_meta( $post->ID,'_skt_pagetitle_metabox',true );
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
?>
<table>
	<tr>
		<td>
			<h4><?php _e('Page Title','invert');?></h4>
		</td>
	<td>
		<div class="inputbox">
			<label for="skt_pagetitle_metabox1"><input type="radio" name="_skt_pagetitle_metabox" id="skt_pagetitle_metabox1" value="1" checked="checked"  <?php checked(1, $value);?> /><?php _e('Enable &nbsp;&nbsp;&nbsp;&nbsp;','invert') ?></label>
			<label for="skt_pagetitle_metabox2"><input type="radio" name="_skt_pagetitle_metabox" id="skt_pagetitle_metabox2" value="0" <?php checked(0, $value);?> /><?php _e('Disable','invert') ?></label>
		</div>
	</td>
   </tr>

  <tr>
	<td>
		<h4><?php _e('Page Title Background Image','invert');?></h4>
	</td>
	<td>
		<p>
			<label for="upload_image">
				<input id="skt_pagetitle_bg" class="upload_meta_image" type="text" size="36" name="skt_pagetitle_bg" value="<?php echo get_post_meta(get_the_ID(), '_pagetitle_bg', true); ?>" />
				<input class="upload_image_button" type="button" value="Upload Image" /><br/>
				<span class="hint"><?php _e('Recommend width:1600px and height:450px ', 'invert'); ?></span>
			</label>
		</p>
	 </td>
  </tr>
</table>
<?php } 

// Action when save post
add_action('save_post', 'skt_admin_save_pagetitle');
/* When the post is saved, saves our custom data */
function skt_admin_save_pagetitle( $post_id ) {
	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	// Check permissions
	if(isset($_POST['post_type'])) {
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
	
	// OK, we're authenticated: we need to find and save the data
	if(isset($_POST['_skt_pagetitle_metabox'])){ $skt_pagetitle_metabox = $_POST['_skt_pagetitle_metabox']; }
	if(isset($_POST['skt_pagetitle_bg'])){ $skt_pagetitle_bg = $_POST['skt_pagetitle_bg']; }
	
	global $post;
	if(isset($skt_pagetitle_metabox)){ update_post_meta($post->ID, '_skt_pagetitle_metabox', $skt_pagetitle_metabox); }
	if(isset($skt_pagetitle_bg)){ update_post_meta($post->ID, '_pagetitle_bg', $skt_pagetitle_bg); }
	// Do something with $mydata 
	// probably using add_post_meta(), update_post_meta(), or 
	// a custom table (see Further Reading section below)
}
?>