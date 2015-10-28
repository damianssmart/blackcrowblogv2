<?php 
/********* SHORTCODES v.1.0 ************/

define('SKT_SHORTCODES_VERSION', '1.0');
define('SKT_SHORTCODES_DIR', get_template_directory_uri() . '/SketchBoard/functions/shortcodes');
add_action('wp_enqueue_scripts', 'skt_shortcodes_css');

function skt_shortcodes_css(){
	wp_enqueue_style('skt-shortcodes-css', SKT_SHORTCODES_DIR . '/css/shortcodes.css', false, SKT_SHORTCODES_VERSION, 'all');
	wp_enqueue_style('skt-tolltip-css', SKT_SHORTCODES_DIR . '/css/tipTip.css', false, SKT_SHORTCODES_VERSION, 'all');
	wp_enqueue_script('skt-shortcodes-js', SKT_SHORTCODES_DIR . '/js/shrotcodes.js', array('jquery'), SKT_SHORTCODES_VERSION, true);
	wp_enqueue_script('skt-tolltip-js', SKT_SHORTCODES_DIR . '/js/jquery.tipTip.js', array('jquery'), SKT_SHORTCODES_VERSION, true);
}

if (!function_exists('no_wpautop')) {
	function no_wpautop($content){ 
	    $content = do_shortcode( shortcode_unautop($content) ); 
	    $content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
	    return $content;
	}
}


/*********clear class*********/
function skt_clear( $atts, $content = null ) {
   return '<div class="clearfix">' . do_shortcode($content) . '</div>';
}
add_shortcode('clear','skt_clear');

/*********skt_container class

----------------------------------*********/

function skt_container( $atts, $content = null ) {
   $content = preg_replace('#<br \/>#', '', $content);
   return '<div class="page-container clearfix">' . do_shortcode($content) . '</div>';
}
add_shortcode('page_container','skt_container');

/*********one_half

-----------------------------*********/

function skt_one_half( $atts, $content = null ) {

   return '<div class="one_half">' . do_shortcode($content) . '</div>';

}

add_shortcode('one_half','skt_one_half');

/*********one_half last

---------------------------------*********/

function skt_one_half_last( $atts, $content = null ) {

   return '<div class="one_half last">' . do_shortcode($content) . '</div>';

}

add_shortcode('one_half_last','skt_one_half_last');

/**********skt_one_third********/

function skt_one_third( $atts, $content = null ) {

   return '<div class="one_third">'.do_shortcode($content).'</div>';

}

add_shortcode('one_third','skt_one_third');

/*********skt_one_third last*********/

function skt_one_third_last( $atts, $content = null ) {

   return '<div class="one_third last">' . do_shortcode($content) . '</div>';

}

add_shortcode('one_third_last','skt_one_third_last');

/*********skt_one_fourth*********/

function skt_one_fourth( $atts, $content = null ) {

   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';

}

add_shortcode('one_fourth','skt_one_fourth');

/*********skt_one_fourth last*********/

function skt_one_fourth_last( $atts, $content = null ) {

   return '<div class="one_fourth last">' . do_shortcode($content) . '</div>';

}

add_shortcode('one_fourth_last','skt_one_fourth_last');

/*********skt_two_third*********/

function skt_two_third( $atts, $content = null ) {

   return '<div class="two_third">' . do_shortcode($content) . '</div>';

}

add_shortcode('two_third','skt_two_third');

/*********skt_two_third last*********/

function skt_two_third_last( $atts, $content = null ) {

   return '<div class="two_third last">' . do_shortcode($content) . '</div>';

}

add_shortcode('two_third_last','skt_two_third_last');

/*********skt_three_fourth*********/

function skt_three_fourth( $atts, $content = null ) {

   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';

}

add_shortcode('three_fourth','skt_three_fourth');

/*********skt_three_fourth last*********/

function skt_three_fourth_last( $atts, $content = null ) {

   return '<div class="three_fourth last">' . do_shortcode($content) . '</div>';

}

add_shortcode('three_fourth_last','skt_three_fourth_last');

/********* skt_linkbutton *********/

function skt_linkbutton( $atts, $content = null ) {

    extract(shortcode_atts(array(

    'link'	=> '#',

    'target'	=> '',

    'size'	=> '',

    'align'	=> '',

	'color'=>''

    ), $atts));

	$align = ($align) ? ' align'.$align : '';

	$size = ($size) ? ' '.$size.'-button' : '';

	$target = ($target == 'blank') ? ' target="_blank"' : '';

	$color = ($color) ? ' '.$color : ' ';

	$out = '<a' .$target. ' class="button-link' .$size.$align. '" style="border-color:'.$color.';color:'.$color.';" href="' .$link. '"><span>' .do_shortcode($content). '</span></a>';

    return $out;

}

