<?php
/**
 *
 * Blakzr Panel - Slider Manager
 * Version: 1.0
 * Author: Harold Coronado
 * Author URI: http://blakzr.com
 *
*/

add_action('admin_menu', 'blakzr_panel_slider_admin_menu');
add_action('admin_init', 'blakzr_panel_slider_admin_init');

$theme_prefix_slider = 'blakzr_slide_';
$panel_sections_slider = array(__('Slides', 'blakzr'));

$panel_options_slider = array(
	array(
		'section' 		=> 0,
		'id' 			=> $theme_prefix_slider . 'homepage_slider',
		'name' 			=> __('Homepage Slider', 'blakzr'),
		'description' 	=> __('Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas', 'blakzr'),
		'type' 			=> 'slider',
		'default' 		=> ''
	)
);

function blakzr_panel_slider_admin_menu(){
	
	global $panel_sections_slider, $panel_options_slider;
	
	if ( isset( $_GET['page'] ) && $_GET['page'] == 'blakzrpanel_slider' ) :
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'save' ) :
			
			foreach ( $panel_options_slider as $option ) {
				// Checks
				if ( $option['type'] == 'check' && $option['default'] == 'true' && ! isset( $_POST[$option['id']] ) ) :
					update_option( $option['id'], 'false' );
					continue;
				endif;
				
				// Slider
				if ( 'slider' == $option[ 'type' ] ) {
					$home_slides = array();
					foreach ( $_POST['url'] as $key => $value ) :
						$home_slides[] = array(
							'url' 			=> $value,
							'title'		 	=> $_POST['title'][$key],
							'description'	=> $_POST['description'][$key],
							'link' 			=> $_POST['link'][$key],
							'caption' 		=> stripslashes( $_POST['caption'][$key] )
						);
					endforeach;
					update_option( $option['id'], $home_slides );
					continue;
				}
				
				if ( isset($_POST[$option['id']] ) && $_POST[$option['id']] != $option['default'] ) :
					update_option( $option['id'], stripslashes($_POST[$option['id']] ) );
				else:
					delete_option( $option['id'] );
				endif;
				
			}
			exit;
		elseif ( isset($_POST['action'] ) && $_POST['action'] == 'reset' ) :
			foreach ( $panel_options_slider as $option ) :  
				delete_option( $option['id'] );
			endforeach;
			header( "Location: themes.php?page=blakzrpanel_slider" );
			die;
		endif;
	endif;
	
	add_theme_page( __( 'Slider', 'blakzr' ), __( 'Slider', 'blakzr' ), 'edit_themes', 'blakzrpanel_slider', 'blakzr_panel_slider' );
	
}

