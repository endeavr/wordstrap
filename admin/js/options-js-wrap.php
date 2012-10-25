<?php

add_action('optionsframework_custom_scripts', 'optionsframework_option_wrap');
function optionsframework_option_wrap() { ?>

<script type="text/javascript">
	jQuery(document).ready(function($) { 
		
		// custom js for wrap options
		$('#ws_wrapoption').change(function() {
			switch($(this).val()) {
				case "transparent":
			        	$('[id=section-ws_wrapbackground], [id=section-ws_wrappatternsheer], [id=section-ws_wrappatternopaque], [id=section-ws_wrapupload], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]' ).hide().addClass('hidden');
				break;			
				case "color":
					$('[id=section-ws_wrappatternsheer], [id=section-ws_wrappatternopaque], [id=section-ws_wrapupload], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]').hide().addClass('hidden');
					$('[id=section-ws_wrapbackground]').show().removeClass('hidden');
				break;
				case "gradient":
					$('[id=section-ws_wrappatternsheer], [id=section-ws_wrappatternopaque], [id=section-ws_wrapupload]').hide().addClass('hidden');
					$('[id=section-ws_wrapbackground], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]').show().removeClass('hidden');
				break;				
				case "patternsheer":
					$('[id=section-ws_wrapupload], [id=section-ws_wrappatternopaque]').hide().addClass('hidden');
			        	$('[id=section-ws_wrapbackground], [id=section-ws_wrappatternsheer], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]').show().removeClass('hidden');
				break;
				case "patternopaque":
					$('[id=section-ws_wrapbackground], [id=section-ws_wrapupload], [id=section-ws_wrappatternsheer]').hide().addClass('hidden');
			        	$('[id=section-ws_wrappatternopaque], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]').show().removeClass('hidden');
				break;				
				case "uploadsheer":
					$('[id=section-ws_wrappatternsheer], [id=section-ws_wrappatternopaque],').hide().addClass('hidden');
					$('[id=section-ws_wrapbackground], [id=section-ws_wrapupload], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]').show().removeClass('hidden');
				break;	
				case "uploadopaque":
					$('[id=section-ws_wrapbackground], [id=section-ws_wrappatternsheer], [id=section-ws_wrappatternopaque],').hide().addClass('hidden');				
					$('[id=section-ws_wrapupload], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]').show().removeClass('hidden');
				break;							
			}
		});
		
		// show and hide sections on page load based off of the currently selected wrap option 
		if ($('#ws_wrapoption').val() == "transparent") {
			$('[id=section-ws_wrapbackground],[id=section-ws_wrappatternsheer], [id=section-ws_wrappatternopaque], [id=section-ws_wrapupload], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]' ).hide().addClass('hidden');
		    }; 		
		if ($('#ws_wrapoption').val() == "color") {
		     $('[id=section-ws_wrappatternsheer], [id=section-ws_wrappatternopaque], [id=section-ws_wrapupload], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]').hide().addClass('hidden');
		     $('[id=section-ws_wrapbackground]').show().removeClass('hidden');
		    };
		if ($('#ws_wrapoption').val() == "gradient") {
		     $('[id=section-ws_wrappatternsheer], [id=section-ws_wrappatternopaque], [id=section-ws_wrapupload]').hide().addClass('hidden');
		     $('[id=section-ws_wrapbackground], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]').show().removeClass('hidden');
		    };		    
		if ($('#ws_wrapoption').val() == "patternsheer") {
			$('[id=section-ws_wrapupload], [id=section-ws_wrappatternopaque]').hide().addClass('hidden');
			$('[id=section-ws_wrapbackground], [id=section-ws_wrappatternsheer], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]').show().removeClass('hidden');
		    };
		if ($('#ws_wrapoption').val() == "patternopaque") {
			$('[id=section-ws_wrapbackground], [id=section-ws_wrapupload], [id=section-ws_wrappatternsheer]').hide().addClass('hidden');
			$('[id=section-ws_wrappatternopaque], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]').show().removeClass('hidden');
		    };		    
		if ($('#ws_wrapoption').val() == "uploadsheer") {
			$('[id=section-ws_wrappatternsheer], [id=section-ws_wrappatternopaque]').hide().addClass('hidden');
			$('[id=section-ws_wrapbackground], [id=section-ws_wrapupload], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]').show().removeClass('hidden');
		    }; 
		if ($('#ws_wrapoption').val() == "uploadopaque") {
		     $('[id=section-ws_wrapbackground], [id=section-ws_wrappatternsheer], [id=section-ws_wrappatternopaque]').hide().addClass('hidden');
			$('[id=section-ws_wrapupload], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]').show().removeClass('hidden');
		    }; 		        
			    
	});
</script>		    

<?php
}