<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage BlakzrFramework
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

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
					$format = get_post_format();
					if ( false === $format )
						$format = 'standard';
					?>

					<?php get_template_part( 'content', 'blog' ); ?>

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

	<!-- </div> fin de main esta en el footer -->

	<?php get_footer(); ?>