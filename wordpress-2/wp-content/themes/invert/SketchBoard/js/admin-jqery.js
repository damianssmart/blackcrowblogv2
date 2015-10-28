/*-- Upload image jquery start 
--------------------------------------------*/
jQuery(document).ready( function() {
	var targetfield= '.upload_meta_image';
	var fwb_send_to_editor = window.send_to_editor;
	jQuery('.upload_image_button').click(function(){
		targetfield = jQuery(this).prev('.upload_meta_image');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery(targetfield).val(imgurl);
			tb_remove();
			window.send_to_editor = fwb_send_to_editor;
		}
		return false;
	});	
});
/*-------------------------------------------*/

jQuery(document).ready(function ($) {
//Show/hide metabox, depending on element value
    jQuery(document).ready(function(){
        toggleMetaboxOnFormat("quote-metabox", 'quote');
        toggleMetaboxOnFormat("video-metabox", 'video');
        toggleMetaboxOnFormat("gallery-metabox", 'gallery');
        togglesectionboxOnFormat("frontpagesection-metabox", 'template-front-page.php');


        jQuery("input[name=post_format]").on("change",function() {
            toggleMetaboxOnFormat("quote-metabox", 'quote');
            toggleMetaboxOnFormat("video-metabox", 'video');
            toggleMetaboxOnFormat("gallery-metabox", 'gallery');
        });
		
		jQuery("#page_template").on("change",function() {
			togglesectionboxOnFormat("frontpagesection-metabox", 'template-front-page.php');
        });
		 

    });

    function toggleMetaboxOnFormat(metaboxId, value) {
        var format = jQuery("input[name=post_format]:checked").val();
       
        if(format != value ){
            jQuery("#" + metaboxId).slideUp("fast");}
        else{
            jQuery("#" + metaboxId).slideDown("fast");}

    }
	
	function togglesectionboxOnFormat(metaboxId, value) {
		var title = jQuery("#page_template").val();
		if(title != value ) {
            jQuery("#" + metaboxId).slideUp("fast"); 
			jQuery('#pagetitle-metabox').show();
		}
        else { 
            jQuery("#" + metaboxId).slideDown("fast"); 
			jQuery('#pagetitle-metabox').hide();
		}
		if(title === "template-front-page.php" ){
			jQuery("#skt-fpage-sections-order-metaboxes").slideDown("fast"); 
		}else{
			jQuery("#skt-fpage-sections-order-metaboxes").slideUp("fast"); 
		}

    }

});

jQuery(document).ready(function($){
	jQuery(".skt-slider-set .skt_allslider_metabox").click(function(){
		var allslider_inner = $(this).attr('rel');
		jQuery('.allslider-inner').hide();
		jQuery('#'+allslider_inner).fadeIn();
	});		jQuery(".skt_statics_metabox").click(function(){		var allstatics_inner = $(this).attr('rel');		jQuery('.skt-statics-inner').hide();		jQuery('#'+allstatics_inner).fadeIn();	});
	
	if (jQuery('#frontpagesection-metabox #skt_teammember_metabox1').is(':checked') && jQuery('#frontpagesection-metabox #skt_teammember_metabox1').val() === '1') {
		jQuery('#frontpagesection-metabox table .team_member_items').show();
	}
	
	jQuery("#frontpagesection-metabox  .skt_teammember_metabox").click(function(){
		var skt_teamchk = $(this).attr('value');
		if(skt_teamchk === '0') {
			jQuery('#frontpagesection-metabox .team_member_items, #frontpagesection-metabox .team_member_selections').hide();
			jQuery("#skt_teammember_call1").prop("checked", true)
			
		}else if(skt_teamchk === '1') {
			jQuery('#frontpagesection-metabox .team_member_items').show();
		}
	});
	jQuery(".team_member_items .skt_teammember_call").click(function(){
		var teammember_call_inner = $(this).attr('rel');
		jQuery('.team_member_selections').hide();
		jQuery('#'+teammember_call_inner).fadeIn();
	});
});

jQuery(document).ready(function() 
{
	if(jQuery('#skt-frontpage-sections').length > 0){
		jQuery("#skt-frontpage-sections").sortable({placeholder: "ui-state-highlight"});
	}
});