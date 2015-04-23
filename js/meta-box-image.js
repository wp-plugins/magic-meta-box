/*
 * Attaches the image uploader to the input field
 */
jQuery(document).ready(function($){
    // Instantiates the variable that holds the media library frame.
    var meta_image_frame;
    // Runs when the image button is clicked.
    $('.meta-image-button').live('click', function(e){
 		$this = $(this);
        // Prevents the default action from occuring.
        e.preventDefault();
        // If the frame already exists, re-open it.
        if ( meta_image_frame ) {
            meta_image_frame.open();
            return;
        }
        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' },
        });
        // Runs when an image is selected.
        meta_image_frame.on('select', function(){
            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
            // Sends the attachment URL to our custom image input field.
            $this.parents('.imageUploadMeta').find('.holdURL').val(media_attachment.url);
            $this.parents('.imageUploadMeta').find('.holdID').val(media_attachment.id);
            $this.parents('.imageUploadMeta').find('.holdTitle').val(media_attachment.title);
            $this.parents('.imageUploadMeta').find('.holdAlt').val(media_attachment.alt);
            $this.parents('.imageUploadMeta').find('.holdEditLink').val(media_attachment.editLink);
            $this.parents('.imageUploadMeta').find('img').attr('src', media_attachment.url);
            $this.parents('.imageUploadMeta').find('img').parent().css({'display': 'block'});
        });
        // Opens the media library frame.
        meta_image_frame.open();
    });
    //remove Image
    $('.metaboxImage .removeImage').live('click',function(){
    	$(this).parents('.imageUploadMeta').find('img').slideUp('normal',function(){
    		$(this).parents('.imageUploadMeta').find('.metaboxImage').css({'display':'none'});
    		$(this).parents('.imageUploadMeta').find('.holdURL').val('');
            $(this).parents('.imageUploadMeta').find('.holdID').val('');
            $(this).parents('.imageUploadMeta').find('.holdTitle').val('');
            $(this).parents('.imageUploadMeta').find('.holdAlt').val('');
            $(this).parents('.imageUploadMeta').find('.holdEditLink').val('');
    	});
    });
});