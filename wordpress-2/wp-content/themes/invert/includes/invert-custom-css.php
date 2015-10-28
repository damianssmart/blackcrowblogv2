<?php global $invert_shortname, $invert_themename, $post; ?>
<?php
function skeHex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
} 
	if(sketch_get_option($invert_shortname.'_colorpicker')){ $bg_color = sketch_get_option($invert_shortname.'_colorpicker'); } 
	if(sketch_get_option($invert_shortname.'_headercolorpicker')){ $headercolorpicker = sketch_get_option($invert_shortname.'_headercolorpicker'); } 
	if(sketch_get_option($invert_shortname.'_navfontcolorpicker')){ $navfontcolorpicker = sketch_get_option($invert_shortname.'_navfontcolorpicker'); } 
	if(sketch_get_option($invert_shortname.'_teamcolorpicker')){ $teamcolorpicker = sketch_get_option($invert_shortname.'_teamcolorpicker'); } 
	if(sketch_get_option($invert_shortname.'_teamtitlecolor')){ $teamtitlecolor = sketch_get_option($invert_shortname.'_teamtitlecolor'); } 
	if(sketch_get_option($invert_shortname.'_bread_color')){ $breadcolor = sketch_get_option($invert_shortname.'_bread_color'); } 
	if(sketch_get_option($invert_shortname.'_bread_image')){ $breadimage = sketch_get_option($invert_shortname.'_bread_image'); } 
	if(sketch_get_option($invert_shortname.'_fullparallax_image')){ $fullparallax_image = sketch_get_option($invert_shortname.'_fullparallax_image'); } 
	if(sketch_get_option($invert_shortname.'_mobi_menu_width')){ $mobi_menu_width = sketch_get_option($invert_shortname.'_mobi_menu_width'); } 
	if(sketch_get_option($invert_shortname.'_logo_wdth')){ $skt_logo_wdth = sketch_get_option($invert_shortname.'_logo_wdth'); } 
	if(sketch_get_option($invert_shortname.'_logo_hght')){ $skt_logo_hght = sketch_get_option($invert_shortname.'_logo_hght'); } 
	if(sketch_get_option($invert_shortname.'_hide_con_map')){ $skt_hide_map = sketch_get_option($invert_shortname.'_hide_con_map'); } 
	if(sketch_get_option($invert_shortname.'_contact_gmap_height')){ $skt_map_height = sketch_get_option($invert_shortname.'_contact_gmap_height'); } 
	if(sketch_get_option($invert_shortname.'_hide_pro_filter')){ $skt_port_filter_hide = sketch_get_option($invert_shortname.'_hide_pro_filter'); } 
	if(sketch_get_option($invert_shortname.'_bread_title_color')){ $skt_bread_title_color = sketch_get_option($invert_shortname.'_bread_title_color'); } 	
	if(sketch_get_option($invert_shortname.'_shrink_endi')){ $skt_shrink_endi = sketch_get_option($invert_shortname.'_shrink_endi'); } 	
	if(sketch_get_option($invert_shortname.'_navhovercolorpicker')){ $skt_navhovercolorpicker = sketch_get_option($invert_shortname.'_navhovercolorpicker'); } 	

	if(is_page()) {
		$pagetitlebg = get_post_meta($post->ID, "_pagetitle_bg", true);
	}else{
		$pagetitlebg = "";
	}

	$rgb=array();
	$rgb = skeHex2RGB($bg_color);
	$R = $rgb['red'];
	$G = $rgb['green'];
	$B = $rgb['blue'];
	$rgbcolor = "rgba(". $R .",". $G .",". $B .",.4)";
	$bdrrgbcolor = "rgba(". $R .",". $G .",". $B .",.7)";


	$hrgb = skeHex2RGB($headercolorpicker);
	$hR = $hrgb['red'];
	$hG = $hrgb['green'];
	$hB = $hrgb['blue'];
	$hrgbcolor = "rgba(". $hR .",". $hG .",". $hB .",.95)";