add_shortcode('link_button', 'skt_linkbutton');

/********* skt_tooltip *********/

function skt_tooltip( $atts, $content = null ) {

	extract(shortcode_atts(array(

	'tooltip_title'=> '' 

	), $atts));

   return '<span title="'.$tooltip_title.'" class="tooltip"><a href="javascript:void(0);">' . do_shortcode($content) . '</a></span>';

}

add_shortcode('tooltip','skt_tooltip');

/****************quote*************/

function skt_quote($atts, $content = null) {

		extract(shortcode_atts(array(

			'author'=> '',

			'link'=>'' 

	), $atts));

  return '<blockquote class="skt-quote">'. do_shortcode($content) .'<a href="'.$link.'" target="_blank"><span class="quoteauthor">'.$author.'</span></a></blockquote>';

}

add_shortcode('blockquote','skt_quote');

/****************skt_dropcaps

--------------------------------------------*************/

function skt_dropcaps($atts, $content = null) {

	extract(shortcode_atts(array(

	'type'=>'',

	'bgcolor'=>'',

	'color'=> '',

	'size'=>''	

	), $atts));

  return '<span class="skt-dropcaps '.$type.'" style="color:'.$color.';font-size:'.$size.';background-color:'.$bgcolor.';line-height:'.$size.';width:'.$size.';">'. do_shortcode($content) .'</span>';

}

add_shortcode('dropcaps','skt_dropcaps');

/**************** warning box *************/

function skt_worningbox($atts, $content = null) {

  return '<div class="notification fail cannothide" style="position: relative;"><div class="boximg warningimg"></div>'. do_shortcode($content) .'</div>';

}

add_shortcode('worningbox','skt_worningbox');

/**************** download box *************/

function skt_downloadbox($atts, $content = null) {

  return '<div class="notification success cannothide" style="position: relative;"><div class="boximg downloadimg"></div>'. do_shortcode($content) .'</div>';

}

add_shortcode('downloadbox','skt_downloadbox');

/**************** info  box *************/

function skt_infobox($atts, $content = null) {

 return '<div class="notification lock cannothide" style="position: relative;"><div class="boximg infoimg"></div>'. do_shortcode($content) .'</div>';

}

add_shortcode('infobox','skt_infobox');

/**************** normal  box *************/

function skt_normalbox($atts, $content = null) {

  return '<div class="notification download  cannothide" style="position: relative;"><div class="boximg normalimg"></div>'. do_shortcode($content) .'</div>';

}

add_shortcode('normalbox','skt_normalbox'); 

/**************** normal  box *************/

function skt_notificationbox($atts, $content = null) {

  return '<div class="notification edit cannothide" style="position: relative;"><div class="boximg notifyimg"></div>'. do_shortcode($content) .'</div>';

}

add_shortcode('notificationbox','skt_notificationbox');

/**************** notification success box *************/

function skt_notificationsuccessbox($atts, $content = null) {

	return '<div class="notification success canhide" style="position: relative;"><span>SUCCESS!</span> '. do_shortcode($content) .'<div class="icon"></div><div class="close-notification"></div></div>';

}

add_shortcode('successbox','skt_notificationsuccessbox');

/**************** notification fail box *************/

function skt_notificationerrorbox($atts, $content = null) {

	return '<div class="notification fail canhide" style="position: relative;"><span>ERROR!</span> '. do_shortcode($content) .'<div class="icon"></div><div class="close-notification"></div></div>';

}

add_shortcode('notification_error','skt_notificationerrorbox');

/**************** notification info   box *************/

function skt_notificationinfobox($atts, $content = null) {

	return '<div class="notification info canhide" style="position: relative;"><span>INFORMATION:</span>'. do_shortcode($content) .'<div class="icon"></div><div class="close-notification"></div></div>';

}

add_shortcode('notification_info','skt_notificationinfobox');

/**************** notification warning  box *************/

function skt_notificationwarningbox($atts, $content = null) {

	return '<div class="notification warning canhide" style="position: relative;"><span>WARNING!</span> '. do_shortcode($content) .'<div class="icon"></div><div class="close-notification"></div></div>';

}

add_shortcode('notification_warning','skt_notificationwarningbox');

/**************** notification download  box *************/

