<?php 
global $invert_shortname;
$clientlogometa = get_post_meta( $post->ID,'_skt_clientlogo_metabox',true );
if($clientlogometa === '1'){ ?>
<div id="full-client-box" class="skt-section">
	<div class="container">
		<div class="row-fluid">
			<?php if(sketch_get_option($invert_shortname."_clientsec_title")){?><h3 class="inline-border"><?php echo sketch_get_option($invert_shortname."_clientsec_title"); ?></h3><span class="border_left"></span><?php } ?>
			<ul class="clients-items clearfix">
				<?php if(sketch_get_option($invert_shortname.'_img1_icon')){ ?><li class="span2"><a href="<?php if(sketch_get_option($invert_shortname.'_img1_link')){ echo sketch_get_option($invert_shortname.'_img1_link','invert'); } ?>" title="<?php if(sketch_get_option($invert_shortname.'_img1_title')){ echo sketch_get_option($invert_shortname.'_img1_title','invert'); } ?>"><img alt="client-logo" src="<?php if(sketch_get_option($invert_shortname.'_img1_icon')){ echo sketch_get_option($invert_shortname.'_img1_icon','invert'); } ?>"></a></li><?php } ?>

				<?php if(sketch_get_option($invert_shortname.'_img2_icon')){ ?><li class="span2"><a href="<?php if(sketch_get_option($invert_shortname.'_img2_link')){ echo sketch_get_option($invert_shortname.'_img2_link','invert'); } ?>" title="<?php if(sketch_get_option($invert_shortname.'_img2_title')){ echo sketch_get_option($invert_shortname.'_img2_title','invert'); } ?>"><img alt="client-logo" src="<?php if(sketch_get_option($invert_shortname.'_img2_icon')){ echo sketch_get_option($invert_shortname.'_img2_icon','invert'); } ?> "></a></li><?php } ?>

				<?php if(sketch_get_option($invert_shortname.'_img3_icon')){ ?><li class="span2"><a href="<?php if(sketch_get_option($invert_shortname.'_img3_link')){ echo sketch_get_option($invert_shortname.'_img3_link','invert'); } ?>" title="<?php if(sketch_get_option($invert_shortname.'_img3_title')){ echo sketch_get_option($invert_shortname.'_img3_title','invert'); } ?>"><img alt="client-logo" src="<?php if(sketch_get_option($invert_shortname.'_img3_icon')){ echo sketch_get_option($invert_shortname.'_img3_icon','invert'); } ?>"></a></li><?php } ?>

				<?php if(sketch_get_option($invert_shortname.'_img4_icon')){ ?><li class="span2"><a href="<?php if(sketch_get_option($invert_shortname.'_img4_link')){ echo sketch_get_option($invert_shortname.'_img4_link','invert'); } ?>" title="<?php if(sketch_get_option($invert_shortname.'_img4_title')){ echo sketch_get_option($invert_shortname.'_img4_title','invert'); } ?>"><img alt="client-logo" src="<?php if(sketch_get_option($invert_shortname.'_img4_icon')){ echo sketch_get_option($invert_shortname.'_img4_icon','invert'); } ?>"></a></li><?php } ?>

				<?php if(sketch_get_option($invert_shortname.'_img5_icon')){ ?><li class="span2"><a href="<?php if(sketch_get_option($invert_shortname.'_img5_link')){ echo sketch_get_option($invert_shortname.'_img5_link','invert'); } ?>" title="<?php if(sketch_get_option($invert_shortname.'_img5_title')){ echo sketch_get_option($invert_shortname.'_img5_title','invert'); } ?>"><img alt="client-logo" src="<?php if(sketch_get_option($invert_shortname.'_img5_icon')){ echo sketch_get_option($invert_shortname.'_img5_icon','invert'); } ?>"></a></li><?php } ?>
			</ul>
		</div>
	</div>
</div>
<?php } ?>