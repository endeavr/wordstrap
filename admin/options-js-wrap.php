<?php

add_action('optionsframework_custom_scripts', 'optionsframework_option_wrap');
function optionsframework_option_wrap() { ?>

<script type="text/javascript">
	jQuery(document).ready(function($) { 
		
		// custom js for wrap options
		$('#ws_wrapoption').change(function() {
			switch($(this).val()) {
				case "transparent":
			        	$('[id=section-ws_wrapbackground], [id=section-ws_wrappattern], [id=section-ws_wrapupload], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]' ).hide().addClass('hidden');
				break;
				case "color":
					$('[id=section-ws_wrappattern], [id=section-ws_wrapupload], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]').hide().addClass('hidden');
					$('[id=section-ws_wrapbackground]').show().removeClass('hidden');
				break;
				case "colorpattern":
					$('[id=section-ws_wrapupload]').hide().addClass('hidden');
			        	$('[id=section-ws_wrapbackground], [id=section-ws_wrappattern], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]').show().removeClass('hidden');
				break;	
				case "upload":
					$('[id=section-ws_wrapbackground], [id=section-ws_wrapupload], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]').show().removeClass('hidden');
			        	$('[id=section-ws_wrappattern]').hide().addClass('hidden');
				break;								
			}
		});
		
		// show and hide sections on page load based off of the currently selected wrap option 
		if ($('#ws_wrapoption').val() == "transparent") {
			$('[id=section-ws_wrapbackground], [id=section-ws_wrappattern], [id=section-ws_wrapupload], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]' ).hide().addClass('hidden');
		    }; 
		if ($('#ws_wrapoption').val() == "color") {
		     $('[id=section-ws_wrappattern], [id=section-ws_wrapupload], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]').hide().addClass('hidden');
		     $('[id=section-ws_wrapbackground]').show().removeClass('hidden');
		    };
		if ($('#ws_wrapoption').val() == "colorpattern") {
		     $('[id=section-ws_wrapupload]').hide().addClass('hidden');
			$('[id=section-ws_wrapbackground], [id=section-ws_wrappattern], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]').show().removeClass('hidden');
		    };
		if ($('#ws_wrapoption').val() == "upload") {
		     $('[id=section-ws_wrapbackground], [id=section-ws_wrapupload], [id=section-ws_wraprepeat], [id=section-ws_wrapattach]').show().removeClass('hidden');
			$('[id=section-ws_wrappattern]').hide().addClass('hidden');
		    };			    
			    
	});
</script>		    

<?php
}