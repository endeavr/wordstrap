<?php

add_action('optionsframework_custom_scripts', 'optionsframework_option_sidebar');
function optionsframework_option_sidebar() { ?>

<script type="text/javascript">
	jQuery(document).ready(function($) { 
		
		// custom js for sidebar options
		$('#ws_sidebaroption').change(function() {
			switch($(this).val()) {
				case "transparent":
			        	$('[id=section-ws_sidebarbackground], [id=section-ws_sidebarpatternsheer], [id=section-ws_sidebarpatternopaque], [id=section-ws_sidebarupload], [id=section-ws_sidebarrepeat], [id=section-ws_sidebarattach]' ).hide().addClass('hidden');
				break;			
				case "color":
					$('[id=section-ws_sidebarpatternsheer], [id=section-ws_sidebarpatternopaque], [id=section-ws_sidebarupload], [id=section-ws_sidebarrepeat], [id=section-ws_sidebarattach]').hide().addClass('hidden');
					$('[id=section-ws_sidebarbackground]').show().removeClass('hidden');
				break;
				case "gradient":
					$('[id=section-ws_sidebarpatternsheer], [id=section-ws_sidebarpatternopaque], [id=section-ws_sidebarupload]').hide().addClass('hidden');
					$('[id=section-ws_sidebarbackground], [id=section-ws_sidebarrepeat], [id=section-ws_sidebarattach]').show().removeClass('hidden');
				break;				
				case "patternsheer":
					$('[id=section-ws_sidebarupload], [id=section-ws_sidebarpatternopaque]').hide().addClass('hidden');
			        	$('[id=section-ws_sidebarbackground], [id=section-ws_sidebarpatternsheer], [id=section-ws_sidebarrepeat], [id=section-ws_sidebarattach]').show().removeClass('hidden');
				break;
				case "patternopaque":
					$('[id=section-ws_sidebarbackground], [id=section-ws_sidebarupload], [id=section-ws_sidebarpatternsheer]').hide().addClass('hidden');
			        	$('[id=section-ws_sidebarpatternopaque], [id=section-ws_sidebarrepeat], [id=section-ws_sidebarattach]').show().removeClass('hidden');
				break;				
				case "uploadsheer":
					$('[id=section-ws_sidebarpatternsheer], [id=section-ws_sidebarpatternopaque],').hide().addClass('hidden');
					$('[id=section-ws_sidebarbackground], [id=section-ws_sidebarupload], [id=section-ws_sidebarrepeat], [id=section-ws_sidebarattach]').show().removeClass('hidden');
				break;	
				case "uploadopaque":
					$('[id=section-ws_sidebarbackground], [id=section-ws_sidebarpatternsheer], [id=section-ws_sidebarpatternopaque],').hide().addClass('hidden');				
					$('[id=section-ws_sidebarupload], [id=section-ws_sidebarrepeat], [id=section-ws_sidebarattach]').show().removeClass('hidden');
				break;							
			}
		});
		
		// show and hide sections on page load based off of the currently selected sidebar option 
		if ($('#ws_sidebaroption').val() == "transparent") {
			$('[id=section-ws_sidebarbackground],[id=section-ws_sidebarpatternsheer], [id=section-ws_sidebarpatternopaque], [id=section-ws_sidebarupload], [id=section-ws_sidebarrepeat], [id=section-ws_sidebarattach]' ).hide().addClass('hidden');
		    }; 		
		if ($('#ws_sidebaroption').val() == "color") {
		     $('[id=section-ws_sidebarpatternsheer], [id=section-ws_sidebarpatternopaque], [id=section-ws_sidebarupload], [id=section-ws_sidebarrepeat], [id=section-ws_sidebarattach]').hide().addClass('hidden');
		     $('[id=section-ws_sidebarbackground]').show().removeClass('hidden');
		    };
		if ($('#ws_sidebaroption').val() == "gradient") {
		     $('[id=section-ws_sidebarpatternsheer], [id=section-ws_sidebarpatternopaque], [id=section-ws_sidebarupload]').hide().addClass('hidden');
		     $('[id=section-ws_sidebarbackground], [id=section-ws_sidebarrepeat], [id=section-ws_sidebarattach]').show().removeClass('hidden');
		    };		    
		if ($('#ws_sidebaroption').val() == "patternsheer") {
			$('[id=section-ws_sidebarupload], [id=section-ws_sidebarpatternopaque]').hide().addClass('hidden');
			$('[id=section-ws_sidebarbackground], [id=section-ws_sidebarpatternsheer], [id=section-ws_sidebarrepeat], [id=section-ws_sidebarattach]').show().removeClass('hidden');
		    };
		if ($('#ws_sidebaroption').val() == "patternopaque") {
			$('[id=section-ws_sidebarbackground], [id=section-ws_sidebarupload], [id=section-ws_sidebarpatternsheer]').hide().addClass('hidden');
			$('[id=section-ws_sidebarpatternopaque], [id=section-ws_sidebarrepeat], [id=section-ws_sidebarattach]').show().removeClass('hidden');
		    };		    
		if ($('#ws_sidebaroption').val() == "uploadsheer") {
			$('[id=section-ws_sidebarpatternsheer], [id=section-ws_sidebarpatternopaque]').hide().addClass('hidden');
			$('[id=section-ws_sidebarbackground], [id=section-ws_sidebarupload], [id=section-ws_sidebarrepeat], [id=section-ws_sidebarattach]').show().removeClass('hidden');
		    }; 
		if ($('#ws_sidebaroption').val() == "uploadopaque") {
		     $('[id=section-ws_sidebarbackground], [id=section-ws_sidebarpatternsheer], [id=section-ws_sidebarpatternopaque]').hide().addClass('hidden');
			$('[id=section-ws_sidebarupload], [id=section-ws_sidebarrepeat], [id=section-ws_sidebarattach]').show().removeClass('hidden');
		    }; 		        
			    
	});
</script>		    

<?php
}