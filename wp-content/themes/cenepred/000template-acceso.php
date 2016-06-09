<?php
/**
 * Template Name: Acceso (Formulario)
 *
 * @package WordPress
 * @subpackage BlakzrFramework
 * @since BlakzrFramework 0.1
 */

get_header(); 

require_once("includes/define.php");
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
				<center>
				<h1 class="entry-title"><?php the_title(); ?></h1>								                                                                 
				</center>
				
				<?php 
				 //$direc='http://cenepred.gob.pe/wp-content/themes/cenepred/includes/exportar.png';
				  $direc='http://localhost/web_cenepred/wp-content/themes/cenepred/includes/exportar.png';
				?>
				<div align="right">
				<a href="http://localhost/web_cenepred/wp-content/themes/cenepred/includes/exportar_lista_excel.php">
				<img src="<?php echo $direc; ?>">
				</a>
				</div>
				<div class="entry-content">
					<?php the_content( __( 'Continúe leyendo <span class="meta-nav">&rarr;</span>', 'blakzr' ) ); ?>

					<div id="contact-form">
						<?php if ( isset( $_POST['ct_submit'] ) ) : ?>
							<?php
							// Form data
							$unidad 			= $_POST['ct_unidad'];
							$name 				= $_POST['ct_name'];
							$tipo_documento 	= $_POST['ct_tipo_documento'];
							$numero_documento 	= $_POST['ct_numero_documento'];
							$representante 		= $_POST['ct_rep'];
							$domicilio	 		= $_POST['ct_dir'];
							$departamento 		= $_POST['ct_dep'];
							$provincia	 		= $_POST['ct_prov'];
							$telefono	 		= $_POST['ct_telefono'];
							$email 				= $_POST['ct_email'];
							$comment 			= $_POST['ct_comment'];
                            
							//--- Guardar DB Alterno ---
							
							//*******************  INICIO DE TRANSACCION *******************************************
							$conn->StartTrans(); $vSQL_select = "BEGIN"; $rs_select = &$conn->Execute($vSQL_select);
							//**************************************************************************************
							$error = "";
							$sql_max = "SELECT MAX(i_codsolicitud) FROM tr_cntbc_solicitudes";
							$max = &$conn->Execute($sql_max);
							$nmax = $max->fields[0];
							$id = $nmax + 1;            // echo '<br> ID:'.$id;
							
							$vSQL_insert = "INSERT INTO tr_cntbc_solicitudes(i_codsolicitud,v_solicitante,v_desunidad,v_tipodoc,v_numdoc,v_desrepre,v_direccion,v_departamento,v_provincia,v_distrito,
							v_telefono,v_email,v_solicitud,d_fecsolicitud,i_usureg,d_fecreg,i_estreg)
							VALUES($id,'$name','$unidad','$tipo_documento','$numero_documento','$representante','$domicilio','$departamento','$provincia','$distrito',
							'$telefono','$email','$comment',NOW(),'1',NOW(),'1')";
							$rs_insert = &$conn->Execute($vSQL_insert); // echo '<br>'.$vSQL_insert;
							if (!$rs_insert) { $error = true; $strMensaje = $conn->ErrorMsg(); echo '<br>' . $vSQL_insert; echo '<br>' . $strMensaje; }
														
							//--------------------------
							// Mail details
							$to = get_option( 'blakzr_contact_email', get_option( 'admin_email' ) );
							$subject = __( 'Solicitud de acceso a información desde ', 'blakzr' ) . get_option( 'blogname' ) . ' - ' . ucfirst( $asunto );

							$message = __('Dirección/unidad:', 'blakzr') . ' ' . $unidad . "\n";
							$message .= __('Nombre:', 'blakzr') . ' ' . $name . "\n";
							$message .= __('Documento:', 'blakzr') . ' ' . $tipo_documento . ' ' . $numero_documento . "\n";
							$message .= __('Nombre Representante:', 'blakzr') . ' ' . $representante . "\n";
							$message .= __('Domicilio:', 'blakzr') . ' ' . $domicilio . "\n";
							$message .= __('Departamento:', 'blakzr') . ' ' . $departamento . "\n";
							$message .= __('Provincia:', 'blakzr') . ' ' . $provincia . "\n";
							$message .= __('Teléfono:', 'blakzr') . ' ' . $telefono . "\n";
							$message .= __('Email:', 'blakzr') . ' ' . $email . "\n";
							$message .= __('Comentario/Solucitud:', 'blakzr') . " \n\n";
							$message .= $comment . " \n\n";
							$message .= __('Formato(s):', 'blakzr') . "\n";
							
							if (isset($_POST['formato']) && is_array($_POST['formato']) ) {
							   
							   foreach ($_POST['formato'] as $formato) {
							      
							      $message .= '- ' . ucfirst( $formato ) . "\n";
							      
							      //------
							      $format=ucfirst($formato);
							      
							      $vSQL_insert = "INSERT INTO tr_cntbd_formato(i_codsolicitud,v_desformato,i_usureg,d_fecreg,i_estreg)
							      VALUES($id,'$format','1',NOW(),'1')";
							      $rs_insert = &$conn->Execute($vSQL_insert); // echo '<br>'.$vSQL_insert;
							      if (!$rs_insert) { $error = true; $strMensaje = $conn->ErrorMsg(); echo '<br>' . $vSQL_insert; echo '<br>' . $strMensaje; }
							      //------
							   }
							}
							
							$message .= "\n" . __('Planos potters):', 'blakzr') . "\n";
							
							if (isset($_POST['planos']) && is_array($_POST['planos']) ) {
							   
							   foreach ($_POST['planos'] as $plano) {
							      
							      $message .= '- ' . ucfirst( $plano ) . "\n";
							      
							      //------
							      $plan=ucfirst($plano);
							      
							      $vSQL_insert = "INSERT INTO tr_cntbd_plano(i_codsolicitud,v_desplano,i_usureg,d_fecreg,i_estreg)
							      VALUES($id,'$plan','1',NOW(),'1')";
							      $rs_insert = &$conn->Execute($vSQL_insert); // echo '<br>'.$vSQL_insert;
							      if (!$rs_insert) { $error = true; $strMensaje = $conn->ErrorMsg(); echo '<br>' . $vSQL_insert; echo '<br>' . $strMensaje; }
							      //------
							   }
							}

							
							if (!$error) {
								$conn->CompleteTrans(); $vSQL_select="COMMIT";  $rs_select = &$conn->Execute($vSQL_select);								
							}
							else{ $conn->RollbackTrans(); $vSQL_select="ROLLBACK"; $rs_select = &$conn->Execute($vSQL_select);?> 
							   <script>alert('Error al Guardar Solicitud - Contacte al administrador!!');</script> <?php
							}  // end else si guardo	
														
							
							//-----------------------------------------------------------------------

							$headers = 'From: ' . $name . ' <' . $email . '>' . "\r\n";
                            
							//*****************************
							//$to="dgereda@cenepred.gob.pe";
							//*****************************
							
							wp_mail( $to, $subject, $message, $headers );
							
							// Mail de confirmación			
							$to = $email;
							$subject = 'Solicitud de acceso recibida - CENEPRED';
							
							$contenido = 'SOLICITUD DE ACCESO RECIBIDA' . "\r\n";
							$contenido .= '--------------------------------------------------------------------------------------' . "\r\n";
							$contenido .= 'Hemos recibido su solicitud de acceso a información. Nos pondremos en contacto en breve.' . "\r\n";
											
							$headers = 'From: CENEPRED <no-responder@cenepred.gob.pe>' . "\r\n";
							
							wp_mail( $to, $subject, $contenido, $headers );
							?>
							<center>
								<h3><?php _e('Su solicitud ha sido enviada. Gracias por contactarnos.', 'blakzr'); ?></h3>
							</center>
						<?php else: ?>
							<form action="" method="post" id="template-form-other" class="group">
							<center>
								<h3>Ley No 27806 Ley de Transparencia y Acceso a la Información Pública</h3>
								<h4>Funcionario Responsable de brindar información: Julio Armando Cumpa Arisnavarreta</h4>
                                <h4>Solicitud Presencial</h4>
                                <p>Nota: Si usted desea, puede descargar el formulario para presentarlo personalmente a nuestras oficinas, <a href="http://magento-course.com/cenepred/wp-content/uploads/2014/01/formato-acceso.pdf">haga clic aquí</a>.</p>
                                <h4>Solicitud Electrónica</h4>
							</center>
                                				<p>Dirección y/o Unidad Orgánica que posee la información:</p>
								<p>
									<select name="ct_unidad" id="ct_unidad" tabindex="1">
										<option value="jefatura">Jefatura</option>
										<option value="secretaria general">Secretaría General</option>
										<option value="dirección de gestión de procesos">Dirección de Gestión de Procesos</option>
										<option value="dirección de fortalecimiento y asistencia técnica">Dirección de Fortalecimiento y Asistencia Técnica</option>
										<option value="dirección de monitoreo, seguimiento y evaluación">Dirección de Monitoreo, Seguimiento y Evaluación</option>
										<option value="cooperación internacional">Cooperación Internacional</option>
										<option value="oficina asesoría jurídica">Oficina Asesoría Jurídica</option>
										<option value="oficina de administración">Oficina de Administración</option>
										<option value="oficina de planeamiento y presupuesto">Oficina de Planeamiento y Presupuesto (OPP)</option>
									</select>
								</p>
								
								<h4>1. Datos del solicitante:</h4>
								
								<div class="half">
									<p>
										<input type="text" name="ct_name" value="" id="ct_name" class="required" tabindex="2" placeholder="<?php _e( 'Nombre completo*' , 'blakzr'); ?>">
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
										<input type="text" name="ct_rep" value="" id="ct_rep" class="required" tabindex="5" placeholder="<?php _e( 'Nombre de representante legal*' , 'blakzr'); ?>">
										<em><?php _e( 'Este campo es obligatorio.', 'blakzr' ); ?></em>
									</p>
									<p>
										<input type="text" name="ct_dir" value="" id="ct_dir" class="required" tabindex="6" placeholder="<?php _e( 'Domicilio Legal (Av / Jr / Calle / Psje / No / Dpto / Mza / Lote / Urb)*' , 'blakzr'); ?>">
										<em><?php _e( 'Este campo es obligatorio.', 'blakzr' ); ?></em>
									</p>
								</div>
								
								<div class="half last">
									<p>
										<input type="text" name="ct_dep" value="" id="ct_dep" class="required" tabindex="7" placeholder="<?php _e( 'Departamento*' , 'blakzr'); ?>">
										<em><?php _e( 'Este campo es obligatorio.', 'blakzr' ); ?></em>
									</p>
									<p>
										<input type="text" name="ct_prov" value="" id="ct_prov" class="required" tabindex="8" placeholder="<?php _e( 'Provincia*' , 'blakzr'); ?>">
										<em><?php _e( 'Este campo es obligatorio.', 'blakzr' ); ?></em>
									</p>
									<p>
										<input type="text" name="ct_dist" value="" id="ct_dist" class="required" tabindex="9" placeholder="<?php _e( 'Distrito*' , 'blakzr'); ?>">
										<em><?php _e( 'Este campo es obligatorio.', 'blakzr' ); ?></em>
									</p>
									<p>
										<input type="text" name="ct_telefono" value="" id="ct_telefono" class="required" tabindex="10" placeholder="<?php _e( 'Teléfono*' , 'blakzr'); ?>">
										<em><?php _e( 'Este campo es obligatorio.', 'blakzr' ); ?></em>
									</p>
									<p>
										<input type="text" name="ct_email" value="" id="ct_email" class="required email" tabindex="11" placeholder="<?php _e( 'Email*' , 'blakzr'); ?>">
										<em><?php _e( 'Ingrese una dirección de email válida.', 'blakzr' ); ?></em>
									</p>
								</div>
								<h4>2. Información Solicitada:</h4>
								<p>
									<textarea id="ct_comment" rows="8" cols="45" name="ct_comment" id="ct_comment" class="required" tabindex="12" placeholder="<?php _e( '(Exprese su pedido de información, de manera concreta y precisa).*' , 'blakzr'); ?>"></textarea>
									<em><?php _e( 'Este campo es obligatorio.', 'blakzr' ); ?></em>
								</p>
								<div class="half">
									<h4>3. Forma de entrega de la información:</h4>
									<p>
										<input type="checkbox" name="formato[]" id="formato_copia" value="copia certificada"><label for="formato_copia">Copia Certificada</label>
									</p>
									<p>
										<input type="checkbox" name="formato[]" id="formato_copia_simple" value="copia simple"><label for="formato_copia_simple">Copia Simple</label>
									</p>
									<p>
										<input type="checkbox" name="formato[]" id="formato_cdroom" value="cdroom"><label for="formato_cdroom">CD-Room</label>
									</p>
									<p>
										<input type="checkbox" name="formato[]" id="formato_email" value="correo electronico"><label for="formato_email">Correo Electrónico</label>
									</p>
									<p>
										<input type="checkbox" name="formato[]" id="formato_diskette" value="diskette"><label for="formato_diskette">Diskette</label>
									</p>
								</div>
								<div class="half last">
									<p>Sólo para planos plotters (Indicar tipo de papel y formato)</p>
									<p>
										<input type="checkbox" name="planos[]" id="planos_bond" value="papel bond"><label for="planos_bond">Papel Bond</label>
									</p>
									<p>
										<input type="checkbox" name="planos[]" id="planos_canson" value="papel canson"><label for="planos_canson">Papel Canson</label>
									</p>
									<p>
										<input type="checkbox" name="planos[]" id="planos_a0" value="formato a0"><label for="planos_a0">Formato A0</label>
									</p>
									<p>
										<input type="checkbox" name="planos[]" id="planos_a1" value="formato a1"><label for="planos_a1">Formato A1</label>
									</p>
									<p><input type="submit" value="<?php _e('Enviar', 'blakzr'); ?>" name="ct_submit" id="ct_submit" class="button" tabindex="13"></p>
								</div>
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