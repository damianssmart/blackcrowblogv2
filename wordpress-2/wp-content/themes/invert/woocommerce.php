<?php 
/**
* The template for displaying woocommerce pages.
*
* This is the template that displays all pages by default.
* Please note that this is the WordPress construct of pages and that other
* 'pages' on your WordPress site will use a different template.
*
*/
get_header(); 
?>
<?php
//change to 4 columsn per row when using sidebar
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 4; // 4 products per row
	}
}
?>

<?php global $invert_shortname; ?>

<div class="main-wrapper-item"> 
	<?php 
		$pagetitle ='';
		$pagetitle = get_post_meta($post->ID, "_skt_pagetitle_metabox", true); 
		$pagetitle = ((isset($pagetitle) && $pagetitle !="") ? $pagetitle : '1' ); 
	?>

	<?php if($pagetitle == 1) { ?>
		<div class="bread-title-holder">
			<div class="bread-title-bg-image full-bg-breadimage-fixed"></div>
			<div class="container">
				<div class="row-fluid">
					<div class="container_inner clearfix">
						<h1 class="title"><?php if(class_exists( 'Woocommerce' ) && is_woocommerce() ) { woocommerce_page_title(); } ?></h1>
						<?php if(sketch_get_option($invert_shortname."_hide_bread") == 'true') {
							if ((function_exists('woocommerce_breadcrumb'))) {
								$args = array(
										'delimiter'  =>  '<span class="skt-breadcrumbs-separator"> / </span>',
										'wrap_before'  => '<section class="cont_nav"><div class="cont_nav_inner"><p>',
										'wrap_after' => '</p></div></section>',
										'before'   => '&nbsp;',
										'after'   => '&nbsp;'
									);
								woocommerce_breadcrumb($args);
							}
						} ?>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>		
	
	<?php
	$main_shop_layout = sketch_get_option($invert_shortname.'main_shop_layout');
	$single_product_layout = sketch_get_option($invert_shortname.'single_product_layout');
	?>
	
	<?php
	//single product layout
	if(is_product()){
	
		if($single_product_layout === "left-sidebar") { 
			?><div class="page-content left-sidebar shop-template"><?php 
		}
		else { 
			?><div class="page-content default-pagetemp shop-template"><?php 
		} 
	}
	//Main Shop page layout 
	elseif(is_shop() || is_product_category() || is_product_tag()){
	
		if($main_shop_layout === "left-sidebar") {
			?><div class="page-content left-sidebar woo-three-col shop-template"><?php
		}
		elseif($main_shop_layout === "right-sidebar") { 
			?><div class="page-content woo-three-col default-pagetemp shop-template"><?php 
		} 
		else{ 
			?><div class="page-content default-pagetemp shop-template"><?php 
		} 
	}
	?>
	
		<div class="container post-wrap">
			<div class="row-fluid">
			
				<?php	
				//single product layout
				if(is_product()){
					
					if($single_product_layout == 'right-sidebar' || $single_product_layout == 'left-sidebar'){ 
						add_filter('loop_shop_columns', 'loop_columns');
					}
					
					switch($single_product_layout) {
						case 'no-sidebar':
							woocommerce_content(); 
							break; 
						case 'right-sidebar':

							echo '<div id="content" class="span8">';
								woocommerce_content(); 
							echo '</div><!--/span8-->';
							
							echo '<div id="sidebar" class="span3">';
								get_sidebar('shoppage'); 
							echo '</div><!--/span3--><div class="clearfix"></div>';
							
							break; 
							
						case 'left-sidebar':
							echo '<div id="content" class="span8">';
								woocommerce_content(); 
							echo '</div><!--/span8-->';
							
							echo '<div id="sidebar" class="span3">';
								get_sidebar('shoppage'); 
							echo '</div><!--/span3--><div class="clearfix"></div>';
							break; 
						default: 
							woocommerce_content(); 
							break; 
					}
			
				}
				
				//Main Shop page layout 
				elseif(is_shop() || is_product_category() || is_product_tag()) {
					
					if($main_shop_layout == 'right-sidebar' || $main_shop_layout == 'left-sidebar'){ 
						add_filter('loop_shop_columns', 'loop_columns');
					}
					
					switch($main_shop_layout) {
						case 'no-sidebar':
							woocommerce_content(); 
							break; 
						case 'right-sidebar':

							echo '<div id="content" class="span8">';
								woocommerce_content(); 
							echo '</div><!--/span8-->';
							
							echo '<div id="sidebar" class="span3">';
								get_sidebar('shoppage'); 
							echo '</div><!--/span3--><div class="clearfix"></div>';
							
							break; 
							
						case 'left-sidebar':
							echo '<div id="content" class="span8">';
								woocommerce_content(); 
							echo '</div><!--/span8-->';
							
							echo '<div id="sidebar" class="span3">';
								get_sidebar('shoppage'); 
							echo '</div><!--/span3--><div class="clearfix"></div>';
							break; 
						default: 
							woocommerce_content(); 
							break; 
					}

				}
				
				//regular WooCommerce page layout 
				else {
					 woocommerce_content(); 
				}
				?>
			</div><!-- row-fluid -->
		</div><!-- container post-wrap -->
		
	</div><!-- page-content -->
</div><!-- main-wrapper-item -->
<?php get_footer(); ?>