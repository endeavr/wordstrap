/**
 * All scripts for metaboxes.
 */

jQuery(document).ready(function($) {
	
	/*-----------------------------------------------------------------------------------*/
	/* Hi-jacked Page Attributes meta box
	/*-----------------------------------------------------------------------------------*/
	
	// Show the proper option on page load
	var page_atts = $('#wordstrap_pageparentdiv'),
		template = page_atts.find('select[name="page_template"]').val();
	
	if( template == 'template_builder.php' )
	{
		page_atts.find('select[name="_ws_sidebar_layout"]').hide().prev('p').hide();
	}
	else
	{
		page_atts.find('select[name="_ws_custom_layout"]').hide().prev('p').hide();
		page_atts.find('p.ws_custom_layout').hide().prev('p').hide();
	}
	
	// Show the proper option when user changes <select>
	page_atts.find('select[name="page_template"]').change(function(){
		var template = $(this).val();
		if( template == 'template_builder.php' )
		{
			page_atts.find('select[name="_ws_sidebar_layout"]').hide().prev('p').hide();
			page_atts.find('select[name="_ws_custom_layout"]').show().prev('p').show();
			page_atts.find('p.ws_custom_layout').show().prev('p').show();
		}
		else
		{
			page_atts.find('select[name="_ws_custom_layout"]').hide().prev('p').hide();
			page_atts.find('p.ws_custom_layout').hide().prev('p').hide();
			page_atts.find('select[name="_ws_sidebar_layout"]').show().prev('p').show();
		}
	});
	
	/*-----------------------------------------------------------------------------------*/
	/* Options Framework imports for meta boxes
	/*-----------------------------------------------------------------------------------*/
	
	// Image Options
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');		
	});
		
	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();
	
	/*-----------------------------------------------------------------------------------*/
	/* Edit Post Meta Box
	/*-----------------------------------------------------------------------------------*/
	
	// Setup featured image link
	var value;
	$('.ws-meta-box .ws-thumb-link').hide();
	$('.ws-meta-box .select-ws-thumb-link input:radio:checked').each(function() {
		value = $(this).val();
		$('.ws-meta-box .ws-thumb-link-'+value).show();
	});
	$('.ws-meta-box .select-ws-thumb-link input:radio').change(function(){
		value = $(this).val();
		$('.ws-meta-box .ws-thumb-link').hide();
		$('.ws-meta-box .ws-thumb-link-'+value).show();
	});
});