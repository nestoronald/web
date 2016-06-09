/**
 *
 * Blakzr Framework
 * Admin jQuery
 *
 */

jQuery(document).ready(function(){

	/* ---------- Show/Hide Post Page Meta Boxes ---------- */
	if ( jQuery('#page_template').length ) {
		
		$default_template = jQuery('#page_template option:selected').val();
		jQuery('table[data-template="' + $default_template + '"]').parents('.postbox').show();
		
		jQuery('#page_template').change(function() {
			$default_template = jQuery('#page_template option:selected').val();
			jQuery('#fullwidthtitle-meta').hide();
			jQuery('table[data-template="' + $default_template + '"]').parents('.postbox').show();
		});
		
	}
	
	/* ---------- Show/Hide Post Format Meta Boxes ---------- */
	if ( jQuery('#post-formats-select').length ) {
		
		$default_format = jQuery('#post-formats-select input:checked').val();
		jQuery('#format-' + $default_format + '-meta').show();
		
		jQuery('#post-formats-select input').click(function() {
			$format = jQuery('#post-formats-select input:checked').val();
			jQuery('#format-link-meta, #format-quote-meta, #format-video-meta').hide();
			jQuery('#format-' + $format + '-meta').show();
			
		});
		
	}
	
	/* ---------- Video Format Options ---------- */
	if ( jQuery('#format-video-meta').length ) {
		
		$default_radio = jQuery('#format-video-meta input[type="radio"]:checked').val();
		jQuery('#post_format_video_' + $default_radio).removeAttr('disabled');
		
		jQuery('#format-video-meta input[type="radio"]').each(function() {
			jQuery(this).click(function() {
				jQuery('#format-video-meta input[type="text"]').attr('disabled', 'disabled');
				jQuery('#post_format_video_' + jQuery(this).val()).removeAttr('disabled');
			});
		});
	}
	
	
});