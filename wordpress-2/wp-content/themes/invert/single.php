<?php 
/**
 * The Template for displaying all single posts.
 */

get_header(); ?>

<?php global $invert_shortname; ?>
<div class="main-wrapper-item">
<?php if(have_posts()) : ?>
<?php while(have_posts()) : the_post(); ?>
	<div class="bread-title-holder">
		<div class="bread-title-bg-image full-bg-breadimage-fixed"></div>
		<div class="container">
			<div class="row-fluid">
				<div class="container_inner clearfix">
					<h1 class="title"><?php the_title(); ?></h1>
					<?php
						if(sketch_get_option($invert_shortname."_hide_bread") == 'true') {
						if ((class_exists('invert_breadcrumb_class'))) {$invert_breadcumb->custom_breadcrumb();}
						}
					?>
				</div>
			</div>
		</div>
	</div>

<div class="container post-wrap">
	<div class="row-fluid">
		<div id="container" class="span8">
			<div id="content">  
					<div class="post" id="post-<?php the_ID(); ?>">
						<?php $format = get_post_format(); ?> 
						<?php if($format == "quote") { ?>
							<div class="citation_post clearfix">
								<?php
								//  Citation datas
								$post_id =  get_the_ID();
								$citation = get_post_meta($post->ID, "_skt_postType_citation", true);
								$citation_author = get_post_meta($post->ID, "_skt_postType_citation_author", true);
								?>

								<blockquote class="skt-quote">
									<?php echo $citation ;?>
									<span class="quoteauthor">&mdash; <?php echo $citation_author ;?></span>
								</blockquote>
							</div>
						<?php } ?>

						<?php if($format == "video") { ?>
						<div class="post-image clearfix">
							<div class="video-container">
								<?php $post_id =  get_the_ID();
					if (get_post_meta($post->ID, '_skt_postType_youtubevideo', true)){ 
						$youtube_src1 =	get_post_meta($post->ID, '_skt_postType_youtubevideo', true);

						if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $youtube_src1)) {
												preg_match_all('#(http://www.youtube.com)?/(v/([-|~_0-9A-Za-z]+)|watch\?v\=([-|~_0-9A-Za-z]+)&?.*?)#i',$youtube_src1,$output);
												$invert_yvideo_id = $output[4][0];
						} else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $youtube_src1)) {
												preg_match_all('#(http://www.youtube.com)?/(v/([-|~_0-9A-Za-z]+)|watch\?v\=([-|~_0-9A-Za-z]+)&?.*?)#i',$youtube_src1,$output);
												$invert_yvideo_id = $output[4][0];
						} else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/',$youtube_src1)) {
												preg_match_all('#(http://www.youtube.com)?/(v/([-|~_0-9A-Za-z]+)|watch\?v\=([-|~_0-9A-Za-z]+)&?.*?)#i',$youtube_src1,$output);
												$invert_yvideo_id = $output[4][0];
						} else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $youtube_src1)) {
												preg_match_all('#(http://www.youtube.com)?/(v/([-|~_0-9A-Za-z]+)|watch\?v\=([-|~_0-9A-Za-z]+)&?.*?)#i',$youtube_src1,$output);
												$invert_yvideo_id = $output[4][0];
						} else if(preg_match('/https:\/\/(www\.)*youtube\.com\/.*/',$youtube_src1)){
												preg_match_all('#(http://www.youtube.com)?/(v/([-|~_0-9A-Za-z]+)|watch\?v\=([-|~_0-9A-Za-z]+)&?.*?)#i',$youtube_src1,$output);
												$invert_yvideo_id = $output[4][0];
						}
					
					?>
					<div class="flex-video widescreen vimeo">
						<iframe width="770" height="442" src="https://www.youtube.com/embed/<?php echo $invert_yvideo_id; ?>?wmode=opaque" frameborder="0" class="youtube-video" allowfullscreen></iframe>
					</div>
					<?php }

					if (get_post_meta($post->ID, '_skt_postType_vimeovideo', true)){ 
						$vimeo_src1 = get_post_meta($post->ID, '_skt_postType_vimeovideo', true);
					function parse_vimeo($link){
					     
					        $regexstr = '~
					            # Match Vimeo link and embed code
					            (?:<iframe [^>]*src=")?       # If iframe match up to first quote of src
					            (?:                         # Group vimeo url
					                https?:\/\/             # Either http or https
					                (?:[\w]+\.)*            # Optional subdomains
					                vimeo\.com              # Match vimeo.com
					                (?:[\/\w]*\/videos?)?   # Optional video sub directory this handles groups links also
					                \/                      # Slash before Id
					                ([0-9]+)                # $1: VIDEO_ID is numeric
					                [^\s]*                  # Not a space
					            )                           # End group
					            "?                          # Match end quote if part of src
					            (?:[^>]*></iframe>)?        # Match the end of the iframe
					            (?:<p>.*</p>)?              # Match any title information stuff
					            ~ix';
					         
					        preg_match($regexstr, $link, $matches);
					         
					        return $matches[1];
					         
					    }
					$invert_vvideo_id = parse_vimeo($vimeo_src1);
					
						if($invert_vvideo_id) {?>   
						<div class="flex-video widescreen vimeo">   
							<iframe src='http://player.vimeo.com/video/<?php echo $invert_vvideo_id; ?>?portrait=0&amp;title=0&amp;byline=0&amp;badge=0' width='770' height='442' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
						</div>
							<?php 
						} ?>
					<?php  } ?>
							</div>
						</div>
						<?php } ?>

						<?php if($format == "gallery") { ?>
						<?php
						$att_args = array( 'post_type'      => 'attachment',
									   'numberposts'    => -1,
									   'post_status'    => null,
									   'post_parent'    => $post->ID,
									   'post_mime_type' => 'image',
									   'orderby'        => 'menu_order'
								);
						$attachments = get_posts( $att_args );
						?>

						<div class="slider-attach">
							<?php if( $attachments ): ?>
							<?php 
								$bullets = get_post_meta($post->ID, "_skt_postType_slider_bullet", true);
								$postautoscroll = get_post_meta($post->ID, "_skt_postType_slider_auscroll", true);
								$postdirction = get_post_meta($post->ID, "_skt_postType_slider_direction", true);
							?>

							<script type="text/javascript">
									jQuery(document).ready(function(){
										  jQuery(window).load(function () {
											jQuery('#post-slider-<?php the_ID(); ?>').flexslider({
												animation: "fade",
												namespace: "postformat-gallery",//{NEW} String: Prefix string attached to the class of every element generated by the plugin
												selector: ".slides > li",       //{NEW} Selector: Must match a simple pattern. '{container} > {slide}' -- Ignore pattern at your own peril
												easing: "swing",                //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
												direction: "vertical",
												slideshow: true,
												slideshowSpeed: 5000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
												animationSpeed: 600,            //Integer: Set the speed of animations, in millisecond
												controlsContainer: "",
												controlNav: false,              //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
												directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
												prevText: "",                   //String: Set the text for the "previous" directionNav item
												nextText: ""
											});
										});
									});
							</script> 

							<div class="image-gallery-slider" id="post-slider-<?php the_ID(); ?>">
								<ul class="gallery-box slides">
									<?php foreach( $attachments as $attachment ): ?>
									 <li>
										<?php $attachment_img = wp_get_attachment_image_src( $attachment->ID, 'invert_standard_img'); ?>
				  						<img src="<?php echo $attachment_img[0]; ?>" alt="<?php echo $attachment->post_title; ?>" width="<?php echo $attachment_img[1]; ?>" height="<?php echo $attachment_img[2]; ?>" />
			  						</li>
									<?php endforeach; ?>
								</ul>
							</div>
							<?php endif; ?>
						</div><!-- slider-attach -->
						<?php } ?>


						<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
						<div class="featured-image-shadow-box">
							<?php the_post_thumbnail('full'); ?>
						</div>
						<?php } ?>

						<div class="bread-title">
							<h1 class="title">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							</h1>
							<div class="clearfix"></div>
						</div>

						<div class="skepost-meta clearfix">
							<span class="date"><?php _e('On','invert');?> <?php the_time('F j, Y') ?></span><?php _e(',','invert');?>
							<span class="author-name"><?php _e('Posted by ','invert'); the_author_posts_link(); ?> </span><?php _e(',','invert');?>
							<?php if (has_category()) { ?><span class="category"><?php _e('In ','invert');?><?php the_category(','); ?></span><?php _e(',','invert');?><?php } ?>
							<?php the_tags('<span class="tags">By ',',','</span> ,'); ?>
							<span class="comments"><?php _e('With ','invert');?><?php comments_popup_link(__('No Comments ','invert'), __('1 Comment ','invert'), __('% Comments ','invert')) ; ?></span>
						</div>
						<!-- skepost-meta -->

						<div class="skepost">
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'invert' ) ); ?>
							<?php wp_link_pages(__('<p><strong>Pages:</strong> ','invert'), '</p>', __('number','invert')); ?>
						</div>
						<!-- skepost -->

						<div class="navigation"> 
							<span class="nav-previous"><?php previous_post_link( __('&larr; %link','invert')); ?></span>
							<span class="nav-next"><?php next_post_link( __('%link &rarr;','invert')); ?></span> 
						</div>
						<div class="clearfix"></div>
						<div class="comments-template">
							<?php comments_template( '', true ); ?>
						</div>
					</div>
				<!-- post -->
				<?php endwhile; ?>
				<?php else :  ?>

				<div class="post">
					<h2><?php _e('Not Found','invert'); ?></h2>
				</div>
				<?php endif; ?>
			</div><!-- content --> 
		</div><!-- container --> 

		<!-- Sidebar -->
		<div id="sidebar" class="span3">
			<?php get_sidebar(); ?>
		</div>
		<!-- Sidebar --> 

	</div>
 </div>
</div>
<?php get_footer(); ?>