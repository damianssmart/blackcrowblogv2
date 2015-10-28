<div class="front-video-bg">
<?php  
	$skt_video_section = get_post_meta( $post->ID,'_skt_video_section',true ); 
?>
<?php if(sketch_get_option($invert_shortname.'_homevideo_hght')){ $skt_video_height = sketch_get_option($invert_shortname.'_homevideo_hght','invert'); } ?>
<?php 	
		if (get_post_meta($post->ID, '_skt_video_section', true)){ 
			$vimeo_src1 = get_post_meta($post->ID, '_skt_video_section', true);
			$skt_vvideo_id = parse_vimeo($vimeo_src1);
		if(isset($skt_vvideo_id)){ ?>     
			<iframe src='http://player.vimeo.com/video/<?php echo $skt_vvideo_id; ?>?portrait=0&amp;title=0&amp;byline=0&amp;badge=0' height='<?php echo $skt_video_height; ?>' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
		<?php }
		 }

		$post_id =  get_the_ID();
			if (get_post_meta($post->ID, '_skt_video_section', true)){ 
			$youtube_src1 =	get_post_meta($post->ID, '_skt_video_section', true);

		if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $youtube_src1)) {
			preg_match_all('#(http://www.youtube.com)?/(v/([-|~_0-9A-Za-z]+)|watch\?v\=([-|~_0-9A-Za-z]+)&?.*?)#i',$youtube_src1,$output);
			$video_id = $output[4][0];
		} else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $youtube_src1)) {
			preg_match_all('#(http://www.youtube.com)?/(v/([-|~_0-9A-Za-z]+)|watch\?v\=([-|~_0-9A-Za-z]+)&?.*?)#i',$youtube_src1,$output);
			$video_id = $output[4][0];
		} else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/',$youtube_src1)) {
			preg_match_all('#(http://www.youtube.com)?/(v/([-|~_0-9A-Za-z]+)|watch\?v\=([-|~_0-9A-Za-z]+)&?.*?)#i',$youtube_src1,$output);
			$video_id = $output[4][0];
		} else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $youtube_src1)) {
			preg_match_all('#(http://www.youtube.com)?/(v/([-|~_0-9A-Za-z]+)|watch\?v\=([-|~_0-9A-Za-z]+)&?.*?)#i',$youtube_src1,$output);
			$video_id = $output[4][0];
		} else if(preg_match('/https:\/\/(www\.)*youtube\.com\/.*/',$youtube_src1)){
			preg_match_all('#(http://www.youtube.com)?/(v/([-|~_0-9A-Za-z]+)|watch\?v\=([-|~_0-9A-Za-z]+)&?.*?)#i',$youtube_src1,$output);
			$video_id = $output[4][0];
		}
		?>
		<?php if(isset($video_id)){ ?>
			<iframe height="<?php echo $skt_video_height; ?>" src="https://www.youtube.com/embed/<?php echo $video_id; ?>?autohide=1&amp;wmode=opaque&amp;showinfo=0" class="youtube-video" allowfullscreen></iframe>
		<?php }
		} ?>
</div>