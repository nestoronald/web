<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage BlakzrFramework
 * @since BlakzrFramework 0.1
 */
?>
<!--<aside class="main-sidebar col-2-6">
			<ul class="sidebar">
				< ?php if ( ! dynamic_sidebar( 'Sidebar Principal' ) ) : ?>
					<li class="widget">
						<h4 class="widgettitle">< ?php _e('Sample Widget', 'blakzr'); ?></h4>
						<p>< ?php _e('This is not a real widget. Just a placeholder. You can put any other available widgets in this area. Try it, what are you waiting for?', 'blakzr'); ?></p>
					</li>
				< ?php endif; ?>
			</ul>
</aside>-->
<?php
	if(is_active_sidebar('widget-video')){
		?>
		<aside class="main-sidebar">
    <section class="sidebar-publicaciones">
        <div class="tit-seccion">En Directo</div>
        <div class="cont-sidebar cont-publi">
            <div class="contenedor">
            <?php dynamic_sidebar('widget-video'); ?>
            </div>
        </div> 
    </section>
    </aside>
		<?php
		
	} else {
?>
<aside class="main-sidebar">
    <section class="sidebar-publicaciones">
        <div class="tit-seccion">Temas de inter&eacute;s t&eacute;cnico</div>
        <div class="cont-sidebar cont-publi">
            <ul class="tabs" id="first-row">
                <li><a href="#tab1">Manuales</a></li>
                <li><a href="#tab2">Guias</a></li>
                <li><a href="#tab3">Planes</a></li>
                <li><a href="#tab4">Informes</a></li>
            </ul>
            
            <div class="contenedor">
                <div id="tab1" class="contenido">
                    <ul>
                        <li>
                        	<?php
							$args = array(
								'posts_per_page' 	=> 1,
								'order'				=> 'DESC',
								'orderby'	 		=> 'date',
								'tipo' 				=> 'manuales',
								'post_status' 		=> 'publish'
							);
						
							$show_posts = new WP_Query( $args );
						
							if ( $show_posts->have_posts() ) :
								while ( $show_posts->have_posts() ) : $show_posts->the_post(); ?>
									<div class="image-informe">
										<?php if ( has_post_thumbnail() ) : ?>
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
										<?php else : ?>
											<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/thumbnail.png" alt="<?php the_title(); ?>"></a>
										<?php endif; ?>
									</div>
	                            <div class="txt-informe">
	                                <h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
	                                <p><?php echo trim( substr( get_the_excerpt(), 0, 100 ) ).'.'; ?></p>    
	                            </div>
	                            <!-- <a class="bot-vermas bot-descarga text-shadow" title="Descargar" href="#">Descargar</a> -->
								<?php endwhile; ?>
<a class="bot-vermas bot-descarga text-shadow" title="Ver más" href="<?php echo site_url( '/' ); ?>tipo/manuales">Ver más</a>
								<?php wp_reset_postdata(); ?>
							<?php else : ?>
								
							<?php endif; ?>
                        </li>
                    </ul>                        
                </div>
                <div id="tab2" class="contenido">
                	<ul>
                        <li>
                        	<?php
							$args = array(
								'posts_per_page' 	=> 1,
								'order'				=> 'DESC',
								'orderby'	 		=> 'date',
								'tipo' 				=> 'guias',
								'post_status' 		=> 'publish'
							);
						
							$show_posts = new WP_Query( $args );
						
							if ( $show_posts->have_posts() ) :
								while ( $show_posts->have_posts() ) : $show_posts->the_post(); ?>
									<div class="image-informe">
										<?php if ( has_post_thumbnail() ) : ?>
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
										<?php else : ?>
											<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/thumbnail.png" alt="<?php the_title(); ?>"></a>
										<?php endif; ?>
									</div>
	                            <div class="txt-informe">
	                                <h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
	                                <p><?php echo trim( substr( get_the_excerpt(), 0, 100 ) ).'.'; ?></p>    
	                            </div>
	                            <!-- <a class="bot-vermas bot-descarga text-shadow" title="Descargar" href="#">Descargar</a> -->
								<?php endwhile; ?>
<a class="bot-vermas bot-descarga text-shadow" title="Ver más" href="<?php echo site_url( '/' ); ?>tipo/guias">Ver más</a>
								<?php wp_reset_postdata(); ?>
							<?php else : ?>
								
							<?php endif; ?>
                        </li>
                    </ul>
                </div>
                <div id="tab3" class="contenido">
                <ul>
                        <li>
                        	<?php
							$args = array(
								'posts_per_page' 	=> 1,
								'order'				=> 'DESC',
								'orderby'	 		=> 'date',
								'tipo' 				=> 'planes',
								'post_status' 		=> 'publish'
							);
						
							$show_posts = new WP_Query( $args );
						
							if ( $show_posts->have_posts() ) :
								while ( $show_posts->have_posts() ) : $show_posts->the_post(); ?>
									<div class="image-informe">
										<?php if ( has_post_thumbnail() ) : ?>
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
										<?php else : ?>
											<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/thumbnail.png" alt="<?php the_title(); ?>"></a>
										<?php endif; ?>
									</div>
	                            <div class="txt-informe">
	                                <h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
	                                <p><?php echo trim( substr( get_the_excerpt(), 0, 100 ) ).'.'; ?></p>    
	                            </div>
	                            <!-- <a class="bot-vermas bot-descarga text-shadow" title="Descargar" href="#">Descargar</a> -->
								<?php endwhile; ?>
								<?php wp_reset_postdata(); ?>
							<?php else : ?>
								
							<?php endif; ?>
                        </li>
                    </ul>
                </div>
                <div id="tab4" class="contenido">
                	<ul>
                        <li>
                        	<?php
							$args = array(
								'posts_per_page' 	=> 1,
								'order'				=> 'DESC',
								'orderby'	 		=> 'date',
								'tipo' 				=> 'informes',
								'post_status' 		=> 'publish'
							);
						
							$show_posts = new WP_Query( $args );
						
							if ( $show_posts->have_posts() ) :
								while ( $show_posts->have_posts() ) : $show_posts->the_post(); ?>
									<div class="image-informe">
										<?php if ( has_post_thumbnail() ) : ?>
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
										<?php else : ?>
											<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/thumbnail.png" alt="<?php the_title(); ?>"></a>
										<?php endif; ?>
									</div>
	                            <div class="txt-informe">
	                                <h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
	                                <p><?php echo trim( substr( get_the_excerpt(), 0, 100 ) ).'.'; ?></p>    
	                            </div>
	                            <!-- <a class="bot-vermas bot-descarga text-shadow" title="Descargar" href="#">Descargar</a> -->
								<?php endwhile; ?>
								<?php wp_reset_postdata(); ?>
							<?php else : ?>
								
							<?php endif; ?>
                        </li>
                    </ul>
                </div>
                
            </div>
            
            <ul class="tabs" id="second-row">
                <li><a href="#tab5">Aula Virtual</a></li>
                <li><a href="#tab6">Catálogos</a></li>
                <li class="enfen-tab"><a href="#tab7">Comunicados ENFEN</a></li>
                <li><a href="#tab8">Comunicados</a></li>
            </ul>
            
            <div class="contenedor">            
            
                <div id="tab5" class="contenido">
                	<ul>
                        <li>
                        	<?php
							$args = array(
								'posts_per_page' 	=> 1,
								'order'				=> 'DESC',
								'orderby'	 		=> 'date',
								'tipo' 				=> 'escenarios',
								'post_status' 		=> 'publish'
							);
						
							$show_posts = new WP_Query( $args );
						
							if ( $show_posts->have_posts() ) :
								while ( $show_posts->have_posts() ) : $show_posts->the_post(); ?>
									<div class="image-informe">
										<?php if ( has_post_thumbnail() ) : ?>
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
										<?php else : ?>
											<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/thumbnail.png" alt="<?php the_title(); ?>"></a>
										<?php endif; ?>
									</div>
	                            <div class="txt-informe">
	                                <h3><a href="http://aulavirtual.cenepred.gob.pe:8085/chamilo-1.9.4" target="_blank" title="">Plataforma de Desarrollo de Capacidades a Distancia CENEPRED</a></h3>
	                                <p><?php echo trim( substr( get_the_excerpt(), 0, 100 ) ).'.'; ?></p>    
	                            </div>
                                
                                
                                
                                <div class="image-informe">
										<?php if ( has_post_thumbnail() ) : ?>
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
										<?php else : ?>
											<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/thumbnail.png" alt="<?php the_title(); ?>"></a>
										<?php endif; ?>
									</div>
                                
                                 <div class="txt-informe">
	                               <h3><a href="http://aulavirtual.cenepred.gob.pe:8085/cenepred/aulavirtual" target="_blank" title="">Aula Virtual (Nueva versión)</a></h3>
	                               <p><?php echo 'Nueva versión del aula virtual CENEPRED'; ?></p>    
	                            </div>
                                
                                
                                
	                            <!-- <a class="bot-vermas bot-descarga text-shadow" title="Descargar" href="#">Descargar</a> -->
								<?php endwhile; ?>
								<?php wp_reset_postdata(); ?>
							<?php else : ?>
								
							<?php endif; ?>
                        </li>
                    </ul>
                </div>
                
                <div id="tab6" class="contenido">
                	<ul>
                        <li>
                        	<?php
							$args = array(
								'posts_per_page' 	=> 1,
								'order'				=> 'DESC',
								'orderby'	 		=> 'date',
								'tipo' 				=> 'catalogos',
								'post_status' 		=> 'publish'
							);
						
							$show_posts = new WP_Query( $args );
						
							if ( $show_posts->have_posts() ) :
								while ( $show_posts->have_posts() ) : $show_posts->the_post(); ?>
									<div class="image-informe">
										<?php if ( has_post_thumbnail() ) : ?>
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
										<?php else : ?>
											<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/thumbnail.png" alt="<?php the_title(); ?>"></a>
										<?php endif; ?>
									</div>
	                            <div class="txt-informe">
	                                <h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
	                                <p><?php echo trim( substr( get_the_excerpt(), 0, 100 ) ).'.'; ?></p>    
	                            </div>
	                            <!-- <a class="bot-vermas bot-descarga text-shadow" title="Descargar" href="#">Descargar</a> -->
								<?php endwhile; ?>
<a class="bot-vermas bot-descarga text-shadow" title="Ver más" href="<?php echo site_url( '/' ); ?>tipo/catalogos/">Ver más</a>	
								<?php wp_reset_postdata(); ?>
							<?php else : ?>
								
							<?php endif; ?>
                        </li>
                    </ul>
                </div>
                
                <div id="tab7" class="contenido">
                	<ul>
                        <li>
                        	<?php
							$args = array(
								'posts_per_page' 	=> 1,
								'order'				=> 'DESC',
								'orderby'	 		=> 'date',
								'post_type' 		=> 'post',
								'category_name'		=> 'comunicados-enfen',
								'post_status' 		=> 'publish'
							);
						
							$show_posts = new WP_Query( $args );
						
							if ( $show_posts->have_posts() ) :
								while ( $show_posts->have_posts() ) : $show_posts->the_post(); ?>
									<div class="image-informe">
										<?php if ( has_post_thumbnail() ) : ?>
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
										<?php else : ?>
											<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/thumbnail.png" alt="<?php the_title(); ?>"></a>
										<?php endif; ?>
									</div>
	                            <div class="txt-informe">
	                                <h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
	                                <p><?php echo trim( substr( get_the_excerpt(), 0, 100 ) ).'.'; ?></p>    
	                            </div>
	                            <!-- <a class="bot-vermas bot-descarga text-shadow" title="Descargar" href="#">Descargar</a> -->
								<?php endwhile; ?>
					<a class="bot-vermas bot-descarga text-shadow" title="Ver más" href="<?php echo site_url( '/' ); ?>category/comunicados-enfen/">Ver más</a>				
								<?php wp_reset_postdata(); ?>
							<?php else : ?>
								
							<?php endif; ?>
                        </li>
                    </ul>
                </div>
                
                <div id="tab8" class="contenido">
                	<ul>
                        <li>
                        	<?php
							$args = array(
								'posts_per_page' 	=> 1,
								'order'				=> 'DESC',
								'orderby'	 		=> 'date',
								'post_type' 		=> 'post',
								'category_name'		=> 'comunicados',
								'post_status' 		=> 'publish'
							);
						
							$show_posts = new WP_Query( $args );
						
							if ( $show_posts->have_posts() ) :
								while ( $show_posts->have_posts() ) : $show_posts->the_post(); ?>
									<div class="image-informe">
										<?php if ( has_post_thumbnail() ) : ?>
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
										<?php else : ?>
											<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/thumbnail.png" alt="<?php the_title(); ?>"></a>
										<?php endif; ?>
									</div>
	                            <div class="txt-informe">
	                                <h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
	                                <p><?php echo trim( substr( get_the_excerpt(), 0, 100 ) ).'.'; ?></p>    
	                            </div>
	                            <!-- <a class="bot-vermas bot-descarga text-shadow" title="Descargar" href="#">Descargar</a> -->
								<?php endwhile; ?>
<a class="bot-vermas bot-descarga text-shadow" title="Ver más" href="<?php echo site_url( '/' ); ?>category/comunicados/">Ver más</a>
								<?php wp_reset_postdata(); ?>
							<?php else : ?>
								
							<?php endif; ?>
                        </li>
                    </ul>
                </div>
                
            </div>
               
        </div> 
    </section>
    <?php if(!is_front_page()){ ?>
    <section class="comunicados-rec">
        <div class="tit-seccion">Comunicados recientes</div>
        <div class="cont-sidebar">
        	<?php
			$args = array(
				'posts_per_page' 	=> 3,
				'order'				=> 'DESC',
				'orderby'	 		=> 'date',
				'post_type' 		=> 'post',
				'category_name'		=> 'comunicados',
				'post_status' 		=> 'publish'
			);
		
			$show_posts = new WP_Query( $args );
		
			if ( $show_posts->have_posts() ) :
				while ( $show_posts->have_posts() ) : $show_posts->the_post(); ?>
				<div class="commu-cont">
	                <h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
	                <p><?php echo trim( substr( get_the_excerpt(), 0, 120 ) ).' [...]'; ?></p>  
	            </div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				
			<?php endif; ?>
        </div>
    </section>
    <?php } ?>
</aside>
<?php } ?>