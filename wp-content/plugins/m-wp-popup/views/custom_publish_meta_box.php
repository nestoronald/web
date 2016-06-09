<div class="submitbox" id="submitpopup">

<div id="misc-publishing-actions">
<div class="misc-pub-section"> 
</div>
</div>


<div id="major-publishing-actions">
	
	<?php if ( $post_status == 'publish'  ): ?>
		<div id="delete-action">
			<a class="submitdelete deletion" href="<?php echo $delete_link ?>">
				<?php echo __( 'Move to Trash', 'wpp' ); ?>
			</a>
		</div>
	<?php endif; ?>
	
	<div id="publishing-action">
		<?php 
			if ( $post_status != 'publish'  ):
				submit_button( __( 'Create Popup', 'wpp' ), 'primary', 'publish', false );
			else:
				submit_button( __( 'Update Popup', 'wpp' ), 'primary', 'submit', false );
			endif;
		?>
	</div>
	
</div>

<div class="clear"></div>

</div>
<input type="hidden" name="post_type_is_wpp_popup" value="yes" />
<input type="hidden" name="wpp_popup_nonce" value="<?php echo $nonce ?>" />