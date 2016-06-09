<?php
/**
 *
 * Blakzr Panel
 * Version: 1.0
 * Author: Harold Coronado
 * Author URI: http://blakzr.com
 *
*/

add_action( 'admin_menu', 'blakzr_panel_admin_menu' );
add_action( 'admin_init', 'blakzr_panel_admin_init' );

$theme_prefix = 'blakzr_';
$panel_sections = array(
					__( 'General', 'blakzr' ),
					//__( 'Diseño', 'blakzr' ),
					__( 'Cabecera', 'blakzr' ),
					//__( 'Blog', 'blakzr' ),
					//__( 'Redes Sociales', 'blakzr' ),
					//__( 'Footer', 'blakzr' )
				);

$panel_options = array(
	array(
		'section'		=> 0,
		'id'			=> $theme_prefix . 'rss_url',
		'name'			=> __( 'RSS personalizado', 'blakzr' ),
		'description'	=> __( 'Pegue la URL de su RSS personalizado (example: una URL de FeedBurner).', 'blakzr' ),
		'type'			=> 'text',
		'default'		=> '',
		'class'			=> 'regular-text'
	),
	array(
		'section'		=> 0,
		'id'			=> $theme_prefix . 'favicon_url',
		'name'			=> __('Favicon', 'blakzr'),
		'description'	=> __('Pegue la URL del ícono aquí o suba uno nuevo.', 'blakzr'),
		'type'			=> 'upload',
		'default'		=> '',
		'class'			=> 'regular-text'
	),
	array(
		'section'		=> 0,
		'id'			=> $theme_prefix . 'tracking_code',
		'name'			=> __('Código de Seguimiento', 'blakzr'),
		'description'	=> __('Pegue aquí cualquier código de seguimiento para su sitio. Este código será usado en cada página. Por ejemplo, si usted usa Google Analytics, pegue su código de Analytics aquí.', 'blakzr'),
		'type'			=> 'textarea',
		'default'		=> ''
	),
	array(
		'section' 		=> 0,
		'id' 			=> $theme_prefix . 'contact_email',
		'name' 			=> __('Email de destino', 'blakzr'),
		'description' 	=> __('Ingrese la dirección de email para recebir los mensajes enviados por sus usuarios a través de las plantillas de Contacto.', 'blakzr'),
		'label' 		=> __('Ingrese la dirección de email', 'blakzr'),
		'type' 			=> 'text',
		'default' 		=> get_option('admin_email'),
		'class' 		=> 'regular-text'
	),
	array(
		'section' 		=> 1,
		'id' 			=> $theme_prefix . 'topbar_slogan',
		'name' 			=> __('Frase superior', 'blakzr'),
		'description' 	=> __('Frase de la franja superior en la cabecera', 'blakzr'),
		'label' 		=> __('Ingrese frase', 'blakzr'),
		'type' 			=> 'text',
		'default' 		=> 'Año de la inversión para el desarrollo rural y la seguridad alimentaria',
		'class' 		=> 'regular-text'
	),
	array(
		'section' 		=> 1,
		'id' 			=> $theme_prefix . 'header_title',
		'name' 			=> __('Título (H1)', 'blakzr'),
		'description' 	=> __('Título principal de la cabecera', 'blakzr'),
		'label' 		=> __('Ingrese el título', 'blakzr'),
		'type' 			=> 'text',
		'default' 		=> 'Bienvenidos a CENEPRED',
		'class' 		=> 'regular-text'
	),
	array(
		'section' 		=> 1,
		'id' 			=> $theme_prefix . 'header_description',
		'name' 			=> __('Descripción', 'blakzr'),
		'description' 	=> __('Descripción para la cabecera', 'blakzr'),
		'label' 		=> __('Ingrese la descripción', 'blakzr'),
		'type' 			=> 'textarea',
		'default' 		=> 'El CENEPRED es un organismo público ejecutor que conforma el Sistema Nacional de Gestión de Riesgo de Desastres.',
		'class' 		=> 'regular-text'
	),
	array(
		'section' 		=> 4,
		'id' 			=> $theme_prefix . 'blog_name',
		'name' 			=> __('Título del Blog', 'blakzr'),
		'description' 	=> __('Título principal del Blog', 'blakzr'),
		'label' 		=> __('Ingrese el título', 'blakzr'),
		'type' 			=> 'text',
		'default' 		=> 'Blog',
		'class' 		=> 'regular-text'
	),
	array(
		'section' 		=> 4,
		'id' 			=> $theme_prefix . 'blog_subtitle',
		'name' 			=> __('Subtítulo del Blog', 'blakzr'),
		'description' 	=> __('Subítulo para el Blog', 'blakzr'),
		'label' 		=> __('Ingrese el subtítulo', 'blakzr'),
		'type' 			=> 'text',
		'default' 		=> 'Opinión y actualidad sobre el mundo del Diseño Web',
		'class' 		=> 'regular-text'
	)
);

