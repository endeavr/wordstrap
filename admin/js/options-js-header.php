<?php

add_action('optionsframework_custom_scripts', 'optionsframework_option_header');
function optionsframework_option_header() { ?>

<script type="text/javascript">
	jQuery(document).ready(function($) { 
		
		// custom js for header options
		$('#ws_headeroption').change(function() {
			switch($(this).val()) {
				case "transparent":
			        	$('[id=section-ws_headerbackground], [id=section-ws_headerpatternsheer], [id=section-ws_headerpatternopaque], [id=section-ws_headerupload], [id=section-ws_headerrepeat], [id=section-ws_headerattach]' ).hide().addClass('hidden');
				break;			
				case "color":
					$('[id=section-ws_headerpatternsheer], [id=section-ws_headerpatternopaque], [id=section-ws_headerupload], [id=section-ws_headerrepeat], [id=section-ws_headerattach]').hide().addClass('hidden');
					$('[id=section-ws_headerbackground]').show().removeClass('hidden');
				break;
				case "gradient":
					$('[id=section-ws_headerpatternsheer], [id=section-ws_headerpatternopaque], [id=section-ws_headerupload]').hide().addClass('hidden');
					$('[id=section-ws_headerbackground], [id=section-ws_headerrepeat], [id=section-ws_headerattach]').show().removeClass('hidden');
				break;				
				case "patternsheer":
					$('[id=section-ws_headerupload], [id=section-ws_headerpatternopaque]').hide().addClass('hidden');
			        	$('[id=section-ws_headerbackground], [id=section-ws_headerpatternsheer], [id=section-ws_headerrepeat], [id=section-ws_headerattach]').show().removeClass('hidden');
				break;
				case "patternopaque":
					$('[id=section-ws_headerbackground], [id=section-ws_headerupload], [id=section-ws_headerpatternsheer]').hide().addClass('hidden');
			        	$('[id=section-ws_headerpatternopaque], [id=section-ws_headerrepeat], [id=section-ws_headerattach]').show().removeClass('hidden');
				break;				
				case "uploadsheer":
					$('[id=section-ws_headerpatternsheer], [id=section-ws_headerpatternopaque],').hide().addClass('hidden');
					$('[id=section-ws_headerbackground], [id=section-ws_headerupload], [id=section-ws_headerrepeat], [id=section-ws_headerattach]').show().removeClass('hidden');
				break;	
				case "uploadopaque":
					$('[id=section-ws_headerbackground], [id=section-ws_headerpatternsheer], [id=section-ws_headerpatternopaque],').hide().addClass('hidden');				
					$('[id=section-ws_headerupload], [id=section-ws_headerrepeat], [id=section-ws_headerattach]').show().removeClass('hidden');
				break;							
			}
		});
		
		// show and hide sections on page load based off of the currently selected header option 
		if ($('#ws_headeroption').val() == "transparent") {
			$('[id=section-ws_headerbackground],[id=section-ws_headerpatternsheer], [id=section-ws_headerpatternopaque], [id=section-ws_headerupload], [id=section-ws_headerrepeat], [id=section-ws_headerattach]' ).hide().addClass('hidden');
		    }; 		
		if ($('#ws_headeroption').val() == "color") {
		     $('[id=section-ws_headerpatternsheer], [id=section-ws_headerpatternopaque], [id=section-ws_headerupload], [id=section-ws_headerrepeat], [id=section-ws_headerattach]').hide().addClass('hidden');
		     $('[id=section-ws_headerbackground]').show().removeClass('hidden');
		    };
		if ($('#ws_headeroption').val() == "gradient") {
		     $('[id=section-ws_headerpatternsheer], [id=section-ws_headerpatternopaque], [id=section-ws_headerupload]').hide().addClass('hidden');
		     $('[id=section-ws_headerbackground], [id=section-ws_headerrepeat], [id=section-ws_headerattach]').show().removeClass('hidden');
		    };		    
		if ($('#ws_headeroption').val() == "patternsheer") {
			$('[id=section-ws_headerupload], [id=section-ws_headerpatternopaque]').hide().addClass('hidden');
			$('[id=section-ws_headerbackground], [id=section-ws_headerpatternsheer], [id=section-ws_headerrepeat], [id=section-ws_headerattach]').show().removeClass('hidden');
		    };
		if ($('#ws_headeroption').val() == "patternopaque") {
			$('[id=section-ws_headerbackground], [id=section-ws_headerupload], [id=section-ws_headerpatternsheer]').hide().addClass('hidden');
			$('[id=section-ws_headerpatternopaque], [id=section-ws_headerrepeat], [id=section-ws_headerattach]').show().removeClass('hidden');
		    };		    
		if ($('#ws_headeroption').val() == "uploadsheer") {
			$('[id=section-ws_headerpatternsheer], [id=section-ws_headerpatternopaque]').hide().addClass('hidden');
			$('[id=section-ws_headerbackground], [id=section-ws_headerupload], [id=section-ws_headerrepeat], [id=section-ws_headerattach]').show().removeClass('hidden');
		    }; 
		if ($('#ws_headeroption').val() == "uploadopaque") {
		     $('[id=section-ws_headerbackground], [id=section-ws_headerpatternsheer], [id=section-ws_headerpatternopaque]').hide().addClass('hidden');
			$('[id=section-ws_headerupload], [id=section-ws_headerrepeat], [id=section-ws_headerattach]').show().removeClass('hidden');
		    }; 		        
			    
	});
</script>		    

<?php
}