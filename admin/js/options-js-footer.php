<?php

add_action('optionsframework_custom_scripts', 'optionsframework_option_footer');
function optionsframework_option_footer() { ?>

<script type="text/javascript">
	jQuery(document).ready(function($) { 
		
		// custom js for footer options
		$('#ws_footeroption').change(function() {
			switch($(this).val()) {
				case "transparent":
			        	$('[id=section-ws_footerbackground], [id=section-ws_footerpatternsheer], [id=section-ws_footerpatternopaque], [id=section-ws_footerupload], [id=section-ws_footerrepeat], [id=section-ws_footerattach]' ).hide().addClass('hidden');
				break;			
				case "color":
					$('[id=section-ws_footerpatternsheer], [id=section-ws_footerpatternopaque], [id=section-ws_footerupload], [id=section-ws_footerrepeat], [id=section-ws_footerattach]').hide().addClass('hidden');
					$('[id=section-ws_footerbackground]').show().removeClass('hidden');
				break;
				case "gradient":
					$('[id=section-ws_footerpatternsheer], [id=section-ws_footerpatternopaque], [id=section-ws_footerupload]').hide().addClass('hidden');
					$('[id=section-ws_footerbackground], [id=section-ws_footerrepeat], [id=section-ws_footerattach]').show().removeClass('hidden');
				break;				
				case "patternsheer":
					$('[id=section-ws_footerupload], [id=section-ws_footerpatternopaque]').hide().addClass('hidden');
			        	$('[id=section-ws_footerbackground], [id=section-ws_footerpatternsheer], [id=section-ws_footerrepeat], [id=section-ws_footerattach]').show().removeClass('hidden');
				break;
				case "patternopaque":
					$('[id=section-ws_footerbackground], [id=section-ws_footerupload], [id=section-ws_footerpatternsheer]').hide().addClass('hidden');
			        	$('[id=section-ws_footerpatternopaque], [id=section-ws_footerrepeat], [id=section-ws_footerattach]').show().removeClass('hidden');
				break;				
				case "uploadsheer":
					$('[id=section-ws_footerpatternsheer], [id=section-ws_footerpatternopaque],').hide().addClass('hidden');
					$('[id=section-ws_footerbackground], [id=section-ws_footerupload], [id=section-ws_footerrepeat], [id=section-ws_footerattach]').show().removeClass('hidden');
				break;	
				case "uploadopaque":
					$('[id=section-ws_footerbackground], [id=section-ws_footerpatternsheer], [id=section-ws_footerpatternopaque],').hide().addClass('hidden');				
					$('[id=section-ws_footerupload], [id=section-ws_footerrepeat], [id=section-ws_footerattach]').show().removeClass('hidden');
				break;							
			}
		});
		
		// show and hide sections on page load based off of the currently selected footer option 
		if ($('#ws_footeroption').val() == "transparent") {
			$('[id=section-ws_footerbackground],[id=section-ws_footerpatternsheer], [id=section-ws_footerpatternopaque], [id=section-ws_footerupload], [id=section-ws_footerrepeat], [id=section-ws_footerattach]' ).hide().addClass('hidden');
		    }; 		
		if ($('#ws_footeroption').val() == "color") {
		     $('[id=section-ws_footerpatternsheer], [id=section-ws_footerpatternopaque], [id=section-ws_footerupload], [id=section-ws_footerrepeat], [id=section-ws_footerattach]').hide().addClass('hidden');
		     $('[id=section-ws_footerbackground]').show().removeClass('hidden');
		    };
		if ($('#ws_footeroption').val() == "gradient") {
		     $('[id=section-ws_footerpatternsheer], [id=section-ws_footerpatternopaque], [id=section-ws_footerupload]').hide().addClass('hidden');
		     $('[id=section-ws_footerbackground], [id=section-ws_footerrepeat], [id=section-ws_footerattach]').show().removeClass('hidden');
		    };		    
		if ($('#ws_footeroption').val() == "patternsheer") {
			$('[id=section-ws_footerupload], [id=section-ws_footerpatternopaque]').hide().addClass('hidden');
			$('[id=section-ws_footerbackground], [id=section-ws_footerpatternsheer], [id=section-ws_footerrepeat], [id=section-ws_footerattach]').show().removeClass('hidden');
		    };
		if ($('#ws_footeroption').val() == "patternopaque") {
			$('[id=section-ws_footerbackground], [id=section-ws_footerupload], [id=section-ws_footerpatternsheer]').hide().addClass('hidden');
			$('[id=section-ws_footerpatternopaque], [id=section-ws_footerrepeat], [id=section-ws_footerattach]').show().removeClass('hidden');
		    };		    
		if ($('#ws_footeroption').val() == "uploadsheer") {
			$('[id=section-ws_footerpatternsheer], [id=section-ws_footerpatternopaque]').hide().addClass('hidden');
			$('[id=section-ws_footerbackground], [id=section-ws_footerupload], [id=section-ws_footerrepeat], [id=section-ws_footerattach]').show().removeClass('hidden');
		    }; 
		if ($('#ws_footeroption').val() == "uploadopaque") {
		     $('[id=section-ws_footerbackground], [id=section-ws_footerpatternsheer], [id=section-ws_footerpatternopaque]').hide().addClass('hidden');
			$('[id=section-ws_footerupload], [id=section-ws_footerrepeat], [id=section-ws_footerattach]').show().removeClass('hidden');
		    }; 		        
			    
	});
</script>		    

<?php
}