<?php
/**
* The Header for our theme.
*/
?><!DOCTYPE html>
<?php global $invert_shortname, $invert_themename; ?>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<!--[if IE 9]>
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
<![endif]-->
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
	<div id="wrapper" class="skepage">
		<div id="header" class="skehead-headernav clearfix">
			<div class="glow">
				<div id="skehead">
					<div class="container">      
						<div class="row-fluid">      
							<!-- #logo -->
							<div id="logo" class="span4">
								<?php if(sketch_get_option($invert_shortname."_logo_img")){ ?>
									<a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>" ><img class="logo" src="<?php echo sketch_get_option($invert_shortname."_logo_img"); ?>" alt="<?php echo sketch_get_option($invert_shortname."_logo_alt"); ?>" /></a>
								<?php } else{ ?>
								<!-- #description -->
								<div id="site-title" class="logo_desp">
									<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name') ?>" ><?php bloginfo('name'); ?></a> 
									<div id="site-description"><?php bloginfo( 'description' ); ?></div>
								</div>
								<!-- #description -->
								<?php } ?>
							</div>
							<!-- #logo -->
							<!-- navigation-->
							<div class="top-nav-menu span8">
							<?php 
								if( function_exists( 'has_nav_menu' ) && has_nav_menu( 'Header' ) ) {
									wp_nav_menu(array( 'container_class' => 'ske-menu', 'container_id' => 'skenav', 'menu_id' => 'menu-main','menu' => 'Primary Menu','theme_location' => 'Header' )); 
								} else {
								?>
								<div class="ske-menu" id="skenav">
									<ul id="menu-main" class="menu">
										<?php wp_list_pages('title_li=&depth=0'); ?>
									</ul>
								</div>
								<?php } ?>
							</div>
							<div class="clearfix"></div>
							<!-- #navigation --> 
						</div>
					</div>
				</div>
				<!-- #skehead -->
			</div>
			<!-- glow --> 
		</div>
		<div class="header-clone"></div>
<!-- #header -->
<?php
if( is_page_template('template-front-page.php')  ) { 
global $tweetfeedmeta;
$frontslider_set_meta = get_post_meta( $post->ID,'_skt_allslider_metabox',true );
if($frontslider_set_meta === 'flex'){ include("includes/front-flex-slider.php"); }
else if($frontslider_set_meta === 'rev'){ include("includes/front-rev-slider.php"); }
else if($frontslider_set_meta === 'video'){ include("includes/front-video-template.php"); }
$tweetfeedmeta = get_post_meta( $post->ID,'_skt_twfeed_metabox',true );
}
?>
<div id="main" class="clearfix">