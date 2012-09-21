jQuery(document).ready(function($) {
	
	/*-----------------------------------------------------------------------------------*/
	/* Static Methods
	/*-----------------------------------------------------------------------------------*/
	
	var sidebar_ws = {
		
		// Delete Sidebar
    	delete_sidebar : function( ids, action )
    	{
    		var nonce  = $('#manage_current_sidebars').find('input[name="_wpnonce"]').val();
			tbc_confirm( wordstrap.delete_sidebar, {'confirm':true}, function(r)
			{
		    	if(r)
		        {
		        	$.ajax({
						type: "POST",
						url: ajaxurl,
						data:
						{
							action: 'sidebar_ws_delete_sidebar',
							security: nonce,
							data: ids
						},
						success: function(response)
						{	
							// Prepare response
							response = response.split('[(=>)]');
							
							// Scroll to top of page
							$('body').animate( { scrollTop: 0 }, 100, function(){						
								
								// Insert update message, fade it in, and then remove it 
								// after a few seconds.
								$('#sidebar_ws #manage_sidebars').prepend(response[0]);
								$('#sidebar_ws #manage_sidebars .ajax-update').fadeIn(500, function(){
									setTimeout( function(){
										$('#sidebar_ws #manage_sidebars .ajax-update').fadeOut(500, function(){
											$('#sidebar_ws #manage_sidebars .ajax-update').remove();
										});
							      	}, 1500);
								
								});
								
								// Update table
								$('#sidebar_ws #manage_sidebars .ajax-mitt').hide().html(response[1]).fadeIn('fast');
							});
						}
					});
		        }
		    });
    	}

	};
	
	/*-----------------------------------------------------------------------------------*/
	/* General setup
	/*-----------------------------------------------------------------------------------*/
	
	// Items from wordstrap namespace
	$('#sidebar_ws .accordion').wordstrap('accordion');
	
	// Hide secret tab when page loads
	$('#sidebar_ws .nav-tab-wrapper a.nav-edit-sidebar').hide();
	
	// If the active tab is on edit layout page, we'll 
	// need to override the default functionality of 
	// the Options Framework JS, because we don't want 
	// to show a blank page.
	if (typeof(localStorage) != 'undefined' )
	{
		if( localStorage.getItem('activetab') == '#edit_sidebar')
		{
			$('#sidebar_ws .group').hide();
			$('#sidebar_ws .group:first').fadeIn();
			$('#sidebar_ws .nav-tab-wrapper a:first').addClass('nav-tab-active');
		}
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* Manage Widget Areas Page
	/*-----------------------------------------------------------------------------------*/
	
	// Edit slider (via Edit Link on manage page)
	$('#sidebar_ws #manage_sidebars .edit-ws_sidebar').live( 'click', function(){
		var name = $(this).closest('tr').find('.post-title .title-link').text(),
			id = $(this).attr('href'), 
			id = id.replace('#', '');
		
		$.ajax({
			type: "POST",
			url: ajaxurl,
			data:
			{
				action: 'sidebar_ws_edit_sidebar',
				data: id
			},
			success: function(response)
			{	
				// Get the ID from the beginning
				var page = response.split('[(=>)]');
				
				// Prepare the edit tab
				$('#sidebar_ws .nav-tab-wrapper a.nav-edit-sidebar').text(wordstrap.edit_sidebar+': '+name).addClass('edit-'+page[0]);
				$('#sidebar_ws #edit_sidebar .ajax-mitt').html(page[1]);
				
				// Setup accordion
				$('#sidebar_ws #edit_sidebar .accordion').wordstrap('accordion');
				
				// Setup options
				$('#sidebar_ws #edit_sidebar').wordstrap('options', 'setup');
				
				// Take us to the tab
				$('#sidebar_ws .nav-tab-wrapper a').removeClass('nav-tab-active');
				$('#sidebar_ws .nav-tab-wrapper a.nav-edit-sidebar').show().addClass('nav-tab-active');
				$('#sidebar_ws .group').hide();
				$('#sidebar_ws .group:last').fadeIn();
			}
		});
		return false;
	});
	
	// Delete sidebar (via Delete Link on manage page)
	$('#sidebar_ws .row-actions .trash a').live( 'click', function(){
		var href = $(this).attr('href'), id = href.replace('#', ''), ids = 'posts%5B%5D='+id;
		sidebar_ws.delete_sidebar( ids, 'click' );
		return false;
	});
	
	// Delete sidebars via bulk action
	$('#manage_current_sidebars').live( 'submit', function(){		
		var value = $(this).find('select[name="action"]').val(), ids = $(this).serialize();
		if(value == 'trash')
		{
			sidebar_ws.delete_sidebar( ids, 'submit' );
		}
		return false;
	});
	
	/*-----------------------------------------------------------------------------------*/
	/* Add New Widget Area Page
	/*-----------------------------------------------------------------------------------*/
	
	// Add new layout
	$('#optionsframework #add_new_sidebar').submit(function(){		
		var el = $(this),
			data = el.serialize(),
			load = el.find('.ajax-loading'),
			name = el.find('input[name="options[sidebar_name]"]').val(),
			nonce = el.find('input[name="_wpnonce"]').val();
		
		// Tell user they forgot a name
		if(!name)
		{
			tbc_confirm(wordstrap.no_name, {'textOk':'Ok'});
		    return false;
		}
			
		$.ajax({
			type: "POST",
			url: ajaxurl,
			data: 
			{
				action: 'sidebar_ws_add_sidebar',
				security: nonce,
				data: data
			},
			beforeSend: function()
			{
				load.fadeIn('fast');
			},
			success: function(response)
			{	
				// Update management table
				$('#sidebar_ws #manage_sidebars .ajax-mitt').html(response);
				
				// Scroll to top of page
				$('body').animate( { scrollTop: 0 }, 100, function(){						
					// Take us back to the management tab
					$('#sidebar_ws .nav-tab-wrapper a').removeClass('nav-tab-active');
					$('#sidebar_ws .nav-tab-wrapper a:first').addClass('nav-tab-active');
					$('#sidebar_ws .group').hide();
					$('#sidebar_ws .group:first').fadeIn();
					tbc_alert.init(wordstrap.sidebar_created, 'success');
				});
				
				// Clear form
				$('#sidebar_ws #add_new_sidebar #sidebar_name').val('');
				$('#sidebar_ws #add_new_sidebar input').removeAttr('checked');
								
				// Hide loader no matter what.												
				load.hide();
			}
		});
		return false;
	});
	
	/*-----------------------------------------------------------------------------------*/
	/* Edit Widget Area Page
	/*-----------------------------------------------------------------------------------*/
	
	// Save Widget Area
	$('#optionsframework #edit_current_sidebar').live('submit', function(){
		var el = $(this),
			data = el.serialize(),
			load = el.find('.ajax-loading'),
			nonce = el.find('input[name="_wpnonce"]').val();

		$.ajax({
			type: "POST",
			url: ajaxurl,
			data:
			{
				action: 'sidebar_ws_save_sidebar',
				security: nonce,
				data: data
			},
			beforeSend: function()
			{
				load.fadeIn('fast');
			},
			success: function(response)
			{	
			
				response = response.split('[(=>)]');
				
				// Scroll to top of page
				$('body').animate( { scrollTop: 0 }, 100, function(){						
					// Insert update message, fade it in, and then remove it 
					// after a few seconds.
					$('#sidebar_ws #edit_sidebar').prepend(response[0]);
					$('#sidebar_ws #edit_sidebar .ajax-update').fadeIn(500, function(){
						setTimeout( function(){
							$('#sidebar_ws #edit_sidebar .ajax-update').fadeOut(500, function(){
								$('#sidebar_ws #edit_sidebar .ajax-update').remove();
							});
				      	}, 1500);
					
					});
				});
			
				// Update management table in background
				$('#sidebar_ws #manage_sidebars .ajax-mitt').html(response[1]);
				
				load.fadeOut('fast');
			}
		});
		return false;
	});
	
});