?>
<style type="text/css">

	/***************** HEADER *****************/
	.skehead-headernav{background: <?php if(isset($hrgbcolor)){ echo $hrgbcolor; } ?>;}

	/**************** LOGO SIZE ***************/
	.skehead-headernav .logo{width:<?php if(isset($skt_logo_wdth)){ echo $skt_logo_wdth; } ?>px;height:<?php if(isset($skt_logo_hght)){ echo $skt_logo_hght; } ?>px;}

	/***************** THEME *****************/
	
	.flex-control-paging li a.flex-active,.skt_price_table .price_table_inner ul li.table_title{background: <?php if(isset($bg_color)){ echo $bg_color; } ?>; }
	.sticky-post {color : <?php if(isset($bg_color)){ echo $bg_color; } ?>;border-color:<?php if(isset($bdrrgbcolor)){ echo $bdrrgbcolor; } ?>}
	#footer,.skt_price_table .price_table_inner .price_button a { border-color: <?php if(isset($bg_color)){ echo $bg_color; } ?>; }
	.social li a:hover{background: <?php if(isset($bg_color)){ echo $bg_color; } ?>;}
	.social li a:hover:before{color:#fff; }
	.flexslider:hover .flex-next:hover, .flexslider:hover .flex-prev:hover,a#backtop,.slider-link a:hover,#respond input[type="submit"]:hover,.skt-ctabox div.skt-ctabox-button a:hover,#portfolio-division-box a.readmore:hover,.project-item .icon-image,.project-item:hover,.filter li .selected,.filter a:hover,.widget_tag_cloud a:hover,.widget_product_tag_cloud a:hover, .continue a:hover,blockquote,.skt-quote,#invert-paginate .invert-current,#invert-paginate a:hover,.postformat-gallerydirection-nav li a:hover,#wp-calendar,.comments-template .reply a:hover,#content .contact-left form input[type="submit"]:hover,.service-icon:hover,.skt-parallax-button:hover,.sktmenu-toggle,.skt_price_table .price_table_inner .price_button a:hover, .mid-box:hover .iconbox-icon i,#content .skt-service-page div.one_third:hover .service-icon,#content div.one_half .skt-service-page:hover .service-icon  {background-color: <?php if(isset($bg_color)){ echo $bg_color; } ?>; }
	.skt-ctabox div.skt-ctabox-button a,#portfolio-division-box .readmore,.teammember,.continue a,.comments-template .reply a,#respond input[type="submit"],.slider-link a,.ske_tab_v ul.ske_tabs li.active,.ske_tab_h ul.ske_tabs li.active,#content .contact-left form input[type="submit"],.filter a,.service-icon,.skt-parallax-button,#invert-paginate a:hover,#invert-paginate .invert-current,#content .contact-left form textarea:focus,#content .contact-left form input[type="text"]:focus, #content .contact-left form input[type="email"]:focus, #content .contact-left form input[type="url"]:focus, #content .contact-left form input[type="tel"]:focus, #content .contact-left form input[type="number"]:focus, #content .contact-left form input[type="range"]:focus, #content .contact-left form input[type="date"]:focus, #content .contact-left form input[type="file"]:focus,form input[type="text"]:focus,form input[type="email"]:focus, form input[type="url"]:focus,form input[type="tel"]:focus, form input[type="number"]:focus,form input[type="range"]:focus, form input[type="date"]:focus,form input[type="file"]:focus,form textarea:focus,form input[type="submit"]{border-color:<?php if(isset($bg_color)){ echo $bg_color; } ?>;} 	
	.clients-items li a:hover{border-bottom-color:<?php if(isset($bg_color)){ echo $bg_color; } ?>;}
	a,.ske-footer-container ul li:hover:before,.ske-footer-container ul li:hover > a,.ske_widget ul ul li:hover:before,.ske_widget ul ul li:hover,.ske_widget ul ul li:hover a,.title a ,.skepost-meta a:hover,.post-tags a:hover,.entry-title a:hover ,.continue a,.readmore a:hover,#Site-map .sitemap-rows ul li a:hover ,.childpages li a,#Site-map .sitemap-rows .title,.ske_widget a,.ske_widget a:hover,#Site-map .sitemap-rows ul li:hover,.mid-box:hover .iconbox-icon i,#footer .third_wrapper a:hover,.ske-title,#content .contact-left form input[type="submit"],.filter a,service-icon i,.service-icon i,span.team_name,#respond input[type="submit"],.reply a, a.comment-edit-link,.iconbox-icon i,.skt_price_table .price_in_table .value,form input[type="submit"]{color: <?php if(isset($bg_color)){ echo $bg_color; } ?>;text-decoration: none;}
	.single #content .title,#content .post-heading,.childpages li ,.fullwidth-heading,.comment-meta a:hover,#respond .required, #wp-calendar tbody a{color: <?php if(isset($bg_color)){ echo $bg_color; } ?>;} 
	#skenav a{color:<?php if(isset($navfontcolorpicker)){ echo $navfontcolorpicker; } ?>;}
	#skenav ul ul li a:hover,.mid-box:hover .iconbox-icon i{background-color: <?php if(isset($bg_color)){ echo $bg_color; } ?>;color:#fff;}
	*::-moz-selection{background: <?php if(isset($bg_color)){ echo $bg_color; } ?>;color:#fff;}
	::selection {background: <?php if(isset($bg_color)){ echo $bg_color; } ?>;color:#fff;}
	#full-twitter-box,.progress_bar {background: none repeat scroll 0 0 <?php if(isset($bg_color)){ echo $bg_color; } ?>;}
	#skenav ul li.current_page_item > a,
	#skenav ul li.current-menu-ancestor > a,
	#skenav ul li.current-menu-item > a,
	#skenav ul li.current-menu-parent > a { background-color:<?php if(isset($bg_color)){ echo $bg_color; } ?>;color:#fff;}
	.project-item:hover > .title,.iconbox-icon i { border-color: <?php if(isset($bg_color)){ echo $bg_color; } ?>;  }
	#searchform input[type="submit"],#sidebar #searchform input[type="submit"]{ background: none repeat scroll 0 0 <?php if(isset($bg_color)){ echo $bg_color; } ?>;  }
	.ske-footer-container ul li {}
	.col-one .box .title, .col-two .box .title, .col-three .box .title, .col-four .box .title {color: <?php if(isset($bg_color)){ echo $bg_color; } ?> !important;  }
	<?php if(sketch_get_option($invert_shortname.'_bread_stype')){ $bread_type = sketch_get_option($invert_shortname.'_bread_stype'); } 
	
	if(isset($bread_type)) {
	if ($bread_type == "brcolor" && $pagetitlebg == Null ) {?>.full-bg-breadimage-fixed { background-color: <?php echo $breadcolor; ?>;}<?php  } 
	else { ?> .full-bg-breadimage-fixed { background-image: url("<?php if(isset($pagetitlebg) && $pagetitlebg!= Null ){ echo $pagetitlebg;} ?>");} <?php }
	?>
	<?php if(isset($bread_type) && $bread_type == "brimage") { ?>.full-bg-breadimage-fixed { background-image: url("<?php if(isset($pagetitlebg) && $pagetitlebg!= Null ){ echo $pagetitlebg;} else { echo $breadimage; } ?>");}<?php } } ?>
	.full-bg-image-fixed { background-image: url("<?php if(isset($fullparallax_image)){ echo $fullparallax_image; } ?>"); }


	/***************** TEAM BG *****************/
	#team-division-box .border_center {
		border-color: <?php if(isset($teamtitlecolor)){ echo $teamtitlecolor; } ?>;
	}
	.team_custom_title.title_center, .team_custom_title.title_center h3 {
		color: <?php if(isset($teamtitlecolor)){ echo $teamtitlecolor; } ?>;
	}

	#team-division-box{background-color: <?php if(isset($teamcolorpicker)){ echo $teamcolorpicker; } ?>;}
	.teammember img.teammember_img{box-shadow:0 0 0 5px <?php if(isset($bg_color)){ echo $bg_color; } ?>;}
	.teammember img.teammember_img:hover,.teammember:hover img.teammember_img { animation:team_ttb 1s; -webkit-animation:team_ttb 1s; -moz-animation:team_ttb 1s; -o-animation:team_ttb 1s; } 	
	
	@keyframes team_ttb{25%{box-shadow:0 0 0 5px <?php if(isset($bg_color)){ echo $rgbcolor; } ?>} 100%{box-shadow:0 0 0 5px <?php if(isset($bg_color)){ echo $bg_color; } ?>}}
	@-webkit-keyframes team_ttb{25%{box-shadow:0 0 0 5px <?php if(isset($bg_color)){ echo $rgbcolor; } ?>} 100%{box-shadow:0 0 0 5px <?php if(isset($bg_color)){ echo $bg_color; } ?>}}
	@-moz-keyframes team_ttb{25%{box-shadow:0 0 0 5px <?php if(isset($bg_color)){ echo $rgbcolor; } ?>} 100%{box-shadow:0 0 0 5px <?php if(isset($bg_color)){ echo $bg_color; } ?>}}
	@-o-keyframes team_ttb{25%{box-shadow:0 0 0 5px <?php if(isset($bg_color)){ echo $rgbcolor; } ?>} 100%{box-shadow:0 0 0 5px <?php if(isset($bg_color)){ echo $bg_color; } ?>}}
	
	#skenav li a:hover,#skenav .sfHover,#skenav ul ul li { background-color:<?php if(isset($skt_navhovercolorpicker)){ echo $skt_navhovercolorpicker; } else { echo '#333333'; } ?>;color: #FFFFFF;}
	#skenav .sfHover a { color: #FFFFFF;}
	#skenav .ske-menu #menu-secondary-menu li a:hover, #skenav .ske-menu #menu-secondary-menu .current-menu-item a{color: #71C1F2;  }
	.footer-seperator{background-color: rgba(0,0,0,.2);}
	#skenav .ske-menu #menu-secondary-menu li .sub-menu li {margin: 0;}


	<?php if(isset($skt_hide_map) && $skt_hide_map === 'false' ){ ?>#map_canvas{display:none;}<?php } ?>
	<?php if(isset($skt_port_filter_hide) && $skt_port_filter_hide === 'false' ){ ?>#container-isotop{margin-top:0px !important;}<?php } ?>
	#map_canvas #map,#map_canvas{height:<?php if(isset($skt_map_height)){ echo $skt_map_height; } ?>px;}
	.teammember {border-bottom-color : <?php if(isset($rgbcolor)){ echo $rgbcolor; } ?>;}
 	<?php if(isset($skt_port_filter_hide) && $skt_port_filter_hide === 'false' ){ ?>#container-isotop{margin-top:0px !important;}<?php } ?>

	.bread-title-holder h1.title,.cont_nav_inner span,.bread-title-holder .cont_nav_inner p{
		color: <?php if(isset($skt_bread_title_color)){ echo $skt_bread_title_color; } ?>;
	}
	
	/***************** WOOCOMMERCE-STYLE *****************/
	
	<?php
		if(sketch_get_option($invert_shortname.'_woopricecolor')){ $_woopricecolor = sketch_get_option($invert_shortname.'_woopricecolor'); } 
		if(sketch_get_option($invert_shortname.'_wooratingcolor')){ $_wooratingcolor = sketch_get_option($invert_shortname.'_wooratingcolor'); } 
	?>
	
	.woocommerce form .form-row input.input-text:focus, .woocommerce form .form-row textarea:focus, .woocommerce-page form .form-row input.input-text:focus, .woocommerce-page form .form-row textarea:focus,select:focus{ border-color: <?php if(isset($bg_color)){ echo $bg_color; } ?>; } 	
	.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price,
	.woocommerce #content div.product p.price, .woocommerce #content div.product span.price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce-page #content div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page div.product span.price {color: <?php if(isset($_woopricecolor)){ echo $_woopricecolor; } ?>;}
	.woocommerce .products .star-rating, .woocommerce-page .products .star-rating,
	.woocommerce .woocommerce-product-rating .star-rating, .woocommerce-page .woocommerce-product-rating .star-rating,.woocommerce .star-rating, .woocommerce-page .star-rating,.woocommerce-page p.stars a:hover{color: <?php if(isset($_wooratingcolor)){ echo $_wooratingcolor; } ?>;}
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active{border-top-color: <?php if(isset($bg_color)){ echo $bg_color; } ?>;}	
	.woocommerce ul.products li.product a:hover, .woocommerce-page ul.products li.product a:hover,
	.woocommerce #content div.product .product_title, .woocommerce div.product .product_title, .woocommerce-page #content div.product .product_title, .woocommerce-page div.product .product_title {color: <?php if(isset($bg_color)){ echo $bg_color; } ?>;}
	.woocommerce span.onsale, .woocommerce-page span.onsale{background: <?php if(isset($bg_color)){ echo $bg_color; } ?>;}
	.woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button,
	.woocommerce div.product form.cart .button, .woocommerce #content div.product form.cart .button, .woocommerce-page div.product form.cart .button, .woocommerce-page #content div.product form.cart .button,.woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce #content input.button.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page #content input.button.alt  	{ color: <?php if(isset($bg_color)){ echo $bg_color; } ?>;border-color: <?php if(isset($bg_color)){ echo $bg_color; } ?>;}
	.woocommerce #content input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover,
	.woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce #content input.button.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce-page #content input.button.alt:hover, 
	.woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li span.current,.woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce #content input.button.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce-page #content input.button.alt:hover,form input[type="submit"]:hover {background: <?php if(isset($bg_color)){ echo $bg_color; } ?>!important;color:#fff !important;text-shadow:inherit;}
	.woocommerce #content input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li span.current{border-color: <?php if(isset($bg_color)){ echo $bg_color; } ?>;}
	.woocommerce #sidebar .ui-slider-handle.ui-state-default.ui-corner-all,#sidebar .ui-slider-range.ui-widget-header.ui-corner-all{background: <?php if(isset($bg_color)){ echo $bg_color; } ?>; }

	<?php if($skt_shrink_endi == 'true') { ?>
			.skehead-headernav.skehead-headernav-shrink .logo {
				height: 34px;
				margin-top: 5px;
				width: auto;
			}
			.skehead-headernav.skehead-headernav-shrink #logo #site-title a{margin-top:0;}
			.skehead-headernav.skehead-headernav-shrink #logo #site-title a{font-size:24px;line-height:24px;}
			#header.skehead-headernav-shrink #skenav a {
				line-height: 56px;
			}
	<?php } else{
			
		}
	?>

	@media only screen and (max-width : <?php if(isset($mobi_menu_width)){ echo $mobi_menu_width; } ?>px) {
		#menu-main {
			display:none;
		}

		#header .container {
			width:97%;
		}
		
	}


</style>

<script type="text/javascript">
jQuery(document).ready(function(){
'use strict';
	jQuery('#menu-main').sktmobilemenu({'fwidth':<?php if(isset($mobi_menu_width)){ echo $mobi_menu_width; } ?>});
});
</script> 