<?php
/**
 * Template Name: Homepage
 *
 * @package WordPress
 * @subpackage BlakzrFramework
 * @since BlakzrFramework 0.1
 */

get_header( 'home' ); ?>


	<div class="main wrap">
        
        <div class="group" style="margin-bottom: 40px;">
	        <div class="main-content">
	            <div class="slide-informes">
<?php if(is_active_sidebar('widget-video-slider')){
                                    dynamic_sidebar('widget-video-slider');
                                } else{ ?>
	                 <div class="slider-info flexslider">
	                    <ul class="slides">
	                        <?php
							$home_slider = get_option( 'blakzr_slide_homepage_slider' );
		
							foreach ( $home_slider as $slide ) :
		
								if ( is_numeric( $slide['url'] ) ) :
									$the_image = wp_get_attachment_image_src( $slide['url'], 'slide' );
								else:
									$the_image = array();
								endif;
							?>
							<li>
								<figure>
									<a href="<?php echo $slide['link']; ?>">
										<img src="<?php echo $the_image[0]; ?>" width="690" height="300" alt="<?php echo $slide['title']; ?>">
										<figcaption>
											<h4><?php echo $slide['title']; ?></h4>
											<?php if ( !empty( $slide['description'] ) ) : ?>
											<p><?php echo $slide['description']; ?></p>
											<?php endif; ?>
										</figcaption>
									</a>
								</figure>
							</li>
							<?php
							endforeach;
							?>
	                    </ul>
	                 </div>
<?php }?>         
	            </div>
	        </div>
	        
	        <?php get_sidebar(); 
	        
	        
	        echo '<br> BAR:'.get_sidebar();
	        
	        ?>
	    
	        
        </div>
		
		<section id="entidades">
            <div class="tit-seccion">Destacados CENEPRED</div>
            <div class="menu-destacados-homepage-container">
            	<ul id="menu-destacados-homepage" class="destacados group">
            		<li id="menu-item-212" class="menu-item menu-item-type-custom menu-item-object-custom">
				<a target="_self" href="http://cenepred.gob.pe/sistema-sigrid/">
            			<!--<a target="_blank" href="http://cenepred.gob.pe/sigrid-traslado-de-nuestros-servidores/">-->
            				<h3>SIGRID</h3>
            			</a>
            			<p><span class="nav-desc">Sistema de información para la gestión del riesgo de desastres.</span></p>

<!-- <span class="nav-desc">Video <a href="https://www.youtube.com/watch?v=zb7PVZt4FR4"><img src="http://cenepred.gob.pe/wp-content/uploads/2014/05/sigrid-video-imagen-2.png"></a></span>-->
            		</li>
            		<li id="menu-item-213" class="menu-item menu-item-type-post_type menu-item-object-page">
            			<a href="http://cenepred.gob.pe/coordinacionyarticulacion/">
            				<h3>Coordinación y Articulación</h3>
            			</a>
            			<p></p>
            		</li>
            		<li id="menu-item-219" class="menu-item menu-item-type-custom menu-item-object-custom">
            			<a href="http://cenepred.gob.pe/itse/">
            				<h3>ITSE</h3>
            			</a>
            			
				<p><span class="nav-desc">Inspecciones Técnicas de Seguridad en Edificaciones</span></p>

				<!--<p><span class="nav-desc">Publicación de Manual y Formatos (Aprobados)</span></p>-->
				<p></p>
				<p style="margin-bottom: 15px;"></p>
				<p><span class="nav-desc">- <a href="http://cenepred.gob.pe/comunicados-itse">Comunicados</a> <!--<img src="/wp-content/uploads/2014/09/nnuevo.gif"></span></p>-->
				<p></p>
				<p><span class="nav-desc">- <a href=" http://app.cenepred.gob.pe/ritsev2">RITSE</a> <img src="/wp-content/uploads/2014/09/nnuevo.gif">
				<p></p>
				<p><span class="nav-desc">- <a href=" http://app.cenepred.gob.pe/ritsev2/busqueda.php">Búsqueda de Inspectores</a> <img src="/wp-content/uploads/2014/09/nnuevo.gif">
				<p></p>
				
				
            		</li>
            		<li id="menu-item-215" class="menu-item menu-item-type-custom menu-item-object-custom">
            			<a href="http://cenepred.gob.pe/escenarios-de-riesgos">
            				<h3>Escenarios de Riesgos</h3>
            			</a>
            			<p></p>
            		</li>
            		<li id="menu-item-216" class="menu-item menu-item-type-post_type menu-item-object-page">
            			<a href="http://cenepred.gob.pe/oficina-de-cooperacion-y-relaciones-internacionales/">
            			<h3>Cooperación y Relaciones Internacionales</h3>
            			</a>
            			<p><span class="nav-desc"></span></p>
            		</li>
            		<li id="menu-item-217" class="menu-item menu-item-type-custom menu-item-object-custom">
            			<a href="http://cenepred.gob.pe/notas-de-prensa/">
            				<h3>Prensa <!-- <img src="/wp-content/uploads/2014/05/nuevo.gif"> --></h3>
            			</a>
            			<p><span class="nav-desc">Noticias, boletines, galería y <a href="http://cenepred.gob.pe/eventos/">agenda de eventos</a>.</span></p>   
				<a href="#">
            			<!--	<h3>Publicaciones </h3>
            			</a>
				<p><span class="nav-desc">Historietas: <a href="http://www.youblisher.com/p/872857-Conociendo-sobre-las-heladas-con-Mayra/"><img src="/wp-content/uploads/2014/05/heladas2.png"></a> <a href="http://www.youblisher.com/p/872861-Conociendo-Sobre-las-Sequias-con-Mayra/"><img src="/wp-content/uploads/2014/05/sequias2.png"></a> <a href="http://www.youblisher.com/p/872858-Ordenando-Nuestro-Territorio-con-Mayra-para-Reducir-Riesgos/"><img src="/wp-content/uploads/2014/05/ordenamiento2.png"></span></p>-->
					
            		</li>
            	</ul>
            </div>
         </section>
        
        
  <!--      
<?php if ( has_nav_menu( 'destacados' ) ) : ?>  
        <section id="entidades">
            <div class="tit-seccion">Destacados CENEPRED</div>
            <?php wp_nav_menu( array( 'theme_location' => 'destacados', 'container' => 'div', 'menu_class' => 'destacados group', 'depth' => 0, 'walker' => new Description_Walker_destacados ) ); ?>
        </section>
<?php endif; ?>
-->  
        
        

<?php get_footer(); ?>