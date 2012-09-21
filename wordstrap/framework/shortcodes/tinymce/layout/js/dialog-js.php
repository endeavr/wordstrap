<?php
header("Content-Type:text/javascript");

//Setup URL to WordPres
$absolute_path = __FILE__;
$path_to_wp = explode( 'wp-content', $absolute_path );
$wp_url = $path_to_wp[0];

//Access WordPress
require_once( $wp_url.'/wp-load.php' );

//Path to TinyMCE plugin folder
$path_to_wp = explode( 'wp-content', dirname(__FILE__) );
$plugin_path = trailingslashit( '../wp-content' . substr( $path_to_wp[1], 0, -3 ) );

//URL to TinyMCE plugin folder
$plugin_url = get_template_directory_uri().'/framework/shortcodes/tinymce/';
?>

var framework_url = '<?php echo dirname( __FILE__ ); ?>';

var shortcode_generator_path = '<?php echo $plugin_path; ?>';
var shortcode_generator_url = '<?php echo $plugin_url; ?>';

var ws_dialog_helper = {
	
	// ---------------------------------------------------------
    // TickBox popup controls
    // ---------------------------------------------------------
    
    remove_linebreaks : false,
    needsPreview: false,
    setUpButtons: function () {
        var a = this;
        jQuery("#wordstrap-cancel-button").click(function () {
            a.closeDialog()
        });
        jQuery("#wordstrap-insert-button").click(function () {
            a.insertAction()
        });
    },
    loadShortcodeDetails: function () {
        if (wordstrapSelectedShortcodeType) {
            var a = this;
            jQuery.getScript(shortcode_generator_url + "shortcodes/ws_" + wordstrapSelectedShortcodeType + ".js", function () {
                a.initializeDialog();
                
                // Set the default content to the highlighted text, for certain shortcode types.
                switch ( wordstrapSelectedShortcodeType ) {
					case 'box':
					case 'ilink':
					case 'quote':
					case 'button':
					case 'abbr':
					case 'unordered_list':
					case 'ordered_list':
					case 'typography':
						jQuery('input#wordstrap-value-content').val( selectedText );
					case 'toggle':
						jQuery('textarea#wordstrap-value-content').val( selectedText );
					break;
				
				} // End SWITCH Statement
                
                // Automatic preview generation on load.
                a.previewAction();
            })

        }

    },
    initializeDialog: function () {

        if (typeof wordstrapShortcodeAtts == "undefined") {
            jQuery("#wordstrap-shortcode-options").append("<p>Error loading details for shortcode: " + wordstrapSelectedShortcodeType + "</p>");
        } else {

            var a = wordstrapShortcodeAtts.attributes,
                b = jQuery("#wordstrap-options-table");

            for (var c in a) {
                var f = "wordstrap-value-" + a[c].id,
                    d = a[c].isRequired ? "wordstrap-required" : "",
                    g = jQuery('<th valign="top" scope="row"></th>');

                var requiredSpan = '<span class="optional"></span>';
                if (a[c].isRequired) {
                    requiredSpan = '<span class="required">*</span>';
                } // End IF Statement
                jQuery("<label/>").attr("for", f).attr("class", d).html(a[c].label).append(requiredSpan).appendTo(g);
                f = jQuery("<td/>");
                d = (d = a[c].controlType) ? d : "text-control";
                switch (d) {
	                /*
	                case "tab-control":
	                    this.createTabControl(a[c], f, c == 0);
	                    break;
					*/
	                case "icon-control":
	                case "link-control":
	                case "text-control":
	                    this.createTextControl(a[c], f, c == 0);
	                    break;
	                    
	                case "textarea-control":
	                    this.createTextAreaControl(a[c], f, c == 0);
	                    break;
	
	                case "select-control":
	                    this.createSelectControl(a[c], f, c == 0);
	                    break;
	                }
	
	                jQuery("<tr/>").append(g).append(f).appendTo(b)
	            }
	            jQuery(".wordstrap-focus-here:first").focus()
	
				// Add additional wrappers, etc, to each select box.
				jQuery('#wordstrap-shortcode-options select').wrap( '<div class="select_wrapper"></div>' ).before('<span></span>');
				jQuery('#wordstrap-shortcode-options select option:selected').each( function () {
				jQuery(this).parents('.select_wrapper').find('span').text( jQuery(this).text() );
			});

        } // End IF Statement
    },
    
     /* Tab Generator Element */

    createTabControl: function (a, b, c) {
        new wordstrapTabMaker(b, 6, c ? "wordstrap-focus-here" : null);
        b.addClass("wordstrap-marker-tab-control")
    },

    // ---------------------------------------------------------
    // Generic Text Element
    // ---------------------------------------------------------

    createTextControl: function (a, b, c) {
		
        var f = a.validateLink ? "wordstrap-validation-marker" : "",
            d = a.isRequired ? "wordstrap-required" : "",
            g = "wordstrap-" + a.id,
            e = a.value; // Default text input value (Added 10/10/2011)

        jQuery('<input type="text">').attr("id", g).attr("name", g).val(e).addClass(f).addClass(d).addClass('txt input-text').addClass(c ? "wordstrap-focus-here" : "").appendTo(b);
		
        if (a = a.help) {
            jQuery("<br/>").appendTo(b);
            jQuery("<span/>").addClass("wordstrap-input-help").html(a).appendTo(b)
        }

        var h = this;
        b.find("#" + g).bind("keydown focusout", function (e) {
            if (e.type == "keydown" && e.which != 13 && e.which != 9 && !e.shiftKey) h.needsPreview = true;
            else if (h.needsPreview && (e.type == "focusout" || e.which == 13)) {
                h.previewAction(e.target);
                h.needsPreview = false
            }
        })

    },
	
	// ---------------------------------------------------------
    // Generic TextArea Element
    // ---------------------------------------------------------
	
    createTextAreaControl: function (a, b, c) {

        var f = a.validateLink ? "wordstrap-validation-marker" : "",
            d = a.isRequired ? "wordstrap-required" : "",
            g = "wordstrap-" + a.id;

        jQuery('<textarea>').attr("id", g).attr("name", g).attr("rows", 10).attr("cols", 30).addClass(f).addClass(d).addClass('txt input-textarea').addClass(c ? "wordstrap-focus-here" : "").appendTo(b);
        b.addClass("wordstrap-marker-textarea-control");

        if (a = a.help) {
            jQuery("<br/>").appendTo(b);
            jQuery("<span/>").addClass("wordstrap-input-help").html(a).appendTo(b)
        }

        var h = this;
        b.find("#" + g).bind("keydown focusout", function (e) {
            if (e.type == "keydown" && e.which != 13 && e.which != 9 && !e.shiftKey) h.needsPreview = true;
            else if (h.needsPreview && (e.type == "focusout" || e.which == 13)) {
                h.previewAction(e.target);
                h.needsPreview = false
            }
        })

    },
	
	
	// ---------------------------------------------------------
    // Select Box Element
    // ---------------------------------------------------------

    createSelectControl: function (a, b, c) {

        var f = a.validateLink ? "wordstrap-validation-marker" : "",
            d = a.isRequired ? "wordstrap-required" : "",
            g = "wordstrap-" + a.id;

        var selectNode = jQuery('<select>').attr("id", g).attr("name", g).addClass(f).addClass(d).addClass('select input-select').addClass(c ? "wordstrap-focus-here" : "");

        b.addClass('wordstrap-marker-select-control');

        var selectBoxValues = a.selectValues;
        
        var labelValues = a.selectValues;

        for (v in selectBoxValues) {

            var value = selectBoxValues[v];
            var label = labelValues[v];
            var selected = '';

            if (value == '') {

                if (a.defaultValue == value) {

                    label = a.defaultText;

                } // End IF Statement
            } else {

                if (value == a.defaultValue) {
                    label = a.defaultText;
                } // End IF Statement
            } // End IF Statement
            if (value == a.defaultValue) {
                selected = ' selected="selected"';
            } // End IF Statement
            
            selectNode.append('<option value="' + value + '"' + selected + '>' + label + '</option>');

        } // End FOREACH Loop
        
        selectNode.appendTo(b);

        if (a = a.help) {
            jQuery("<br/>").appendTo(b);
            jQuery("<span/>").addClass("wordstrap-input-help").html(a).appendTo(b)
        }

        var h = this;

        b.find("#" + g).bind("change", function (e) {

            if ((e.type == "change" || e.type == "focusout") || e.which == 9) {

                h.needsPreview = true;

            }

            if (h.needsPreview) {

                h.previewAction(e.target);

                h.needsPreview = false
            }
            
            // Update the text in the appropriate span tag.
            var newText = jQuery(this).children('option:selected').text();
            
            jQuery(this).parents('.select_wrapper').find('span').text( newText );
        })

    },
    
	getTextKeyValue: function (a) {
        var b = a.find("input");
        if (!b.length) return null;
        a = b.attr("id").substring(10);
        b = b.val();
        return {
            key: a,
            value: b
        }
    },

	getTextAreaKeyValue: function (a) {
        var b = a.find("textarea");
        if (!b.length) return null;
        a = b.attr("id").substring(10);
        b = b.val();
        return {
            key: a,
            value: b
        }
    },

    getColumnKeyValue: function (a) {
        var b = a.find("#wordstrap-column-text").text();
        if (a = Number(a.find("select option:selected").val())) return {
            key: "data",
            value: {
                content: b,
                numColumns: a
            }
        }
    },
    
    getTabKeyValue: function (a) {
        var b = a.find("#wordstrap-tab-text").text();
        if (a = Number(a.find("select option:selected").val())) return {
            key: "data",
            value: {
                content: b,
                numTabs: a
            }
        }
    },

    makeShortcode: function () {

        var a = {},
            b = this;

        jQuery("#wordstrap-options-table td").each(function () {

            var h = jQuery(this),
                e = null;

            if (e = h.hasClass("wordstrap-marker-select-control") ? b.getSelectKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
            if (e = h.hasClass("wordstrap-marker-tab-control") ? b.getTabKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
            if (e = h.hasClass("wordstrap-marker-textarea-control") ? b.getTextAreaKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value

        });

        if (wordstrapShortcodeAtts.customMakeShortcode) return wordstrapShortcodeAtts.customMakeShortcode(a);
        var c = a.content ? a.content : wordstrapShortcodeAtts.defaultContent,
            f = "";
        for (var d in a) {
            var g = a[d];
            if (g && d != "content") f += " " + d + '="' + g + '"'
        }
        
        // Customise the shortcode output for various shortcode types.
        
        switch ( wordstrapShortcodeAtts.shortcodeType ) {
        
        	case 'text-replace':
        	
        		var shortcode = "[" + wordstrapShortcodeAtts.shortcode + f + "]" + (c ? c + "[/" + wordstrapShortcodeAtts.shortcode + "]" : " ")
        	
        	break;
        	
        	default:
        	
        		var shortcode = "[" + wordstrapShortcodeAtts.shortcode + f + "]" + (c ? c + "[/" + wordstrapShortcodeAtts.shortcode + "] " : " ")
        	
        	break;
        
        } // End SWITCH Statement
        
        return shortcode;
    },

    getSelectKeyValue: function (a) {
        var b = a.find("select");
        if (!b.length) return null;
        a = b.attr("id").substring(10);
        b = b.val();
        return {
            key: a,
            value: b
        }
    },

    insertAction: function () {
        if (typeof wordstrapShortcodeAtts != "undefined") {
            var a = this.makeShortcode();
            tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
            this.closeDialog()
        }
    },

    closeDialog: function () {
        this.needsPreview = false;
        ws_remove();
        jQuery("#wordstrap-dialog").remove()
    },

    previewAction: function (a) {
    
    	var fontValue = '';
    	
    	jQuery('#wordstrap-options-table').find('select.input-select-font').each ( function () {
    	
    		fontValue = jQuery(this).val();
    	
    	});
    
        jQuery(a).hasClass("wordstrap-validation-marker") && this.validateLinkFor(a);
    },

    validateLinkFor: function (a) {
        var b = jQuery(a);
        b.removeClass("wordstrap-validation-error");
        b.removeClass("wordstrap-validated");
        if (a = b.val()) {
            b.addClass("wordstrap-validating");
            jQuery.ajax({
                url: ajaxurl,
                dataType: "json",
                data: {
                    action: "wordstrap_check_url_action",
                    url: a
                },
                error: function () {
                    b.removeClass("wordstrap-validating")
                },
                success: function (c) {
                    b.removeClass("wordstrap-validating");
                    c.error || b.addClass(c.exists ? "wordstrap-validated" : "wordstrap-validation-error")
                }
            })
        }
    }

};

ws_dialog_helper.setUpButtons();
ws_dialog_helper.loadShortcodeDetails();