function skt_notificationdownloadbox($atts, $content = null) {

	return '<div class="notification download canhide" style="position: relative;"><span>DOWNLOAD:</span> '. do_shortcode($content) .'<div class="icon"></div><div class="close-notification"></div></div>';

}

add_shortcode('notification_download','skt_notificationdownloadbox');

/**************** notification chat   box *************/

function skt_notificationchatbox($atts, $content = null) {

	return '<div class="notification chat canhide" style="position: relative;"><span>HELLO!</span> '. do_shortcode($content) .'<div class="icon"></div><div class="close-notification"></div></div>';

}

add_shortcode('notification_chat','skt_notificationchatbox');

/**************** notification task box *************/

function skt_notificationtaskbox($atts, $content = null) {

	return '<div class="notification task canhide" style="position: relative;"><span>TASK!</span> '. do_shortcode($content) .'<div class="icon"></div><div class="close-notification"></div></div>';

}

add_shortcode('notification_task','skt_notificationtaskbox');

/**************** custom list *************/

function skt_custom_list($atts, $content = null) {

	extract(shortcode_atts(array(

	'type'=>''

	), $atts));

  return '<div class="custom_list '.$type.'">'. do_shortcode($content) .'</div>';

}

add_shortcode('custom_list','skt_custom_list');

/********* Google Maps Shortcode ***************/

function skt_googleMaps($atts, $content = null) {

   extract(shortcode_atts(array(

      "width" => '640',

      "height" => '480',

      "src" => ''

   ), $atts));

   return '<div class="map-shortcode"><iframe width="'.$width.'" height="'.$height.'"  src="'.$src.'&amp;output=embed"></iframe></div>';

}

add_shortcode("googlemap", "skt_googleMaps");

/********* Youtube video  Shortcode ***************/

function skt_youtube($atts, $content=null){  

    extract(shortcode_atts( array('src' => '','width'=>'','height'=>''), $atts));  

    $return = $content;  

    if($content)  

    $return .= "<br /><br />";  

    preg_match_all('#(http://www.youtube.com)?/(v/([-|~_0-9A-Za-z]+)|watch\?v\=([-|~_0-9A-Za-z]+)&?.*?)#i',$src,$output);

	$video_id = $output[4][0];

    $return .= '<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/' . $video_id . '" allowfullscreen></iframe>';  

    return $return;   

}  

add_shortcode('youtube', 'skt_youtube'); 

/********* vimeo video  Shortcode ***************/

function skt_vimeo($atts, $content=null){  

    extract(shortcode_atts( array('src' => '','width'=>'','height'=>''), $atts));  

    $return = $content;  

    if($content)  

        $return .= "<br /><br />";  

    preg_match_all('#(http://vimeo.com)/([0-9]+)#i',$src,$output);

	$video_id = $output[2][0];

    $return .= '<iframe width="'.$width.'" height="'.$height.'" src="http://player.vimeo.com/video/' . $video_id . '" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';  

    return $return;   

}  

add_shortcode('vimeo', 'skt_vimeo');

/********* SKT_TABWRAPPER  SHORTCODE ***************/
function skt_tabwrapper($atts, $content=null){ 
	extract(shortcode_atts( array('id' => '','itemno'=>'','orient'=>'','effect'=>''), $atts)); 
?>
	<script type="text/javascript">
		jQuery('document').ready(function(){
			jQuery('#<?php echo $id; ?>').sketchtab({itemno:'<?php echo $itemno; ?>',orient:'<?php echo $orient; ?>',effect:<?php echo $effect; ?>});
	    });
    </script>
<?php	
	$content = preg_replace('#<br \/>#', '', $content);
    $return = '<div id="'.$id.'">' . do_shortcode($content) . '</div>';  
    return $return;    
}  
add_shortcode('tabwrapper', 'skt_tabwrapper');

/********* skt_tabs  Shortcode ***************/
function skt_tabs($atts, $content=null){       
    $return = '<ul class="ske_tabs clearfix">' . do_shortcode($content) . '</ul>';  
    return $return;    
}  
add_shortcode('tabs', 'skt_tabs');

/********* skt_tab  Shortcode ***************/
function skt_tab($atts, $content=null){       
    $return = '<li><a href="javascript:void(0);">' . do_shortcode($content) . '</a></li>';  
    return $return;    
}  
add_shortcode('tabtxt', 'skt_tab');

