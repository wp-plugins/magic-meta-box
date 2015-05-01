/*
 * Attaches the image uploader to the input field
 */
jQuery(document).ready(function($){
 
    // Instantiates the variable that holds the media library frame.
    var meta_file_frame;
    // Runs when the image button is clicked.
    $('.meta-file-button').live('click', function(e){
 		$this = $(this);
 		console.log('here');
        // Prevents the default action from occuring.
        e.preventDefault();
 
        // If the frame already exists, re-open it.
        if ( meta_file_frame ) {
            meta_file_frame.open();
            return;
        }
        // Sets up the media library frame
        meta_file_frame = wp.media.frames.meta_file_frame = wp.media({
            title: meta_file.title,
            button: { text:  meta_file.button },
        });
        // Runs when an image is selected.
        meta_file_frame.on('select', function(){
            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_file_frame.state().get('selection').first().toJSON();
            // Sends the attachment URL to our custom image input field.
            $this.parents('.imageUploadMeta').find('.holdURL').val(media_attachment.url);
            $this.parents('.imageUploadMeta').find('.holdID').val(media_attachment.id);
            $this.parents('.imageUploadMeta').find('.holdTitle').val(media_attachment.title);
            $this.parents('.imageUploadMeta').find('.holdAlt').val(media_attachment.alt);
            $this.parents('.imageUploadMeta').find('.holdEditLink').val(media_attachment.editLink);
            $this.parents('.imageUploadMeta').find('img').attr('src', media_attachment.url);
            var str = media_attachment.url;
            if (str.match(".jpg$") || str.match(".jpeg$") || str.match(".png$") || str.match(".gif$") ) {
            	$this.parents('.imageUploadMeta').find('img').attr('src', media_attachment.url);
            }else if(str.match(".mp4$") || str.match(".webm$") || str.match(".mkv$") || str.match(".flv$") || str.match(".vob$") || str.match(".ogv$") || str.match(".ogg$") || str.match(".drc$") || str.match(".mng$") || str.match(".avi$") || str.match(".mov$") || str.match(".wmv$") || str.match(".yuv$") || str.match(".rmvb$") || str.match(".rm$") || str.match(".m4p$") || str.match(".m4v$") || str.match(".mpg$") || str.match(".mp2$") || str.match(".svi$") || str.match(".mxf$") || str.match(".qt$")){
            	$this.parents('.imageUploadMeta').find('img').attr('src', meta_file.video_image);
            }else if(str.match(".mp3$") || str.match(".mpc$") || str.match(".msv$") || str.match(".wav$") || str.match(".mmf$") || str.match(".m4a$") || str.match(".wma$") || str.match(".wv$")){
            	$this.parents('.imageUploadMeta').find('img').attr('src', meta_file.audio_image);
            }else {
            	$this.parents('.imageUploadMeta').find('img').attr('src', meta_file.pdf_image);
            }
            $this.parents('.imageUploadMeta').find('.metaboxImageTitle p').html(media_attachment.title);
            $this.parents('.imageUploadMeta').find('img').parent().css({'display': 'block'});
        });
        // Opens the media library frame.
        meta_file_frame.open();
    });
    //remove Image
    $('.metaboxImage .removeImage').live('click',function(){
    	$(this).parents('.imageUploadMeta').find('.metaboxImageTitle p').html('');	
    	$(this).parents('.imageUploadMeta').find('img').slideUp('normal',function(){
		$this.parents('.imageUploadMeta').find('.metaboxImage').css({'display':'none'});
		$this.parents('.imageUploadMeta').find('.holdURL').val('');
        $this.parents('.imageUploadMeta').find('.holdID').val('');
        $this.parents('.imageUploadMeta').find('.holdTitle').val('');
        $this.parents('.imageUploadMeta').find('.holdAlt').val('');
        $this.parents('.imageUploadMeta').find('.holdEditLink').val('');
	});
    });
});