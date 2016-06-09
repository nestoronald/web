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
					<?php
						if ( is_category() ) {
							printf( __( 'Categoría: %s', 'blakzr' ), '<span>' . single_cat_title( '', false ) . '</span>' );
							$category_description = category_description();
						} elseif ( is_tag() ) {
							printf( __( 'Etiqueta: %s', 'blakzr' ), '<span>' . single_tag_title( '', false ) . '</span>' );
							$tag_description = tag_description();
						} elseif ( is_author() ) {
							/* Queue the first post, that way we know
							 * what author we're dealing with (if that is the case).
							*/
							the_post();
							printf( __( 'Entradas por %s', 'blakzr' ), '<span class="vcard">' . get_the_author() . '</span>' );
							?>
							<?php
							/* Since we called the_post() above, we need to
							 * rewind the loop back to the beginning that way
							 * we can run the loop properly, in full.
							 */
							rewind_posts();
		
						} elseif ( is_day() ) {
							printf( __( 'Archivos Diarios: %s', 'blakzr' ), '<span>' . get_the_date() . '</span>' );
		
						} elseif ( is_month() ) {
							printf( __( 'Archivos Mensuales: %s', 'blakzr' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
		
						} elseif ( is_year() ) {
							printf( __( 'Archivos Anuales: %s', 'blakzr' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
		
						} else {
							_e( 'Archivos', 'blakzr' );
		
						}
					?>
				</h1>
				<?php if ( is_author() ) : ?>
				<p class="description"><?php the_author_meta( 'description' ); ?></p>
					<?php
					$googleplus = get_the_author_meta( 'googleplus' );
					if ( !empty( $googleplus ) ) :
					?>
					<ul class="social-profiles">
						<li><?php printf( '<a href="https://plus.google.com/%2$s/posts?rel=author" rel="me" target="_blank" class="gplus">Sigue a %1$s en Google+</a>', get_the_author_meta( 'first_name' ), $googleplus ); ?></li>
					</ul>
					<?php endif; ?>
				<?php endif; ?>
				<?php if ( '' != $category_description ) : ?>
					<?php echo apply_filters( 'category_archive_meta', '<p class="description">' . $category_description . '</p>' ); ?>
				<?php elseif ( '' != $tag_description ) : ?>
					<?php echo apply_filters( 'tag_archive_meta', '<p class="description">' . $tag_description . '</p>' ); ?>
				<?php endif; ?>
			</div>

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

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

	<?php get_footer(); ?>