/********* skt_tab_container  shortcode ***************/
function skt_tabcontainer($atts, $content=null){       
    $return = '<div class="ske_tab_container">' . do_shortcode($content) . '</div>';  
    return $return;    
}  
add_shortcode('tabcontainer', 'skt_tabcontainer');

/********* skt_tab_content  Shortcode ***************/
function skt_tabcontent($atts, $content=null){       
    $return = '<div class="ske_tab_content">' . do_shortcode($content) . '</div>';  
    return $return;    
}  
add_shortcode('tabcontent', 'skt_tabcontent');

/********* SKT_TOGGLE  SHORTCODE ***************/
function skt_toggle($atts, $content=null){  
	extract(shortcode_atts( array('id' => '','state'=>'','effect'=>''), $atts)); 
?>
	<script type="text/javascript">
		jQuery('document').ready(function(){
			jQuery('#<?php echo $id; ?>').sketchtoggle({state:'<?php echo $state; ?>',effect:<?php echo $effect; ?>});
	    });
    </script>
<?php	     
	$content = preg_replace('#<br \/>#', '', $content);
    $return = '<div id="'.$id.'">' . do_shortcode($content) . '</div>';  
    return $return;    
}  
add_shortcode('togglecontainer', 'skt_toggle');

/********* skt_tog_title  Shortcode ***************/
function skt_tog_title($atts, $content=null){  	     
    $return = '<h3 class="ske_tog_title">' . do_shortcode($content) . '</h3>';  
    return $return;    
}  
add_shortcode('togtitle', 'skt_tog_title');

/********* skt_tog_title  Shortcode ***************/
function skt_tog_content($atts, $content=null){  	     
    $return = '<div class="ske_tog_content">' . do_shortcode($content) . '</div>';  
    return $return;    
}  
add_shortcode('togcontent', 'skt_tog_content');


/********* SKT_ACCORDIAN  SHORTCODE ***************/
function skt_accordian($atts, $content=null){  
	extract(shortcode_atts( array('id' => '','hoverpause'=>'','itemno'=>'','effect'=>'','togacc'=>'','autoplay'=>'1'), $atts)); 
?>
	<script type="text/javascript">
		jQuery('document').ready(function(){
		  jQuery('#<?php echo $id; ?>').sketchaccordian({hoverpause:<?php echo $hoverpause; ?>,itemno:'<?php echo $itemno; ?>',effect:<?php echo $effect; ?>,togacc:<?php echo $togacc; ?>,autoplay:<?php echo $autoplay; ?>});
	    });
    </script>
<?php	     
	$content = preg_replace('#<br \/>#', '', $content);
    $return = '<div id="'.$id.'">' . do_shortcode($content) . '</div>';  
    return $return;    
}  

add_shortcode('accordiancontainer', 'skt_accordian');

/********* SKT_PRICE_TABLE  SHORTCODE ***************/

if (!function_exists('skt_pricing_column')) {
	function skt_pricing_column($atts, $content = null) {
	        $args = array(
	            "title"         => "",
	            "price"         => "0",
	            "currency"      => "$",
	            "price_period"  => "Monthly",
	            "link"          => "",
	            "target"        => "",
	            "button_text"   => "Buy Now",
	            "active"        => ""
	        );
	        
		extract(shortcode_atts($args, $atts));
	        
	    $html = ""; 
	        
            if($target == ""){
                    $target = "_self";
            }
			
			if($active == "yes") {
				$html .= "<div class='skt_price_table price_featured'>";
			}else{
				$html .= "<div class='skt_price_table'>";
			}
			
            $html .= "<div class='price_table_inner'>";
            
            if($active == "yes"){
                    $html .= "<div class='active_best_price'><p>". __('Best','invert') ."</p></div>";
            } 

        $html .= "<ul>";
	    $html .= "<li class='cell table_title'>".strtoupper($title)."</li>";
	    $html .= "<li class='prices'>";
	    $html .= "<div class='price_in_table'>";
	    $html .= "<sup class='value'>".$currency."</sup>";
	    $html .= "<span class='price'>".$price."</span>";
	    $html .= "<div class='mark'>".strtoupper($price_period)."</div>";
	    $html .= "</div>";
	    $html .= "</li>"; //close price li wrapper
	    
	    $html .= "<li class='sktprccont'>".no_wpautop($content)."</li>"; //append pricing table content 
	    
	    $html .="<li class='price_button'>";
	    $html .= "<a class='qbutton normal' href='$link' target='$target'>".$button_text."</a>";
	    $html .= "</li>"; //close button li wrapper
	    
	    $html .= "</ul>";
	    $html .= "</div>"; //close price_table_inner
	    $html .="</div>"; //close price_table
	    
	    return $html;
	}
}
add_shortcode('pricing_column', 'skt_pricing_column');


