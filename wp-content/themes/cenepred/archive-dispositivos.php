<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
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
		
		<!--	<div class="site-location">
				<h1 class="location-title">
					<?php _e( 'Resoluciones' ) ?>
				</h1>
				<h2><?php _e( 'Resoluciones y Decretos PCM para el CENEPRED' ) ?></h2>
			</div> -->
	
	
		
	<!-- Inicio para agregar un nuevo elemento -->		
			<!--<article class="blog-list group">-->	
				 <!--  post de blog-->
		      <!--   <div class="cont-date">-->	
		        <!-- 	<a href="#">-->	
		        <!-- 		<img src="<?php echo get_template_directory_uri(); ?>/img/iso.png" alt="">-->	
		        <!-- 	</a>-->	
		    <!--     </div>-->	
		        <!-- contenido post de blog-->
		       <!--  <div class="cont-post">-->	
		    	<!-- 	<h2 class="entry-title"><a href="<?php bloginfo( 'url' ); ?>/tipo/ley/">Ley</a></h2>-->	
		    
		    	<!-- 	<div class="entry-excerpt">-->	
		    			<!-- <p>Descripción corta para esta categoría</p> -->
		    	<!-- 	</div><!-- .entry-excerpt -->
		      <!--   </div>-->	
			<!-- </article>-->	
	<!-- Fin para agregar un nuevo elemento -->

			<!-- <article class="blog-list group"> -->
				 <!--  post de blog-->
		       <!--  <div class="cont-date">-->
		        <!-- 	<a href="#">-->
		        <!-- 		<img src="<?php echo get_template_directory_uri(); ?>/img/iso.png" alt="">-->
		        <!-- 	</a>-->
		     <!--    </div>-->
		        <!-- contenido post de blog-->
		      <!--   <div class="cont-post">-->
		    	<!-- 	<h2 class="entry-title"><a href="<?php bloginfo( 'url' ); ?>/tipo/decretos-supremos/">Decretos Supremos</a></h2>-->
		    
		    	<!-- 	<div class="entry-excerpt">-->
		    			<!-- <p>Descripción corta para esta categoría</p> -->
		    	<!-- 	</div>--><!-- .entry-excerpt -->
		      <!--   </div>-->
			<!-- </article>-->
			
			


<!-- Inicio para agregar un nuevo elemento -->		
			<!--<article class="blog-list group">-->
				 <!--  post de blog-->
		        <!--<div class="cont-date">-->
		        	<!--<a href="#">-->
		        	<!--	<img src="<?php echo get_template_directory_uri(); ?>/img/iso.png" alt="">-->
		        	<!--</a>-->
		      <!--  </div>-->
		        <!-- contenido post de blog-->
		       <!-- <div class="cont-post">-->
		    	<!--	<h2 class="entry-title"><a href="<?php bloginfo( 'url' ); ?>/tipo/Politica/">Política Nacional de Gestión del riesgo de Desastres</a></h2>-->
		    
		    		<!--<div class="entry-excerpt">-->
		    			<!-- <p>Descripción corta para esta categoría</p> -->
		    		<!--</div>--><!-- .entry-excerpt -->
		      <!--  </div>-->
			<!--</article>-->
	

<!-- Fin para agregar un nuevo elemento -->


			<!--<article class="blog-list group"> -->
				 <!--  post de blog-->
		       <!-- <div class="cont-date"> -->
		        <!--	<a href="#"> -->
		        	<!--	<img src="<?php echo get_template_directory_uri(); ?>/img/iso.png" alt=""> -->
		        <!--	</a> -->
		     <!--   </div> -->
		        <!-- contenido post de blog-->
		      <!--  <div class="cont-post"> -->
		    	<!--	<h2 class="entry-title"><a href="<?php bloginfo( 'url' ); ?>/tipo/resoluciones/">Resoluciones Ministeriales</a></h2> -->
		    
		    	<!--	<div class="entry-excerpt"> -->
		    			<!-- <p>Descripción corta para esta categoría</p> -->
		    		<!--</div> --><!-- .entry-excerpt -->
		      <!--  </div> -->
			<!--</article> -->
			
			
			
			<article class="blog-list group">
				 <!--  post de blog-->
		        <div class="cont-date">
		        	<a href="#">
		        		<img src="<?php echo get_template_directory_uri(); ?>/img/iso.png" alt="">
		        	</a>
		        </div>
		        <!-- contenido post de blog-->
		        <div class="cont-post">
		    		<h2 class="entry-title"><a href="<?php bloginfo( 'url' ); ?>/tipo/convenios/">Convenios</a></h2>
		    
		    		<div class="entry-excerpt">
		    			<!-- <p>Descripción corta para esta categoría</p> -->
		    		</div><!-- .entry-excerpt -->
		        </div>
			</article>
			
	

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php //get_template_part( 'content', 'blog' ); ?>

				<?php endwhile; ?>

				<?php //blakzr_content_nav( 'nav-below' ); ?>

			<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<h1 class="entry-title"><?php _e( 'No se encontr— nada', 'blakzr' ); ?></h1>
				
				<div class="entry-content">
					<p><?php _e( 'Disculpas, pero no se han encontrado resultados para el archivo solicitado. Puede que la bœsqueda le ayudar‡ a encontrar una entrada relacionada.', 'blakzr' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

			<?php endif; ?>
		</div><!-- .main-content -->

		<?php get_sidebar(); ?>

	<?php get_footer(); ?>