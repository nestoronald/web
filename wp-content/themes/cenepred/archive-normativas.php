<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage BlakzrFramework
 * @since BlakzrFramework 0.1
 */


get_header(); ?>

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
		
			<div class="site-location">
				<h1 class="location-title">
				

				<?php _e( 'Dirección de Gestión de Procesos – DGP' ) ?>
				</h1>
				<!-- <h2><?php _e( 'Resoluciones y Decretos PCM para el CENEPRED' ) ?></h2> -->
			</div>
			
			<article>
				<div class="entry-content">
					<p>Es el órgano de línea responsable técnico de coordinar, facilitar y supervisar la formulación e implementación de la Política Nacional y el Plan Nacional de Gestión del Riesgo de Desastres en los procesos de estimación, prevención, reducción del riesgo y reconstrucción; asimismo, es responsable de asesorar y proponer las normas, lineamientos técnicos y coordinar la incorporación de la Gestión Prospectiva y Correctiva en los planes de desarrollo, ordenamiento territorial y demás instrumentos de planificación, en los tres niveles de gobierno, así como establecer los mecanismos que faciliten el acceso a la información geoespacial y/o registros generales para la Gestión del Riesgo de Desastres.</p>
<p style="text-align: justify;">

				</div>
			</article>            
			
			<article class="blog-list group">
				 <!--  post de blog-->
		        <div class="cont-date">
		        	<a href="#">
		        		<img src="<?php echo get_template_directory_uri(); ?>/img/iso.png" alt="">
		        	</a>
		        </div>
		        <!-- contenido post de blog-->
		        <div class="cont-post">
		    		<h2 class="entry-title"><a href="<?php bloginfo( 'url' ); ?>/escenarios-de-riesgos/">Escenarios de Riesgo</a></h2>
		    
		    		<div class="entry-excerpt">
		    			<!-- <p>Descripción corta para esta categoría</p> -->
		    		</div><!-- .entry-excerpt -->
		        </div>
			</article>
			
			<article class="blog-list group">
				 <!--  post de blog-->
		        <div class="cont-date">
		        	<a href="#">
		        		<img src="<?php echo get_template_directory_uri(); ?>/img/iso.png" alt="">
		        	</a>
		        </div>
		        <!-- contenido post de blog-->
		        <div class="cont-post">
		    		<h2 class="entry-title"><a href="<?php bloginfo( 'url' ); ?>/tipo/manuales/">Manuales</a></h2>
		    
		    		<div class="entry-excerpt">
		    			<!-- <p>Descripción corta para esta categoría</p> -->
		    		</div><!-- .entry-excerpt -->
		        </div>
			</article>
			
			<article class="blog-list group">
				 <!--  post de blog-->
		        <div class="cont-date">
		        	<a href="#">
		        		<img src="<?php echo get_template_directory_uri(); ?>/img/iso.png" alt="">
		        	</a>
		        </div>
		        <!-- contenido post de blog-->
		        <div class="cont-post">
		    		<h2 class="entry-title"><a href="<?php bloginfo( 'url' ); ?>/tipo/catalogos/">Catálogos</a></h2>
		    
		    		<div class="entry-excerpt">
		    			<!-- <p>Descripción corta para esta categoría</p> -->
		    		</div><!-- .entry-excerpt -->
		        </div>
			</article>

			<article class="blog-list group">
				 <!--  post de blog-->
		        <div class="cont-date">
		        	<a href="#">
		        		<img src="<?php echo get_template_directory_uri(); ?>/img/iso.png" alt="">
		        	</a>
		        </div>
		        <!-- contenido post de blog-->
		        <div class="cont-post">
		    		<h2 class="entry-title"><a href="<?php bloginfo( 'url' ); ?>/tipo/exposiciones/">Exposiciones</a></h2>
		    
		    		<div class="entry-excerpt">
		    			<!-- <p>Descripción corta para esta categoría</p> -->
		    		</div><!-- .entry-excerpt -->
		        </div>
			</article>



	

			
		</div><!-- .main-content -->

		<?php get_sidebar(); ?>

	<?php get_footer(); ?>