/********* skt_acc_wrap  Shortcode ***************/
function skt_acc_wrap($atts, $content=null){  	     
    $return = '<div class="ske_acc_set">' . do_shortcode($content) . '</div>';  
    return $return;    
}  
add_shortcode('accwrap', 'skt_acc_wrap');

/********* skt_acc_title  Shortcode ***************/
function skt_acc_title($atts, $content=null){  	     
    $return = '<div class="ske_acc_title">' . do_shortcode($content) . '</div>';  
    return $return;    
}  
add_shortcode('acctitle', 'skt_acc_title');

/********* skt_acc_content  Shortcode ***************/
function skt_acc_content($atts, $content=null){  	     
    $return = '<div class="ske_acc_content">' . do_shortcode($content) . '</div>';  
    return $return;    
}  
add_shortcode('acccontent', 'skt_acc_content');


/********* Horizontal Break  Shortcode ***************/
function skt_hr($atts, $content=null){  

	extract(shortcode_atts( array('color' => '','width'=>'','style'=>''), $atts)); 	     

    	$return = '<div class="horizotal_break clearfix" style="border-bottom-style:'.$style.';border-bottom-color:'.$color.';border-bottom-width:'.$width.';">' . do_shortcode($content) . '</div>';  

    return $return;    

}  

add_shortcode('hr', 'skt_hr');

/********* Go to top divider  Shortcode ***************/

function skt_gototop_divider($atts, $content=null){  

	extract(shortcode_atts( array('color' => '','width'=>'','style'=>''), $atts)); 	     

    	$return = '<div class="horizotal_break clearfix" style="border-bottom-style:'.$style.';border-bottom-color:'.$color.';border-bottom-width:'.$width.';"><a style="color:'.$color.';" href="JavaScript:void(0);" title="Back To Top" id="back-to-top">' . do_shortcode($content) . '</a></div>';  

    return $return;    

}  

add_shortcode('gotop', 'skt_gototop_divider');

/********* Highlighted Shortcode ***************/

function skt_highlight($atts, $content=null){  

	extract(shortcode_atts( array('bgcolor' => '','color'=>''), $atts)); 	     

    	$return = '<span class="highlighted" style="background-color:'.$bgcolor.';color:'.$color.';">' . do_shortcode($content) . '</span>';  

    return $return;    

}  

add_shortcode('highlighted', 'skt_highlight');

/*********Share bar shortcode****************/

function skt_share($atts, $content=null){  

extract(shortcode_atts( array('type' => ''), $atts)); 	    

?>

<script type="text/javascript">var switchTo5x=true;</script>

<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>

<script type="text/javascript">stLight.options({publisher: "982f4ac7-8284-472b-a36a-6af95d0f6889", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

<?php	

    	$return = "<div class='sketch_sharebar'>

					<span class='st_sharethis_".$type."' displayText='ShareThis'></span>

					<span class='st_facebook_".$type."' displayText='Facebook'></span>

					<span class='st_twitter_".$type."' displayText='Tweet'></span>

					<span class='st_googleplus_".$type."' displayText='Google +'></span>

					<span class='st_linkedin_".$type."' displayText='LinkedIn'></span>

					<span class='st_pinterest_".$type."' displayText='Pinterest'></span>

					<span class='st_email_".$type."' displayText='Email'></span></div>";  

    return $return;    

}  

add_shortcode('share_icon', 'skt_share');

/*********skt counter ****************/
function skt_counter($attributes, $content)
    {
        $attributes = shortcode_atts(
            array(
                'count' => '99',
                'suffix' => '',
                'prefix' => '',
                'color' => '',
                'title' => '',
            ), $attributes);

        //$color_class = ($attributes['color'] != '')?' color_'.$attributes['color']:'';

        $output = 	'<div class="skt-counter span3 fade_in_hide element_fade_in" data-count="'.$attributes['count'].'" data-prefix="'.$attributes['prefix'].'" data-suffix="'.$attributes['suffix'].'" style="color:'.$attributes['color'].';">
						<div class="skt-counter-h">
							<div class="skt-counter-number">'.$attributes['prefix'].$attributes['count'].$attributes['suffix'].'</div>
							<h6 class="skt-counter-title">'.$attributes['title'].'</h6>
						</div>
					</div>';

        return $output;

    }
	add_shortcode('skt_counter','skt_counter');