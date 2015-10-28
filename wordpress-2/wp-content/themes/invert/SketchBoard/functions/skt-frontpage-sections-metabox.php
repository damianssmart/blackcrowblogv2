<?php
/*-----------------------------------------------------------------------------------*/
/*	ADD FRONTPAGE SECTION ORDER METABOXES
/*-----------------------------------------------------------------------------------*/

add_action('admin_init', 'skt_frontpagesection_metabox_order');
function skt_frontpagesection_metabox_order(){
	add_meta_box('skt-fpage-sections-order-metaboxes', 'Home Page Sections Order', 'skt_frontpagesection_metabox_order_callback', 'page', 'normal', 'high');
}

// METABOX CALLBACK
function skt_frontpagesection_metabox_order_callback() { 
	global $post;
	$_skt_frontpage_sections_order = get_post_meta( $post->ID,'_skt_frontpage_sections_order',true );
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
?>
<?php _e('You can re-order the home page sections via drag & drop ','advertica'); ?>

<ul id="skt-frontpage-sections">
	<?php 
	if(isset($_skt_frontpage_sections_order) && $_skt_frontpage_sections_order !="") {
		$_skt_frontpage_sections_order = $_skt_frontpage_sections_order;
	}else{
		$_skt_frontpage_sections_order = array('Featured Box Section','Call to Action Section','Latest Project Section','Product Section','Content Box with Parallax Effect Section','Team Member Section','Client Logo Section','Page Content');
	}
	
	foreach($_skt_frontpage_sections_order as $fsection){ 
		?>
		<li><input type="text" value="<?php echo $fsection; ?>" name="_skt_frontpage_sections_order[]" readonly="readonly" /></li>
		<?php 
	} 
			
	?>
</ul>

<?php 
} 

// Action when save post
add_action('save_post', 'skt_admin_save_frontpagesection_order');

/* When the post is saved, saves our custom data */
function skt_admin_save_frontpagesection_order( $post_id ) {

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
	if(isset($_POST['_skt_frontpage_sections_order'])){ 
		$_skt_frontpage_sections_order = $_POST['_skt_frontpage_sections_order']; 

		foreach($_skt_frontpage_sections_order as $fsection){
			$orderSection[] = $fsection;
		}
	}
	
	global $post;
	if(isset($_skt_frontpage_sections_order)){ update_post_meta($post->ID, '_skt_frontpage_sections_order', $orderSection); }
	
  // probably using add_post_meta(), update_post_meta(), or 
  // a custom table (see Further Reading section below)
}
/*-----------------------------------------------------------------------------------*/
/*-----------------------------------------------------------------------------------*/


// REVSLIDER ----------------------------------
// --------------------------------------------
$prefix = 'invert_';
if ( class_exists( 'RevSlider' ) ) {
	$slider = new RevSlider();
	$arrSliders = $slider->getArrSliders();
	$ids = array();
	foreach ( $arrSliders as $slider ) {
		$alias = $slider->getAlias();
		$ids[] = $alias;
	}
}
if ( empty( $ids ) ) {
	$ids = array( __( 'No slides found, please add some slides', 'invert' ) );
}

$meta_box_page_revolution = array(
	'id' => 'invert-meta-box-page-revolution',
	'title' =>  __( 'Revolution Slider Settings', 'invert' ),
	'page' => 'page',
	'context' => 'normal', 
	'priority' => 'default',
	'fields' => array(
		array( 
			"name" => __( 'Revolution Slider', 'invert' ),
			"desc" => __( 'Choose Revolution Slider you would like to display.', 'invert' ),
			"id" => "_".$prefix."revslider_alias",
			'type' => 'select',
			'std' => '',
			'options' => $ids
		)
	)
);

/*-----------------------------------------------------------------------------------*/
/*	ADD FRONTPAGE SECTION METABOXES
/*-----------------------------------------------------------------------------------*/

