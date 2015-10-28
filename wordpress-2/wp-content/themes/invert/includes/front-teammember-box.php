<?php  
$teammembermeta  = get_post_meta( $post->ID,'_skt_teammember_metabox',true );
$teammember_call = get_post_meta( $post->ID,'_skt_teammember_call',true );

if($teammember_call === 'specific') {
	$teammember_sel1 = get_post_meta( $post->ID,'_skt_teammember_sel1',true );
	$teammember_sel2 = get_post_meta( $post->ID,'_skt_teammember_sel2',true );
	$teammember_sel3 = get_post_meta( $post->ID,'_skt_teammember_sel3',true );
	$team_members =  array($teammember_sel1, $teammember_sel2, $teammember_sel3);
}

if($teammembermeta == '1'){ ?>
<div id="team-division-box" class="skt-section">  
	<div class="team-division container">    
		<div class="team_custom_title title_center"> 	 
			<?php if(sketch_get_option($invert_shortname.'_teammember_title')) { ?><h3><?php echo sketch_get_option($invert_shortname.'_teammember_title'); ?></h3><span class="border_center"> </span><?php } ?>
			<p><?php if(sketch_get_option($invert_shortname.'_teamsub_title')) { echo sketch_get_option($invert_shortname.'_teamsub_title'); } ?></p> 
		</div>
		
        <div class="team-box row-fluid"> 
			<?php $count=1;?>		
			<?php 	
				if($teammember_call === 'specific') {
					$the_query = new WP_Query( array( 'post_type' => 'team_member', 'posts_per_page' => '3','orderby' => 'post__in', 'post__in' => $team_members ) );
				}else{
					$the_query = new WP_Query( 'post_type=team_member&posts_per_page=3');	
				}	

				if($the_query->have_posts()) : 		
				while ( $the_query->have_posts() ) : $the_query->the_post();		
					$id   = get_the_ID();			
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

            <!--team-container-->    
            <div  class="team-box-mid span4 fade_in_hide element_fade_in <?php if($count%3==0){?>no-margin<?php }?>">        
				<div class="teammember">			
					<a href="javascript:void(0);"><img alt="team" src="<?php echo $avatar; ?>" class="teammember_img"></a>		
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
						<?php if( $skype_url) { ?><li><a href="skype:<?php echo $skype_url; ?>?call" ><i class="fa fa-skype"></i></a></li>	<?php } ?>						
				    </ul>
				</div>      
            </div>	
			<?php $count++;?>
			<?php 
				endwhile;
				wp_reset_query();
				endif;
			?>       
            <div class="clear"></div>   
        </div> 
	</div>
</div>
<?php } ?> 	