function blakzr_panel_admin_menu(){
	global $panel_sections, $panel_options;
	if ( isset( $_GET['page'] ) && $_GET['page'] == 'blakzrpanel' ) :
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'save' ) :
			
			foreach( $panel_options as $option ) {
				// Checks
				if ( 'check' == $option['type'] && 'true' == $option['default'] && ! isset( $_POST[$option['id']] ) ) :
					update_option( $option['id'], 'false' );
					continue;
				endif;
				
				// Category Arrange
				if ( 'category-arrange' == $option[ 'type' ] ) {
					$cat_items = array();
					foreach( $_POST['category_id'] as $key => $value ) :
						$cat_items[] = array(
							'id'		=> $value,
							'name'		=> $_POST['category_name'][$key]
						);
					endforeach;
					update_option( $option['id'], $cat_items );
					continue;
				}
				
				if ( isset( $_POST[$option['id']] ) && $_POST[$option['id']] != $option['default'] ) :
					update_option( $option['id'], stripslashes( $_POST[$option['id']] ) );
				else:
					delete_option( $option['id'] );
				endif;
				
			}
			exit;
		elseif ( isset( $_POST['action'] ) && $_POST['action'] == 'reset' ) :
			foreach ( $panel_options as $option ) :
				delete_option( $option['id'] );
			endforeach;
			header( "Location: themes.php?page=blakzrpanel" );
			die;
		endif;
	endif;
	
	add_theme_page( __( 'Theme Options', 'blakzr' ), __( 'Opciones del Tema', 'blakzr' ), 'edit_themes', 'blakzrpanel', 'blakzr_panel_content');
	
	// Add menu link to the admin bar
	function blakzrpanel_add_admin_menu() {
		global $wp_admin_bar;
		$wp_admin_bar->add_menu( array(
			'parent'	=>	'appearance',
			'id'		=>	'blakzrpanel',
			'title'		=>	__( 'Opciones del Tema', 'blakzr' ),
			'href'		=>	admin_url( 'themes.php?page=blakzrpanel' ),
			'meta'		=>	false
		));
	}
	add_action( 'wp_before_admin_bar_render', 'blakzrpanel_add_admin_menu' );
	
}

