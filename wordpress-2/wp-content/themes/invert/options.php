<?php

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {
	global $invert_shortname;
	global $invert_themename;
	// This gets the theme name from the stylesheet

	$invert_themename = get_option( 'stylesheet' );
	$invert_themename = preg_replace("/\W/", "_", strtolower($invert_themename) );
	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $invert_themename;
	update_option( 'optionsframework', $optionsframework_settings );

}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 * If you are making your theme translatable, you should replace 'invert'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
*/

function optionsframework_options() {

	global $invert_shortname;
	global $invert_themename;
	
	// Background Defaults
	$background_style = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	//mode_test_array
		$mode_test_array = array(
			'fade' => __('Fade', 'invert'),
			'slide' => __('Slide', 'invert')
		);

     //showcontrols_test_array
	   $showcontrols_test_array = array(
			'true' => __('Enable', 'invert'),
			'false' => __('Disable', 'invert')
		);

	//map_hide_array
	   $map_hide_array = array(
			'true' => __('Show', 'invert'),
			'false' => __('Hide', 'invert')
		);

	//filter_hide_array
   $port_filter_hide_array = array(
		'true' => __('Show', 'invert'),
		'false' => __('Hide', 'invert')
	);

	//direction_arra
	$direction_array = array(
		'horizontal' => __('Horizontal', 'invert'),
		'vertical' => __('Vertical', 'invert')
	);

	$bread_type = array(
		'brimage' => __('Image', 'invert'),
		'brcolor' => __('Color', 'invert')
	);

	//showmarkers_array
	$showmarkers_array = array(
		'true' => __('Yes', 'invert'),
		'false' => __('No', 'invert')
	);

	//pauseonhover_array

	$pauseonhover_array = array(
		'true' => __('Yes', 'invert'),
		'false' => __('No', 'invert')
	);

	// pagination
	$test_pagiarray = array(
		1 => __('Yes', 'invert'),
		0 => __('No', 'invert')
	);

	// rss_feed_icon

	$test_rss_feed_icon = array(
		1 => __('Yes', 'invert'),
		0 => __('No', 'invert')
	);

	//breadcumhide_array
	$breadcumhide_array = array(
		'true' => __('Enable', 'invert'),
		'false' => __('Disable', 'invert')
	);
	
	//shrink _array
	$shrink_array = array(
		'true' => __('Enable', 'invert'),
		'false' => __('Disable', 'invert')
	);

	// cgmap infostatus
	$cgmap_infowin = array(
		'open' => __('Open', 'invert'),
		'close' => __('Close', 'invert')
	);

	// cgmap marker animation
	$cgmap_markanim = array(
		'BOUNCE' => __('Bounce', 'invert'),
		'DROP' => __('Drop', 'invert')
	);
	

	// cgmap zoom level
	$cgmap_zoomlevel = array(
		'1' => __('1', 'invert'),
		'2' => __('2', 'invert'),
		'3' => __('3', 'invert'),
		'4' => __('4', 'invert'),
		'5' => __('5', 'invert'),
		'6' => __('6', 'invert'),
		'7' => __('7', 'invert'),
		'8' => __('8', 'invert'),
		'9' => __('9', 'invert'),
		'10' => __('10', 'invert'),
		'11' => __('11', 'invert'),
		'12' => __('12', 'invert'),
		'13' => __('13', 'invert'),
		'14' => __('14', 'invert'),
		'15' => __('15', 'invert'),
		'16' => __('16', 'invert'),
		'17' => __('17', 'invert'),
		'18' => __('18', 'invert'),
		'19' => __('19', 'invert'),
		'20' => __('20', 'invert'),
		'21' => __('21', 'invert')
	);

	// cgmap map type
	$cgmap_maptype = array(
		'ROADMAP'  => __('ROADMAP', 'invert'),
		'SATELLITE'=> __('SATELLITE', 'invert'),
		'HYBRID'   => __('HYBRID', 'invert'),
		'TERRAIN'  => __('TERRAIN', 'invert')
	);
	
	// WooCommerce Shop/Single Page Layout
	$woo_pagelayout = array(
		'left-sidebar'  => __('Left Sidebar', 'invert'),
		'right-sidebar'=> __('Right Sidebar', 'invert'),
		'no-sidebar'   => __('No Sidebar', 'invert'),
	);
	$woo_product_categories = get_terms('product_cat', 'orderby=count&hide_empty=0&fields=id=>slug');
	
	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array

	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// set pages
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath   =  get_template_directory_uri() . '/images/';
	$twitterInfo = 'http://www.sketchthemes.com/tutorials/getting-new-twitter-api-consumer-and-secret-keys/';

	$options = array();
	
	//General Settings
	$options[] = array(
		'name' => __('General Settings', 'invert'),
		'type' => 'heading');

	$options[] = array(
			'name' => __('Choose Theme Color', 'invert'),
			'desc' => __('', 'invert'),
			'id' => $invert_shortname.'_colorpicker',
			'std' => '#D83B2D',
			'type' => 'color' );

	$options[] = array(
			'name' => __('Change logo (full path to logo image size: 120px width and 40px height)', 'invert'),
			'desc' => __('This creates a Custom logo that previews the image.', 'invert'),
			'id' => $invert_shortname.'_logo_img',
			'std' => $imagepath.'Invert-Logo.png',
			'type' => 'upload');

	$options[] = array(
			'name' => __('Logo Image Width (in px)', 'invert'),
			'desc' => __('Enter Logo Image Width in PX.', 'invert'),
			'id' => $invert_shortname.'_logo_wdth',
			'class' => 'mini',
			'std' => '114',
			'type' => 'text');

	$options[] = array(
			'name' => __('Logo Image Height (in px)', 'invert'),
			'desc' => __('Enter Logo Image Height in PX.', 'invert'),
			'id' => $invert_shortname.'_logo_hght',
			'class' => 'mini',
			'std' => '40',
			'type' => 'text');

	$options[] = array(
			'name' => __('Logo ALT Text', 'invert'),
			'desc' => __('Logo ALT Text field.', 'invert'),
			'id' => $invert_shortname.'_logo_alt',
			'std' => 'sketch themes',
			'type' => 'text');

	$options[] = array(
			'name' => __('Change favicon', 'invert'),
			'desc' => __('This creates a Custom favicon that previews the image.', 'invert'),
			'id' => $invert_shortname.'_favicon',
			'std' => $imagepath.'Invert_favicon.png',
			'type' => 'upload');

	$options[] = array(
			'name' => __('Choose Header Background Color', 'invert'),
			'desc' => __('', 'invert'),
			'id' => $invert_shortname.'_headercolorpicker',
			'std' => '#ffffff',
			'type' => 'color' );

	$options[] = array(
			'name' => __('Choose Navigation Font Color', 'invert'),
			'desc' => __('', 'invert'),
			'id' => $invert_shortname.'_navfontcolorpicker',
			'std' => '#333333',
			'type' => 'color' );
			
	$options[] = array(
			'name' => __('Choose Navigation Hover Background Color', 'invert'),
			'desc' => __('', 'invert'),
			'id' => $invert_shortname.'_navhovercolorpicker',
			'std' => '#333333',
			'type' => 'color' );

	 $options[] = array(
			'name' => __('Show Custom Pagination', 'invert'),
			'desc' => __('Show custom pagination on blog/project page.', 'invert'),
			'id' => $invert_shortname.'_show_pagination',
			'std' => 'yes',
			'type' => 'select',
			'class' => 'mini', //mini, tiny, small
			'options' => $test_pagiarray);

	$options[] = array(
			'name' => __('Mobile Menu Activate From', 'invert'),
			'desc' => __('Enter value in px for mobile menu activation.', 'invert'),
			'id' => $invert_shortname.'_mobi_menu_width',
			'std' => '1025',
			'type' => 'text');

	//Bg style
	$options[] = array(
				'name' =>  __('Custom Background', 'invert'),
				'desc' => __('Change the background CSS.', 'invert'),
				'id' => $invert_shortname.'_bg_style',
				'std' => $background_style,
				'type' => 'background' );
				
	$options[] = array(
			'name' => __('Header Shrink  Enable/Disable:', 'invert'),
			'desc' => __('Radio select with default options "Enable".', 'invert'),
			'id' => $invert_shortname.'_shrink_endi',
			'std' => 'true',
			'type' => 'radio',
			'options' => $shrink_array);

	$options[] = array(
			'name' => __('Home Template Video Height (in pixel)', 'invert'),
			'desc' => __('Enter home template video height in pixel.', 'invert'),
			'id' => $invert_shortname.'_homevideo_hght',
			'class' => 'mini',
			'std' => '500',
			'type' => 'text');
			

	//Breadcrumb	
	$options[] = array(
		'name' => __('Breadcrumb Settings', 'invert'),
		'type' => 'heading');

	$options[] = array(
			'name' => __('Breadcrumb Enable/Disable:', 'invert'),
			'desc' => __('Radio select with default options "Enable".', 'invert'),
			'id' => $invert_shortname.'_hide_bread',
			'std' => 'true',
			'type' => 'radio',
			'options' => $breadcumhide_array);

	$options[] = array(
			'name' => __('Page Title & Breadcrumb Background Type', 'invert'),
			'desc' => __('Default ( image ).', 'invert'),
			'id' => $invert_shortname.'_bread_stype',
			'std' => 'brimage',
			'type' => 'radio',
			'options' => $bread_type);

    $options[] = array(
			'name' => __('Choose Page Title & Breadcrumb Background Color', 'invert'),
			'desc' => __('No color selected by default.', 'invert'),
			'id' => $invert_shortname.'_bread_color',
			'std' => '#F2F2F2',
			'type' => 'color',
			'class'=>'hidden' );

    $options[] = array(
			'name' => __('Upload Page Title & Breadcrumb Background Image (size: 1600px width and 450px height)', 'invert'),
			'desc' => __('This creates a full size uploader that previews the image.', 'invert'),
			'id' => $invert_shortname.'_bread_image',
			'std' => $imagepath.'danbo_green.jpg',
			'type' => 'upload',
			'class'=>'hidden');


	$options[] = array(
			'name' => __('Choose Page Title & Breadcrumb Color', 'invert'),
			'desc' => __('No color selected by default.', 'invert'),
			'id' => $invert_shortname.'_bread_title_color',
			'std' => '#222222',
			'type' => 'color' );

	//Blog	
	$options[] = array(
		'name' => __('Blog Page Settings', 'invert'),
		'type' => 'heading');

	//Blog page Title
	$options[] = array(
			'name' => __('Enter Blog page Title:', 'invert'),
			'desc' => __('Enter Blog page Title.', 'invert'),
			'id' => $invert_shortname.'_blogpage_heading',
			'std' => 'Blog',
			'type' => 'text');		

	//Team Member Section	
	$options[] = array(
		'name' => __('Team Member Section Settings', 'invert'),
		'type' => 'heading');

		 $options[] = array(
			'name' => __('Choose Team Member Section Background Color', 'invert'),
			'desc' => __('', 'invert'),
			'id' => $invert_shortname.'_teamcolorpicker',
			'std' => '#FAAE33',
			'type' => 'color' );

		 $options[] = array(
			'name' => __('Choose Team Member Title & Border Color', 'invert'),
			'desc' => __('', 'invert'),
			'id' => $invert_shortname.'_teamtitlecolor',
			'std' => '#ffffff',
			'type' => 'color' );

		//Teammember Title
		$options[] = array(
			'name' => __('TeamMember Title:', 'invert'),
			'desc' => __('Enter TeamMember title.', 'invert'),
			'id' => $invert_shortname.'_teammember_title',
			'std' => 'Team Member',
			'type' => 'text');

	//Teammember description
	    $options[] = array(
			'name' => __('Team Member Sub-Title:', 'invert'),
			'desc' => __('Enter Team Member Sub-Title.', 'invert'),
			'id' => $invert_shortname.'_teamsub_title',
			'std' => 'Lorem ipsum dolor sit amet, feugiat delicata liberavisse.',
			'type' => 'text');

	    $options[] = array(
			'name' => __('About Template Number of Team Member', 'invert'),
			'desc' => __('Enter Number of Team Member that you want to show on About Template.', 'invert'),
			'id' => $invert_shortname.'_numbet_team_member',
			'std' => '6',
			'type' => 'text');

		$options[] = array(
			'name' => __('Team Member Description (Content) Word Limit', 'invert'),
			'desc' => __('Enter word limit for team member content.', 'invert'),
			'id'   => $invert_shortname.'_team_cont_limit',
			'std'  => '20',
			'type' => 'text');		
			
			

	//Project	
	$options[] = array(
		'name' => __('Project Page Template Settings', 'invert'),
		'type' => 'heading');

		$options[] = array(
			'name' => __('Show/Hide Projects Filter Section:', 'invert'),
			'desc' => __('If Show, Show Projects Filter .', 'invert'),
			'id' => $invert_shortname.'_hide_pro_filter',
			'std' => 'true',
			'type' => 'radio',
			'options' => $port_filter_hide_array);

//Slider Setting
	$options[] = array(
		'name' => __('Home Template Flex Slider Configuration', 'invert'),
		'type' => 'heading');

		 $options[] = array(
				'name' => __('Select Mode', 'invert'),
				'desc' => __('Select Mode.', 'invert'),
				'id' => $invert_shortname.'_mode_select',
				'std' => 'fade',
				'type' => 'select',
				'class' => 'mini', //mini, tiny, small
				'options' => $mode_test_array);

		  $options[] = array(
			'name' => __('Direction', 'invert'),
			'desc' => __('Select the sliding direction, "horizontal" or "vertical".', 'invert'),
			'id' => $invert_shortname.'_direction',
			'std' => 'true',
			'type' => 'select',
			'class' => 'mini', //mini, tiny, small
			'options' => $direction_array);

			$options[] = array(
				'name' => __('Slideshow Speed in milliseconds', 'invert'),
				'desc' => __('Set the speed of the slideshow cycling, in milliseconds.', 'invert'),
				'id' => $invert_shortname.'_slideshowspeed',
				'std' => '7000',
				'type' => 'text');

			$options[] = array(
				'name' => __('Animation Speed in milliseconds', 'invert'),
				'desc' => __('Set the speed of animations, in milliseconds.', 'invert'),
				'id' => $invert_shortname.'_animspeed',
				'std' => '600',
				'type' => 'text');

		$options[] = array(
				'name' => __('show next and prev controls', 'invert'),
				'desc' => __('If Show, show next and prev controls.', 'invert'),
				'id' => $invert_shortname.'_showcontrols',
				'std' => '',
				'type' => 'select',
				'class' => 'mini', //mini, tiny, small
				'options' => $showcontrols_test_array);

	   $options[] = array(
				'name' => __('Show individual slide markers', 'invert'),
				'desc' => __('Create navigation for paging control of each slide.', 'invert'),
				'id' => $invert_shortname.'_showmarkers',
				'std' => 'true',
				'type' => 'select',
				'class' => 'mini', //mini, tiny, small
				'options' => $showmarkers_array);

		$options[] = array(
				'name' => __('PauseOnHover:', 'invert'),
				'desc' => __('Pause the slideshow when hovering over slider, then resume when no longer hovering.', 'invert'),
				'id' => $invert_shortname.'_pauseonhover',
				'std' => 'true',
				'type' => 'select',
				'class' => 'mini', //mini, tiny, small
				'options' => $pauseonhover_array);

//Home Page Featured Box Options	
	$options[] = array(
		'name' => __('Home Template Featured Box Section', 'invert'),
		'type' => 'heading');

	//Featured Box 1
		$options[] = array(
			'name' => __('Featured Box 1 Heading:', 'invert'),
			'desc' => __('Enter Featured Box 1 Heading.', 'invert'),
			'id' => $invert_shortname.'_fb1_first_part_heading',
			'std' => 'Business Strategy',
			'type' => 'text');

		$options[] = array(
			'name' => __('Featured Box 1 Icon Class:', 'invert'),
			'desc' => __('Enter Featured Box 1 Class.', 'invert'),
			'id' => $invert_shortname.'_fb1_first_icon_class',
			'std' => 'fa-group',
			'type' => 'text');
			
		$options[] = array(
			'name' => __('Featured Box 1 Image Path (size: 150px width and 150px height)', 'invert'),
			'desc' => __('This creates a full size uploader that previews the image.', 'invert'),
			'id' => $invert_shortname.'_fb1_first_part_image',
			'std' => '',
			'type' => 'upload');

		 $options[] = array(
				'name' => __('Featured Box 1 Content:', 'invert'),
				'desc' => __('Enter Featured Box 1 Content.','invert'),
				'id' => $invert_shortname.'_fb1_first_part_content',
				'std' => ' Get focused from your target consumers and increase your business with Web portal Design and Development. ',
				'type' => 'textarea');

		$options[] = array(
				'name' => __('Featured Box 1 Link:', 'invert'),
				'desc' => __('Enter Box 1 Link.', 'invert'),
				'id' => $invert_shortname.'_fb1_first_part_link',
				'std' => '#',
				'type' => 'text');

		//Featured Box 2
		$options[] = array(
			'name' => __('Featured Box 2 Heading:', 'invert'),
			'desc' => __('Enter Featured Box 2 Heading.', 'invert'),
			'id' => $invert_shortname.'_fb2_second_part_heading',
			'std' => 'Quality Products',
			'type' => 'text');

		$options[] = array(
			'name' => __('Featured Box 2 Icon Class:', 'invert'),
			'desc' => __('Enter Featured Box 2 Class.', 'invert'),
			'id' => $invert_shortname.'_fb2_first_icon_class',
			'std' => 'fa-shield',
			'type' => 'text');
			
		$options[] = array(
			'name' => __('Featured Box 2 Image Path (size: 150px width and 150px height)', 'invert'),
			'desc' => __('This creates a full size uploader that previews the image.', 'invert'),
			'id' => $invert_shortname.'_fb2_second_part_image',
			'std' => '',
			'type' => 'upload');

	    $options[] = array(
			'name' => __('Featured Box 2 Content:', 'invert'),
			'desc' => __('Enter Featured Box 2 Content.','invert'),
			'id' => $invert_shortname.'_fb2_second_part_content',
			'std' => ' Products with the ultimate features and functionality that provide the complete satisfaction to the clients.',
			'type' => 'textarea');

	    $options[] = array(
			'name' => __('Featured Box 2 Link:', 'invert'),
			'desc' => __('Enter Box 2 Link.', 'invert'),
			'id' => $invert_shortname.'_fb2_second_part_link',
			'std' => '#',
			'type' => 'text');

	//Featured Box 3
		$options[] = array(
			'name' => __('Featured Box 3 Heading:', 'invert'),
			'desc' => __('Enter Featured Box 3 Heading.', 'invert'),
			'id' => $invert_shortname.'_fb3_third_part_heading',
			'std' => 'Best Business Plans',
			'type' => 'text');
			
		$options[] = array(
			'name' => __('Featured Box 3 Icon Class:', 'invert'),
			'desc' => __('Enter Featured Box 3 Class.', 'invert'),
			'id' => $invert_shortname.'_fb3_first_icon_class',
			'std' => 'fa-desktop',
			'type' => 'text');

		$options[] = array(
			'name' => __('Featured Box 3 Image Path (size: 150px width and 150px height)', 'invert'),
			'desc' => __('This creates a full size uploader that previews the image.', 'invert'),
			'id' => $invert_shortname.'_fb3_third_part_image',
			'std' => '',
			'type' => 'upload');

	 	$options[] = array(
			'name' => __('Featured Box 3 Content:', 'invert'),
			'desc' => __('Enter Featured Box 3 Content.','invert'),
			'id' => $invert_shortname.'_fb3_third_part_content',
			'std' => ' Based on the client requirement, different business plans suits and fulfill your business and cost requirement.',
			'type' => 'textarea');

		$options[] = array(
			'name' => __('Featured Box 3 Link:', 'invert'),
			'desc' => __('Enter Box 3 Link.', 'invert'),
			'id' => $invert_shortname.'_fb3_third_part_link',
			'std' => '#',
			'type' => 'text');

	//Front Page call-to-action-block	
	$options[] = array(
		'name' => __('Home Template Call to Action Section', 'invert'),
		'type' => 'heading');

	$options[] = array(
			'name' => __('Call to Action Box Heading:', 'invert'),
			'desc' => __('Enter Call to Action Box Heading.', 'invert'),
			'id' => $invert_shortname.'_catoac_heading',
			'std' => 'Join The Ultimate And Irreplaceable Experience Now.',
			'type' => 'text');

	$options[] = array(
			'name' => __('Call to Action Box Content:', 'invert'),
			'desc' => __('Enter Call to Action Box Content.','invert'),
			'id' => $invert_shortname.'_catoac_content',
			'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec consequat malesuada urna, non fringilla purus malesuada eget.',
			'type' => 'textarea');

	$options[] = array(
			'name' => __('Call to Action Button Text:', 'invert'),
			'desc' => __('Enter call to action button text.', 'invert'),
			'id' => $invert_shortname.'_catoac_txt',
			'std' => 'Call to Action',
			'type' => 'text');

	$options[] = array(
			'name' => __('Call to Action Button Link:', 'invert'),
			'desc' => __('Enter call to action button Link.', 'invert'),
			'id' => $invert_shortname.'_catoac_link',
			'std' => '#',
			'type' => 'text');

	//Front Page Project Box Options	
	$options[] = array(
		'name' => __('Home Template Latest Project Section', 'invert'),
		'type' => 'heading');

	//Project Title
		$options[] = array(
			'name' => __('Project Title:', 'invert'),
			'desc' => __('Enter Project title.', 'invert'),
			'id' => $invert_shortname.'_port_title',
			'std' => 'Latest Projects',
			'type' => 'text');

	//Project Title
		$options[] = array(
			'name' => __('View More Projects Link Title:', 'invert'),
			'desc' => __('Enter View More Projects Link title.', 'invert'),
			'id' => $invert_shortname.'_portlink_title',
			'std' => 'View More Projects',
			'type' => 'text');

	//Project link
	    $options[] = array(
			'name' => __('View More Projects Link:', 'invert'),
			'desc' => __('Enter Link.', 'invert'),
			'id' => $invert_shortname.'_port_link',
			'std' => '#',
			'type' => 'text');
			
	//Number of Projects		
		$options[] = array(
			'name' => __('Number of Projects:', 'invert'),
			'desc' => __('Enter the number of projects.', 'invert'),
			'id' => $invert_shortname.'_nof_projects',
			'std' => '4',
			'type' => 'text');	


	//Front Page Products Box Options	
	$options[] = array(
		'name' => __('Home Template Products Section', 'invert'),
		'type' => 'heading');

	//Products Title
		$options[] = array(
			'name' => __('Product Title:', 'invert'),
			'desc' => __('Enter Product title.', 'invert'),
			'id' => $invert_shortname.'_product_title',
			'std' => 'Most Popular Products',
			'type' => 'text');

	//Products Title
		$options[] = array(
			'name' => __('View More Products Link Title:', 'invert'),
			'desc' => __('Enter View More Products Link title.', 'invert'),
			'id' => $invert_shortname.'_product_link_title',
			'std' => 'View More Products',
			'type' => 'text');

	//Products link
	    $options[] = array(
			'name' => __('View More Products Link:', 'invert'),
			'desc' => __('Enter Link.', 'invert'),
			'id' => $invert_shortname.'_product_link',
			'std' => '#',
			'type' => 'text');
			
			
	//Products Category
		$options[] = array(
			'name' => __('Select Product Category', 'invert'),
			'desc' => __('select product category.', 'invert'),
			'id' => $invert_shortname.'_product_category',
			'std' => '',
			'type' => 'select',
			'class' => 'mini', //mini, tiny, small
			'options' => $woo_product_categories);
					

	//Front Page Parallax Box Options	
	$options[] = array(
		'name' => __('Home Template Parallax Section', 'invert'),
		'type' => 'heading');

	$options[] = array(
			'name' => __('Upload Your Image for parallax (size: 1600px width and 800px height)', 'invert'),
			'desc' => __('This creates a full size uploder that previews the image.', 'invert'),
			'id' => $invert_shortname.'_fullparallax_image',
			'std' => $imagepath.'Parallax_Section_Image.jpg',
			'type' => 'upload');

	$options[] = array(
			'name' => __('Content box with parallax effect section:', 'invert'),
			'desc' => __('Enter Box Content.','invert'),
			'id' => $invert_shortname.'_para_content_left',
			'std' => '<div style="text-align: center;color: #fff;padding: 73px 0 85px">
						  <div style="font-size: 46px;line-height: 46px">Awesome Parallax Section</div>
						  <div style="margin: 0px auto;width: 365px;font-weight: normal;border-bottom: 1px solid #fff;height: 15px"></div>
						  <div style="font-size: 18px;line-height: 35px;margin-top:7px">Invert features an amazing parallax section.</div>
						  <div class="clearfix"><a class="para_btn" href="#">Buy Now</a></div>
					  </div>',
			'type' => 'textarea');


	//Front Page Options	
	$options[] = array(
		'name' => __('Home Template Clients Logo Section', 'invert'),
		'type' => 'heading');

	$options[] = array(
			'name' => __('Client Section Title:', 'invert'),
			'desc' => __('Enter Client Section Title.', 'invert'),
			'id' => $invert_shortname.'_clientsec_title',
			'std' => 'Our Partners',
			'type' => 'text');

	$options[] = array(
			'name' => __('Image 1 Title:', 'invert'),
			'desc' => __('Enter Image 1 Title.', 'invert'),
			'id' => $invert_shortname.'_img1_title',
			'std' => '',
			'type' => 'text');

	$options[] = array(
		'name' => __('Image 1 Icon (size: 232px width and 101px height)', 'invert'),
		'desc' => __('This creates a full size uploader that previews the image.', 'invert'),
		'id' => $invert_shortname.'_img1_icon',
		'std' => $imagepath.'Sample_Client_Logo.png',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Image 1 Link:', 'invert'),
		'desc' => __('Enter Image 1 Link.', 'invert'),
		'id' => $invert_shortname.'_img1_link',
		'std' => '#',
		'type' => 'text');

	$options[] = array(
		'name' => __('Image 2 Title:', 'invert'),
		'desc' => __('Enter Image 1 Title.', 'invert'),
		'id' => $invert_shortname.'_img2_title',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Image 2 Icon (size: 232px width and 101px height)', 'invert'),
		'desc' => __('This creates a full size uploader that previews the image.', 'invert'),
		'id' => $invert_shortname.'_img2_icon',
		'std' => $imagepath.'Sample_Client_Logo.png',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Image 2 Link:', 'invert'),
		'desc' => __('Enter Image 2 Link.', 'invert'),
		'id' => $invert_shortname.'_img2_link',
		'std' => '#',
		'type' => 'text');

	$options[] = array(
		'name' => __('Image 3 Title:', 'invert'),
		'desc' => __('Enter Image 1 Title.', 'invert'),
		'id' => $invert_shortname.'_img3_title',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Image 3 Icon (size: 232px width and 101px height)', 'invert'),
		'desc' => __('This creates a full size uploader that previews the image.', 'invert'),
		'id' => $invert_shortname.'_img3_icon',
		'std' => $imagepath.'Sample_Client_Logo.png',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Image 3 Link:', 'invert'),
		'desc' => __('Enter Image 3 Link.', 'invert'),
		'id' => $invert_shortname.'_img3_link',
		'std' => '#',
		'type' => 'text');

	$options[] = array(
		'name' => __('Image 4 Title:', 'invert'),
		'desc' => __('Enter Image 1 Title.', 'invert'),
		'id' => $invert_shortname.'_img4_title',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Image 4 Icon (size: 232px width and 101px height)', 'invert'),
		'desc' => __('This creates a full size uploader that previews the image.', 'invert'),
		'id' => $invert_shortname.'_img4_icon',
		'std' => $imagepath.'Sample_Client_Logo.png',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Image 4 Link:', 'invert'),
		'desc' => __('Enter Image 4 Link.', 'invert'),
		'id' => $invert_shortname.'_img4_link',
		'std' => '#',
		'type' => 'text');

	$options[] = array(
		'name' => __('Image 5 Title:', 'invert'),
		'desc' => __('Enter Image 1 Title.', 'invert'),
		'id' => $invert_shortname.'_img5_title',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Image 5 Icon (size: 232px width and 101px height)', 'invert'),
		'desc' => __('This creates a full size uploader that previews the image.', 'invert'),
		'id' => $invert_shortname.'_img5_icon',
		'std' => $imagepath.'Sample_Client_Logo.png',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Image 5 Link:', 'invert'),
		'desc' => __('Enter Image 5 Link.', 'invert'),
		'id' => $invert_shortname.'_img5_link',
		'std' => '#',
		'type' => 'text');

	//Twitter	

	$options[] = array(
		'name' => __('Home Template Twitter Configuration', 'invert'),
		'type' => 'heading');

	$options[] = array(
			'name' => __('Twitter Configuration Info', 'invert'),
			'desc' => __("<p class='description'>More information on Twiiter api keys and how to get them, read this <a href='$twitterInfo' target='_blank'>$twitterInfo</a> tutorial to find out.</p>", 'invert'),
			'type' => 'info');

	//Cache Tweets
		$options[] = array(
			'name' => __('Cache Tweets in every(In minutes):', 'invert'),
			'desc' => __('Cache Tweets in every(In minutes).', 'invert'),
			'id' => $invert_shortname.'_cachetime',
			'std' => '1',
			'type' => 'text');

	//latest tweets

		$options[] = array(
			'name' => __('Number of latest tweets display:', 'invert'),
			'desc' => __('Number of latest tweets display.', 'invert'),
			'id' => $invert_shortname.'_numb_lat_tw',
			'std' => '10',
			'type' => 'text');

	//username

		$options[] = array(
			'name' => __('Twitter username:', 'invert'),
			'desc' => __('Enter Twitter username.', 'invert'),
			'id' => $invert_shortname.'_tw_username',
			'std' => 'sketchthemes',
			'type' => 'text');

	//Twitter consumer
		$options[] = array(
			'name' => __('Consumer key:', 'invert'),
			'desc' => __('Enter Consumer key.', 'invert'),
			'id' => $invert_shortname.'_twitter_consumer',
			'std' => '',
			'type' => 'text');

	//twitter Consumer secret
		$options[] = array(
			'name' => __('Consumer secret:', 'invert'),
			'desc' => __('Enter Consumer secret.', 'invert'),
			'id' => $invert_shortname.'_twitter_con_s',
			'std' => '',
			'type' => 'text');

	//twitter Access token
		$options[] = array(
			'name' => __('Access token:', 'invert'),
			'desc' => __('Enter Access token.', 'invert'),
			'id' => $invert_shortname.'_twitter_acc_t',
			'std' => '',
			'type' => 'text');

	//twitter Access token secret
		$options[] = array(
			'name' => __('Access token secret:', 'invert'),
			'desc' => __('Enter Access token secret.', 'invert'),
			'id' => $invert_shortname.'_twitter_acc_t_s',
			'std' => '',
			'type' => 'text');

	//contact page
		$options[] = array(
				'name' => __('Contact Template Settings', 'invert'),
				'type' => 'heading');

	$options[] = array(
			'name' => __('Show/Hide Contact Map:', 'invert'),
			'desc' => __('If Show, Show Contact Map.', 'invert'),
			'id' => $invert_shortname.'_hide_con_map',
			'std' => 'true',
			'type' => 'radio',
			'options' => $map_hide_array);

		$options[] = array(
			'name' => __('Contact Google Map Height in px', 'invert'),
			'desc' => __('Enter Height For Google Map.', 'invert'),
			'id' => $invert_shortname.'_contact_gmap_height',
			'std' => '460',
			'type' => 'text');

		$options[] = array(
			'name' => __('Contact Google Map Latitude', 'invert'),
			'desc' => __('To find latitude and longitude  right click on the google map at your desired location and from context menu select Whats here & you will get the latitude and longitude  at searchbox..', 'invert'),
			'id' => $invert_shortname.'_contact_gmap_lat',
			'std' => '22.735024',
			'type' => 'text');

		$options[] = array(
			'name' => __('Contact Google Map Longitude', 'invert'),
			'desc' => __('To find latitude and longitude  right click on the google map at your desired location and from context menu select Whats here & you will get the latitude and longitude at searchbox..', 'invert'),
			'id' => $invert_shortname.'_contact_gmap_long',
			'std' => '75.854988',
			'type' => 'text');	

		$options[] = array(
			'name' => __('Contact Google Map Info window by default', 'invert'),
			'desc' => __('Default ( close ).', 'invert'),
			'id' => $invert_shortname.'_contact_gmap_infost',
			'std' => 'close',
			'type' => 'radio',
			'options' => $cgmap_infowin);	

		$options[] = array(
			'name' => __('Contact Google Map Info Window Text. ( please donot use double quotes. )', 'invert'),
			'desc' => __('Enter Google Map Info Window Text.', 'invert'),
			'id' => $invert_shortname.'_contact_gmap_infotxt',
			'std' => "Sketch Themes, Forever Street Coridor View",
			'type' => 'textarea');

		$options[] = array(
			'name' => __('Contact Google Map Marker Title', 'invert'),
			'desc' => __('Enter Contact Google Map Marker Title.', 'invert'),
			'id' => $invert_shortname.'_contact_gmap_marttl',
			'std' => 'Indore',
			'type' => 'text');

		$options[] = array(
			'name' => __('Contact Google Map Marker Image', 'invert'),
			'desc' => __('This creates a Marker image that previews the image.', 'invert'),
			'id' => $invert_shortname.'_contact_gmap_iconimg',
			'std' => $imagepath.'blue-marker.png',
			'type' => 'upload');

		$options[] = array(
			'name' => __('Contact Google Map Marker Animation', 'invert'),
			'desc' => __('Default ( Bounce ).', 'invert'),
			'id' => $invert_shortname.'_contact_gmap_markanim',
			'std' => 'BOUNCE',
			'type' => 'radio',
			'options' => $cgmap_markanim);

		$options[] = array(
			'name' => __('Google Map Zoom Level', 'invert'),
			'desc' => __('Set Google Map Zoom Level', 'invert'),
			'id' => $invert_shortname.'_contact_gmap_zlevel',
			'std' => '16',
			'type' => 'select',
			'class' => 'mini', //mini, tiny, small
			'options' => $cgmap_zoomlevel);

		$options[] = array(
			'name' => __('Google Map Type', 'invert'),
			'desc' => __('Set Google Map Type', 'invert'),
			'id' => $invert_shortname.'_contact_gmap_maptype',
			'std' => 'ROADMAP',
			'type' => 'select',
			'class' => 'mini', //mini, tiny, small
			'options' => $cgmap_maptype);

	//Custom style Settings
		$options[] = array(
			'name' => __('Custom Style Settings', 'invert'),
			'type' => 'heading');		
			
		$options[] = array(
			'name' => __('Custom CSS', 'invert'),
			'desc' => __('Write Custom CSS in order to overwrite style CSS (without "style" tag).', 'invert'),
			'id' => $invert_shortname.'_custom_css',
			'std' => "#logo{}",
			'type' => 'textarea');

  //404	

	$options[] = array(
		'name' => __('404 Page Settings', 'invert'),
		'type' => 'heading');

		$options[] = array(
			'name' => __('404 Page Text', 'invert'),
			'desc' => __('You can use HTML for links etc..', 'invert'),
			'id' => $invert_shortname.'_four_zero_four_txt',
			'std' => 'Sorry, but the requested resource was not found on this site. Please try again or contact the administrator for assistance.',
			'type' => 'textarea');

	//Footer	
	$options[] = array(
		'name' => __('Footer Settings', 'invert'),
		'type' => 'heading');

		$options[] = array(
			'name' => __('Copyright Text', 'invert'),
			'desc' => __('You can use HTML for links etc..', 'invert'),
			'id' => $invert_shortname.'_copyright',
			'std' => "Invert WordPress Theme &copy; 2014 SketchThemes",
			'type' => 'textarea');
			
		$options[] = array(
			'name' => __('Google Analytics code:', 'invert'),
			'desc' => __('You can use Google Analytics code here.', 'invert'),
			'id' => $invert_shortname.'_analytics',
			'std' => '',
			'type' => 'textarea');
			
			
	//WooCommerce Settings	
	$options[] = array(
		'name' => __('WooCommerce Settings', 'invert'),
		'type' => 'heading');

		$options[] = array(
			'name' => __('Shop Page Layout', 'invert'),
			'desc' => __('Set content lauput for the shop page.', 'invert'),
			'id' => $invert_shortname.'main_shop_layout',
			'std' => 'right-sidebar',
			'type' => 'select',
			'class' => 'mini', //mini, tiny, small
			'options' => $woo_pagelayout);
			
		$options[] = array(
			'name' => __('Single Product Page Layout', 'invert'),
			'desc' => __('Set content lauput for the product single page.', 'invert'),
			'id'   => $invert_shortname.'single_product_layout',
			'std' => 'right-sidebar',
			'type' => 'select',
			'class' => 'mini', //mini, tiny, small
			'options' => $woo_pagelayout);	
			
		$options[] = array(
			'name' => __('Price Color', 'invert'),
			'desc' => __('', 'invert'),
			'id' => $invert_shortname.'_woopricecolor',
			'std' => '#D83B2D',
			'type' => 'color' );	
			
		$options[] = array(
			'name' => __('Rating Starts Color', 'invert'),
			'desc' => __('', 'invert'),
			'id' => $invert_shortname.'_wooratingcolor',
			'std' => '#D83B2D',
			'type' => 'color' );	
			
	return $options;

}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');
function optionsframework_custom_scripts() { ?>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$('#example_showhidden').click(function() {
  		$('#section-example_text_hidden').fadeToggle(400);
	});
	if ($('#example_showhidden:checked').val() !== undefined) {
		$('#section-example_text_hidden').show();
	}

    var selected_bredbtn = jQuery("#section-invert_bread_stype input:checked").val();
	if (selected_bredbtn === 'brcolor') {
		jQuery('#section-invert_bread_color').show();
	}
    else if (selected_bredbtn === 'brimage') {
		jQuery('#section-invert_bread_image').show();
	}

	jQuery("input[type='radio']").change(function() {
        var selected_radio = jQuery(this).val();
		if (selected_radio === 'brcolor') {
            jQuery('#section-invert_bread_image').hide();
			jQuery('#section-invert_bread_color').fadeIn();
        }else if (selected_radio === 'brimage') {
			jQuery('#section-invert_bread_color').hide();
            jQuery('#section-invert_bread_image').fadeIn();
        }
    });
});
</script>
<?php
}