// ADD METABOX
add_action('admin_init', 'skt_frontpagesection_metabox');
function skt_frontpagesection_metabox(){
	add_meta_box('frontpagesection-metabox', 'Home Page Template Sections', 'skt_frontpagesection_metabox_callback', 'page', 'normal', 'high');
}

// METABOX CALLBACK
function skt_frontpagesection_metabox_callback() { 
	global  $meta_box_page_revolution,$post;
	$fraturedbox          = get_post_meta( $post->ID,'_skt_freaturedboxsection_metabox',true );
	$ctameta              = get_post_meta( $post->ID,'_skt_calltoaction_metabox',true );
	$latestprojectmeta    = get_post_meta( $post->ID,'_skt_latestproject_metabox',true );
	$_skt_products_metabox= get_post_meta( $post->ID,'_skt_products_metabox',true );
	$parallaxeffectmeta   = get_post_meta( $post->ID,'_skt_parallaxeffect_metabox',true );
	$teammembermeta       = get_post_meta( $post->ID,'_skt_teammember_metabox',true );
	$teammembermetacall   = get_post_meta( $post->ID,'_skt_teammember_call',true );
	$teammembersel1       = get_post_meta( $post->ID,'_skt_teammember_sel1',true );
	$teammembersel2       = get_post_meta( $post->ID,'_skt_teammember_sel2',true );
	$teammembersel3       = get_post_meta( $post->ID,'_skt_teammember_sel3',true );
	$clientlogometa       = get_post_meta( $post->ID,'_skt_clientlogo_metabox',true );
	$tweetfeedmeta        = get_post_meta( $post->ID,'_skt_twfeed_metabox',true );
	$frontslider_set_meta = get_post_meta( $post->ID,'_skt_allslider_metabox',true );
	$skt_teammember_call_meta = get_post_meta( $post->ID,'_skt_teammember_call',true );
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
?>

<table>
	<tr>
		<td>
			<h4><?php _e('Slider Section','invert');?></h4>
		</td>
		<td>
			<div class="skt-slider-set inputbox">
				<div class="tab-slider">
					<label for="skt_allslider_metabox3"><input type="radio" name="_skt_allslider_metabox" id="skt_allslider_metabox3" class="skt_allslider_metabox" value="video" rel="video" checked="checked" <?php checked('video', $frontslider_set_meta); ?> /><?php _e('Video &nbsp;&nbsp;&nbsp;&nbsp;','invert') ?></label>
					<label for="skt_allslider_metabox1"><input type="radio" name="_skt_allslider_metabox" id="skt_allslider_metabox1" class="skt_allslider_metabox" value="flex" rel="flex"  <?php checked('flex', $frontslider_set_meta); ?> /><?php _e('Flex Slider &nbsp;&nbsp;&nbsp;&nbsp;','invert') ?></label> 
					<label for="skt_allslider_metabox2"><input type="radio" name="_skt_allslider_metabox" id="skt_allslider_metabox2" class="skt_allslider_metabox" value="rev" rel="rev"  <?php checked('rev', $frontslider_set_meta); ?> /><?php _e('Revolution Slider &nbsp;&nbsp;&nbsp;&nbsp;','invert') ?></label>
					<label for="skt_allslider_metabox4"><input type="radio" name="_skt_allslider_metabox" id="skt_allslider_metabox4" class="skt_allslider_metabox" value="withoutall" rel="withoutall" <?php checked('withoutall', $frontslider_set_meta); ?>/><?php _e('None of these &nbsp;&nbsp;&nbsp;&nbsp;','invert') ?></label>
				</div>
				<div class="allslider-inner" id="rev" <?php if($frontslider_set_meta == "rev") { echo "style='display:block;'"; } ?>>
					<input type="hidden" name="invert_meta_box_nonce" value="<?php wp_create_nonce(basename(__FILE__)) ?>" />
					<table class="form-table invert-custom-table">
						<?php
							foreach ( $meta_box_page_revolution['fields'] as $field ) {
							
								// get current post meta data
								if ( isset ( $field['id'] ) ) {
									$meta = get_post_meta( $post->ID, $field['id'], true );
								}

								switch ( $field['type'] ) {

									//If Select	
									case 'select': ?>
									<tr>
										<td style="width:50%"><label for="<?php echo $field['id']; ?>"><strong><?php echo $field['name']; ?></strong><span style="display:block;"><?php echo $field['desc']; ?></span></label></td>
										<td style="border:none;">
											<select id="<?php echo $field['id']; ?>" name="<?php echo $field['id']; ?>">
												<?php
												foreach ( $field['options'] as $option ) {
													echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
												} ?>
											</select>
										</td>
									</tr>
								<?php 
								break;
							}
						} ?>
					</table>
				</div>
				<div class="allslider-inner" id="video" <?php if($frontslider_set_meta == "video") { echo "style='display:block;'"; } ?>>
					<strong><?php _e('Put video url ( Youtube or Vimeo )','invert');?></strong>
					<input type="text" id="skt_video_section" name="_skt_video_section" value="<?php echo get_post_meta($post->ID, '_skt_video_section',true);?>"  style="width:100%;" />
				 </div>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<h4><?php _e('Featured Box Section','invert');?></h4>
		</td>
		<td>
			<div class="inputbox">
				<label for="skt_freaturedboxsection_metabox1"><input type="radio" name="_skt_freaturedboxsection_metabox" id="skt_freaturedboxsection_metabox1" value="1" checked="checked"  <?php checked(1, $fraturedbox); ?> /><?php _e('Enable &nbsp;&nbsp;&nbsp;&nbsp;','invert') ?></label>
				<label for="skt_freaturedboxsection_metabox2"><input type="radio" name="_skt_freaturedboxsection_metabox" id="skt_freaturedboxsection_metabox2" value="0" <?php checked(0, $fraturedbox); ?> /><?php _e('Disable','invert') ?></label>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<h4><?php _e('Call to Action Section','invert');?></h4>
		</td>
		<td>
		<div class="inputbox">
			<label for="skt_calltoaction_metabox1"><input type="radio" name="_skt_calltoaction_metabox" id="skt_calltoaction_metabox1" value="1" checked="checked"  <?php checked(1, $ctameta); ?> /><?php _e('Enable &nbsp;&nbsp;&nbsp;&nbsp;','invert') ?></label>
			<label for="skt_calltoaction_metabox2"><input type="radio" name="_skt_calltoaction_metabox" id="skt_calltoaction_metabox2" value="0" <?php checked(0, $ctameta); ?> /><?php _e('Disable','invert') ?></label>
		</div>
		</td>
	</tr>
	<tr>
		<td>
			<h4><?php _e('Latest Project Section','invert');?></h4>
		</td>
		<td>
			<div class="inputbox">
			<label for="skt_latestproject_metabox1"><input type="radio" name="_skt_latestproject_metabox" id="skt_latestproject_metabox1" value="1" checked="checked"  <?php checked(1, $latestprojectmeta); ?> /><?php _e('Enable &nbsp;&nbsp;&nbsp;&nbsp;','invert') ?></label>
			<label for="skt_latestproject_metabox2"><input type="radio" name="_skt_latestproject_metabox" id="skt_latestproject_metabox2" value="0" <?php checked(0, $latestprojectmeta); ?> /><?php _e('Disable','invert') ?></label>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<h4><?php _e('Product Section','invert');?></h4>
		</td>
		<td>
			<div class="inputbox">
				<label for="skt_products_metabox1"><input type="radio" name="_skt_products_metabox" id="skt_products_metabox1" value="1" checked="checked"  <?php checked(1, $_skt_products_metabox); ?> /><?php _e('Enable &nbsp;&nbsp;&nbsp;&nbsp;','invert') ?></label>
				<label for="skt_products_metabox2"><input type="radio" name="_skt_products_metabox" id="skt_products_metabox2" value="0" <?php checked(0, $_skt_products_metabox); ?> /><?php _e('Disable','invert') ?></label>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<h4><?php _e('Content Box with Parallax Effect Section','invert');?></h4>
		</td>
		<td>
			<div class="inputbox">
				<label for="skt_parallaxeffect_metabox1"><input type="radio" name="_skt_parallaxeffect_metabox" id="skt_parallaxeffect_metabox1" value="1" checked="checked"  <?php checked(1, $parallaxeffectmeta);?> /><?php _e('Enable &nbsp;&nbsp;&nbsp;&nbsp;','invert') ?></label>
				<label for="skt_parallaxeffect_metabox2"><input type="radio" name="_skt_parallaxeffect_metabox" id="skt_parallaxeffect_metabox2" value="0" <?php checked(0, $parallaxeffectmeta);?> /><?php _e('Disable','invert') ?></label>
			</div>
		</td>
	</tr>
   
    <tr>
		<td>
			<h4><?php _e('Team Member Section','invert');?></h4>
		</td>
		<td style="">
			<div class="inputbox">
				<label for="skt_teammember_metabox1"><input type="radio" name="_skt_teammember_metabox" class="skt_teammember_metabox" id="skt_teammember_metabox1" value="1" rel="team_open"  checked="checked"  <?php checked(1, $teammembermeta);?> /><?php _e('Enable &nbsp;&nbsp;&nbsp;&nbsp;','invert') ?></label>
				<label for="skt_teammember_metabox2"><input type="radio" name="_skt_teammember_metabox" class="skt_teammember_metabox" id="skt_teammember_metabox2" value="0" rel="team_close"  <?php checked(0, $teammembermeta);?> /><?php _e('Disable','invert') ?></label>
			</div>

			<div class="team_member_items" <?php if($teammembermeta === "1") { echo "style='display:block;'"; } ?>>
				<div class="team_member_settings" <?php if($teammembermeta === "1") { echo "style='display:block;'"; } ?>>
					<label for="skt_teammember_call1"><input type="radio" name="_skt_teammember_call" id="skt_teammember_call1" class="skt_teammember_call" value="latest" rel="latest" checked="checked"   <?php checked('latest', $teammembermetacall);?> /><?php _e('Latest Team Members &nbsp;&nbsp;&nbsp;&nbsp;','invert') ?></label>
					<label for="skt_teammember_call2"><input type="radio" name="_skt_teammember_call" id="skt_teammember_call2" class="skt_teammember_call" value="specific" rel="specific"  <?php checked('specific', $teammembermetacall);?> /><?php _e('Specific Team Members &nbsp;&nbsp;&nbsp;&nbsp;','invert') ?></label>
				</div>
				<div class="team_member_selections" id="specific" <?php if($skt_teammember_call_meta === "specific" && $teammembermeta === "1") { echo "style='display:block;'"; } ?>>
					<?php
						$teamposts = get_posts('post_type=team_member&posts_per_page=-1');
						if(!$teamposts) {
							_e('<b style="color:red;">Please Add Team Members To Select.</b>','invert');
						}
					?>
					<div class="team_blocks">
						<?php
							$teampostype = get_posts('post_type=team_member&posts_per_page=-1');
							if($teampostype) : ?>
							<label for="team_memsel1"><?php _e('First Team Member','invert');?></label>
							<select id="team_memsel1" name="_skt_teammember_sel1">
								<?php foreach ( $teampostype as $teampost  ) : ?>
								<option value="<?php echo $teampost->ID; ?>" <?php selected( $teammembersel1, $teampost->ID ); ?>><?php echo $teampost->post_title; ?></option>
								<?php endforeach; ?>
							</select>
						<?php endif ?>
					</div>
					<div class="team_blocks">
						<?php
							if($teampostype) : ?>
							<label for="team_memsel2"><?php _e('Second Team Member','invert');?></label>
							<select id="team_memsel2" name="_skt_teammember_sel2">
								<?php print_r($teampostype) ?>
								<?php foreach ( $teampostype as $teampost  ) : ?>
									<option value="<?php echo $teampost->ID; ?>" <?php selected( $teammembersel2, $teampost->ID ); ?>><?php echo $teampost->post_title; ?></option>
								<?php endforeach; ?>
							</select>
						<?php endif ?>
					</div>
					<div class="team_blocks">
						<?php
							$teampostype = get_posts('post_type=team_member&posts_per_page=-1');
							if($teampostype) : ?>
							<label for="team_memsel3"><?php _e('Third Team Member','invert');?></label>
							<select id="team_memsel3" name="_skt_teammember_sel3">
								<?php foreach ( $teampostype as $teampost  ) : ?>
								<option value="<?php echo $teampost->ID; ?>" <?php selected( $teammembersel3, $teampost->ID ); ?>><?php echo $teampost->post_title; ?></option>
								<?php endforeach; ?>
							</select>
						<?php endif ?>
					</div>
				</div>
			</div>
		</td>
    </tr>
	<tr>
		<td>
			<h4><?php _e('Client Logo Section','invert');?></h4>
		</td>
		<td>
			<div class="inputbox">
				<label for="skt_clientlogo_metabox1"><input type="radio" name="_skt_clientlogo_metabox" id="skt_clientlogo_metabox1" value="1" checked="checked"  <?php checked(1, $clientlogometa);?> /><?php _e('Enable &nbsp;&nbsp;&nbsp;&nbsp;','invert') ?></label>
				<label for="skt_clientlogo_metabox2"><input type="radio" name="_skt_clientlogo_metabox" id="skt_clientlogo_metabox2" value="0" <?php checked(0, $clientlogometa);?> /><?php _e('Disable','invert') ?></label>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<h4><?php _e('Twitter Feed Section','invert');?></h4>
		</td>
		<td>
			<div class="inputbox">
				<label for="skt_twfeed_metabox1"><input type="radio" name="_skt_twfeed_metabox" id="skt_twfeed_metabox1" value="1"  <?php checked(1, $tweetfeedmeta);?> /><?php _e('Enable &nbsp;&nbsp;&nbsp;&nbsp;','invert') ?></label>
				<label for="skt_twfeed_metabox2"><input type="radio" name="_skt_twfeed_metabox" id="skt_twfeed_metabox2" value="0"  <?php checked(0, $tweetfeedmeta);?> /><?php _e('Disable','invert') ?></label>
			</div>
		</td>
	</tr>
</table>	
<?php 
} 

