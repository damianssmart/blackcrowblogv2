<?php
/**
* The template for displaying the footer.
*
* Contains footer content and the closing of the
* #main and #page div elements.
*
*/
global $tweetfeedmeta,$invert_shortname;
?>

<?php  
if($tweetfeedmeta == '1'){ ?>
<!-- full-twitter-box -->
<div id="full-twitter-box">
	<div class="container">
		<div class="row-fluid">
			<?php  get_template_part('section','twitter-panel'); ?>
		</div>
	</div>
</div>
<?php } ?>
	<div class="clearfix"></div>
</div>
<!-- #main --> 

<!-- #footer -->
<div id="footer" class="<?php if($tweetfeedmeta !="1"){ echo "foot-skt-section"; } ?>" >
	<div class="container">
		<div class="row-fluid">
			<div class="second_wrapper">
				<?php dynamic_sidebar( 'Footer Sidebar' ); ?>
				<div class="clearfix"></div>
			</div><!-- second_wrapper -->
		</div>
	</div>

	<div class="third_wrapper">
		<div class="container">
			<div class="row-fluid">
				<?php $sktURL = 'http://www.sketchthemes.com/'; ?>
				<div class="copyright span6 alpha omega"> <?php echo stripslashes(sketch_get_option($invert_shortname."_copyright")); ?> </div>
				<div class="owner span6 alpha omega"><?php _e('black crows','invert'); ?> <a href="<?php echo $sktURL; ?>" title="Sketch Themes"><?php _e('','invert'); ?></a></div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div><!-- third_wrapper --> 
</div>
<!-- #footer -->

</div>
<!-- #wrapper -->
	<a href="JavaScript:void(0);" title="Back To Top" id="backtop"></a>
	<?php wp_footer(); ?>
	<?php // [[[[[[[[[[[[  google analytics 
	if(sketch_get_option($invert_shortname."_analytics"))
	{ 	
		echo stripslashes(sketch_get_option($invert_shortname."_analytics"));
	 }
	// google analytics ]]]]]]]]]]]]]]]]]]] ?>
	
</body>
</html>