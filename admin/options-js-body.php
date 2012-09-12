<?php

add_action('optionsframework_custom_scripts', 'optionsframework_option_body');
function optionsframework_option_body() { ?>

<script type="text/javascript">
	jQuery(document).ready(function($) { 
		
		// custom js for body options
		$('#ws_bodyoption').change(function() {
			switch($(this).val()) {
				case "color":
					$('[id=section-ws_bodypattern], [id=section-ws_bodyupload], [id=section-ws_bodyrepeat], [id=section-ws_bodyattach]').hide().addClass('hidden');
					$('[id=section-ws_bodybackground]').show().removeClass('hidden');
				break;
				case "colorpattern":
					$('[id=section-ws_bodyupload]').hide().addClass('hidden');
			        	$('[id=section-ws_bodybackground], [id=section-ws_bodypattern], [id=section-ws_bodyrepeat], [id=section-ws_bodyattach]').show().removeClass('hidden');
				break;
				case "upload":
					$('[id=section-ws_bodybackground],[id=section-ws_bodyupload], [id=section-ws_bodyrepeat], [id=section-ws_bodyattach]').show().removeClass('hidden');
			        	$('[id=section-ws_bodypattern]').hide().addClass('hidden');
				break;				
			}
		});
		
		// show and hide sections on page load based off of the currently selected body option 
		if ($('#ws_bodyoption').val() == "color") {
		     $('[id=section-ws_bodypattern], [id=section-ws_bodyupload], [id=section-ws_bodyrepeat], [id=section-ws_bodyattach]').hide().addClass('hidden');
		     $('[id=section-ws_bodybackground]').show().removeClass('hidden');
		    };
		if ($('#ws_bodyoption').val() == "colorpattern") {
			$('[id=section-ws_bodyupload]').hide().addClass('hidden');
			$('[id=section-ws_bodybackground], [id=section-ws_bodypattern], [id=section-ws_bodyrepeat], [id=section-ws_bodyattach]').show().removeClass('hidden');
		    };
		if ($('#ws_bodyoption').val() == "upload") {
			$('[id=section-ws_bodybackground],[id=section-ws_bodyupload], [id=section-ws_bodyrepeat], [id=section-ws_bodyattach]').show().removeClass('hidden');
			$('[id=section-ws_bodypattern]').hide().addClass('hidden');
		    };     
			    
	});
</script>		    

<?php
}