<?php get_header();
/*
Template name: Projects 3-col Template
*/
?>
<?php if(have_posts()) : ?>
<?php while(have_posts()) : the_post(); ?>
<?php 
	$skt_port_filter_hide  = sketch_get_option($invert_shortname.'_hide_pro_filter');
	$pagetitle = get_post_meta($post->ID, "_skt_pagetitle_metabox", true); 
	$pagetitle = ((isset($pagetitle) && $pagetitle !="") ? $pagetitle : '1' ); 
?>
<?php if($pagetitle == 1) { ?>
<div class="bread-title-holder"> 
	<div class="bread-title-bg-image full-bg-breadimage-fixed"></div>
	<div class="container">
		<div class="row-fluid">
			<div class="container_inner clearfix">
				<h1 class="title"><?php the_title(); ?></h1>
				<?php if(sketch_get_option($invert_shortname."_hide_bread") == 'true') {
				if ((class_exists('invert_breadcrumb_class'))) {$invert_breadcumb->custom_breadcrumb();}
				} ?>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<!-- #Container Area -->
<div id="container" class="clearfix">
	<div class="container post-wrap">
		<div class="row-fluid">
			<!-- Content -->
			<div id="content" class="span12">
				<div class="post project-temp3" id="post-<?php the_ID(); ?>" >
					<!-- Project Wrap -->
					<div class="project_wrap clearfix">
						<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
						<?php $args=array('post_type' => 'project','posts_per_page' =>'-1','paged' => $paged);
						query_posts($args);
						$args = array( 'taxonomy' => 'project_category' );
						$data_type = null; //For display data-type class
						$data_id = 0; //For display data-id class
						?>
						<div id="wrap" class="clearfix">
						<?php if($skt_port_filter_hide == "true") { ?>
							<div class="style-filter">
								<!-- Category Filter -->
								<dl class="group maingroup">
									<dt></dt>
									<dd>
										<ul class="filter group" id="isofilters">
											<li><a href="JavaScript:void(0);" data-filter="*" class="selected"><?php _e('show all','invert'); ?></a></li>
											<?php
												$categories=get_categories($args);
												foreach ($categories as $category) {
												$cat_name=$category->name;
												$cat_slug=$category->slug; ?>
											<li><a href="JavaScript:void(0);" data-filter="<?php echo $cat_slug; ?>"><?php echo $cat_name; ?></a></li>
											<?php } ?>
										</ul>
									</dd>
								</dl>
								<!-- Category Filter -->
							</div><!-- style-filter -->
							<?php } ?>
							<div id="container-isotop" class="portfolio group three-col">
								<?php 
								// The Loop
								while ( have_posts() ) : the_post();
								$terms = get_the_terms( $post->ID, 'project_category' ); 
								$cat_links = array();
								foreach ( $terms as $term ) {
								$cat_links[] = $term->slug;
								}
								foreach($cat_links as $itm){
								$data_type .= $itm.' ';
								}
								$data_id++;
								?>
								<!-- Project Box -->
								<div class="item project_box span4 <?php echo $data_type;$data_type =null; ?>" data-type="<?php echo $data_type;$data_type =null; ?>" data-id="id-<?php echo $data_id; ?>">
									<!-- standard -->
									<div class="project-item" id="post-<?php the_ID(); ?>">
										<?php if(has_post_thumbnail()) {
										$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'invert_portfolio_three_image' );
										$pretty_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full'); ?>
										<div class="feature_image" style="position: relative;">
											<img class="skin-border" src="<?php echo $image[0]; ?>" alt="Thumbnail" />
										</div>
										<div class="title">
											<a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a>
										</div>
										<div class="mask">
											<a data-rel="prettyPhoto" class="icon-image folio" href="<?php echo $pretty_thumb[0]; ?>"></a>
										</div>
										<?php } ?>
									</div>
									<!-- standard -->
								</div>
								<!-- Project Box -->
								<?php
								endwhile;					
								// Reset Query
								?>
							</div>
							<div class="clearfix"></div>
							<?php wp_reset_query(); ?>
						</div>
					</div>
					<!-- Project Wrap -->
				</div>	
				<?php endwhile; ?>
				<?php else : ?>
					<div class="post"><h2><?php _e('Not Found','invert'); ?></h2></div>
				<?php endif; ?>
			</div>
			<!-- Content -->
		</div>
	</div>
</div>
<!-- #Container Area -->
<?php get_footer(); ?>