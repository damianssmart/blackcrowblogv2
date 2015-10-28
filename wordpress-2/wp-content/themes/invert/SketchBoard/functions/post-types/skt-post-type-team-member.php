<?php

/*------------------------------------------------------------------------*/

/*	REGISTER TEAM MEMBER POST FORMAT.

/*------------------------------------------------------------------------*/

add_action( 'init', 'skt_teammember_posttype_init' );



if ( !function_exists( 'skt_teammember_posttype_init' ) ) :

function skt_teammember_posttype_init() {

	global $invert_shortname;

	$skt_teammember_labels = array(

		'name' =>  ucwords($invert_shortname).__(' Team Member','invert' ),

		'singular_name' => _x('teammember', 'post type singular name','invert'),

		'add_new' => _x('Add New', 'team member','invert'),

		'add_new_item' => __('Add New Team Member','invert'),

		'edit_item' => __('Edit Team Member','invert'),

		'new_item' => __('New Team Member','invert'),

		'all_items' => __('All Team Member','invert'),

		'view_item' => __('View Team Member','invert'),

		'search_items' => __('Search Team Member','invert'),

		'not_found' =>  __('No Team Member found','invert'),

		'not_found_in_trash' => __('No Team Member found in Trash','invert'), 

		'parent_item_colon' => '',

		'menu_name' => ucwords($invert_shortname).__(' Team','invert')

	);

	$skt_teammember_args = array(

		'labels' => $skt_teammember_labels,

		'public' => true,

		'publicly_queryable' => true,

		'show_ui' => true, 

		'show_in_menu' => true, 

		'query_var' => true,

		'rewrite' => true,

		'capability_type' => 'post',

		'has_archive' => true, 

		'hierarchical' => false,

		'rewrite' => array('slug' => 'team-member-post'),

		'menu_icon' => get_template_directory_uri().'/images/custom_Person-group.png',

		'supports' => array( 'title' )

	); 

	register_post_type( 'team_member', $skt_teammember_args );

}

endif;



/*------------------------------------------------------------------------*/

/*	ADD TEAMMEMBER METABOXES

/*------------------------------------------------------------------------*/

// Add metabox

add_action('admin_init', 'skt_team_member_metabox');

function skt_team_member_metabox(){

	add_meta_box('team-member-metabox', 'Team Member Data', 'skt_team_member_metabox_callback', 'team_member', 'normal');

}



// Metabox callback

