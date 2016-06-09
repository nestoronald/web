<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage BlakzrFramework
 * @since BlakzrFramework 0.1
 */
?><article id="post-<?php the_ID(); ?>" <?php post_class('group'); ?>>

		<?php if ( is_single() ) : ?>
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1>
		<?php else : ?>
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Enlace a %s', 'blakzr' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
		<?php the_title(); ?>
		</a></h2>
		<?php endif; ?>

		<?php if ( is_search() || ! is_single() ) : // Only display Excerpts for Search ?>
		<div class="entry-excerpt">
			<p><?php echo get_the_excerpt(); ?> <a href="<?php the_permalink(); ?>" class="more-link"><?php _e( 'Leer más &rarr;', 'blakzr' ); ?></a></p>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continuar leyendo <span class="meta-nav">&rarr;</span>', 'blakzr' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Páginas:', 'blakzr' ) . '</span>', 'after' => '</div>' ) ); ?>
			<?php edit_post_link( __( 'Editar este post', 'blakzr' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>
		
		<div class="prev-next-entries">
			<?php previous_post_link( '%link', '&laquo; Anterior' ); ?>
			<?php next_post_link( '%link', 'Siguiente &raquo;' ); ?>
		</div>

	</article><!-- #post-<?php the_ID(); ?> -->
