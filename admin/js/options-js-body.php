<?php

add_action('optionsframework_custom_scripts', 'optionsframework_option_body');
function optionsframework_option_body() { ?>

<script type="text/javascript">
	jQuery(document).ready(function($) { 
		
		// custom js for body options
		$('#ws_bodyoption').change(function() {
			switch($(this).val()) {
				case "color":
					$('[id=section-ws_bodypatternsheer], [id=section-ws_bodypatternopaque], [id=section-ws_bodyupload], [id=section-ws_bodyrepeat], [id=section-ws_bodyattach]').hide().addClass('hidden');
					$('[id=section-ws_bodybackground]').show().removeClass('hidden');
				break;
				case "gradient":
					$('[id=section-ws_bodypatternsheer], [id=section-ws_bodypatternopaque], [id=section-ws_bodyupload]').hide().addClass('hidden');
					$('[id=section-ws_bodybackground], [id=section-ws_bodyrepeat], [id=section-ws_bodyattach]').show().removeClass('hidden');
				break;				
				case "patternsheer":
					$('[id=section-ws_bodyupload], [id=section-ws_bodypatternopaque]').hide().addClass('hidden');
			        	$('[id=section-ws_bodybackground], [id=section-ws_bodypatternsheer], [id=section-ws_bodyrepeat], [id=section-ws_bodyattach]').show().removeClass('hidden');
				break;
				case "patternopaque":
					$('[id=section-ws_bodybackground], [id=section-ws_bodyupload], [id=section-ws_bodypatternsheer]').hide().addClass('hidden');
			        	$('[id=section-ws_bodypatternopaque], [id=section-ws_bodyrepeat], [id=section-ws_bodyattach]').show().removeClass('hidden');
				break;				
				case "uploadsheer":
					$('[id=section-ws_bodypatternsheer], [id=section-ws_bodypatternopaque],').hide().addClass('hidden');
					$('[id=section-ws_bodybackground], [id=section-ws_bodyupload], [id=section-ws_bodyrepeat], [id=section-ws_bodyattach]').show().removeClass('hidden');
				break;	
				case "uploadopaque":
					$('[id=section-ws_bodybackground], [id=section-ws_bodypatternsheer], [id=section-ws_bodypatternopaque],').hide().addClass('hidden');				
					$('[id=section-ws_bodyupload], [id=section-ws_bodyrepeat], [id=section-ws_bodyattach]').show().removeClass('hidden');
				break;							
			}
		});
		
		// show and hide sections on page load based off of the currently selected body option 
		if ($('#ws_bodyoption').val() == "color") {
		     $('[id=section-ws_bodypatternsheer], [id=section-ws_bodypatternopaque], [id=section-ws_bodyupload], [id=section-ws_bodyrepeat], [id=section-ws_bodyattach]').hide().addClass('hidden');
		     $('[id=section-ws_bodybackground]').show().removeClass('hidden');
		    };
		if ($('#ws_bodyoption').val() == "gradient") {
		     $('[id=section-ws_bodypatternsheer], [id=section-ws_bodypatternopaque], [id=section-ws_bodyupload]').hide().addClass('hidden');
		     $('[id=section-ws_bodybackground], [id=section-ws_bodyrepeat], [id=section-ws_bodyattach]').show().removeClass('hidden');
		    };		    
		if ($('#ws_bodyoption').val() == "patternsheer") {
			$('[id=section-ws_bodyupload], [id=section-ws_bodypatternopaque]').hide().addClass('hidden');
			$('[id=section-ws_bodybackground], [id=section-ws_bodypatternsheer], [id=section-ws_bodyrepeat], [id=section-ws_bodyattach]').show().removeClass('hidden');
		    };
		if ($('#ws_bodyoption').val() == "patternopaque") {
			$('[id=section-ws_bodybackground], [id=section-ws_bodyupload], [id=section-ws_bodypatternsheer]').hide().addClass('hidden');
			$('[id=section-ws_bodypatternopaque], [id=section-ws_bodyrepeat], [id=section-ws_bodyattach]').show().removeClass('hidden');
		    };		    
		if ($('#ws_bodyoption').val() == "uploadsheer") {
			$('[id=section-ws_bodypatternsheer], [id=section-ws_bodypatternopaque]').hide().addClass('hidden');
			$('[id=section-ws_bodybackground], [id=section-ws_bodyupload], [id=section-ws_bodyrepeat], [id=section-ws_bodyattach]').show().removeClass('hidden');
		    }; 
		if ($('#ws_bodyoption').val() == "uploadopaque") {
		     $('[id=section-ws_bodybackground], [id=section-ws_bodypatternsheer], [id=section-ws_bodypatternopaque]').hide().addClass('hidden');
			$('[id=section-ws_bodyupload], [id=section-ws_bodyrepeat], [id=section-ws_bodyattach]').show().removeClass('hidden');
		    }; 		        
			    
	});
</script>		    

<?php
}