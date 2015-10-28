<?php
/*
Template Name: Home page Template
*/
get_header(); 
global $invert_shortname; 
?>

<?php
	global $wp_query;
	$postid = $wp_query->post->ID;
	$_skt_frontpage_sections_order = get_post_meta($postid, '_skt_frontpage_sections_order', true);
	
	if(isset($_skt_frontpage_sections_order) && $_skt_frontpage_sections_order !=""){
	
		foreach($_skt_frontpage_sections_order as $fsection){ 
		
			if($fsection === "Featured Box Section"){
			
				include("includes/front-mid-box.php");                // FEATURED BOXES SECTION
			
			}elseif($fsection === "Call to Action Section"){
			
				include("includes/front-call-to-action-section.php"); // CALL-TO-ACTION SECTION
			
			}elseif($fsection === "Latest Project Section"){
			
				include("includes/front-latest-project.php");         // LATEST PROJECTS SECTION			
			
			}elseif($fsection === "Product Section"){
			
				include("includes/front-woo-products.php");           // LATEST PRODUCTS SECTION
			
			}elseif($fsection === "Content Box with Parallax Effect Section"){
			
				include("includes/front-parallax-section.php");       // AWESOME PARALLAX SECTION
			
			}elseif($fsection === "Team Member Section"){
			
				include("includes/front-teammember-box.php");         // TEAM MEMBER SECTION
				
			}elseif($fsection === "Client Logo Section"){
			
				include("includes/front-client-logo-section.php");    // TEAM MEMBER SECTION
				
			}elseif($fsection === "Page Content"){
				$post_object = get_post( $postid );
				if($post_object->post_content) {
				?>
					<!-- PAGE EDITER CONTENT -->
					<div id="front-content-box" class="skt-section">
						<div class="container">
							<div class="row-fluid"> 
								<?php 
									echo do_shortcode($post_object->post_content); 
								?>
							</div>
							<div class="border-content-box bottom-space"></div>
						</div>
					</div>
					<!-- \\PAGE EDITER CONTENT -->
				<?php
				}
			}
		}
	}else{
	?>
		<!-- FEATURED BOXES SECTION -->
		<?php include("includes/front-mid-box.php"); ?>

		<!-- CALL TO ACTION SECTION -->
		<?php include("includes/front-call-to-action-section.php"); ?>

		<!-- LATEST PORTFOLIO SECTION -->
		<?php include("includes/front-latest-project.php"); ?>
		
		<!-- LATEST PRODUCT SECTION -->
		<?php include("includes/front-woo-products.php"); ?>

		<!-- AWESOME PARALLAX SECTION -->
		<?php include("includes/front-parallax-section.php"); ?>

		<!-- TEAM-MEMBER SECTION -->
		<?php include("includes/front-teammember-box.php"); ?>

		<!-- CLIENTS-LOGO SECTION -->
		<?php include("includes/front-client-logo-section.php"); ?>
	<?php
	}
?>
<?php get_footer(); ?>