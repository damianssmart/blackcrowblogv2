<?php 
global $invert_shortname;
$ctameta = get_post_meta( $post->ID,'_skt_calltoaction_metabox',true );
if($ctameta == '1'){ ?>
<div id="call-to-action-box" class="skt-section">
	<div class="container">
		<div class="call-to-action-block row-fluid">
			<div id="content" class="span12">
				<div class="skt-ctabox">
					<div class="skt-ctabox-content">
						<?php if(sketch_get_option($invert_shortname."_catoac_heading")) { ?><h2><?php echo sketch_get_option($invert_shortname."_catoac_heading"); ?></h2><?php } ?>
						<?php if(sketch_get_option($invert_shortname."_catoac_content")) { ?><p><?php echo sketch_get_option($invert_shortname."_catoac_content"); ?></p><?php } ?>
					</div>

					<?php if(sketch_get_option($invert_shortname."_catoac_txt")) { ?>
						<div class="skt-ctabox-button">
						<a href="<?php if(sketch_get_option($invert_shortname.'_catoac_link')) { echo sketch_get_option($invert_shortname.'_catoac_link'); } ?>" class="skt-ctabox-button"><?php echo sketch_get_option($invert_shortname."_catoac_txt"); ?></a>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>