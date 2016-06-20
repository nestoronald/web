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
		
			<div class="site-location">
				<h1 class="location-title">
					<?php
				    global $wp_query;
				    $term = $wp_query->get_queried_object();
				    $title = $term->name;
				    echo $title;
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