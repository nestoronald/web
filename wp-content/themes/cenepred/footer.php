<?php
/**
 * The template for displaying the footer.
 *
 *
 * @package WordPress
 * @subpackage BlakzrFramework
 * @since BlakzrFramework 0.1
 */
?>

<section id="slider-entidades">
          <!--  <div class="tit-seccion">Organismos públicos, Entidades cooperantes y ONG</div> -->
    <div class="slide-entid">
        <ul id="slider_carrusel">
            <li class="itemposts large"><div class="items   ">
            <a href="http://www.pcm.gob.pe/" target="_blank" title="Presidencia del Consejo de Ministros" >
            <img alt="Presidencia del Consejo de Ministros" src="<?php echo get_template_directory_uri(); ?>/img/instituciones/pcm.png" /></a></div>
            </li>
            
            <li class="itemposts large"><div class="items  ">
            <a href="http://sgrd.pcm.gob.pe/" target="_blank" title="Secretaria de Gestion del Riesgo de Desastres" >
            <img alt="Secretaria de Gestion del Riesgo de Desastres" src="<?php echo get_template_directory_uri(); ?>/img/instituciones/sec-ges-riesgos-desastres.png" /></a></div>
            </li>
            
            <li class="itemposts medium-1"><div class="items   ">
            <a href="http://www.vivienda.gob.pe/" title="Ministerio de Vivienda, Construcción y Saneamiento" >
            <img alt="Ministerio de Vivienda, Construcción y Saneamiento" src="<?php echo get_template_directory_uri(); ?>/img/instituciones/min-vivienda.png" /></a></div>
            </li>
            
            <li class="itemposts midium-1"><div class="items   ">
            <a href="http://www.mtc.gob.pe/portal/inicio.html" title="Ministerio de Transportes y Comunicaciones" ><img alt="Ministerio de Transportes y Comunicaciones" src="<?php echo get_template_directory_uri(); ?>/img/instituciones/min-transportes.png" /></a></div>
            </li>
            
            <li class="itemposts small"><div class="items   ">
            <a href="http://minagri.gob.pe/portal/" title="Ministerio de Agricultura y Riego" >
            <img alt="Ministerio de Agricultura y Riego" src="<?php echo get_template_directory_uri(); ?>/img/instituciones/min-agricultura.png" /></a></div>
            </li>           
            
            
            <li class="itemposts medium-2"><div class="items   "><a href="http://www.senamhi.gob.pe/" title="SENAHMI" ><img alt="SENAHMI" src="<?php echo get_template_directory_uri(); ?>/img/instituciones/senamhi.png" />
            </a></div>
            </li>  
            
            <li class="itemposts small"><div class="items   ">
            <a href="http://www.igp.gob.pe/" title="IGP" >
            <img alt="IGP" src="<?php echo get_template_directory_uri(); ?>/img/instituciones/igp.png" />
            </a></div>            
            </li>      
            
            <li class="itemposts medium-2"><div class="items   ">
            <a href="#" target="_blank" title="Autoridad Nacional del Agua" >
            <img alt="ANA" src="<?php echo get_template_directory_uri(); ?>/img/instituciones/ana.png" />
            </a></div>
            </li>
            
            <li class="itemposts small"><div class="items   ">
            <a href="#" target="_blank" title="Colegio de Ingenieros del Perú" >
            <img alt="CIP" src="<?php echo get_template_directory_uri(); ?>/img/instituciones/colegio-ing-peru.png" />
            </a></div>
            </li>
            
        </ul> 
        
        <a title="Siguiente" id="nextfeatured-properties" href="#" class="next btn_next2 animationAll z2">Siguiente<span></span></a>
	    <a title="Anterior" id="prevfeatured-properties" href="#" class="prev btn_prev2 animationAll z2">Anterior<span></span></a>
    </div>
</section>
</div>
<footer id="footer"> 
    <div class="container">
        <div>
        
        			<ul class="sidebar group">
        			 	<?php if ( ! dynamic_sidebar( 'Footer' ) ) : ?>
        			 	<li class="widget">
        					<h3 class="widgettitle"><?php _e('Just a Static Widget', 'blakzr'); ?></h3>
        					<p><?php  _e('This is not a real widget. Just a placeholder. You can put any other available widgets in this area. Try it, what are you waiting for?', 'blakzr'); ?></p>
        				</li>
        			 	<?php endif; ?>
        			</ul>
        
        </div>
    </div>
</footer>
	<?php if ( '' != get_option( 'blakzr_tracking_code', '' ) ) :
		echo get_option( 'blakzr_tracking_code' );
	endif; ?>
	<?php
	   /* Always have wp_footer() just before the closing </body>
	    * tag of your theme, or you will break many plugins, which
	    * generally use this hook to reference JavaScript files.
	    */
	    wp_footer();
	?>

</body>
</html>