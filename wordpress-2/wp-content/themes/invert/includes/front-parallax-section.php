<!-- FULL-DIVISION-BOX -->
<?php
global $invert_shortname;
$parallaxeffectmeta = get_post_meta( $post->ID,'_skt_parallaxeffect_metabox',true );
if($parallaxeffectmeta == '1'){ ?>
<div id="full-division-box" class="full-bg-image full-bg-image-fixed">
	<div class="container full-content-box" >
		<div class="row-fluid">
			<div class="span12">
				<?php if(sketch_get_option($invert_shortname."_para_content_left")) { echo sketch_get_option($invert_shortname."_para_content_left");} ?>
			</div>
		</div>
	</div>
</div>
<?php } ?>