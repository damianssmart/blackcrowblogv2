<?php if ( is_page_template('template-front-page.php')  ) { ?>
<!-- header slider -->
<?php
	if(get_query_var( 'page')){	
		$paged=get_query_var('page');			
	}	
	else{	
		$paged=get_query_var('paged');	
	}
	$args=array('post_type'=>'Slides','posts_per_page'=>-1,'paged'=>$paged);
	query_posts( $args );	
?>
<!-- flexslider jQuery Slider -->
<div class="flexslider">
	<ul class="slides">
		<?php if(have_posts()) : ?>
		<?php while(have_posts()) : the_post(); ?>
		<li> 
			<?php if(has_post_thumbnail()){ $thumbnail=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),"full");?>
				<img src="<?php echo $thumbnail[0];?>"   alt="Sliderimg"/>
			<?php } ?>
			<?php $excerpt = get_the_excerpt(); ?>
			<p class="flex-caption">
				<span class="slider-title"><?php echo get_the_title(); ?></span>
				<?php if($excerpt) { ?><span class="text"><?php echo invert_slider_limit_words($excerpt, '20'); ?></span><?php } ?>
				<?php $sliderlinktxt = get_post_meta($post->ID, "_slider_link_text", true); ?>
				<?php $sliderlink = get_post_meta($post->ID, "_slider_link", true); ?>
				<?php if($sliderlink ) { ?><span class="slider-link"><a href="<?php echo esc_url($sliderlink); ?>"><?php echo $sliderlinktxt; ?></a></span><?php } ?>
			</p>
		</li>
		<?php endwhile; ?>
		<?php else : ?>
		<div class="post"><img alt="invert-default-slider-image" class="default-slider-image"  src="<?php echo get_template_directory_uri();?>/images/invert.jpg" ></div>
		<?php endif; ?>
		<?php wp_reset_query();?>
	</ul>
</div>
<!-- end flexslider jQuery Slider -->
<!-- header slider -->
<?php } ?>