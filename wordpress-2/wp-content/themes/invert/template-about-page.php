<?php
/*
Template Name: About page Template
*/
?>
<?php get_header(); ?>
<?php global $invert_shortname; ?>

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
					<h1 class="title">
						<?php the_title(); ?>
					</h1>
					<?php if(sketch_get_option($invert_shortname."_hide_bread") == 'true') {
					if ((class_exists('invert_breadcrumb_class'))) {$invert_breadcumb->custom_breadcrumb();}
					}
					?>
				</div>
			</div>
		</div>
</div>
<?php } ?>

<?php if($post->post_content != "")  { ?>
<div class="container post-wrap">
	<div class="row-fluid">
		<div id="container" class="span12">
			<div id="content">
				<div class="post" id="post-<?php the_ID(); ?>">
					<div class="skepost">
						<?php the_content(); ?>
						<?php wp_link_pages(__('<p><strong>Pages:</strong> ','invert'), '</p>', __('number','invert')); ?>
						<?php edit_post_link('Edit', '', ''); ?>	
					</div>
					<!-- skepost --> 
				</div>
				<!-- post -->
				<div class="clearfix"></div>
			</div>
			<!-- content --> 
		</div>
	<!-- container -->
	</div>
</div>
<?php } ?>
<?php endwhile; ?>
<?php else :  ?>
<?php endif; ?>

<div id="team-division-box" class="skt-section about-template">
	<div class="team-division container">
		<!--our_team_member-->
		<div class="our_team_member">
			<div class="team_custom_title title_center"> 
				<?php if(sketch_get_option($invert_shortname.'_teammember_title')) { ?><h3><?php echo sketch_get_option($invert_shortname.'_teammember_title'); ?></h3><span class="border_center"> </span><?php } ?>
				<p><?php if(sketch_get_option($invert_shortname.'_teamsub_title')) { echo sketch_get_option($invert_shortname.'_teamsub_title'); } ?></p>
			</div>
			<!--team-container-->

			<div class="team-box row-fluid"> 
				<?php $count=1;
					if(sketch_get_option($invert_shortname.'_numbet_team_member')){ $skt_numbet_team_member = sketch_get_option($invert_shortname.'_numbet_team_member'); } 
				?>

				<?php 
					$args = array('post_type' => 'team_member','posts_per_page' => $skt_numbet_team_member);
					$the_query = new WP_Query($args);
					if($the_query->have_posts()) : 
					while ( $the_query->have_posts() ) : $the_query->the_post();
					$id = get_the_ID();
					$data = get_post_meta($id);
					$avatar 	= !empty($data['_teammember_avatar'][0]) ? $data['_teammember_avatar'][0] : '' ;
					$content 	= !empty($data['_teammember_content'][0]) ? $data['_teammember_content'][0] : '' ;
					$name 		= !empty($data['_teammember_name'][0]) ? $data['_teammember_name'][0] : '' ;
					$website 	= !empty($data['_teammember_website'][0]) ? $data['_teammember_website'][0] : '' ;
					$website    =  esc_url($website);
					$job 	    = !empty($data['_teammember_job'][0]) ? $data['_teammember_job'][0] : '' ;	
					$fb_url 	= !empty($data['_teammember_fb'][0]) ? $data['_teammember_fb'][0] : '' ;
					$fb_url     =  esc_url($fb_url);
					$tw_url 	= !empty($data['_teammember_tw'][0]) ? $data['_teammember_tw'][0] : '' ;
					$tw_url     =  esc_url($tw_url);
					$drb_url 	= !empty($data['_teammember_drb'][0]) ? $data['_teammember_drb'][0] : '' ;
					$drb_url    =  esc_url($drb_url);
					$mailid_url = !empty($data['_teammember_mailid'][0]) ? $data['_teammember_mailid'][0] : '' ;
					$skype_url 	= !empty($data['_teammember_skype'][0]) ? $data['_teammember_skype'][0] : '' ;		
				?>



				<div class="team-box-mid span4 <?php if($count%3==0){?>no-margin<?php }?>">
					<div class="teammember">
						<a href="javascript:void(0);"><img alt="HOME" src="<?php echo $avatar; ?>" class="teammember_img"></a>
						<strong><?php if($website) { ?><a class="team_name" href="<?php echo $website; ?>"><?php echo $name; ?></a><?php } else {?><span class="team_name"> <?php echo $name; ?></span><?php } ?></strong>
						<strong><?php echo $job; ?></strong>
						<p>
							<?php 
								$_team_cont_limit = sketch_get_option($invert_shortname.'_team_cont_limit');
								$_team_cont_limit = (isset($_team_cont_limit) && $_team_cont_limit !="") ? $_team_cont_limit : '20';
								echo invert_slider_limit_words($content, $_team_cont_limit); 
							?>
						</p>
						<ul class="teamsocial">
							<?php if( $website) { ?><li><a href="<?php echo $website; ?>" ><i class="fa fa-globe "></i></a></li><?php } ?>	
							<?php if( $fb_url) { ?><li><a href="<?php echo $fb_url; ?>"><i class="fa fa-facebook"></i></a></li><?php } ?>			
							<?php if( $tw_url) { ?><li><a href="<?php echo $tw_url; ?>"><i class="fa fa-twitter"></i></a></li><?php } ?>		
							<?php if( $drb_url) { ?><li><a href="<?php echo $drb_url; ?>"><i class="fa fa-dribbble"></i></a></li><?php } ?>			
							<?php if( $mailid_url) { ?><li><a href="mailto:<?php echo $mailid_url; ?>"><i class="fa fa-envelope-o"></i></a></li><?php } ?>	
							<?php if( $skype_url) { ?><li><a href="skype:<?php echo $skype_url; ?>?call"><i class="fa fa-skype"></i></a></li><?php } ?>			
							
						</ul>
					</div>
				</div>
				<?php $count++;?>
				<?php endwhile; endif; ?>
				<div class="clearfix"></div>
			</div>
		</div>
		<!-- our_team_member --> 
	</div>
	<!-- content --> 
</div>
<!-- team-division-box -->
<?php get_footer(); ?>