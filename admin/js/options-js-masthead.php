<?php

add_action('optionsframework_custom_scripts', 'optionsframework_option_mast');
function optionsframework_option_mast() { ?>

<script type="text/javascript">
	jQuery(document).ready(function($) { 
		
		// custom js for mast options
		$('#ws_mastoption').change(function() {
			switch($(this).val()) {
				case "transparent":
			        	$('[id=section-ws_mastbackground], [id=section-ws_mastpatternsheer], [id=section-ws_mastpatternopaque], [id=section-ws_mastupload], [id=section-ws_mastrepeat], [id=section-ws_mastattach]' ).hide().addClass('hidden');
				break;			
				case "color":
					$('[id=section-ws_mastpatternsheer], [id=section-ws_mastpatternopaque], [id=section-ws_mastupload], [id=section-ws_mastrepeat], [id=section-ws_mastattach]').hide().addClass('hidden');
					$('[id=section-ws_mastbackground]').show().removeClass('hidden');
				break;
				case "gradient":
					$('[id=section-ws_mastpatternsheer], [id=section-ws_mastpatternopaque], [id=section-ws_mastupload]').hide().addClass('hidden');
					$('[id=section-ws_mastbackground], [id=section-ws_mastrepeat], [id=section-ws_mastattach]').show().removeClass('hidden');
				break;				
				case "patternsheer":
					$('[id=section-ws_mastupload], [id=section-ws_mastpatternopaque]').hide().addClass('hidden');
			        	$('[id=section-ws_mastbackground], [id=section-ws_mastpatternsheer], [id=section-ws_mastrepeat], [id=section-ws_mastattach]').show().removeClass('hidden');
				break;
				case "patternopaque":
					$('[id=section-ws_mastbackground], [id=section-ws_mastupload], [id=section-ws_mastpatternsheer]').hide().addClass('hidden');
			        	$('[id=section-ws_mastpatternopaque], [id=section-ws_mastrepeat], [id=section-ws_mastattach]').show().removeClass('hidden');
				break;				
				case "uploadsheer":
					$('[id=section-ws_mastpatternsheer], [id=section-ws_mastpatternopaque],').hide().addClass('hidden');
					$('[id=section-ws_mastbackground], [id=section-ws_mastupload], [id=section-ws_mastrepeat], [id=section-ws_mastattach]').show().removeClass('hidden');
				break;	
				case "uploadopaque":
					$('[id=section-ws_mastbackground], [id=section-ws_mastpatternsheer], [id=section-ws_mastpatternopaque],').hide().addClass('hidden');				
					$('[id=section-ws_mastupload], [id=section-ws_mastrepeat], [id=section-ws_mastattach]').show().removeClass('hidden');
				break;							
			}
		});
		
		// show and hide sections on page load based off of the currently selected mast option 
		if ($('#ws_mastoption').val() == "transparent") {
			$('[id=section-ws_mastbackground],[id=section-ws_mastpatternsheer], [id=section-ws_mastpatternopaque], [id=section-ws_mastupload], [id=section-ws_mastrepeat], [id=section-ws_mastattach]' ).hide().addClass('hidden');
		    }; 		
		if ($('#ws_mastoption').val() == "color") {
		     $('[id=section-ws_mastpatternsheer], [id=section-ws_mastpatternopaque], [id=section-ws_mastupload], [id=section-ws_mastrepeat], [id=section-ws_mastattach]').hide().addClass('hidden');
		     $('[id=section-ws_mastbackground]').show().removeClass('hidden');
		    };
		if ($('#ws_mastoption').val() == "gradient") {
		     $('[id=section-ws_mastpatternsheer], [id=section-ws_mastpatternopaque], [id=section-ws_mastupload]').hide().addClass('hidden');
		     $('[id=section-ws_mastbackground], [id=section-ws_mastrepeat], [id=section-ws_mastattach]').show().removeClass('hidden');
		    };		    
		if ($('#ws_mastoption').val() == "patternsheer") {
			$('[id=section-ws_mastupload], [id=section-ws_mastpatternopaque]').hide().addClass('hidden');
			$('[id=section-ws_mastbackground], [id=section-ws_mastpatternsheer], [id=section-ws_mastrepeat], [id=section-ws_mastattach]').show().removeClass('hidden');
		    };
		if ($('#ws_mastoption').val() == "patternopaque") {
			$('[id=section-ws_mastbackground], [id=section-ws_mastupload], [id=section-ws_mastpatternsheer]').hide().addClass('hidden');
			$('[id=section-ws_mastpatternopaque], [id=section-ws_mastrepeat], [id=section-ws_mastattach]').show().removeClass('hidden');
		    };		    
		if ($('#ws_mastoption').val() == "uploadsheer") {
			$('[id=section-ws_mastpatternsheer], [id=section-ws_mastpatternopaque]').hide().addClass('hidden');
			$('[id=section-ws_mastbackground], [id=section-ws_mastupload], [id=section-ws_mastrepeat], [id=section-ws_mastattach]').show().removeClass('hidden');
		    }; 
		if ($('#ws_mastoption').val() == "uploadopaque") {
		     $('[id=section-ws_mastbackground], [id=section-ws_mastpatternsheer], [id=section-ws_mastpatternopaque]').hide().addClass('hidden');
			$('[id=section-ws_mastupload], [id=section-ws_mastrepeat], [id=section-ws_mastattach]').show().removeClass('hidden');
		    }; 		        
			    
	});
</script>		    

<?php
}