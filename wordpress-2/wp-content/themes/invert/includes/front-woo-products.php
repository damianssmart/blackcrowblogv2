<?php
global $invert_shortname;
if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ))) )
{
	$_skt_products_metabox = get_post_meta( $post->ID,'_skt_products_metabox',true );
	$_product_category = sketch_get_option($invert_shortname.'_product_category');
	$_product_slug = get_term_by('id', $_product_category, 'product_cat');
		
	if($_skt_products_metabox == '1'){ ?>
		<div id="portfolio-division-box" class="skt-section">
			<div class="container">
				<div class="row-fluid">
					<div class="portfolio-title span12">
						<div class="row-fluid clearfix">
							<?php if(sketch_get_option($invert_shortname.'_product_title')) { ?> <div class="span8 port-title"><h3><?php echo sketch_get_option($invert_shortname.'_product_title');  ?></h3><span class="border_left"></span></div><?php } ?>
							<?php if(sketch_get_option($invert_shortname.'_product_link')) { ?><div class="span4 port-readmore"><a class="readmore" href="<?php if(sketch_get_option($invert_shortname.'_product_link')) { echo sketch_get_option($invert_shortname.'_product_link'); } ?>"><?php if(sketch_get_option($invert_shortname.'_product_link_title')) { echo sketch_get_option($invert_shortname.'_product_link_title'); } ?></a></div><?php } ?>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<div class="row-fluid">
								<?php echo do_shortcode("[product_category category='$_product_slug->slug']"); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
?>