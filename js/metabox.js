var $ =jQuery.noConflict();
$(document).ready(function() {
	/* tinymce editor Start */
	// array to hold all ids of tinymce in repeater
	var textarea_id_tinymce = new Array();
	// make textarea To Tinymce Editor
	$('.textareaTinyMCE').each(function(index){
		var textarea_id = $(this).attr('id');
		textarea_id_tinymce[index] = textarea_id;
		tinymce.init({
			height : 300,
			falseblock_formats: "Paragraph=p;Pre=pre;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6",
			body_class: textarea_id + " post-type-post post-status-publish post-format-standard locale-en-us",
			style_formats:[{title: "Paragraph", block: "p", classes: 'editorP'}],
			browser_spellcheck: true,
			content_css: [gs_metabox.includes + "css/dashicons.min.css", gs_metabox.includes + "js/tinymce/skins/wordpress/wp-content.css"],
			language: "en",
			menubar: false,
			plugins: "charmap,colorpicker,hr,lists,media,paste,tabfocus,textcolor,fullscreen,wpautoresize,wpeditimage,wpgallery,wplink,wpdialogs,wpview",
			toolbar1: "newdocument | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | hr removeformat | subscript superscript | charmap | print fullscreen | styleselect formatselect fontselect fontsizeselect",
	        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
	        toolbar3: "table | emoticons ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
			preview_styles: "font-family font-size font-weight font-style text-decoration text-transform",
			relative_urls: false,
			remove_script_host: false,
			resize: "vertical",
			selector: '#'+ textarea_id,
			fontsize_formats: "10px 12px 14px 16px 24px 26px 28px 30px 32px 34px 36px",
			font_formats: "Andale Mono=andale mono,times;"+
				        "Arial=arial,helvetica,sans-serif;"+
				        "Arial Black=arial black,avant garde;"+
				        "Book Antiqua=book antiqua,palatino;"+
				        "Comic Sans MS=comic sans ms,sans-serif;"+
				        "Courier New=courier new,courier;"+
				        "Georgia=georgia,palatino;"+
				        "Helvetica=helvetica;"+
				        "Impact=impact,chicago;"+
				        "Symbol=symbol;"+
				        "Tahoma=tahoma,arial,helvetica,sans-serif;"+
				        "Terminal=terminal,monaco;"+
				        "Times New Roman=times new roman,times;"+
				        "Trebuchet MS=trebuchet ms,geneva;"+
				        "Verdana=verdana,geneva;"+
				        "Webdings=webdings;"+
				        "Wingdings=wingdings,zapf dingbats;",
			skin: "lightgray",
			theme: "modern",
			force_p_newlines : true,
			forced_root_block : "p",
		});
	});
	/* tinymce editor End */
	/* Remove Submit When Press Enter Start  */
	$('form#post').on("keyup keypress", function(e) {
	  var code = e.keyCode || e.which; 
	  if (code  == 13) {      
	    e.preventDefault();
	    return false;
	  }
	});
	/* Remove Submit When Press Enter End  */
	/* Select 2 Start */
	$('.selectMetabox').select2();
	/* Select 2 End */
	/* Tabs Start */
	if($('.tableWithTabs').length > 0){
		if($('.mapMetaboxContainer').length == 0){
			$('.tabsMetabox li').click(function(){
				$this = $(this);
				$this.parent().children().removeClass('nav-tab-active');
				$this.addClass('nav-tab-active');
				$this.closest('.inside').find('.tableWithTabs tr').each(function(){
					if($this.attr('id') == $(this).data('tab')){
						$(this).addClass('showTab');
						$(this).removeClass('hideTab');
					}else{
						$(this).removeClass('showTab');
						$(this).addClass('hideTab');
					}
				});
			});
			$('.tabsMetabox').each(function(){
				$(this).find('li').first().click();
			});
		}
	}
	/* Tabs End */
	// Loads the color pickers
	$('.gs-color').wpColorPicker();
	/* date picker Start */
	$( ".datepicker" ).each(function(){
		$(this).datepicker({
			dateFormat: ($(this).data('date_format') != '')? $(this).data('date_format') : 'yy/mm/dd'
		});
	});
	/* date picker End */
	/* date time picker Start */
	$( ".datetimepicker" ).each(function(){
		var time_zone = '';
		if($(this).data('time_zone') == true ){
			time_zone = 'z';
		}else{
			time_zone = '';
		}
		$(this).datetimepicker({
			dateFormat: ($(this).data('date_format') != '')? $(this).data('date_format') : 'yy/mm/dd',
			timeFormat: ($(this).data('time_format') != '')? $(this).data('time_format') + time_zone : 'hh:mm tt' + time_zone
		});
	});
	/* date time picker End */
	/* time picker Start */
	$( ".timepicker" ).each(function(){
		var time_zone = '';
		if($(this).data('time_zone') == true ){
			time_zone = 'z';
		}else{
			time_zone = '';
		}
		$(this).timepicker({
			timeFormat: ($(this).data('time_format') != '')? $(this).data('time_format') + time_zone : 'hh:mm tt' + time_zone
		});
	});
	/* time picker End */
	/* Number Start */
	$('.numberType').spinner();
	/* Number End */
	/* Slider Start */
	$( ".sliderMetabox" ).each(function(){
		$(this).slider({
			animate: ($(this).data('animate'))? $(this).data('animate') : 'fast',
			max: ($(this).data('max'))? $(this).data('max') : '' ,
			min: ($(this).data('min'))? $(this).data('min') : 0,
			orientation: ($(this).data('orientation'))? $(this).data('orientation') : 'horizontal',
			range: ($(this).data('range'))? $(this).data('range') : false,
			step: ($(this).data('step'))? $(this).data('step') : 1,
			value: ($(this).data('value'))? $(this).data('value') : 0,
			slide: function(event, ui) { 
			    $(this).closest('.sliderMetaboxContainer').find('.inputSliderMetabox').val(ui.value);
			    $(this).closest('.sliderMetaboxContainer').find('.showSliderValue').text(ui.value);
			},
		});
	});
	/* Slider End */
	/* Embed Start */
	$('.embedButton').live('click', function(){
		$(this).closest('.embedContainer').find('.embedIframe').html($(this).closest('.embedContainer').find('.embed').val());
	});
	/* Embed End */
	// Get array of repeater fields container Number
	var count = gs_metabox.count_repeat;
	// when choose on radio button
	$(document).on("click",".elementContent input[type='radio']",function(e){
	    e.stopPropagation();
	    $(this).closest('.elementContent').find('input[type="radio"]').each(function(){
	        $(this).removeAttr('checked');
	    });
	    $(this).attr('checked','checked');
	});
	/* Add New Repeat Box Start */
	$(".addNewMeta").unbind('click').click(function(e) {
	    var number_repeat = $(this).data('number');
	    var number_metabox = $(this).data('number_metabox');
	    /* remove all checked radio Button before clone and return value after clone Start */
	    var radioIndex;
	    if($(this).closest('.containerAddNew').find('.contentRepeater .repeaterWrapper').first().find('input[type="radio"]').length > 0 ){
	        $(this).closest('.containerAddNew').find('.contentRepeater .repeaterWrapper').first().find('input[type="radio"]').each(function(index){
	            if($(this).attr('checked') == 'checked'){
	                radioIndex = index;
	                $(this).removeAttr('checked');
	            }
	        });
	    }
	    // clone fields to new item
	    $(this).closest('.containerAddNew').find('.contentRepeater .repeaterWrapper').first().clone().fadeIn('slow').appendTo($(this).closest('.containerAddNew').find('.contentRepeater'));
	    // return value of radio button
	    if($(this).closest('.containerAddNew').find('.contentRepeater .repeaterWrapper').first().find('input[type="radio"]').length > 0 ){
	        $(this).closest('.containerAddNew').find('.contentRepeater .repeaterWrapper').first().find('input[type="radio"]').eq(radioIndex).attr('checked','checked');
	    }
	    /* remove all checked radio Button before clone and return value after clone End */
	    // Remove all data in new repeate box and add number of array
	    $(this).closest('.containerAddNew').find('.contentRepeater .repeaterWrapper').last().find('*').each(function(){
	        if($(this).parent().attr('class') == 'galleryImages'){
	        	$(this).remove();
	        }else if($(this).attr('class') == 'removeImage'){
	        	$(this).parents('.imageUploadMeta').find('.metaboxImage').css({'display':'none'});
	        }else if($(this).attr('type') == 'text' || $(this).attr('type') == 'hidden' || $(this).attr('class') == 'textarea' || $(this).attr('type') == 'url' || $(this).attr('type') == 'email'){
	           $(this).val('');
	        }else if($(this).attr('type') == 'checkbox' ){
	            $(this).removeAttr('checked');
	        }else if($(this).attr('class') == 'select' ){
	            $(this).find('option').removeAttr('selected');
	        }else if($(this).attr('class') == 'embedIframe' ){
	            $(this).html('');
	        }
       		var attrID = '';
       		var attrName = '';
       		var attrFor = '';
       		var attrEditor = '';
       		var attrTarget = '';
	        if($(this).attr('id') != '' && $(this).attr('id') != undefined ){
	           attrID += $(this).attr('id').replace(/-[0-9]+-/g, '-' + count[number_metabox][number_repeat] +'-');
	           $(this).attr('id', attrID.replace(/[[][0-9]+]/g, '[' + count[number_metabox][number_repeat] +']'));
	        }
	        if($(this).attr('name') != '' && $(this).attr('name') != undefined ){
	           attrName += $(this).attr('name').replace(/-[0-9]+-/g, '-' + count[number_metabox][number_repeat] +'-');
	           $(this).attr('name', attrName.replace(/[[][0-9]+]/g, '[' + count[number_metabox][number_repeat] +']'));
	        }
	        if($(this).attr('for') != '' && $(this).attr('for') != undefined ){
	           attrFor += $(this).attr('for').replace(/-[0-9]+-/g, '-' + count[number_metabox][number_repeat] +'-');
	           $(this).attr('for', attrFor.replace(/[[][0-9]+]/g, '[' + count[number_metabox][number_repeat] +']'));
	        }
	        if($(this).attr('data-editor') != '' && $(this).attr('data-editor') != undefined ){
	           attrEditor += $(this).attr('data-editor').replace(/-[0-9]+-/g, '-' + count[number_metabox][number_repeat] +'-');
	           $(this).attr('data-editor', attrEditor);
	        }
	        if($(this).attr('data-target') != '' && $(this).attr('data-target') != undefined ){
	           attrEditor += $(this).attr('data-target').replace(/-[0-9]+-/g, '-' + count[number_metabox][number_repeat] +'-');
	           $(this).attr('data-target', attrEditor);
	        }
	        
	    });
	    count[number_metabox][number_repeat]++; // increment to replace number another new attribute
	    // Add New Color Picker 
	    $('.gs-color').wpColorPicker();
	    // Add New Date Picker
	    $(this).closest('.containerAddNew').find('.repeaterWrapper').last().find('.datepicker').each(function(){
	    	$(this).removeClass('hasDatepicker');
			$(this).datepicker({
				dateFormat: ($(this).data('date_format') != '')? $(this).data('date_format') : 'yy/mm/dd'
			});
	    });
	    // Add New Date Time Picker
	     $(this).closest('.containerAddNew').find('.repeaterWrapper').last().find('.datetimepicker').each(function(){
	     	$(this).removeClass('hasDatepicker');
	     	var time_zone = '';
			if($(this).data('time_zone') == true ){
				time_zone = 'z';
			}else{
				time_zone = '';
			}
	     	$(this).datetimepicker({
				dateFormat: ($(this).data('date_format') != '')? $(this).data('date_format') : 'yy/mm/dd',
				timeFormat: ($(this).data('time_format') != '')? $(this).data('time_format') + time_zone : 'hh:mm tt' + time_zone 
			});
	     });
	     // Add New Time Picker
	     $(this).closest('.containerAddNew').find('.repeaterWrapper').last().find('.timepicker').each(function(){
	     	$(this).removeClass('hasDatepicker');
	     	var time_zone = '';
			if($(this).data('time_zone') == true ){
				time_zone = 'z';
			}else{
				time_zone = '';
			}
			$(this).timepicker({
				timeFormat: ($(this).data('time_format') != '')? $(this).data('time_format') + time_zone : 'hh:mm tt' + time_zone
			});
		});
		// Add New Number
	    $(this).closest('.containerAddNew').find('.repeaterWrapper').last().find('.numberType').each(function(){
	    	$(this).removeClass('ui-spinner-input');
	    	$(this).spinner();
	    });
	    $(this).closest('.containerAddNew').find('.repeaterWrapper').last().find('.ui-spinner .ui-spinner').each(function(){
	    	$(this).prependTo($(this).closest('.contentMetaDesc'));
	    });
	    // Add New DropDown
	    $(this).closest('.containerAddNew').find('.repeaterWrapper').last().find('.selectMetabox').each(function(){
	    	$(this).siblings().remove();
	    	$(this).select2();
	    	$(this)[0].selectedIndex = 0;
		    $(this).select2('val', $(this).val());
	    });
	     $(this).closest('.containerAddNew').find('.repeaterWrapper').last().find('.multiSelect').each(function(){
	    	$(this)[0].selectedIndex = -1;
		    $(this).select2('val', $(this).val());
	    });
	    // Add New tinyMCE
	    $(this).closest('.containerAddNew').find('.repeaterWrapper').last().find('.mce-tinymce').each(function(){
	    	var textarea_id = $(this).parent().find('textarea').attr('id');
	    	var textarea_name = $(this).parent().find('textarea').attr('name');
	    	//console.log(textarea_id);
	    	$(this).closest('.tinymceContentMetaDesc').addClass('here');
	    	$(this).parent().find('textarea').remove();
	    	$(this).remove();
	    	var i = 0;
	    	while($.inArray(textarea_id,textarea_id_tinymce) != -1){
	    		textarea_id = textarea_id.replace(/-[0-9]+-/g, '-' + i +'-');
	    		i++;
	    	}
	    	textarea_id_tinymce[textarea_id_tinymce.length] = textarea_id;
    		$('.tinymceContentMetaDesc.here').append('<textarea id="'+ textarea_id +'" name="'+ textarea_name +'" style="min-height: 200px;"></textarea>');
	    	$('.tinymceContentMetaDesc.here').removeClass('here');
			tinymce.init({
				height : 300,
				falseblock_formats: "Paragraph=p;Pre=pre;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6",
				body_class: textarea_id + " post-type-post post-status-publish post-format-standard locale-en-us",
				style_formats:[{title: "Paragraph", format: "p"}],
				browser_spellcheck: true,
				content_css: [gs_metabox.includes + "css/dashicons.min.css?ver=4.1.1", gs_metabox.includes + "js/tinymce/skins/wordpress/wp-content.css?ver=4.1.1"],
				language: "en",
				menubar: false,
				plugins: "charmap,colorpicker,hr,lists,media,paste,tabfocus,textcolor,fullscreen,wpautoresize,wpeditimage,wpgallery,wplink,wpdialogs,wpview",
				toolbar1: "newdocument | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | hr removeformat | subscript superscript | charmap | print fullscreen | styleselect formatselect fontselect fontsizeselect",
		        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
		        toolbar3: "table | emoticons ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
				preview_styles: "font-family font-size font-weight font-style text-decoration text-transform",
				relative_urls: false,
				remove_script_host: false,
				resize: "vertical",
				selector: '#'+ textarea_id,
				fontsize_formats: "10px 12px 14px 16px 24px 26px 28px 30px 32px 34px 36px",
				font_formats: "Andale Mono=andale mono,times;"+
					        "Arial=arial,helvetica,sans-serif;"+
					        "Arial Black=arial black,avant garde;"+
					        "Book Antiqua=book antiqua,palatino;"+
					        "Comic Sans MS=comic sans ms,sans-serif;"+
					        "Courier New=courier new,courier;"+
					        "Georgia=georgia,palatino;"+
					        "Helvetica=helvetica;"+
					        "Impact=impact,chicago;"+
					        "Symbol=symbol;"+
					        "Tahoma=tahoma,arial,helvetica,sans-serif;"+
					        "Terminal=terminal,monaco;"+
					        "Times New Roman=times new roman,times;"+
					        "Trebuchet MS=trebuchet ms,geneva;"+
					        "Verdana=verdana,geneva;"+
					        "Webdings=webdings;"+
					        "Wingdings=wingdings,zapf dingbats;",
				skin: "lightgray",
				theme: "modern",
				force_p_newlines : true,
				forced_root_block : 'p',
			});
		 });
	    // Add New Slider
	    $(this).closest('.containerAddNew').find('.repeaterWrapper').last().find('.sliderMetabox').each(function(){
	    	$(this).removeClass('ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all');
	    	$(this).slider({
				animate: ($(this).data('animate'))? $(this).data('animate') : 'fast',
				max: ($(this).data('max'))? $(this).data('max') : '' ,
				min: ($(this).data('min'))? $(this).data('min') : 0,
				orientation: ($(this).data('orientation'))? $(this).data('orientation') : 'horizontal',
				range: ($(this).data('range'))? $(this).data('range') : false,
				step: ($(this).data('step'))? $(this).data('step') : 1,
				value: ($(this).data('value'))? $(this).data('value') : 0,
				slide: function(event, ui) { 
				    $(this).closest('.sliderMetaboxContainer').find('.inputSliderMetabox').val(ui.value);
				    $(this).closest('.sliderMetaboxContainer').find('.showSliderValue').text(ui.value);
				}
		    });
		    $(this).closest('.sliderMetaboxContainer').find('.inputSliderMetabox').val(0);
		    $(this).closest('.sliderMetaboxContainer').find('.showSliderValue').text(0);
		    $(this).slider( "option", "value", 0 );
		});
		$(this).closest('.containerAddNew').find('.repeaterWrapper').last().find('.ui-spinner').last().remove();
		$(this).closest('.containerAddNew').find('.repeaterWrapper').last().find('.contentMetaDesc > .wp-picker-container > .wp-color-result').css({"display": 'none'});
		console.log(count[number_metabox][0]);
	});
	/* Add New Repeat Box End */
	/* Remove Repeat Box Start */
	$(".removeMeta").live('click', function() {
		var number_repeat = $(this).data('number');
		var number_metabox = $(this).data('number_metabox');
		$(this).closest('.containerAddNew').addClass('removeFromThisContainer');
		// This Conditian to stop remove last repeat box 
	    if(count[number_metabox][number_repeat] >= 2){
	        $(this).parent().slideUp("normal", function() {
	            $(this).remove();
	            count[number_metabox][number_repeat] = 0;
	            // Rearrang array of repeat box
	            $('.containerAddNew.removeFromThisContainer').find('.contentRepeater .repeaterWrapper').each(function(){
	                $(this).find('*').each(function(){
	                    var attrID = '';
	                    var attrName = '';
	                    var attrFor = '';
				        var attrEditor = '';
				        var attrTarget = '';
	                    if($(this).attr('id') != '' && $(this).attr('id') != undefined ){
	                       	attrID += $(this).attr('id').replace(/-[0-9]+-/g, '-' + count[number_metabox][number_repeat] +'-');
	                    	$(this).attr('id', attrID.replace(/[[][0-9]+]/g, '[' + count[number_metabox][number_repeat] +']'));
	                    }
	                    if($(this).attr('name') != '' && $(this).attr('name') != undefined ){
	                        attrName += $(this).attr('name').replace(/-[0-9]+-/g, '-' + count[number_metabox][number_repeat] +'-');
	                        $(this).attr('name', attrName.replace(/[[][0-9]+]/g, '[' + count[number_metabox][number_repeat] +']'));
	                    }
	                    if($(this).attr('for') != '' && $(this).attr('for') != undefined ){
	                       attrFor += $(this).attr('for').replace(/-[0-9]+-/g, '-' + count[number_metabox][number_repeat] +'-');
	                       $(this).attr('for', attrFor.replace(/[[][0-9]+]/g, '[' + count[number_metabox][number_repeat] +']'));
	                    }
	                    if($(this).attr('data-editor') != '' && $(this).attr('data-editor') != undefined ){
				           attrEditor += $(this).attr('data-editor').replace(/-[0-9]+-/g, '-' + count[number_metabox][number_repeat] +'-');
				           $(this).attr('data-editor', attrEditor);
				        }
				        if($(this).attr('data-target') != '' && $(this).attr('data-target') != undefined ){
				           attrEditor += $(this).attr('data-target').replace(/-[0-9]+-/g, '-' + count[number_metabox][number_repeat] +'-');
				           $(this).attr('data-target', attrEditor);
				        }
	                });
	                count[number_metabox][number_repeat]++;
	                $('.containerAddNew.removeFromThisContainer').removeClass('removeFromThisContainer');
	            });
	        });
	    }else{
	        //alert('you cannot remove all fields');
	        $(this).closest('.containerAddNew').find('.contentRepeater .repeaterWrapper').last().find('*').each(function(){
		        if($(this).parent().attr('class') == 'galleryImages'){
		        	$(this).remove();
		        }else if($(this).attr('class') == 'removeImage'){
		        	$(this).click();
		        }else if($(this).attr('class') == 'wp-color-result'){
		        	$(this).css({'background': 'none'});
		        }else if($(this).attr('class') == 'gs-color'){
		        	$(this).val('');
		        }else if($(this).attr('type') == 'radio' ){
		        	$(this).removeAttr('checked');
		        }else if($(this).attr('type') == 'text' || $(this).attr('type') == 'hidden'  || $(this).attr('class') == 'textarea' || $(this).attr('type') == 'url' || $(this).attr('type') == 'email'){
		           $(this).val('');
		        }else if($(this).attr('type') == 'checkbox' ){
		            $(this).removeAttr('checked');
		        }else if($(this).hasClass('select') ){
		           	$(this)[0].selectedIndex = 0;
		           	$(this).select2('val', $(this).val());
		        }else if($(this).attr('class') == 'embedIframe' ){
		            $(this).html('');
		        }else if($(this).hasClass('sliderMetabox')){
				    $(this).closest('.sliderMetaboxContainer').find('.inputSliderMetabox').val(0);
				    $(this).closest('.sliderMetaboxContainer').find('.showSliderValue').text(0);
				    $(this).slider( "option", "value", 0 );
		        }
		        if($(this).hasClass('multiSelect') ){
		           	$(this)[0].selectedIndex = -1;
		    		$(this).select2('val', $(this).val());
		        }
		        
	        });
	        $('.containerAddNew.removeFromThisContainer').removeClass('removeFromThisContainer');
		}
	});
	/* Remove Repeat Box End */
});