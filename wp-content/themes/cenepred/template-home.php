<?php
/**
 * Template Name: Homepage
 *
 * @package WordPress
 * @subpackage BlakzrFramework
 * @since BlakzrFramework 0.1
 */
get_header( 'home' ); 
//  echo '<br>Este:'.dirname( __FILE__ );
?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri();?>/css/direcciones.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri();?>/css/noticias.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri();?>/css/interestecnico.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri();?>/css/tab.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri();?>/css/listanoticia.css">
 <style type="text/css"> 
  
#itselink1 {
position: relative;
top: -62px;
left: 10px;
width: 100%;
color: white;
font: bold 11px Helvetica;
/*padding: 10px;*/
cursor:pointer; cursor: hand;
}   

#itselink2 {
position: relative;
top: -58px;
left: 10px;
width: 100%;
color: white;
font: bold 11px Helvetica;
/*padding: 10px;*/
cursor:pointer; cursor: hand;
}   

#itselink3 {
position: relative;
top: -53px;
left: 10px;
width: 100%;
color: white;
font: bold 11px Helvetica;
/*padding: 10px;*/
cursor:pointer; cursor: hand;
}   
</style>
	<?php 	
		$url_base='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	?>   
	<div class="bg-01">
        
       <div class="group">
	       <div class="main-content2">
	           <div class="slide-informes">
                <?php 
                  if(is_active_sidebar('widget-video-slider'))
                  {
                               dynamic_sidebar('widget-video-slider');
                  } 
                  else{ ?>

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
	        
	        <?php // get_sidebar(); ?>
	            
        </div>
<!-- START BLOQUE2: SECTOR DIRECCIONES -->
                
<?php if ( has_nav_menu( 'dir' ) ) : ?>                    
<?php //wp_nav_menu( array( 'theme_location' => 'dir', 'container' => 'div', 'menu_class' => 'direc', 'depth' => 0, 'walker' => new Description_Walker ) ); ?>
<?php endif; 
?>  
<div class="area row">
  <h3>Direcciones de linea</h3>
  <ul>
    <li><a id="btn-dpg" href="<?php echo $url_base?>direccion-de-fortalecimiento-y-asistencia-tecnica/">Dirección de Gestión de Procesos - DGP</a></li>
    <li><a id="btn-difat" href="<?php echo $url_base?>direccion-de-fortalecimiento-y-asistencia-tecnica/">Dirección de Fortalecimiento y Asistencia Técnica - DIFAT</a></li>
    <li><a id="btn-dimse" href="<?php echo $url_base?>direccion-de-monitoreo-seguimiento-y-evaluacion/">Dirección de Monitoreo, Seguimiento y Evaluación - DIMSE</a></li>
  </ul>
</div>
 <div style="clear: both;"></div>      
<!-- END BLOQUE2: SECTOR DIRECCIONES -->      
<!-- START BLOQUE3: SECTOR TEMAS DE INTERES TECNICO --> 

<div class="aplicaciones row">
  <h3>Plataformas en linea</h3>
  <ul>
    <li><a id="btn-sigrid" target="_blank" href="<?php echo $url_base ?>sistema-sigrid/">SIGRID</a></li>
    <li><a id="btn-siide" target="_blank" href="http://dgp.cenepred.gob.pe/">SIIDE</a></li>
    <li><a id="btn-simse" target="_blank" href="http://servicios.cenepred.gob.pe/cenepred">SIMSE</a></li>    
    <!-- <li><a id="btn-biblioteca-virtual" href="#">BIBLIOTECA-VIRTUAL</a></li>
    <li><a id="btn-aula-virtual" href="#">AULA-VIRTUAL</a></li>
    <li><a id="btn-0" href="#">SIGRID-COLLET</a></li> -->
  </ul>
</div>
<div style="clear: both;"></div>
        

      
<!-- START BLOQUE4: SECTOR NOTICIAS && INTERES VIDEO   style="vertical-align:top"-->
<div class="row">
	<div class="col-10">
		<div class="noticias">
			<h3>Noticias</h3>
			<div>				
	            
	            <?php 
				  $args = array(
				        'posts_per_page' 	=> 6,
	         			'order'				=> 'DESC',
			        	'orderby'	 		=> 'date',
	         			'post_type' 		=> 'notas_prensa',
			         	'post_status' 		=> 'publish',
	        			'year'  			=> '2016'
			            );
			
			       $show_posts = new WP_Query( $args ); 
				?>				
					<?php if ( $show_posts->have_posts() ) : ?>

						<?php /* Start the Loop */ $init=1;?>
						<?php while ( $show_posts->have_posts() ) : $show_posts->the_post(); ?>
		
							<?php
							$format = get_post_format();
							if ( false === $format )
								$format = 'standard';
							?>
							
							<?php
							if ($init<5) {
								get_template_part( 'content', 'nota' );
							}
							?>
		
						<?php $init++; endwhile; ?>
		
						<?php blakzr_content_nav( 'nav-below' ); ?>
		
					<?php else : ?>
		
					<article id="post-0" class="post no-results not-found">
						<h1 class="entry-title"><?php _e( 'No se encontro nada', 'blakzr' ); ?></h1>
						
						<div class="entry-content">
							<p><?php _e( 'Disculpas, pero no se han encontrado resultados para el archivo solicitado. Puede que la busqueda le ayudara a encontrar una entrada relacionada.', 'blakzr' ); ?></p>
							<?php get_search_form(); ?>
						</div><!-- .entry-content -->
					</article><!-- #post-0 -->
		
					<?php endif; ?>
												            
			</div><!-- .main-content -->			
		</div>
	</div>       
	<div class="desta col-2">
		<h3>Destacados</h3>
		<ul>
			<li><a id="btn-esc-riesgo" href="<?php echo $url_base ?>web/escenarios-de-riesgos/">Escenario de Riesgo</a></li>
			<li><a id="btn-inspec-tec" href="<?php echo $url_base ?>web/itse/">Inspecciones técnicas</a></li>
			<li><a id="btn-sigrid-collet" target="_blank" href="https://play.google.com/store/apps/details?id=gob.cenepred.sigrid.collect&hl=es">Sigrid Collect</a></li>
			<li><a id="btn-cal" href="<?php echo $url_base ?>eventos/">Calendario de actividades</a></li>
		</ul>
	</div>
</div>
<div class="row">
	<div class="col-10">		
			<div class="publicaciones">
			<h3>Publicaciones</h3>
				<ul class="slide-pub">
			            <li class="itemposts"><div class="items">
			            <a href="<?php echo $url_base ?>escenarios-riesgos/"  title="Escenarios de Riesgos Bajas Temperaturas 2015" >
			            <img alt="Presidencia del Consejo de Ministros" src="<?php echo get_template_directory_uri(); ?>/img/publicaciones/pub-1.png" /></a></div>
			            </li>
			            <li class="itemposts last"><div class="items">
			            <a href="<?php echo $url_base ?>boletin-sigrid"  title="Boletin SIGRID" >
			            <img alt="Secretaria de Gestion del Riesgo de Desastres" src="<?php echo get_template_directory_uri(); ?>/img/publicaciones/pub-2.png" /></a></div>
			            </li>		           		             		           
			    </ul>
			</div>					
			<div class="educativos">
				<h3>Educativos</h3>
				<ul>
					<li class="itemposts"><div class="items">
			            <a href="<?php echo $url_base ?>mapa-de-heladas-y-friajes/"  title="Que es el CENEPRED" >
			            <img alt="#" src="<?php echo get_template_directory_uri(); ?>/img/educativos/cenepred.jpg" /></a></div>
			        </li>
			        <li class="itemposts last"><div class="items">
			            <a href="<?php echo $url_base ?>cenepred/" title="Marco Normativo del CENEPRED" >
			            <img alt="#" src="<?php echo get_template_directory_uri(); ?>/img/educativos/marco-normativo.jpg" /></a></div>
			        </li>		        
				</ul>
			</div>		
	</div>
	<div class=" col-2">
		<div class="videos">
				<h3>Videos Institucionales</h3>
				<iframe width="320" height="230" src="https://www.youtube.com/embed/zb7PVZt4FR4" frameborder="0" allowfullscreen></iframe>
		</div>
	</div>
</div>	
  
<!-- END BLOQUE4: SECTOR NOTICIAS && INTERES VIDEO -->          
        

<?php  get_footer(); ?>



