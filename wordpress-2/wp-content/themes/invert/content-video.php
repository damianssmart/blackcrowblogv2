<?php
/**
 * The template for displaying posts in the Video post format.
 */
?>

<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
	  
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
		
		<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
        <div class="featured-image-shadow-box">
			<?php
					$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'invert_standard_img');
			?>
			<a href="<?php the_permalink(); ?>" class="image">
				<img src="<?php echo $thumbnail[0];?>" alt="<?php the_title(); ?>" class="featured-image alignnon"/>
			</a>
		</div>
	   <?php } ?>
			  
        <h1 class="post-title">
		   <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_title(); ?>
          </a>
		</h1>
		
		<div class="skepost-meta clearfix">
		    <span class="date"><?php _e('On','invert');?> <?php the_time('F j, Y') ?></span><?php _e(',','invert');?>
            <span class="author-name"><?php _e('Posted by ','invert'); the_author_posts_link(); ?> </span><?php _e(',','invert');?>
			<?php if (has_category()) { ?><span class="category"><?php _e('In ','invert');?><?php the_category(','); ?></span><?php _e(',','invert');?><?php } ?>
            <?php the_tags('<span class="tags">By ',',','</span> ,'); ?>
            <span class="comments"><?php _e('With ','invert');?><?php comments_popup_link(__('No Comments ','invert'), __('1 Comment ','invert'), __('% Comments ','invert')) ; ?></span>
        </div>
		<!-- skepost-meta -->

        <div class="skepost">
          <?php the_excerpt(); ?> 
		  <div class="continue"><a href="<<?php the_permalink(); ?>"><?php _e('Read More &rarr;','invert');?></a></div>		  
        </div>
        <!-- skepost -->
		
</div>
<!-- post -->