function blakzr_panel_slider(){
	global $panel_sections_slider, $panel_options_slider;
	
	?>
	<div class="wrap">
		<div id="icon-themes" class="icon32">
			<br>
		</div>
		<h2><?php _e('Homepage Slider', 'blakzr'); ?></h2>
		<h3 class="nav-tab-wrapper">
			<?php
			foreach ( $panel_sections_slider as $key => $section ) :
				?>
			<a class="nav-tab<?php echo 0 == $key ? ' nav-tab-active' : ''; ?>" href="#" data-id="<?php echo $key; ?>"><?php echo $section; ?></a>
				<?php
			endforeach;
			?>
		</h3>
		<div id="message-append">
			<div id="top-message" class="updated saved"><p><?php _e('Settings saved', 'blakzr'); ?></p></div>
		</div>
		<div id="blakzr_warp">
			<div class="panelcontent">
				<div class="controls-wrap">
					<table>
						<tr>
							<td>
								<img src="<?php echo get_template_directory_uri(); ?>/img/loader.gif" width="24" height="24" class="saving">
							</td>
							<td>
								<button class="button-primary options-save-slider"><?php _e('Save Changes', 'blakzr'); ?></button>
							</td>
						</tr>
					</table>
				</div>
				<form action="" method="post" id="options_form">
					<input type="hidden" name="action" value="save">
					<table class="form-table" id="options-table">
						<tbody>
				<?php
				foreach( $panel_options_slider as $option ) :
					switch( $option['type'] ) :
						case 'text' :
							?>
							<tr data-id="<?php echo $option['section']; ?>">
								<th scope="row">
									<label for="<?php echo $option['id']; ?>"><?php echo $option['name']; ?></label>
								</th>
								<td>
									<input class="regular-text<?php echo !empty( $option['class'] ) ? ' ' . $option['class'] . '' : ''; ?>" type="text" value="<?php echo stripslashes( get_option( $option['id'], $option['default'] ) ); ?>" id="<?php echo $option['id']; ?>" name="<?php echo $option['id']; ?>"> 
									<p class="option-description">
										<?php echo $option['description']; ?>
									</p>
								</td>
							</tr>
							<?php
							break;
						case 'check' :
							?>
							<tr data-id="<?php echo $option['section']; ?>">
								<th scope="row">
									<?php echo $option['name']; ?>
								</th>
								<td>
									<input type="checkbox" name="<?php echo $option['id']; ?>" value="true" id="<?php echo $option['id']; ?>"<?php echo 'true' == get_option( $option['id'], $option['default'] ) ? ' checked="checked"' : ''; ?>>
									<label for="<?php echo $option['id']; ?>"><?php echo $option['label']; ?></label>
									<p class="option-description">
										<?php echo $option['description']; ?>
									</p>
								</td>
							</tr>
							<?php
							break;
						case 'textarea' :
							?>
							<tr data-id="<?php echo $option['section']; ?>">
								<th scope="row">
									<?php echo $option['name']; ?>
								</th>
								<td>
									<p class="option-description">
										<?php echo $option['description']; ?>
									</p>
									<p>
										<textarea class="large-text code" name="<?php echo $option['id']; ?>" id="<?php echo $option['id']; ?>" rows="10" cols="50"><?php echo stripslashes( get_option( $option['id'], $option['default'] ) ); ?></textarea>
									</p>
								</td>
							</tr>
							<?php
							break;
						case 'select' :
							?>
							<tr data-id="<?php echo $option['section']; ?>">
								<th scope="row">
									<label for="<?php echo $option['id']; ?>"><?php echo $option['name']; ?></label>
								</th>
								<td>
									<?php
									$default = get_option( $option[ 'id' ], $option[ 'default' ] );
									?>
									<select name="<?php echo $option['id']; ?>" id="<?php echo $option['id']; ?>">
									<?php
									foreach ( $option['options'] as $value => $optiontag ) :
									?>
										<option value="<?php echo $value; ?>"<?php echo $default == $value ? ' selected="selected"' : ''; ?>><?php echo $optiontag; ?></option>
									<?php
									endforeach;
									?>
									</select>
									<p class="option-description">
										<?php echo $option['description']; ?>
									</p>
								</td>
							</tr>
							<?php
							break;
						case 'color_picker' :
							?>
							<tr data-id="<?php echo $option['section']; ?>">
								<th scope="row">
									<label for="<?php echo $option['id']; ?>"><?php echo $option['name']; ?></label>
								</th>
								<td>
									<div class="colorchoose" style="background:<?php echo stripslashes( get_option($option['id'], $option['default'] ) ); ?>" data-color="<?php echo stripslashes( get_option( $option['id'], $option['default'] ) ); ?>"></div>
									<input class="color_picker" type="text" name="<?php echo $option['id']; ?>" value="<?php echo stripslashes(get_option($option['id'], $option['default'])); ?>" id="<?php echo $option['id']; ?>">
									<p class="option-description">
										<?php echo $option['description']; ?>
									</p>
								</td>
							</tr>
							<?php
							break;
						case 'upload' :
							?>
							<tr data-id="<?php echo $option['section']; ?>">
								<th scope="row">
									<label for="<?php echo $option['id']; ?>"><?php echo $option['name']; ?></label>
								</th>
								<td>
									<input class="regular-text upload" type="text" name="<?php echo $option['id']; ?>" value="<?php echo stripslashes( get_option( $option['id'], $option['default'] ) ); ?>" id="<?php echo $option['id']; ?>" />
									<input type="button" name="bt_<?php echo $option['id']; ?>" value="<?php _e( 'Upload', 'blakzr' ); ?>" id="bt_<?php echo $option['id']; ?>" />
									<p class="option-description">
										<?php echo $option['description']; ?>
									</p>
								</td>
							</tr>
							<?php
							break;
						case 'image' :
							?>
							<tr data-id="<?php echo $option['section']; ?>">
								<th scope="row">
									<?php echo $option['name']; ?>
								</th>
								<td>
									<p class="option-description">
										<?php echo $option['description']; ?>
									</p>
									<?php
									$default = get_option( $option[ 'id' ], $option[ 'default' ] );
									foreach ( $option[ 'options' ] as $value => $image_option ) :
										$option_value = isset( $image_option[ 'new_value' ] ) ? $image_option[ 'new_value' ] : $value;
									?>
									<div class="imageradio">
										<label for="<?php echo $option[ 'id' ] . '_' . $value; ?>">
											<input type="radio" name="<?php echo $option[ 'id' ]; ?>" value="<?php echo $option_value; ?>" id="<?php echo $option[ 'id' ] . '_' . $value; ?>"<?php echo $default == $option_value ? ' checked="checked"' : ''; ?>>
											<img src="<?php echo $image_option[ 'src' ]; ?>" alt="">
											<span><?php echo $image_option[ 'label' ]; ?></span>
										</label>
									</div>
									<?php
									endforeach;
									?>
								</td>
							</tr>
							<?php
							break;
						case 'color-scheme' :
							?>
							<tr data-id="<?php echo $option['section']; ?>">
								<th scope="row">
									<?php echo $option['name']; ?>
								</th>
								<td>
									<fieldset><legend class="screen-reader-text"><span><?php echo $option['name']; ?></span></legend>
										<?php
										$default = get_option( $option[ 'id' ], $option[ 'default' ] );
										foreach ( $option[ 'options' ] as $value => $color_option ) :
											$option_value = isset( $color_option[ 'new_value' ] ) ? $color_option[ 'new_value' ] : $value;
										?>
										<div class="color-option"><input name="<?php echo $option['id']; ?>" type="radio" value="<?php echo $option_value; ?>" class="tog" id="<?php echo $option[ 'id' ] . '_' . $value; ?>"<?php echo $default == $option_value ? ' checked="checked"' : ''; ?>>
											<table class="color-palette">
												<tr data-id="<?php echo $option['section']; ?>">
													<?php
													foreach ( $color_option['colors'] as $color ) :
													?>
													<td style="background-color: <?php echo $color; ?>" title="<?php echo $color_option['name']; ?>">&nbsp;</td>
													<?php
													endforeach;
													?>
												</tr>
											</table>
											<label for="<?php echo $option[ 'id' ] . '_' . $value; ?>"><?php echo $color_option['name']; ?></label>
										</div>
										<?php
										endforeach;
										?>
									</fieldset>
								</td>
							</tr>
							<?php
							break;
						case 'slider' :
							?>
							<tr data-id="<?php echo $option['section']; ?>">
								<td>
									<ul id="blakzr_slider">
									<?php if ( get_option( $option['id'] ) ) : $home_slides = get_option( $option['id'] ); ?>
										<?php foreach( $home_slides as $key => $slide ) : ?>
										<li class="homeslide">
											<?php
												if ( is_numeric( $slide['url'] ) ) :
													$the_image = wp_get_attachment_image_src( $slide['url'], 'medium' );
												else:
													$the_image = array();
												endif;
											?>
											<div class="slide-image<?php echo '' != $slide['url'] ? ' over-image' : ''; ?>" style="background-image: url('<?php echo $the_image[0]; ?>')">
												<span><?php _e( 'Click here to add an image', 'blakzr' ); ?></span>
												<span><?php _e( 'Click to change image', 'blakzr' ); ?></span>
												<input class="image-url" type="hidden" name="url[]" id="img_url" value="<?php echo $slide['url']; ?>">
											</div>
											<div class="slide-options">
												<label><?php _e('Caption', 'blakzr'); ?></label>
												<input class="regular-text" type="text" name="caption[]" id="slide_caption" value="<?php echo $slide['caption'] ?>">
												<label><?php _e('Title', 'blakzr'); ?></label>
												<input class="regular-text" type="text" name="title[]" id="slide_title" value="<?php echo $slide['title'] ?>">
												<label><?php _e('Description', 'blakzr'); ?></label>
												<input class="regular-text" type="text" name="description[]" id="slide_description" value="<?php echo $slide['description'] ?>">
												<label><?php _e('Link', 'blakzr'); ?></label>
												<input class="regular-text" type="text" name="link[]" id="img_link" value="<?php echo $slide['link']; ?>">
												<button class="remove button-secondary"><?php _e('Remove', 'blakzr')?></button>
											</div>
										</li>
										<?php endforeach; ?>
									<?php else: ?>
										<li class="homeslide">
											<div class="slide-image">
												<span><?php _e( 'Click here to add an image', 'blakzr' ); ?></span>
												<span><?php _e( 'Click to change image', 'blakzr' ); ?></span>
												<input type="hidden" name="url[]" id="img_url">
											</div>
											<div class="slide-options">
												<label><?php _e('Caption', 'blakzr'); ?></label>
												<input class="regular-text" type="text" name="caption[]" id="slide_caption">
												<label><?php _e('Title', 'blakzr'); ?></label>
												<input class="regular-text" type="text" name="title[]" id="slide_title">
												<label><?php _e('Description', 'blakzr'); ?></label>
												<input class="regular-text" type="text" name="description[]" id="slide_description">												
												<label><?php _e('Link', 'blakzr'); ?></label>
												<input class="regular-text" type="text" name="link[]" id="img_link">
												<button class="remove button-secondary"><?php _e('Remove', 'blakzr')?></button>
											</div>
										</li>
									<?php endif; ?>
									</ul>
								</td>
							</tr>
							<?php
							break;
					endswitch;
				endforeach;
				?>
						</tbody>
					</table>
				</form>
				<div class="controls-wrap lower">
					<table>
						<tr>
							<td>
								<form id="options_reset" method="post">  
									<div class="innerbox" style="text-align:right;">
										<input type="hidden" name="action" value="reset" />
										<input class="button" type="submit" value="<?php _e('Reset Settings', 'blakzr'); ?>" name="submit" />
									</div>
								</form>
							</td>
							<td>
								<img src="<?php echo get_template_directory_uri(); ?>/img/loader.gif" width="24" height="24" class="saving">
							</td>
							<td>
								<button class="button-primary options-save-slider"><?php _e('Save Changes', 'blakzr'); ?></button>
							</td>
						</tr>
					</table>
				</div>
			</div><!-- .panelcontent -->
		</div><!-- #blakzr_warp -->
	</div>
	<?php
}

function blakzr_panel_slider_admin_init() {
	
	if ( isset( $_GET['page'] ) && $_GET['page'] == 'blakzrpanel_slider' ) {

		wp_enqueue_style('thickbox');
		wp_enqueue_style('blakzrpanel_style', get_bloginfo('template_url') . '/css/blakzrpanel.css', false, '1.0', 'all');
		wp_enqueue_style('colorpicker_css', get_bloginfo('template_url') . '/js/colorpicker.css', false, '1.0', 'all');
		
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-appendo', get_bloginfo('template_url') . '/js/jquery.appendo.js', false, '1.01', false);
		wp_enqueue_script('colorpicker_js', get_bloginfo('template_url') . '/js/colorpicker.js', false, '1.0', false);
		wp_enqueue_script('blakzrpanel_js', get_bloginfo('template_url') . '/js/blakzrpanel.js', false, '1.0', false);
		
	}
	
}

?>