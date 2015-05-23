var $ =jQuery.noConflict();
function showHideMetaBox(){
	var flagMetaBox = new Array();
	var flagMetaBoxcondition = new Array();
	$.each(gs_show_hide.show, function(k, v) {
		flagMetaBox[k] = [];
		flagMetaBoxcondition = [];
	    $('#' + k).hide();
	    if(typeof gs_show_hide.show[k]['template'] !== 'undefined' && gs_show_hide.show[k]['template'].length > 0){
		    for(var i = 0; i < gs_show_hide.show[k]['template'].length; i++){
		    	if($("#page_template").val() == gs_show_hide.show[k]['template'][i]){
			        flagMetaBox[k]['template'] = true;
			    }
		    }
	    }
	    $.each(gs_show_hide.show[k], function( index, value ) {
	    	if(index != 'template' && index != 'post_format' && index != 'relation'){
	    		$('#' + index + 'checklist input[type="checkbox"]').each(function(i,e){
					var id = $(this).attr('id').match(/-([0-9]*)$/i);
					id = (id && id[1]) ? parseInt(id[1]) : null ;
					if ($.inArray(id, gs_show_hide.show[k][index]) > -1 && $(this).is(':checked')){
						flagMetaBox[k][index] = true;
					}
				});
	    	}
		});
		if(typeof gs_show_hide.show[k]['post_format'] !== 'undefined' && gs_show_hide.show[k]['post_format'].length > 0){
			for(var i = 0; i < gs_show_hide.show[k]['post_format'].length; i++){
				if( $( "input#post-format-" + gs_show_hide.show[k]['post_format'][i] ).is(':checked') ){
					flagMetaBox[k]['post_format'] = true;
			    }
			}
		}
		$.each(gs_show_hide.show[k], function(index, value) {
			if(index != 'relation'){
				if(typeof flagMetaBox[k][index] !== 'undefined' && flagMetaBox[k][index] == true){
					flagMetaBoxcondition[0] = true;
				}else {
					flagMetaBoxcondition[1] = false;
				}
			}
		});
		if(typeof flagMetaBoxcondition[1] === 'undefined') {
			flagMetaBoxcondition[1] = true;
		}
		if(typeof flagMetaBoxcondition[0] === 'undefined'){
			flagMetaBoxcondition[0] = false;
		}
		if(gs_show_hide.show[k]['relation'] == 'and'){
			if(flagMetaBoxcondition[0] == true && flagMetaBoxcondition[1] == true){
				$('#' + k).show();
			}
		}else if(gs_show_hide.show[k]['relation'] == 'or'){
			if(flagMetaBoxcondition[0] == true || flagMetaBoxcondition[1] == true){
				$('#' + k).show();
			}
		}

	});
}
$(document).ready(function() {
	var counterShowHide;
	if($('.tableWithTabs').length > 0 && $('.mapMetaboxContainer').length > 0){
		counterShowHide = setInterval(function(){
			if($('.showHideOpen').length > 0){
				showHideMetaBox();
				clearInterval(counterShowHide);
			}
		}, 200);
	}else{
		showHideMetaBox();
	}
	$('#page_template').change(function() {
		showHideMetaBox();
    });
    
    $( "input:radio[name=post_format]" ).change( function() {
    	showHideMetaBox();
    });
	$.each(gs_show_hide.show, function(k, v) {
		$.each(gs_show_hide.show[k], function( index, value ) {
    		if(index != 'template' && index != 'post_format'){
	    		$('#' + index + 'checklist input[type="checkbox"]').live('click', function(){
	    			showHideMetaBox();
				});
	    	}
	   });
	});
});