<?php
/**
 * Template Name: Reclamaciones (Formulario)
 *
 * @package WordPress
 * @subpackage BlakzrFramework
 * @since BlakzrFramework 0.1
 */
get_header('home'); ?>

	<div class="main wrap grid">

		<div class="main-content col-8-12">

			<nav class="breadcrumbs">
				<?php
				// Code to display breadcrumbs from the plugin 'Breadcrumbs NavXT'
				if ( function_exists( 'bcn_display' ) ) :
					bcn_display();
				endif;
				?>
			</nav>

			<article>
			
				<h1 class="entry-title"><?php the_title(); ?></h1>

				<div class="entry-content">
					<?php the_content( __( 'Continœe leyendo <span class="meta-nav">&rarr;</span>', 'blakzr' ) ); ?>

					<div id="contact-form">
						<?php if ( isset( $_POST['ct_submit'] ) ) : ?>
							<?php
							// Form data
							$nombre 			= $_POST['ct_nombre'];
							$apellido 			= $_POST['ct_apellido'];
							$tipo_documento 	= $_POST['ct_tipo_documento'];
							$numero_documento 	= $_POST['ct_numero_documento'];
							$email 				= $_POST['ct_email'];
							$telefono 			= $_POST['ct_telefono'];
							$direccion 			= $_POST['ct_direccion'];
							$mensaje 			= $_POST['ct_mensaje'];

							// Mail details
							$to 		= get_option( 'blakzr_contact_email', get_option( 'admin_email' ) );
							$subject 	= __( 'Reclamación desde ', 'blakzr' ) . get_option( 'blogname' ) . ' - ' . ucfirst( $asunto );

							$message 	= __('Nombres:', 'blakzr') . ' ' . $nombre . ' ' . $apellido . "\n";
							$message 	.= __('Documento:', 'blakzr') . ' ' . $tipo_documento . ' ' . $numero_documento . "\n";
							$message 	.= __('Email:', 'blakzr') . ' ' . $email . "\n";
							$message 	.= __('Teléfono:', 'blakzr') . ' ' . $telefono . "\n";
							$message 	.= __('Dirección:', 'blakzr') . ' ' . $direccion . "\n";
							$message 	.= __('Mensaje:', 'blakzr') . " \n\n";
							$message 	.= $mensaje;

							$headers = 'From: ' . $nombre . ' <' . $email . '>' . "\r\n";

							wp_mail( $to, $subject, $message, $headers );
							
							// Mail de confirmación			
							$to = $email;
							$subject = 'Gracias por enviarnos su reclamo - CENEPRED';
							
							$contenido = 'GRACIAS POR ENVIARNOS SU RECLAMO' . "\r\n";
							$contenido .= '--------------------------------------------------------------------------------------' . "\r\n";
							$contenido .= 'Hemos recibido su reclamación. Gracias por usar nuestros servicios.' . "\r\n";
											
							$headers = 'From: CENEPRED <no-responder@cenepred.gob.pe>' . "\r\n";
							
							wp_mail( $to, $subject, $contenido, $headers );
							?>
							<center>
								<h3><?php _e('Su reclamo ha sido enviado. Muchas gracias.', 'blakzr'); ?></h3>
							</center>
						<?php else: ?>
							<form action="" method="post" id="template-form" class="group">
								<p>
									<input type="text" name="ct_nombre" value="" id="ct_nombre" class="required" tabindex="1" placeholder="<?php _e( 'Su nombre*' , 'blakzr'); ?>">
									<em><?php _e( 'Este campo es obligatorio.', 'blakzr' ); ?></em>
								</p>
								<p>
									<input type="text" name="ct_apellido" value="" id="ct_apellido" class="required" tabindex="2" placeholder="<?php _e( 'Sus apellidos*' , 'blakzr'); ?>">
									<em><?php _e( 'Este campo es obligatorio.', 'blakzr' ); ?></em>
								</p>
								<p>
									<select name="ct_tipo_documento" id="ct_tipo_documento" tabindex="3">
										<option value="DNI">D.N.I.</option>
										<option value="RUC">R.U.C.</option>
										<option value="CE">C.E.</option>
										<option value="LM">L.M.</option>
										<option value="Pasaporte">Pasaporte</option>
									</select>
								</p>
								<p>
									<input type="text" name="ct_numero_documento" value="" id="ct_numero_documento" class="required" tabindex="4" placeholder="<?php _e( 'Nro. de Documento*' , 'blakzr'); ?>">
									<em><?php _e( 'Este campo es obligatorio.', 'blakzr' ); ?></em>
								</p>
								<p>
									<input type="text" name="ct_email" value="" id="ct_email" class="required email" tabindex="5" placeholder="<?php _e( 'Su email*' , 'blakzr'); ?>">
									<em><?php _e( 'Ingrese una dirección de email válida.', 'blakzr' ); ?></em>
								</p>
								<p>
									<input type="text" name="ct_telefono" value="" id="ct_telefono" class="required" tabindex="6" placeholder="<?php _e( 'Su teléfono*' , 'blakzr'); ?>">
									<em><?php _e( 'Este campo es obligatorio.', 'blakzr' ); ?></em>
								</p>
								<p>
									<input type="text" name="ct_direccion" value="" id="ct_direccion" class="required" tabindex="7" placeholder="<?php _e( 'Su dirección*' , 'blakzr'); ?>">
									<em><?php _e( 'Este campo es obligatorio.', 'blakzr' ); ?></em>
								</p>
								<p>
									<textarea rows="8" cols="45" name="ct_mensaje" id="ct_mensaje" class="required" tabindex="8" placeholder="<?php _e( 'Su mensaje*' , 'blakzr'); ?>"></textarea>
									<em><?php _e( 'Este campo es obligatorio.', 'blakzr' ); ?></em>
								</p>
								<p><input type="submit" value="<?php _e('Enviar', 'blakzr'); ?>" name="ct_submit" id="ct_submit" class="button" tabindex="9"></p>
							</form>
							<p><a href="javascript:window.print();"><img src="<?php echo get_template_directory_uri(); ?>/img/print-form.png" alt="Imprimir Formulario"></a></p>
						<?php endif; ?>
					</div><!-- #contact-form -->
					
					
					<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Páginas:', 'blakzr' ) . '</span>', 'after' => '</div>' ) ); ?>
					<?php edit_post_link( __( 'Edite esta página', 'blakzr' ), '<span class="edit-link">', '</span>' ); ?>
					
				</div><!-- .entry-content -->
			</article>

		</div><!-- .main-content -->

		<?php get_sidebar(); ?>

	<?php get_footer(); ?>