function skt_team_member_metabox_callback() { ?>

	<input type="hidden" name="skt_page_post_id" id="skt_page_post_id" value="<?php echo get_the_ID(); ?>" />

	<table width="100%">	

		<tr class="alternate">

			<th class="left"><?php _e('Content','invert');  ?></th>

			<td>

				<p><textarea rows="2" cols="80" name="teammember-content" id="teammember-content"><?php echo get_post_meta(get_the_ID(), '_teammember_content', true); ?></textarea></p>

			</td>

		</tr>

		<tr class="alternate">

			<th class="left"><?php _e('By (Name)','invert');  ?></th>

			<td>

				<p><input type="text" name="teammember-name" id="teammember-name" class="regular-text" value="<?php echo get_post_meta(get_the_ID(), '_teammember_name', true); ?>" ></p>

			</td>

		</tr>

		<tr class="alternate" >

			<th class="left"><?php _e('Avatar','invert') ?></th>

			<td>

				<p>

					<label for="upload_image">

						<input id="teammember-avatar" class="upload_meta_image" type="text" size="36" name="teammember-avatar" value="<?php echo get_post_meta(get_the_ID(), '_teammember_avatar', true); ?>" />

						<input class="upload_image_button" type="button" value="Upload Image" />

						<span class="hint"><?php _e('Recommend 176px * 176px', 'invert'); ?></span>

					</label>

				</p>

			</td>

		</tr>

		<tr class="alternate">

			<th class="left"><?php _e('Job title','invert');  ?></th>

			<td>

				<p><input type="text" name="teammember-job" id="teammember-job" class="regular-text" value="<?php echo get_post_meta(get_the_ID(), '_teammember_job', true); ?>" ></p>

			</td>

		</tr>

		<tr class="alternate">

			<th class="left"><?php _e('Website','invert');  ?></th>

			<td>

				<p><input type="text" name="teammember-website" id="teammember-website" class="regular-text" value="<?php echo get_post_meta(get_the_ID(), '_teammember_website', true); ?>" ></p>

			</td>

		</tr>

		<tr class="alternate">

			<th class="left"><?php _e('Facebook Url','invert');  ?></th>

			<td>

				<p><input type="text" name="teammember-fb" id="teammember-fb" class="regular-text" value="<?php echo get_post_meta(get_the_ID(), '_teammember_fb', true); ?>" ></p>

			</td>

		</tr>

		<tr class="alternate">

			<th class="left"><?php _e('Twitter Url','invert');  ?></th>

			<td>

				<p><input type="text" name="teammember-tw" id="teammember-tw" class="regular-text" value="<?php echo get_post_meta(get_the_ID(), '_teammember_tw', true); ?>" ></p>

			</td>

		</tr>

		<tr class="alternate">

			<th class="left"><?php _e('Dribbble Url','invert');  ?></th>

			<td>

				<p><input type="text" name="teammember-drb" id="teammember-drb" class="regular-text" value="<?php echo get_post_meta(get_the_ID(), '_teammember_drb', true); ?>" ></p>

			</td>

		</tr>

		<tr class="alternate">

			<th class="left"><?php _e('Mail id','invert');  ?></th>

			<td>

				<p><input type="text" name="teammember-mailid" id="teammember-mailid" class="regular-text" value="<?php echo get_post_meta(get_the_ID(), '_teammember_mailid', true); ?>" ></p>

			</td>

		</tr>

		<tr class="alternate">

			<th class="left"><?php _e('Skype id','invert');  ?></th>

			<td>

				<p><input type="text" name="teammember-skype" id="teammember-skype" class="regular-text" value="<?php echo get_post_meta(get_the_ID(), '_teammember_skype', true); ?>" ></p>

			</td>

		</tr>

	</table>

<?php }



// Action when save post

add_action('save_post', 'skt_admin_save_teammember');

function skt_admin_save_teammember($post_id){

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {

		return;

	}

	if( isset($_POST['post_type']) && 'team_member' == $_POST['post_type'] ){

		if( isset($_POST['teammember-content']) ){

			update_post_meta($post_id, '_teammember_content', $_POST['teammember-content']);

		}

		if( isset($_POST['teammember-name']) ){

			update_post_meta($post_id, '_teammember_name', $_POST['teammember-name']);

		}

		if( isset($_POST['teammember-job']) ){

			update_post_meta($post_id, '_teammember_job', $_POST['teammember-job']);

		}

		if( isset($_POST['teammember-website']) ){

			update_post_meta($post_id, '_teammember_website', $_POST['teammember-website']);

		}

		if( isset($_POST['teammember-avatar']) ){

			update_post_meta($post_id, '_teammember_avatar', $_POST['teammember-avatar']);

		}

		if( isset($_POST['teammember-fb']) ){

			update_post_meta($post_id, '_teammember_fb', $_POST['teammember-fb']);

		}

		if( isset($_POST['teammember-tw']) ){

			update_post_meta($post_id, '_teammember_tw', $_POST['teammember-tw']);

		}

		if( isset($_POST['teammember-drb']) ){

			update_post_meta($post_id, '_teammember_drb', $_POST['teammember-drb']);

		}

		if( isset($_POST['teammember-mailid']) ){

			update_post_meta($post_id, '_teammember_mailid', $_POST['teammember-mailid']);

		}

		if( isset($_POST['teammember-skype']) ){

			update_post_meta($post_id, '_teammember_skype', $_POST['teammember-skype']);

		}

	}

}