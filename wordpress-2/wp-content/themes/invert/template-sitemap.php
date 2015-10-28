<?php
/*
Template Name: Sitemap Template
*/
?>
<?php get_header(); ?>
<?php global $invert_shortname; ?>

<div class="main-wrapper-item">
<?php if(have_posts()) : ?>
<?php while(have_posts()) : the_post(); ?>
<?php 
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
					}
					?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>	  
<div class="page-content sitemap-temp">
	<div class="container post-wrap">
		<div class="row-fluid">
			<div id="content" class="span8">
				<?php endwhile; ?>
				<?php else :  ?>
				<?php endif; ?>
				<!-- SiteMap -->
				<div id="Site-map"> 
					<!-- First Column -->
					<div class="sitemap-first sitemap-rows clearfix">
						<div class="left_site sitemap-box span4">
							<div class="title">
								<?php _e('Pages','invert'); ?>
							</div>
							<ul>
								<?php wp_list_pages('title_li='); ?>
							</ul>
						</div>
						<div class="mid_site sitemap-box span3">
							<div class="title">
								<?php _e('Categories','invert'); ?>
							</div>
							<ul>
								<?php wp_list_categories('title_li='); ?>
							</ul>
						</div>
						<div class="right_site sitemap-box span4">
							<div class="title">
							<?php _e('Blog Entries','invert'); ?>
							</div>
							<ul>
								<?php
								$args=array(
								'post_type'=>'post',
								'posts_per_page'=>-1
								);
								// The Query
								$the_query = new WP_Query( $args );
								// The Loop
								while ( $the_query->have_posts() ) : $the_query->the_post();
								echo '<li>';
								?>
								<a href="<?php the_permalink();?>" title="<?php the_title();?>">
								<?php the_title();?>
								</a>
								<?php
								echo '</li>';
								endwhile;
								// Reset Post Data
								wp_reset_postdata();
								?>
							</ul>
						</div>
						<div class="clearfix"></div>
					</div>
					<!-- First Column --> 

					<!-- Second Column -->
					<div class="sitemap-second sitemap-rows clearfix">
						<div class="post-heading title">
							<?php _e('Posts Per Category :-','invert'); ?>
						</div>
						<?php
						$args = array(
						'type'                     => 'post',
						'child_of'                 => 0,
						'orderby'                  => 'name',
						'order'                    => 'ASC',
						'hide_empty'               => 1,
						'taxonomy'                 => 'category'
						);

						$categories=  get_categories($args);
						$count=1;
						foreach($categories as $category)
						{
						?>
						<div class="<?php if($count%3==1){ echo "left_site";}?> <?php if($count%3==2){ echo "mid_site";}?> <?php if($count%3==0){ echo "right_site";}?> sitemap-box span3">
							<div class="title"><?php echo $category->cat_name;?></div>
							<ul>
								<?php
								$args=array(
								'post_type'=>'post',
								'cat'=>$category->term_id,
								'posts_per_page'=>-1
								);
								// The Query
								$the_query = new WP_Query( $args );
								// The Loop
								while ( $the_query->have_posts() ) : $the_query->the_post();
								echo '<li>';
								?>
								<a href="<?php the_permalink();?>" title="<?php the_title();?>">
								<?php the_title();?>
								</a>
								<?php
								echo '</li>';
								endwhile;
								// Reset Post Data
								wp_reset_postdata();
								?>
							</ul>
						</div>
						<?php $count++; } ?>
					</div>    
					<!-- Third Column --> 
					<div class="clearfix"></div>
				</div>
				<!-- SiteMap -->
				<div class="clearfix"></div>
			</div>
			<!-- content -->

			<!-- Sidebar -->
			<div id="sidebar" class="span3">
				<?php get_sidebar('page'); ?>
				<div class="clearfix"></div>
				<!-- Sidebar --> 
			</div>
		</div>
	</div>
  </div>
</div>
<?php get_footer(); ?>