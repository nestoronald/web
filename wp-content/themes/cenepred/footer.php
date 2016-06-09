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
            <li class="itemposts"><div class="items grises">
            <a href="http://www.pcm.gob.pe/" target="_blank" title="Presidencia del Consejo de Ministros" >
            <img alt="Presidencia del Consejo de Ministros" src="<?php echo get_template_directory_uri(); ?>/img/entidades/pcm.jpg" /></a></div>
            </li>
            
            <li class="itemposts"><div class="items grises">
            <a href="http://sgrd.pcm.gob.pe/" target="_blank" title="Secretaria de Gestion del Riesgo de Desastres" >
            <img alt="Secretaria de Gestion del Riesgo de Desastres" src="<?php echo get_template_directory_uri(); ?>/img/entidades/sgrd.jpg" /></a></div>
            </li>
            
            <li class="itemposts"><div class="items grises">
            <a href="http://www.minam.gob.pe/" title="Ministerio del Ambiente" >
            <img alt="Ministerio del Ambiente" src="<?php echo get_template_directory_uri(); ?>/img/entidades/logo-mambiente.jpg" /></a></div>
            </li>
            
            <li class="itemposts"><div class="items grises">
            <a href="http://www.vivienda.gob.pe/" title="Ministerio de Vivienda, Construcción y Saneamiento" >
            <img alt="Ministerio de Vivienda, Construcción y Saneamiento" src="<?php echo get_template_directory_uri(); ?>/img/entidades/logo-vivienda.jpg" /></a></div>
            </li>
            
            <li class="itemposts"><div class="items grises">
            <a href="http://www.mtc.gob.pe/portal/inicio.html" title="Ministerio de Transportes y Comunicaciones" ><img alt="Ministerio de Transportes y Comunicaciones" src="<?php echo get_template_directory_uri(); ?>/img/entidades/logo-trans.jpg" /></a></div>
            </li>
            
            <li class="itemposts"><div class="items grises">
            <a href="http://minagri.gob.pe/portal/" title="Ministerio de Agricultura y Riego" >
            <img alt="Ministerio de Agricultura y Riego" src="<?php echo get_template_directory_uri(); ?>/img/entidades/logo-agri.jpg" /></a></div>
            </li>
            
            <li class="itemposts"><div class="items grises">
            <a href="http://www.comunidadandina.org/predecan/predecan.html" title="PREDECAN" >
            <img alt="PREDECAN" src="<?php echo get_template_directory_uri(); ?>/img/entidades/predecam.jpg" />
            </a></div>
            </li>
            
            <li class="itemposts"><div class="items grises"><a href="http://www.senamhi.gob.pe/" title="SENAHMI" ><img alt="SENAHMI" src="<?php echo get_template_directory_uri(); ?>/img/entidades/senamhi.jpg" />
            </a></div>
            </li>
            
            <li class="itemposts"><div class="items grises">
            <a href="http://www.imarpe.pe/imarpe/" title="IMARPE" >
            <img alt="IMARPE" src="<?php echo get_template_directory_uri(); ?>/img/entidades/logo-trans.jpg" />
            </a></div>
            </li>
            
            <li class="itemposts"><div class="items grises">
            <a href="http://www.igp.gob.pe/" title="IGP" >
            <img alt="IGP" src="<?php echo get_template_directory_uri(); ?>/img/entidades/igp.jpg" />
            </a></div>            
            </li>
            
            <li class="itemposts"><div class="items grises">
            <a href="http://www.dhn.mil.pe/" title="DHN" >
            <img alt="DHN" width="95" height="86" src="<?php echo get_template_directory_uri(); ?>/img/entidades/logo_dhn.gif" />
            </a></div>           
            </li>
            
            <li class="itemposts"><div class="items grises">
            <a href="http://senamhi.gob.pe/?p=0805" title="ENFEN" >
            <img alt="ENFEN" width="95" height="86" src="<?php echo get_template_directory_uri(); ?>/img/entidades/logo-enfen.png" />
            </a></div>
            </li>
            
            <li class="itemposts"><div class="items grises">
            <a href="http://www.unasursg.org/" target="_blank" title="UNASUR" >
            <img alt="UNASUR" src="<?php echo get_template_directory_uri(); ?>/img/entidades/unasur.jpg" />
            </a></div>
            </li>
            
            <li class="itemposts"><div class="items grises">
            <a href="http://www.ingemmet.gob.pe/form/Inicio.aspx" target="_blank" title="Instituto Geológico Minero y Metalúrgico" >
            <img alt="INGEMMET" src="<?php echo get_template_directory_uri(); ?>/img/entidades/logo-ingemmet-2014.jpg" />
            </a></div>
            </li>
            
            <li class="itemposts"><div class="items grises">
            <a href="http://www.sni.org.pe/" target="_blank" title="Sociedad Nacional de Industrias" >
            <img alt="SNI" src="<?php echo get_template_directory_uri(); ?>/img/entidades/Logotipo-SNI1.jpg" />
            </a></div>
            </li>
            
            <li class="itemposts"><div class="items grises">
            <a href="http://mimp.gob.pe/adultomayor/" target="_blank" title="Personas Adultas Mayores" >
            <img alt="PAM" src="<?php echo get_template_directory_uri(); ?>/img/entidades/adultomayor.jpg" />
            </a></div>
            </li>
            
        </ul> 
        
        <a title="Siguiente" id="nextfeatured-properties" href="#" class="next btn_next2 animationAll z2">NEXT<span></span></a>
	    <a title="Anterior" id="prevfeatured-properties" href="#" class="prev btn_prev2 animationAll z2">PREV<span></span></a>
    </div>
</section>
</div>
<footer id="footer"> 
    <div class="container">
        <div class="pad-content">
        
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