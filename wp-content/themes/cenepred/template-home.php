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
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri();?>/css/nr_main.css">
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
	<div class="main wrap">
        
       <div class="group" style="margin-bottom: 40px;">
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
	                        <?php echo "slider" ?>
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
<div class="area">
  <h3>Direcciones de linea</h3>
  <ul>
    <li><a id="btn-dpg" href="http://192.168.2.20/web/direccion-de-fortalecimiento-y-asistencia-tecnica/">Dirección de Gestión de Procesos - DGP</a></li>
    <li><a id="btn-difat" href="http://192.168.2.20/web/direccion-de-fortalecimiento-y-asistencia-tecnica/">Dirección de Fortalecimiento y Asistencia Técnica - DIFAT</a></li>
    <li><a id="btn-dimse" href="http://192.168.2.20/web/direccion-de-monitoreo-seguimiento-y-evaluacion/">Dirección de Monitoreo, Seguimiento y Evaluación - DIMSE</a></li>
  </ul>
</div>
 <div style="clear: both;"></div>      
<!-- END BLOQUE2: SECTOR DIRECCIONES -->      
<!-- START BLOQUE3: SECTOR TEMAS DE INTERES TECNICO --> 

<div class="aplicaciones">
  <h3>Plataforma en linea</h3>
  <ul>
    <li><a id="btn-sigrid" href="#">SIGRID</a></li>
    <li><a id="btn-siide" href="#">SIIDE</a></li>
    <li><a id="btn-simse" href="#">SIMSE</a></li>
    <li><a id="btn-sigrid-collet" href="#">SIGRID-COLLET</a></li>
    <li><a id="btn-biblioteca-virtual" href="#">BIBLIOTECA-VIRTUAL</a></li>
    <li><a id="btn-aula-virtual" href="#">AULA-VIRTUAL</a></li>
  </ul>
</div>
<div style="clear: both;"></div>
        
<!-- END BLOQUE3: SECTOR TEMAS DE INTERES TECNICO -->  
        
  <!--      
<?php if ( has_nav_menu( 'destacados' ) ) : ?>  
        <section id="entidades">
            <div class="tit-seccion">Destacados CENEPRED</div>
            <?php wp_nav_menu( array( 'theme_location' => 'destacados', 'container' => 'div', 'menu_class' => 'destacados group', 'depth' => 0, 'walker' => new Description_Walker_destacados ) ); ?>
        </section>
<?php endif; ?>
-->  
      
<!-- START BLOQUE4: SECTOR NOTICIAS && INTERES VIDEO   style="vertical-align:top"-->       
<table border="0" width="100%">
<tr>
   <td>
      <aside class="main-sidebar5">
        <section class="sidebar-publicaciones">
           <div class="tit-seccion">Noticias</div>        
        </section>
      </aside>     
   </td>
   <td style="width:5%">&nbsp;</td>
   <td valign="top">
    <aside class="main-sidebar4">
     <section class="sidebar-publicaciones">  
        <div class="tit-seccion">Videos Institucionales</div>
          <p><span class="nav-desc"></span></p>
      </section>      
    </aside>    
   </td>
   <td style="width:40px">&nbsp;</td>
</tr>
<tr>
 <td valign="top" width="60%" style="vertical-align:top">   
  
  <div class="mainn wrap grid">

		<div class="mainn-content col-8-12">
		
		<!--	<nav class="breadcrumbs">
				<?php
				// Code to display breadcrumbs from the plugin 'Breadcrumbs NavXT'
				if ( function_exists( 'bcn_display' ) ) :
				//	bcn_display(); // echo 'AA';
				endif;
				?>
			</nav> 
        -->
		
		<!--	<div class="site-location">
				<h1 class="location-title">
				  <a href="<? //echo site_url( '/' );?>notas-de-prensa/">	
				  <?php // _e('Notas de Prensa', 'blakzr'); ?>
                  Noticias
                  </a>
				</h1>
			</div> -->
        	
			<?php
				
				$args = array(
					'type'				=> 'yearly',
					'format'			=> 'html', 
					'before'			=> '',
					'after'				=> '',
					'show_post_count'	=> false,
					'echo'				=> 1,
					'order'				=> 'DESC',
					'post_type'			=> 'notas_prensa'
				);
				
			?>
			
			<ul class="date-navigation group" data-url="<?php echo get_template_directory_uri(); ?>" data-type="prensa">
				<?php wp_get_archives( $args ); ?>
                <input type="hidden" id="short_noticia" name="short_noticia" value="1" /> <!-- Mostrar solo 5 noticias ver js/code.js -->
			</ul>
            
            <?php 
			  $args = array(
			        'posts_per_page' 	=> 6,
         			'order'				=> 'DESC',
		        	'orderby'	 		=> 'date',
         			'post_type' 		=> 'notas_prensa',
		         	'post_status' 		=> 'publish',
        			'year'  			=> '2016'
		            );
				
		       // echo '<br>HOLA'.$_GET['year'];
		
		       $show_posts = new WP_Query( $args ); 
			?>
			
			<div class="archive-updater"> 
				<?php if ( $show_posts->have_posts() ) :   //echo 'h:'.$show_posts->have_posts(); ?>

					<?php /* Start the Loop */ ?>
					<?php while ( $show_posts->have_posts() ) : $show_posts->the_post(); ?>
	
						<?php
						$format = get_post_format();
						if ( false === $format )
							$format = 'standard';
						?>
	
						<?php get_template_part( 'content', 'nota' ); ?>
	
					<?php endwhile; ?>
	
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
			</div>
			
			<nav id="nav-below" class="page-navigation group">        
              <div class="nav-previous"><a href="<? echo site_url( '/' );?>notas-de-prensa/" ><span class="meta-nav">>></span> <span>Ver m&aacute;s noticias</span></a></div>
            </nav>
            
		</div><!-- .main-content -->
    
 </td>
 <td style="width:5%">&nbsp;</td>
 <td valign="top">
      
           <table>
           <tr><td>
           
           <iframe width="395" height="270" src="https://www.youtube.com/embed/zb7PVZt4FR4" frameborder="0" allowfullscreen></iframe>
           
           </td>
           </tr>
           <tr>
           <td><div style="margin: auto; margin: -40px 0px;">
              <?php get_sidebar(); ?>  
              </div>
           </td>
           </tr>
           </table>    
   
   </td>
 <td style="width:40px">&nbsp;</td>
</tr>
</table>     
<!-- END BLOQUE4: SECTOR NOTICIAS && INTERES VIDEO -->          
        

<?php  get_footer(); ?>



