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
					<?php _e('Notas de Prensa', 'blakzr'); ?>
				</h1>
			</div>
						
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
			</ul>
			
			<div class="archive-updater">
			
				<?php // echo 'h:'.have_posts();  
				
				if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post();  ?>
	
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
					<h1 class="entry-title"><?php _e( 'No se encontró nada', 'blakzr' ); ?></h1>
					
					<div class="entry-content">
						<p><?php _e( 'Disculpas, pero no se han encontrado resultados para el archivo solicitado. Puede que la bœsqueda le ayudar‡ a encontrar una entrada relacionada.', 'blakzr' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->
	
				<?php endif; ?>
				
			</div>
			
		</div><!-- .main-content -->

		<?php get_sidebar(); ?>

	<?php get_footer(); ?>