<?php

add_action('optionsframework_custom_scripts', 'optionsframework_option_nav');
function optionsframework_option_nav() { ?>

<script type="text/javascript">
	jQuery(document).ready(function($) { 
		
		// custom js for nav options
		$('#ws_navbartype').change(function() {
		    switch($(this).val()) {
		    		case "navbar-light":
		    			$('[id^=section-ws_navbarinverse],[id^=section-ws_navbartabs],[id^=section-ws_navbarpills]').hide().addClass('hidden');
			     	$('[id^=section-ws_navbardefault]').show().removeClass('hidden');
			     break;
			     case "navbar-dark":
		    			$('[id^=section-ws_navbardefault],[id^=section-ws_navbartabs],[id^=section-ws_navbarpills]').hide().addClass('hidden');
			     	$('[id^=section-ws_navbarinverse]').show().removeClass('hidden');
			     break;
			     case "tabs":
		    			$('[id^=section-ws_navbardefault],[id^=section-ws_navbarinverse],[id^=section-ws_navbarpills]').hide().addClass('hidden');
			     	$('[id^=section-ws_navbartabs]').show().removeClass('hidden');
			     break;
			     case "pills":
		    			$('[id^=section-ws_navbardefault],[id^=section-ws_navbarinverse],[id^=section-ws_navbartabs]').hide().addClass('hidden');
			     	$('[id^=section-ws_navbarpills]').show().removeClass('hidden');
			     break;
			}
		});    			    
			    
	});
</script>		    

<?php
}