<?php
/**
 * Template Name: Contacto (Formulario)
 *
 * @package WordPress
 * @subpackage BlakzrFramework
 * @since BlakzrFramework 0.1
 */
get_header(); 
//Funtion to Validate sql-injection
function noInjection($query) {
	$data = explode("\\",$query);
	$cleaned = implode("",$data);
	$limpio=str_replace("'","", $cleaned);
	$limpio2=str_replace("-","", $limpio);
	return $limpio2;
}
//End Function
?>

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
					<?php the_content( __( 'Continúe leyendo <span class="meta-nav">&rarr;</span>', 'blakzr' ) );
					
					//echo get_option( 'blakzr_contact_email', get_option( 'admin_email' ) );
					 ?>

					<div id="contact-form"> 
						<?php if ( isset( $_POST['ct_submit'] ) ) : ?>
							<?php
							// Form data
							//Adding sql-injection function to the form fileds
							$name = noInjection($_POST['ct_name']);
							$apellidos = noInjection($_POST['ct_apellidos']);
							$email = noInjection($_POST['ct_email']);
							$asunto = noInjection($_POST['ct_asunto']);
							$comment = noInjection($_POST['ct_comment']);
							//--------------------------------------------------
							// Mail details
							$to = get_option( 'blakzr_contact_email', get_option( 'admin_email' ) );
							$subject = __( 'Mensaje desde ', 'blakzr' ) . get_option( 'blogname' ) . ' - ' . ucfirst( $asunto );

							$message = __('Nombres:', 'blakzr') . ' ' . $name . ' ' . $apellidos . "\n";
							$message .= __('Email:', 'blakzr') . ' ' . $email . "\n";
							$message .= __('Asunto:', 'blakzr') . ' ' . $asunto . "\n";
							$message .= __('Mensaje:', 'blakzr') . " \n\n";
							$message .= $comment;

							$headers = 'From: ' . $name . ' <' . $email . '>' . "\r\n";

							wp_mail( $to, $subject, $message, $headers );
							
							
							// Mail de confirmación			
							$to = $email;
							$subject = 'Gracias por contactar a CENEPRED';
							
							$contenido = 'GRACIAS POR CONTACTAR A CENEPRED' . "\r\n";
							$contenido .= '--------------------------------------------------------------------------------------' . "\r\n";
							$contenido .= 'Nos pondremos en contacto con usted en breve.' . "\r\n";
											
							$headers = 'From: CENEPRED <no-responder@cenepred.gob.pe>' . "\r\n";
							
							wp_mail( $to, $subject, $contenido, $headers );
							
							?>
							<center>
								<h3><?php _e('Su consulta ha sido enviada. Gracias por contactarnos.', 'blakzr'); ?></h3>
							</center>
						<?php else: ?>
							<form action="" method="post" id="template-form" class="group">
								<p>
									<input type="text" name="ct_name" value="" id="ct_name" class="required" tabindex="1" placeholder="<?php _e( 'Su nombre*' , 'blakzr'); ?>">
									<em><?php _e( 'Este campo es obligatorio.', 'blakzr' ); ?></em>
								</p>
								<p>
									<input type="text" name="ct_apellidos" value="" id="ct_apellidos" class="required" tabindex="2" placeholder="<?php _e( 'Sus apellidos*' , 'blakzr'); ?>">
									<em><?php _e( 'Este campo es obligatorio.', 'blakzr' ); ?></em>
								</p>
								<p>
									<input type="text" name="ct_email" value="" id="ct_email" class="required email" tabindex="2" placeholder="<?php _e( 'Su email*' , 'blakzr'); ?>">
									<em><?php _e( 'Ingrese una dirección de email válida.', 'blakzr' ); ?></em>
								</p>
								<p>
									<input type="text" name="ct_asunto" value="" id="ct_asunto" class="required" tabindex="2" placeholder="<?php _e( 'Asunto*' , 'blakzr'); ?>">
									<em><?php _e( 'Este campo es obligatorio.', 'blakzr' ); ?></em>
								</p>
								<p>
								<p>
									<textarea id="ct_comment" rows="8" cols="45" name="ct_comment" id="ct_comment" class="required" tabindex="3" placeholder="<?php _e( 'Su mensaje*' , 'blakzr'); ?>"></textarea>
									<em><?php _e( 'Este campo es obligatorio.', 'blakzr' ); ?></em>
								</p>
								<p><input type="submit" value="<?php _e('Enviar', 'blakzr'); ?>" name="ct_submit" id="ct_submit" class="button" tabindex="4"></p>
							</form>
						<?php endif; ?>
					</div><!-- #contact-form -->

					<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Páginas:', 'blakzr' ) . '</span>', 'after' => '</div>' ) ); ?>
					<?php edit_post_link( __( 'Edite esta página', 'blakzr' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-content -->
			</article>

		</div><!-- .main-content -->

		<?php get_sidebar(); ?>

	<?php get_footer(); ?>
