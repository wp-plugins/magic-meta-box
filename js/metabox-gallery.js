jQuery(document).ready(function($){
	// The click event for the gallery manage button
    $('.manage_gallery').live('click', function() {
    	$this = $(this);
        // Create the shortcode from the current ids in the hidden field
        var gallerysc = '[gallery ids="' + $this.closest('.metaboxGallery').find('.galleryIDs').val() + '"]';
        // Open the gallery with the shortcode and bind to the update event
        wp.media.gallery.edit(gallerysc).on('update', function(g) {
            // We fill the array with all ids from the images in the gallery
            var url_array = [];
            var id_array = [];
            var title_array = [];
            var alt_array = [];
            var edit_array = [];
            $.each(g.models, function(id, img) { 
            	url_array.push(img.attributes.url);
            	id_array.push(img.attributes.id);
            	title_array.push(img.attributes.title);
            	alt_array.push(img.attributes.alt);
            	edit_array.push(img.attributes.editLink); 
            	});
			// Make comma separated list from array and set the hidden value
			$this.closest('.metaboxGallery').find('.galleryURLs').val(url_array.join(","));
            $this.closest('.metaboxGallery').find('.galleryIDs').val(id_array.join(","));
            $this.closest('.metaboxGallery').find('.galleryTitles').val(title_array.join(","));
            $this.closest('.metaboxGallery').find('.galleryAlts').val(alt_array.join(","));
            $this.closest('.metaboxGallery').find('.galleryEdits').val(edit_array.join(","));
            $.ajax({
            	type : "post",
		        dataType : "json",
		        url : gs_meta_Ajax.ajaxurl,
		        data : { action: "gs_meta_gallery", ids : $this.closest('.metaboxGallery').find('.galleryIDs').val() },
		        success: function(response) {
		        	$this.closest('.galleryContainer').find('.galleryImages img').remove();
		        	for(var i = 0 ; i < response.length; i++ ){
		        		$this.closest('.galleryContainer').find('.galleryImages').append('<img src="'+ response[i] +'" class="attachment-thumbnail" alt="Gallery Image">');
		        	}
		        }
            });
            // On the next post this field will be send to the save hook in WP
        });
    });
    $('.clear_gallery').live('click', function() {
    	$this = $(this);
    	$this.closest('.metaboxGallery').find('.galleryIDs').val('');
    	$.ajax({
        	type : "post",
	        dataType : "json",
	        url : gs_meta_Ajax.ajaxurl,
	        data : { action: "gs_meta_gallery", ids : $this.closest('.metaboxGallery').find('.galleryIDs').val() },
	        success: function(response) {
	        	$this.closest('.galleryContainer').find('.galleryImages img').remove();
	        	for(var i = 0 ; i < response.length; i++ ){
	        		if(response[i] != null){
	        			$this.closest('.galleryContainer').find('.galleryImages').append('<img src="'+ response[i] +'" class="attachment-thumbnail" alt="Gallery Image">');
	        		}
	        	}
	        }
        });
    });
});