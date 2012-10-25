<?php

add_action('optionsframework_custom_scripts', 'optionsframework_option_colophon');
function optionsframework_option_colophon() { ?>

<script type="text/javascript">
	jQuery(document).ready(function($) { 
		
		// custom js for colophon options
		$('#ws_colophonoption').change(function() {
			switch($(this).val()) {
				case "auto":
			        	$('[id=section-ws_colophonpattern], [id=section-ws_colophonupload], [id=section-ws_colophonrepeat], [id=section-ws_colophonattach]' ).hide().addClass('hidden');
			        	$('[id=ws_colophonnote], [id=section-ws_colophonbackground], [id=section-ws_colophonbackgroundopacity]').show().removeClass('hidden');
				break;
				case "transparent":
			        	$('[id=section-ws_colophonbackground], [id=section-ws_colophonpatternsheer], [id=section-ws_colophonpatternopaque], [id=section-ws_colophonupload], [id=section-ws_colophonrepeat], [id=section-ws_colophonattach], [id=section-ws_colophonbackgroundopacity], [id=ws_colophonnote]' ).hide().addClass('hidden');
				break;			
				case "color":
					$('[id=section-ws_colophonpatternsheer], [id=section-ws_colophonpatternopaque], [id=section-ws_colophonupload], [id=section-ws_colophonrepeat], [id=section-ws_colophonattach], [id=ws_colophonnote]').hide().addClass('hidden');
					$('[id=section-ws_colophonbackground], [id=section-ws_colophonbackgroundopacity]').show().removeClass('hidden');
				break;
				case "gradient":
					$('[id=section-ws_colophonpatternsheer], [id=section-ws_colophonpatternopaque], [id=section-ws_colophonupload], [id=ws_colophonnote]').hide().addClass('hidden');
					$('[id=section-ws_colophonbackground], [id=section-ws_colophonrepeat], [id=section-ws_colophonattach], [id=section-ws_colophonbackgroundopacity]').show().removeClass('hidden');
				break;				
				case "patternsheer":
					$('[id=section-ws_colophonupload], [id=section-ws_colophonpatternopaque], [id=section-ws_colophonbackgroundopacity], [id=ws_colophonnote]').hide().addClass('hidden');
			        	$('[id=section-ws_colophonbackground], [id=section-ws_colophonpatternsheer], [id=section-ws_colophonrepeat], [id=section-ws_colophonattach]').show().removeClass('hidden');
				break;
				case "patternopaque":
					$('[id=section-ws_colophonbackground], [id=section-ws_colophonupload], [id=section-ws_colophonpatternsheer], [id=section-ws_colophonbackgroundopacity], [id=ws_colophonnote]').hide().addClass('hidden');
			        	$('[id=section-ws_colophonpatternopaque], [id=section-ws_colophonrepeat], [id=section-ws_colophonattach]').show().removeClass('hidden');
				break;				
				case "uploadsheer":
					$('[id=section-ws_colophonpatternsheer], [id=section-ws_colophonpatternopaque], [id=ws_colophonnote]').hide().addClass('hidden');
					$('[id=section-ws_colophonbackground], [id=section-ws_colophonupload], [id=section-ws_colophonrepeat], [id=section-ws_colophonattach], [id=section-ws_colophonbackgroundopacity]').show().removeClass('hidden');
				break;	
				case "uploadopaque":
					$('[id=section-ws_colophonbackground], [id=section-ws_colophonpatternsheer], [id=section-ws_colophonpatternopaque], [id=section-ws_colophonbackgroundopacity], [id=ws_colophonnote]').hide().addClass('hidden');				
					$('[id=section-ws_colophonupload], [id=section-ws_colophonrepeat], [id=section-ws_colophonattach]').show().removeClass('hidden');
				break;							
			}
		});
		
		// show and hide sections on page load based off of the currently selected colophon option 
		if ($('#ws_colophonoption').val() == "auto") {
			$('[id=section-ws_colophonpattern], [id=section-ws_colophonupload], [id=section-ws_colophonrepeat], [id=section-ws_colophonattach]' ).hide().addClass('hidden');
			$('[id=ws_colophonnote], [id=section-ws_colophonbackground], [id=section-ws_colophonbackgroundopacity]').show().removeClass('hidden');
		    };
		if ($('#ws_colophonoption').val() == "transparent") {
			$('[id=section-ws_colophonbackground],[id=section-ws_colophonpatternsheer], [id=section-ws_colophonpatternopaque], [id=section-ws_colophonupload], [id=section-ws_colophonrepeat], [id=section-ws_colophonattach], [id=section-ws_colophonbackgroundopacity], [id=ws_colophonnote]' ).hide().addClass('hidden');
		    }; 		
		if ($('#ws_colophonoption').val() == "color") {
		     $('[id=section-ws_colophonpatternsheer], [id=section-ws_colophonpatternopaque], [id=section-ws_colophonupload], [id=section-ws_colophonrepeat], [id=section-ws_colophonattach], [id=ws_colophonnote]').hide().addClass('hidden');
		     $('[id=section-ws_colophonbackground], [id=section-ws_colophonbackgroundopacity]').show().removeClass('hidden');
		    };
		if ($('#ws_colophonoption').val() == "gradient") {
		     $('[id=section-ws_colophonpatternsheer], [id=section-ws_colophonpatternopaque], [id=section-ws_colophonupload], [id=ws_colophonnote]').hide().addClass('hidden');
		     $('[id=section-ws_colophonbackground], [id=section-ws_colophonrepeat], [id=section-ws_colophonattach], [id=section-ws_colophonbackgroundopacity]').show().removeClass('hidden');
		    };		    
		if ($('#ws_colophonoption').val() == "patternsheer") {
			$('[id=section-ws_colophonupload], [id=section-ws_colophonpatternopaque], [id=ws_colophonnote]').hide().addClass('hidden');
			$('[id=section-ws_colophonbackground], [id=section-ws_colophonpatternsheer], [id=section-ws_colophonrepeat], [id=section-ws_colophonattach], [id=section-ws_colophonbackgroundopacity]').show().removeClass('hidden');
		    };
		if ($('#ws_colophonoption').val() == "patternopaque") {
			$('[id=section-ws_colophonbackground], [id=section-ws_colophonupload], [id=section-ws_colophonpatternsheer], [id=section-ws_colophonbackgroundopacity], [id=ws_colophonnote]').hide().addClass('hidden');
			$('[id=section-ws_colophonpatternopaque], [id=section-ws_colophonrepeat], [id=section-ws_colophonattach]').show().removeClass('hidden');
		    };		    
		if ($('#ws_colophonoption').val() == "uploadsheer") {
			$('[id=section-ws_colophonpatternsheer], [id=section-ws_colophonpatternopaque], [id=ws_colophonnote]').hide().addClass('hidden');
			$('[id=section-ws_colophonbackground], [id=section-ws_colophonupload], [id=section-ws_colophonrepeat], [id=section-ws_colophonattach], [id=section-ws_colophonbackgroundopacity]').show().removeClass('hidden');
		    }; 
		if ($('#ws_colophonoption').val() == "uploadopaque") {
		     $('[id=section-ws_colophonbackground], [id=section-ws_colophonpatternsheer], [id=section-ws_colophonpatternopaque], [id=section-ws_colophonbackgroundopacity], [id=ws_colophonnote]').hide().addClass('hidden');
			$('[id=section-ws_colophonupload], [id=section-ws_colophonrepeat], [id=section-ws_colophonattach]').show().removeClass('hidden');
		    }; 		        
			    
	});
</script>		    

<?php
}