// Action when save post
add_action('save_post', 'skt_admin_save_frontpagesection');

/* When the post is saved, saves our custom data */
function skt_admin_save_frontpagesection( $post_id ) {
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
	if(isset($_POST['_skt_allslider_metabox'])){ $skt_allslider_metabox = $_POST['_skt_allslider_metabox']; }
	if(isset($_POST['_skt_freaturedboxsection_metabox'])){ $skt_freaturedboxsection_metabox = $_POST['_skt_freaturedboxsection_metabox']; }
	if(isset($_POST['_skt_calltoaction_metabox'])){ $skt_calltoaction_metabox = $_POST['_skt_calltoaction_metabox']; }
	if(isset($_POST['_skt_latestproject_metabox'])){ $skt_latestproject_metabox = $_POST['_skt_latestproject_metabox']; }
	if(isset($_POST['_skt_products_metabox'])){ $_skt_products_metabox = $_POST['_skt_products_metabox']; }
	if(isset($_POST['_skt_parallaxeffect_metabox'])){ $skt_parallaxeffect_metabox = $_POST['_skt_parallaxeffect_metabox']; }
	if(isset($_POST['_skt_teammember_metabox'])){ $skt_teammember_metabox = $_POST['_skt_teammember_metabox']; }
	if(isset($_POST['_skt_teammember_call'])){ $_skt_teammember_call = $_POST['_skt_teammember_call']; }
	if(isset($_POST['_skt_teammember_sel1'])){ $_skt_teammember_sel1 = $_POST['_skt_teammember_sel1']; }
	if(isset($_POST['_skt_teammember_sel2'])){ $_skt_teammember_sel2 = $_POST['_skt_teammember_sel2']; }
	if(isset($_POST['_skt_teammember_sel3'])){ $_skt_teammember_sel3 = $_POST['_skt_teammember_sel3']; }
	if(isset($_POST['_skt_clientlogo_metabox'])){ $skt_clientlogo_metabox = $_POST['_skt_clientlogo_metabox']; }
	if(isset($_POST['_skt_twfeed_metabox'])){ $skt_twfeed_metabox = $_POST['_skt_twfeed_metabox']; }
	if(isset($_POST['_skt_video_section'])){ $skt_video_section = $_POST['_skt_video_section']; }
	if(isset($_POST['_skt_statics_metabox'])){ $skt_statics_section = $_POST['_skt_statics_metabox']; }
	if(isset($_POST['_skt_staticsarea_section'])){ $skt_statics_area_section = $_POST['_skt_staticsarea_section']; }
	
	global $meta_box_page_revolution,$post;
	
	if(isset($skt_allslider_metabox)){ update_post_meta($post->ID, '_skt_allslider_metabox', $skt_allslider_metabox); }
	if(isset($skt_freaturedboxsection_metabox)){ update_post_meta($post->ID, '_skt_freaturedboxsection_metabox', $skt_freaturedboxsection_metabox); }
	if(isset($skt_calltoaction_metabox)){ update_post_meta($post->ID, '_skt_calltoaction_metabox', $skt_calltoaction_metabox); }
	if(isset($skt_latestproject_metabox)){ update_post_meta($post->ID, '_skt_latestproject_metabox', $skt_latestproject_metabox); }
	if(isset($_skt_products_metabox)){ update_post_meta($post->ID, '_skt_products_metabox', $_skt_products_metabox); }
	if(isset($skt_parallaxeffect_metabox)){ update_post_meta($post->ID, '_skt_parallaxeffect_metabox', $skt_parallaxeffect_metabox); }
	if(isset($skt_teammember_metabox)){ update_post_meta($post->ID, '_skt_teammember_metabox', $skt_teammember_metabox); }
	if(isset($_skt_teammember_call)){ update_post_meta($post->ID, '_skt_teammember_call', $_skt_teammember_call); }
	if(isset($_skt_teammember_sel1)){ update_post_meta($post->ID, '_skt_teammember_sel1', $_skt_teammember_sel1); }
	if(isset($_skt_teammember_sel2)){ update_post_meta($post->ID, '_skt_teammember_sel2', $_skt_teammember_sel2); }
	if(isset($_skt_teammember_sel3)){ update_post_meta($post->ID, '_skt_teammember_sel3', $_skt_teammember_sel3); }

	if(isset($skt_clientlogo_metabox)){ update_post_meta($post->ID, '_skt_clientlogo_metabox', $skt_clientlogo_metabox); }
	if(isset($skt_twfeed_metabox)){ update_post_meta($post->ID, '_skt_twfeed_metabox', $skt_twfeed_metabox); }
	if(isset($skt_video_section)){ update_post_meta($post->ID, '_skt_video_section', $skt_video_section); }
	if(isset($skt_statics_section)){ update_post_meta($post->ID, '_skt_statics_metabox', $skt_statics_section); }
	if(isset($skt_statics_area_section)){ update_post_meta($post->ID, '_skt_staticsarea_section', $skt_statics_area_section); }

	if(isset($_REQUEST['post_type']) && $_REQUEST['post_type'] === 'page' && isset($post->ID)) {
		foreach ( $meta_box_page_revolution['fields'] as $field ) {
			if ( isset($field['id'] ) ) {
				$old = get_post_meta($post_id, $field['id'], true);
				$new = $_POST[$field['id']];
				
				if ($new && $new != $old) {
					update_post_meta($post_id, $field['id'], stripslashes(html_entity_decode($new)));
				} elseif ('' == $new && $old) {
					delete_post_meta($post_id, $field['id'], $old);
				}
			}
		}
	}
  // Do something with $mydata 
  // probably using add_post_meta(), update_post_meta(), or 
  // a custom table (see Further Reading section below)
}
?>
