<?php
/**
 * The template for displaying Search Results pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage BlakzrFramework
 * @since BlakzrFramework 0.1
 */

get_header(); ?>

	<div class="site-location">
		<div class="wrapper group">
			<h1 class="location-title"><?php printf( __( 'Resultados para: %s', 'blakzr' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</div>
	</div>

	<div class="main wrapper grid">

		<div class="main-content col-8-12">

			<nav class="breadcrumbs">
				<?php
				// Code to display breadcrumbs from the plugin 'Breadcrumbs NavXT'
				if ( function_exists( 'bcn_display' ) ) :
					bcn_display();
				endif;
				?>
			</nav>

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
					$format = get_post_format();
					if ( false === $format )
						$format = 'standard';
					?>

					<?php get_template_part( 'content', 'search' ); ?>

				<?php endwhile; ?>

				<?php blakzr_content_nav( 'nav-below' ); ?>

			<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<h1 class="entry-title"><?php _e( 'No se encontró nada', 'blakzr' ); ?></h1>
				
				<div class="entry-content">
					<p><?php _e( 'Disculpas, pero no se han encontrado resultados para el archivo solicitado. Puede que la búsqueda le ayudará a encontrar una entrada relacionada.', 'blakzr' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

			<?php endif; ?>
		</div><!-- .main-content -->

		<?php get_sidebar(); ?>

	</div>

	<?php get_footer(); ?>