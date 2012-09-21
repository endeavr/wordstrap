/**
 * Prints out the inline javascript needed for managing sliders. 
 * This is an extension of what was already started in the
 * options-custom.js file.
 */

jQuery(document).ready(function($) {
	
	/*-----------------------------------------------------------------------------------*/
	/* Static Methods
	/*-----------------------------------------------------------------------------------*/
	
	var slider_ws = {
    	
    	// Update Manage Sliders page's table
    	manager : function( table )
    	{
    		if(table)
			{
				// We already have the table, so just throw it in.
				$('#slider_ws #manage .ajax-mitt').html(table);
			}
			else
			{
				// We don't have the table yet, so let's grab it.
				$.ajax({
					type: "POST",
					url: ajaxurl,
					data:
					{
						action: 'slider_ws_update_table'
					},
					success: function(response)
					{	
						$('#slider_ws #manage .ajax-mitt').html(response);
					}
				});
			}
    	},
    	
    	// Delete Slider
    	delete_slider : function( ids, action, location )
    	{
    		var nonce  = $('#manage_sliders').find('input[name="_wpnonce"]').val();
			tbc_confirm( wordstrap.delete_slider, {'confirm':true}, function(r)
			{
		    	if(r)
		        {
		        	$.ajax({
						type: "POST",
						url: ajaxurl,
						data:
						{
							action: 'slider_ws_delete_slider',
							security: nonce,
							data: ids
						},
						success: function(response)
						{	
							// Prepare response
							response = response.split('[(=>)]');
							
							// Insert update message, fade it in, and then remove it 
							// after a few seconds.
							$('#slider_ws #manage').prepend(response[1]);
							$('#slider_ws #manage .ajax-update').fadeIn(500, function(){
								setTimeout( function(){
									$('#slider_ws #manage .ajax-update').fadeOut(500, function(){
										$('#slider_ws #manage .ajax-update').remove();
									});
						      	}, 1500);
							
							});
							
							// Change number of sliders
							$('#slider_ws .displaying-num').text(response[0]);
							
							// Update table
							if(action == 'submit')
							{
								$('#manage_sliders').find('input[name="posts[]"]').each(function(){
									if( $(this).is(':checked') )
									{
										var id = $(this).val();
										if( $('#edit-tab').hasClass(id+'-edit') )
										{
											$('#edit-tab').hide();
										}
										$(this).closest('tr').remove();
									}
								});
							}
							else if(action == 'click')
							{
								var id = ids.replace('posts%5B%5D=', '');
								if( $('#edit-tab').hasClass(id+'-edit') )
								{
									$('#edit-tab').hide();
								}
								$('#row-'+id).remove();
							}
							
							// Uncheck all checkboxes
							$('#manage_sliders option').removeAttr('checked'); 
							
							// Forward back to manage sliders page, if 
							// we're deleting this slider from the Edit 
							// Slider page.
							if(location == 'edit_page')
							{
								$('#slider_ws .group').hide();
								$('#slider_ws .group:first').fadeIn();
								$('#slider_ws .nav-tab-wrapper a:first').addClass('nav-tab-active');	
							}
						}
					});
		        }
		    });
    	},
    	
    	// Enter into editing a slider
    	edit : function ( name, page )
    	{
    		// Get the ID from the beginning
			var page = page.split('[(=>)]');

			// Prepare the edit tab
			$('#slider_ws .nav-tab-wrapper a.nav-edit-slider').text(wordstrap.edit_slider+': '+name).addClass(page[0]+'-edit');
			$('#slider_ws #edit_slider .ajax-mitt').html(page[1]);
			
			// Setup elements
			$('#slider_ws .slide-element-check input').each(function(){
				slider_ws.elements( $(this) );
			});
			
			// Setup types
			$('#slider_ws .slide-set-type select').each(function(){
				slider_ws.type( $(this) );
			});
			
			// Setup widgets
			$('#slider_ws .widget').wordstrap('widgets');
			
			// Setup sortables
			$('#sortable').sortable({
				handle: '.widget-name'
			});
			
			// Take us to the tab
			$('#slider_ws .nav-tab-wrapper a').removeClass('nav-tab-active');
			$('#slider_ws .nav-tab-wrapper a.nav-edit-slider').show().addClass('nav-tab-active');
			$('#slider_ws .group').hide();
			$('#slider_ws .group:last').fadeIn();
    	},
    	
    	// Show setup for slide according to what type of slide we're working with. 
    	// Will always be image, video, or custom type of slide.
    	type : function( object )
    	{
    		var opposite,
				parent = object.closest('.widget-content'),
				value = object.val(),
				position = object.closest('.widget-content').find('.slide-position').val();
				name = object.find('option[value="'+value+'"]').text();	
			
			parent.removeClass('type-image type-video type-custom');
			parent.addClass('type-'+value);
			object.parent().find('strong').text(name);
			
			if(value == 'custom')
			{
				parent.find('.slide-media').hide();
				parent.find('.slide-custom').fadeIn('fast');
			}
			else
			{
				if(value == 'image'){
					opposite = 'video';
					if( parent.find('.slide-elements .element-image_link input').is(':checked') )
					{
						parent.find('.slide-elements .element-image_link').show();
					}
					else
					{
						parent.find('.slide-elements .element-image_link:first').show();
					}
					parent.find('.slide-elements-warning').hide();
					parent.find('.slide-elements').show();
				}
				else if(value == 'video')
				{
					opposite = 'image';
					parent.find('.slide-elements .element-image_link').hide();
					if(position == 'full')
					{
						parent.find('.slide-elements').hide();
						parent.find('.slide-elements-warning').show();
					}
					else
					{
						parent.find('.slide-elements-warning').hide();
						parent.find('.slide-elements').show();
					}
				}
				
				parent.find('.slide-set-media .slide-set-'+opposite).hide();
				parent.find('.slide-set-media .slide-set-'+value).show();
				parent.find('.slide-custom').hide();
				parent.find('.slide-media').fadeIn('fast');
			}
		},
		
		// Slide's position of media - full width, aligned right, aligned left
		position : function( object )
		{
			if( object.closest('.widget-content').hasClass('type-video') )
			{
				var value = object.val(), parent = object.closest('.widget-content');
				parent.find('.slide-elements .element-image_link').hide();
				if(value == 'full')
				{
					parent.find('.slide-elements').hide();
					parent.find('.slide-elements-warning').show();
				}
				else
				{
					parent.find('.slide-elements-warning').hide();
					parent.find('.slide-elements').show();
				}
			}
		},
		
		// Show/hide elements when editing a slide
    	elements : function( object )
    	{
	    	var option_set = object.closest('tr').next('tr');
			if ( object.is(':checked') )
			{
				option_set.show();
			}
			else
			{
				option_set.hide();
			}
    	}
    };
	
	/*-----------------------------------------------------------------------------------*/
	/* General setup
	/*-----------------------------------------------------------------------------------*/
	
	// Items from wordstrap namespace
	$('#slider_ws .widget').wordstrap('widgets');
	
	// Hide secret tab when page loads
	$('#slider_ws .nav-tab-wrapper a.nav-edit-slider').hide();
	
	// If the active tab is on edit slider page, we'll 
	// need to override the default functionality of 
	// the Options Framework JS, because we don't want 
	// to show a blank page.
	if (typeof(localStorage) != 'undefined' )
	{
		if( localStorage.getItem('activetab') == '#edit')
		{
			$('#slider_ws .group').hide();
			$('#slider_ws .group:first').fadeIn();
			$('#slider_ws .nav-tab-wrapper a:first').addClass('nav-tab-active');
		}
	}
	
	// Edit slider binded events
	$('#slider_ws .slide-set-type select').live('change', function(){
		slider_ws.type( $(this)  );
	});
	$('#slider_ws .slide-position').live('change', function(){
		slider_ws.position( $(this) );
	});
	$('#slider_ws .slide-element-check input').live('change', function(){
		slider_ws.elements( $(this) );
	});
	
	/*-----------------------------------------------------------------------------------*/
	/* Manage Sliders Page
	/*-----------------------------------------------------------------------------------*/
	
	// Edit slider (via Edit Link on manage page)
	$('#slider_ws #manage .edit-ws_slider').live( 'click', function(){
		var name = $(this).closest('tr').find('.post-title .title-link').text(),
			id = $(this).attr('href'), 
			id = id.replace('#', '');
		
		$.ajax({
			type: "POST",
			url: ajaxurl,
			data:
			{
				action: 'slider_ws_edit_slider',
				data: id
			},
			success: function(response)
			{	
				slider_ws.edit( name, response );
			}
		});
		return false;
	});
	
	// Delete slider (via Delete Link on manage page)
	$('#slider_ws .row-actions .trash a').live( 'click', function(){
		var href = $(this).attr('href'), id = href.replace('#', ''), ids = 'posts%5B%5D='+id;
		slider_ws.delete_slider( ids, 'click' );
		return false;
	});
	
	// Delete sliders via bulk action
	$('#manage_sliders').live( 'submit', function(){
		var value = $(this).find('select[name="action"]').val(), ids = $(this).serialize();
		if(value == 'trash')
		{
			slider_ws.delete_slider( ids, 'submit' );
		}
		return false;
	});
	
	/*-----------------------------------------------------------------------------------*/
	/* Add New Slider Page
	/*-----------------------------------------------------------------------------------*/
	
	// Add new slider
	$('#optionsframework #add_new_slider').submit(function(){		
		var el = $(this),
			data = el.serialize(),
			load = el.find('.ajax-loading'),
			name = el.find('input[name="options[slider_name]"]').val(),
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
				action: 'slider_ws_add_slider',
				security: nonce,
				data: data
			},
			beforeSend: function()
			{
				load.fadeIn('fast');
			},
			success: function(response)
			{	
			    if (response == 'error_type')
				{
					// Tell 'em the type of slider is invalid.
					tbc_confirm(wordstrap.invalid_slider, {'textOk':'Ok'});
				}
				else
				{	
					// Scroll to top of page
					$('body').animate( { scrollTop: 0 }, 100, function(){						
						// Everything is good to go. So, forward 
						// on to the edit slider page.					
						slider_ws.edit( name, response );
						tbc_alert.init(wordstrap.slider_created, 'success');
						el.find('input[name="options[slider_name]"]').val('');
					});

					// Update slider management table in background
					slider_ws.manager();
				}

				// Hide loader no matter what.												
				load.hide();
			}
		});
		return false;
	});
	
	/*-----------------------------------------------------------------------------------*/
	/* Edit Slider Page
	/*-----------------------------------------------------------------------------------*/
	
	// Add new slide
	$('#optionsframework #add_new_slide').live( 'click', function(){
		var el = $(this),
			id,
			trim_front,
			trim_back,
			slide_id,
			overlay = el.parent().find('.ajax-overlay'),
			load = el.parent().find('.ajax-loading');
			type = el.attr('href'),
			type = type.replace('#', '');

		$.ajax({
			type: "POST",
			url: ajaxurl,
			data:
			{
				action: 'slider_ws_add_slide',
				data: type
			},
			beforeSend: function()
			{
				overlay.fadeIn('fast');
				load.fadeIn('fast');
			},
			success: function(response)
			{	
				trim_front = response.split('<div id="');
				trim_back = trim_front[1].split('" class="widget slide-options"');
				slide_id = trim_back[0];
				$('#slider_ws #edit #sortable .no-item-yet').remove();
				$('#slider_ws #edit #sortable').append(response);
				$('#'+slide_id+' .slide-set-type select').each(function(){
					slider_ws.type( $(this)  );
				});
				$('#'+slide_id).wordstrap('widgets');
				$('#'+slide_id).fadeIn();											
				load.fadeOut('fast');
				overlay.fadeOut('fast');
			}
		});
		return false;
	});
	
	// Save Slider
	$('#optionsframework #edit_slider').live('submit', function(){
		var el = $(this),
			data = el.serialize(),
			load = el.find('.publishing-action .ajax-loading'),
			nonce = el.find('input[name="_wpnonce"]').val();
			
		$.ajax({
			type: "POST",
			url: ajaxurl,
			data:
			{
				action: 'slider_ws_save_slider',
				security: nonce,
				data: data
			},
			beforeSend: function()
			{
				load.fadeIn('fast');
			},
			success: function(response)
			{	
				// Insert update message, fade it in, and then remove it 
				// after a few seconds.
				$('#slider_ws #edit').prepend(response);

				// Scroll to top of page
				$('body').animate( { scrollTop: 0 }, 50, function(){						
					// Fade in the update message
					$('#slider_ws #edit .ajax-update').fadeIn(500, function(){
						setTimeout( function(){
							$('#slider_ws #edit .ajax-update').fadeOut(500, function(){
								$('#slider_ws #edit .ajax-update').remove();
							});
				      	}, 1500);
					
					});
				});
				load.fadeOut('fast');
			}
		});
		return false;
	});
	
	// Delete slider (via Delete Link on edit slider page)
	$('#slider_ws #edit .delete_slider').live( 'click', function(){
		var href = $(this).attr('href'), id = href.replace('#', ''), ids = 'posts%5B%5D='+id;
		slider_ws.delete_slider( ids, 'click', 'edit_page' );
		return false;
	});
			 		
});	