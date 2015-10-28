<?php
/*-----------------------------------------------------------------*/
/*	ADD QUOTE METABOXES
/*-----------------------------------------------------------------*/
// Add metabox
add_action('admin_init', 'skt_quote_metabox');
function skt_quote_metabox(){
	add_meta_box('quote-metabox', 'Quote', 'skt_quote_metabox_callback', 'post');
}

// Metabox callback
function skt_quote_metabox_callback() { ?>
	<div class="inner" id="citation">
		<h4><?php _e('Quote','invert');?></h4>
		<textarea id="skt_postType_citation" name="_skt_postType_citation"  style="width:100%;"><?php echo get_post_meta(get_the_ID(), '_skt_postType_citation',true); ?></textarea>
		<h4><?php _e('Author','invert');?></h4>
		<input type="text" id="skt_postType_citation_author" name="_skt_postType_citation_author" value="<?php echo get_post_meta(get_the_ID(), '_skt_postType_citation_author',true);?>"  style="width:100%;" />
		<h4><?php _e('Author Url','invert');?></h4>
		<input type="text" id="skt_postType_citation_author_url" name="_skt_postType_citation_author_url" value="<?php echo get_post_meta(get_the_ID(), '_skt_postType_citation_author_url',true);?>"  style="width:100%;" />
	</div>
<?php }

/*-----------------------------------------------------------------*/
/*	ADD VIDEO METABOXES
/*-----------------------------------------------------------------*/
// Add metabox
add_action('admin_init', 'skt_video_metabox');
function skt_video_metabox() {
	add_meta_box('video-metabox', 'Video', 'skt_video_metabox_callback', 'post');
}

// Metabox callback
function skt_video_metabox_callback() { ?>
	<div class="inner" id="video">
		<h4><?php _e('Put the YouTube Video Url Here.','invert');?></h4>
		<input id="skt_postType_youtubevideo" name="_skt_postType_youtubevideo" style="width:80%;" value="<?php echo get_post_meta(get_the_ID(), '_skt_postType_youtubevideo',true); ?>" />
		<h4><?php _e('OR','invert');?></h4>
		<h4><?php _e('Put the Vimeo Video Url Here.','invert');?></h4>
		<input id="skt_postType_vimeovideo" name="_skt_postType_vimeovideo" style="width:80%;" value="<?php echo get_post_meta(get_the_ID(), '_skt_postType_vimeovideo',true); ?>" />
	</div>
<?php 
}

/*-----------------------------------------------------------------------------------*/
/*	ADD GALLERY METABOXES
/*-----------------------------------------------------------------------------------*/
// Add metabox
add_action('admin_init', 'skt_gallery_metabox');
function skt_gallery_metabox(){
	add_meta_box('gallery-metabox', 'Gallery', 'skt_gallery_metabox_callback', 'post');
}

// Metabox callback
function skt_gallery_metabox_callback() { ?>
	<div class="inner" id="slider">
		<h4><?php _e('you can use image attachment or nothing...','invert');?></h4>
		<h4><?php _e('Slider Auto Scroll on/off','invert');?></h4>
		<select id="skt_postType_slider_auscroll" name="_skt_postType_slider_auscroll" style="width:50%;">
			<?php $autoscroll = get_post_meta(get_the_ID(), '_skt_postType_slider_auscroll',true); ?>
			<option value="true" <?php selected('true', $autoscroll);?>><?php _e('true','invert');?></option>
			<option value="false" <?php selected('false', $autoscroll);?>><?php _e('false','invert');?></option>
		</select>	
		<h4><?php _e('Slider direction Navigation on/off','invert');?></h4>
		<select id="skt_postType_slider_direction" name="_skt_postType_slider_direction" style="width:50%;">
			<?php $direction = get_post_meta(get_the_ID(), '_skt_postType_slider_direction',true); ?>
			<option value="true" <?php selected('true', $direction);?>><?php _e('true','invert');?></option>
			<option value="false" <?php selected('false', $direction);?>><?php _e('false','invert');?></option>
		</select>	
	</div>
<?php }

// Action when save post
add_action('save_post', 'skt_admin_save_postformat');
/* When the post is saved, saves our custom data */
function skt_admin_save_postformat( $post_id ) {
	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
	  return;
	}
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	// Check permissions
	if(isset($_POST['post_type'])){
		if ( 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		}
	}
	else {
		if ( !current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}
	
    // OK, we're authenticated: we need to find and save the data
	if(isset($_POST['_skt_postType_youtubevideo'])){ $skt_postType_youtubevideo = $_POST['_skt_postType_youtubevideo']; }
	if(isset($_POST['_skt_postType_vimeovideo'])){ $skt_postType_vimeovideo = $_POST['_skt_postType_vimeovideo']; }
	if(isset($_POST['_skt_postType_citation'])){ $skt_postType_citation = $_POST['_skt_postType_citation']; }
	if(isset($_POST['_skt_postType_citation_author'])){ $skt_postType_citation_author = $_POST['_skt_postType_citation_author']; }
	if(isset($_POST['_skt_postType_citation_author_url'])){ $skt_postType_citation_author_url = $_POST['_skt_postType_citation_author_url']; }
	if(isset($_POST['_skt_postType_slider_auscroll'])){ $skt_postType_slider_auscroll = $_POST['_skt_postType_slider_auscroll']; }
	if(isset($_POST['_skt_postType_slider_direction'])){ $skt_postType_slider_direction = $_POST['_skt_postType_slider_direction']; }
	
	global $post;
	if(isset($skt_postType_youtubevideo)){ update_post_meta($post->ID, '_skt_postType_youtubevideo', $skt_postType_youtubevideo); }
	if(isset($skt_postType_vimeovideo)){ update_post_meta($post->ID, '_skt_postType_vimeovideo', $skt_postType_vimeovideo); }
	if(isset($skt_postType_citation)){ update_post_meta($post->ID, '_skt_postType_citation', $skt_postType_citation); }
	if(isset($skt_postType_citation_author)){ update_post_meta($post->ID, '_skt_postType_citation_author', $skt_postType_citation_author); }
	if(isset($skt_postType_citation_author_url)){ update_post_meta($post->ID, '_skt_postType_citation_author_url', $skt_postType_citation_author_url); }
	if(isset($skt_postType_slider_auscroll)){ update_post_meta($post->ID, '_skt_postType_slider_auscroll', $skt_postType_slider_auscroll); }
	if(isset($skt_postType_slider_direction)){ update_post_meta($post->ID, '_skt_postType_slider_direction', $skt_postType_slider_direction); }
  // Do something with $mydata 
  // probably using add_post_meta(), update_post_meta(), or 
  // a custom table (see Further Reading section below)
}
?>