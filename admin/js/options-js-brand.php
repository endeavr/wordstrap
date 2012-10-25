<?php

add_action('optionsframework_custom_scripts', 'optionsframework_option_brand');
function optionsframework_option_brand() { ?>

	<script type="text/javascript">
		jQuery(document).ready(function($) { 
			
			// custom js for navbar brand options
			$('#ws_brand').change(function() {
				switch($(this).val()) {
					case "one":
						$('[id=section-ws_brand_font_text], [id=section-ws_brand_font_type]').show().removeClass('hidden');
				        	$('[id=section-ws_brand_mark], [id=section-ws_brand_logo]').hide().addClass('hidden');
					break;
					case "two":
						$('[id=section-ws_brand_logo]').hide().addClass('hidden');
						$('[id=section-ws_brand_font_text], [id=section-ws_brand_font_type], [id=section-ws_brand_mark]').show().removeClass('hidden');
					break;
					case "three":
						$('[id=section-ws_brand_font_text], [id=section-ws_brand_font_type], [id=section-ws_brand_mark]').hide().addClass('hidden');
				        	$('[id=section-ws_brand_logo]').show().removeClass('hidden');
					break;
					case "four":
						$('[id=section-ws_brand_font_text], [id=section-ws_brand_font_type], [id=section-ws_brand_mark], [id=section-ws_brand_logo]').hide().addClass('hidden');
				        	$('').show().removeClass('hidden');
					break;
					case "five":
						$('[id=section-ws_brand_font_text], [id=section-ws_brand_font_type], [id=section-ws_brand_mark], [id=section-ws_brand_logo]').hide().addClass('hidden');
				        	$('').show().removeClass('hidden');
					break;									
				}
			});
			
			// show and hide sections on page load based off of the currently selected navbar brand option 
			if ($('#ws_brand').val() == "one") {
				$('[id=section-ws_brand_font_text], [id=section-ws_brand_font_type]').show().removeClass('hidden');
				$('[id=section-ws_brand_mark], [id=section-ws_brand_logo]').hide().addClass('hidden');
			    }; 
			if ($('#ws_brand').val() == "two") {
			     $('[id=section-ws_brand_mark], [id=section-ws_brand_font_text], [id=section-ws_brand_font_type]').show().removeClass('hidden');
			     $('[id=section-ws_brand_logo]').hide().addClass('hidden');
			    };
			if ($('#ws_brand').val() == "three") {
			     $('[id=section-ws_brand_logo]').show().removeClass('hidden');
			     $('[id=section-ws_brand_font_text], [id=section-ws_brand_font_type], [id=section-ws_brand_mark]').hide().addClass('hidden');
			    }; 
			if ($('#ws_brand').val() == "four") {
			     $('').show().removeClass('hidden');
			     $('[id=section-ws_brand_font_text], [id=section-ws_brand_font_type], [id=section-ws_brand_mark], [id=section-ws_brand_logo]').hide().addClass('hidden');
			    };    
			if ($('#ws_brand').val() == "five") {
			     $('').show().removeClass('hidden');
			     $('[id=section-ws_brand_font_text], [id=section-ws_brand_font_type], [id=section-ws_brand_mark], [id=section-ws_brand_logo]').hide().addClass('hidden');
			    };      
				    
		});
	</script>		    

<?php
}