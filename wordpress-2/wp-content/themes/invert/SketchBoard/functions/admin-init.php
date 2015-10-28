<?php
/********************************************
 FRAME WORK CODE STARTS HERE
*********************************************/
/********************************************
 THEME VARIABLES
*********************************************/
global $invert_themename;
global $invert_shortname;
require_once('sketch-functions.php');                // Pagination, excerpt control etc.
require_once('sketch-enqueue.php');                  // Enqueue Css Scripts
require_once('sketch-breadcrumb.php');               // custom post types includes
require_once('post-types/skt-custom-post-types.php');// custom post types includes
require_once('shortcodes/shortcodes.php');           // Shortcode includes
require_once('widgets/include-widgets.php');         // Includes Widget
require_once('skt-post-metabox.php');                // Meta box for gallery video quote
require_once('skt-pagetitle-section-metabox.php');   // Meta box for page title
require_once('skt-frontpage-sections-metabox.php');  // Meta box for Front page sections