function blakzr_panel_content(){
	global $panel_sections, $panel_options;
	
	?>
	<div class="wrap">
		<div id="icon-themes" class="icon32">
			<br>
		</div>
		<h2><?php _e('Opciones del Tema', 'blakzr'); ?></h2>
		<h3 class="nav-tab-wrapper">
			<?php
			foreach( $panel_sections as $key => $section ) :
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
								<button class="button-primary options-save"><?php _e('Guardar Cambios', 'blakzr'); ?></button>
							</td>
						</tr>
					</table>
				</div>
				<form action="" method="post" id="options_form">
					<input type="hidden" name="action" value="save">
					<table class="form-table" id="options-table">
						<tbody>
				<?php
				foreach( $panel_options as $option ) :
					switch( $option['type'] ) :
						case 'subtitle' :
							?>
							<tr data-id="<?php echo $option['section']; ?>">
								<td>
									<h3 class="title"><?php echo $option['name']; ?></h3>
								</td>
							</tr>
							<?php
							break;
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
									<input type="button" class="button" name="bt_<?php echo $option['id']; ?>" value="<?php _e( 'Upload', 'blakzr' ); ?>" id="bt_<?php echo $option['id']; ?>" />
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
						case 'wpeditor' :
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
										<?php
										wp_editor( $option['default'], $option['id'], $settings = array( 'teeny' => true, 'media_buttons' => false ) );
										?>
									</p>
								</td>
							</tr>
							<?php
							break;
						case 'category-arrange' :
							?>
							<tr data-id="<?php echo $option['section']; ?>">
								<th scope="row">
									<label for="<?php echo $option['id']; ?>"><?php echo $option['name']; ?></label>
								</th>
								<td>
									<p class="option-description">
										<?php echo $option['description']; ?>
									</p>
									<style type="text/css">
										#cat-sortable li:nth-child(-n+<?php echo get_option( 'blakzr_home_cat_number', 8 ); ?>) {
											color: #333;
										}
									</style>
									<ul id="cat-sortable">
										<?php
										if ( get_option( $option['id'] ) ) :
											// Get categoris from database
											$cat_items = get_option( $option['id'] );
											$cat_items_q = count( $cat_items );
											// Store all available categories
											$all_cats = get_categories( array( 'order' => 'DESC', 'orderby' => 'count' ) );
											$all_cats_filtered = array();
											$new_cat_order = array();
											
											foreach ( $all_cats as $cat ) :
												$all_cats_filtered[] = array( 'id' => $cat->term_id, 'name' => $cat->name );
											endforeach;
											$all_cats_filtered_q = count( $all_cats_filtered );
											
											if ( $all_cats_filtered_q > $cat_items_q ) :
												
												foreach ( $all_cats_filtered as $key1 => $allcat ) :
													$i = 0;
													foreach ( $cat_items as $key2 => $cat ) :
														if ( $allcat['id'] != $cat['id'] ) $i++;
														if ( $i == $cat_items_q )
															$new_cat_order[] = array( 'id' => $allcat['id'], 'name' => $allcat['name'] );
													endforeach;
												endforeach;
												
												foreach ( $new_cat_order as $key => $cat ) :
													$cat_items[] = array( 'id' => $cat['id'], 'name' => $cat['name'] );
												endforeach;
												
											endif;
																						
											// Display category list
											foreach( $cat_items as $key => $cat ) :
												$cat_data = get_category( $cat['id'] );
										?>
										<li id="<?php echo $cat['id']; ?>">
											<strong><?php echo $cat['name']; ?></strong> (<?php echo $cat_data->count; ?>)
											<input type="hidden" name="category_id[]" value="<?php echo $cat['id']; ?>">
											<input type="hidden" name="category_name[]" value="<?php echo $cat['name']; ?>">
										</li>
										<?php
											endforeach;
										else :
											$cat_args = array(
												'order' 	=> 'DESC',
												'orderby'	=> 'count'
											);
											
											$categories = get_categories( $cat_args );
											foreach ( $categories as $category ) :
										?>
										<li id="<?php echo $category->term_id; ?>">
											<strong><?php echo $category->name; ?></strong> (<?php echo $category->count; ?>)
											<input type="hidden" name="category_id[]" value="<?php echo $category->term_id; ?>">
											<input type="hidden" name="category_name[]" value="<?php echo $category->name; ?>">
										</li>
										<?php
											endforeach;
										endif;
										?>
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
										<input type="hidden" name="action" value="reset">
										<input class="button" type="submit" value="<?php _e('Reset', 'blakzr'); ?>" name="submit">
									</div>
								</form>
							</td>
							<td>
								<img src="<?php echo get_template_directory_uri(); ?>/img/loader.gif" width="24" height="24" class="saving">
							</td>
							<td>
								<button class="button-primary options-save"><?php _e('Guardar Cambios', 'blakzr'); ?></button>
							</td>
						</tr>
					</table>
				</div>
			</div><!-- .panelcontent -->
		</div><!-- #blakzr_warp -->
	</div>
	<?php
}

function blakzr_panel_admin_init(){
	if( isset( $_GET['page'] ) && $_GET['page'] == 'blakzrpanel' ) {

		wp_enqueue_style('blakzrpanel_style', get_template_directory_uri() . '/css/blakzrpanel.css', false, '1.0', 'all');
		wp_enqueue_style('colorpicker_css', get_template_directory_uri() . '/css/colorpicker.css', false, '1.1', 'all');
		wp_enqueue_style('thickbox');
		
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-appendo', get_bloginfo('template_url') . '/js/jquery.appendo.js', false, '1.01', false);
		wp_enqueue_script('colorpicker_js', get_template_directory_uri() . '/js/colorpicker.js', false, '1.1', false);
		wp_enqueue_script('blakzrpanel_js', get_template_directory_uri() . '/js/blakzrpanel.js', false, '1.0', false);
		
	}
}

?>